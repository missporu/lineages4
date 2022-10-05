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

if ($udata[dostup]>4){
$time = date("H:i d.m.y");

switch($_GET[mod]){

default:
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!empty($smsgo)){echo "$smsgo <hr/>";}

echo "<p><font color=orabge>Рассылка сообщений</font></p><hr>";
   
if(empty($_POST[text])){

echo '<form action="?" method="post">';
echo"Введите текст сообщения:<br/><small><font color=grey>(Поддержка html тегов)</font></small><br/>
<textarea name=\"text\" rows=\"4\" maxlength=\"5000\"></textarea><br/>";
echo '<input class="button" type="submit" value="Отправить" /></form>';


}else{ //

$text = " <font color=#669966><b> $_POST[text] </b></font>";

//защита от антифлуда//
//-
$reqcolpovtor = mysql_num_rows(mysql_query("SELECT * FROM `msg_r` WHERE `time`='$time' and `mail_msg`='$text' and `user_from` = '$log' Limit 1"));
if ($reqcolpovtor==1){echo "<p><font color=#990000>Повтор запроса</font></p><hr/>";}else{
//-

$usrreg = mysql_query("SELECT * FROM `users`");
   While($usr = mysql_fetch_array($usrreg)){
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Рассылка от администрации', `user_to` = '$usr[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'"); // отправляем сообщение
}
echo '<p><font color=#99CC66><b>Сообщения разосланы </b></font></p><hr/>';

}

echo "<div class=inoy><a href=\"?\">Назад</a></div>";

}

echo "<div class=inoy><a href=\"/gm/\">GM-Админка</a></div>";

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