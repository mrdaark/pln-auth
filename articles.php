<?

//Функция вывода новостей

require_once (realpath(__DIR__)."/adminpln/inc/vrezki.php");

function article($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0", $for_forum="0", $print="0", $dirzero="")
{

    $numr=rand(1,2);



    $yadirekt_blk="<!-- Yandex.RTB R-A-271392-1 -->
<div id=\"yandex_rtb_R-A-271392-1\"></div>
<script type=\"text/javascript\">
    (function(w, d, n, s, t) {
        w[n] = w[n] || [];
        w[n].push(function() {
            Ya.Context.AdvManager.render({
                blockId: \"R-A-271392-1\",
                renderTo: \"yandex_rtb_R-A-271392-1\",
                async: true
            });
        });
        t = d.getElementsByTagName(\"script\")[0];
        s = d.createElement(\"script\");
        s.type = \"text/javascript\";
        s.src = \"//an.yandex.ru/system/context.js\";
        s.async = true;
        t.parentNode.insertBefore(s, t);
    })(this, this.document, \"yandexContextAsyncCallbacks\");
</script>\n";

    $t1="

<!--Zone T1 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=14\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=14&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone T1 -->


";

    $t2="


<!--Zone T2 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=15\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=15&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone T2 -->

";


    $t1_t2_vnutr="
<div class=\"banners_line2__bnr\">
<!--Zone t1vnutr -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=59\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=59&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone t1vnutr -->
</div>

<div class=\"banners_line2__bnr\">
<!--Zone t2vnutr -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=60\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=60&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone t2vnutr -->
</div>
<div class=\"columns__column_separator\">&nbsp;</div>



";


    $c1_c2="
<div class=\"banners_line2__bnr\">
<!--Zone c1 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=19\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=19&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone c1 -->
</div>

<div class=\"banners_line2__bnr\">
<!--Zone c2 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=20\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=20&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone c2 -->
</div>
";



    $c3_c4="
<div class=\"banners_line2__bnr\">
<!--Zone c3 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=21\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=21&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone c3 -->
</div>

<div class=\"banners_line2__bnr\">
<!--Zone c4 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=22\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=22&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone c4 -->
</div>
";

    $r0_r3_xx="


<div class=\"banners_line4__bnr\">

<!--Zone R0 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=1\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=1&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone R0 -->

</div>


<div class=\"banners_line4__bnr\">

<!--Zone R1 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=2\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=2&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone R1 -->

</div>


<div class=\"banners_line4__bnr\">

<!--Zone R2 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=3\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=3&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone R2 -->

</div>


<div class=\"banners_line4__bnr\">

<!--Zone R3 -->
<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://nbads.pln24.ru/ads/www/delivery/ajs.php':'http://nbads.pln24.ru/ads/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);
   document.write (\"?zoneid=4\");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write (\"&amp;loc=\" + escape(window.location));
   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));
   if (document.context) document.write (\"&context=\" + escape(document.context));
   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");
   document.write (\"'><\/scr\"+\"ipt>\");
//]]>--></script><noscript><a href='http://nbads.pln24.ru/ads/www/delivery/ck.php?n=a21ad61d&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'>
<img src='http://nbads.pln24.ru/ads/www/delivery/avw.php?zoneid=4&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a21ad61d' border='0' alt='' /></a></noscript>
<!--Zone R3 -->

</div>


";

    $r4_r7xxx="
<div class=\"banners_line4__bnr\">
<!--Zone R4 -->
<ins data-revive-zoneid=\"5\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R4 -->
</div>


<div class=\"banners_line4__bnr\">
<!--Zone R5 -->
<ins data-revive-zoneid=\"6\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R5 -->
</div>


<div class=\"banners_line4__bnr\">
<!--Zone R6 -->
<ins data-revive-zoneid=\"7\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R6 -->
</div>


<div class=\"banners_line4__bnr\">
<!--Zone R7 -->
<ins data-revive-zoneid=\"8\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R7 -->
</div>

";

    $r8_r11="
<div class=\"banners_line4__bnr\">
<!--Zone R8 -->
<ins data-revive-zoneid=\"9\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R8 -->
</div>


<div class=\"banners_line4__bnr\">
<!--Zone R9 -->
<ins data-revive-zoneid=\"10\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R9 -->
</div>


<div class=\"banners_line4__bnr\">
<!--Zone R10 -->
<ins data-revive-zoneid=\"11\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R10 -->
</div>


<div class=\"banners_line4__bnr\">
<!--Zone R11 -->
<ins data-revive-zoneid=\"12\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
<!--Zone R11 -->
</div>

";







    //выборка новости по id
    if ($id)
    {

        // Сюжеты

        if (($subj)&&(!$announce)&&(!$print))
        {

            $SQL="SELECT subject FROM subjects_urls WHERE nid='$id'";
            // OR url LIKE '%/".$id.".html'
            $subj=mysql_fetch_array(runSQL($SQL)); $subj=$subj["subject"];

            $SQL="SELECT name FROM subjects WHERE id='$subj'";
            $sname=mysql_fetch_array(runSQL($SQL)); $sname=$sname["name"];

            $SQL="SELECT * FROM subjects_urls WHERE subject='$subj' order by nid desc";
            $r=runSQL($SQL);
            if (mysql_num_rows($r))
            {

                $ss.='  <div class="pr__news_list3">
                        <a href="/subject/'.$subj.'.html" class="pr__news_list3__header">
                            Сюжет: '.$sname.'
                        </a>';




                while ($d=mysql_fetch_array($r))
                {

                    if ($d["url"]!="")
                    {
                        $ss.='<a href="'.$d["url"].'"  class="pr__news_list3__link_small">
              <span class="pr__news_list3__link__title_small">'.$d["alt"].'
              </a>';

                    }
                    else
                    {
                        $SQL1="SELECT news.header,topics.dir FROM news,topics WHERE news.topic=topics.id AND news.appr='1' AND news.id='".$d["nid"]."'";
                        $dd=mysql_fetch_array(runSQL($SQL1));

                        $ss.='<a "/'.$dd["dir"].'/'.$d["nid"].'.html  class="pr__news_list3__link_small">
              <span class="pr__news_list3__link__title_small">'.$dd["header"].'
              </a>';

                    }


                }
                $ss.='</div>';
            }


        }




        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date, noforum FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;
            $noforum=$d["noforum"];
            $src_id=$d["src_id"];
            $place_id=$d["place_id"];
            $material_date=$d["date"];
            $header=$d["header"];
            $text=renderInsertion($d["text"]);

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);
            $root_topic_id=root_topic_id($d["topic"]);

            $forum_count=count_forum($id);


            //убрал в спецдиректорию за пароль просмотр неактивированных новостей
            $news_is_approved=$d["appr"];
            if ($news_is_approved!="1")
            {
                //стираем все данные в массиве
                $d="";
                //переадресовываем на главную
                Header("Location: /");
                die;
            }


            if($place_id!="")
            {$SQL="SELECT name  from places where Id='$place_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $place_name=$dss["name"];
            }
            else {
                $place_name="Псков";
            }





            if(($forum)&&(!$noforum))
            {

                $forum_line0=' <span class="icons">Комментарии: <a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }

            //Теги и источник
            if($src_id!="")
            {$SQL="SELECT url , name  from links where Id='$src_id'";
                $dss=mysql_fetch_array(runSQL($SQL));



                $SQL3="select news_tags.tags_id as id, tags.tag as tag from news_tags, tags  where  news_tags.tags_id=tags.id and news_id='".$id."'";
                $r3=runSQL($SQL3);

                while ($d3=mysql_fetch_array($r3))
                {


                    $tags.='<span class="pl__tags__name"> <A class="pl__source__name" href="/tags/?tag='.$d3["id"].'"> #'.$d3["tag"].'</a></span>';
                }


                if ($tags!="")
                {$source_line='<div class="pl__tags">Теги: '.$tags.' </div>';}

                $source_line.='<div class="pl__source">Источник: <span class="pl__source__name"> <A class="pl__source__name" href="http://'.$dss["url"].'">'.$dss["name"].'</a></span></div>';

            }
            //Теги и источник


            if(($forum_count>0)&&($announce))
            {
                $forum_line='<a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }




//
//Серия кнопок "поделиться" от Яндекса
//



            $yandex_share_line=' <div class="pl__social_share">
                        <div class="pl__social_share__title">Поделитесь новостью с друзьями</div>
                        <div class="pl__social_share__buttons">

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js" charset="utf-8"></script>
<div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,telegram" data-counter=""></div>

  </div>
  <div class="pl__social_share__code"><a class="pl__social_share__code" href="/blogers/'.$id.'.html" class="blog" title="Код для блога">Код для блога</a></div>
</div>
 ';


            $print_and_forum_line.='

<div class="material_line"><b>'.$forum_line0.'&nbsp;|&nbsp;<a href="/blogers/'.$id.'.html" class="blog" title="Вставить в блог">Вставить в блог</a>&nbsp;|&nbsp;<a href="/print/'.$id.'.html" class="print" title="Версия для печати">Версия для печати</a> </span></b> </div>';



            //Добавление в Шапку для интерактива что ответственности за содержание мы не несем
//if ($dir=="letters"){ $cc.='<br/><div style="color:red;border:1px dashed red;padding:10px;margin-bottom:15px;"><small>За информацию данного раздела ИА «Псковская Лента Новостей» ответственности не несет.  Достоверность публикации администрация сайта не гарантирует. Информация в данном разделе публикуется посетителями сайта. </small></div><br/><br/>';}


            //Здесь формируем содержимое публикации:

            $cc.='
                    <div class="pl__section_name">'.$topic_name.'</div>';

            if ($dir=='letters')
            {
                $cc.='<hr/>	<div class="pl__comments">
                        <div class="pl__comments__header">Написать на ПЛН</div>
                        <div class="pl__comments__form">
                            <form action="/inter/" method="post" enctype="multipart/form-data">

                                <input type="text"  name="name" class="pl__comments__form__name" placeholder="Ваше имя">
                                <textarea placeholder="Текст материала" class="pl__comments__form__comment" name="textl" id="textl"></textarea>
                                Прикрепить фото/видео (до 15МБ): <Input type="file" name="userfile"><br>
                                <br><div class="g-recaptcha" data-sitekey="6LdXnEAUAAAAAFAUe0XbyYKqxOaRtdmn8h-9eGQn"></div>
                                <input type="submit" value="отправить редактору" class="pl__comments__form__submit">
                            </form>
                            <br><small>* обязательно заполните все поля</small>
     					  <br><small>** файлы больших размеров отправляйте на redaktor@pln-pskov.ru </small>
     					  <br>
     					  <br>
                        </div>
				<div style="color:red;border:1px dashed red;padding:10px;margin-bottom:15px;"><small>За информацию данного раздела ИА «Псковская Лента Новостей» ответственности не несет.  Достоверность публикации администрация сайта не гарантирует. Информация в данном разделе публикуется посетителями сайта. </small></div>

                        ';
            }



            $cc.='<div class="pl__header"><h1>'.$header.'</h1></div>';
            if(($forum)&&(!$noforum))
            {
                $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span><a href="/forum/'.$id.'.html" class="pl__header__comments__link"><span class="sdb__comments" data-href="/forum/'.$id.'.html">Комментариев: '.$forum_count.'</span></a></div>';
            }
            else
            {
                $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span></div>';
            }

            $cntr_n="<div style=\"display:none\" style=\"width:0;height:0;font-size:0\">
    <script type=\"text/javascript\">
        document.write('<img src=\"/cntr.php?id=".$id."\" />');
    </script>
    <noscript>
        <img src=\"/counter.php?id=".$id."\" />
    </noscript>
</div>";


            $cc.=$yandex_share_line;
            $cc.='<div class="pl__text">';


            $cc.=$text.$cntr_n.'
                           </div>';

            $cc.=vrezkaPerson($id);

            $cc.=$source_line;

            if(($forum)&&(!$noforum))
            {
                $cc.='<div class="pl__buttons">
                        <a href="/forum/'.$id.'.html" class="pl__buttons__comments">Комментариев: '.$forum_count.'</a><a href="/print/'.$id.'.html" class="pl__buttons__print">Версия для печати</a>
                    </div>';
            }
            else
            {
                $cc.='<div class="pl__buttons">
                        <a href="/print/'.$id.'.html" class="pl__buttons__print">Версия для печати</a>
                        </div>';
            }

            if (($dirzero=='house')||($dirzero=='npsk'))
            {
                $cc.= '<div class="banners_line4">

        					</div>';

                $cc.=draw_vote();
                $cc.= '<div class="banners_line4">

        					</div>';

                $cc.=$ss;




                $cc.= '<div class="banners_line4">

        					</div>';

                $cc.= '<div class="banners_line4">

        					</div>';

            }
            elseif ($dirzero=='tourism')
            {
                $cc.= '<div class="banners_line4">

        					</div>';

                $cc.=draw_vote();
                $cc.= '<div class="banners_line4">

        					</div>';

                $cc.=$ss;


                //$cc.=vrezkaPerson($id);

                $cc.= '<div class="banners_line4">

        					</div>';

                $cc.= '<div class="banners_line4">

        					</div>';

            }
            else
            {
                /*$cc.= '<div class="banners_line4">
                           '.${"t".$numr}.'
                       </br>

                       </div>';
               */
                $cc.= '<div class="banners_line4">
           					 '.$t1_t2_vnutr.'
        					</br>

        					</div>
        					<div class="columns__column_separator">&nbsp;</div>


        					';


                $cc.=draw_vote();
                $cc.= '<div class="banners_line4">
           					 '.$yadirekt_blk.'
        					</div>';

                $cc.=$ss;


                // $cc.=vrezkaPerson($id);

                $cc.= '<div class="banners_line4">
           					 '.$r4_r7.'
        					</div>';

                /* $cc.= '<div class="banners_line4">
                            '.$r8_r11.'
                        </div>';*/
            }





            return $cc;
        }
    }
}

function article_print($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0", $for_forum="0", $print="0")
{


    //выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date, noforum FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;
            $noforum=$d["noforum"];
            $src_id=$d["src_id"];
            $place_id=$d["place_id"];
            $material_date=$d["date"];
            $header=$d["header"];
            $text=renderInsertion($d["text"]);

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);

            $forum_count=count_forum($id);


            //убрал в спецдиректорию за пароль просмотр неактивированных новостей
            $news_is_approved=$d["appr"];
            if ($news_is_approved!="1")
            {
                //стираем все данные в массиве
                $d="";
                //переадресовываем на главную
                Header("Location: /");
                die;
            }


            if($place_id!="")
            {$SQL="SELECT name  from places where Id='$place_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $place_name=$dss["name"];
            }
            else {
                $place_name="Псков";
            }





            if(($forum)&&(!$noforum))
            {

                $forum_line0=' <span class="icons">Комментарии: <a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }


            if($src_id!="")
            {$SQL="SELECT url , name  from links where Id='$src_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $source_line='<div class="pl__source">Источник: <span class="pl__source__name"> <A class="pl__source__name" href="http://'.$dss["url"].'">'.$dss["name"].'</a></span></div>';
            }


            if(($forum_count>0)&&($announce))
            {
                $forum_line='<a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }







            //Добавление в Шапку для интерактива что ответственности за содержание мы не несем
//if ($dir=="letters"){ $cc.='<br/><div style="color:red;border:1px dashed red;padding:10px;margin-bottom:15px;"><small>За информацию данного раздела ИА «Псковская Лента Новостей» ответственности не несет.  Достоверность публикации администрация сайта не гарантирует. Информация в данном разделе публикуется посетителями сайта. </small></div><br/><br/>';}


            //Здесь формируем содержимое публикации:

            $cc.='
                    <div class="pl__section_name">'.$topic_name.'</div>
                    <div class="pl__header"><h1>'.$header.'</h1></div>';

            $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span></div>';


            $cc.='<div class="pl__text">
                        '.$text.'
                           </div>';






            return $cc;
        }
    }
}






function blog_article($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0", $for_forum="0", $print="0")
{


    //выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date, noforum FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;
            $noforum=$d["noforum"];
            $src_id=$d["src_id"];
            $place_id=$d["place_id"];
            $material_date=$d["date"];
            $header=$d["header"];
            $text=renderInsertion($d["text"]);

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);

            $forum_count=count_forum($id);


            //убрал в спецдиректорию за пароль просмотр неактивированных новостей
            $news_is_approved=$d["appr"];
            if ($news_is_approved!="1")
            {
                //стираем все данные в массиве
                $d="";
                //переадресовываем на главную
                Header("Location: /");
                die;
            }


            if($place_id!="")
            {$SQL="SELECT name  from places where Id='$place_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $place_name=$dss["name"];
            }
            else {
                $place_name="Псков";
            }





            if(($forum)&&(!$noforum))
            {

                $forum_line0=' <span class="icons">Комментарии: <a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }


            if($src_id!="")
            {$SQL="SELECT url , name  from links where Id='$src_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $source_line='<div class="pl__source">Источник: <span class="pl__source__name"> <A class="pl__source__name" href="http://'.$dss["url"].'">'.$dss["name"].'</a></span></div>';
            }


            if(($forum_count>0)&&($announce))
            {
                $forum_line='<a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }




//
//Серия кнопок "поделиться" от Яндекса
//



            $yandex_share_line=' <div class="pl__social_share">
                        <div class="pl__social_share__title">Поделитесь новостью с друзьями</div>
                        <div class="pl__social_share__buttons">
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js" charset="utf-8"></script>
<div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,telegram" data-counter=""></div>
  </div>
  <div class="pl__social_share__code"><a class="pl__social_share__code" href="/blogers/'.$id.'.html" class="blog" title="Код для блога">Код для блога</a></div>
</div>
 ';


            $print_and_forum_line.='

<div class="material_line"><b>'.$forum_line0.'&nbsp;|&nbsp;<a href="/blogers/'.$id.'.html" class="blog" title="Вставить в блог">Вставить в блог</a>&nbsp;|&nbsp;<a href="/print/'.$id.'.html" class="print" title="Версия для печати">Версия для печати</a> </span></b> </div>';



            //Добавление в Шапку для интерактива что ответственности за содержание мы не несем
//if ($dir=="letters"){ $cc.='<br/><div style="color:red;border:1px dashed red;padding:10px;margin-bottom:15px;"><small>За информацию данного раздела ИА «Псковская Лента Новостей» ответственности не несет.  Достоверность публикации администрация сайта не гарантирует. Информация в данном разделе публикуется посетителями сайта. </small></div><br/><br/>';}


            //Здесь формируем содержимое публикации:

            $cc.='
                    <div class="pl__section_name">'.$topic_name.'</div>
                    <div class="pl__header"><h1>'.$header.'</h1></div>';
            if(($forum)&&(!$noforum))
            {
                $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span><a href="/forum/'.$id.'.html" class="pl__header__comments__link"><span class="sdb__comments" data-href="/forum/'.$id.'.html">Комментариев: '.$forum_count.'</span></a></div>';
            }
            else
            {
                $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span></div>';
            }


            $cc.=$yandex_share_line;
            $cc.='<div class="pl__text">
                        '.$text.'
                           </div>';

            $cc.=$source_line;

            if(($forum)&&(!$noforum))
            {
                $cc.='<div class="pl__buttons">
                        <a href="/forum/'.$id.'.html" class="pl__buttons__comments">Комментариев: '.$forum_count.'</a><a href="/print/'.$id.'.html" class="pl__buttons__print">Версия для печати</a>
                    </div>';
            }
            else
            {
                $cc.='<div class="pl__buttons">
                        <a href="/print/'.$id.'.html" class="pl__buttons__print">Версия для печати</a>
                        </div>';
            }


            $cc.=draw_vote();

            $cc.=vrezkaPerson($id);





            return $cc;
        }
    }
}



//функция формирует форму ввода комментариев
function forum_article_form($id,$place_id)
{
    $user = [];
    $is_login = false;
    //нужно проверить что пользователь залогинен...
    if (isset($_COOKIE['auth_token']) && ($_COOKIE['auth_token']!=''))
    {

        //echo "SELECT * FROM forum_user WHERE SHA1(CONCAT(identity,network))='".mysql_real_escape_string($_COOKIE['ulogin_token'])."'";

        /*
        $r = runSQL("SELECT * FROM forum_user WHERE SHA1(CONCAT(identity,network))='".mysql_real_escape_string($_COOKIE['ulogin_token'])."'");

        if (mysql_num_rows($r))
        {
            $is_login=true;
            $user = mysql_fetch_assoc($r);
        }
        */
    }

    $profile="";

    if ($is_login) {

    }

  return '<div class="pl__comments__form">
        <form action="/forum/post" method="post">
            <input type="hidden" name="topic" value="'.$id.'">
            <!-- <input type="text" name="name" class="pl__comments__form__name" placeholder="Ваше имя"> -->

            <input type="hidden" name="user" value="" id="ulogin_identity_'.$place_id.'">
            <input type="hidden" name="name" value="" id="forum_name_'.$place_id.'">

            <div id="ulogin_form_'.$place_id.'" style="display: none; height:32px; line-height:32px;">
                <span>Для комментирования войдите с помощью </span><a href="" class="phone_auth_form">Телефона</a> или <a href="#" id="uLogin_'.$place_id.'"><img src="https://ulogin.ru/img/button.png?version=img.2.0.0" width=187 height=30 alt="МультиВход"/></a>
            </div>
            <div id="ulogin_info_'.$place_id.'" class="ulogin_info" style="display: none;">
                <div class="profile_image"></div>
                <ul class="profile_link">
                    <li><a href="" target="_blank" id="profile_link_'.$place_id.'"></a></li>
                    <li><a href="javascript:ulogin_logout();" class="forum_logout">Выйти</a></li>
                </ul>
            </div>
            <textarea placeholder="Комментарий" class="pl__comments__form__comment" name="text" id="forum_text_'.$place_id.'"></textarea>
            <a href="/rules/" class="pl__comments__rules">Правила</a>
            <input type="submit" value="высказаться" class="pl__comments__form__submit" id="forum_submit_'.$place_id.'">
        </form>
    </div>';
}

function forum_article($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0", $for_forum="0", $print="0")
{


    //выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date, UNIX_TIMESTAMP(`time`) as timestmp, noforum FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;
            $noforum=$d["noforum"];
            $src_id=$d["src_id"];
            $place_id=$d["place_id"];
            $material_date=$d["date"];
            $header=$d["header"];



            if ((time())>($d['timestmp']+(30 * 24 * 60 * 60)))
            {$time_stop_comments=1;}

            //Убираем врезки
            $text= preg_replace('/{{vrezka_photorep:(\d*)}}/i',"",$d["text"]);
            $text= preg_replace('/{{vrezka_news:(\d*)}}/i',"",$text);

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);

            $forum_count=count_forum($id);


            //убрал в спецдиректорию за пароль просмотр неактивированных новостей
            $news_is_approved=$d["appr"];
            if ($news_is_approved!="1")
            {
                //стираем все данные в массиве
                $d="";
                //переадресовываем на главную
                Header("Location: /");
                die;
            }


            if($place_id!="")
            {$SQL="SELECT name  from places where Id='$place_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $place_name=$dss["name"];
            }
            else {
                $place_name="Псков";
            }





            if(($forum)&&(!$noforum))
            {

                $forum_line0=' <span class="icons">Комментарии: <a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }


            if($src_id!="")
            {$SQL="SELECT url , name  from links where Id='$src_id'";
                $dss=mysql_fetch_array(runSQL($SQL));

                $source_line='<div class="pl__source">Источник: <span class="pl__source__name"> <A class="pl__source__name" href="http://'.$dss["url"].'">'.$dss["name"].'</a></span></div>';
            }


            if(($forum_count>0)&&($announce))
            {
                $forum_line='<a class="comments" href="/forum/'.$id.'.html" title="Комментарии:'.$forum_count.'">'.$forum_count.'</a>';

            }




//
//Серия кнопок "поделиться" от Яндекса
//



            $yandex_share_line=' <div class="pl__social_share">
                        <div class="pl__social_share__title">Поделитесь новостью с друзьями</div>
                        <div class="pl__social_share__buttons">
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js" charset="utf-8"></script>
<div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,telegram" data-counter=""></div>

  </div>
  <div class="pl__social_share__code"><a class="pl__social_share__code" href="/blogers/'.$id.'.html" class="blog" title="Код для блога">Код для блога</a></div>
</div>
 ';


            $print_and_forum_line.='

<div class="material_line"><b>'.$forum_line0.'&nbsp;|&nbsp;<a href="/blogers/'.$id.'.html" class="blog" title="Вставить в блог">Вставить в блог</a>&nbsp;|&nbsp;<a href="/print/'.$id.'.html" class="print" title="Версия для печати">Версия для печати</a> </span></b> </div>';



            //Добавление в Шапку для интерактива что ответственности за содержание мы не несем
//if ($dir=="letters"){ $cc.='<br/><div style="color:red;border:1px dashed red;padding:10px;margin-bottom:15px;"><small>За информацию данного раздела ИА «Псковская Лента Новостей» ответственности не несет.  Достоверность публикации администрация сайта не гарантирует. Информация в данном разделе публикуется посетителями сайта. </small></div><br/><br/>';}


            //Здесь формируем содержимое публикации:

            $cc.='
                    <div class="pl__section_name">'.$topic_name.'</div>

                    <div class="pl__header"><h1><a href="/'.$dir.'/'.$id.'.html" >'.$header.'</a></h1></div>';
            if(($forum)&&(!$noforum))
            {

                $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span><a href="/forum/'.$id.'.html" class="pl__header__comments__link"><span class="sdb__comments" data-href="/forum/'.$id.'.html">Комментариев: '.$forum_count.'</span></a></div>';
            }
            else
            {
                $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash">|</span>'.$place_name.'</span></div>';
            }


            $cc.=$yandex_share_line;
            $cc.='<div class="pl__short_text">
                        '.announce($text).'
                        <div class="pl__short_text__read_all"><a href="/'.$dir.'/'.$id.'.html" class="pl__short_text__read_all__link">Читать весь материал</a></div>
                           </div>';


            $cc.='<link rel="stylesheet" href="/css/forum.css"><script src="/js/ulogin.js"></script><script src="//ulogin.ru/js/ulogin.js"></script><div class="pl__comments">
                        <div class="pl__comments__header">Комментарии <span class="pl__comments__header__all">'.$forum_count.'</span></div>';

            if ($time_stop_comments!=1)
            {
                $cc.=forum_article_form($id,"up");
            }
            $cc.='  <div class="pl__comments__previous">';




//Если есть комменты  - выводим их
            if ($forum_count>0){
                //$SQL="SELECT id,name,email,subject,text,date_format(time, '%d.%m.%Y %H:%i') as time, inet_ntoa(ip) as ip, inet_ntoa(ip_orig) as ip_orig from forum WHERE topic='$id' ORDER BY forum.time";
                $SQL = "SELECT f.id,name,email,subject,text,date_format(time, '%d.%m.%Y %H:%i') as time, inet_ntoa(ip) as ip, inet_ntoa(ip_orig) as ip_orig,fu.first_name AS firstname, fu.last_name AS lastname,fu.identity,fu.profile,fu.image,f.user_id from forum AS f LEFT JOIN forum_user AS fu ON (f.user_id=fu.id) WHERE topic='".$id."'  ORDER BY f.time";
                $r=runSQL($SQL);

                while ($d=mysql_fetch_array($r))
                {
                    //Выборка суммы лайков и анлайков по комментам
                    $SQL1="select id, pLike, pDislike from `forum_like_sum` where id='".$d["id"]."'";
                    $ddd=mysql_fetch_array(runSQL($SQL1));
                    //если такой записи нет в таблице forum_like_sum для данного камента
                    //ставим лайку и дизлайку ='0'

                    //$pLike=(int) $ddd['pLike'];
                    // $pDislike= (int) $ddd['pDislike'];
                    if($ddd['pLike']==""){(int) $pLike=0;}
                    if($ddd['pDislike']==""){(int) $pDislike=0;}

                    if ($d['user_id']!=0)
                    {
                        $user_target=' target="_blank"';
                        $user_link=$d['profile'];
                        if ($d['network']=='smsc.ru'||$d['network']=='facebook'||$d['profile']=='')
                        {
                            $user_link="javascript:void(0);";
                            $user_target="";
                        }
                        $forum_user = '<a href="'.$user_link.'"'.$user_target.' rel="nofollow">'.$d['firstname'].' '.$d['lastname'].'</a>';
                        
                        
                        $forum_img = '<img src="'.$d['image'].'" class="forum_avatar">';
                    }
                    else
                    {
                        $forum_user = $d['name'];
                        $forum_img = '<img src="/pictures/forum/nopic.png" class="forum_avatar">';
                    }


                    $cc.=' <div class="pl__comments__previous__comment">
                                <div class="pl__comments__previous__comment__name_time">'.$forum_img.'<span class="pl__comments__previous__comment__name">'.$forum_user.'</span>  '.$d["time"].'</div>
                                <div class="pl__comments__previous__comment__text">'.stripslashes($d["text"]).'</div>
                                <div class="pl__comments__previous__comment__buttons">
                                    <a onclick=posldl("like","'.$d['id'].'") class="pln__comments__previous__comment__buttons__like"><span id="product_like_'.$d['id'].'">'.(int)$ddd['pLike'].'</span></a>
                                    <a onclick=posldl("dislike","'.$d['id'].'") class="pln__comments__previous__comment__buttons__dislike"><span id="product_dislike_'.$d['id'].'">'.(int)$ddd['pDislike'].'</span></a>
                                </div>
                            </div>

      ';

                }

            }




            if ($time_stop_comments!=1)
            {
                $cc.='   </div>


                        <div class="pl__comments__leave_comment">
                            <a href="#" class="pl__comments__leave_comment__link">Оставить комментарий</a>
                           ';

            }
            else

            {
                $cc.='   </div>


                        <div class="pl__comments__leave_comment">
                            <a href="#" class="pl__comments__leave_comment__link">Время для комментирования публикации истекло</a>
                           ';

            }


            if ($time_stop_comments!=1)
            {
                $cc.=forum_article_form($id,"down");;
            }

            $cc.='    </div>
                    </div>';






            return $cc;
        }
    }
}


function gforum_article($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0", $for_forum="0", $print="0")
{





    //выборка новости по id
    if ($id)
    {

        if ($id)
        {
            $SQL="select  id_catalog, name, description from photocat where id_catalog='".$id."'" ;
            $r=runSQL($SQL);
            $dt=mysql_fetch_array($r);


            $SQL2="select count(*) as gfcnt  from gforum where  gforum.topic='".$dt["id_catalog"]."'";
            $f=mysql_fetch_array(runSQL($SQL2));
            $forum_count=$f["gfcnt"];

            //Здесь формируем содержимое публикации:

            $cc.='
                    <div class="pl__section_name">Фоторепортажи</div>
                    <div class="pl__header"><h1>'.$dt[name].'</h1></div>';

            $cc.='<div class="sdb pl__header__comments"><span class="sdb__datetime">'.$material_date.'<span class="pl__header__comments__dash"></span>'.$place_name.'</span><a href="/gforum/'.$dt[id_catalog].'.html" class="pl__header__comments__link"><span class="sdb__comments" data-href="/gforum/'.$id.'.html">Комментариев: '.$f["gfcnt"].'</span></a></div>';


            $cc.=$yandex_share_line;
            $cc.='<div class="pl__short_text">
                        '.$dt[description].'
                        <div class="pl__short_text__read_all"><a href="/prpt/?gallery='.$dt[id_catalog].'" class="pl__short_text__read_all__link">Смотреть фоторепортаж</a></div>
                           </div>';


            $cc.='<div class="pl__comments">
                        <div class="pl__comments__header">Комментарии <span class="pl__comments__header__all">'.$forum_count.'</span></div>
                        <div class="pl__comments__form">
                            <form action="/gforum/post" method="post">
                                <INPUT type=hidden name=topic value='.$id.'>
                                <input type="text"  name="name" class="pl__comments__form__name" placeholder="Ваше имя">
                                <textarea placeholder="Комментарий" class="pl__comments__form__comment" name="text" id="text"></textarea>
                                <a href="/rules/" class="pl__comments__rules">Правила</a>
                                <input type="submit" value="высказаться" class="pl__comments__form__submit">
                            </form>
                        </div>';

            $cc.='  <div class="pl__comments__previous">';




//Если есть комменты  - выводим их
            if ($forum_count>0){
                $SQL="SELECT id,name,email,subject,text,date_format(time, '%d.%m.%Y %H:%i') as time, inet_ntoa(ip) as ip, inet_ntoa(ip_orig) as ip_orig from gforum WHERE topic='$id' ORDER BY gforum.time";

                $r=runSQL($SQL);





                while ($d=mysql_fetch_array($r))
                {
                    //Выборка суммы лайков и анлайков по комментам
                    $SQL1="select id, pLike, pDislike from `forum_like_sum` where id='".$d["id"]."'";
                    $ddd=mysql_fetch_array(runSQL($SQL1));
                    //если такой записи нет в таблице forum_like_sum для данного камента
                    //ставим лайку и дизлайку ='0'

                    //$pLike=(int) $ddd['pLike'];
                    // $pDislike= (int) $ddd['pDislike'];
                    if($ddd['pLike']==""){(int) $pLike=0;}
                    if($ddd['pDislike']==""){(int) $pDislike=0;}



                    $cc.=' <div class="pl__comments__previous__comment">
                                <div class="pl__comments__previous__comment__name_time"><span class="pl__comments__previous__comment__name">'.$d["name"].'</span>  '.$d["time"].'</div>
                                <div class="pl__comments__previous__comment__text">'.stripslashes($d["text"]).'</div>
                                <div class="pl__comments__previous__comment__buttons">
                                    <a onclick=posldl("like","'.$d['id'].'") class="pln__comments__previous__comment__buttons__like"><span id="product_like_'.$d['id'].'">'.(int)$ddd['pLike'].'</span></a>
                                    <a onclick=posldl("dislike","'.$d['id'].'") class="pln__comments__previous__comment__buttons__dislike"><span id="product_dislike_'.$d['id'].'">'.(int)$ddd['pDislike'].'</span></a>
                                </div>
                            </div>

      ';

                }

            }





            $cc.='   </div>


                        <div class="pl__comments__leave_comment">
                            <a href="#" class="pl__comments__leave_comment__link">Оставить комментарий</a>
                            <div class="pl__comments__form">
                                <form action="/gforum/post" method="post">
                                    <INPUT type=hidden name=topic value='.$id.'>
                                    <input type="text"  name="name" class="pl__comments__form__name" placeholder="Ваше имя">
                                <textarea placeholder="Комментарий" class="pl__comments__form__comment" name="text" id="text"></textarea>
                                <a href="/rules/" class="pl__comments__rules">Правила</a>
                                <input type="submit" value="высказаться" class="pl__comments__form__submit">
                                </form>
                            </div>
                        </div>
                    </div>';






            return $cc;
        }
    }
}





function old_forum_article($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0")
{

//выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;

            //убрал в спецдиректорию за пароль просмотр неактивированных новостей
            $news_is_approved=$d["appr"];
            if ($news_is_approved!="1")
            {
                //стираем все данные в массиве
                $d="";
                //переадресовываем на главную
                Header("Location: /");
                die;


            }


            //counter make +1
            if (!$announce){
                $query="update counter  set count=count+1 where topic=$id";
                runSQL($query);
            }

            $header=$d["header"];

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);
            $forum_count=count_forum($id);

            // Картинка в анонсе
            /* if ($announce)
               if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
                if (file_exists("pictures/tn/".$regs[1].".jpg"))
                 $imgname=$regs[1];
              */


            if ($time)
                $time=$d["date"];




            $header=(($announce)?'<a href="/'.$dir.'/'.$id.'.html">'.$header.'</a>':$header);
            $text='<div id="date">'.$time.' ПЛН </div>  <p>'.announce($d["text"]).'</p>';

            $cc.='<div id="material_txt">

        <H2>'.$header.'</H2>

        '.$text;


            $cc.='<p><a class="more" href="/'.$dir.'/'.$id.'.html">Читать весь материал</a> </p>
     Комментарии:<span class="comments">'.$forum_count.'</span><br>
     <div id="material_title"><a title="Обсуждение">Обсуждение</a></div>

     ';




            //Вывод блока коммнентариев
            $forum_count=count_forum($id);


//Если есть комменты  - выводим их
            if ($forum_count>0){
                $SQL="SELECT id,name,email,subject,text,date_format(time, '%d.%m.%Y %H:%i') as time, inet_ntoa(ip) as ip, inet_ntoa(ip_orig) as ip_orig from forum WHERE topic='$id' ORDER BY forum.time";
                $r=runSQL($SQL);





                while ($d=mysql_fetch_array($r))
                {
                    $cc.='
       <DIV id="comment">
      <DIV class="nik">'.$d["name"].'</DIV>
      <DIV class="date">'.$d["time"].'</DIV>
      ';

                    if (
                        ($REMOTE_ADDR=='195.133.238.20' and getIp()=='195.133.238.20') or
                        ($REMOTE_ADDR=='195.133.238.2') or (1!=1)
                    )
                    {


                        $cc.='
      <DIV class=date>Внешний IP: '.$d["ip"].'</DIV>';
// $cc.='<DIV class=date>Host Name: '.@gethostbyaddr($d["ip"]).'</DIV>';
                        $cc.='<DIV class=date>Внутренний IP: '.$d["ip_orig"].'</DIV>';
// $cc.='<DIV class=date>Host Name:'.@gethostbyaddr($d["ip_orig"]).'</DIV>';
                    }


                    //Выборка суммы лайков и анлайков по комментам
                    $SQL1="select id, pLike, pDislike from `forum_like_sum` where id='".$d["id"]."'";
                    $ddd=mysql_fetch_array(runSQL($SQL1));
                    //если такой записи нет в таблице forum_like_sum для данного камента
                    //ставим лайку и дизлайку ='0'

                    //$pLike=(int) $ddd['pLike'];
                    // $pDislike= (int) $ddd['pDislike'];
                    if($ddd['pLike']==""){(int) $pLike=0;}
                    if($ddd['pDislike']==""){(int) $pDislike=0;}





                    $cc.='<table border="0" width="100%"><tr><td>
      <DIV class="comment_txt">'.stripslashes($d["text"]).'</DIV>
      </td>
      <td width="35" style="vertical-align:top;"><div class="product_like" ><img  src="/i/like.png" onclick=posldl("like","'.$d['id'].'")></td><td width="20"  style="vertical-align:top; padding-top:5px; padding-right:3px;"> <span id="product_like_'.$d['id'].'">'.(int)$ddd['pLike'].'</span></div>
      </td>
      <td width="35" style="vertical-align:top;">
      <img src="/i/dislike.png" onclick=posldl("dislike","'.$d['id'].'")></td><td width="20"  style="vertical-align:top; padding-top:5px; padding-right:3px;"><span id="product_dislike_'.$d['id'].'">'.(int)$ddd['pDislike'].'</span></div>
      </td>
      </tr>
      </table>
      </DIV>';
                }

            }





            //сама форма для сообщений
            $cc.='<!-- Обсуждение -->
<div id="material_txt">
<h3>Добавить комментарий&nbsp;&nbsp;&nbsp;<a class="more" href="/rules">Правила</a></h3>
<div id="opinion">
<form action="/forum/post" method="post">
<INPUT type=hidden name=topic value='.$id.'>
<div class="name">Ваше имя: <input name="name" size="25" type="text"></div>
<div>Сообщение:
<textarea type="text" name="text" id="text" rows="7" cols="24" style="width:99%"></textarea>
<input style="padding: 0 6px 0 6px" type=submit name="search" value="Высказаться">

</div>
</form>
</div>
</div>';

            /*   $cc.='
            <!-- Put this div tag to the place, where the Comments block will be -->
            <div id="vk_comments"></div>
            <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {limit: 20, width: "496", attach: "*"});
            </script>

            <br>';
            */
            $cc.='
<div id="yadpln"></div>
';

            $cc.='
        </div>
         ';

        }


        return $cc;
    }
}



function search_article_announce($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0")
{

//выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;



            $header=$d["header"];

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);
            $forum_count=count_forum($id);


            if ($time)
                $time=$d["date"];


            //  $text='<div id="date">'.$time.'</div><p>'.announce($d["text"]).'</p><p><a class="more" href="/'.$dir.'/'.$id.'.html">Читать весь материал</a></p>';

            $cc.=' <span class="search__results__news_link">
                                <span class="sdb"><span class="sdb__datetime">'.$time.'</span><a style="text-decoration: none; color:#878787;" href="/forum/'.$id.'.html"><span class="sdb__comments" data-href="/forum/'.$id.'.html">'.$forum_count.'</span></a><span class="sdb__section">'.$topic_name.'</span></span>
        <a style="text-decoration: none;" href="/'.$dir.'/'.$id.'.html">
        <span class="search__results__news_link__title">
        '.$header.'</span>

        <span class="search__results__person__title">'.announce($d["text"]).'</span>
        </a>
        </span>
        ';
        }
    }
    return $cc;

}



function search_person_announce($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0")
{

    $letters=[
        '1'=>'а',
        '2'=>'б',
        '3'=>'в',
        '4'=>'г',
        '5'=>'д',
        '6'=>'е',
        '7'=>'ё',
        '8'=>'ж',
        '9'=>'з',
        '10'=>'и',
        '11'=>'й',
        '12'=>'к',
        '13'=>'л',
        '14'=>'м',
        '15'=>'н',
        '16'=>'о',
        '17'=>'п',
        '18'=>'р',
        '19'=>'с',
        '20'=>'т',
        '21'=>'у',
        '22'=>'ф',
        '23'=>'х',
        '24'=>'ц',
        '25'=>'ч',
        '26'=>'ш',
        '27'=>'щ',
        '28'=>'э',
        '29'=>'ю',
        '30'=>'я'
    ];




//выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date FROM person WHERE person.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {

            $header=$d["header"];

            //Буковка для ссылки в кто есть кто
            $f=mb_strtolower($header,'CP1251')[0];
            $f=array_search($f,$letters);


            $dir='whoiswho/'.$f.'_';

            $topic_name=get_topic_name($d["topic"]);
            $forum_count=count_forum($id);

            // Картинка в анонсе
            if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
                if (file_exists("pictures/tn/".$regs[1].".jpg"))
                    $imgname=$regs[1];




            if ($time)
                $time=$d["date"];


            //  $text='<div id="date">'.$time.'</div><p>'.announce($d["text"]).'</p><p><a class="more" href="/'.$dir.'/'.$id.'.html">Читать весь материал</a></p>';

            $cc.=' <span class="search__results__news_link">

        <a style="text-decoration: none;" href="/'.$dir.'/'.$id.'.html">
        <span class="search__results__news_link__title">
        '.$header.'</span>

        <span class="search__results__person__title">'.announce($d["text"]).'</span>
        </a>
        </span>
        ';
        }
    }
    return $cc;

}




function new_article_announce($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0")
{

//выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;



            $header=$d["header"];

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);
            $forum_count=count_forum($id);

            // Картинка в анонсе
            /* if ($announce)
               if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
                if (file_exists("pictures/tn/".$regs[1].".jpg"))
                 $imgname=$regs[1];
              */


            if ($time)
                $time=$d["date"];

            $header='<a href="/'.$dir.'/'.$id.'.html">'.$header.'</a>';
            $text='<div id="date">'.$time.'</div><p>'.announce($d["text"]).'</p><p><a class="more" href="/'.$dir.'/'.$id.'.html">Читать весь материал</a></p>';

            $cc.='

        <H2>'.$header.'</H2>

        '.$text;

            /*     $cc.='<DIV style="FONT-WEIGHT: bold; MARGIN: 8px 0px 16px"><A
                  href="/'.$dir.'/'.$id.'.html"><IMG
                  style="PADDING-RIGHT: 0px; DISPLAY: inline; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px"
                  height=9 src="/i/list.gif" width=9>&nbsp;Читать весь
                  текст</A></DIV>';
            */
        }
    }
    return $cc;

}









/**
 * @param string $aInitialImageFilePath - строка, представляющая путь к обрезаемому изображению
 * @param string $aNewImageFilePath - строка, представляющая путь куда нахо сохранить выходное обрезанное изображение
 * @param int $aNewImageWidth - ширина выходного обрезанного изображения
 * @param int $aNewImageHeight - высота выходного обрезанного изображения
 */
function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight) {
    if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) {
        return false;
    }

    // Массив с поддерживаемыми типами изображений
    $lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png");

    // Получаем размеры и тип изображения в виде числа
    list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath);

    if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
        return false;
    }
    $lImageExtension = $lAllowedExtensions[$lImageExtensionId];

    // Получаем название функции, соответствующую типу, для создания изображения
    $func = 'imagecreatefrom' . $lImageExtension;
    // Создаём дескриптор исходного изображения
    $lInitialImageDescriptor = $func($aInitialImageFilePath);

    // Определяем отображаемую область
    $lCroppedImageWidth = 0;
    $lCroppedImageHeight = 0;
    $lInitialImageCroppingX = 0;
    $lInitialImageCroppingY = 0;
    if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
        $lCroppedImageWidth = floor($lInitialImageWidth);
        $lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
        $lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
    } else {
        $lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
        $lCroppedImageHeight = floor($lInitialImageHeight);
        $lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
    }

    // Создаём дескриптор для выходного изображения
    $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
    imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
    $func = 'image' . $lImageExtension;

    $copy=ImageCreateFromPng($_SERVER['DOCUMENT_ROOT'] ."/adminpln/photo/img/copy.png");
    $cpx = ImageSx($copy);
    $cpy = ImageSy($copy);

    //Не лепим лого
    // ImageCopyMerge($lNewImageDescriptor, $copy, (612-$cpx),(344-$cpy),0,0,$cpx,$cpy,100);

    ImageJPEG($lNewImageDescriptor,$aNewImageFilePath,100);

    ImageDestroy($lNewImageDescriptor);


    //  chmod ("../../../pictures/$newname",0644);


    // сохраняем полученное изображение в указанный файл
    // $func($lNewImageDescriptor, $aNewImageFilePath);




}






function topnews_block()
{



    $pr1=get_var("Primary1");

    $pr2=get_var("Primary2");

    $pr3=get_var("Primary3");

    $pr4=get_var("rpskrim");
    $pr5=get_var("rvlprim");



//
// 1-я новость
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr1'";
    $d=mysql_fetch_array(runSQL($SQL));

    $primary1["id"]=$d["id"];
    $primary1["dir"]=get_topic_dir($d["topic"]);
    $primary1["fulldir"]=build_path($primary1[dir]);

    $primary1["date"]=$d[date];
    $primary1["header"]=$d[header];
    $primary1["text"]=countstr($d[text],140);

    $primary1["forum_count"]=count_forum($pr1);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";


//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary1["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider.jpg", 612, 344);
        $primary1["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }
    else
    {
        $primary1["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }



//
// 2-я новость
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr2'";
    $d=mysql_fetch_array(runSQL($SQL));
    $primary2["id"]=$d["id"];
    $primary2["dir"]=get_topic_dir($d["topic"]);
    $primary2["fulldir"]=build_path($primary2[dir]);

    $primary2["date"]=$d[date];
    $primary2["header"]=$d[header];
    $primary2["text"]=countstr($d[text],140);

    $primary2["forum_count"]=count_forum($pr2);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";

//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary2["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider.jpg", 612, 344);
        $primary2["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }
    else
    {
        $primary2["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }


//
// 3-я новость
//
    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr3'";
    $d=mysql_fetch_array(runSQL($SQL));
    $primary3["id"]=$d["id"];
    $primary3["dir"]=get_topic_dir($d["topic"]);
    $primary3["fulldir"]=build_path($primary3[dir]);

    $primary3["date"]=$d[date];
    $primary3["header"]=$d[header];
    $primary3["text"]=countstr($d[text],140);

    $primary3["forum_count"]=count_forum($pr3);



    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";

//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary3["imgname_big"]=$imgname_big;

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider.jpg", 612, 344);
        $primary3["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }
    else
    {
        $primary3["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }



//
// 1-я Главная новость в правый блок Псков
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr4'";
    $d=mysql_fetch_array(runSQL($SQL));

    $primary4["id"]=$d["id"];
    $primary4["dir"]=get_topic_dir($d["topic"]);
    $primary4["fulldir"]=build_path($primary1[dir]);

    $primary4["date"]=$d[date];
    $primary4["header"]=$d[header];
    $primary4["text"]=countstr($d[text],140);

    $primary4["forum_count"]=count_forum($pr4);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";


//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary4["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider_right.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider_right.jpg", 300, 166);
        $primary4["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }
    else
    {
        $primary4["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }



//
// 2-я Главная новость в правый блок Великие Луки
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr5'";
    $d=mysql_fetch_array(runSQL($SQL));

    $primary5["id"]=$d["id"];
    $primary5["dir"]=get_topic_dir($d["topic"]);
    $primary5["fulldir"]=build_path($primary1[dir]);

    $primary5["date"]=$d[date];
    $primary5["header"]=$d[header];
    $primary5["text"]=countstr($d[text],140);

    $primary5["forum_count"]=count_forum($pr5);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";


//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary5["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider_right.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider_right.jpg", 300, 166);
        $primary5["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }
    else
    {
        $primary5["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }


    $zz1a="
<ins data-revive-zoneid=\"68\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
";

    $zz1b="
<ins data-revive-zoneid=\"69\" data-revive-id=\"b7e52a292f64a460c6892b0f1021106a\"></ins>
<script async src=\"//nbads.pln24.ru/ads/www/delivery/asyncjs.php\"></script>
";



    $c='<div class="news_of_day__wrapper">
            <div class="news_of_day">
                <div class="news_of_day__lines">
                    <table>
                        <tr>
                            <td class="news_of_day__big_block__container">
                                <div class="news_of_day__big_block">
                                    <a href="/'.$primary1["dir"].'/'.$primary1["id"].'.html" class="simg">
                                        <img src="'.$primary1["imgname_big"].'" height="344">
                                        <span class="news_of_day__big_block__header">новость дня</span>
                                        <span class="news_of_day__big_block__info simg__text">
                                            <span class="news_of_day__big_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary1["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary1["id"].'.html">'.$primary1["forum_count"].'</span></span>
                                            <span class="news_of_day__big_block__title">'.$primary1["header"].'</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="news_of_day__big_block" style="display: none;">
                                    <a href="/'.$primary2["dir"].'/'.$primary2["id"].'.html" class="simg">
                                        <img src="'.$primary2["imgname_big"].'" height="344">
                                        <span class="news_of_day__big_block__header">новость дня</span>
                                        <span class="news_of_day__big_block__info simg__text">
                                            <span class="news_of_day__big_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary2["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary2["id"].'.html">'.$primary2["forum_count"].'</span></span>
                                            <span class="news_of_day__big_block__title">'.$primary2["header"].'</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="news_of_day__big_block" style="display: none;">
                                    <a href="/'.$primary3["dir"].'/'.$primary3["id"].'.html" class="simg">
                                        <img src="'.$primary3["imgname_big"].'" height="344">
                                        <span class="news_of_day__big_block__header">новость дня</span>
                                        <span class="news_of_day__big_block__info simg__text">
                                            <span class="news_of_day__big_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary3["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary3["id"].'.html">'.$primary3["forum_count"].'</span></span>
                                            <span class="news_of_day__big_block__title">'.$primary3["header"].'</span>
                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td class="news_of_day__middle_blocks__container">
                                <table class="news_of_day__middle_blocks__tbl">
                                    <tr><td class="news_of_day__middle_blocks current"><a href="/'.$primary1["dir"].'/'.$primary1["id"].'.html" class="news_of_day__middle_blocks__link">
                                        <span class="news_of_day__middle_blocks__title">'.$primary1["header"].'</span>
                                        <span class="news_of_day__middle_blocks__details sdb"><span class="sdb__datetime">'.$primary1["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary1["id"].'.html">'.$primary1["forum_count"].'</span></span>
                                    </a></td></tr>
                                    <tr><td class="news_of_day__middle_blocks"><a href="/'.$primary2["dir"].'/'.$primary2["id"].'.html" class="news_of_day__middle_blocks__link">
                                        <span class="news_of_day__middle_blocks__title">'.$primary2["header"].'</span>
                                        <span class="news_of_day__middle_blocks__details sdb"><span class="sdb__datetime">'.$primary2["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary2["id"].'.html">'.$primary2["forum_count"].'</span></span>
                                    </a></td></tr>
                                    <tr><td class="news_of_day__middle_blocks"><a href="/'.$primary3["dir"].'/'.$primary3["id"].'.html" class="news_of_day__middle_blocks__link">
                                        <span class="news_of_day__middle_blocks__title">'.$primary3["header"].'</span>
                                        <span class="news_of_day__middle_blocks__details sdb"><span class="sdb__datetime">'.$primary3["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary3["id"].'.html">'.$primary3["forum_count"].'</span></span>
                                    </a></td></tr>
                                </table>
                            </td>
                            <td class="news_of_day__small_blocks__container">
                                <table class="news_of_day__small_blocks">
                                    <tr><td>
                                    '.$zz1a.'
                                    </td></tr>
                                    <tr><td>
                                   '.$zz1b.'
                                    </td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>';




    return $c;
}




function topnews_block_vln()
{



    $pr1=get_var("VlPrimary1");

    $pr2=get_var("VlPrimary2");

    $pr3=get_var("VlPrimary3");

    $pr4=get_var("rpskrim");
    $pr5=get_var("rvlprim");



//
// 1-я новость
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr1'";
    $d=mysql_fetch_array(runSQL($SQL));

    $primary1["id"]=$d["id"];
    $primary1["dir"]=get_topic_dir($d["topic"]);
    $primary1["fulldir"]=build_path($primary1[dir]);

    $primary1["date"]=$d[date];
    $primary1["header"]=$d[header];
    $primary1["text"]=countstr($d[text],140);

    $primary1["forum_count"]=count_forum($pr1);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";


//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary1["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider.jpg", 612, 344);
        $primary1["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }
    else
    {
        $primary1["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }



//
// 2-я новость
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr2'";
    $d=mysql_fetch_array(runSQL($SQL));
    $primary2["id"]=$d["id"];
    $primary2["dir"]=get_topic_dir($d["topic"]);
    $primary2["fulldir"]=build_path($primary2[dir]);

    $primary2["date"]=$d[date];
    $primary2["header"]=$d[header];
    $primary2["text"]=countstr($d[text],140);

    $primary2["forum_count"]=count_forum($pr2);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";

//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary2["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider.jpg", 612, 344);
        $primary2["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }
    else
    {
        $primary2["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }


//
// 3-я новость
//
    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr3'";
    $d=mysql_fetch_array(runSQL($SQL));
    $primary3["id"]=$d["id"];
    $primary3["dir"]=get_topic_dir($d["topic"]);
    $primary3["fulldir"]=build_path($primary3[dir]);

    $primary3["date"]=$d[date];
    $primary3["header"]=$d[header];
    $primary3["text"]=countstr($d[text],140);

    $primary3["forum_count"]=count_forum($pr3);



    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";

//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary3["imgname_big"]=$imgname_big;

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider.jpg", 612, 344);
        $primary3["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }
    else
    {
        $primary3["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider.jpg';
    }



//
// 1-я Главная новость в правый блок Псков
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr4'";
    $d=mysql_fetch_array(runSQL($SQL));

    $primary4["id"]=$d["id"];
    $primary4["dir"]=get_topic_dir($d["topic"]);
    $primary4["fulldir"]=build_path($primary1[dir]);

    $primary4["date"]=$d[date];
    $primary4["header"]=$d[header];
    $primary4["text"]=countstr($d[text],140);

    $primary4["forum_count"]=count_forum($pr1);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";


//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary4["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider_right.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider_right.jpg", 300, 166);
        $primary4["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }
    else
    {
        $primary4["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }



//
// 2-я Главная новость в правый блок Великие Луки
//

    $SQL="SELECT  news.id as id, news.topic as topic, news.header as header, date_format(news.time, '%d.%m.%Y %H:%i') as date, date_format(news.time, '%H:%i') as smalldate, date_format(news.time, '%d.%m.%Y') as bigdate, text as text FROM news WHERE id='$pr5'";
    $d=mysql_fetch_array(runSQL($SQL));

    $primary5["id"]=$d["id"];
    $primary5["dir"]=get_topic_dir($d["topic"]);
    $primary5["fulldir"]=build_path($primary1[dir]);

    $primary5["date"]=$d[date];
    $primary5["header"]=$d[header];
    $primary5["text"]=countstr($d[text],140);

    $primary5["forum_count"]=count_forum($pr1);


    $imgname="";
    $imgname_big="";
    $imgname="";
    $imgname_only="";


//поиск картинки

    if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
    {   //if (file_exists("pictures/".$regs[1].".jpg"))
        // {
        $imgname_only=$regs[1];
        $imgname=$regs[1];
        $imgname_big='pictures/'.$imgname.'.jpg';
        $imgname='pictures/tn/'.$imgname.'.jpg';

        // }
        //Дебаглог обработка - начали катинки в блоках анонсов теряться. Почему?
        /*  else
          {
            $starttime=date("d.m.Y H:i:s",time());
            $filo=fopen("anonce_articles.log","a+");
            fwrite($filo, "$starttime - lost file for $regs[1]  \n---------------------------\n");
            fclose($filo);

                  }
         */

    }
    $primary5["imgname_big"]=$imgname_big;


    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/pictures/slider/'.$imgname_only.'_slider_right.jpg'))
    {cropImage($_SERVER['DOCUMENT_ROOT'] . "/pictures/".$imgname_only.".jpg", $_SERVER['DOCUMENT_ROOT'] . "/pictures/slider/".$imgname_only."_slider_right.jpg", 300, 166);
        $primary5["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }
    else
    {
        $primary5["imgname_big"]='/pictures/slider/'.$imgname_only.'_slider_right.jpg';
    }








    $c='<div class="news_of_day__wrapper">
            <div class="news_of_day">
                <div class="news_of_day__lines">
                    <table>
                        <tr>
                            <td class="news_of_day__big_block__container">
                                <div class="news_of_day__big_block">
                                    <a href="/'.$primary1["dir"].'/'.$primary1["id"].'.html" class="simg">
                                        <img src="'.$primary1["imgname_big"].'" height="344">
                                        <span class="news_of_day__big_block__header">новость дня</span>
                                        <span class="news_of_day__big_block__info simg__text">
                                            <span class="news_of_day__big_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary1["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary1["id"].'.html">'.$primary1["forum_count"].'</span></span>
                                            <span class="news_of_day__big_block__title">'.$primary1["header"].'</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="news_of_day__big_block" style="display: none;">
                                    <a href="/'.$primary2["dir"].'/'.$primary2["id"].'.html" class="simg">
                                        <img src="'.$primary2["imgname_big"].'" height="344">
                                        <span class="news_of_day__big_block__header">новость дня</span>
                                        <span class="news_of_day__big_block__info simg__text">
                                            <span class="news_of_day__big_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary2["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary2["id"].'.html">'.$primary2["forum_count"].'</span></span>
                                            <span class="news_of_day__big_block__title">'.$primary2["header"].'</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="news_of_day__big_block" style="display: none;">
                                    <a href="/'.$primary3["dir"].'/'.$primary3["id"].'.html" class="simg">
                                        <img src="'.$primary3["imgname_big"].'" height="344">
                                        <span class="news_of_day__big_block__header">новость дня</span>
                                        <span class="news_of_day__big_block__info simg__text">
                                            <span class="news_of_day__big_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary3["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary3["id"].'.html">'.$primary3["forum_count"].'</span></span>
                                            <span class="news_of_day__big_block__title">'.$primary3["header"].'</span>
                                        </span>
                                    </a>
                                </div>
                            </td>
                            <td class="news_of_day__middle_blocks__container">
                                <table class="news_of_day__middle_blocks__tbl">
                                    <tr><td class="news_of_day__middle_blocks current"><a href="/'.$primary1["dir"].'/'.$primary1["id"].'.html" class="news_of_day__middle_blocks__link">
                                        <span class="news_of_day__middle_blocks__title">'.$primary1["header"].'</span>
                                        <span class="news_of_day__middle_blocks__details sdb"><span class="sdb__datetime">'.$primary1["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary1["id"].'.html">'.$primary1["forum_count"].'</span></span>
                                    </a></td></tr>
                                    <tr><td class="news_of_day__middle_blocks"><a href="/'.$primary2["dir"].'/'.$primary2["id"].'.html" class="news_of_day__middle_blocks__link">
                                        <span class="news_of_day__middle_blocks__title">'.$primary2["header"].'</span>
                                        <span class="news_of_day__middle_blocks__details sdb"><span class="sdb__datetime">'.$primary2["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary2["id"].'.html">'.$primary2["forum_count"].'</span></span>
                                    </a></td></tr>
                                    <tr><td class="news_of_day__middle_blocks"><a href="/'.$primary3["dir"].'/'.$primary3["id"].'.html" class="news_of_day__middle_blocks__link">
                                        <span class="news_of_day__middle_blocks__title">'.$primary3["header"].'</span>
                                        <span class="news_of_day__middle_blocks__details sdb"><span class="sdb__datetime">'.$primary3["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary3["id"].'.html">'.$primary3["forum_count"].'</span></span>
                                    </a></td></tr>
                                </table>
                            </td>
                            <td class="news_of_day__small_blocks__container">
                                <table class="news_of_day__small_blocks">
                                    <tr><td><a href="/'.$primary4["dir"].'/'.$primary4["id"].'.html" class="news_of_day__small_block simg">
                                        <img src="'.$primary4["imgname_big"].'">
                                        <span class="news_of_day__small_block__city">Псков</span>
                                        <span class="news_of_day__small_block__desc simg__text">
                                            <span class="news_of_day__small_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary4["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary4["id"].'.html">'.$primary4["forum_count"].'</span></span>
                                            <span class="news_of_day__small_block__title">'.$primary4["header"].'</span>
                                        </span>
                                    </a></td></tr>
                                    <tr><td><a href="/'.$primary5["dir"].'/'.$primary5["id"].'.html" class="news_of_day__small_block simg">
                                        <img src="'.$primary5["imgname_big"].'">
                                        <span class="news_of_day__small_block__city">великие луки</span>
                                        <span class="news_of_day__small_block__desc simg__text">
                                            <span class="news_of_day__small_block__details sdb sdb-on_image"><span class="sdb__datetime">'.$primary5["date"].'</span><span class="sdb__comments" data-href="/forum/'.$primary5["id"].'.html">'.$primary5["forum_count"].'</span></span>
                                            <span class="news_of_day__small_block__title">'.$primary5["header"].'</span>
                                        </span>
                                    </a></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>';




    return $c;
}




function blogers_article($id,$subj="1",$time="1",$announce="0", $header="1", $primary="0")
{

//выборка новости по id
    if ($id)
    {

        $SQL="SELECT *,date_format(time, '%d.%m.%Y %H:%i') as date FROM news,topics WHERE news.topic=topics.id AND news.id='$id'";
        if ($d=mysql_fetch_array(runSQL($SQL)))
        {
            //Смотрим в опции (opts) рубрики (sd - single document & forum)
            $SQL="SELECT sd,forum FROM topics WHERE id='".$d["topic"]."'";
            $opts=mysql_fetch_array(runSQL($SQL));
            $sd=$opts["sd"]+0;
            $forum=$opts["forum"]+0;

            //counter make +1
            if (!$announce){
                $query="update counter  set count=count+1 where topic=$id";
                runSQL($query);
            }

            $header=$d["header"];

            $dir=get_topic_dir($d["topic"]);
            $topic_name=get_topic_name($d["topic"]);
            $forum_count=count_forum($id);

            // Картинка в анонсе
            //if ($announce)
            if (preg_match("/pictures\/([0-9_]*)/",stripslashes($d["text"]),$regs))
                if (file_exists("pictures/tn/".$regs[1].".jpg"))
                    $imgname=$regs[1];


            if ($time)
                $time=$d["date"];






            if ($imgname)
                $text='<img src="http://pln-pskov.ru/pictures/tn/'.$imgname.'.jpg" alt="'.$d["header"].'" width="70" align="left">'.announce($d["text"]);
            else
                $text=announce($d["text"]);





            $dd.="<table cellpadding=\"2\" cellspacing=\"0\" bgcolor=\"white\" width=\"800\" style=\"border: 1px solid #c0c0c0;\"><tbody><tr><td><a href=\"http://pln-pskov.ru/\"><img  border=\"0\" title=\"Псков. Новости Пскова и Псковской области. Псковская Лента Новостей / ПЛН.\" alt=\"Псковская Лента Новостей \" src=\"http://pln-pskov.ru/images/header2_logo.png\" /></a></td></tr><tr><td><a style=\"text-decoration: none\" href=\"http://pln-pskov.ru/".$dir."/".$id.".html\"><h2 style=\"color:  #000000; font-size: 18px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\">".$header."</h2></a></td></tr><tr><td><span style=\"color: #4F4F4F;  font-size: 11px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\">".$time."</span></td></tr><tr><td><a style=\"text-decoration: none\" href=\"http://pln-pskov.ru/".$dir."/".$id.".html\"><span style=\"color: #000000;  font-size: 12px;  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\">".$text."</span></a></td></tr><tr><td><br/><a style=\"text-decoration: none\" href=\"http://pln-pskov.ru/".$dir."/".$id.".html\"><span style=\"color: #9E0B0E;  font-size: 12px; font-weight:bold; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\">Читать весь текст</span></a></td></tr></tbody></table>";

            $cc.= "

<table width=\"100%\" style=\"border: solid 0px #B0B0B0; \">
<tr>
<td>

<H2> HTML-код для Вашего блога: </H2>

<TEXTAREA style=\"WIDTH: 98%\" name=text rows=10 cols=24>".$dd."</TEXTAREA>

</td>
</tr>
</table>

<br>
<br>

<table width=\"100%\" style=\"border: solid 0px #B0B0B0; \">
<tr>
<td>
<b> Результат будет выглядеть так: </b>
<hr>
".$dd."

</td>
</tr>
</table>



";



        }


        return $cc;
    }
}



?>