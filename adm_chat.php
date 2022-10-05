<?php

$headmod = 'adm_chat';//фикс. места

$textl='Админ Чат';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

if($udata[dostup]<2){
echo "<font color=red><p>Доступ закрыт</p></font>";
include($path.'inc/down.php');exit;
}


switch($_GET[mod]){

default:
/*
function smiles($string){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="">',$string);
}}
closedir ($dir);
return $string;  }
*/
/////////////
$rand = rand(1000,9999);
///////////////////

echo "<center><b><font color=lime><div class='dot'>Админ чат</center></b></font></div>" ;
echo "<center>-=$times=-</center>";//Время по игре
echo'<div class="hid" align="left"><div class=chat2>';//надписи по левому краю
//див
//echo "<a href=\"smile.php?\">Смайлы</a><br/>";
echo "<a href=\"adm_chat.php?r=$rand\">Обновить</a>";
echo "<form action=\"adm_chat.php?mod=writes\" method=\"POST\">";
echo //"	<input type=\"text\" name=\"zin\" maxlength=\"5000\"/> 
		"	<textarea name=\"zin\" rows=\"3\" maxlength=\"5000\"></textarea><br/>

<input type=\"submit\" value=\"Написать\" class=\"ibutton\"></div>";
///Функция отправки
//начало подщёт страниц
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
///конец подщётов
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM adm_chat"));
$puslap = floor($viso/10);
$times = date("H:i");
$asd = mysql_query("SELECT * FROM adm_chat ORDER BY id DESC LIMIT $num,10");
echo"<div align='left'>";
while($dsa = mysql_fetch_array($asd))
{
$nickas = strip_tags($dsa['nick']);
$koment = $dsa['komentaras'];
$time = strip_tags($dsa['time']);
//$koment = smiles($koment);



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

if($udata[dostup]>=4){
$silka = " <a href=\"adm_chat.php?mod=del_post&amp;p=$dsa[id]\"><font color=red>x</font></a>";
}


if ($ud[dostup]>=4)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=lime>$nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><b><font color=#893700> $koment </font></b>";
}else{
if ($ud[dostup]==2 or $ud[dostup]==3)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#0026FF>$nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><font color=#007ED8> $koment </font>";}else{

// если есть цветной ник, то грузим цвет
$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$nickas' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$colors = mysql_fetch_array($req222);

echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#$colors[color]> $nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b> $koment ";
}else{

///////////////////////////////////////


echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"> $nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b> $koment ";
}}}

echo'<br/>';
}
echo "<hr/></div>";
if($udata[dostup] >= 3)
{
echo "<br/><div class=inoy><a href=\"adm_chat.php?mod=och\">Удалить все сообщения</a></div>";
}
echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

if ($_GET[page] > 0)
{
echo "<a href=\"adm_chat.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"adm_chat.php?page=$next\">Далее</a>";}
else
{echo "Далее";}
echo "</div>";
break;

case 'del_post':
if($udata[dostup] >= 4)
{
if(empty($_GET[p])){
echo"Не выбран пост!<br/>";
}else{
$asd = mysql_query("SELECT * FROM adm_chat WHERE id='".mysql_real_escape_string($_GET[p])."' LIMIT 1");
$avto=mysql_num_rows($asd);
if($avto==0){
echo'Нет такого поста!<br/>';
}else{
mysql_query("DELETE FROM `adm_chat` WHERE id='".mysql_real_escape_string($_GET[p])."' LIMIT 1");
echo'Пост успешно удалён!<br/>';
echo "<a href=\"adm_chat.php?\">Назад</a>";
}
}
}else{
echo "Ошибка!Доступ закрыт!";
}
break;

case 'write':

echo"<b>Сообщение</b><br/>";
echo "<form action=\"adm_chat.php?mod=writes\" method=\"POST\">";
if (isset($_GET[nick]))
{
$_GET[nick] = htmlspecialchars($_GET[nick]);
//echo "<input type=\"text\" name=\"zin\" maxlength=\"250\" value=\"$_GET[nick], \" size=\"20\"/><br/>";
echo "<textarea name=\"zin\" rows=\"3\" maxlength=\"5000\">$_GET[nick], </textarea><br/>";


}
else
{
echo "<input type=\"text\" name=\"zin\" maxlength=\"250\" size=\"20\"/><br/>";
}
echo "<input type=\"submit\" value=\"Ok\" class=\"ibutton\"><br/>";
echo "<div class=silka><a href=\"adm_chat.php?\">Назад</a></div>";
break;

case 'writes':


$msg=$_POST['zin'];

// пишем защиту от повтора сообщений
$pov = mysql_fetch_array(mysql_query("SELECT * FROM adm_chat WHERE nick = '$log' ORDER BY id DESC LIMIT 1"));

if ($pov[komentaras]==$msg){
echo "<b>Спам. Запрещенно писать одинаковые сообщения! </b>";
					echo"<br/><br/><a href=\"adm_chat.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}




$msg=substr($msg, 0, 512);
$msg=stripslashes(htmlspecialchars($msg));
$msg=str_replace("\r\n","<br />",$msg);
$msg=str_replace("\r","<br />",$msg);
$msg=str_replace("\n","<br />",$msg);
$msg = addslashes($msg);
$msg=preg_replace ("|[\r\n]+|si","",$msg);
$a = mysql_num_rows(mysql_query("SELECT komentaras FROM adm_chat WHERE komentaras = '$msg'"));
$b = mysql_fetch_array(mysql_query("SELECT kada FROM adm_chat WHERE nick = '$log' ORDER BY kada DESC LIMIT 1"));
$data_kom = strip_tags($b['kada']);
$data = date("y/m/d H:i:s", strtotime("+20 seconds"));
$data_dbr = date("y/m/d H:i:s");
$time = date("H:i");
if($data_dbr >= $data_kom && $msg != "")
{
mysql_query("INSERT INTO adm_chat SET nick = '$log', komentaras = '$msg', kada = '$data', time = '$time'");
$rand = rand(1000,9999);
//start
/*
function smiles($string){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="">',$string);
}}
closedir ($dir);
return $string;  }
*/
/////////////
$rand = rand(1000,9999);
///////////////////
echo'<div class="hid" align="left">';
///echo "<a href=\"smile.php?\">Смайлы</a><br/>";
echo "<a href=\"adm_chat.php?r=$rand\">Обновить</a>";
echo "<form action=\"adm_chat.php?mod=writes\" method=\"POST\">";
echo //"<input type=\"text\" name=\"zin\" maxlength=\"5000\"/> 
		"	<textarea name=\"zin\" rows=\"3\" maxlength=\"5000\"></textarea><br/>
<input type=\"submit\" value=\"Написать\" class=\"ibutton\"></div>";

if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM adm_chat"));
$puslap = floor($viso/10);
$times = date("H:i");
//echo "<center>-=$times=-</center>";
$asd = mysql_query("SELECT * FROM adm_chat ORDER BY id DESC LIMIT $num,10");
echo"<div align='left'>";
while($dsa = mysql_fetch_array($asd))
{
$nickas = strip_tags($dsa['nick']);
$koment = $dsa['komentaras'];
$time = strip_tags($dsa['time']);
///$koment = smiles($koment);

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


if($udata[dostup]>=4){
$silka = " <a href=\"adm_chat.php?mod=del_post&amp;p=$dsa[id]\"><font color=red>x</font></a>";
}


if ($ud[dostup]>=4)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=lime>$nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><b><font color=#893700> $koment </font></b>";
}else{
if ($ud[dostup]==2 or $ud[dostup]==3)
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#0026FF>$nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b><font color=#007ED8> $koment </font>";}else{

// если есть цветной ник, то грузим цвет
$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$nickas' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$colors = mysql_fetch_array($req222);

echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#$colors[color]> $nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b> $koment ";
}else{

///////////////////////////////////////


echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"> $nickas</font></a>
<a href=\"adm_chat.php?nick=$nickas&amp;mod=write\"> [отв] $silka</a>
:<br/></b> $koment ";
}}}

echo'<br/>';
}
echo "<hr/></div>";
if($udata[dostup] >= 4)
{
echo "<br/><div class=inoy><a href=\"adm_chat.php?mod=och\">Удалить все сообщения</a></div>";
}
echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

if ($_GET[page] > 0)
{
echo "<a href=\"adm_chat.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"adm_chat.php?page='. htmlspecialchars($next).' \">Далее</a>";}
else
{echo "Далее";}
echo "</div>";
//end
}
elseif($data_dbr < $data_kom)
{
$sec = $data_kom-$data_dbr;
$rand = rand(1000,9999);
echo "Защита от Флуда! Подождите $sec секунд<br/>";
echo"<a href=\"adm_chat.php?r=$rand\">Продолжить</a>";
}
elseif($msg == "")
{
$rand = rand(1000,9999);
echo "Вы не написали сообщение!<br/>";
echo"<a href=\"adm_chat.php?r=$rand\">Продолжить</a>";
}
else
{
$rand = rand(1000,9999);
echo "Ошибка!<br/>";
echo"<a href=\"adm_chat.php?r=$rand\">Продолжить</a>";
}
break;

case 'och':

if($udata[dostup] >= 4)
{
mysql_query("DELETE FROM adm_chat");
echo "Все сообщения удалены!";
echo "<br/><a href=\"adm_chat.php?\">Назад</a><br/></div>";
}
else
{
echo "Ошибка!Доступ закрыт!<br/></div>";
}
break;
}

include($path.'inc/down.php');
?>
