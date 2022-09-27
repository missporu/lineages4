<?
define('PROTECTOR', 1);

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
	$path='../';			//
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////
if ($udata[dostup]>1){

switch($_GET[mod]){

default:
echo "<p><b><font color=grey>Логи переводов!</font></b></p>";
if($udata[dostup]>4){echo ".::<a href=\"logi.php?mod=paywk\">Покупки</a><br/>";}
echo ".::<a href=\"logi.php?mod=sunduk_ny\">Новогодний Сундук</a><br/>";
echo ".::<a href=\"logi.php?mod=key\">Ключ</a><br/>";
echo ".::<a href=\"logi.php?mod=kol\">Колы</a><br/>";
echo ".::<a href=\"logi.php?mod=money\">Деньги</a><br/>";
echo ".::<a href=\"logi.php?mod=giveitem\">Передача вещей</a><br/>";
echo ".::<a href=\"logi.php?mod=giveres\">Передача ресурсов</a><br/>";
echo ".::<a href=\"logi.php?mod=givepit\">Передача вещей питомцев</a><br/>";
echo ".::<a href=\"logi.php?mod=put\">Ложение на склад</a><br/>";
echo ".::<a href=\"logi.php?mod=take\">Взятие со склада вещей</a><br/>";
echo ".::<a href=\"logi.php?mod=offvesh\">Выбрасывание вещей</a><br/>";
echo ".::<a href=\"logi.php?mod=offres\">Выбрасывание ресурсов</a><br/>";
echo ".::<a href=\"logi.php?mod=slomal\">Неудачная заточка</a><br/>";
echo ".::<a href=\"logi.php?mod=kraft\">Неудачный крафт</a><br/>";
break;

case 'paywk': 
$reqvh = mysql_query("SELECT * FROM `logi_paywk` WHERE `tip` = 'item' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);  
if ($avto>0){   
While($logi = mysql_fetch_array($reqvh))  
{  
echo "  <font color=#565656>$logi[text]<hr/>"; 
}  
}  
else{echo "<br/><p><b><u>Покупок не было.</b></u><br/><br/></p>";}  
break;
case 'kraft':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'kraft' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[text]<hr/>";
}
}
else{echo "<br/><p><b><u>неудачных крафтов небыло.</b></u><br/><br/></p>";}
break;
case 'sunduk_ny':
$reqvh = mysql_query("SELECT * FROM `logi_ny` WHERE `tip` = 'item' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh); 
if ($avto>0){  
While($logi = mysql_fetch_array($reqvh)) 
{ 
echo "  <font color=#565656>$logi[text]<hr/>";
} 
} 
else{echo "<br/><p><b><u>Выиграшей не было.</b></u><br/><br/></p>";} 
break;
case 'key': 
$reqvh = mysql_query("SELECT * FROM `logi_k` WHERE `tip` = 'item' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh); 
if ($avto>0){  
While($logi = mysql_fetch_array($reqvh)) 
{ 
echo "  <font color=#565656>$logi[text]<hr/>";
} 
} 
else{echo "<br/><p><b><u>Выиграшей не было.</b></u><br/><br/></p>";} 
break;
case 'kol':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'kol' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;

case 'slomal':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'slomal' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Поломок небыло.</b></u><br/><br/></p>";}
break;

case 'money':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'money' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;
case 'giveitem':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'giveitem' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;
case 'giveres':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'giveres' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;
case 'givepit':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'givepit' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;
case 'put':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'put' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;
case 'take':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'take' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Переводов небыло.</b></u><br/><br/></p>";}
break;

case 'offvesh':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'offvesh' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Вещей не выбрасывали.</b></u><br/><br/></p>";}
break;

case 'offres':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'offres' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Рерурсы не выбрасывали.</b></u><br/><br/></p>";}
break;

case 'clcol':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'clcol' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Вещей не выбрасывали.</b></u><br/><br/></p>";}
break;

case 'сladen':
$reqvh = mysql_query("SELECT * FROM `logi` WHERE `tip` = 'сladen' ORDER BY `id` DESC LIMIT 0,30");
$avto = mysql_num_rows($reqvh);
if ($avto>0){ 

While($logi = mysql_fetch_array($reqvh))
{
echo "  <font color=#565656>$logi[id]) $logi[text]:<hr/>";
}
}
else{echo "<br/><p><b><u>Ресурсы не выбрасывали.</b></u><br/><br/></p>";}
break;


}

}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>
