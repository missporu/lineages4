<?php

$headmod = 'event';//фикс. места

$textl='Арена';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

switch($_GET[mod]){

default:

/*
if ($udata[dostup]>4){



$date = date("d.m.Y");
$times = date("H:i");



$datans = date("H:i-w");

//if ($datans == '15:00-0'){ // в 3 часа дня воскресенье
if (!empty($datans)){ // в 3 часа дня воскресенье



$avto=mysql_num_rows(mysql_query("SELECT * FROM `eve_mob` ORDER BY `skoko` DESC LIMIT 3"));
if($avto > 0 and $avto <=3){


if (empty($i)){$i=1;}
while ($i <= 3){

$req = mysql_query("SELECT * FROM `eve_mob` ORDER BY `skoko` DESC LIMIT 1");
$mag = mysql_fetch_array($req);


if ($i==1) {$mesto="1"; $col=90;}
if ($i==2) {$mesto="2"; $col=60;}
if ($i==3) {$mesto="3"; $col=40;}
if ($i==3){$br="<hr/><br/><br/>";}

//перед тем, что бы писать первого, чистим таблицу
//if ($i==1){mysql_query("DELETE FROM `event`");}

//if (empty($mag[usr])){$mag[usr]="Пусто";}
echo ".:: <b>$mag[usr]</b> победитель эвента <font color=#8B475D>\"Убийца монстров\"</font> занявший $mesto место от $date . Награда $col Coin of Luck $br <br/>";

//mysql_query("DELETE FROM `eve_mob` WHERE `usr` = '$mag[usr]'");//удаляем первого

$i++;}

//mysql_query("DELETE FROM `eve_mob`");//чистим логи всех участников
}

$newtm = time()+604800;
//mysql_query("UPDATE `time` SET `eve_mob` = '$newtm'"); //  записуем следущее время запуска
}



}*/


if ($_GET[mod]=='r'){
echo "<font color=#527F3F>Первые по рыбалке:</font><br/><br/>";
$req = mysql_query("SELECT * FROM `fish_log` WHERE `ids`>'0' ORDER BY `skoko` DESC LIMIT 5");
$avto=mysql_num_rows($req);$i=1;
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo '<div class=inoy> <a href="search.php?nick='.$mag[usr].'&amp;go=go">.: '.$mag[usr].'  <font color=#ffffff> ` '.$mag[skoko].'</font></a> </div>';
$i++;}}else {echo "В даном эвенте нет участников!<br/>";}//написать что в эвенте никто не участвовал
echo "<br/>";
echo "<hr/>";
//----------------------






//--------------первые по мобам---------------------------------


echo "<font color=#527F3F>Первые по убийствам монстров:</font><br/><br/>";
$req = mysql_query("SELECT * FROM `eve_mob` WHERE `id`>'0' ORDER BY `skoko` DESC LIMIT 5");
$avto=mysql_num_rows($req);$i=1;
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo '<div class=inoy> <a href="search.php?nick='.$mag[usr].'&amp;go=go">.: '.$mag[usr].'  <font color=#ffffff> ` '.$mag[skoko].'</font></a> </div>';
$i++;}}else {echo "В даном эвенте нет участников!<br/>";}//написать что в эвенте никто не участвовал
echo "<br/>";
echo "<hr/>";
//----------------------

echo "<font color=#527F3F>Первые по убийствам в PK:</font><br/><br/>";
$req = mysql_query("SELECT * FROM `eve_pk` WHERE `id`>'0' ORDER BY `skoko` DESC LIMIT 5");
$avto=mysql_num_rows($req); $i=1;
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo '<div class=inoy> <a href="search.php?nick='.$mag[usr].'&amp;go=go">.: '.$mag[usr].'  <font color=#ffffff> ` '.$mag[skoko].'</font></a> </div>';
$i++;}}else {echo "В даном эвенте нет участников!<br/>";}//написать что в эвенте никто не участвовал
echo "<br/>";
echo "<hr/>";
//--------------//---------------//------------//-------------//--
}else{

echo "<div class=silka><a href=\"event.php?mod=r\">Список первых по эвэнтам</a></div><br/>";


		        $avto45 = mysql_num_rows(mysql_query("SELECT * FROM `event`"));

				$str = round($avto45/9);

   if($_GET['page']<=0 or $_GET['page'] >= $str){
		
		$page = $str;
		
		}else{
		$page = intval($_GET['page']);
		}

		$from = ($page-1)*9;
		
		        $avto = mysql_num_rows(mysql_query("SELECT * FROM `event`"));
            $pages1=$avto/9;
            $pages=round($avto/9);
            if($pages1>$pages){
            $pages=$pages+1;
            }
			


			if ($avto > 0){




$req = mysql_query("SELECT * FROM `event` WHERE `id` >= '0' ORDER BY `id` ASC LIMIT $from,9");
////////////////////////////
//if(mysql_num_rows($req)>=1){

While($eve = mysql_fetch_array($req))
{

echo "<hr/> $eve[text] ";

}

echo "</div><hr><p>Страниц: "; navig2($page, '?', $pages);

}else{echo "<div class=menu><div class=menu>Нет Эвэнтов.";}

//echo "<br/>";
//echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

/*if ($_GET[page] > 0)
{
echo "<a href=\"event.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"event.php?page=$next\">Далее</a>";}
else
{echo "Далее";}
*/
echo "</div>";
break;

}



}
include($path.'inc/down.php');
?>