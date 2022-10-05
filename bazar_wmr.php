<?php

$headmod = 'bazar_wmr';//фикс. места

$textl='Базар WMR';
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

/*
if ($log == 'Zigas' or $log == 'Svi4'){}else{
echo'Закрито на доработки! Скоро будет работать.<br/>';
echo"<br/><a href=\"index.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}
*/
//--------------время прошло, шмотку убрало-------------------
$tm=time();

$btm = mysql_query("SELECT * FROM bazar_wmr WHERE times <= '$tm'");
$avtobt=mysql_num_rows($btm);
if($avtobt>=1){
While($item = mysql_fetch_array($btm))
{ 
 mysql_query("INSERT INTO
        `item` SET
        `usr` = '$item[usr]',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");

$time = date("H:i d.m.y");
$u=explode('*',$item[name]);
$text = "Никто не купил у Вас <img src=\"shmot/$u[0].png\" alt=\"pic\"/><font color=#A1081F> $item[name]</font>. Время истекло. Вещь вернули Вам.";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Торговец', `user_to` = '$item[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
		
		
  mysql_query("DELETE FROM `bazar_wmr` WHERE id = '$item[id]'");
}}
//------------------------------------------------------------

switch($_GET[mod]){

default:
////////////////////
$b = mysql_query("SELECT usr FROM bazar_wmr WHERE usr = '$log' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($b);
////////////////////////

echo "<p> <span style=color:#D24A1D;><b> &#160 Базар за WMR&#160 </b></span><br/><small>(все цены в WMR)</small> </p> <hr/>";

//echo"<div class=inoy><a href=\"bazar_wmr.php?mod=sell\">Выставить на продажу</a></div>";
echo"<div class=inoy><a href=\"bazar_wmr.php?mod=sell&amp;tip=item\">Продать вещи</a></div>";

if($avto>0){
$cbazwmrvi = mysql_num_rows(mysql_query("SELECT * FROM `bazar_wmr` WHERE `usr`='$log'"));
echo"<div class=inoy><a href=\"bazar_wmr.php?mod=back\">Забрать вещи <small> <font color=#3C668D>[$cbazwmrvi]</font></small></a></div>";}
echo'<hr/><br/><div class="event">';

// вывод вещей что на продажу выставленны

//---выщитует страницы----------

	$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `bazar_wmr` WHERE `usr` != '$log'"), 0);
	if($count > 0){
		$pages = ceil($count/10);
		if(isset($_GET['page'])){
			$page = abs(intval($_GET['page']));
		}else{
			$page = 1;
		}
		$from = ($page-1)*10;
}
//-------------------------------


$b = mysql_query("SELECT * FROM bazar_wmr WHERE `usr` != '$log' ORDER BY id DESC LIMIT $from, 10");
$avto=mysql_num_rows($b);
if($avto>=1){

While($best = mysql_fetch_array($b))
{
$u=explode('*',$best[name]);
//$best[mycena]=$best[mycena]/100;


$best[times]=$best[times]-time();

												
												$time_ch = floor($best[times]/3600); // сколько часов										
												$best[times] = floor($best[times]-($time_ch*3600)); // остача часов
												
												$time_min = floor($best[times]/60);
												
												$time_sek = floor($best[times]-($time_min*60));
												
													if ($time_sek<0) {
																	$time_min=$time_min-1;
																	$time_sek = floor($udata[time]-($time_min*60));
																	}
	
	if ($time_ch>0){$time_ch="$time_ch:";}else{$time_ch="";}
	if ($time_min>0){$time_min="$time_min:";}else{$time_min="0:";}
	if ($time_sek>0){$time_sek="$time_sek";}else{$time_sek="";}
	
											$tim = "$time_ch$time_min$time_sek sek.";



echo "<div class=inoy><a href=\"bazar_wmr.php?mod=info&amp;tip=item&amp;id=$best[id]\"><img src=\"shmot/$u[0].png\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/>
 $best[name] <span style=color:#C2B6B2;>[".number_format($best[mycena], 2, ',', "`")." WMR]</span><br/>
<font color=#F5F5F5>&nbsp; Открыто:  $tim</font></a></div>";



}
// показ страниц
echo "<div class=msg><p>Стр: ";
	navig2($page, 'bazar_wmr.php?', $pages);
echo "</p></div>";
//---------------
}else{
echo"<div class=msg><p>Нет торговых лавок</p></div>";
}
break;

case 'sell':

$avtobz = mysql_num_rows(mysql_query("SELECT usr FROM `bazar_wmr` WHERE `usr` = '$log'"));
if($avtobz>=5){
echo "<div class=msg><p>Вы не можете выставить на продажу одновременно более 5 товаров.</p></div>";
echo"<hr/><div class=silka><a href=\"bazar_wmr.php?\">Назад</a></div>";
include($path.'inc/down.php');exit;
}






echo "<b><font color=grey> <p>Базар: </p></font></b><hr/>";

if(empty($_GET[tip])){
echo "<div class=inoy>";
echo"<a href=\"bazar_wmr.php?mod=sell&amp;tip=item\">Продать вещи</a>";
//echo"<a href=\"bazar_wmr.php?mod=sell&amp;tip=res\">Продать ресурсы</a>";
//echo"<a href=\"bazar_wmr.php?mod=sell&amp;tip=pit\">Продать вещи питомцев</a>";
echo "</div>";
}elseif($_GET[tip]==item){


//---выщитует страницы----------

	$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `item` WHERE `usr` = '$log' and `image`='not'"), 0);
	if($count > 0){
		$pages = ceil($count/15);
		if(isset($_GET['page'])){
			$page = abs(intval($_GET['page']));
		}else{
			$page = 1;
		}
		$from = ($page-1)*15;
}
//-------------------------------


$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not'  ORDER BY id DESC LIMIT $from, 15");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
$u=explode('*',$mag[name]);
echo"<div class=inoy><a href=\"bazar_wmr.php?mod=sell&amp;tip=item&amp;id=$mag[id]\"><img src=\"shmot/$u[0].png\" width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/>$mag[name]</a></div>";
}

echo "<hr/><div class=msg><p>Стр: ";
	navig2($page, 'bazar_wmr.php?mod=sell&tip=item&amp;', $pages);
echo "</p></div>";

}else{
echo"Нет вещей<br/>";
}
}else{
if(empty($_POST[mycena])){
echo "<form action=\"bazar_wmr.php?mod=sell&amp;tip=item&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Цена (WMR):</b><br/>';
echo '<input name="mycena"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';

echo "<font color=orange><br/><hr/>
* Вводите целое значение (например 15 WMR).<br/>
* Значения к примеру 10,05 не принемаються.
 </font>";
}else{
if($_POST[mycena]<=0){
echo"Минимальная цена один WMR!";
include($path.'inc/down.php');exit;
}

if(is_numeric($_POST[mycena])==FALSE) {
echo"Вводите только цыфры!";
include($path.'inc/down.php');exit;
}


$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

$times = time()+60*60*48;//секунд/минут/часов

mysql_query("INSERT INTO
        `bazar_wmr` SET
        `usr` = '$log',
        `times` = '$times',
        `baz_tip` = 'item',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `mycena` = '$_POST[mycena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `nlvl` = '$item[nlvl]'");

mysql_query("DELETE FROM `item` WHERE usr='$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
   
   
echo"Вещь $item[name] выставлена на продажу за $_POST[mycena] WMR!<br/>";

}else{
echo"Нет такой вещи<br/>";
}
}}
}elseif($_GET[tip]==res){
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<div class=dot><a href=\"bazar_wmr.php?mod=sell&amp;tip=res&amp;id=$mag[id]\">$mag[name]</a> ($mag[kol] штук)</div>";
}
}else{
echo"Нет ресурсов!<br/>";
}
}else{
if(empty($_POST[mycena]) or empty($_POST[num])){
echo "<form action=\"bazar_wmr.php?mod=sell&amp;tip=res&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Цена за штуку:</b><br/>';
echo '<input name="mycena"/><br/>';
echo '<b>Сколько:</b><br/>';
echo '<input name="num"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';
}else{
if($_POST[mycena]<=0 or $_POST[num]<=0){
echo"Ошибка! Неправильно введённая цена или количество!";
include($path.'inc/down.php');exit;
}
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$res = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `bazar_wmr` WHERE `usr` = '$log' and `lat_name`='$res[lat_name]'");
////////////////////////////
$avto=mysql_num_rows($req);
/////////////////////
if($res[kol]-$_POST[num]<=0){
mysql_query("DELETE FROM `res` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
$nkol=$res[kol];
}else{
$res[kol]=$res[kol]-$_POST[num];
mysql_query("UPDATE `res` SET `kol` = '$res[kol]' WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
$nkol=$_POST[num];
}
////////////////////////
$_POST[mycena]=round($_POST[mycena]*$nkol);
/////////////////////
if($avto==0){

$times=time()+60*60*48;//секунд/минут/часов
mysql_query("INSERT INTO
        `bazar_wmr` SET
        `usr` = '$log',
        `time2` = '$times',
        `name` = '$res[name]',
        `lat_name` = '$res[lat_name]',
        `baz_tip` = 'res',
        `mycena` = '$_POST[mycena]',
        `tip` = '$res[tip]',
        `what` = '$res[what]',
        `give` = '$res[give]',
        `kol` = '$nkol',
        `cena` = '$res[cena]'");
}else{
$item = mysql_fetch_array($req);
$item[kol]=$item[kol]+$nkol;
mysql_query("UPDATE `bazar_wmr` SET `kol` = '$item[kol]' WHERE `usr` = '$log' and `lat_name`='$res[lat_name]'");
}     
echo"$res[name]($nkol штук) выставлен на продажу за $_POST[mycena] WMR!<br/>";
}else{
echo"Нет ресурсов!<br/>";
}
}
}
}elseif($_GET[tip]==pit){
$req = mysql_query("SELECT * FROM `pit_item` WHERE `usr` = '$log' and `image`='not'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<div class=dot><a href=\"bazar_wmr.php?mod=sell&amp;tip=pit&amp;id=$mag[id]\">$mag[name]</a></div>";
}
}else{
echo"Нет вещей<br/>";
}
}else{
if(empty($_POST[mycena])){
echo "<form action=\"bazar_wmr.php?mod=sell&amp;tip=pit&amp;id='.htmlspecialchars($_GET[id]).'\" method=\"post\">";
echo '<b>Цена:</b><br/>';
echo '<input name="mycena"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';
}else{
if($_POST[mycena]<=0){
echo"Минимальная цена одна WMR!";
include($path.'inc/down.php');exit;
}
$req = mysql_query("SELECT * FROM `pit_item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

$times=time()+60*60*48;//секунд/минут/часов
mysql_query("INSERT INTO
        `bazar_wmr` SET
        `usr` = '$log',
        `times` = '$times',
        `baz_tip` = 'pit',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `mycena` = '$_POST[mycena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `nlvl` = '$item[nlvl]'");

mysql_query("DELETE FROM `pit_item` WHERE usr='$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
        
echo"Вещь $item[name] выставлена на продажу за $_POST[mycena] WMR!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}}
}else{
echo"Ошибка!<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar_wmr.php?\">Назад</a></div>";
break;
case 'back':
if(empty($_GET[tip]) or empty($_GET[id])){
$b = mysql_query("SELECT * FROM bazar_wmr WHERE usr = '$log' ORDER BY id");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;

echo "<p> <font color=grey> &#160 Забрать с продажи &#160 </font> </p> <hr/>";

While($best = mysql_fetch_array($b))
{
$u=explode('*',$best[name]);
echo"<div class=msg> $i. <img src=\"shmot/$u[0].png\" width='32' height='32' alt=\"pic\"/> <a href=\"bazar_wmr.php?mod=info&amp;tip=$best[baz_tip]&amp;id=$best[id]\">$best[name]</a> ";
if($best[baz_tip]==res){echo" ($best[kol] штук - $best[mycena] WMR)";}
else{echo" ($best[mycena] WMR)";}
echo" <a href=\"bazar_wmr.php?mod=back&amp;tip=$best[baz_tip]&amp;id=$best[id]\">[забрать]</a></div>";
$i++;
}
}else{
echo"Нет вещей на продаже<br/>";
}
}elseif($_GET[tip]==pit and !empty($_GET[id])){
$req = mysql_query("SELECT * FROM `bazar_wmr` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

mysql_query("INSERT INTO
        `pit_item` SET
        `usr` = '$log',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
        
mysql_query("DELETE FROM `bazar_wmr` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
        
echo"Вещь $item[name] забрана с продажи!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}
elseif($_GET[tip]==item and !empty($_GET[id])){
$req = mysql_query("SELECT * FROM `bazar_wmr` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$log',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
        
mysql_query("DELETE FROM `bazar_wmr` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
        
echo"Вещь $item[name] забрана с продажи!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}elseif($_GET[tip]==res and !empty($_GET[id])){

$req = mysql_query("SELECT * FROM `bazar_wmr` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$res = mysql_fetch_array($req);

$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `lat_name`='$res[lat_name]' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($req);

if($avto==0){
mysql_query("INSERT INTO
        `res` SET
        `usr` = '$log',
        `name` = '$res[name]',
        `lat_name` = '$res[lat_name]',
        `tip` = '$res[tip]',
        `what` = '$res[what]',
        `give` = '$res[give]',
        `kol` = '$res[kol]',
        `cena` = '$res[cena]'");
}else{
$myres=mysql_fetch_array($req);
$myres[kol]=$myres[kol]+$res[kol];
mysql_query("UPDATE `res` SET `kol` = '$myres[kol]' WHERE `usr` = '$log' and `lat_name`='$res[lat_name]'");
}
/////////////////////
mysql_query("DELETE FROM `bazar_wmr` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");//с база
    
echo"$res[name]($res[kol] штук) забраны с продажи!<br/>";
}else{
echo"Нет ресурсов!<br/>";
}
}else{
echo"Ошибка!<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar_wmr.php?\">Назад</a></div>";
break;
case 'by':
if(empty($_GET[id])){
echo'Невыбрана вещь для покупки!';
include($path.'inc/down.php');exit;
}
if($_GET[tip]==item){
$req = mysql_query("SELECT * FROM `bazar_wmr` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);
if($item[usr]==$log and $log!='iNoY.GM'){
echo'Свои товары нельзя покупать!';
include($path.'inc/down.php');exit;
}
if($udata[wmr]<$item[mycena]*100){
echo'Нехватает WMR!';
include($path.'inc/down.php');exit;
}

$udata[wmr]=$udata[wmr]-$item[mycena]*100;//mony

        
        mysql_query("INSERT INTO
        `item` SET
        `usr` = '$log',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
        

        
mysql_query("DELETE FROM `bazar_wmr` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");
        
        mysql_query("UPDATE `users` SET `wmr` = '$udata[wmr]' WHERE `usr` = '$log'");
        
$req = mysql_query("SELECT wmr FROM `users` WHERE `usr` = '$item[usr]' LIMIT 1");
////////////////////////////
$m = mysql_fetch_array($req);
$m[wmr]=$m[wmr]+$item[mycena]*100;
mysql_query("UPDATE `users` SET `wmr` = '$m[wmr]' WHERE `usr` = '$item[usr]'");

$time = date("H:i d.m.y");

$u=explode('*',$item[name]);
$text = "<a href=\"search.php?nick=$log&amp;go=go\">$log</a> купил у Вас <img src=\"shmot/$u[0].png\" alt=\"pic\"/><font color=#1F6B8C> $item[name]</font> за <font color=#CC6633>$item[mycena] WMR</font>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Торговец', `user_to` = '$item[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");

echo"Вещь $item[name] куплена за $item[mycena] WMR!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}else{
echo'Ошибка!<br/>';
}
echo"<hr/><div class=silka><a href=\"bazar_wmr.php?\">Назад</a></div>";
break;

//-----------------------------------------------------------------------------------------------------------

case 'info':
$req = mysql_query("SELECT * FROM `bazar_wmr` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");
$avto=mysql_num_rows($req);

if($avto==0){echo'Ошибка! Нет такой вещи.';include($path.'inc/down.php');exit;}

$mag = mysql_fetch_array($req);
switch($mag[tip]){
case 'weapon':
$tip='Оружие';
break;
case 'body':
$tip='Доспехи';
break;
case 'golova':
$tip='Шлем';
break;
case 'nogi':
$tip='Сапоги';
break;
case 'shit':
$tip='Щит';
break;
case 'poyas':
$tip='Пояс';
break;
case 'plash':
$tip='Плащ';
break;
case 'ruki':
$tip='Рукавицы';
break;
case 'kolco':
$tip='Кольцо';
break;
case 'amulet':
$tip='Амулет';
break;
}


echo "<p><font color=#0C8B83>Лавkа игроka <b>$mag[usr]</b>:</font></p><hr/>";


///////////////////////
$u=explode('*',$mag[name]);
echo"<img src=\"shmot/$u[0].png\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/> <b>$mag[name]</b><br/>
Тип: $tip ";

if ($mag[ruka]=='ydar'){echo"Ударное";}
if ($mag[ruka]=='luk'){echo"Лук";}
if ($mag[ruka]=='kin'){echo"Кинжал";}
if ($mag[ruka]=='sdv'){echo"Сдвоенное";}
if ($mag[ruka]=='kas'){echo"Кастет";}
if ($mag[ruka]=='kniga'){echo"Книга";}
if ($mag[ruka]=='koppik'){echo"Копьё/Пика";}
if ($mag[ruka]=='me4'){echo"Меч";}
if ($mag[ruka]=='rap'){echo"Рапира";}
if ($mag[ruka]=='fish'){echo"Удочка";}


echo "<hr/><b>Характеристика</b><br/>";
if ($tip=="Оружие"){
echo "
Физ. атака: $mag[patt]<br/>
Маг. атака: $mag[matt]<br/><br/>

SoulShot: x$mag[soul]<br/>
SpiritShot: x$mag[spirit]<br/><br/>";}else{

echo "
Физ. защ.: $mag[pdef]<br/>
Маг. защ.: $mag[mdef]<br/><br/>";}

$best[times]=$mag[times];
$best[times]=$best[times]-time();

if ($best[times]>0){

												
												$time_ch = floor($best[times]/3600); // сколько часов										
												$best[times] = floor($best[times]-($time_ch*3600)); // остача часов
												
												$time_min = floor($best[times]/60);
												
												$time_sek = floor($best[times]-($time_min*60));
												
													if ($time_sek<0) {
																	$time_min=$time_min-1;
																	$time_sek = floor($udata[time]-($time_min*60));
																	}
											$tim = "$time_ch час. $time_min мин. $time_sek сек.";
																	}else{$tim = "<font color=red>Закрыта</font>";}	
	
echo "<div class=msg><p>Лавка еще открыта: $tim</p></div>";


echo"<div class=inoy><a href=\"bazar_wmr.php?mod=by&amp;tip=item&amp;id=$mag[id]\">Купить за <font color=#CC6633>".number_format($mag[mycena], 2, ',', "`")." WMR </font></a></div>";

echo"<hr/><div class=silka><a href=\"bazar_wmr.php?\">Назад</a></div>";
break;




case 'shop':
$_GET[usr] = htmlspecialchars(stripslashes(addslashes($_GET[usr])));
$b2 = mysql_query("SELECT usr FROM bazar_wmr WHERE usr = '".mysql_real_escape_string($_GET[usr])."' LIMIT 1");
////////////////////////////
$avto2=mysql_num_rows($b2);
if($avto2==0){
echo'Нет такой торговой лавки!';
include($path.'inc/down.php');
exit;
}
echo'<div class="event">';
echo"<hr/><b>Вещи:</b><br/>";
$b = mysql_query("SELECT * FROM bazar_wmr WHERE baz_tip = 'item' and usr = '".mysql_real_escape_string($_GET[usr])."' ORDER BY id DESC");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"<div class=dot> $i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar_wmr.php?mod=info&amp;tip=item&amp;id=$best[id]\">$best[name]</a> ($best[mycena] WMR)
  [<a href=\"bazar_wmr.php?mod=by&amp;tip=item&amp;id=$best[id]\">купить</a>]</div>";
$i++;
}
}else{
echo"<div class=dot> ПусТо </div>";
}

echo"<hr/><b>Вещи для питомцев:</b><br/>";
$b = mysql_query("SELECT * FROM bazar_wmr WHERE baz_tip = 'pit' and usr = '".mysql_real_escape_string($_GET[usr])."'");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"<div class=dot> $i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar_wmr.php?mod=info&amp;tip=pit&amp;id=$best[id]\">$best[name]</a> ($best[mycena] WMR)
  [<a href=\"bazar_wmr.php?mod=by&amp;tip=pit&amp;id=$best[id]\">купить</a>]</div>";
$i++;
}
}else{
echo"<div class=dot> ПусТо </div>";
}

echo'</div>';
echo"<hr/><div class=silka><a href=\"bazar_wmr.php?\">Назад</a></div>";
break;
}
include($path.'inc/down.php');
?>