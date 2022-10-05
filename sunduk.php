<?php

$headmod = 'sunduk';

$textl='Открытие сундуков';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
//if ($udata[dostup]<4){echo'Подождите! Делаем что то новое =)<br/>';echo"<br/><a href=\"pers.php?\">Назад</a>";include($path.'inc/down.php');exit;}


switch($_GET[mod]){


default:

$resk = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' && `name` = 'Ключ'");
$avk = mysql_num_rows($resk);
$fak = mysql_fetch_array($resk);
$avk = $fak[kol];
if (empty($avk)){$avk = 0;}
if ($avk==0){

echo "<p><font color=grey><b>У Вас нет Ключей</b></font></p>";


echo "<div class=inoy><a href=\"inventar.php\">Инвентарь</a></div>";
echo "<div class=silka><a href=\"gorod.php\">В город</a></div>";
}else{


if (isset($_GET[yes])){ 


if($avk>0){
$req22 = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `name` = 'Ключ'");
$res=mysql_num_rows($req22);
$rs = mysql_fetch_array($req22);
if($res==0){
echo "<p><font color=red>У Вас нет Ключей...</font></p>";
echo"<div class=inoy><a href=\"open_s_aden.php\">Назад</a></div>";
}else{
$avk=$avk-1;
$nk=$rs[kol]-1;
mysql_query("UPDATE `res` SET `kol` = '$avk' WHERE `usr` = '$log' and `name` = 'Ключ'");
if($nk <= 0){ //удаляем
mysql_query("DELETE FROM `res` WHERE `usr` = '$log' and `name` = 'Ключ' LIMIT 1");
mysql_query("DELETE FROM `res` WHERE `id` = '$rs[id]' LIMIT 1");
}
}
}else{echo"У вас нету Ключей<br>";include($path.'inc/down.php');exit;}


///////// RES ////////

$shans=rand(1,100);
if($shans<=30){
if(empty($coldrop)){$coldrop = 1;}
$req = mysql_query("SELECT * FROM `keydrop`");
$rezdrop=mysql_num_rows($req);
$drop=rand(1,$rezdrop);
$req = mysql_query("SELECT * FROM `keydrop` WHERE `id` = '$drop' LIMIT 1");
$drops = mysql_fetch_array($req);

///////////////////
//--------пишем для рецептов---------
if ($drops[lat_name] == "recipe"){
$reqshop = mysql_query("SELECT * FROM `shop` ORDER BY RAND() LIMIT 1"); // случайный с таблици
$rezshop=mysql_fetch_array($reqshop);
$name2=explode(":",$drops[name]);
$drops[name] = $name2[0];
$drops[name]="$drops[name]: $rezshop[name]"; // рецепт : имя
$drops[lat_name]="$drops[lat_name]$rezshop[id]"; // рецепт+ид что бы не путать
$drops[give]=$rezshop[id]; // пишем ид шмота
$drops[cena]=round($rezshop[cena]/3); // считаем цену
$coldrop = 1;}
//----------------------
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `lat_name` = '$drops[lat_name]'");
$res=mysql_num_rows($req);
$rs = mysql_fetch_array($req);
 
if (empty($drops[name])){$drops[name]='Выпал хлам (выкинуто)'; $rez_res=0;}else{
 
if($res==0){
mysql_query("INSERT INTO
         `res` SET
         `usr` = '$log',
         `name` = '$drops[name]',
         `lat_name` = '$drops[lat_name]',
         `tip` = '$drops[tip]',
         `what` = '$drops[what]',
         `give` = '$drops[give]',
         `kol` = '$coldrop',
         `cena` = '$drops[cena]'");
}else{
$nk=$rs[kol]+$coldrop;
mysql_query("UPDATE `res` SET `kol` = '$nk' WHERE `usr` = '$log' and `lat_name` = '$drops[lat_name]'");
}
$rez_res = " <font color=red>Выпало</font>:<b> <font color=aqua>$drops[name]</font> х$coldrop </b><br/>";
}
}
else{$rez_res = 0;}
/////----------------------------------


//-----Выпадение шмотки------
$shans=rand(1,400);
if($shans<='1'){
mysql_query("INSERT INTO
`item` SET
`usr` = '$log',
         `tip` = 'weapon',
`ruka` = 'luk',
`name` = 'VIP Dragon Grinder',
         `cena` = '2000',
         `patt` = '20000',
         `matt` = '1000',
         `pdef` = '0',
`mdef` = '0',
         `soul` = '1',
`spirit` = '1',
`razb` = 'yes',
`image` = 'not'");
//-----logi------
$text = "[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> выиграл $_POST[item] <font color=darkorange>VIP Dragon Grinder</font>";
$timelog = date("H:i"); 
$datelog = date("d.m.y"); 
mysql_query("INSERT INTO `logi_k` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---
$time = date("H:i");   
/*
$msg = "<font color=gold><b>Невероятно</font><font color=white>! Игрок <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> получил артефакт: <font color=darkorange>VIP Dragon Grinder</font> в сундуке!</b></font>";
mysql_query("INSERT INTO komentarai SET nick = 'Система', komentaras = '$msg', kada = '$data', time = '$time'");
*/
$rez_item = " <br><font color=lime><b>Удача!</font> <font color=white>вам выпал:</font></b> <b><br><font color=orange>VIP Dragon Grinder</font></b><br/>";
}else{$rez_item = 0;}
//---------Конец--------



$r_kush=rand(1,100);
$kush=rand(100,100);
if ($r_kush<=0.8){
$kushnew=$udata[almaz]+$kush;
mysql_query("UPDATE `users` SET `almaz` = '$kushnew' WHERE `usr` = '$log' LIMIT 1");
//-----logi------  
$text = "[$time] <font color=darkorange><b> какая удача!</font></b> <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> выиграл $_POST[kush] <font color=yellow>Coin of Luck</font> $kush шт. ";
$timelog = date("H:i");   
$datelog = date("d.m.y");   
mysql_query("INSERT INTO `logi_k` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end--- 
$rez_kush = " <font color=red>Выпало</font>: <b>$kush <font color=yellow>Coin of Luck</font><font color=darkorange> какая удача!</font> </b><br/>";
}else{$rez_kush = 0;}


$r_col=rand(1,100);
$kol=rand(1,10);
if ($r_col<=30){
$colnew=$udata[almaz]+$kol;
mysql_query("UPDATE `users` SET `almaz` = '$colnew' WHERE `usr` = '$log' LIMIT 1");
//-----logi------ 
$text = "[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> выиграл $_POST[coin] <font color=yellow>Coin of Luck</font> $kol шт. ";
$timelog = date("H:i");  
$datelog = date("d.m.y");  
mysql_query("INSERT INTO `logi_k` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---
$rez_col = " <font color=red>Выпало</font>: <b>$kol <font color=yellow>Coin of Luck</font> </b><br/>";
}else{$rez_col = 0;}

$r_aden=rand(1,100);
$aden=rand(1,5000000);
if ($r_aden<=25){
$moneynew=$udata[money]+$aden;
mysql_query("UPDATE `users` SET `money` = '$moneynew' WHERE `usr` = '$log' LIMIT 1");
$rez_aden = " <font color=red>Выпало</font>: <b>".number_format($aden, 0, ',', " ")." <font color=orange>Аден</font> </b><br/>";
}else{$rez_aden = 0;}

$r_vote=rand(1,100);
$votecoin=rand(1,5);
if ($r_vote<=25){
$votenew=$udata[votecoin]+$votecoin;
mysql_query("UPDATE `users` SET `votecoin` = '$votenew' WHERE `usr` = '$log' LIMIT 1");
//-----logi------ 
$text = "[$time] <a href=\"/search.php?nick=$log&amp;go=go\">$log</a> выиграл $_POST[votec] <font color=red>Vote</font><font color=yellow>Coin</font> $votecoin шт. ";
$timelog = date("H:i");  
$datelog = date("d.m.y");  
mysql_query("INSERT INTO `logi_k` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---
$rez_vote = " <font color=red>Выпало</font>: <b>$votecoin <font color=red>Vote</font><font color=yellow>Coin</font> </b><br/>";
}else{$rez_vote = 0;}





echo "<div class=dot><u>Cундук успешно открыт:</u><br/><br/>";

if (empty($rez_aden) and empty($rez_col) and empty($rez_kush) and empty($rez_vote) and empty($rez_res) and empty($rez_item))
{echo "<b><font color=orangered>Ничего не выпало...<img src='pic/fig.gif' height=30' width='30'></font></b>";}
else
{
if (!empty($rez_aden)){echo "$rez_aden";}
if (!empty($rez_col)){echo "$rez_col";}
if (!empty($rez_kush)){echo "$rez_kush";}
if (!empty($rez_vote)){echo "$rez_vote";}
if (!empty($rez_res)){echo "$rez_res";}
if (!empty($rez_item)){echo "$rez_item";}
}

$av - 1;

echo "</p><p>Осталось: $avk Ключей";
echo "</p></div>";
if ($avk>0){ 
echo "<div class=inoy><a href=\"?yes\">Открыть еще один</a></div>"; 


}
echo'<div class=dot><b><br><center><font color=violette>последние выиграши</font>:</b><br><br></center>';
$reqvh = mysql_query("SELECT * FROM `logi_k` WHERE `tip` = 'item' ORDER BY `id` DESC LIMIT 0,10");
$avto = mysql_num_rows($reqvh); 
if ($avto>0){  
While($logi = mysql_fetch_array($reqvh)) 
{ 
echo "  <font color=#565656>$logi[text]</font><hr/>";
} 
}
$reqvh = mysql_query("SELECT * FROM `logi_k` WHERE `tip` = 'coin' ORDER BY `id` DESC LIMIT 0,10");
$avto = mysql_num_rows($reqvh); 
if ($avto>0){  
While($logi = mysql_fetch_array($reqvh)) 
{ 
echo "  <font color=#565656>$logi[text] $ko</font>l<hr/>";
} 
}
$reqvh = mysql_query("SELECT * FROM `logi_k` WHERE `tip` = 'kush' ORDER BY `id` DESC LIMIT 0,10");
$avto = mysql_num_rows($reqvh);  
if ($avto>0){   
While($logi = mysql_fetch_array($reqvh))  
{  
echo "  <font color=#565656>$logi[text] $ko</font>l<hr/>";
}  
}
$reqvh = mysql_query("SELECT * FROM `logi_k` WHERE `tip` = 'votec' ORDER BY `id` DESC LIMIT 0,10");
$avto = mysql_num_rows($reqvh); 
if ($avto>0){  
While($logi = mysql_fetch_array($reqvh)) 
{ 
echo "  <font color=#565656>$logi[text]</font><hr/>";
} 
}

echo'</div>';
echo "<div class=inoy><a href=\"inventar.php\">Инвентарь</a></div>"; 
echo "<div class=silka><a href=\"gorod.php\">В город</a></div>";

include($path.'inc/down.php');

}
//-------------------------------------------

echo "<p><font color=grey><b>У Вас $avk Ключей</b></font></p>";
echo "<p><font color=#D2B48C>Вы действительно хотите открыт <b><u>Сундук</u></b>? При открытии могут выпасть <font color=yellow>Coin of Luck</font>, <font color=orange>Адена</font>, <font color=red>Vote</font><font color=yellow>Coin</font>, <font color=aqua>Ресурсы</font></b><br><br><font color=orangered>Или же артефакт</font><font color=white>:</font> <font color=sandybrown><b> VIP Dragon Grinder</b></font></font></p>";

echo "<div class=inoy><a href=\"?yes\">Да, хочу</a></div>";

echo "<div class=silka><a href=\"gorod.php\">В город</a></div>";

}

break;



}
include($path.'inc/down.php');
?>