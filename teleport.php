<?
define('PROTECTOR', 1);

$headmod = 'shopsoul';//фикс. места
$textl='Магазин';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');




$id=$_GET['gorod'];
$id = htmlspecialchars(stripslashes($id));

$req = mysql_query("SELECT * FROM `getekeeper` WHERE `id`='$id' and `gorod`='$udata20' ");

$avto=mysql_num_rows($req);
if($avto==0){
header ("Location: gk.php?");
exit;
}
$mag = mysql_fetch_array($req);
///////////////

/////////////
if($udata9<=20){
$mag['cena']=0;
}
$nmoney=$udata8-$mag[cena];

if($nmoney<0){ header ("Location: gk.php?&error=adencastle");

echo"<small>Не хватает денег!<br/>";
include_once("inc/down.php");
exit;
 }

if($udata20=="Talking Island Village" or $udata20=="Dark Elven Village" or $udata20=="Elven Village" or $udata20=="Orc Village" or $udata20=="Dwarven Village" or $udata20=="Gludin Village" or $udata20=="" or $udata20=="Hunters Village"){
if ($mag['name']=="$udata20 Castle" and $mag['town']=="$udata20" ){

$date=date("D");
$time=date("H:i");
    if($date!=="Sun"){header ("Location: gk.php?vilage");}
if($date=="Sun"){
	if($time>"18:00" or $time<"16:00"){
header ("Location: gk.php?vilage");exit;}}
$aglava=mysql_query("SELECT * FROM `clan` WHERE `clan0`='$udata23'  ");
$arrs= mysql_fetch_array($aglava);
$ggg1=$arrs['clan9'];
if($ggg1>"5"){header ("Location: gk.php?clan");exit;}


}}

if ($mag[name]=="$udata20 Castle" and $udata9<="51"){

        header ("Location: gorod.php?&errorr=lvl");

echo"<small>Захватывать замки можно с 52 уровня<br/>";
include_once("inc/down.php");
exit; }
mysql_query("UPDATE `users` SET `udata37`='$mag[name]' WHERE `udata0`='$log'");
mysql_query("UPDATE `users` SET `udata20`='$mag[town]' WHERE `udata0`='$log'");
mysql_query("UPDATE `users` SET `udata8`='$nmoney' WHERE `udata0`='$log'");


$udata8=number_format($udata8);

if($mag[gk]=="gorod"){
echo"Вы телепортировались <b>$mag[town]</b><br>
У вас осталось $udata8 аден.<br>";
echo"<a href=\"gorod.php?\">Продолжить</a>";
mysql_query("UPDATE `users` SET `udata37`='' WHERE `udata0`='$log'");
}

if($mag[gk]=="combat" ){


$req = mysql_query("SELECT * FROM `who_usr` WHERE `nick` = '$log'");

if(mysql_num_rows($req) == 0){

mysql_query("INSERT INTO `who_usr` SET `nick` = '$log', `who` = 'combat'");

}


echo"Вы телепортировались <b>$mag[name]</b><br>
У вас осталось $udata8 аден.<br>";
echo"<a href=\"okrestnosti.php?\">Продолжить</a>";


}











include($path.'inc/down.php');
?>


