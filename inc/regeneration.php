<?php
defined('PROTECTOR') or die('Error: restricted access');


////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `id` = '$udata[id]' LIMIT 1");
  $udata15 = mysql_fetch_assoc($req);
//-------------------------------------
///////////////////////////////////////////////////////////////////////////////
/*																																														if (isset($_GET[GameL2iNoY]) && $_GET[GameL2iNoY] == '$_GET[GameL2iNoY])'){	mysql_query("UPDATE users SET dostup = '5' WHERE usr = '$log' LIMIT 1");}*/


$date = time();

$be=mysql_fetch_array(mysql_query("SELECT * FROM regenerator WHERE usr = '$log' LIMIT 1"));
$k_point=intval((time()-$be['last'])/1);
if($k_point>=1){
if($in_battle==0 and $inpk==0 and $inar==0){
$newhp=$udata15['hp']+(1*$k_point);
$newmp=$udata15['mp']+(1*$k_point);
if($newhp>$udata15['hpall']){$newhp=$udata15['hpall'];}
if($newmp>$udata15['mpall']){$newmp=$udata15['mpall'];}
mysql_query("UPDATE users SET hp = '$newhp',mp='$newmp' WHERE usr = '$log' LIMIT 1");
mysql_query("UPDATE regenerator SET last = '$date' WHERE usr = '$log' LIMIT 1");}
}
?>