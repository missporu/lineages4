<?
defined('PROTECTOR') or die('Error: restricted access');
////////////////	AntiDdoss	//////////////////
include $_SERVER['DOCUMENT_ROOT'].'/inc/antiddos.php';
//////////////////////////////////////////////////
include $_SERVER['DOCUMENT_ROOT'].'/inc/gzips.php';
session_start();
$db_host = "localhost";
$db_user = "misspo";
$db_table = "misspo";
$db_pass = "12345";
$connect = @mysql_pconnect($db_host, $db_user, $db_pass) or die('Нет подключения к серверу.');
@mysql_select_db($db_table) or die('Нет соединения с БД.');
@mysql_query("SET NAMES 'utf8'", $connect);
##################### Класс борьбы с SQL атаками ################
include($path.'inc/sql.php');
$stop_injection = new InitVars();
$stop_injection->checkVars();
##################### Класс борьбы с SQL атаками ################
?>