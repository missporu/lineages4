<?
define('PROTECTOR', 1);

$textl='Ред. Блок персонажа';
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


if ($udata[dostup] < 3){
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'Что то пошло не так...', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
include($path.'inc/down.php');
exit;}

switch($_GET[mod]){
default:
//-
$data = date("d F Yг. в H:i", strtotime("+20 seconds"));
//-
$data = str_replace("January","Января",$data);
$data = str_replace("February","Февраля",$data);
$data = str_replace("March","Марта",$data);
$data = str_replace("April","Апреля",$data);
$data = str_replace("May","Мая",$data);
$data = str_replace("June","Июня",$data);
$data = str_replace("July","Июля",$data);
$data = str_replace("August","Августа",$data);
$data = str_replace("September","Сентября",$data);
$data = str_replace("October","Октября",$data);
$data = str_replace("November","Ноября",$data);
$data = str_replace("December","Декабря",$data);


//---ПИШЕМ РЕЗУЛЬТАТ-----

if (isset($_GET[new_bl])){

mysql_query ("UPDATE block SET text='$_POST[text]',cena='$_POST[cena]' WHERE usr='$_POST[usr]' LIMIT 1"); // пишем данные игрока с новой суммой

//http://l-nw.ru/search.php?nick=Angel-Sky&go=go
echo "
<p><b>
	<font color=red>Блок редактирован! </font><br/> <br/>


	<font color=green>Причина: <font color=orange>$_POST[text]!</font><br/> </font>
	<font color=green>Цена разб: <font color=orange>$_POST[cena]!</font><br/> </font>
	<font color=green>Перс: <font color=orange>$_POST[usr]!</font><br/> </font>
</p></b>
<div class=dot>
<p><b><font color=orange>Save . . . Ok!</font</b></p></div>";

}else{
//------------------------------------

//  -------- приравниваем ------------------------------------------------------------------------------
if(!empty($_POST[usr]) and !empty($_POST[b]))
{
  $_GET[usr] = $_POST[usr]; $_GET[b] = $_POST[b]; 
}
//------------------------------------------------------------------------------------------------------------


//-----------------------открываем данные о персонаже---------------------
if(empty($_GET[usr]) and empty($_GET[b])){

echo '<form action="?" method="post">';


echo"Логин:<br/>
<input class='input' type=\"text\" size=\"10\" value=\"$blok[usr]\" name=\"usr\"/><br/>";

echo"ID блока:<br/>
<input class='input' type=\"text\" size=\"10\" value=\"$blok[usr]\"  name=\"b\"/><br/>";

echo '<input class="button" type="submit" value="Далее" /></form>';



}else{
$blok = mysql_fetch_array(mysql_query("SELECT * FROM `block` WHERE `id`='$_GET[b]' and `usr`='$_GET[usr]' Limit 1"));

if (!empty($blok)){

echo "<p><b>Редактор блока:</b></p>";
echo '<form action="?new_bl" method="post">';


echo"Логин:<br/>
<input class='input' type=\"text\" size=\"10\" value=\"$blok[usr]\" name=\"usr\"/><br/>";

echo"Причина бана:<br/>
<input class='input' type=\"text\" size=\"10\" value=\"$blok[text]\"  name=\"text\"/><br/>";

echo"Цена разблока:<br/>
<input class='input' type=\"text\" size=\"10\" value=\"$blok[cena]\"  name=\"cena\"/><br/>";


echo '<input class="button" type="submit" value="Изменить" /></form>';


}
}
}

break;

}

echo "<br/><div class=inoy><a href=\"/search.php?nick=$_POST[usr]$_GET[usr]&go=go\">Назад</a></div></div>";

include($path.'inc/down.php');
?>