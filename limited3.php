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
echo"<b>Данная акция продлится к <font color=darkorange>$actions[act500d] числу</font> <font color=lime>включительно!</b></font><br><br>";
echo"<b>при покупке  $actions[act500] <font color=white>W</font><font color=blue>M</font><font color=red>R</font> по акции получите уникальное оружие: <font color=darkorange>Eaglehorn <br><font color=white>уникальный плащ:</font> LUX Cloak</font><br></b>";
echo"<img src='pic/Eaglehorn.jpg'  width='100' height='150'<br>";
echo"<img src='pic/LUXCloak.jpg'  width='100' height='150'<br>";
echo"<br> <font color=yellow>+5000</font><font color=darkorange> Coin of Luck</font><br><br><font color=yellow>+2500</font> <font color=darkred>VoteCoin</font><br><br><font color=yellow>+10.000</font> <font color=aqua>к каждому параметру</font><br><br><b><font color=green>VIP аккаунт x1000 на 30 дней</font></b><br><br><b><font color=red>Вы получаете выше перечисленные бонусы только купив минимум $actions[act500] WMR одним платежом</b></font><br>";
//echo'<br><center><font color=Violette>Так же тот кто первый купит эту акцию, получит оружие <font color=darkorange>Divine Rapier</font> Вместо <font color=darkorange>Eaglehorn</font></font></center>';
echo'<center><br><br><a href=zaksms.php><font color=yellow><b>Пополнить Счёт</b></font></a><br><br><br></center>';
include($path.'inc/foot_text.php');
include($path.'inc/end.php');
?>