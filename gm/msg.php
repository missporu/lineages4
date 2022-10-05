<?php

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
	$path='../';			//
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////

if ($udata[dostup]>1){

switch($_GET[mod]){

default:
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(empty($_POST[nick])){ $nick = $_GET[nick];}else{$nick = $_POST[nick];}

if(!empty($_GET[nick]))  {$_POST[nick]=$_GET[nick];}
   
   
   
if(empty($_POST[nick])){
echo '<form action="msg.php?" method="post">';
echo"Ник:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"$nick\" name=\"nick\"/><br/>";




echo '<input class="button" type="submit" value="Читать приват" /></form>';
}else{

//// защита старших по званию читать приват нельзя

$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
///////////////////////////
$avto=mysql_num_rows($req);

if($avto=="0"){
echo'Нет такого игрока!';
include($path.'inc/down.php');exit;
}

$usdata = mysql_fetch_array($req);

if($udata[dostup]<$usdata[dostup]){
echo'Нельзя читать почту! Вы меньше по званию.';
include($path.'inc/down.php');exit;
}
if($usdata[usr]=='Shiki' and $udata[usr]!='Shiki'){
echo'Нельзя читать почту Shiki!Это наказуемо =D.';
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Вашу почту попытался прочитать $udata[usr]' ");
include($path.'inc/down.php');exit;
}
if($usdata[usr]=='MuTpaHgep' and $udata[usr]!='KraToS'){
echo'Ох чую щас ты люлей отхапаешь :D.';
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Freya-war', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Вашу почту попытался прочитать $udata[usr]' ");
include($path.'inc/down.php');exit;
}

if($usdata[usr]=='Freya-war' and $udata[usr]!='KraToS'){
echo'Ох чую щас ты люлей отхапаешь :D.';
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Freya-war', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Вашу почту попытался прочитать $udata[usr]' ");
include($path.'inc/down.php');exit;
}

if($usdata[usr]=='KoTe' and $udata[usr]!='Shiki'){
echo'Нельзя читать почту Miray!Это наказуемо =D.';
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Miray', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Вашу почту попытался прочитать $udata[usr]' ");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Почту Miray попытался прочитать $udata[usr]' ");
include($path.'inc/down.php');exit;
}

///////////////////////////////////////////////

$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE user_to = '$nick'"),0);
if ($result == 0)
{
echo "<b>Почта пуста!</b><br/>";
}
else {

echo "<hr/>";
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 5;
if($_GET[page] == "0")
{$i = 0;}
else{$i = ($_GET[page]*5)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/5);
$message = mysql_query("SELECT * FROM msg_r WHERE user_to = '$nick'  ORDER BY id DESC LIMIT $num,5");
while($msg = mysql_fetch_array($message))
{
if ($msg[read] == 1)
{
//mysql_query("UPDATE `msg_r` SET `read` = 0 WHERE `user_to` = '$nick'"); // не прочитаное что бы не пропало
}
if ($msg[read] == 1)
{
$read = "<font color=red>Не прочитано<br/></font>";
} else
{
$read = "";
}
$text = $msg[mail_msg];
//$text = strip_tags($text);
$from = strip_tags($msg['user_from']);
echo "<br/><b><font color=grey>От:</font> </b><b><a href='/search.php?nick=".$from."&amp;go=go'>$from</a><font color=#686868></b> <small>$msg[time]</small></font>
<br/> $read 

<b><font color=grey>Текст:</font></b> $text
<br/><br/>";
echo "<hr/>";
} 
if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?nick=$nick&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?nick=$nick&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
}
echo "<br/><a href=\"/gm/\">Назад</a></div>";
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
break;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>