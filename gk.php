<?php
include_once("inc/zag.php");
include_once("inc/mysql.php");
$polz=mysql_query("SELECT * FROM `users` WHERE `udata0`='$log' AND `udata1`='$pas' LIMIT 1");
if(mysql_num_rows($polz)==0){

header ("Location: index.php?error");
echo'<div class="p">Ошибка! Пользователь с таким логином и паролем не зарегистрирован, или пароль/логин неверен! <a href="index.php">На главную</a><br>';exit;

}else{
if ($udata20==""){echo'Говорит: Гнилой, полуживой скелет.<br />Ты провалился в подземелье скорее бижы с него либо ты можете остаться в нем на всю свою жизнь, как я!!! Не делай глупостей когда будешь выбираться на верх, потому что тебя смогут заметить старые, страшные, злые ловцы душ, и тогда тебе прийдеться остаться здесь на долго тоисть на всегда!!!<br /><br /><a href="helpgk.php?log='.$log.'&amp;pas='.$pas.'">Пробивать выбратся</a><br />';}else{

if($go=="lose"){

if($udata48 == "deadmob"){
$expn=round($udata19*0.1/100);

echo'<u>Вы проиграли!</u> Потеряно '.$expn.' опыта.<br><br>';
$expn=$udata19-$expn;

$udata16=$udata17;
$udata7=$udata7+1;


mysql_query("UPDATE `users` SET `udata19`='$expn' WHERE `udata0`='$log'");
mysql_query("UPDATE `users` SET `udata16`='$udata16' WHERE `udata0`='$log'");
mysql_query("UPDATE `users` SET `udata7`='$udata7' WHERE `udata0`='$log'");
mysql_query("UPDATE `users` SET `udata37`='' WHERE `udata0`='$log'");
}
}
if (isset($errorr)){echo'Захватывать замки можно с 52 уровня<br/>';}
if (isset($vilage)){echo'Захватывать деревни можно только в воскресенье с 16:00 до 18:00.<br/>';}
if (isset($clann)){echo'Деревни могут захватывать кланы до 5 уровня!<br/>';}
if (isset($close)){echo'Деревня уже захвачена!<br/>';}
if (isset($error)){echo'У вас не хватает денег.<br/>';}


echo'<br />Вы в городе<b>'.$udata20.'</b><br />';

echo "<img src=\"images/desing/teleport.jpg\" alt=\"\" /><br />";


$qi = mysql_query("SELECT * from `quests` where `town`='$udata20' and `status` = 'on'  and `mesto`='/gk.php' LIMIT 1 ");
$row=mysql_fetch_array($qi);
if (mysql_affected_rows()==1)
{
	echo"<a href=\"quests.php?id=$row[id]\">Задание</a><br/><br/>";}

echo 'Города:<br />';

$qi = mysql_query("SELECT * FROM `getekeeper` WHERE `gorod`='$udata20' and `gk` = 'gorod' ");

while($row=mysql_fetch_array($qi))

{

if($udata20=="Talking Island Village" or $udata20=="Dark Elven Village" or $udata20=="Elven Village" or $udata20=="Orc Village" or $udata20=="Dwarven Village" or $udata20=="Gludin Village" or $udata20=="" or $udata20=="Hunters Village"){









if ($row['name']=="$udata20 Castle"  ){


$date=date("D");
$time=date("H:i:s");

$date=date("D");
$time=date("H:i:s");
    if($date!=="Sun"){
	if($time<="16:00:00" and $time>="18:00:00"){

	}}else
	if($date=="Sun"){
	if($time>="16:00:00" and $time<="18:00:00"){
	$arrr = mysql_query("SELECT * from `zamok`  where `name`='".$udata20."' and  `gtime`<('".time()."'-'80000') ");



if (mysql_affected_rows() == 1)
{
echo'<img src="images/desing/castle.png" alt=\"pic\"/> <a href="teleport.php?&amp;gorod='.$row['id'].'">'.$row['name'].' </a>(<img src="images/desing/adena.png" alt=\"pic\"/> '.$row['cena'].')<br />';}}}


}}else{
	$arrr = mysql_query("SELECT * from `zamok`  where `name`='".$udata20."' and  `gtime`<('".time()."'-'300') ");



if (mysql_affected_rows() == 0)
{


if($udata9<=20){
$row['cena']=0;
}

if ($row['name']=="$udata20 Castle"  ){



echo'<img src="images/desing/castle.png" alt=\"pic\"/> <a href="teleport.php?&amp;gorod='.$row['id'].'">'.$row['name'].' </a>(<img src="images/desing/adena.png" alt=\"pic\"/> '.$row['cena'].')<br />';
}}}


echo'<img src="images/desing/castle.png" alt=\"pic\"/> <a href="teleport.php?&amp;gorod='.$row['id'].'">'.$row['name'].' </a>(<img src="images/desing/adena.png" alt=\"pic\"/> '.$row['cena'].')<br />';

}

echo '<br /><br />Окрестности:<br />';


$qi = mysql_query("SELECT * FROM `getekeeper` WHERE `gorod`='$udata20' and `gk` = 'combat' ");

while($row=mysql_fetch_array($qi))

{

if($udata20=="Talking Island Village" or $udata20=="Dark Elven Village" or $udata20=="Elven Village" or $udata20=="Orc Village" or $udata20=="Dwarven Village" or $udata20=="Gludin Village" or $udata20=="" or $udata20=="Hunters Village"){









if ($row['name']=="$udata20 Castle"  ){


$date=date("D");
$time=date("H:i:s");

$date=date("D");
$time=date("H:i:s");
    if($date!=="Sun"){
	if($time<="16:00:00" and $time>="18:00:00"){

	}}else
	if($date=="Sun"){
	if($time>="16:00:00" and $time<="18:00:00"){
	$arrr = mysql_query("SELECT * from `zamok`  where `name`='".$udata20."' and  `gtime`<('".time()."'-'80000') ");



if (mysql_affected_rows() == 1)
{
echo'<img src="images/desing/travel.png" alt=\"pic\"/> <a href="teleport.php?&amp;gorod='.$row['id'].'">'.$row['name'].' </a>(<img src="images/desing/adena.png" alt=\"pic\"/> '.$row['cena'].')<br />';}}}


}}else{
	$arrr = mysql_query("SELECT * from `zamok`  where `name`='".$udata20."' and  `gtime`<('".time()."'-'300') ");



if (mysql_affected_rows() == 0)
{


if($udata9<=20){
$row['cena']=0;
}

if ($row['name']=="$udata20 Castle"  ){



echo'<img src="images/desing/travel.png" alt=\"pic\"/> <a href="teleport.php?&amp;gorod='.$row['id'].'">'.$row['name'].' </a>(<img src="images/desing/adena.png" alt=\"pic\"/> '.$row['cena'].')<br />';
}}}


echo'<img src="images/desing/travel.png" alt=\"pic\"/> <a href="teleport.php?&amp;gorod='.$row['id'].'">'.$row['name'].' </a>(<img src="images/desing/adena.png" alt=\"pic\"/> '.$row['cena'].')<br />';

}




}




}


include_once"inc/down.php";
?>