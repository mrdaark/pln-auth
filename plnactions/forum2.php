<?php

if (is_numeric($_POST["topic"]))
{
    $topic=$_POST["topic"];
}

$text=$_POST["text"];
$name=$_POST["name"];

//���� � ��� ��������� ������ - �������� ��
$name=preg_replace('/[0-9a-z.-]+\.[a-z]{2,4}/i', '', $name);

// ��������� �� �������� �� ����� � ���� �������
$SQL="SELECT noforum, appr as newsapproved FROM news WHERE id='".$topic."'";
$no=mysql_fetch_array(runSQL($SQL));

function prepare_forumpost_condition ($s_text)
{
    //������ ���� html
    $s_text = @ strip_tags ($s_text);
    //��������� �� 70 ��������
    $s_text = substr ($s_text, 0, 70);
    //������� ���
    $s_text = str_replace ("'", '"', $s_text);

    $s_text = str_replace ("javascript", "", $s_text);

    //���������
    //$s_text = addslashes ($s_text);
    //�������� ��������� shell ������� escapeshellcmd()
    //$s_text = escapeshellcmd($s_text);

    return $s_text;
}
$name=prepare_forumpost_condition($name);

if ($dirs[1]=="post")
{
    $is_login = false;
    if ( isset($_POST['user']) && is_numeric($_POST['user']) ) {
        //
        $ri=runSQL("SELECT * FROM forum_user WHERE id = '".$_POST['user']."'");
        if ($ri->num_rows)
        {
            $user = mysql_fetch_array($ri);
            if ($_COOKIE['auth_token']==sha1($user['identity'].$user['network'].$user['auth_time'].'bDWzMZQW2Vvvv4KA6sZF') && $user['blocked']<time())
            {
                $is_login=true;
            }
        }
    }

    global $REMOTE_ADDR,$topic,$name,$email,$subject,$text;
    $ip_orig=getIp();


    //�������� �� ���������� IP
    $ri=runSQL("SELECT * FROM banedips");
    while($bi=mysql_fetch_array($ri)) //��� ����� ���? SELECT * FROM banedips WHERE ip='".$REMOTE_ADDR."'...
    {
        if ($REMOTE_ADDR==$bi["ip"]) {
            $ipisbaned = '1';
        }
    }


    // $SQL="INSERT INTO forum(topic,time,name,email,subject,text,ip,ip_orig) VALUES ('$topic',NOW(),'".addslashes($name)."','$email','".addslashes(check_msg($subject))."','".addslashes(check_msg($text))."',INET_ATON('$REMOTE_ADDR'),INET_ATON('".$ip_orig."'))";
    if ($ipisbaned!='1' && $is_login)
    {
        if ($topic=="")
        {
            header("Location: /");
            die();
        }
        else
        {

            //sozdaem peremennuu po 2m parametram - sovpadenie s 1 iz poslednih 100 posts ili perebor postov s IP za edinitsu vremeni
            //plus nada blokirovat po IP ukazyvaemym is adminki na sutki

            // !!!!!!!!!!!!!!
            // !!!!!!!!!!!!!! ��������!!!  ������� � ����� ������� ����� �� ������������������. �.�. ����-�� ����
            // !!!!!!!!!!!!!!
            if (($REMOTE_ADDR=='190.14.5.18')||($REMOTE_ADDR=='141.105.65.131'))
            {
                $dontpostthis="1";
            }
            // !!!!!!!!!!!!!!
            // !!!!!!!!!!!!!! ��������!!!  ������� � ����� ������� ����� �� ������������������. �.�. ����-�� ����
            // !!!!!!!!!!!!!!

            if (( eregi("([�-�])",$text) ) && ($topic!="35385") && (!$no[noforum]) && ($no[newsapproved]=="1") && ($dontpostthis!="1") )
            {

                $r=runSQL("SELECT * FROM badwords");
                while($b=mysql_fetch_array($r))
                {
                    $bad[0+$i]=$b['pattern'];  ///��� ������ ������, ������ 0+$i ��� ���������� ���� ������ ����, ����� �������� ����������...
                    $i++;
                }

                //setlocale (LC_ALL,CP1251);

                //echo count($bad), "\r\n";
                //������ ���� html
                $text = @ strip_tags ($text);
                $name = @ strip_tags ($name);

                //������ ���� �������� ������ � ������������� �������
                setlocale(LC_ALL, "ru_RU.CP1251"); //�� �����... mb_strtolower
                $textlower=strtolower("$text");

                //echo $textlower, "\r\n";
                $spamcount=0;
                $text_was_checked=1;
                foreach  ($bad as $key=>$value)
                {
                    if (eregi("$value", $textlower, $regs))
                    {
                        $spamcount++;
                        $spcword=$value;
                        $spcwordslist.=$value;
                        $dingo.="-$value";
                    }
                }

                //������ location ������� ������������ ������ �� ������� ���� $

                //if (($spamcount==1)&&($spcword="$"))
                //{
                //$spamcount--;
                //}

                //������� ���������� ������
                $textarr=preg_split("/[\s]+/s", $textlower);

                foreach ($textarr as $key=>$val)
                {
                    //preg_match("/http|https|www/i",$val)
                    if (eregi("http",$val))
                    {
                        $hrefs++; //� ��� ���������� ����������?
                        $bingo.="-$val";
                    }
                    elseif(eregi("https",$val))
                    {
                        $hrefs++;
                        $bingo.="-$val";
                    }
                    elseif(eregi("www",$val))
                    {
                        $hrefs++;
                        $bingo.="-$val";
                    }
                }

                $spamcount=($hrefs*2)+$spamcount;

                ///
                /// ������������ starts
                ///

                if ($spamcount<3)
                {
                    if (eregi("��������� ����� �������� ��������� ������������ ��������� � ���������� �� ��������� ������������� ������",$text))
                    {
                        $text="";
                        $name="";
                        $spamcount=10;
                    }

                    //����� ������� � �������
                    $deathpoint=time()-600;

                    //������� ���������� ���������� ������ �� ���������� �������
                    $SQL="select count(*) as cnt  from `forum3` where  `text`='".$text."' and '".$deathpoint."' < UNIX_TIMESTAMP(`time`)   order by id desc";
                    $flude=mysql_fetch_array(runSQL($SQL));

                    if($flude["cnt"]>3) { $spamcount=10; }
                    $flude["cnt"]='';

                    $deathpoint=time()-1200;
                    //������� ���������� ���������� IP �� ���������� �������
                    $SQL="select count(*) as cnt  from `forum3` where `ip`=inet_aton('".$REMOTE_ADDR."')  and  '".$deathpoint."' < UNIX_TIMESTAMP(`time`)   order by id desc";

                    $flude=mysql_fetch_array(runSQL($SQL));

                    if($flude["cnt"]>30) { $spamcount=10; }

                    //��� ������� �������� ������� ���� �� ����  �� ���� ������� forum3 � ������� ������ ����������� �� ��� ����� �������� ����� �����
                    $deathpoint=time()-60;

                    //������� ���������� ���������� IP �� ���������� �������
                    $SQL="select count(*) as cnt  from `forum3` where `ip`=inet_aton('".$REMOTE_ADDR."')  and  '".$deathpoint."' < UNIX_TIMESTAMP(`time`)   order by id desc";

                    $flude=mysql_fetch_array(runSQL($SQL));

                    if($flude["cnt"]>5) {$spamcount=10;}


                    /*
                    // START **************************************
                    // ���� ��������� ����� ������ ��������

                    $posts_new_arr = explode(" ", $text);
                    $new_cnt=count($posts_new_arr);


                    // ���� ��������� ������ 18 ����
                    // ��������� ��� �� ���������� �� 75 � ����� ��������� � 500-�� ����������� ����������� � �����
                    if ($new_cnt>15){

                            $SQL="select time, text from forum3 order by id desc limit 300";

                            $r=runSQL($SQL);

                            while($old_posts=mysql_fetch_array($r))
                            {
                                $posts_old_arr = explode(" ", $old_posts["text"]);
                                $old_cnt=count($posts_old_arr);



                                if ($old_cnt/$new_cnt>0.75)
                                {
                                $result = array_intersect($posts_new_arr, $posts_old_arr);
                                }

                                if (count($result)/$new_cnt>0.75)
                                {
                                 print_r($result);
                                 exit();
                                 $spamcount=10;
                                }
                            }
                    }
                    // END ���� ��������� ����� ������ ��������
                    //**************************************
                   */

                }
                /// � ������� ����� ������� �������� ��������� ������ ���� ����� post-������ �� ��������� ���������� � ������� �� 48 ����� ����� ����� �� ���������
                /// � ��������� �� ��� ��������, ��� ���� ������ � �� ���������� ���� �������, � ��-�������  - ���
                /// ������� �����=1328853834 ���-������� � ��������� post md5 ('1328853') + ��� ������������ md5 ('13288532') md5 ('13288531')  md5 ('13288530')
                /// � ����� ���������� ���-�� 45-60 ����� ���� ������� �� �������� ��������, ��������� � �������� ����� - ����������?
                ///
                /// ������������ ends
                ///

                //echo "����������", $spamcount;

                if ($spamcount<3)
                {
                    //� ��� ���� ��� �� ����, �� �������� ��� �� % # � ������ �������
                    include('antimater.php');
                    $text=antimat($text);
                    $name=antimat($name);

                    $SQL="INSERT INTO forum(user_id,topic,time,name,email,subject,text,ip,ip_orig) VALUES (".$user['id'].",'$topic',NOW(),'".addslashes($name)."','$email','".addslashes(check_msg($subject))."','".addslashes(check_msg($text))."',INET_ATON('$REMOTE_ADDR'),INET_ATON('".$ip_orig."'))";
                    runSQL($SQL);

                    //��������� � ������ ������� ��� ���������� ������� � ������ ���� ������ �������
                    $SQL2="INSERT INTO forum2(user_id,topic,time,name,email,subject,text,ip,ip_orig) VALUES (".$user['id'].",'$topic',NOW(),'".addslashes($name)."','$email','".addslashes(check_msg($subject))."','".addslashes(check_msg($text))."',INET_ATON('$REMOTE_ADDR'),INET_ATON('".$ip_orig."'))";
                    runSQL($SQL2);

                    //��������� � ������ ������� ��� ���������� ������� � ������ ���� ������ �������
                    $SQL2="INSERT INTO forum3(user_id,topic,time,name,email,subject,text,ip,ip_orig) VALUES (".$user['id'].",'$topic',NOW(),'".addslashes($name)."','$email','".addslashes(check_msg($subject))."','".addslashes(check_msg($text))."',INET_ATON('$REMOTE_ADDR'),INET_ATON('".$ip_orig."'))";
                    runSQL($SQL2);

                    //��������� ������-����� �������
                    $SQLf="SELECT count(id) as cnt FROM forum WHERE topic='$topic'";
                    $dataf=mysql_fetch_array(runSQL($SQLf));
                    //$data[cnt]="0";
                    $SQL1f="replace into count_forum set fcount='$dataf[cnt]', topic='$topic'";
                    runSQL($SQL1f);
                }
            }
        }
    }
    else
    {
        $spamcount=10;
    }

    header("Location: /forum/$topic.html");
    die();
}
else
{
    $article=forum_article($news_id,0,1,1);
}

//����������� starts
$b.='<div class="inpage__container">';
$b.=baners();
//����������� end

//������ ������� ���������� ��������
//right column starts

require_once("./plnactions/right.php");

//������ ������� ���������� ��������
//right column starts

//����� ������� ���������� �������� � ����������
//left column starts
$b.='<div class="inpage__left">'.$article.'</div></div></div>';

//���������� ���������� ��������
//prefoother starts
require_once("./plnactions/prefoother.php");
?>