<?
define('PROTECTOR', 1);

$textl='GM-Panel WebMoney';
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


if ($udata[dostup] < 4){
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
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


// --- --- Одобрить заказ --- --- //
if (isset($_GET[y])){
$reqcolpovto = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `id`='$_GET[y]' Limit 1"));
if ($reqcolpovto==1){

$zak = mysql_fetch_array(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `id`='$_GET[y]' Limit 1"));
$usr = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `usr`='$zak[usr]' Limit 1"));

$col=$usr[wmr]+$_POST[col]*100;

mysql_query ("UPDATE users SET wmr='$col' WHERE usr='$zak[usr]' LIMIT 1"); // пишем данные игрока с новой суммой
mysql_query("DELETE FROM `zakaz_col_wm` WHERE `id`='$zak[id]' and `usr`='$zak[usr]' LIMIT 1"); // удаляем со списка заказов
mysql_query("INSERT INTO
        `zakaz_col_wm_log` SET
        `usr` = '$log',
        `komu` = '$zak[usr]',
        `col` = '$_POST[col]',
        `data` = '$data'"); // зуписуем в лог
$time = date("H:i d.m.y");
$text = " <font color=green>Ваш запрос пополнения на <b>$_POST[col]</b> WMR успешно обработан. Благодарим за покупку!</font>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$zak[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'"); // отправляем сообщение


		//----------даём рефералу процент----------------
		
		if (!empty($usr[ref])){
		$ref = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `usr`='$usr[ref]' Limit 1"));
		
		$cenasms = $_POST[col]*100; // считаем цену потраченого
		$refprocent = 0.15; // процент 15 стоит
		$wmrprocent = round($cenasms * $refprocent);
		$wmr = $ref[wmr]+$wmrprocent;
		mysql_query ("UPDATE users SET wmr='$wmr' WHERE usr='$ref[usr]' LIMIT 1");
		
		}
		//-----------------------------------------------



echo '<p><font color=#99CC66><b>'.$_POST[col].' WMR персонажу '.$zak[usr].' зачислено:</b></font></p><hr/> ';
//echo "Цена СМС - $cenasms / Процент - $refprocent / Проц.ден. - $wmrprocent / К начислению - $wmr / Кому - $ref[usr] / Реф - $usr[ref]";
}
}


// --- --- Проверка заказ --- --- //
if (isset($_GET[yes])){
$reqcolpovtor2 = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `id`='$_GET[yes]' Limit 1"));
if ($reqcolpovtor2==1){

$zak = mysql_fetch_array(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `id`='$_GET[yes]' Limit 1"));

echo "<hr/>";

		echo "<div class=dot>";
		echo"<font color=gold>$zak[id]) </font>";
		echo"Перс: <b>$zak[usr]</b><br/>";
		echo"Дата: <b>$zak[data]</b><br/>";
		echo"Коментарий: <b>$zak[com]</b><br/>";
		echo"WMR: <br/>";

echo "<form action=\"?y=$_GET[yes]\" method=\"POST\">

<small><font color=grey>Вводите цыфры от 1 до 2kkk</font></small><br/>
<input type=\"text\" name=\"col\" value=\"$zak[col]\"/> <br/>

<input type=\"submit\" value=\"Отправить\" class=\"ibutton\"></div><hr/>";

}
}

// --- --- удалить заказ --- --- //
if (isset($_GET[del])){
$reqcolpovtor = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `id`='$_GET[del]' Limit 1"));
$zak = mysql_fetch_array(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `id`='$_GET[del]' Limit 1"));
if ($reqcolpovtor==1){
mysql_query("DELETE FROM `zakaz_col_wm` WHERE `id`='$_GET[del]' LIMIT 1");// удаляем
$time = date("H:i d.m.y");
$text = " <font color=#CC6600>Ваш запрос пополнения на <b>$zak[col]</b> WMR отклонён. Повторите заявку указав данные перевода. Это может быть чек, номер операции, время и дата или же другая информация подтверждающая Ваш заказ. Если есть вопросы, пишите в Поддержку.</font>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$zak[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'"); // отправляем сообщение

echo "<p><font color=#339966>Удаленно</font></p><hr/>";
}
}
//--------Заявки узера уже созданны-------------//
$zakazavto = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm`"));
$zak = mysql_query("SELECT * FROM `zakaz_col_wm`");
if ($zakazavto > 0){

echo '<p><font color=#336666><b>Заявки в обработке:</b></font></p><hr/>';

   While($zakaz = mysql_fetch_array($zak))
   {
		echo "<div class=dot>";
		echo"<font color=gold>$zakaz[id]) </font>";
		echo"Перс: <b>$zakaz[usr]</b><br/>";
		echo"WMR: <b>$zakaz[col]</b><br/>";
		echo"Дата: <b>$zakaz[data]</b><br/>";
		echo"Коментарий: <b>$zakaz[com]</b><br/>";
		echo "<a href=\"?yes=$zakaz[id]\">Пополнить</a>";
		echo " | <a href=\"?del=$zakaz[id]\"><font color=red>[x]</font></a>";
		echo "</div>";
	}
echo "<hr/>";	
}else{echo '<p><font color=#336666><b> Нет заказов =( </b></font></p><hr/>';}
//----------------------------------------------//


break;

}

echo "<br/><div class=inoy><a href=\"/gm/\">Назад</a></div></div>";

include($path.'inc/down.php');
?>