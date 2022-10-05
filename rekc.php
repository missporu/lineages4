<?php

$headmod = 'rekc';//фикс. места

$textl='Рекомендации';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////

//---------------------
$nick=$_GET[nick];
if (!empty($_POST[nick])) {$nick=$_POST[nick];}
$id=$_GET[id];
//---------------------
//-
$data = date("d F Yг. в H:i", strtotime("+20 seconds"));
//-
$data = str_replace("January","Января",$data);
$data = str_replace("February","Февраля",$data);
$data = str_replace("March","Марта",$data);
$data = str_replace("April","Апреля",$data);
$data = str_replace("May","Мая",$data);
$data = str_replace("June","Июня",$data);
$data = str_replace("July","Июля",$data);
$data = str_replace("August","Августа",$data);
$data = str_replace("September","Сентября",$data);
$data = str_replace("October","Октября",$data);
$data = str_replace("November","Ноября",$data);
$data = str_replace("December","Декабря",$data);
////////////////////////////////////////////////////////////////////////


echo "</div> <div class = fon>";

switch($_GET[mod]){

default:


/////////////////////////////////////////////////////////////////
if (isset($_GET[who])){

if (empty($_GET[who])){$_GET[who] = $log;}
if (empty($nick)){$nick = $_GET[who];}



echo "<p><font color=#6CA686>Рекомендации $nick!</font></p><hr/>";




   if($_GET['page']<=0){
		$page = 1;
		}else{
		$page = intval($_GET['page']);
		}
		$from = ($page-1)*10;
		
		        $avto = mysql_num_rows(mysql_query("SELECT * FROM `rekc` WHERE kogo = '$nick'"));
            $pages1=$avto/10;
            $pages=round($avto/10);
            if($pages1>$pages){
            $pages=$pages+1;
            }


$asd = mysql_query("SELECT * FROM rekc WHERE kogo = '$nick' ORDER BY `id` DESC LIMIT $from,10");

$i=1;
While($visi = mysql_fetch_array($asd))
{
echo "<div class=dot>";
echo "<font color=#A6966C><a href=\"search.php?nick=$visi[kto]&go=go\">$visi[kto]</a> рекомендовал <a href=\"search.php?nick=$visi[kogo]&go=go\">$visi[kogo]</a> </font><font color=grey><small>$visi[data]</small></font>";
echo "</div>";
}

echo "</div><hr><p>Страниц: "; navig2($page, 'rekc.php?who='.$nick.'&', $pages);
echo "</p>";





if (empty($_GET[who])) {echo"<br/><div class=silka><a href=\"/?\">Главная</a>";}else{
 echo"<br/><div class=silka><a href=\"search.php?nick=$_GET[who]&go=go\">Вернутся к $_GET[who]</a>";}

include($path.'inc/down.php');

}
////////////////////////////////////////////////////////////////

echo "<hr/><p><font color=orange> * Стоимость рекомендации 15 Coin of Luck</font></p><hr/>";

///////////////////////////////////////////////////////////
if (empty($nick)){

echo "<form action=\"rekc.php?\" method=\"post\">Введите ник:<br/>";
echo "<input name=\"nick\" maxlength=\"25\" title=\"nick\" emptyok=\"true\"/><br/>";
echo "<input type=\"submit\" value=\"Найти\" /></form>";

}else
///////////////////////////////////////////////////////////
{

$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log'");
///////////////////////////
$avto=mysql_num_rows($req);
$usdata = mysql_fetch_array($req);
///////////////////////////

if($avto=="0"){
echo'<font color=red>Нет такого игрока!</font>';
echo"<br/><div class=silka><a href=\"/?\">Главная</a>";
include($path.'inc/down.php');exit;
}




if (isset($_GET[go])){


if($log == $nick){
echo'<font color=red>Себя рекомендовать нельзя!</font>';
if (empty($nick)) {echo"<br/><div class=silka><a href=\"/?\">Главная</a>";}else{
 echo"<br/><div class=silka><a href=\"search.php?nick=$nick&go=go\">Вернутся к $nick</a>";}
include($path.'inc/down.php');exit;
}



$req = mysql_query("SELECT * FROM `rekc` WHERE `kto` = '$log' and `kogo` = '$nick'");
///////////////////////////
$avto=mysql_num_rows($req);
if($avto > 0){
echo'<font color=red>Вы уже рекомендовали этого игрока!</font>';
if (empty($nick)) {echo"<br/><div class=silka><a href=\"/?\">Главная</a>";}else{
 echo"<br/><div class=silka><a href=\"search.php?nick=$nick&go=go\">Вернутся к $nick</a>";}
include($path.'inc/down.php');exit;
}


if ($usdata[almaz]< 15){
echo'<font color=red>Не хватает Coin of Luck!</font>';
if (empty($nick)) {echo"<br/><div class=silka><a href=\"/?\">Главная</a>";}else{
echo"<br/><div class=silka><a href=\"search.php?nick=$nick&go=go\">Вернутся к $nick</a>";}
include($path.'inc/down.php');exit;
}

$almaznew = $usdata[almaz] - 15;
mysql_query ("UPDATE users SET almaz='$almaznew'  WHERE usr='$log' LIMIT 1"); // пишем данные игрока с новой суммой

// создаём в таблице запись
mysql_query("INSERT INTO `rekc` SET `kto` = '$log', `kogo` = '$nick', `data` = '$data'");

$time = date("H:i d.m.y");
$text = " <font color=#6A47FA>Вас рекомендовал <a href=\"search.php?nick=$log&go=go\"><font color=#6A47FA><b>$log</b></font></a>!</font>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$nick', `time` = '$time', `read` = 1, `mail_msg` = '$text'"); // отправляем сообщение


echo "<p><font color=#008282> Вы рекомендовали игрока  <b>$nick</b></font></p><hr/>";

}else{



echo "<p>Вы уверенны что хотите рекомендовать игрока <b>$nick</b>?</p><hr/>";

echo "<div class=inoy>";
 echo"<a href=\"rekc.php?nick=$nick&go\"><font color=green>Да</font></a>";
 echo"<a href=\"search.php?nick=$nick&go=go\"><font color=red>Нет</font></a>";

echo "</div>";


}}
break;

}

if (empty($nick)) {echo"<br/><div class=silka><a href=\"/?\">Главная</a>";}else{
 echo"<br/><div class=silka><a href=\"search.php?nick=$nick&go=go\">Вернутся к $nick</a>";}


include($path.'inc/down.php');
?>