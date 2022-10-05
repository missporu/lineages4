<?php

$headmod = 'sklad';//фикс. места

$textl='Склад';
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

echo "<font color=#007A43><p><b> Склад: </b></p></font>";

switch($_GET[mod]){

default:
echo "<div class=inoy>";
echo"<a href=\"sklad.php?mod=send\">Положить вещь</a>";
echo"<a href=\"sklad.php?mod=back\">Забрать вещь</a>";
echo"<a href=\"sklad.php?mod=give\">Передать</a>";
echo "</div>";
break;

case 'send':
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{$u = explode("*",$mag[name]);
echo "<div class=inoy>";
echo"<a href=\"sklad.php?mod=send&amp;id=$mag[id]\"><img src=\"shmot/$u[0].png\" alt=\"pic\"/> $mag[name]</a>";
echo "</div>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
}else{
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

mysql_query("INSERT INTO
        `sklad` SET
        `usr` = '$log',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `time` = '$item[time]',
        `nlvl` = '$item[nlvl]'");
        
mysql_query("DELETE FROM `item` WHERE usr='$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
$time = date("H:i d.m.y");
$text="[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> Положил $item[name] на склад";
mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text` )VALUES (NULL , 'put', '$text')");
        
echo"Вещь $item[name] положена на склад!<br/>";

}else{
echo"<b>Нет такой вещи</b><br/>";
}
}
echo"<br/><div class=silka><a href=\"sklad.php?\">Назад</a></div>";

break;

case 'back':
$req = mysql_query("SELECT * FROM `sklad` WHERE `usr` = '$log'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{$u = explode("*",$mag[name]);

echo"<div class=inoy><a href=\"sklad.php?mod=back&amp;id=$mag[id]\"><img src=\"shmot/$u[0].png\" alt=\"pic\"/>  $mag[name]</a></div>";
}
}else{
echo"<b>Нет вещей на складе</b><br/>";
}
}else{
$req = mysql_query("SELECT * FROM `sklad` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
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
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `time` = '$item[time]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
        
mysql_query("DELETE FROM `sklad` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
$time = date("H:i d.m.y");
$text="[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> Забрал $item[name] на склад";
mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text` )VALUES (NULL , 'take', '$text')");
echo"Вещь $item[name] забрана со склада!<br/>";

}else{
echo"<b>Нет такой вещи</b><br/>";
}
}
echo"<br/><div class=silka><a href=\"sklad.php?\">Назад</a></div>";

break;
case 'give':
if($udata[lvl]<9){
echo'Доступно с 9 уровня!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
if(empty($_GET[act])){
echo "<div class=inoy>";
echo"<a href=\"sklad.php?mod=give&amp;act=1\">Передать вещи <br/><font color=grey><small> &nbsp;* комисия 1% от цены </small></font></a>";
echo"<a href=\"sklad.php?mod=give&amp;act=2\">Передать ресурсы</a>";
echo"<a href=\"sklad.php?mod=give&amp;act=5\">Передать вещи для питомцев</a>";
echo "</div><br/>";
echo"<div class=silka><a href=\"sklad.php?\">Назад</a></div>";
}elseif($_GET[act]==1){
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{$u = explode("*",$mag[name]);
echo"<div class=inoy><a href=\"sklad.php?mod=give&amp;act=3&amp;id=$mag[id]\"><img src=\"shmot/$u[0].png\" alt=\"pic\"/> $mag[name]</a></div>";
}
}else{
echo"<b>Нет вещей!</b><br/>";
}
}else{
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '".mysql_real_escape_string($_POST['komu'])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto=="0"){
echo'Нет такого игрока!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

if($log==$_POST['komu']){
echo'Себе передать нельзя!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}




$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1");
$mag = mysql_fetch_array($req);
////////////////////////////
$u = explode("*",$mag[name]);
echo"<hr/><p><u>Передать:</u></p><img src=\"/shmot/$u[0].png\" alt=\"pic\"/> $mag[name]<br/><br/>";
//---------------комисия товара-------------------------------------
// люкс
$cena = mysql_fetch_array(mysql_query("SELECT cena FROM `shop_lux` WHERE `name` = '$u[0]' and `tip`='$mag[tip]' LIMIT 1"));
if (!empty($cena[cena])){$kom = floor(($cena[cena] + $u[1]/4) * 0.01);echo " * Комисия: $kom CoL <br/><br/>";}

// вип
$cena = mysql_fetch_array(mysql_query("SELECT cena FROM `shop_vip` WHERE `name` = '$u[0]' and `tip`='$mag[tip]' LIMIT 1"));
if (!empty($cena[cena])){$kom = floor(($cena[cena] + $u[1]/4) * 0.01);echo " * Комисия: $kom CoL <br/><br/>";}

//удочки
if ($u[0]=='Baby Duck Rod'){$kom=floor((5+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
if ($u[0]=='Albatross Rod'){$kom=floor((10+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
if ($u[0]=='Pelican Rod'){$kom=floor((15+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
if ($u[0]=='KingFisher Rod'){$kom=floor((21+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
//------------------------------------------------------------------

if($udata[almaz] < $kom){
echo "Не хватает <b><u>CoL</u></b> для оплаты комисии. Нужно <b>$kom</b>, а у Вас  <u>$udata[almaz]</u>!<br/>";
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

$colnew = $udata[almaz] - $kom;
mysql_query("UPDATE `users` SET `almaz` = '$colnew' WHERE `usr` = '$log' LIMIT 1");


$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);
if($item[mif]=='1'){echo'мифические вещи передавать нельзя';include('inc/down.php');exit;}
$time = date('H:i');
mysql_query("INSERT INTO
        `item` SET
`usr` = '".mysql_real_escape_string($_POST[komu])."',
        `tip` = '$item[tip]',
        `ruka` = '$item[ruka]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `soul` = '$item[soul]',
        `spirit` = '$item[spirit]',
        `time` = '$item[time]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
       
mysql_query("DELETE FROM `item` WHERE usr='$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
        mysql_query("INSERT INTO `msg_r` SET `user_from` = '$log', `user_to` = '$_POST[komu]', `time` = '$time', `read` = 1, `mail_msg` = 'Пользователь  $log прислал Вам $item[name]'");
$time = date("H:i d.m.y");
$text="[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> передал <b>$item[name]<b> игроку <a href=\"/search.php?nick=$_POST[komu]&amp;go=go\">$_POST[komu]</a>";
mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text` )VALUES (NULL , 'giveitem', '$text')");




echo"Вещь $item[name] передана $_POST[komu]!<br/>";

}else{
echo"<b>Нет такой вещи</b><br/>";
}
}
echo"<br/><div class=silka><a href=\"sklad.php?\">Назад</a></div>";
}elseif($_GET[act]==5){
$req = mysql_query("SELECT * FROM `pit_item` WHERE `usr` = '$log' and `image`='not'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<div class=inoy><a href=\"sklad.php?mod=give&amp;act=6&amp;id=$mag[id]\">$mag[name]</a></div>";
}
}else{
echo"<b>Нет вещей!</b><br/>";
}
}else{
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '".mysql_real_escape_string($_POST['komu'])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto=="0"){
echo'Нет такого игрока!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
if($log==$_POST['komu']){
echo'Себе передать нельзя!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

$req = mysql_query("SELECT * FROM `pit_item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$mag = mysql_fetch_array($req);

mysql_query("INSERT INTO
        `pit_item` SET
        `usr` = '".mysql_real_escape_string($_POST['komu'])."',
        `tip` = '$item[tip]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `patt` = '$item[patt]',
        `matt` = '$item[matt]',
        `pdef` = '$item[pdef]',
        `mdef` = '$item[mdef]',
        `time` = '$item[time]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
        
mysql_query("DELETE FROM `pit_item` WHERE usr='$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
$time = date("H:i d.m.y");
$text="[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> передал вещь для питомцев <b>$mag[name]</b>  игроку <a href=\"/search.php?nick=$_POST[komu]&amp;go=go\">$_POST[komu]</a>";
mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text` )VALUES (NULL , 'givepit', '$text')");
echo"Вещь $mag[name] передана!<br/>";
}else{
echo"<b>Нет такой вещи</b><br/>";
}
}
echo"<br/><div class=silka><a href=\"sklad.php?\">Назад</a></div>";
}elseif($_GET[act]==2){


if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = htmlspecialchars($_GET[page]) + 1;
$back = htmlspecialchars($_GET[page]) - 1;
$num = htmlspecialchars($_GET[page]) * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT * FROM `res` WHERE `usr` = '$log'"));
$puslap = floor($viso/10);



$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' LIMIT $num,10");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){

echo "<div class=dot><p> 	Передать ресурсы (выбрать):	</p></div><hr/>";

While($mag = mysql_fetch_array($req))
{

$u=explode(': ',$mag[name]);
echo "<div class=inoy>";
echo"<a href=\"sklad.php?mod=give&amp;act=4&amp;id=$mag[id]\"> <img src=\"pic/skr/$u[0].gif\" alt=\"pic\"/> $mag[name] <font color=#ffffff>($mag[kol] штук)</font></a>";
echo "</div>";
}

echo "<p><center>";
if ($_GET[page] > 0)
{
echo "<a href=\"?page=$back&mod=give&act=2\"> <-=-=- </a>";
}
elseif ($_GET[page] == 0)
{
echo "<-=-=-";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"?page=$next&mod=give&act=2\"> -=-=-> </a>";}
else
{echo "-=-=->";}
echo "</p></center>";


}else{
echo"<b>Нет ресурсов!</b><br/>";
}
}else{
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '".mysql_real_escape_string($_POST[komu])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto=="0" or $_POST[num]<=0.999999999999999){
echo'Ошибка!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}
if($log==$_POST['komu']){
echo'Себе передать нельзя!<br/>';
echo"<a href=\"sklad.php?\">Назад</a>";
include($path.'inc/down.php');exit;
}

$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$res = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$_POST[komu]' and `lat_name`='$res[lat_name]'");
////////////////////////////
$avto=mysql_num_rows($req);
/////////////////////
if($res[tip] == "vip"){echo' вип карты передавать нельзя';include($path.'inc/down.php');exit;}
if($res[kol]-$_POST[num]<=0.9999999999999999999999999999){


mysql_query("DELETE FROM `res` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
$nkol=$res[kol];
}else{
$res[kol]=$res[kol]-$_POST[num];
mysql_query("UPDATE `res` SET `kol` = '$res[kol]' WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
$nkol=$_POST[num];
}
////////////////////////
if($avto==0){
mysql_query("INSERT INTO
        `res` SET
        `usr` = '$_POST[komu]',
        `name` = '$res[name]',
        `lat_name` = '$res[lat_name]',
        `tip` = '$res[tip]',
        `what` = '$res[what]',
        `give` = '$res[give]',
        `kol` = '$nkol',
        `cena` = '$res[cena]'");
}else{
$item = mysql_fetch_array($req);
$item[kol]=$item[kol]+$nkol;
mysql_query("UPDATE `res` SET `kol` = '$item[kol]' WHERE `usr` = '$_POST[komu]' and `lat_name`='$res[lat_name]'");
}
$time = date("H:i d.m.y");
$text="[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> передал ресурс <b>$res[name]</b> в количестве <b>$nkol штук</b> игроку <a href=\"/search.php?nick=$_POST[komu]&amp;go=go\">$_POST[komu]</a>";
mysql_query("INSERT INTO `logi` (`id` ,`tip` ,`text` )VALUES (NULL , 'giveres', '$text')");

       
echo"$res[name]($nkol штук) передан $_POST[komu]!<br/>";

}else{
echo"<b>Нет такой вещи</b><br/>";
}
}
echo"<br/><div class=silka><a href=\"sklad.php?\">Назад</a></div>";
}elseif($_GET[act]==3){


$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1");



$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1");
$mag = mysql_fetch_array($req);
////////////////////////////
$u = explode("*",$mag[name]);
echo"<hr/><p><u>Передать:</u></p><img src=\"/shmot/$u[0].png\" alt=\"pic\"/> $mag[name]<br/><br/>";


//---------------комисия товара-------------------------------------
// люкс
$cena = mysql_fetch_array(mysql_query("SELECT cena FROM `shop_lux` WHERE `name` = '$u[0]' and `tip`='$mag[tip]' LIMIT 1"));
if (!empty($cena[cena])){$kom = floor(($cena[cena] + $u[1]/4) * 0.01);echo " * Комисия: $kom CoL <br/><br/>";}

// вип
$cena = mysql_fetch_array(mysql_query("SELECT cena FROM `shop_vip` WHERE `name` = '$u[0]' and `tip`='$mag[tip]' LIMIT 1"));
if (!empty($cena[cena])){$kom = floor(($cena[cena] + $u[1]/4) * 0.01);echo " * Комисия: $kom CoL <br/><br/>";}

//удочки
if ($u[0]=='Baby Duck Rod'){$kom=floor((5+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
if ($u[0]=='Albatross Rod'){$kom=floor((10+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
if ($u[0]=='Pelican Rod'){$kom=floor((15+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
if ($u[0]=='KingFisher Rod'){$kom=floor((21+$u[1]/4)*0.01); echo " * Комисия: $kom CoL <br/><br/>";}
//------------------------------------------------------------------

echo "<form action=\"sklad.php?mod=give&amp;act=1&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Кому:</b><br/>';
echo '<input name="komu"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';

echo"<a href=\"sklad.php?\">Назад</a>";
}elseif($_GET[act]==6){
echo "<form action=\"sklad.php?mod=give&amp;act=5&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Кому:</b><br/>';
echo '<input name="komu"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';

echo"<a href=\"sklad.php?\">Назад</a>";
}elseif($_GET[act]==4){

echo "<form action=\"sklad.php?mod=give&amp;act=2&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Кому:</b><br/>';
echo '<input name="komu"/><br/>';
echo '<b>Сколько:</b><br/>';
echo '<input name="num"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';

echo"<a href=\"sklad.php?\">Назад</a>";
}else{
echo"Ошибка!<br/>";
}
break;
}
include($path.'inc/down.php');
?>