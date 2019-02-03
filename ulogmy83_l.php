<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

//костыль чтобы не тянуть common.php
function runSQL($r) { return; }

require_once ("mysql.php");

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
                        if (trim($res['first_name'])=='' || trim($res['last_name'])=='')
                        {
                            setcookie("profile_token",sha1($res['id'].$res['identity'].'profile_xer'),time()+86400);
                        }
                        else
                        {
                            setcookie("auth_token",sha1($res['identity'].$res['network']),time()+2592000);
                        }
                        
                        $res['token']=sha1($res['identity'].$res['network']);
                        unset($res['network']);
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
        case 'checkphone':
        {
            //todo: нужно добавить проверку номера

            $code="";
            for ($i = 0; $i<5; $i++) 
            {
                $code.= mt_rand(0,9);
            }

            if (send_sms($_GET['phone'],$code))
            {
                //сохранить куда-нибудь, но сначала проверим что такого номера еще нет в базе.
                $r = $db->query("SELECT * FROM forum_user WHERE provider='smsc' AND identity='".$db->real_escape_string($_GET['phone'])."'");
                $id=0;
                $last_name="";
                $first_name="";
                if ($r->num_rows)
                {
                    $res = $r->fetch_assoc();
                    $id=$res['id'];
                    $last_name=$res['last_name'];
                    $first_name=$res['first_name'];
                    $db->query("UPDATE forum_user SET uid='".$code."' WHERE id='".$res['id']."'");
                }
                else
                {
                    $db->query("INSERT INTO forum_user (provider,network,uid,identity) VALUES ('smsc','smsc.ru','".$code."','".$db->real_escape_string($_GET['phone'])."')");
                    $id = $db->insert_id;
                }
                
                echo json_encode(arr2UTF8(['code_token'=>sha1('smsc'.$id.$code),'id'=>$id,'code'=>$code,'first_name'=>$first_name,'last_name'=>$last_name]));
                die();
            }
            echo json_encode(['error'=>'send sms error']);
            die();
        }
    }
}

function send_sms($phone,$code)
{
    $message = 'Код подтверждения на сайте pln-pskov.ru: '.$code;
    return true;
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
            $db->query("UPDATE forum_user SET image = '".$photo."'");

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
        $tmp = "tmp/".time();
        
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
