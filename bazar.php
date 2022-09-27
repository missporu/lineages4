<?
define('PROTECTOR', 1);

$headmod = 'bazar';//фикс. места

$textl='Базар';
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


/*if ($log == 'Zigas' or $log == 'Svi4'){}else{
echo'Закрито на доработки! Скоро будет работать.<br/>';
echo"<br/><a href=\"index.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}*/


switch($_GET[mod]){

default:
////////////////////
$b = mysql_query("SELECT usr FROM bazar WHERE usr = '$log' and city = '$udata[city]' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($b);
////////////////////////

echo "<p> <font color=grey> &#160 Базар &#160 </font> </p> <hr/>";

echo"<div class=inoy><a href=\"bazar.php?mod=sell\">Выставить на продажу</a>";
if($avto>0){echo"<a href=\"bazar.php?mod=back\">Забрать вещи</a>";}
echo'<hr/></div><br/><div class="event">';
$b = mysql_query("SELECT * FROM bazar WHERE city = '$udata[city]' group by usr");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
$b2 = mysql_query("SELECT usr FROM bazar WHERE usr = '$best[usr]' and city = '$udata[city]'");
////////////////////////////
$avto2=mysql_num_rows($b2);
echo"<div class=dot><a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a> продаёт $avto2 вещей | <a href=\"bazar.php?mod=shop&amp;usr=$best[usr]\">СмОтРеТь</a></div>";
$i++;
}
}else{
echo"Нет торговых лавок<br/>";
}
echo'</div>';
break;

case 'sell':
echo "<b><font color=grey> <p>Базар: </p></font></b><hr/>";

if(empty($_GET[tip])){
echo "<div class=inoy>";
echo"<a href=\"bazar.php?mod=sell&amp;tip=item\">Продать вещи</a>";
echo"<a href=\"bazar.php?mod=sell&amp;tip=res\">Продать ресурсы</a>";
echo"<a href=\"bazar.php?mod=sell&amp;tip=pit\">Продать вещи питомцев</a>";
echo "</div>";
}elseif($_GET[tip]==item){
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not'");
////////////////////////////
$avto=mysql_num_rows($req);
if(empty($_GET[id])){
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<div class=dot><a href=\"bazar.php?mod=sell&amp;tip=item&amp;id=$mag[id]\">$mag[name]</a></div>";
}
}else{
echo"Нет вещей<br/>";
}
}else{
if(empty($_POST[mycena])){
echo "<form action=\"bazar.php?mod=sell&amp;tip=item&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Цена:</b><br/>';
echo '<input name="mycena"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';
}else{
if($_POST[mycena]<=0){
echo"Минимальная цена одна монета!";
include($path.'inc/down.php');exit;
}
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

mysql_query("INSERT INTO
        `bazar` SET
        `usr` = '$log',
        `city` = '$udata[city]',
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
        
echo"Вещь $item[name] выставлена на продажу за $_POST[mycena] монет!<br/>";

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
echo"<div class=dot><a href=\"bazar.php?mod=sell&amp;tip=res&amp;id=$mag[id]\">$mag[name]</a> ($mag[kol] штук)</div>";
}
}else{
echo"Нет ресурсов!<br/>";
}
}else{
if(empty($_POST[mycena]) or empty($_POST[num])){
echo "<form action=\"bazar.php?mod=sell&amp;tip=res&amp;id=$_GET[id]\" method=\"post\">";
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
$req = mysql_query("SELECT * FROM `bazar` WHERE `usr` = '$log' and `lat_name`='$res[lat_name]' and city = '$udata[city]'");
////////////////////////////
$avto=mysql_num_rows($req);
/////////////////////
if($res[tip] == "vip"){echo' вип карты продавать нельзя';include($path.'inc/down.php');exit;}
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
mysql_query("INSERT INTO
        `bazar` SET
        `usr` = '$log',
        `city` = '$udata[city]',
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
mysql_query("UPDATE `bazar` SET `kol` = '$item[kol]' WHERE `usr` = '$log' and `lat_name`='$res[lat_name]' and `city` = '$udata[city]'");
}     
echo"$res[name]($nkol штук) выставлен на продажу за $_POST[mycena] монет!<br/>";
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
echo"<div class=dot><a href=\"bazar.php?mod=sell&amp;tip=pit&amp;id=$mag[id]\">$mag[name]</a></div>";
}
}else{
echo"Нет вещей<br/>";
}
}else{
if(empty($_POST[mycena])){
echo "<form action=\"bazar.php?mod=sell&amp;tip=pit&amp;id=$_GET[id]\" method=\"post\">";
echo '<b>Цена:</b><br/>';
echo '<input name="mycena"/><br/>';
echo '<input type="submit" value="Продолжить"/></form>';
}else{
if($_POST[mycena]<=0){
echo"Минимальная цена одна монета!";
include($path.'inc/down.php');exit;
}
$req = mysql_query("SELECT * FROM `pit_item` WHERE `usr` = '$log' and `image`='not' and `id`='".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);

mysql_query("INSERT INTO
        `bazar` SET
        `usr` = '$log',
        `city` = '$udata[city]',
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
        
echo"Вещь $item[name] выставлена на продажу за $_POST[mycena] монет!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}}
}else{
echo"Ошибка!<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'back':
if(empty($_GET[tip]) or empty($_GET[id])){
$b = mysql_query("SELECT * FROM bazar WHERE usr = '$log' and city = '$udata[city]' ORDER BY id");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;

echo "<p> <font color=grey> &#160 Забрать с продажи &#160 </font> </p> <hr/>";

While($best = mysql_fetch_array($b))
{
echo"<div class=dot> $i. <a href=\"bazar.php?mod=info&amp;tip=$best[baz_tip]&amp;id=$best[id]\">$best[name]</a> ";
if($best[baz_tip]==res){echo" ($best[kol] штук - $best[mycena] Аден)";}
else{echo" ($best[mycena] Аден)";}
echo" <a href=\"bazar.php?mod=back&amp;tip=$best[baz_tip]&amp;id=$best[id]\">[забрать]</a></div>";
$i++;
}
}else{
echo"Нет вещей на продаже<br/>";
}
}elseif($_GET[tip]==pit and !empty($_GET[id])){
$req = mysql_query("SELECT * FROM `bazar` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");
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
        
mysql_query("DELETE FROM `bazar` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
        
echo"Вещь $item[name] забрана с продажи!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}
elseif($_GET[tip]==item and !empty($_GET[id])){
$req = mysql_query("SELECT * FROM `bazar` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");
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
        
mysql_query("DELETE FROM `bazar` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");
        
echo"Вещь $item[name] забрана с продажи!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}elseif($_GET[tip]==res and !empty($_GET[id])){

$req = mysql_query("SELECT * FROM `bazar` WHERE `usr` = '$log' and `id`='".mysql_real_escape_string($_GET[id])."' and city = '$udata[city]' LIMIT 1");
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
mysql_query("DELETE FROM `bazar` WHERE usr='$log' and `id`='".mysql_real_escape_string($_GET[id])."'");//с база
    
echo"$res[name]($res[kol] штук) забраны с продажи!<br/>";
}else{
echo"Нет ресурсов!<br/>";
}
}else{
echo"Ошибка!<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'by':
if(empty($_GET[id])){
echo'Невыбрана вещь для покупки!';
include($path.'inc/down.php');exit;
}
if($_GET[tip]==item){
$req = mysql_query("SELECT * FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);
if($item[usr]==$log and $log!='Admin'){
echo'Свои товары нельзя покупать!';
include($path.'inc/down.php');exit;
}
if($udata[money]<$item[mycena]){
echo'Нехватает монет!';
include($path.'inc/down.php');exit;
}

$udata[money]=$udata[money]-$item[mycena];//mony

        
		
        mysql_query("INSERT INTO
        `item` SET
        `usr` = '$log',
        `tip` = '$item[tip]',
        `ruka` = '$item[tip]',
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
        
$req = mysql_query("SELECT * FROM `zamok` WHERE `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$city = mysql_fetch_array($req);
if($city[clan]!='not' and $udata[clan]!=$city[clan]){
$req = mysql_query("SELECT * FROM `clan` WHERE `lider`='$city[clan]'");
////////////////////////////
$clan = mysql_fetch_array($req);
$clan[money]=$clan[money]+round(($item[mycena]/100)*4);

mysql_query("UPDATE `clan` SET `money` = '$clan[money]' WHERE `lider` = '$udata[clan]'");
}
        
mysql_query("DELETE FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");
        
        mysql_query("UPDATE `users` SET `money` = '$udata[money]' WHERE `usr` = '$log'");
        
        $req = mysql_query("SELECT money FROM `users` WHERE `usr` = '$item[usr]' LIMIT 1");
////////////////////////////
$m = mysql_fetch_array($req);
$m[money]=$m[money]+$item[mycena];
mysql_query("UPDATE `users` SET `money` = '$m[money]' WHERE `usr` = '$item[usr]'");

$time = date("H:i d.m.y");
$text = "$item[name] преобрёл $log, сумма $item[mycena] монет была успешно вам перечислена!";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Торговец', `user_to` = '$item[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");

echo"Вещь $item[name] куплена за $item[mycena] монет!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}elseif($_GET[tip]==pit){
$req = mysql_query("SELECT * FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$item = mysql_fetch_array($req);
if($item[usr]==$log){
echo'Свои товары нельзя покупать!';
include($path.'inc/down.php');exit;
}
if($udata[money]<$item[mycena]){
echo'Нехватает монет!';
include($path.'inc/down.php');exit;
}

$udata[money]=$udata[money]-$item[mycena];//mony

        
        mysql_query("INSERT INTO
        `pit_item` SET
        `usr` = '$log',
        `tip` = '$item[tip]',
        `name` = '$item[name]',
        `cena` = '$item[cena]',
        `umin` = '$item[umin]',
        `umax` = '$item[umax]',
        `pgolova` = '$item[pgolova]',
        `pbody` = '$item[pbody]',
        `pnogi` = '$item[pnogi]',
        `hp` = '$item[hp]',
        `krit` = '$item[krit]',
        `ukrit` = '$item[ukrit]',
        `antikrit` = '$item[antikrit]',
        `sila` = '$item[sila]',
        `lovk` = '$item[lovk]',
        `rasa` = '$item[rasa]',
        `nlvl` = '$item[nlvl]',
        `image` = 'not'");
        
$req = mysql_query("SELECT * FROM `zamok` WHERE `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$city = mysql_fetch_array($req);
if($city[clan]!='not' and $udata[clan]!=$city[clan]){
$req = mysql_query("SELECT * FROM `clan` WHERE `lider`='$city[clan]'");
////////////////////////////
$clan = mysql_fetch_array($req);
$clan[money]=$clan[money]+round(($item[mycena]/100)*4);

mysql_query("UPDATE `clan` SET `money` = '$clan[money]' WHERE `lider` = '$udata[clan]'");
}
        
mysql_query("DELETE FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");
        
        mysql_query("UPDATE `users` SET `money` = '$udata[money]' WHERE `usr` = '$log'");
        
        $req = mysql_query("SELECT money FROM `users` WHERE `usr` = '$item[usr]' LIMIT 1");
////////////////////////////
$m = mysql_fetch_array($req);
$m[money]=$m[money]+$item[mycena];
mysql_query("UPDATE `users` SET `money` = '$m[money]' WHERE `usr` = '$item[usr]'");

$time = date("H:i d.m.y");
$text = "$item[name] преобрёл $log, сумма $item[mycena] монет была успешно вам перечислена!";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Торговец', `user_to` = '$item[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");

echo"Вещь $item[name] куплена за $item[mycena] монет!<br/>";
}else{
echo"Нет такой вещи<br/>";
}
}elseif($_GET[tip]==res){
$req = mysql_query("SELECT * FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto==1){
$res = mysql_fetch_array($req);

if($res[usr]==$log){
echo'Свои товары нельзя покупать!';
include($path.'inc/down.php');exit;
}
if($udata[money]<$res[mycena]){
echo'Нехватает монет!';
include($path.'inc/down.php');exit;
}

$udata[money]=$udata[money]-$res[mycena];//mony

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
        
$req = mysql_query("SELECT * FROM `zamok` WHERE `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$city = mysql_fetch_array($req);
if($city[clan]!='not' and $udata[clan]!=$city[clan]){
$req = mysql_query("SELECT * FROM `clan` WHERE `lider`='$city[clan]'");
////////////////////////////
$clan = mysql_fetch_array($req);
$clan[money]=$clan[money]+round(($item[mycena]/100)*2);

mysql_query("UPDATE `clan` SET `money` = '$clan[money]' WHERE `lider` = '$city[clan]'");
}
        
}else{
$myres=mysql_fetch_array($req);
$myres[kol]=$myres[kol]+$res[kol];
mysql_query("UPDATE `res` SET `kol` = '$myres[kol]' WHERE `usr` = '$log' and `lat_name`='$res[lat_name]'");
}
/////////////////////
mysql_query("DELETE FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");//с база

        mysql_query("UPDATE `users` SET `money` = '$udata[money]' WHERE `usr` = '$log'");
        
$req = mysql_query("SELECT money FROM `users` WHERE `usr` = '$res[usr]' LIMIT 1");
////////////////////////////
$m = mysql_fetch_array($req);
$m[money]=$m[money]+$res[mycena];
mysql_query("UPDATE `users` SET `money` = '$m[money]' WHERE `usr` = '$res[usr]'");

$time = date("H:i d.m.y");
$text = "$res[name]($res[kol] штук) преобрёл $log, сумма $res[mycena] монет была успешно вам перечислена!";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Торговец', `user_to` = '$res[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");

echo"$res[name]($res[kol] штук) куплены за $res[mycena] монет!<br/>";
}else{
echo"Нет ресурсов!<br/>";
}
}else{
echo'Ошибка!<br/>';
}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'info':
if($_GET[tip]==res){
$req = mysql_query("SELECT * FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");

$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
$mag = mysql_fetch_array($req);
switch($mag[tip]){
case 'res':
$tip='Ресурс';
break;
case 'scroll':
$tip='Свиток';
break;
case 'elexir':
$tip='Элексир';
break;
case 'rec':
$tip='Рецепт';
break;
}
echo"<b>$mag[name]</b><br/>
Тип: $tip<br/>
Количество: $mag[kol]<br/>
";
}elseif($_GET[tip]==pit){
$req = mysql_query("SELECT * FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");

$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
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
}
switch($mag[rasa]){
case 'not':
$rasa='Все';
break;
case 'wolf':
$rasa='Волк';
break;
case 'dog':
$rasa='Собака';
break;
}

echo"<b>$mag[name]</b><br/>
Тип: $tip<br/>
<b>Характеристика</b><br/>
Урон: $mag[sila]<br/>
Защита: $mag[prot]<br/>
<b>Бонусы:</b><br/>
Жизнь: $mag[hp]<br/>
Мана: $mag[mp]<br/>

<b>Требования:</b><br/>
Раса: $rasa<br/>
Уровень: $mag[nlvl]<br/>
";

}else{
$req = mysql_query("SELECT * FROM `bazar` WHERE `id`='".mysql_real_escape_string($_GET[id])."' and `city` = '$udata[city]'");

$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
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

///////////////////////
$u=explode('*',$mag[name]);
echo"<br/><img src=\"shmot/$u[0].png\" alt=\"pic\"/> <b>$mag[name]</b><br/>
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


}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'pit':
$b = mysql_query("SELECT * FROM bazar WHERE baz_tip = 'pit' and `city` = '$udata[city]' ORDER BY id DESC");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"$i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar.php?mod=info&amp;tip=pit&amp;id=$best[id]\">$best[name]</a> ($best[mycena] монет)
  [<a href=\"bazar.php?mod=by&amp;tip=pit&amp;id=$best[id]\">купить</a>]<br/>";
$i++;
}
}else{
echo"Нет вещей на продаже<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'item':
$b = mysql_query("SELECT * FROM bazar WHERE baz_tip = 'item' and `city` = '$udata[city]' ORDER BY id DESC");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"$i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar.php?mod=info&amp;tip=item&amp;id=$best[id]\">$best[name]</a> ($best[mycena] монет)
  [<a href=\"bazar.php?mod=by&amp;tip=item&amp;id=$best[id]\">купить</a>]<br/>";
$i++;
}
}else{
echo"Нет вещей на продаже<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'res';
$b = mysql_query("SELECT * FROM bazar WHERE baz_tip = 'res' and `city` = '$udata[city]' ORDER BY id DESC");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"$i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar.php?mod=info&amp;tip=res&amp;id=$best[id]\">$best[name]</a> ($best[kol] штук - $best[mycena] монет)
  [<a href=\"bazar.php?mod=by&amp;tip=res&amp;id=$best[id]\">купить</a>]<br/>";
$i++;
}
}else{
echo"Нет ресурсов продаже<br/>";
}
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
case 'shop':
$_GET[usr] = htmlspecialchars(stripslashes(addslashes($_GET[usr])));
$b2 = mysql_query("SELECT usr FROM bazar WHERE usr = '".mysql_real_escape_string($_GET[usr])."' and city = '$udata[city]' LIMIT 1");
////////////////////////////
$avto2=mysql_num_rows($b2);
if($avto2==0){
echo'Нет такой торговой лавки!';
include($path.'inc/down.php');
exit;
}
echo'<div class="event">';
echo"<hr/><b>Вещи:</b><br/>";
$b = mysql_query("SELECT * FROM bazar WHERE baz_tip = 'item' and city = '$udata[city]' and usr = '".mysql_real_escape_string($_GET[usr])."' ORDER BY id DESC");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"<div class=dot> $i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar.php?mod=info&amp;tip=item&amp;id=$best[id]\">$best[name]</a> ($best[mycena] монет)
  [<a href=\"bazar.php?mod=by&amp;tip=item&amp;id=$best[id]\">купить</a>]</div>";
$i++;
}
}else{
echo"<div class=dot> ПусТо </div>";
}

echo"<hr/><b>Ресурсы:</b><br/>";
$b = mysql_query("SELECT * FROM bazar WHERE baz_tip = 'res' and city = '$udata[city]' and usr = '".mysql_real_escape_string($_GET[usr])."'");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"<div class=dot> $i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar.php?mod=info&amp;tip=res&amp;id=$best[id]\">$best[name]</a> ($best[kol] штук - $best[mycena] монет)
  [<a href=\"bazar.php?mod=by&amp;tip=res&amp;id=$best[id]\">купить</a>]</div>";
$i++;
}
}else{
echo"<div class=dot> ПусТо </div>";
}
echo"<hr/><b>Вещи для питомцев:</b><br/>";
$b = mysql_query("SELECT * FROM bazar WHERE baz_tip = 'pit' and city = '$udata[city]' and usr = '".mysql_real_escape_string($_GET[usr])."'");
////////////////////////////
$avto=mysql_num_rows($b);
if($avto>=1){
$i=1;
While($best = mysql_fetch_array($b))
{
echo"<div class=dot> $i. <a href=\"search.php?nick=$best[usr]&amp;go=go\">$best[usr]</a>
 продаёт <a href=\"bazar.php?mod=info&amp;tip=pit&amp;id=$best[id]\">$best[name]</a> ($best[mycena] монет)
  [<a href=\"bazar.php?mod=by&amp;tip=pit&amp;id=$best[id]\">купить</a>]</div>";
$i++;
}
}else{
echo"<div class=dot> ПусТо </div>";
}

echo'</div>';
echo"<hr/><div class=silka><a href=\"bazar.php?\">Назад</a></div>";
break;
}
include($path.'inc/down.php');
?>