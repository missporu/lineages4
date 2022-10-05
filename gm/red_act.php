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
$req1 = mysql_query("SELECT * FROM `action_donat`"); 
$actions = mysql_fetch_array($req1); 

case 'donat':
if(isset($_POST['submit'])){
$act100=htmlspecialchars($_POST['act100']); 
$act300=htmlspecialchars($_POST['act300']); 
$act300d=htmlspecialchars($_POST['act300d']);
$act500=htmlspecialchars($_POST['act500']);
$act500d=htmlspecialchars($_POST['act500d']);


mysql_query("UPDATE `action_donat` SET `act100` = '".$act100."',
                                        `act300` = '".$act300."',
`act300d` = '".$act300d."',
                                        `act500` = '".$act500."',
`act500d` = '".$act500d."' WHERE `id` = '1'");
echo" Донат раздел успешно отредактирован.";
header('Location: ?');
exit();
 }
echo "<form action='/gm/red_act.php?mod=donat' method='post'>";
echo"<div class='slot_menu' style='width: 77%;'>Набор новичка (100): <br><input type = 'text' name = 'act100' value='".$actions['act100']."'><br/><br/>";
echo "</div><div class='slot_menu' style='width: 77%;'>Акция (300): <br><input type = 'text' name = 'act300' value='".$actions['act300']."'><br/>";
echo "Число (300): <br><input type = 'text' name = 'act300d' value='".$actions['act300d']."'<br/>";
echo "</div><div class='slot_menu' style='width: 77%;'>Акция (500): <br><input type = 'text' name = 'act500' value='".$actions['act500']."'><br/>";
echo "Число (500): <br><input type = 'text' name = 'act500d' value='".$actions['act500d']."'><br/>";
echo "</div><br/><input type='submit' name='submit' value='Сохранить'/></form><br/>";
break;
}
}else{

echo "Ошибка, Доступ закрыт!";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>