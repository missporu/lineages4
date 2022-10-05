<?php

$headmod = 'bank';//фикс. места

$textl='Банк';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
place_okr();
place_zamok();
place_tower();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


$d = time();
$r=rand(1,10);
$req = mysql_query("SELECT * FROM `bank` WHERE `usr` = '$log'");
$avto=mysql_num_rows($req);
if($avto>=1){
$bank = mysql_fetch_array($req);
}
function perc(){
global $log,$d,$pas,$udata,$bank;
if(!empty($bank[usr])){
if($bank[money]<100000){$stavka=1.15;}
if($bank[money]>=100000){$stavka=1.10;}
if($bank[money]>=5000000){$stavka=1.09;}
if($bank[money]>=10000000){$stavka=1.08;}
if($bank[money]>=25000000){$stavka=1.07;}
if($bank[money]>=50000000){$stavka=1.06;}
if($bank[money]>=200000000){$stavka=1.05;}
if($bank[money]>=500000000){$stavka=1.04;}
if($bank[money]>=1000000000){$stavka=1.003;}
if($bank[money]>5000000000){$stavka=1.001;}
if($d>=($bank[ltime]+84600)){
$aden=($bank[money]*$stavka)-$bank[money];
$bank[money]=round($bank[money]*$stavka);
mysql_query("UPDATE `bank` SET `money` = '".mysql_real_escape_string($bank[money])."',`ltime`='".mysql_real_escape_string($d)."' WHERE `usr` = '$log'");
$time = date("H:i:s/d.m.y");
$aden=number_format($aden);
mysql_query("INSERT INTO admin_log SET usr='$log',text='$time - Игрок <a href=\"search.php?&amp;nick=$log&amp;go=go\">$log</a> получил проценты с счёта в банке $aden аден', why='bank'");
echo"<br><b><font color=lime>Вам начислены проценты с вашего счёта!</font> <font color=orange>$aden Аден</font></b><br/>";
echo"<a href=\"bank.php?r=$r\">Продолжить</a>";
include('inc/down.php');exit;
}
}
}
switch($_GET[mod]){

default:
echo" <center><img src='/pic/roz/bank.jpg'  width='284' height='130' alt='' style='margin-right:10px;border:1px solid #383838' class='dot'></div><hr/>";

if(empty($bank[usr])){
echo"<b><font color=red>Вы неявляетесь клиентом банка!<br>
Стартовый взнос 10 Аден!<br/></font></b><hr/>";
}else{
perc();
$timedo=(($bank[ltime]+84600)-$d)/3600;
$timedo=round($timedo);
$bank[money]=number_format($bank[money]);
echo"<b><font color=#007F46>У Вас на счету в банке <b><u>$bank[money]</u></b> Аден! До начисления процентов: $timedo часов<br/></font></b><br>";
}
echo "<form action=\"bank.php?mod=go\" method=\"post\">";
echo '<b>Операция:</b><br/>';

echo '<input name="gold"/><br/>';
echo '<select name="oper" value="2">';
echo '<option value="1">Снять</option><option value="2">Положить</option>';
echo '</select><br/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';


echo"<br/><div class=inoy><a href=\"bank.php?mod=send\">Перевод Аден</a>";
echo"<a href=\"bank.php?mod=sendcol\">Перевод Coin of Luck</a>";
echo"<a href=\"changer.php\">Обменник</a>";


$req = mysql_query("SELECT * FROM `bank`");
$all_bank=mysql_num_rows($req);
$am=0;
While($sum = mysql_fetch_array($req))
{
$am=$am+$sum[money];
}


echo'<br/><style=margin-right:10px;border:1px solid #383838" class="dot">Всего вкладчиков: '.number_format($all_bank, 0, ',', "`").'</div>';
if ($udata[dostup]>3) {echo'<br/><style=margin-right:10px;border:1px solid #383838" class="dot">Капитал банка: '.number_format($am, 0, ',', "`").'</div><hr>';}
break;


//-------------Обменник Аден на Col----------------------




case 'go':
if($_POST[oper]==1){
if(empty($bank[usr])){
echo'Вы неявляетесь клиентом банка!<br/>';
}else{
if($_POST[gold]<=0 or ($bank[money]-$_POST[gold])<10){
echo'Ошибка, введена неверная сумма!В банке должно остаться не меньше 10 Аден!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

$udata[money]=$udata[money]+$_POST[gold];

if($udata[money] > 999999999999999999999999999){
echo'<p>Вы не можете взять с собой более 1 000 000 000 Аден !</p><br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}


$bank[money]=$bank[money]-$_POST[gold];
mysql_query("UPDATE `bank` SET `money` = '$bank[money]',`ltime`='$d' WHERE `usr` = '$log'");

mysql_query("UPDATE `users` SET `money` = '$udata[money]' WHERE `usr` = '$log'");
echo"
Вы забрали с банка: <b>$_POST[gold] Аден</b><br/>
";
}
}else
if($_POST[oper]==2){
if($_POST[gold]<=0 or ($udata[money]-$_POST[gold])<0 or is_numeric($_POST[gold])==FALSE){
echo'Ошибка, введена неверная сумма! Возможно у вас таких денег нет!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
if(empty($bank[usr])){
if($_POST[gold]<10 or $_POST[gold] > 9999999999999999999999999){
echo'Первый взнос должен быть не меньше 10 и не более 9 000 000 000 Аден !<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
$udata[money]=$udata[money]-$_POST[gold];
mysql_query("UPDATE `users` SET `money` = '$udata[money]' WHERE `usr` = '$log'");
mysql_query("INSERT INTO bank SET usr='$log',money='$_POST[gold]',ltime='$d'");
echo"
Поздравляеем вы стали клиентом банка! Ваш первый взнос составил: <b>$_POST[gold]</b><br/>
";
}else{
$bank[money]=$bank[money]+$_POST[gold];
$udata[money]=$udata[money]-$_POST[gold];

if($bank[money] > 9999999999999999999999999999){
echo'Вы не можете положить более 9 000 000 000 Аден !<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}


mysql_query("UPDATE `users` SET `money` = '$udata[money]' WHERE `usr` = '$log'");

mysql_query("UPDATE `bank` SET `money` = '$bank[money]',`ltime`='$d' WHERE `usr` = '$log'");
echo"
Ваш взнос составил: <b>$_POST[gold] Аден</b><br/>
";
}
}else{
echo'Ошибка!<br/>';
}
echo"<a href=\"bank.php?\">Назад</a>";
break;

/////////////////////////////////////////////// перевод колов
case 'sendcol':
if(empty($_GET[act])){

echo "<font color=#007F46>Адена и Coin of Luck списуются с Вашего лицевого счёта и добовляются игроку на лецевой счёт! <hr/></font>";

echo "<font color=grey>Перевод Coin of Luck:</font><br/><small><font color=grey></font></small>";
echo "<form action=\"bank.php?mod=sendcol&amp;act=go\" method=\"post\">";

echo '<b>Кому:</b><br/>';
echo '<input name="komu"/><br/>';
echo '<b>Сколько:</b><br/>';
echo '<input name="gold"/><br/>';

echo '<input type="submit" value="Перевести"/></form>';
echo"<font color=lime> Стоимость перевода 1 Coin of luck составляет 150`000  Аден.</font><br/><br/>";

}elseif($_GET[act]==go){
if($_POST[komu]==$log){
echo'Себе передавать Coin of Luck нельзя!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

if($udata[lvl]<150){
echo'Передавать Coin of Luck можно с 150 уровня!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}


if($_POST[gold]<=0.999999999999999999999999999 or ($udata[almaz]-$_POST[gold])<0  or is_numeric($_POST[gold])==FALSE){
echo'Ошибка, введена неверная сумма! Возможно у вас на счету таких денег нет!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

if($_POST[gold]*150000 > $udata[money]){
echo'Недостаточно Аден для перевода!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}


$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$_POST[komu]'");
$avto=mysql_num_rows($req);
if($avto==0){
echo'Получатель не существует!<br/>';
}else{
$ubank = mysql_fetch_array($req);
$ubank[almaz]=$ubank[almaz]+$_POST[gold];
$udat[almaz]=$udata[almaz]-$_POST[gold];
$udat[money]=$udata[money]-$_POST[gold]*150000;

$_POST[gold] = number_format($_POST[gold], 0, ',', "`");

$time = date("H:i d.m.y");
$text = " Игрок <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> перевёл вам  $_POST[gold] Coin of Luck.";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$_POST[komu]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


$text = "[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> передал игроку <a href=\"/search.php?nick=$_POST[komu]&amp;go=go\">$_POST[komu]</a> $_POST[gold] Coin of Luck . ";

$timelog = date("H:i");
$datelog = date("d.m.y");

mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text`)VALUES (NULL , 'kol', '$text')");


mysql_query("UPDATE `users` SET `almaz` = '$ubank[almaz]' WHERE `usr` = '$_POST[komu]'");
mysql_query("UPDATE `users` SET `almaz` = '$udat[almaz]', `money` = '$udat[money]' WHERE `usr` = '$log'");

echo"<p><b><font color=grey>Вы перевели $_POST[gold] Coin of Luck игроку $_POST[komu]!</b></p>";

}
}else{
echo'Ошибка!<br/>';
}
echo"<a href=\"bank.php?\">Назад</a>";
break;
//////////////////////////////////////////////////////////////


case 'send':
if(empty($_GET[act])){

echo "<font color=#007F46>Адена списуется с Вашего счёта Банка и начисляется игроку на счёт Банка, при этом игрок должен являтся его клиентом. <hr/></font>";

echo "<form action=\"bank.php?mod=send&amp;act=go\" method=\"post\">";
echo '<b>Кому:</b><br/>';

echo '<input name="komu"/><br/>';
echo '<b>Сколько:</b><br/>';
echo '<input name="gold"/><br/>';

echo '<input type="submit" value="Продолжить"/></form>';
}elseif($_GET[act]==go){
if($_POST[komu]==$log){
echo'Себе передавать Адену нельзя!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
if($_POST[gold]<=0 or ($bank[money]-$_POST[gold])<=0  or is_numeric($_POST[gold])==FALSE){
echo'Ошибка, введена неверная сумма!Возможно у вас на счету таких денег нет!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
if(empty($bank[usr])){
echo'Вы неявляетесь клиентом банка!<br/>';
echo"<a href=\"bank.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
$req = mysql_query("SELECT * FROM `bank` WHERE `usr` = '$_POST[komu]'");
$avto=mysql_num_rows($req);
if($avto==0){
echo'Получатель неявляется клиентом банка!<br/>';
}else{
$ubank = mysql_fetch_array($req);
$ubank[money]=$ubank[money]+$_POST[gold];
$bank[money]=$bank[money]-$_POST[gold];

mysql_query("UPDATE `bank` SET `money` = '$ubank[money]' WHERE `usr` = '$_POST[komu]'");
mysql_query("UPDATE `bank` SET `money` = '$bank[money]' WHERE `usr` = '$log'");

$_POST[gold] = number_format($_POST[gold], 0, ',', "`");

$time = date("H:i d.m.y");
$text = " Игрок <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> перевёл вам  $_POST[gold] Аден.";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$_POST[komu]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");

$text = "[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> передал игроку <a href=\"/search.php?nick=$_POST[komu]&amp;go=go\">$_POST[komu]</a> $_POST[gold] Аден. ";


$timelog = date("H:i");
$datelog = date("d.m.y");


mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text` )VALUES (NULL , 'money', '$text')");


echo"<p><b><font color=grey>Вы перевели $_POST[gold] Аден игроку $_POST[komu]!</b></p>";
}
}else{
echo'Ошибка!<br/>';
}
echo"<a href=\"bank.php?\">Назад</a>";
break;
}
include($path.'inc/down.php');
?>