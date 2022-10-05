<?php

$headmod = 'shopsoul';//фикс. места

$textl='Магазин';
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


switch($_GET[mod]){

default:

$req = mysql_query("SELECT * FROM `shopsoul`");
////////////////////////////
$avto=mysql_num_rows($req);
echo "<div class=menu><b><font color=grey>Выберите  элексир:</font></b><br/></div>";
echo "<small><font color=#007F46>(цены указаны за 1000 штук)</font></small>";
echo "<hr/>";
echo "<form action=\"shopsoul.php?mod=sell\" method=\"POST\">";

While($mag = mysql_fetch_array($req))
{
$requ = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' ");
$udata = mysql_fetch_array($requ);
if ($udata[klas]=="wizard") {$k=2; $name=Spiritshot;}
if ($udata[klas]=="fighert") {$k=1; $name=Soulshot;}

echo" <img src=\"pic/skr/$k/$mag[nlvl].jpeg\" alt=\"*\"/>";
echo " <label><input type='radio' name='result' value='$mag[id]' /></label>\n";

if($mag[nlvl]==0) $gr=NG;
if($mag[nlvl]==20) $gr=D;
if($mag[nlvl]==40) $gr=C;
if($mag[nlvl]==52) $gr=B;
if($mag[nlvl]==62) $gr=A;
if($mag[nlvl]==76) $gr=S;
if($mag[nlvl]==91) $gr=R;
if($mag[nlvl]==111) $gr=R111;
echo "$name";
echo "<br/> &#160   Грейд вещи:  $gr (для оружия $mag[nlvl] ур.)<br/>";
echo "&#160   Цена:  $mag[cena] VoteCoin <hr/>";
}

echo "<div class=menu><b><font color=grey>Введите <br/> кол-во Shot:</b><br/>
<input type=\"text\" name=\"col\" size=\"5\" maxlength=\"9\"/> ";

echo " х 1000 </font><br/><input type='submit' name='ok' value='Купить' /><hr/></div>\n";

echo"<br/><a href=\"shopsoul.php?\">Назад</a>";
break;


case 'sell':

if (empty($_POST[result])){
echo "Вы не выбрали Shot!";}else{


if (empty($_POST[col]) or $_POST[col]<=0){
echo "Вы не ввели нужное количество Shot!";}else{

$_GET[id]=$_POST['result'];
$col = $_POST[col];
$col2 = $col * 1000; // кол банок

$req = mysql_query("SELECT * FROM `shopsoul` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");

$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка, такой вещи нет!';
include($path.'inc/down.php');
exit;
}
$mag = mysql_fetch_array($req);

$req=mysql_query("SELECT * FROM domination WHERE id = '1'");
$dom = mysql_fetch_assoc($req);
if($dom['white']>$dom['black']){
$liders='white';
}elseif($dom['black']>$dom['white']){
$liders='black';
}else{
$liders='not';
}
if($udata['storona']==$liders){
$mag[cena]=round($mag[cena]-(($mag[cena]/100)*15));
}

$cen = $mag[cena]*$col; 		// цена элексира
$nmoney = $udata[votecoin]-$cen;	// сколько осталось

if($nmoney<0){
echo'Нехватает VoteCoin!';
}else{
$req1 = mysql_query("SELECT * FROM `soulshots` WHERE `usr` = '$log' and `nlvl` = '$mag[nlvl]'");
$res = mysql_fetch_array($req1);
$avto1=mysql_num_rows($req1);

if($avto1==0){


mysql_query("INSERT INTO `soulshots` (`id` ,
`usr` ,
`kol` ,
`status` ,
`nlvl` 
)
VALUES (NULL , '$log', '$col2', '1', '$mag[nlvl]')");



        
$req = mysql_query("SELECT * FROM `zamok` WHERE `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$city = mysql_fetch_array($req);
if($city[clan]!='not' and $udata[clan]!=$city[clan]){
$req = mysql_query("SELECT * FROM `clan` WHERE `lider`='$city[clan]'");
////////////////////////////
$clan = mysql_fetch_array($req);
$clan[money]=$clan[money]+round(($mag[cena]/100)*2);

mysql_query("UPDATE `clan` SET `money` = '$clan[money]' WHERE `lider` = '$city[clan]'");
}

}else{
$req = mysql_query("SELECT * FROM `zamok` WHERE `city` = '$udata[city]' LIMIT 1");
////////////////////////////
$city = mysql_fetch_array($req);
if($city[clan]!='not' and $udata[clan]!=$city[clan]){
$req = mysql_query("SELECT * FROM `clan` WHERE `lider`='$city[clan]'");
////////////////////////////
$clan = mysql_fetch_array($req);
$clan[money]=$clan[money]+round(($mag[cena]/100)*2);

mysql_query("UPDATE `clan` SET `money` = '$clan[money]' WHERE `lider` = '$city[clan]'");
}
$nk=$res[kol]+$col2;
mysql_query("UPDATE `soulshots` SET `kol` = '$nk' WHERE `usr` = '$log' and `nlvl` = '$mag[nlvl]'");
}
mysql_query("UPDATE users SET votecoin = '$nmoney' WHERE usr = '$log'");

echo"
Вещь $mag[name] куплена в количестве $col2 штук!<br/>
VoteCoin потрачено: $cen<br/>
VoteCoin осталось: $nmoney<br/>
";
}}}
echo"<br/><a href=\"shopsoul.php?\">Назад</a>";

break;
}
include($path.'inc/down.php');
?>