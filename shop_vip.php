<?php

$headmod = 'shop_vip_vip';//фикс. места

$textl='VIP Магазин';
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

$tip2=$_GET[tip2];
$lvlus = htmlspecialchars($_GET[lvlus]);

/*
if ($udata[dostup]<4){

echo "<hr/><p><font color=red>Приносим свои извенения. Проводятся технические работы по обновлению магазинов!</p></font><hr/></b></div></div></center>";
 include($path.'inc/end.php');exit;

}*/


switch($_GET[mod]){

default:
echo" <b><font color=#007F46> VIP Магазин. </font></b><br/>Выберай что нужно:<br/><br/>";
echo"<div class=inoy><a href=\"shop_vip.php?mod=weapon\">Магазин оружия</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=shit\">Отдел щитов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=golova\">Отдел шлемов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=body\">Отдел доспехов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=poyas\">Отдел серёжок</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=plash\">Отдел плащей</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=ruki\">Отдел рукавиц</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=pants\">Отдел штанов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=nogi\">Отдел сапог</a>";


echo"<br/> <a href=\"gorod.php?\">В город</a></div>";

break;

case 'w':
echo"<a href=\"shop_vip.php?mod=weapon\">Отдел оружия</a><br/>";
echo"<a href=\"shop_vip.php?\">Назад</a>";
break;


case 'b':
if(empty($_GET[o])){
echo" <b><font color=#007F46> VIP Магазин. </font></b><br/>Выберай что нужно:<br/><br/>";
echo"<div class=inoy><a href=\"shop_vip.php?mod=weapon\">Магазин оружия</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=shit\">Отдел щитов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=golova\">Отдел шлемов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=body\">Отдел доспехов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=poyas\">Отдел серёжок</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=plash\">Отдел плащей</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=ruki\">Отдел рукавиц</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=pants\">Отдел штанов</a>";
echo"<a href=\"shop_vip.php?mod=b&amp;o=nogi\">Отдел сапог</a>";


echo"<br/> <a href=\"gorod.php?\">В город</a></div>";

}else{
if($_GET[o]!=shit && $_GET[o]!=golova && $_GET[o]!=body && $_GET[o]!=poyas && $_GET[o]!=pants && $_GET[o]!=plash && $_GET[o]!=ruki && $_GET[o]!=nogi){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_vip` WHERE `tip`='$_GET[o]' and `nlvl`='$lvlus' ORDER BY cena");
////////////////////////////


if (empty($lvlus)) {$lvlus = '0';}

if($lvlus<20){$st="NG";}
elseif($lvlus>=20 and $lvlus<40){$st="D";}
elseif($lvlus>=40 and $lvlus<52){$st="C";}
elseif($lvlus>=52 and $lvlus<62){$st="B";}
elseif($lvlus>=62 and $lvlus<76){$st="A";}
elseif($lvlus>=76){$st="S";}

if ($o=='golova'){$tp="Шлемов";}
if ($o=='body'){$tp="Доспехов";}
if ($o=='plash'){$tp="Плащей";}
if ($o=='ruki'){$tp="Рукавиц";}
if ($o=='nogi'){$tp="Сапог";}
if ($o=='shit'){$tp="Щитов";}
if ($o=='pants'){$tp="Штанов";}
if ($o=='poyas'){$tp="Серьг";}

echo "<p>Отдел $tp! </p>";


echo "<hr/>";

///////////////////////////
$avto=mysql_num_rows($req);

While($mag = mysql_fetch_array($req))
{
$mag[name] = htmlspecialchars(stripslashes(addslashes($mag[name])));

echo" <img src=\"shmot/$mag[name].png\" alt=\"pic\"/>
 <a href=\"shop_vip.php?mod=info&amp;id=$mag[id]\">$mag[name]</a><br/> Цена: $mag[cena] CoL<hr/>";
}

echo"<br/><a href=\"shop_vip.php?mod=b\">Назад</a>";

}
break;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case 'weapon':


if($lvlus<20){$st="NG";}
elseif($lvlus>=20 and $lvlus<40){$st="D";}
elseif($lvlus>=40 and $lvlus<52){$st="C";}
elseif($lvlus>=52 and $lvlus<62){$st="B";}
elseif($lvlus>=62 and $lvlus<76){$st="A";}
elseif($lvlus>=76){$st="S";}


if ($tip2=='ydar'){$tp="Ударное";}
if ($tip2=='luk'){$tp="Луки";}
if ($tip2=='kin'){$tp="Кинжалы";}
if ($tip2=='sdv'){$tp="Сдвоенное";}
if ($tip2=='kas'){$tp="Кастеты";}
if ($tip2=='kniga'){$tp="Книги";}
if ($tip2=='koppik'){$tp="Копья/Пики";}
if ($tip2=='me4'){$tp="Мечи";}
if ($tip2=='rap'){$tp="Рапиры";}


/*echo"<b>Классы:</b> | ";
if ($lvlus==0){echo"NG | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=0&tip2=$tip2\">NG</a> | ";}
if ($lvlus==20){echo"D | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=20&tip2=$tip2\">D</a> | ";}
if ($lvlus==40){echo"C | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=40&tip2=$tip2\">C</a> | ";}
if ($lvlus==52){echo"B | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=52&tip2=$tip2\">B</a> | ";}
if ($lvlus==62){echo"A | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=62&tip2=$tip2\">A</a> | ";}
if ($lvlus==76){echo"S | <br/>";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=76&tip2=$tip2\">S</a> |<br/>";}*/


if (empty($tip2)) {$tip2='me4';}

/*echo"<b>Тип:</b> | ";
if ($tip2=='me4'){echo"Мечи | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=$lvlus&tip2=me4\">Мечи</a> | ";}
if ($tip2=='kas'){echo"Кастеты | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=$lvlus&tip2=kas\">Кастеты</a> | ";}
if ($tip2=='rap'){echo"Рапиры | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=$lvlus&tip2=rap\">Рапиры</a> | ";}
if ($tip2=='luk'){echo"Луки | ";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=$lvlus&tip2=luk\">Луки</a> | ";}
if ($tip2=='kin'){echo"Кинжалы |<br/><br/>";}else{ echo"<a href=\"shop_vip.php?mod=weapon&lvlus=$lvlus&tip2=kin\">Кинжалы</a> |<br/><br/>";}*/


echo "<p><font color=grey>Магазин оружия!</p></font>";
echo "<hr/>";
$req = mysql_query("SELECT * FROM `shop_vip` WHERE  `tip`='weapon' ORDER BY cena");
////////////////////////////
$avto=mysql_num_rows($req);

While($mag = mysql_fetch_array($req))
{
//*********************


echo"	<img src=\"shmot/$mag[name].png\" alt=\"pic\"/>
		<a href=\"shop_vip.php?mod=info&amp;id=$mag[id]\">$mag[name]</a><br/>
		Цена: ".number_format($mag[cena])." CoL "; 
		//[<a href=\"sell.php?act=ask&amp;id=$mag[id]\">купить</a>]<br/>";
echo "<hr/>";
}
echo"<br/><a href=\"shop_vip.php?\">Назад</a>";
break;
case 'info':
$req = mysql_query("SELECT * FROM `shop_vip` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");

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
$tip='Серьга'; //серьга
break;
case 'plash':
$tip='Плащ';
break;
case 'ruki':
$tip='Рукавицы';
break;
case 'pants':
$tip='Штаны';
break;
}
switch($mag[klas]){
case 'not':
$klas='Все';
break;
case 'wizard':
$klas='Маг';
break;
case 'fighert':
$klas='Воин';
break;
}




if($mag[nlvl]<20){$st="NG";}
elseif($mag[nlvl]>=20 and $mag[nlvl]<40){$st="D";}
elseif($mag[nlvl]>=40 and $mag[nlvl]<52){$st="C";}
elseif($mag[nlvl]>=52 and $mag[nlvl]<62){$st="B";}
elseif($mag[nlvl]>=62 and $mag[nlvl]<76){$st="A";}
elseif($mag[nlvl]>=76 and $mag[nlvl]<91){$st="S";}
elseif($mag[nlvl]>=91){$st="R";}


echo"<b></div></div></div><div class=menu><img src=\"shmot/$mag[name].png\" alt=\"pic\"/> $mag[name]</b><br/>
Тип: $tip<br/>
Цена: ".number_format($mag[cena], 0, ',', "'")." CoL <br/><br/>";

if ($tip=="Оружие"){
echo "
Физ. атака: $mag[patt]<br/>
Маг. атака: $mag[matt]<br/><br/>

SoulShot: x$mag[soul]<br/>
SpiritShot: x$mag[spirit]<br/><br/>";}else{

echo "
Физ. защ.: $mag[pdef]<br/>
Маг. защ.: $mag[mdef]<br/><br/>";}


echo "
Грейд: $st<br/><br/></div><div class=inoy>
";



echo "<a href=\"sell_vip.php?act=ask&amp;id=$mag[id]\">Купить</a><br/>";
echo"<a href=\"shop_vip.php?\">Назад</a>";
break;
}
include($path.'inc/down.php');
?>