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

///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////
if ($udata[dostup]>1){
switch($_GET[p]){
default:
echo "<form action=\"?&amp;p=poisk\" method=\"post\"><small>Ввдите ник игрока:</small><br/>";
echo "<input name=\"nick\" type=\"text\" maxlength=\"10\" value=\"$nick\" title=\"nick\"/><br/>";
echo '<input type="submit" value="OK" /></form>';

break;
case 'poisk':

$zah = mysql_real_escape_string($_POST[nick]);

$usra = mysql_query("SELECT * FROM `users` WHERE `usr`='$zah' ");
$usr = mysql_fetch_array($usra);

echo"<div class=dot>IP юзверя $zah = <a href=\"?&amp;p=poisk_ip&ip=$usr[ip]&nick=$los\">$usr[ip] </a></div>";

break;

case 'poisk_ip';

$nick=$_GET['nick'];

echo"<div class=dot>Персонажи у которых схожие IP с игроком $nick :</div>";

$ip = mysql_real_escape_string($_GET[ip]);
 $pr_q=mysql_query("SELECT * FROM users WHERE `ip`='$ip'");
 while($prss=mysql_fetch_array($pr_q))
 echo "<div class=inoy><a href=\"search.php?&amp;nick=".$prss['usr']."&go=go\">".$prss['usr']." </a></div>";
break;

}
}else{
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>