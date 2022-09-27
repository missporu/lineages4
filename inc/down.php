<?
defined('PROTECTOR') or die('Error: restricted access');

// если игрок в бане чат не выводится
$avto_ban = mysql_num_rows(mysql_query("SELECT * FROM `ban` WHERE `usr` = '$log' LIMIT 1"));
if ($avto_ban == 0) {

// проверяем  не находится ли игрок в чате
$reqpr = mysql_query("SELECT * FROM `mesto` where `usr`='$log' LIMIT 1");
$prov = mysql_fetch_array($reqpr);

$adres = $_SERVER['SCRIPT_NAME'];
$ad = explode("/", $adres);

if ($ad[1]!=="chat" && $ad[1]!=="wm" && $ad[1]!=="gm" && $adres!=="/forum/posting.php" && $adres!=="/forum/index.php" && $adres!=="/forum/topic.php" && $prov[place]!==chat && $prov[place]!==tchat && $prov[place]!==adm_chat){
/////// подключаем чат ///////////////////////

$chat = mysql_fetch_array(mysql_query("SELECT chat FROM `options` where `usr`='$log' LIMIT 1"));
// если нет таблицы чат показует или когда включен
if(empty($chat[chat]) or $chat[chat]==yes) {include($path.'chat2.php');}
}}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


echo'</div></div></div><span style=text-align:center;>';






$foot = mysql_fetch_array(mysql_query("SELECT foot FROM `options` where `usr`='$log' LIMIT 1"));
if (empty($foot[foot]) or $foot[foot]==text){include($path.'inc/foot_text.php');}else{include($path.'inc/foot_pic.php');}





//echo'</div></center>';

include($path.'inc/nogi.php');
include($path.'inc/end.php');


?>







