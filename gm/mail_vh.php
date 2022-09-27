<?
define('PROTECTOR', 1);

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
	$path='../';			//
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

if($udata[dostup] == 5){
$times = date("H:i");
$display = 10;
$my_page = abs(intval($_GET['p']));
if(!$my_page || $my_page < 1){ 
$my_page = 1; 
}
$start = ($my_page-1)*$display;

$message = mysql_query("SELECT * FROM msg_r ORDER BY id DESC LIMIT $start, $display");
while($msg = mysql_fetch_assoc($message))
{
$text = $msg['mail_msg'];
$text = strip_tags($text);
$from = strip_tags($msg['user_from']);
$to = strip_tags($msg['user_to']);
echo'<div class="slot_menu">';
echo "От <a href=\"/search.php?&amp;nick=$from&go=go\">$from</a>|
Кому <a href=\"/search.php?&amp;nick=$to&go=go\">$to</a>
($msg[time])<br> $text</div>";
}

$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r`"),0);
;
checkin::display_pagin($my_page, $all_posts, 'mail_vh.php?p='); 
}else{
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}



include($path.'inc/down.php');
?>