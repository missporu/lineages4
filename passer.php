<?
define('PROTECTOR', 1);
$headmod = 'changenick';//фикс. места
$textl='Смена ника';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if($udata['dostup']==5){
if(!isset($_POST['ok'])){
echo'<div class="error">Сменить пароль</div>';
echo'<form action="" method="POST">Аккаунт:<br/>
<input type="text" class="form" class="input" name="account" maxlength="30" value="" size="20" maxlength="50" /><br/>
<form action="" method="POST">Пароль:<br/>
<input type="text" class="form" class="input" name="password" maxlength="30" value="" size="20" maxlength="50" /><br/><br/>
<input name="ok" type="submit" class="button" value="Восстановить" /><br/>';
}else{
$nick = mysql_real_escape_string($_POST['account']);
$pass = md5($_POST['password']);
mysql_query("UPDATE `account` SET `pass` = '".$pass."' WHERE `nick` = '".$nick."' ");
echo'<div class="slot_menu">Пароль успешно изменен</div>';
}
}
include($path.'inc/down.php');
?>

