<?php

$headmod = 'karma';//фикс. места

$textl='Карма';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

$nick=$_GET[usr];
$nick = htmlspecialchars(stripslashes($nick));

$req = mysql_query("SELECT `id` FROM `users` WHERE `usr` = '$nick'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto=="0"){
echo'Нет такого игрока!';
include($path.'inc/down.php');exit;
}
$usdata = mysql_fetch_array($req);

$req = mysql_query("SELECT * FROM `karma` WHERE `usr` = '$nick' and `from`='$log' LIMIT 1");
$avto=mysql_num_rows($req);
if($avto==1 or $udata[lvl]<101 or $log==$nick){
echo'Невозможно увеличить карму, возможно вы голосовали за этого игрока! Либо вы ниже 101 лвл!';
include($path.'inc/down.php');exit;
}

mysql_query("INSERT INTO
        `karma` SET
        `usr` = '$nick',
        `from` = '$log'");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$nick', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Ваш рейтинг поднял(а) $udata[usr]' ");
echo"Вы увеличели карму у игрока $nick!<br/>";
echo"<a href=\"search.php?nick=$nick&amp;go=go\">Назад</a>";

include($path.'inc/down.php');
?>