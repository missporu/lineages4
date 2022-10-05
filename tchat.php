<?php


$headmod = 'tchat';//фикс. места

$textl='Торговый Чат';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

switch($_GET[mod]){

default:

function smiles($string){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="">',$string);
}}
closedir ($dir);
return $string;  }
/////////////
$rand = rand(1000,9999);
///////////////////


echo'<div class="hid" align="left">';

echo "<b>Комнаты:</b> <a href=\"chat.php?\"> Общий чат </a>  | 
  Торговый | <a href=\"schat.php?\">Системный</a><br/><br/>" ;


echo "<a href=\"smile.php?\">Смайлы</a><br/>";
echo "<a href=\"tchat.php?r=$rand\">Обновить</a>";
echo "<form action=\"tchat.php?mod=writes\" method=\"POST\">";
echo "<input type=\"text\" name=\"zin\" maxlength=\"5000\"/> <input type=\"submit\" value=\"Написать\" class=\"ibutton\"></div>";

if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = htmlspecialchars($_GET[page]) + 1;
$back = htmlspecialchars($_GET[page]) - 1;
$num = htmlspecialchars($_GET[page]) * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM tchat"));
$puslap = floor($viso/10);
$times = date("H:i");
//echo "<center>-=$times=-</center>";
$asd = mysql_query("SELECT * FROM tchat ORDER BY id DESC LIMIT $num,10");
echo"<div align='left'>";
while($dsa = mysql_fetch_array($asd))
{
$nickas = strip_tags($dsa['nick']);
$koment = strip_tags($dsa['komentaras']);
$time = strip_tags($dsa['time']);
$koment = smiles($koment);

$reqs = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nickas'");
$ud = mysql_fetch_array($reqs);

//картинка клана /////////////////////////////
$pic = "";
if(!empty($ud[clan])){
$req6546566 = mysql_query("SELECT `emblema` FROM `clan` WHERE `lider` = '$ud[clan]' LIMIT 1");
$wh = mysql_fetch_array($req6546566);

if(!empty($wh[emblema])){
$pic = "<img src=\"pic/clan/$wh[emblema]\" alt=\"cl\"/>";}}
////////////////////////////////////////////////
$antiyou = "<img src=\"pic/smiles/align2.gif\" alt=\"antiyou\"/>";

$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$nickas' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$color = mysql_fetch_array($req222);
$cl = "<font color=#$color[color]>";}else{
$cl = "";}


if($udata[dostup]>=2){
$silka = " <a href=\"tchat.php?mod=del_post&amp;p=$dsa[id]\"><font color=red>x</font></a>";
}

if($dsa['nick']=="AntiYou")
{
echo "
<hr/><b>[$time] $pic $antiyou<a href=\"search.php?nick=$nickas&amp;go=go\"><font color=lime>$nickas</font></a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a>
:<br/></b><font color=#5e995c> $koment </font>";
}else{

if ($ud[dostup]>=4)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=lime>$nickas</font></a>
<a href=\"tchat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><font color=#FF0000> $koment </font>";
}else{
if ($ud[dostup]==2 or $ud[dostup]==3)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#0026FF>$nickas</font></a>
<a href=\"tchat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><font color=#007ED8> $koment </font>";}else{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$cl$nickas</font></a>
<a href=\"tchat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b> $koment ";
}}}

echo'<br/>';
}
echo "<hr/></div>";
if($udata[dostup] >= 2)
{
echo "<br/><div class=inoy><a href=\"tchat.php?mod=trinti\">Удалить все сообщения</a></div>";
}
echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

if ($_GET[page] > 0)
{
echo "<a href=\"tchat.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"tchat.php?page=$next\">Далее</a>";}
else
{echo "Далее";}
echo "</div>";
break;

case 'del_post':
if($udata[dostup] >= 2)
{
if(empty($_GET[p])){
echo"Не выбран пост!<br/>";
}else{
$asd = mysql_query("SELECT * FROM tchat WHERE id='".mysql_real_escape_string($_GET[p])."' LIMIT 1");
$avto=mysql_num_rows($asd);
if($avto==0){
echo'Нет такого поста!<br/>';
}else{
mysql_query("DELETE FROM `tchat` WHERE id='".mysql_real_escape_string($_GET[p])."' LIMIT 1");
echo'Пост успешно удалён!<br/>';
echo "<a href=\"tchat.php?\">Назад</a>";
}
}
}else{
echo "Ошибка!Доступ закрыт!";
}
break;

case 'write':

echo"<b>Объявление</b><br/>";
echo "<form action=\"tchat.php?mod=writes\" method=\"POST\">";
if (isset($_GET[nick]))
{
$_GET[nick] = htmlspecialchars($_GET[nick]);
echo "<input type=\"text\" name=\"zin\" maxlength=\"250\" value=\"$_GET[nick], \" size=\"10\"/><br/>";
}
else
{
echo "<input type=\"text\" name=\"zin\" maxlength=\"250\" size=\"10\"/><br/>";
}
echo "<input type=\"submit\" value=\"Ok\" class=\"ibutton\"><br/>";
echo "<img src='img/feather.png' alt=''><a href=\"tchat.php?\">Назад</a><br>";
break;

case 'writes':

$msg=$_POST['zin'];

if ($udata[lvl]<11){
echo "<b>В чате можно писать с 11 уровня! </b>";
			echo"<br/><br/><a href=\"chat.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}
/////////////////////защита спёр с линяги фаворита///////////////////////////

/*if("http://Anonymouse.org/ (Unix)"==getenv('HTTP_USER_AGENT')){
echo"Извините, но с прокси писать запрещено.<br/><br/>Если это сообщение вам выдало по непонятной причине, напишите на ник iNoY_GM браузер с которого
вы заходите.";
echo "</p></card></wml>";
include 'inc/down.php';
exit;
}

if($brow==getenv('HTTP_USER_AGENT')){
if($ip!==$_SERVER['REMOTE_ADDR']){
echo"Извините, но с прокси писать запрещено.<br/><br/>Если это сообщение вам выдало по непонятной причине, напишите на ник iNoY_GM браузер с которого
вы заходите.";
echo "</p></card></wml>";
include 'inc/down.php';

exit;}}*/
//////////////////////////////////////////////////////////////////////////////////


$msg = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|. mobi|. ua|. tk|. ru|. org|. net|. info|. com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3)", "Реклама запрещена", $msg);
$msg = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|. mobi|. ua|. tk|. ru|. org|. net|. info|. com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3)", "Реклама запрещена", $msg);

$msg=eregi_replace("(СУКА|ХУЙ|ХУИ|ХУЁ|ХУЕ|ИБА|ИПАЛ|АХХУЕН|ПИТБ|ХУЯ|ХУУ|АХУЕ|ОХУЕ|ХУЕЛ|ОХУИ|ОХУУ|ОХИУ|ОХУЮ|АХУИ|АХИИ|АХИЕ|АХУУ|АХИУ|ПИЗД|ПИСД|ПЫЗД|ПЫСД|ПИЦД|ПЕЗД|ПЕСД|БЛЯД|БЛЯ|БЛАД|БЛЯТ|БЛАТЬ|БЛЙАД|БЛЙАТ|БЛИАД|БЛИАТ| ЁБ| ЁП| ЕБ|ЙОБ|ИОБ|ЪЕБ|АЁБ|АЁП|АЕБ|АЙОБ|АИОБ|ОЁБ|ОЕБ|УЁБ|УЁП|УЕБ|УЙОБ|УИОБ|ИЕБ|ЫЕБ|МУДИ|МУДА|ЧЛЕН|ЧЛЕП|ПИДОР|ПИДАР|НИДОР|НИДАР|ПЕДИ|ЧМО|ЖОП|ДРАЧИ|ДРАЦХИ|ТВАЮ|ПОЦ|ПОХ|САСИ| ЛОХ| ЛОШ|ЕДРИ|ХЕР|ПИДО|ГОНД|МАНД|ЗАЛУП|ОТХУ|СУЧЕ|СРАН|МУДО|ДАРАС|БАЛЬНИК|СЦУКА)", "***", $msg);
$msg=eregi_replace("(сука|хуй|хуи|хеё|хуе|иба|ипал|аххуен|питв|хуя|ахуе|охуе|хуел|охуи|ахие|пизд|писд|пызд|пысд|пицд|пезд|песд|бляд|бля|блят|блять|блйад|блйат|блиад|блиат|уёбок|уебок|уйоб|член|члеп|пидор|пидар|нидор|нидар|педик|чмо|драчи|драчун|дроч|пох|саси|лох|хер|пидо|гонд|залуп|сучка|дарас|бальник|сцука)", "***", $msg);



$msg=substr($msg, 0, 512);
$msg=stripslashes(htmlspecialchars($msg));
$msg=str_replace("\r\n","<br />",$msg);
$msg=str_replace("\r","<br />",$msg);
$msg=str_replace("\n","<br />",$msg);
$msg = addslashes($msg);
$msg=preg_replace ("|[\r\n]+|si","",$msg);
$a = mysql_num_rows(mysql_query("SELECT komentaras FROM tchat WHERE komentaras = '$msg'"));
$b = mysql_fetch_array(mysql_query("SELECT kada FROM tchat WHERE nick = '$log' ORDER BY kada DESC LIMIT 1"));
$data_kom = strip_tags($b['kada']);
$data = date("y/m/d H:i:s", strtotime("+900 seconds"));
$data_dbr = date("y/m/d H:i:s");
$time = date("H:i");
if($data_dbr >= $data_kom && $msg != "")
{
mysql_query("INSERT INTO tchat SET nick = '$log', komentaras = '$msg', kada = '$data', time = '$time'");
$rand = rand(1000,9999);
//start
function smiles($string){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="">',$string);
}}
closedir ($dir);
return $string;  }
/////////////
$rand = rand(1000,9999);
///////////////////
echo'<div class="hid" align="left">';
echo "<a href=\"smile.php?\">Смайлы</a><br/>";
echo "<a href=\"tchat.php?r=$rand\">Обновить</a>";
echo "<form action=\"tchat.php?mod=writes\" method=\"POST\">";
echo "<input type=\"text\" name=\"zin\" maxlength=\"5000\"/> <input type=\"submit\" value=\"Написать\" class=\"ibutton\"></div>";

if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = htmlspecialchars($_GET[page]) + 1;
$back = htmlspecialchars($_GET[page]) - 1;
$num = htmlspecialchars($_GET[page]) * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM tchat"));
$puslap = floor($viso/10);
$times = date("H:i");
//echo "<center>-=$times=-</center>";
$asd = mysql_query("SELECT * FROM tchat ORDER BY id DESC LIMIT $num,10");
echo"<div align='left'>";
while($dsa = mysql_fetch_array($asd))
{
$nickas = strip_tags($dsa['nick']);
$koment = strip_tags($dsa['komentaras']);
$time = strip_tags($dsa['time']);
$koment = smiles($koment);


$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$nickas' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$color = mysql_fetch_array($req222);
$cl = "<font color=#$color[color]>";}else{
$cl = "";}


$reqs = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nickas'");
$ud = mysql_fetch_array($reqs);

//картинка клана /////////////////////////////
$pic = "";
if(!empty($ud[clan])){
$req6546566 = mysql_query("SELECT `emblema` FROM `clan` WHERE `lider` = '$ud[clan]' LIMIT 1");
$wh = mysql_fetch_array($req6546566);

if(!empty($wh[emblema])){
$pic = "<img src=\"pic/clan/$wh[emblema]\" alt=\"cl\"/>";}}
////////////////////////////////////////////////


if($udata[dostup]>=2){
$silka = " <a href=\"tchat.php?mod=del_post&amp;p=$dsa[id]\"><font color=red>x</font></a>";
}


if ($ud[dostup]>=4)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=lime>$nickas</font></a>
<a href=\"tchat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><font color=#FF0000> $koment </font>";
}else{
if ($ud[dostup]==2 or $ud[dostup]==3)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#0026FF>$nickas</font></a>
<a href=\"tchat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><font color=#007ED8> $koment </font>";}else{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$cl$nickas</font></a>
<a href=\"tchat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b> $koment ";
}}

echo'<br/>';
}
echo "<hr/></div>";
if($udata[dostup] >= 2)
{
echo "<br/><div class=inoy><a href=\"tchat.php?mod=trinti\">Удалить все сообщения</a></div>";
}
echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

if ($_GET[page] > 0)
{
echo "<a href=\"tchat.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"tchat.php?page=$next\">Далее</a>";}
else
{echo "Далее";}
echo "</div>";
//end
}
elseif($data_dbr < $data_kom)
{
$sec = $data_kom-$data_dbr;
$rand = rand(1000,9999);
echo "Массовое размещение сообщений в торговом чате запрещено. Одно сообщение в 15 минут.<br/>";
echo"<a href=\"tchat.php?r=$rand\">Продолжить</a>";
}
elseif($msg == "")
{
$rand = rand(1000,9999);
echo "Вы не написали сообщение!<br/>";
echo"<a href=\"tchat.php?r=$rand\">Продолжить</a>";
}
else
{
$rand = rand(1000,9999);
echo "Ошибка!<br/>";
echo"<a href=\"tchat.php?r=$rand\">Продолжить</a>";
}
break;

case 'trinti':

if($udata[dostup] >= 2)
{
mysql_query("DELETE FROM tchat");
echo "Все сообщения удалены!";
echo "<br/><a href=\"tchat.php?\">Назад</a><br/></div>";
}
else
{
echo "Ошибка!Доступ закрыт!<br/></div>";
}
break;
}

include($path.'inc/down.php');
?>
