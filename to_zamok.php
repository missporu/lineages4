<?php

include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');

/////////место
$req = mysql_query("SELECT * FROM `out` WHERE `usr` = '$log' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
header("Location: gorod.php?");exit;
}
if(empty($udata[clan])){
$textl='Замок';
require_once'inc/head.php';
require_once'inc/zag.php';
echo"Вход в замок доступен только воинам в кланах!";
include_once"inc/down.php";exit;
}
$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
////////////////////////////
$mestouser = mysql_fetch_array($req);

$req = mysql_query("SELECT * FROM `zamok` WHERE `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$city = mysql_fetch_array($req);
if($city[clan]!='not' and $city[clan]!=$udata[clan]){
$req = mysql_query("SELECT * FROM `clanwar` WHERE `clan` = '$city[clan]' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==0){

$time=time()+60;

mysql_query("INSERT INTO
        `clanwar` SET
        `clan` = '$city[clan]',
        `timeout` = '$time'");
}
}
if($city[clan]==$udata[clan]){
$req = mysql_query("SELECT * FROM `clanwar` WHERE `clan` = '$city[clan]' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
mysql_query("DELETE FROM `clanwar` WHERE clan='$city[clan]'");//чистим логи
}
}
if($mestouser[city]==0){
mysql_query("UPDATE `mesto` SET `city` = '2' WHERE `usr` = '$log'");
del_log($lpl='zamok');
header("Location: zamok.php?");exit;
}else{
ryd();
place_city();
place_okr();
place_zamok();
place_tower();
}
?>
