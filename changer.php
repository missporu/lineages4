<?php

$headmod = 'changer';//фикс. места
$textl='Обмен';
$path='';
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
$sett = mysql_fetch_array(mysql_query("SELECT * FROM option_game WHERE id = '1'"));

$case=htmlspecialchars(trim($_GET['mod']));
switch($case){
default:
echo'<hr>У Вас '.number($udata['money']).' Аден<hr>';
echo'У Вас '.number($udata['key']).' Ключей<hr>';
echo'У Вас '.number($udata['chkey']).' Осколков<hr>';
echo'У Вас '.number($udata['almaz_blue']).' Blue Coin<hr>';
echo'У Вас '.number($udata['almaz']).' CoL<hr>';

echo'<br/><a href="?mod=adencol">Адену на CoL</a> [Ваш 1 CoL = наши ('.number($sett['adencol']).') аден]<br/>';
echo'<a href="?mod=colexp">Col на Опыт</a> [Ваш 1 CoL = наши ('.number($sett['colexp']).') опыта]<br/>';
echo'<a href="?mod=chkey">Осколки на <img src="pic/pkey.png"></a> [Ваши '.number($sett['chkey']).' Осколков = наши 1 <img src="pic/pkey.png">]<br/>';
echo'<a href="?mod=blue">Col на Blue Coin</a> [Ваши '.number($sett['blue']).' CoL = наши 1 Blue]<br/>';
break;

case'adencol':
if(empty($_POST['aden'])){
echo'Курс обмена 1 CoL = '.number($sett['adencol']).' Аден';
echo "<form action=\"?mod=adencol\" method=\"post\">";
echo"Сколько Вам нужно CoL:<br/>";
echo"<input class='input' type=\"text\" size=\"10\" name=\"aden\" maxlength=\"15\"/><br/>";
echo '<input class="button" type="submit" value="Обменять" /></form>';
}else{
$col = abs(intval($_POST['aden']));
$kol=$col*$sett['adencol'];
if($udata['money']<$kol){
echo'У Вас недостаточно Аден.<br/>
Нужно '.number($kol).'  Аден а не '.number($udata['money']).'.';
include($path.'inc/down.php');
exit;
}
mysql_query("UPDATE `users` SET `almaz` = `almaz` + '".$col."',`money` = `money` - '".$kol."' WHERE `id` = '".$udata['id']."'");
echo'Вы успешно поменяли '.number($kol).' Аден на  '.number($col).' CoL';
echo'<br/><a href="changer.php">Назад</a>';
}
break;


case'chkey':
if(empty($_POST['key'])){
echo'Курс обмена '.number($sett['chkey']).' Осколков = 1 <img src="pic/pkey.png">';
echo "<form action=\"?mod=chkey\" method=\"post\">";
echo"Сколько Вам нужно <img src='pic/pkey.png'><br/>";
echo"<input class='input' type=\"text\" size=\"10\" name=\"key\" maxlength=\"15\"/><br/>";
echo '<input class="button" type="submit" value="Обменять" /></form>';
}else{
$col = abs(intval($_POST['key']));
$kol=$col*$sett['chkey'];
if($udata['chkey']<$kol){
echo'У Вас недостаточно Осколков.<br/>
Нужно '.$kol.'  Осколков а не '.number($udata['chkey']).'.';
include($path.'inc/down.php');
exit;
}
mysql_query("UPDATE `users` SET `key` = `key` + '".$col."',`chkey` = `chkey` - '".$kol."' WHERE `id` = '".$udata['id']."'");
echo'Вы успешно поменяли '.number($kol).' Осколков на  '.$col.' Ключ-(ей)';
}
break;


case'blue':
if(empty($_POST['blue'])){
echo'Курс обмена '.number($sett['blue']).' CoL = 1 Blue Coin';
echo "<form action=\"?mod=blue\" method=\"post\">";
echo"Сколько Вам нужно Blue Coin:<br/>";
echo"<input class='input' type=\"text\" size=\"10\" name=\"blue\" maxlength=\"15\"/><br/>";
echo '<input class="button" type="submit" value="Обменять" /></form>';
}else{
$col = abs(intval($_POST['blue']));
$kol=$col*$sett['blue'];
if($udata['almaz']<$kol){
echo'У Вас недостаточно CoL.<br/>
Нужно '.number($kol).'  CoL а не '.number($udata['almaz']).'.';
include($path.'inc/down.php');
exit;
}
mysql_query("UPDATE `users` SET `almaz_blue` = `almaz_blue` + '".$col."',`almaz` = `almaz` - '".$kol."' WHERE `id` = '".$udata['id']."'");
echo'Вы успешно поменяли '.number($kol).' CoL на  '.number($col).' Blue Coin';
}
break;


case'colexp':
if(empty($_POST['exp'])){
echo'Курс обмена 1 CoL = '.number($sett['colexp']).' Опыта';
echo "<form action=\"?mod=colexp\" method=\"post\">";
echo"Сколько Вы отдаете CoL:<br/>";
echo"<input class='input' type=\"text\" size=\"10\" name=\"exp\" maxlength=\"15\"/><br/>";
echo '<input class="button" type="submit" value="Обменять" /></form>';
}else{
$col = abs(intval($_POST['exp']));
$kol=$col*$sett['colexp'];
if($udata['almaz']<$col){
echo'У Вас недостаточно CoL.<br/>
Нужно '.number($col).'  Col а не '.number($udata['almaz']).'.';
include($path.'inc/down.php');
exit;
}
mysql_query("UPDATE `users` SET `almaz` = `almaz` - '".$col."',`exp` = `exp` + '".$kol."' WHERE `id` = '".$udata['id']."'");
echo'Вы успешно поменяли '.number($col).' CoL на  '.number($kol).' опыта';
}
break;


}
include($path.'inc/down.php');
?>