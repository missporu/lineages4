<?php

$headmod = 'opt';//фикс. места

$textl='Настройки';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////



switch($_GET[mod]){

default:
////////////////////////////////////////////////////////////////////////////////
$req = mysql_query("SELECT * FROM `options` where `usr`='$log' LIMIT 1");
$avto=mysql_num_rows($req);
if($avto==0) // создаем юзеру таблицу настроек если нет её
{ mysql_query("INSERT INTO
        `options` SET
        `usr` = '$log',
        `chat` = 'yes',
        `paty` = 'yes',
        `foot` = 'pic',
        `theme` = 'style',
        `pic` = 'yes',
        `sneg`='yes',
        `drakon`='yes',
        `ramka`='yes',
        `privat` = 'yes'");}
		
////////////////////////////////////////////////////////////////////////////////
					//  СОХРАНЯЕМ НАСТРОЙКИ //
if ($_GET[mod]==save){

$ressave = mysql_query ("UPDATE options SET
chat='".mysql_real_escape_string($_POST[chat])."',
pic='".mysql_real_escape_string($_POST[pic])."',
paty='".mysql_real_escape_string($_POST[paty])."',
foot='".mysql_real_escape_string($_POST[foot])."',
theme='".mysql_real_escape_string($_POST[theme])."',
sneg='".mysql_real_escape_string($_POST[sneg])."',
drakon='".mysql_real_escape_string($_POST[drakon])."',
ramka='".html($_POST[ramka])."',
privat='".mysql_real_escape_string($_POST[privat])."'
		 WHERE usr='$log' LIMIT 1");
		 
$text = htmlspecialchars(addslashes($_POST['text']));

if (strlen($text)>100) { echo"<font color=red>Длиное сообщение!</font>";}else{

mysql_query ("UPDATE users SET
        status='$text'
		 WHERE usr='$log' LIMIT 1");}
		 
				if ($ressave == 'true')
					{
					echo '<font color=#007F46><p>Настройки сохранены!</p></font>'; // удачно
					echo "<div class=news><font color=red>Некоторые изменения вступят в силу после обновления страници.</font></div>";
					}
					else
					{
					echo "<font color=red><p> Неудача ! </p></font>";  // неудачно =)
					}



}
/////////////////////////////////////////////////////////////////////////////////

$reqi = mysql_query("SELECT * FROM `options` where `usr`='$log' LIMIT 1");
$user = mysql_fetch_array($reqi);

$reqi2 = mysql_query("SELECT * FROM `users` where `usr`='$log' LIMIT 1");
$user2 = mysql_fetch_array($reqi2);

echo "<div class=menu><b><p>Настройки:</p></b><hr/>";
        echo"<div class=inoy><a href=\"opt_pass.php?\">Изменить пароль</a></div>";
		
	


echo '<hr/><form action="opt.php?mod=save" method="post">';

	
/*	------------------------		Выбор ТЕМЫ		-------------------------		*/

echo " Выбор темы:<br/>";

if (empty($user[theme]) or $user[theme]==style){
echo"<select name=\"theme\">
<option value=\"style\">Измененная</option>
<option value=\"osn\">Основная</option>
<option value=\"wml\">WML</option>
</select>";
}

if ($user[theme]==osn){
echo"<select name=\"theme\">
<option value=\"osn\">Основная</option>
<option value=\"style\">Измененная</option>
<option value=\"wml\">WML</option>
</select>";
}

if ($user[theme]==wml){
echo"<select name=\"theme\">
<option value=\"wml\">WML</option>
<option value=\"osn\">Основная</option>
<option value=\"style\">Измененная</option>
</select>";
}





/*-----------------		--------------		-----------------------------			------------------*/		
									
									
									
	echo '<hr/>';								

if ($user[chat]==yes){ // если чат включ то выводит первым да
echo "Показывать чат?<br/>
<select name=\"chat\">
<option value=\"yes\">Да</option>
<option value=\"no\">Нет</option>
</select><hr/>";}else{ // иначе нет (когда отключен)
echo "Показывать чат?<br/>
<select name=\"chat\">
<option value=\"no\">Нет</option>
<option value=\"yes\">Да</option>
</select><hr/>";}


								

if ($user[drakon]==yes){ // если показ дракона включ то выводит первым да
echo "Показывать приход Валакаса?<br/>
<select name=\"drakon\">
<option value=\"yes\">Да</option>
<option value=\"no\">Нет</option>
</select><hr/>";}else{ // иначе нет (когда отключен)
echo "Показывать приход Валакаса?<br/>
<select name=\"drakon\">
<option value=\"no\">Нет</option>
<option value=\"yes\">Да</option>
</select><hr/>";}

if ($user[ramka]==yes){ // если показ дракона включ то выводит первым да 
echo "Показывать верхнюю рамку (валюта)?<br/>
<select name=\"ramka\"> 
<option value=\"yes\">Да</option> 
<option value=\"no\">Нет</option> 
</select><hr/>";}else{ // иначе нет (когда отключен) 
echo "Показывать верхнюю рамку (валюта)?<br/>
<select name=\"ramka\"> 
<option value=\"no\">Нет</option> 
<option value=\"yes\">Да</option> 
</select><hr/>";}



if ($user[privat]==yes){ // если приват включ то выводит первым да
echo "Разр. писать в приват?<br/>
<select name=\"privat\">
<option value=\"yes\">Да</option>
<option value=\"no\">Нет</option>
</select><hr/>";}else{ // иначе нет (когда отключен)
echo "Разр. писать в приват?<br/>
<select name=\"privat\">
<option value=\"no\">Нет</option>
<option value=\"yes\">Да</option>
</select><hr/>";}

if ($user[paty]==yes){ // если пати включ то выводит первым да
echo "Разр. кидать пати?<br/>
<select name=\"paty\">
<option value=\"yes\">Да</option>
<option value=\"no\">Нет</option>
</select><hr/>";}else{ // иначе нет (когда отключен)
echo "Разр. кидать пати?<br/>
<select name=\"paty\">
<option value=\"no\">Нет</option>
<option value=\"yes\">Да</option>
</select><hr/>";}

if ($user[foot]==pic or empty($user[foot])){ // если низ картинки или пусто то
echo "Нижнее меню:<br/>
<select name=\"foot\">
<option value=\"pic\">Картинки</option>
<option value=\"text\">Текст</option>
</select><hr/>";}else{ // иначе нет (когда отключен)
echo "Нижнее меню:<br/>
<select name=\"foot\">
<option value=\"text\">Текст</option>
<option value=\"pic\">Картинки</option>
</select><hr/>";}





			echo 'Статус (100макс):
			<br/><textarea name="text" rows="3" maxlength="100">'.$user2['status'].'</textarea><hr/>';


echo '<input class="button" type="submit" value="Сохранить" /></form>';

echo "</div>";

echo"<div class=silka>		<a href=\"pers.php?\">Назад</a>			</div>";

break;

}
include($path.'inc/down.php');
?>