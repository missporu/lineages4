<?php
define('PROTECTOR', 1);
 
$textl='Бонус при Покупке';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/regfunc.php');
include($path.'inc/zag.php');
$req1 = mysql_query("SELECT * FROM `action_donat`"); 
$actions = mysql_fetch_array($req1);
echo"<b>при покупке $actions[act100] <font color=white>W</font><font color=blue>M</font><font color=red>R</font> по акции получите уникальное оружие: <font color=darkorange>VIP Dragon Grinder <br><font color=white>уникальный доспех:</font> VIP Sealed Dark</font><br></b>";
echo"<img src='pic/donart.jpg'  width='100' height='150'<br>";
echo"<img src='pic/donarts.jpg'  width='100' height='150'<br>";
echo"<br> <font color=yellow>+500</font><font color=darkorange> Coin of Luck</font><br><br><font color=yellow>+300</font> <font color=darkred>VoteCoin</font><br><br><font color=yellow>+1000</font> <font color=aqua>к каждому параметру</font><br><br><b><font color=green>VIP аккаунт x50 на 30 дней</font></b><br><br><b><font color=red>Вы получаете выше перечисленные бонусы только купив минимум $actions[act100] WMR</b></font><br><br/>";
include($path.'inc/foot_text.php');
include($path.'inc/end.php');
?>