<?php

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

if ($udata[dostup]>=3){

switch($_GET[mod]){

default:
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(empty($_POST[nick])){ $nick = $_GET[nick];}else{$nick = $_POST[nick];}

if(!empty($_GET[nick]))  {$_POST[nick]=$_GET[nick];}
   

   
if(empty($_POST[nick])){

   echo "<p><b><font color=grey>Данные игрока ______ !</font></b></p>";

echo '<form action="vhod.php?" method="post">';
echo"Ник:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"$nick\" name=\"nick\"/><br/>";




echo '<input class="button" type="submit" value="Смотреть" /></form>';
}else{

echo "<p><b><font color=grey>Данные игрока $nick !</font></b></p>";



//////////
// Выводим прошлые данные входа
$lim = $_GET[lim];
if (empty($lim)){$lim=1;} // если лимит не указан то он равен 1
echo "<font color=#A0A0A0>Показать последние <br/>";

if ($lim == '1'){echo "1 , ";}else{echo "<a href=\"vhod.php?lim=1&amp;nick=$nick\">1</a> , ";}
if ($lim == '2'){echo "2 , ";}else{echo "<a href=\"vhod.php?lim=2&amp;nick=$nick\">2</a> , ";}
if ($lim == '3'){echo "3 , ";}else{echo "<a href=\"vhod.php?lim=3&amp;nick=$nick\">3</a> , ";}
if ($lim == '4'){echo "4 , ";}else{echo "<a href=\"vhod.php?lim=4&amp;nick=$nick\">4</a> , ";}
if ($lim == '5'){echo "5 `` ";}else{echo "<a href=\"vhod.php?lim=5&amp;nick=$nick\">5</a> `` ";}

echo " входов.</font>";
$reqvh = mysql_query("SELECT * FROM `vhod` WHERE `usr` = '$nick' ORDER BY `id` DESC LIMIT $lim");
$avto=mysql_num_rows($reqvh);
if ($avto>0){ $ii = 1;

While($vhod = mysql_fetch_array($reqvh))
{
echo "<hr/>  <font color=#565656><u><b>$ii) Данные входа $vhod[id]:</b></u><br/>";
echo"<b>Бр.</b> $vhod[brow]<br/>";
echo"<b>IP:</b> $vhod[ip]<br/>";
echo"<b>Дата/время:</b><br/> $vhod[data]<br/></font>";
$ii++;
}
}
else{echo "<br/><p><b><u>Входов  этого персонажа не было.</b></u><br/><br/></p>";}
// -------------------------




echo "<br/><a href=\"/gm/\">Назад</a></div>";
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
break;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>