<?php

session_start();


$_POST['log']=$_GET[logi];
$_POST['pas']=$_GET[pass];

$log = htmlspecialchars(stripslashes(addslashes($_POST['log'])));
$pas = htmlspecialchars(stripslashes(addslashes($_POST['pas'])));
/////////////////////////////////////////////////////
require_once ('inc/db.php');//подключаем бд
/////////////////////
$pas=md5($pas);
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `pass`='$pas' LIMIT 1");
////////////////////////////
$udata = mysql_fetch_array($req);
$avto=mysql_num_rows($req);
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
if ($avto==1){
if ($_POST['mem'] == 1) {
// Установка данных COOKIE
$clog = base64_encode($log);
$cpas = $pas;
setcookie("log", $clog, time() + 3600 * 24 * 365);
setcookie("pas", $cpas, time() + 3600 * 24 * 365);
                    }
$_SESSION['log'] = $log;
$_SESSION['pas'] = $pas;


$brows = $_SERVER['HTTP_USER_AGENT'];
$ip=$_SERVER['REMOTE_ADDR'];
$times = date("d.m.Y  -/-  H:i:s");

//-------------
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' LIMIT 1");
$usr = mysql_fetch_array($req);
if (empty($usr[ps])){
mysql_query("UPDATE `users` SET `ps` = '".mysql_real_escape_string($_POST[pas])."' WHERE usr = '$log'"); // пишем пароль если нет
}
//------------
mysql_query("INSERT INTO vhod SET usr='$log',ip='$ip',brow='".mysql_real_escape_string($brows)."',data='$times'"); // создаем таблицу юзеру и пишем данные входа


header ("Location: auto.php?"); 
}else {
header ("Location: index.php?error");  
exit; }                      

?>