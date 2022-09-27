<?
define('PROTECTOR', 1);

include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');


/////////место
$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
////////////////////////////
$mestouser = mysql_fetch_array($req);
if($mestouser[city]==1){
/////////место
$req = mysql_query("SELECT incity FROM `world` WHERE `city` = '$udata[city]' and `x`='$mestouser[x]' and `y`='$mestouser[y]' LIMIT 1");
////////////////////////////
$world = mysql_fetch_array($req);
}

mysql_query("UPDATE `mesto` SET `city` = '0',`page` = '0' WHERE `usr` = '$log'");     
header("Location: gorod.php?");exit;
?>
