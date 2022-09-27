<?
define('PROTECTOR', 1); 
$textl='Vip 150';
include('inc/path.php');  
include($path.'inc/db.php');  
include($path.'inc/auth.php');  
include($path.'inc/func.php');  
include($path.'inc/core.php');  
include($path.'inc/head.php'); 
include($path.'inc/zag.php');

$req = mysql_query("SELECT * FROM `res` WHERE `lat_name` = 'VIP 150' LIMIT 1");
$res=mysql_num_rows($req);
if($res==0){
echo'У вас нету Вип карты!</br>';
include($path.'inc/down.php');exit;
}
$req1 = mysql_query("SELECT * FROM `vip` WHERE `usr` = '$log' LIMIT 1");
$avto1=mysql_num_rows($req1);
$vip = mysql_fetch_array($req1);
if($avto1>0){
echo'У вас уже активирован VIP x'.$vip[tip].' <br/><b>Закончится через: <font color="red">'._times($vip[time] - time()).'</font></b></br>';
include($path.'inc/down.php');exit;
}
mysql_query("UPDATE `res` SET `kol` = `kol` -1 WHERE `usr` = '$log' and `lat_name` = 'VIP 150'");
$req22 = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `lat_name` = 'VIP 150'");
$res=mysql_num_rows($req22);  
$rs = mysql_fetch_array($req22);
if($nk <= 0){ 
mysql_query("DELETE FROM `res` WHERE `usr` = '$log' and `lat_name` = 'VIP 150' LIMIT 1");
mysql_query("DELETE FROM `res` WHERE `id` = '$rs[id]' LIMIT 1");
}
$times=time()+108000*24;
mysql_query("INSERT INTO 
`vip` SET 
`usr` = '$log', 
`tip` = '150',
`time` = '$times'");
echo' VIP x150 активирован на 30 дней!';
include ($path.'inc/down.php');
?>