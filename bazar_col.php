<?php

$headmod = 'bazar_col';//фикс. места

$textl='Рынок CoL';
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


// проверяем продаёт ли игрок колы

$req = mysql_query("SELECT * FROM `bazar_col` WHERE `usr` = '$log' ORDER BY cena");
////////////////////////////
$avto=mysql_num_rows($req);
if ($avto>=1){
$col = mysql_fetch_array($req);

if ($_GET[mod]==del){


//--------------------------------------------------------------------
//	// 		КАЛЬКУЛЯТОР 		//	//
$nalmaz = $udata[almaz] + $col[col]; // плюсуем колы
//			////////			//	//
//--------------------------------------------------------------------

mysql_query ("UPDATE users SET
        almaz='$nalmaz'
		 WHERE usr='$log' LIMIT 1");
 mysql_query("DELETE FROM `bazar_col` WHERE `usr` = '$log'"); // чистим продажу

echo "<p><b>Рынок Coins of Luck</b><br/>
<font color=grey>Продажа отменена.</font></p><hr/>";	

	echo"<div class=inoy><a href=\"bazar_col.php?\">Продолжить</a></div>";

 
	include($path.'inc/down.php');
exit;

}else{
echo "<b>Рынок Coin of Luck</b><br/>";
echo "Ты продаешь ".number_format($col[col], 0, ',', "`")." Coins of Luck по цене ".number_format($col[cena], 0, ',', "`")." Aден за штуку.";
echo "<hr/><div class=menu><font color=#007F46>Старик:</font><br/>
 <font color=grey>- Ты можешь идти, я послежу за твоими Coin of Luck</font></div><hr/>";	

	echo"<div class=inoy><a href=\"gorod.php?pl=shop_zone\">Уйти в город</a></div>";
	echo"<div class=inoy><a href=\"bazar_col.php?mod=del\">Отменить продажу</a></div>";

	include($path.'inc/down.php');
exit;

}
}



switch($_GET[mod]){

default:
echo"<p><b>Рынок Coin of Luck</p></b> <hr/>";

// список продаж

$req = mysql_query("SELECT * FROM `bazar_col` WHERE `id` != '' ORDER BY cena");
////////////////////////////
$avto=mysql_num_rows($req);
if ($avto>=1){
While($col = mysql_fetch_array($req))
{
echo "<a href=\"bazar_col.php?&mod=by&id=$col[id]\">Купить</a>  ".number_format($col[col], 0, ',', "`")." Coin of Luck у <a href=\"search.php?&nick=$col[usr]&go=go\">$col[usr]</a> по ".number_format($col[cena], 0, ',', "`")." Аден <hr/>";
}
}else{echo "<p>Список продаж не обнаружен!</p><hr/>";}

echo"<div class=inoy><a href=\"bazar_col.php?mod=pr\">Продать Coin of Luck</a>";
echo"<a href=\"zaksms.php?\">Заказать Coin of Luck</a></div>";

break;

/////////////////////Продажа колов//////////////////////////////////////////////////////////
case 'pr';


if(empty($_POST[col]) or $_POST[col]<=0 or $_POST[cena]<=0 or is_numeric($_POST[cena])==FALSE or is_numeric($_POST[col])==FALSE){
echo "<p>Вы хотите продать Coin of Luck. У Вас их <b>".number_format($udata[almaz], 0, ',', "`")."</b> шт.</p><hr/>";
echo '<form action="bazar_col.php?mod=pr" method="post">';
echo"Количество CoL:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"$udata[almaz]\" name=\"col\"/><br/>";

echo"Цена за 1 CoL:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"6000000\" name=\"cena\"/><br/>";

echo '<input class="button" type="submit" value="Продать" /></form>';
					echo"<div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
}else{ // пишем проверку и лог продаж

$req = mysql_query("SELECT * FROM `bazar_col` WHERE `usr` = '$log'");
$avto=mysql_num_rows($req);
if($avto>=1){
echo'Вы уже продаёте Coin of Luck!<br/>';
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
include($path.'inc/down.php');
exit;
}

if($udata[almaz]<$_POST[col]){
echo'У вас недостаточно Coin of Luck!<br/>';
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
include($path.'inc/down.php');
exit;
}

if($_POST[cena] * $_POST[col] >999999999999999999){
echo'Максимальная цена за всё 500`000`000 Аден<br/>';
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
include($path.'inc/down.php');
exit;
}




if (empty($_POST[cena])){$_POST[cena] = 0;} 


$nalmaz = $udata[almaz] - $_POST[col];

mysql_query ("UPDATE users SET  almaz='$nalmaz' WHERE usr='$log' LIMIT 1"); // забираем у юзера колы выставленные на продажу

$res = mysql_query("INSERT INTO
        `bazar_col` SET 
        `usr` = '$log', 
        `col` = '$_POST[col]', 
		`cena` = '$_POST[cena]'");

$cena555 = $_POST[col]*$_POST[cena];

						if ($res == 'true')
					{
					echo 'Вы выставили <b>'.number_format($_POST[col], 0, ',', "`").'</b> Coin of Luck на продажу по <b>'.number_format($_POST[cena], 0, ',', "`").'</b> Аден.<br/>
					Общая цена составила <b><u>'.number_format($cena555, 0, ',', "`").'</u></b> Аден'; // удачно
					}
					else
					{
					echo " Неудачо. После 5 попыток сообщите Администрации сайта.";  // неудачно =)
					}
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";




}
break;
////////////////////////////////////////////////////////////////////////////////////////////

////////////// купить колы ///////
case 'by';


if (!empty($_POST[col]) && $_POST[col]>0){
$req = mysql_query("SELECT * FROM `bazar_col` WHERE `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1");
$avto=mysql_num_rows($req);
if ($avto>=1){
$col = mysql_fetch_array($req);

$req2 = mysql_query("SELECT money FROM `users` WHERE `usr` = '$col[usr]' LIMIT 1");
$users = mysql_fetch_array($req2);

//--------------------------------------------------------------------
//	// 		КАЛЬКУЛЯТОР 		//	//
$cena = $_POST[col] * $col[cena]; // цена ввёденого количества
$nmoney = $udata[money] - $cena; // остача аден при покупке
$nmoney2 = $users[money] + $cena; // даём аден при покупке
$nalmaz = $udata[almaz] + $_POST[col]; // плюсуем колы
$ncol = $col[col] - $_POST[col]; // сколько осталось на базаре
//			////////			//	//
//--------------------------------------------------------------------

if($ncol < 0){
echo'Неверное кол-во Coin of Luck!<br/>';
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
include($path.'inc/down.php');
exit;
}

if($log == $col[usr]){
echo'Вы не можете купить у себя Coin of Luck<br/>';
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
include($path.'inc/down.php');
exit;
}

if($nmoney < 0){
echo 'Недостаточно Аден!<br/>';
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
include($path.'inc/down.php');
exit;
}

// пишем результат
$ressave = mysql_query ("UPDATE users SET
        almaz='$nalmaz',
        money='$nmoney'
		 WHERE usr='$log' LIMIT 1");

		 // + деньги продавцу
  mysql_query ("UPDATE users SET  money='$nmoney2' WHERE usr='$col[usr]' LIMIT 1");


// если купил все колы то удаляем базар 
if($ncol <= 0){
mysql_query("DELETE FROM `bazar_col` WHERE `id` = '".mysql_real_escape_string($_GET[id])."'"); // чистим продажу
}else{ // иначе записуем результат
mysql_query ("UPDATE bazar_col SET col='$ncol' WHERE id='".mysql_real_escape_string($_GET[id])."' LIMIT 1");}


$text = " Игрок <b><a href=\"search.php?&nick=$log&go=go\">$log</a></b> купил у Вас <b> $_POST[col] </b> Coin of Luck за <b><u>".number_format($cena, 0, ',', "`")."</b></u> Аден  !</b>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$col[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


				if ($ressave == 'true')
					{
					echo "<font color=#007F46><p>Вы купили <b>$_POST[col]<b> Coin of Luck за <b><u>".number_format($cena, 0, ',', "`")."</b></u> Аден !</p> </p></font>"; // удачно
										echo"<div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
}
					else
					{
					echo "<font color=red><p> Неудача ! </p></font>";  // неудачно =)
					}

//////////////////////////////////////


}else {echo "<p>Ошибка! Такой продажы не обнаруженно.</p>";
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
}


}else{
$req = mysql_query("SELECT * FROM `bazar_col` WHERE `id` = '".mysql_real_escape_string($_GET[id])."' ORDER BY cena");
////////////////////////////
$avto=mysql_num_rows($req);
if ($avto>=1){
$col = mysql_fetch_array($req);

$cena555 = $col[col]*$col[cena];

echo "<p>Игрок <b>$col[usr]</b> продает <b>".number_format($col[col], 0, ',', "`")."</b> шт. Coin of Luck. <br/>
Цена продавца: <b>".number_format($col[cena], 0, ',', "`")."</b> Aден за штуку <br/>
Общая цена: <b><u>".number_format($cena555, 0, ',', "`")."</b></u> Aден.</p>";

echo '<form action="" method="post">';
echo"Количество:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"0\" name=\"col\"/><br/>";
echo '<input class="button" type="submit" value="Купить" /></form>';


					echo"<div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";


}else {echo "<p>Ошибка! Такой продажы не обнаруженно.</p>";
					echo"<br/><div class=inoy><a href=\"bazar_col.php?\">Рынок Coin of Luck</a></div>";
}
}
break;


}
include($path.'inc/down.php');
?>