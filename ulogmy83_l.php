<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

//костыль чтобы не тянуть common.php
function runSQL($r) { return; }

require_once ("../pln-pskov.ru/mysql.php");

$authForum=new authForum([
    'mysql_host'=>$mysql_host,
    'mysql_username'=>$mysql_username,
    'mysql_password'=>$mysql_password,
    'mysql_database'=>$mysql_database,
    ]);

$actions = ['login','logout','update_profile','upload_image','send_request'];

if ((isset($_REQUEST['act'])) && (in_array($_REQUEST['act'],$actions)))
{
    $authForum->$_REQUEST['act']();
}
else
{
    $authForum->wrongaction();
}

class authForum {
    var $db;
    var $user;
    //методы авторизации
    var $method = ['cookie','ulogin','sms'];
    var $fields = ['provider','network','profile','uid','first_name','last_name','identity','image','auth_time'];
    var $salt = 'bDWzMZQW2Vvvv4KA6sZF'; //солим хеши

    public function __construct(array $config)
    {
        $this->db = new mysqli($config['mysql_host'], $config['mysql_username'], $config['mysql_password'], $config['mysql_database']);
        $this->db->query("set session character_set_server=cp1251;");
        $this->db->query("set session character_set_database=cp1251;");
        $this->db->query("set session character_set_connection=cp1251;");
        $this->db->query("set session character_set_results=cp1251;");
        $this->db->query("set session character_set_client=cp1251;");
    }
    
    public function login() {
        switch ($_POST['mode'])
        {
            case 'ulogin':
                $s = file_get_contents('http://ulogin.ru/token.php?token='.$_POST['token'].'&host='.$_SERVER['HTTP_HOST']);
                $user = json_decode($s, true);
                if (!isset($user['error']))
                {
                    $this->user=$user;
                    $this->ulogin();
                    $this->getUser('ulogin');
                }
                else
                {
                    echo $s;
                }
            break;

            case 'sms':
                $this->getUser('sms');    
            break;

            default:
                $this->getUser('cookie');
            break;
        }
    }

    public function send_request()
    {
        if (!preg_match("/\d{11,13}$/",$_POST['phone']))
        {
            echo json_encode(['error'=>['code'=>1,'text'=>'error format number']]);
            return false;
        }

        if (!(isset($_POST['time'])&&is_numeric($_POST['time'])&&($_POST['time']>0)))
        {
            echo json_encode(['error'=>['code'=>3,'text'=>'error request']]);
            return false;
        }

        $code="";
        for ($i = 0; $i<5; $i++) 
        {
            $code.= mt_rand(0,9);
        }

        //проверим что такой номер есть в базе
        $r = $this->db->query("SELECT * FROM forum_user WHERE provider='smsc' AND identity='".$this->db->real_escape_string($_POST['phone'])."'");
        $id=0;
        $last_name="";
        $first_name="";

        $current_time=time();

        if ($r->num_rows)
        {
            $res = $r->fetch_assoc();

            if ($res['auth_time']!=0&&$res['auth_time']+150>$current_time)
            {
                echo json_encode(['error'=>['code'=>4,'text'=>'time for re-request has not come']]);
                return false;
            }

            $id=$res['id'];
            $last_name=$res['last_name'];
            $first_name=$res['first_name'];
        }

        if ($this->send_sms_code($_POST['phone'],$code))
        {
            if ($id!=0)
            {
                $this->db->query("UPDATE forum_user SET uid='".sha1($code)."',auth_time='".$current_time."' WHERE id='".$res['id']."'");
            }
            else
            {
                $this->db->query("INSERT INTO forum_user (provider,network,uid,identity,auth_time) VALUES ('smsc','smsc.ru','".sha1($code)."','".$this->db->real_escape_string($_POST['phone'])."','".$current_time."')");
                $id = $this->db->insert_id;
            }
            
            echo json_encode($this->arr2UTF8(['id'=>$id,'first_name'=>$first_name,'last_name'=>$last_name]));
            return true;
        }
        echo json_encode(['error'=>['code'=>2,'text'=>'error send sms']]);
        return false;
    }

    public function logout($result=true) {
        setcookie('auth_token');
        if ($result)
        {
            echo json_encode(['t'=>$_COOKIE['auth_token']]);
        }
        return;
    }

    public function update_profile() {
        if ($this->isLogin())
        {
            if ((isset($_POST['first_name']) && trim($_POST['first_name']!='')) ||(isset($_POST['last_name']) && trim($_POST['last_name']!='')))
            {
                $this->user['first_name']=$this->db->real_escape_string(mb_convert_encoding(trim($_POST['first_name']),'CP-1251','UTF-8'));
                $this->user['last_name']=$this->db->real_escape_string(mb_convert_encoding(trim($_POST['last_name']),'CP-1251','UTF-8'));
                $this->saveUser();
                $this->getUser('cookie');
                return true;
            }            
        }
        echo json_encode(['error'=>['code'=>101,'text'=>'user not login']]);
        return false;
    }

    //загрузка картинки профиля
    public function upload_image() {
        if ($this->isLogin())
        {
            $path = realpath(__DIR__ . "/pictures/forum/").'/';
            if (isset($_FILES['photo']))
            {
                $ext_list=['gif','jpg','jpeg','png'];
                $fn = $_FILES['photo']['name'];
                $ext = strtolower(pathinfo($fn, PATHINFO_EXTENSION));
                if( in_array($ext,$ext_list) )
                {
                    $image=$this->user['id'].'_'.time().'.jpg';//.$ext;

                    if (!$this->image_crop($_FILES['photo']['tmp_name'],$path.$image))
                    {
                        echo json_encode(['error'=>['code'=>'4','text'=>'error loading image on server']]);
                        return false;
                    }

                    if (file_exists($path.$image)) {
                        $this->db->query("UPDATE forum_user SET image='/pictures/forum/".$image."' WHERE id='".$this->user['id']."'");
                        echo json_encode(['image'=>'/pictures/forum/'.$image]);
                        return true;
                    }
                    else
                    {
                        echo json_encode(['error'=>['code'=>'4','text'=>'error loading image on server']]);
                        return false;
                    }
                }
                else
                {
                    echo json_encode(['error'=>['code'=>'3','text'=>'wrong image format']]);
                    return false;
                }
            }
            else
            {
                echo json_encode(['error'=>['code'=>'2','text'=>'no image uploaded']]);
                return false;
            }
        }
       
        echo json_encode(['error'=>['code'=>101,'text'=>'user not login']]);
        return false;
    }

    public function wrongaction() {
        echo json_encode(['error'=>['code'=>404,'text'=>'wrong request']]);
        return false;
    }

    protected function isLogin()
    {
        if (isset($_COOKIE['auth_token']) && $_COOKIE['auth_token']!='')
        {
            $r = $this->db->query("SELECT id,first_name,last_name,image,network,profile,identity,auth_time FROM forum_user WHERE SHA1(CONCAT(`identity`,`network`,`auth_time`,'".$this->salt."'))='".$this->db->real_escape_string($_COOKIE['auth_token'])."'");
            if ($r->num_rows)
            {
                $this->user = $r->fetch_assoc();
                return true;
            }
        }
        return false;
    }
    
    protected function ulogin()
    {
        if (isset($this->user['identity']) && $this->user['identity']!='' && isset($this->user['network']) &&$this->user['network']!='' )
        {
            foreach ($this->user as $k=>$v)
            {
                $this->user[$k]=$this->db->real_escape_string(mb_convert_encoding ($v,'CP-1251','UTF-8'));    
            }

            $this->user['auth_time']=time();
            
            $r=$this->db->query("SELECT id FROM forum_user WHERE SHA1(CONCAT(identity,network))='".sha1($this->user['identity'].$this->user['network'])."'");
            if ($r->num_rows)
            {
                //обновляем поля
                $res = $r->fetch_assoc();
                $this->user['id']=$res['id'];
                $this->user['image']=$this->saveUloginPhoto();
                $this->saveUser();
            }
            else
            {
                //создаем пользователя
                $this->saveUser();
                $this->user['image']=$this->saveUloginPhoto();
                $this->saveUser();
            }
        }
    }


    protected function getUser($method)
    {
        $query="";
        switch ($method)
        {
            case 'cookie':
                //todo: переделать на использоване isLogin
                if (isset($_COOKIE['auth_token']) && $_COOKIE['auth_token']!='')
                {
                    $query.="SHA1(CONCAT(`identity`,`network`,`auth_time`,'".$this->salt."'))='".$this->db->real_escape_string($_COOKIE['auth_token'])."'";
                }
            break;

            case 'sms':
                if (preg_match("/\d{11,13}$/",$_POST['phone']) && preg_match("/\d{5}$/",$_POST['code']))
                {
                    $query.="identity='".$this->db->real_escape_string($_POST['phone'])."' AND uid='".sha1($_POST['code'])."'";
                }
            break;

            case 'ulogin':
                if (isset($this->user['identity']) && $this->user['identity']!='' && isset($this->user['network']) &&$this->user['network']!='' )
                {
                    $query.="id ='".$this->user['id']."'";
                }
                
            break;
        }

        if ($query!='')
        {
            $query="SELECT id,first_name,last_name,image,network,profile,identity,auth_time,blocked FROM forum_user WHERE ".$query;
        }
        else
        {    
            echo json_encode(['error'=>['code'=>103,'text'=>'user not login']]);
            return false;
        }

        //echo $query;

        $r = $this->db->query($query);
        if ($r->num_rows)
        {          
            $this->user = $r->fetch_assoc();

            switch ($method)
            {
                case 'sms':
                    if ((isset($_POST['first_name']) && trim($_POST['first_name']!='')) ||(isset($_POST['last_name']) && trim($_POST['last_name']!='')))
                    {
                        $this->user['first_name']=$this->db->real_escape_string(mb_convert_encoding(trim($_POST['first_name']),'CP-1251','UTF-8'));
                        $this->user['last_name']=$this->db->real_escape_string(mb_convert_encoding(trim($_POST['last_name']),'CP-1251','UTF-8'));
                        $this->saveUser();
                    }
                break;
            }

            if ($this->user['blocked'] > time())
            {
                $this->logout(false);
                echo json_encode(['error'=>['code'=>102,'text'=>'user blocked','time'=>$this->user['blocked']]]);
                return false;   
            }

            if ($method!=='cookie') {
                setcookie("auth_token",sha1($this->user['identity'].$this->user['network'].$this->user['auth_time'].$this->salt),time()+2592000);
            }

            //не надо это видеть...
            unset($this->user['identity']);
            unset($this->user['auth_time']);
            unset($this->user['blocked']);

            echo json_encode($this->arr2UTF8($this->user));
            return true;
        }
        
        echo json_encode(['error'=>['code'=>101,'text'=>'user not login']]);
        return false;
    }

    protected function arr2UTF8($arr)
    {
        $ret = [];
        foreach ($arr as $k=>$v)
        {
            $ret[$k]=mb_convert_encoding($v,'UTF-8','CP-1251');
        }
        return $ret;
    }

    protected function saveUser()
    {
        $query="";
        foreach ($this->fields as $v)
        {
            if (isset($this->user[$v]))
            {
                $query.=$v."='".$this->user[$v]."',";
            }
        }

        if (isset($this->user['id']) && is_numeric($this->user['id']) && $this->user['id']!=0)
        {
            $query="UPDATE forum_user SET ".substr($query,0,-1)." WHERE id='".$this->user['id']."'";
        }
        else
        {
            $query="INSERT INTO forum_user SET ".substr($query,0,-1);
        }

        $this->db->query($query);

        //echo $query."\n\n\n";

        if ( !(isset($this->user['id']) && is_numeric($this->user['id']) && $this->user['id']!=0) )
        {
            $this->user['id']=$this->db->insert_id;
        }
    }

    protected function saveUloginPhoto() 
    {
        
        $path = realpath(__DIR__ . "/pictures/forum/").'/';
        if (isset($this->user['photo']) && $this->user['photo']!='')
        {
            //получим картинку, сохраним в темп
            $tmp = $path.time()."___".$this->user['id'];
            
            file_put_contents($tmp,file_get_contents($this->user['photo']));
            $type = exif_imagetype($tmp);
            
            switch ($type)
            {
                case IMAGETYPE_GIF:
                    $name = $this->user['id'].'_'.time().'.gif';
                break;
                case IMAGETYPE_JPEG:
                    $name = $this->user['id'].'_'.time().'.jpg';
                break;
                case IMAGETYPE_PNG:
                    $name = $this->user['id'].'_'.time().'.png';
                break;
                case IMAGETYPE_BMP:
                    $name = $this->user['id'].'_'.time().'.bmp';
                break;
                default:
                    $name='nopic.png';
                break;
            }
    
            if ($name != 'nopic.png') {
                rename ($tmp,$path.$name);
            }
            return '/pictures/forum/'.$name;
    
        }
        return '/pictures/forum/'.'nopic.png';
    }

    //отправка sms
    protected function send_sms_code($phone,$code)
    {
        require_once("adminpln/inc/smsc_api.php");
        $message = 'Код подтверждения на сайте pln-pskov.ru: '.$code;
        $res=send_sms($phone,$message);
        if ($res[1]>0)
        {
            return true;
        }
        return false;
    }

    protected function image_crop($image,$target)
    {
        $h=$w=100;
    
        list( $sw,$sh ) = getimagesize( $image );

        $image_str = file_get_contents($image);
        $src = imagecreatefromstring($image_str);

        $hw=$sw;
        if ($sw>$sh)
        {
            $hw=$sw;
        }

        //если картинка меньше, то просто в png, иначе уменьшать
        if ($sw<=$w || $sh<=$h)
        {
            $w=$sw;
            $h=$sh;
        }

        $thumb = imagecreatetruecolor($w,$h);
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
        imagefill($thumb, 0, 0, imagecolorallocatealpha($thumb,255,255,255,127));
        if (imagecopyresized($thumb,$src,0,0,0,0,$w,$h,$hw,$hw))
        {
            if (imagepng($thumb,$target) && file_exists($target))
            {
                return true;
            }
        }
        return false;
    
    }
}




/*
$db = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
    
$db->query("set session character_set_server=cp1251;");
$db->query("set session character_set_database=cp1251;");
$db->query("set session character_set_connection=cp1251;");
$db->query("set session character_set_results=cp1251;");
$db->query("set session character_set_client=cp1251;");

if (isset($_GET['act']))
{
    switch ($_GET['act'])
    {
        case 'login':
            if (!isset($_GET['token'])) { echo json_encode(['error'=>'token not presented']); die();}

            switch ($_GET['mode'])
            {
                case 'ulogin':
                    $s = file_get_contents('http://ulogin.ru/token.php?token='.$_GET['token'].'&host='.$_SERVER['HTTP_HOST']);
                    $user = json_decode($s, true);
                    if (!isset($user['error']))
                    {
                        echo getUserInfo($user,$db);
                    }
                    else
                    {
                        echo $s;
                    }
                    die();
                break;

                case 'auth':
                    echo getUserInfo($_COOKIE['auth_token'],$db);die();
                break;

                case 'smsc':
                    //получим пользователя
                    $r = $db->query("SELECT id,first_name,last_name,identity,profile,image,network FROM forum_user WHERE SHA1(CONCAT(provider,id,uid))='".$db->real_escape_string($_GET['token'])."' AND uid='".$db->real_escape_string($_GET['code'])."'");
                    //echo "SELECT * FROM forum_user WHERE SHA1(CONCAT(provider,id,'".$db->real_escape_string($_GET['code'])."'))='".$db->real_escape_string($_GET['token'])."' AND uid='".$db->real_escape_string($_GET['code'])."'";      

                    if ($r->num_rows)
                    {
                        $res = $r->fetch_assoc();
                        $update="UPDATE forum_user SET uid='',";
                        if (isset($_GET['first_name']) && trim($_GET['first_name']!=''))
                        {
                            $update.="first_name='".$db->real_escape_string(trim($_GET['first_name']))."',";
                        }
                        if (isset($_GET['last_name']) && trim($_GET['last_name']!=''))
                        {
                            $update.="last_name='".$db->real_escape_string(trim($_GET['last_name']))."',";
                        }

                        if ($update!='')
                        {
                            $update=substr($update,0,-1)." WHERE id='".$res['id']."'";
                            $db->query($update);
                            $r = $db->query("SELECT id,first_name,last_name,identity,profile,image,network FROM forum_user WHERE id='".$res['id']."'");                            
                            $res=$r->fetch_assoc();
                        }

                                                //оставим пока на всякий случай...
                        if (trim($res['first_name'])=='' || trim($res['last_name'])=='')
                        {
                            setcookie("profile_token",sha1($res['id'].$res['identity'].'profile_xer'),time()+86400);
                        }
                        else
                        {
                            setcookie("auth_token",sha1($res['identity'].$res['network']),time()+2592000);
                        }
                        
                        $res['token']=sha1($res['identity'].$res['network']);
                        echo json_encode(arr2UTF8($res));
                        die();
                    }
                    echo json_encode(['error'=>'code not correct']);
                    die();
                break;

                case 'profile':
                    if (isset($_COOKIE['profile_token']) && $_COOKIE['profile_token']!='')
                    {
                        $r=$db->query("SELECT * FROM forum_user WHERE SHA1(CONCAT(id,identity,'profile_xer'))='".$db->real_escape_string($_COOKIE['profile_token'])."'");
                        if ($r->num_rows)
                        {
                            $res = $r->fetch_assoc();
                            $db->query("UPDATE forum_user SET first_name='".$db->real_escape_string($_GET['first_name'])."', last_name='".$db->real_escape_string($_GET['last_name'])."' WHERE id='".$res['id']."'");
                            setcookie('profile_token');
                            $r=$db->query("SELECT * FROM forum_user WHERE id='".$res['id']."'");
                            if ($r->num_rows)
                            {
                                $ret=$r->fetch_assoc();
                                setcookie("auth_token",sha1($ret['identity'].$ret['network'].$res['uid']),time()+2592000);
                                echo json_encode(arr2UTF8($ret));
                                die();
                            }
                        }
                    }
                    echo json_encode(['error'=>'error saving profile']);
                    die();                
                break;
                
                default:
                    echo json_encode(['error'=>'unexpected mode']);
                    die();
                break;
            }
        break;
        case 'logout':
            setcookie('auth_token');
            echo json_encode(['t'=>$_COOKIE['auth_token']]);
            die();
        break;

        case 'update_profile':
            if (isset($_COOKIE['auth_token']) && $_COOKIE['auth_token']!='')
            {

                if (!(isset($_POST['first_name'])&&trim($_POST['first_name']!='')&&isset($_POST['last_name'])&&trim($_POST['last_name']!='')))
                {
                    echo json_encode(['error'=>['code'=>2,'text'=>'error request']]);
                    die();
                }

                $r = $db->query("SELECT id FROM forum_user WHERE SHA1(CONCAT(`identity`,`network`))='".$db->real_escape_string($_COOKIE['auth_token'])."'");
                if ($r->num_rows)
                {
                    $res = $r->fetch_assoc();
                    $db->query("UPDATE forum_user SET first_name='".$db->real_escape_string(mb_convert_encoding($_POST['first_name'],'CP-1251','UTF-8'))."',last_name='".$db->real_escape_string(mb_convert_encoding($_POST['last_name'],'CP-1251','UTF-8'))."' WHERE id='".$res['id']."'");
                    $r=$db->query("SELECT id,first_name,last_name,identity,profile,image,network FROM forum_user WHERE id='".$res['id']."'");
                    $res=$r->fetch_assoc();
                    echo json_encode(arr2UTF8($res));
                    die();
                }
            }
            echo json_encode(['error'=>['code'=>'1','text'=>'user not login']]);
            die();
        break;

        case 'upload_image':
            $path = realpath(__DIR__ . "/pictures/forum/").'/';
            //загрузка картинки...
            //1. проверить что пользователь залогинен
            if (isset($_COOKIE['auth_token']) && $_COOKIE['auth_token']!='')
            {
                $user=[];
                $r = $db->query("SELECT * FROM forum_user WHERE SHA1(CONCAT(`identity`,`network`))='".$db->real_escape_string($_COOKIE['auth_token'])."'");
                if ($r->num_rows)
                {
                    $user = $r->fetch_assoc();
                }
                else
                {
                    echo json_encode(['error'=>['code'=>'1','text'=>'user not login']]);
                    die();
                }
                
                if (isset($_FILES['photo']))
                {
                    $ext_list=['gif','jpg','jpeg','png'];
                    $fn = $_FILES['photo']['name'];
                    $ext = strtolower(pathinfo($fn, PATHINFO_EXTENSION));
                    if( in_array($ext,$ext_list) )
                    {
                        $image=$user['id'].'_'.time().'.'.$ext;

                        if (!move_uploaded_file($_FILES['photo']['tmp_name'],$path.$image))
                        {
                            echo json_encode(['error'=>['code'=>'4','text'=>'error loading image on server']]);
                            die();  
                        }

                        if (file_exists($path.$image)) {
                            $db->query("UPDATE forum_user SET image='/pictures/forum/".$image."' WHERE id='".$user['id']."'");
                            echo json_encode(['image'=>'/pictures/forum/'.$image]);
                            die();
                        }
                        else
                        {
                            echo json_encode(['error'=>['code'=>'4','text'=>'error loading image on server']]);
                            die();  
                        }
                    }
                    else
                    {
                        echo json_encode(['error'=>['code'=>'3','text'=>'wrong image format']]);
                        die();
                    }
                }
                else
                {
                    echo json_encode(['error'=>['code'=>'2','text'=>'no image uploaded']]);
                    die();
                }
            }
            echo json_encode(['error'=>['code'=>'1','text'=>'user not login']]);
            die();
        break;
        
        case 'send_request':
        {
            //todo: нужно добавить проверку номера
            if (!preg_match("/\d{11,13}$/",$_GET['phone']))
            {
                echo json_encode(['error'=>['code'=>1,'text'=>'error format number']]);
                die();
            }

            if (!(isset($_GET['time'])&&is_numeric($_GET['time'])&&($_GET['time']>0)))
            {
                echo json_encode(['error'=>['code'=>3,'text'=>'error request']]);
                die();
            }

            $code="";
            for ($i = 0; $i<5; $i++) 
            {
                $code.= mt_rand(0,9);
            }

            //проверим что такой номер есть в базе
            $r = $db->query("SELECT * FROM forum_user WHERE provider='smsc' AND identity='".$db->real_escape_string($_GET['phone'])."'");
            $id=0;
            $last_name="";
            $first_name="";

            $current_time=time();

            if ($r->num_rows)
            {
                $res = $r->fetch_assoc();

                if ($res['auth_time']!=0&&$res['auth_time']+150>$current_time)
                {
                    echo json_encode(['error'=>['code'=>4,'text'=>'time for re-request has not come']]);
                    die();
                }

                $id=$res['id'];
                $last_name=$res['last_name'];
                $first_name=$res['first_name'];
            }

            if (send_sms_code($_GET['phone'],$code))
            {
                if ($id!=0)
                {
                    $db->query("UPDATE forum_user SET uid='".$code."',auth_time='".$current_time."' WHERE id='".$res['id']."'");
                }
                else
                {
                    $db->query("INSERT INTO forum_user (provider,network,uid,identity,auth_time) VALUES ('smsc','smsc.ru','".$code."','".$db->real_escape_string($_GET['phone'])."','".$current_time."')");
                    $id = $db->insert_id;
                }
                
                echo json_encode(arr2UTF8(['code_token'=>sha1('smsc'.$id.$code),'id'=>$id,'first_name'=>$first_name,'last_name'=>$last_name]));
                die();
            }
            echo json_encode(['error'=>['code'=>2,'text'=>'error send sms']]);
            die();
        }
    }
}

function send_sms_code($phone,$code)
{
    require_once("adminpln/inc/smsc_api.php");
    $message = 'Код подтверждения на сайте pln-pskov.ru: '.$code;
    $res=send_sms($phone,$message);
    if ($res[1]>0)
    {
        return true;
    }
    return false;
}

function getUserInfo ($user,&$db) {

    if (is_array($user))
    {
        //ulogin
        $mode='ulogin';
        $query = "SELECT * FROM forum_user WHERE SHA1(CONCAT(identity,network))='".sha1($user['identity'].$user['network'])."'";
        
        $escape_user = [];
        foreach ($user as $k=>$v)
        {
            $escape_user[$k]=$db->real_escape_string(mb_convert_encoding ($v,'CP-1251','UTF-8'));
        }
    
    }
    else
    {
        //auth
        $mode='auth';
        $query = "SELECT * FROM forum_user WHERE SHA1(CONCAT(`identity`,`network`))='".$db->real_escape_string($user)."'";
    }

    //получим пользователя из базы (если он там есть)
    $res = $db->query($query);

    if ($res->num_rows)
    {
        $ret = $res->fetch_assoc();

        if ($mode=='ulogin')
        {
            
            $photo = savePhoto(['photo'=>$user['photo'],'id'=>$ret['id']]);
            $db->query("UPDATE forum_user SET first_name = '".$escape_user['first_name']."',last_name = '".$escape_user['last_name']."',image = '".$photo."',profile='".$escape_user['profile']."' WHERE id = '".$ret['id']."'");

            $res = $db->query("SELECT * FROM forum_user WHERE id = '".$ret['id']."'");
            $ret = $res->fetch_assoc();
        }
        
        setcookie("auth_token",sha1($ret['identity'].$ret['network']),time()+2592000);

        return json_encode(arr2UTF8($ret));
    }
    else
    {
        if ($mode=='ulogin')
        {
            //добавляем пользователя в базу
            $r=$db->query("INSERT INTO forum_user (provider,network,profile,uid,first_name,last_name,identity,image) VALUES ('ulogin','".$escape_user['network']."','".$escape_user['profile']."','".$escape_user['uid']."','".$escape_user['first_name']."','".$escape_user['last_name']."','".$escape_user['identity']."','".$escape_user['photo']."')");
            $id=$db->insert_id;
            $user['id']=$id;

            //загрузим картинку...
            $photo = savePhoto($user);
            $db->query("UPDATE forum_user SET image = '".$photo."' WHERE id='".$id."'");

            $res = $db->query("SELECT * FROM forum_user WHERE id='".$id."'");
            if ($res->num_rows)
            {
                $ret = $res->fetch_assoc();
                setcookie("auth_token",sha1($ret['identity'].$ret['network']),time()+2592000);
                return json_encode(arr2UTF8($ret));
            }
        }
    }
    setcookie('auth_token','',time()-3600);
    return json_encode(['error'=>'user not found']);
    //setcookie("auth_token",sha1($user['identity'].$user['network']),time()+2592000);
}

function arr2UTF8($arr)
{
    $ret = [];
    foreach ($arr as $k=>$v)
    {
        $ret[$k]=mb_convert_encoding($v,'UTF-8','CP-1251');
    }
    return $ret;
}

function savePhoto($user) 
{
    
    $path = realpath(__DIR__ . "/pictures/forum/").'/';
    if (isset($user['photo']) && $user['photo']!='')
    {
        //получим картинку, сохраним в темп
        $tmp = $path.time()."___".$user['id'];
        
        file_put_contents($tmp,file_get_contents($user['photo']));
        $type = exif_imagetype($tmp);
        
        switch ($type)
        {
            case IMAGETYPE_GIF:
                $name = $user['id'].'_'.time().'.gif';
            break;
            case IMAGETYPE_JPEG:
                $name = $user['id'].'_'.time().'.jpg';
            break;
            case IMAGETYPE_PNG:
                $name = $user['id'].'_'.time().'.png';
            break;
            case IMAGETYPE_BMP:
                $name = $user['id'].'_'.time().'.bmp';
            break;
            default:
                $name='nopic.png';
            break;
        }

        if ($name != 'nopic.png') {
            rename ($tmp,$path.$name);
        }
        return '/pictures/forum/'.$name;

    }
    return '/pictures/forum/'.'nopic.png';
}
*/