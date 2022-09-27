<?
define('PROTECTOR', 1);
$headmod = 'historynick';//фикс. места
$textl='История смены ника';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
$id=abs(intval($_GET['id']));

if(empty($id)){
echo '<div class="error">Не выбран пользователь!</div>';
include($path.'inc/down.php');
exit;}

$user=mysql_query("SELECT * FROM `users` WHERE `id` = '$id' ");
echo'<div class="slot_menu">История ников '.$user['usr'].'</div>';
$times = date("H:i");$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;
$asd = mysql_query("SELECT * FROM nick_history WHERE `id_user` = '$id' ORDER BY id DESC LIMIT $start,$display");
while($dsa = mysql_fetch_array($asd))
{
$old_nick = strip_tags($dsa['old_nick']);
$nick = strip_tags($dsa['nick']);
$time = checkin::sec2day(time()-$dsa['time']);
echo'<div class="slot_menu"><font color= #8B0000>'.get_user($old_nick).'</font> -> <font color = #008000>'.get_user($nick).'</font> ('.$time.' назад)</div>';
}
$all_posts = mysql_num_rows(mysql_query("SELECT COUNT(*) FROM `nick_history`"));
checkin::display_pagin($my_page, $all_posts, 'historynick.php?p=');

include($path.'inc/down.php');
?>


