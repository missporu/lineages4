<?
define('PROTECTOR', 1);

$textl='Инвентарь';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


if(empty($_GET[id])){
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `tip`='".mysql_real_escape_string($_GET[tip])."' and `image`='yes'");
}else{
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `tip`='".mysql_real_escape_string($_GET[tip])."' and `image`='yes' and `id`='".mysql_real_escape_string($_GET[id])."'");
}
$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка, на вас ничего не одето!';
include($path.'inc/down.php');
exit;
}


//if ($udata[dostup]==5){//тест создателя
//---------------пишем пропадает баф когда снмают шмот-------//
//$req1 = mysql_query("SELECT * FROM `baf` WHERE `usr` = '$log' LIMIT 1");
$avto1=mysql_num_rows($req1);
//if($avto1>0){
$timebaf = time()+1; // 
//mysql_query("UPDATE `baf` SET `time` = '$timebaf'  WHERE usr = '$log'");}
//-----------------------------------------------------------//
//}
$mag = mysql_fetch_array($req);

$npatt=$udata[patt]-$mag[patt];
$nmatt=$udata[matt]-$mag[matt];

$npdef=$udata[pdef]-$mag[pdef];
$nmdef=$udata[mdef]-$mag[mdef];


mysql_query("UPDATE `users` SET
         `pdef` = '$npdef',
         `mdef` = '$nmdef',
         `patt` = '$npatt',
         `matt` = '$nmatt'
          WHERE usr = '$log'");
          
if(empty($_GET[id])){
mysql_query("UPDATE item SET image = 'not' WHERE `usr` = '$log' and `tip`='".mysql_real_escape_string($_GET[tip])."' and `image`='yes'");
}else{
mysql_query("UPDATE item SET image = 'not' WHERE `usr` = '$log' and `tip`='".mysql_real_escape_string($_GET[tip])."' and `image`='yes' and `id`='".mysql_real_escape_string($_GET[id])."'");
}
header ('Location: pers.php?act=shmot',false);

include($path.'inc/down.php');
?>