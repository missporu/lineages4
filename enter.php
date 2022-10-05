<?php

session_start();




$log = htmlspecialchars(stripslashes(addslashes($_POST['log'])));
$pas = htmlspecialchars(stripslashes(addslashes($_POST['pas'])));

require_once ('inc/db.php');

$pas=md5($pas);

if(is_numeric($_POST['log'])) {
$log=abs(intval($_POST['log']));
$persi = mysql_fetch_assoc(mysql_query("SELECT * FROM `account` WHERE `id`='".$log."'"));
$log=$persi['nick'];
}

$req = mysql_query("SELECT * FROM `account` WHERE `nick` = '".$log."' and `pass` = '".$pas."' LIMIT 1");

$udata = mysql_fetch_assoc($req);
$avto = mysql_num_rows($req);


if ($avto==1){
if ($_POST['mem'] == 1) {

$clog = $log;
$cpas = $pas;
setcookie("nick", $clog, time() + 3600 * 3);
setcookie("password", $cpas, time() + 3600 * 3);
                    }
$_SESSION['nick'] = $log;
$_SESSION['password'] = $pas;


$brows = $_SERVER['HTTP_USER_AGENT'];
$ip=$_SERVER['REMOTE_ADDR'];
$times = date("d.m.Y  -/-  H:i:s");



$usr =  mysql_fetch_assoc(mysql_query("SELECT * FROM `account` WHERE `nick` = '".$log."' LIMIT 1"));



mysql_query("INSERT INTO vhod SET usr='".$log."',ip='".$ip."',brow='".mysql_real_escape_string($brows)."',data='".$times."'"); // создаем таблицу юзеру и пишем данные входа


header ("Location: office.php?"); 
}else {
header ("Location: index.php?error");

exit; }                      

?>