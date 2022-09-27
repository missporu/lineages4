<?
define('PROTECTOR', 1);
$headmod = 'zayavka';//фикс. места
$textl='Предложения замуж';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
switch($_GET[go]){

default:
$req = mysql_query("SELECT * FROM `zamuj` WHERE `usr` = '$log'");
$inv = mysql_fetch_array($req);
echo"Вам предложил вступить в брак:";echo" <a href=\"search.php?nick=$inv[clan]&go=go\">$inv[clan]</a><br/>";
echo"Текст к Предложению: $inv[text]<br/><br/>";

echo"<a href=\"zayavka.php?go=ok\">Вступить в брак</a><br/>";
echo"<a href=\"zayavka.php?go=no\">Отказаться</a><br/>";
break;

case 'ok':
if(!empty($udata[zamujem])){
echo'Вы уже состоите в браке!';
include"inc/down.php";
exit;
}
$req = mysql_query("SELECT * FROM `zamuj` WHERE `usr` = '$log'");
$inv = mysql_fetch_array($req);
mysql_query("DELETE FROM `zamuj` WHERE usr='$log'");
mysql_query("UPDATE `users` SET `zamujem`='$inv[clan]' WHERE `usr` = '$log'");
mysql_query("UPDATE `users` SET `zamujem`='$log' WHERE `usr` = '$inv[clan]'");
mysql_query("INSERT INTO
        `ya_zamujem` SET
        `usr` = '$log',
`muj` = '$inv[clan]'");
echo"Предложение принято.<br>Поздравляем вас вы заключили брак с: $inv[clan]!<br/>";
break;


case 'no':
mysql_query("DELETE FROM `zamuj` WHERE usr='$log' and `id`='".intval($_GET['id'])."'");
echo"Предложение отклонено.<br/>";
break;





}


include($path.'inc/down.php');
?>