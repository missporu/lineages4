<?
session_start();
// Подключаемся к БД
$dbhost="localhost";
$dbname="l2warmobi_server";
$dbuser="l2warmobi_server";
$dbpass="200990";
$lin=mysql_connect($dbhost,$dbuser,$dbpass) or die("Не могу подключиться к серверу БД");
mysql_select_db($dbname,$lin) or die("Не могу подключиться к БД");
mysql_query("SET NAMES utf8");
mysql_query("set character_set_client='utf8'");
mysql_query("set character_set_results='utf8'");
mysql_query("set collation_connection='utf8'");
// Делаем проверку на существование акаунта
$password = md5($password);
$g=mysql_query("SELECT * FROM `account` WHERE `account`='$account' AND `password`='$password' LIMIT 1");
if(mysql_num_rows($g)==1){

if ($saver=="ok"){
SetCookie("account","$account",time()+3600*24*1000);
SetCookie("password","$password",time()+3600*24*1000);
SetCookie("login","");
}else{
SetCookie("account","$account");
SetCookie("password","$password");
SetCookie("login","");
}

header("Location: zals?");
}else{

header("Location: index?error");
}