<?php

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
    $path='../';            //
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if ($udata[dostup]>4){

switch($_GET[mod]){
default:
$req1 = mysql_query("SELECT * FROM `aluko`");
$aluko = mysql_fetch_array($req1);

case 'respown':
if(isset($_POST['submit'])){
$health=htmlspecialchars($_POST['health']);
$max_health=htmlspecialchars($_POST['max_health']);


$time = date("H:i"); 
$msg = "<font color=red><b>Самое сильное существо ожило! Хватай оружие и сражайся!</b></font>";
mysql_query("INSERT INTO komentarai SET nick = 'Система', komentaras = '$msg', kada = '$data', time = '$time'");

mysql_query("UPDATE `aluko` SET
`health` = '".$health."',
`max_health` = '".$max_health."'
WHERE `id` = '1'");
echo" Донат раздел успешно отредактирован.";
header('Location: ?');
exit();
 }
echo "<form action='/gm/red_aluk.php?mod=respown' method='post'>";
echo"<div class='slot_menu' style='width: 77%;'>HP Валакаса: <br><input type = 'text' name = 'health' value='".$aluko['health']."'><br/><br/>";
echo "</div><div class='slot_menu' style='width: 77%;'>MaX HP Валакаса: <br><input type = 'text' name = 'max_health' value='".$aluko['max_health']."'><br/>";
echo "</div><br/><input type='submit' name='submit' value='Возродить'/></form><br/>";
break;
}
}else{

echo "Ошибка, Доступ закрыт!";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>