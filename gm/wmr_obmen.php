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
if (isset($_GET[pers])){

$usr = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `usr`='$_GET[pers]' Limit 1"));

$almplus = round($usr[wmr]/400); // скоко начисляем
$wmr = $usr[wmr]-$almplus*400; // выщитуем остачу
$almaz = $usr[almaz]+($almplus*10); // плюсуем скоко получил к скоко есть
if ($wmr<0){$wmr=0;}

mysql_query ("UPDATE users SET almaz='$almaz', wmr='$wmr'  WHERE usr='$_GET[pers]' LIMIT 1"); // пишем данные игрока с новой суммой

echo '<p><font color=#99CC66><b> Готово </b></font></p><hr/>';


}
break;

}

echo "<br/><div class=inoy><a href=\"/gm/\">Назад</a></div></div>";

include($path.'inc/down.php');
?>