<?
define('PROTECTOR', 1);

$headmod = 'shop';//фикс. места

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

$tip2=$_GET[tip2];
$lvlus = htmlspecialchars($_GET[lvlus]);

/*if ($udata[dostup]<4){

echo "<hr/><p><font color=red>Приносим свои извенения. Проводятся технические работы по обновлению магазинов!</p></font><hr/></b></div></div></center>";
 include($path.'inc/down.php');exit;

}*/


switch($_GET[mod]){

default:
echo"</div></div> <div class=menu> <font color=grey>Решил прикупиться? <br/>Выбирай что нужно: </font><br/><br/></div>";
echo "<div class=inoy>";
echo"<a href=\"shop.php?mod=weapon\">Магазин оружия</a>";
echo"<a href=\"shop.php?mod=b\">Магазин брони</a>";
echo"<a href=\"/shopjuvilir.php?\">Магазин амулетов и колец</a>";
echo"<a href=\"shopsoul.php\">Магазин SoulShots</a>";


echo "</div>";
break;

case 'w':
echo"<a href=\"shop.php?mod=weapon\">Отдел оружия</a><br/>";
echo"<a href=\"shop.php?\">Назад</a>";
break;

case 'b':
if(empty($_GET[o])){
echo"<font color=grey> Хах...Защита важная часть!!! </font><br/><br/>";

echo "<div class=inoy>";
echo"<a href=\"shop.php?mod=b&amp;o=shit\"> Щиты</a>";
echo"<a href=\"shop.php?mod=b&amp;o=golova\"> Шлемы</a>";
echo"<a href=\"shop.php?mod=b&amp;o=body\"> Доспехи</a>";
echo"<a href=\"shop.php?mod=b&amp;o=poyas\"> Левые серёжки</a>";
echo"<a href=\"shop.php?mod=b&amp;o=rpoyas\"> Правые серёжки</a>";
echo"<a href=\"shopjuvilir.php?mod=mag&amp;o=amulet\"> Амулеты</a>";
echo"<a href=\"shopjuvilir.php?mod=mag&amp;o=rkolco\">Правые кольца</a>";
echo"<a href=\"shopjuvilir.php?mod=mag&amp;o=kolco\">Левые кольца</a>";
echo"<a href=\"shop.php?mod=b&amp;o=plash\"> Отдел плащей</a>";
echo"<a href=\"shop.php?mod=b&amp;o=pants\"> Штаны</a>";
echo"<a href=\"shop.php?mod=b&amp;o=ruki\"> Рукавицы</a>";
echo"<a href=\"shop.php?mod=b&amp;o=nogi\"> Сапоги</a>";



echo"<br/><a href=\"shop.php?\">Назад</a>";
echo "</div>";

}else{
if($_GET[o]!=shit && $_GET[o]!=golova && $_GET[o]!=body && $_GET[o]!=rpoyas && $_GET[o]!=poyas && $_GET[o]!=plash && $_GET[o]!=pants && $_GET[o]!=ruki && $_GET[o]!=nogi){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop` WHERE `city` != '' and `tip`='$_GET[o]' and `nlvl`='$lvlus' ORDER BY cena");
////////////////////////////

echo"<b>Классы:</b> | ";
if ($lvlus==0){echo"NG | ";}else{ echo"<a href=\"shop.php?mod=b&lvlus=0&o=$_GET[o]\">NG</a> | ";}
if ($lvlus==20){echo"D | ";}else{ echo"<a href=\"shop.php?mod=b&lvlus=20&o=$_GET[o]\">D</a> | ";}
if ($lvlus==40){echo"C | ";}else{ echo"<a href=\"shop.php?mod=b&lvlus=40&o=$_GET[o]\">C</a> | ";}
if ($lvlus==52){echo"B | ";}else{ echo"<a href=\"shop.php?mod=b&lvlus=52&o=$_GET[o]\">B</a> | ";}
if ($lvlus==62){echo"A | ";}else{ echo"<a href=\"shop.php?mod=b&lvlus=62&o=$_GET[o]\">A</a> | ";}
if ($lvlus==76){echo"S | ";}else{ echo"<a href=\"shop.php?mod=b&lvlus=76&o=$_GET[o]\">S</a> | ";}
if ($lvlus==91){echo"R | <br/>";}else{ echo"<a href=\"shop.php?mod=b&lvlus=91&o=$_GET[o]\"> R </a> |<br/>";}

if (empty($lvlus)) {$lvlus = '0';}

if($lvlus<20){$st="NG";}
elseif($lvlus>=20 and $lvlus<40){$st="D";}
elseif($lvlus>=40 and $lvlus<52){$st="C";}
elseif($lvlus>=52 and $lvlus<62){$st="B";}
elseif($lvlus>=62 and $lvlus<76){$st="A";}
elseif($lvlus>=76 and $lvlus<91){$st="S";}
elseif($lvlus>=91){$st="R";}

if ($o=='golova'){$tp="Шлем";}
if ($o=='body'){$tp="Доспех";}
if ($o=='plash'){$tp="Плащ";}
if ($o=='pants'){$tp="Штаны";}
if ($o=='ruki'){$tp="Рукавицы";}
if ($o=='nogi'){$tp="Сапоги";}
if ($o=='shit'){$tp="Щит";}
if ($o=='poyas'){$tp="Левая серьга";}
if ($o=='rpoyas'){$tp="Правая серьга";}
echo "<hr/>";

///////////////////////////
$avto=mysql_num_rows($req);

While($mag = mysql_fetch_array($req))
{
$mag[name] = htmlspecialchars(stripslashes(addslashes($mag[name])));

echo" <img src=\"shmot/$mag[name].png\" alt=\"pic\"/>
 <a href=\"shop.php?mod=info&amp;id=$mag[id]\">$mag[name]</a><br/> Цена: ".number_format($mag[cena])." <hr/>";
}

echo"<br/><a href=\"shop.php?mod=b\">Назад</a>";

}
break;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case 'weapon':


if($lvlus<20){$st="NG";}
elseif($lvlus>=20 and $lvlus<40){$st="D";}
elseif($lvlus>=40 and $lvlus<52){$st="C";}
elseif($lvlus>=52 and $lvlus<62){$st="B";}
elseif($lvlus>=62 and $lvlus<76){$st="A";}
elseif($lvlus>=76 and $lvlus<91){$st="S";}
elseif($lvlus>=91){$st="R";}


if ($tip2=='ydar'){$tp="Ударное";}
if ($tip2=='luk'){$tp="Луки";}
if ($tip2=='kin'){$tp="Кинжалы";}
if ($tip2=='sdv'){$tp="Сдвоенное";}
if ($tip2=='kas'){$tp="Кастеты";}
if ($tip2=='kniga'){$tp="Книги";}
if ($tip2=='koppik'){$tp="Копья/Пики";}
if ($tip2=='me4'){$tp="Луки";}
if ($tip2=='rap'){$tp="Мечи";}


echo"<b>Классы:</b> | ";
if ($lvlus==0){echo"NG | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=0&tip2=$tip2\">NG</a> | ";}
if ($lvlus==20){echo"D | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=20&tip2=$tip2\">D</a> | ";}
if ($lvlus==40){echo"C | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=40&tip2=$tip2\">C</a> | ";}
if ($lvlus==52){echo"B | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=52&tip2=$tip2\">B</a> | ";}
if ($lvlus==62){echo"A | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=62&tip2=$tip2\">A</a> | ";}
if ($lvlus==76){echo"S | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=76&tip2=$tip2\">S</a> | ";}
if ($lvlus==91){echo"R | <br/>";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=91&tip2=$tip2\">R</a> |<br/>";}


if (empty($tip2)) {$tip2='ydar';}

echo"<b>Тип:</b> | ";
if ($tip2=='ydar'){echo"Ударное | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=ydar\">Ударное</a> | ";}
if ($tip2=='luk'){echo"Луки | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=luk\">Луки</a> | ";}
if ($tip2=='kin'){echo"Кинжалы | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=kin\">Кинжалы</a> | ";}
if ($tip2=='sdv'){echo"Сдвоенное | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=sdv\">Сдвоенное</a> | ";}
if ($tip2=='kas'){echo"Кастеты | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=kas\">Кастеты</a> | ";}
if ($tip2=='kniga'){echo"Книги | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=kniga\">Книги</a> | ";}
if ($tip2=='koppik'){echo"Копья/Пики | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=koppik\">Копья/Пики</a> | ";}
if ($tip2=='me4'){echo"Мечи | ";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=me4\">Мечи</a> | ";}
if ($tip2=='rap'){echo"Рапиры | <br/><br/>";}else{ echo"<a href=\"shop.php?mod=weapon&lvlus=$lvlus&tip2=rap\">Рапиры</a> | <br/><br/>";}



echo "<hr/>";
$req = mysql_query("SELECT * FROM `shop` WHERE `city` != '' and `tip`='weapon' and `tip2`='$tip2' and `nlvl`='$lvlus' ORDER BY cena");
////////////////////////////
$avto=mysql_num_rows($req);

While($mag = mysql_fetch_array($req))
{
//*********************


echo"	<img src=\"shmot/$mag[name].png\" alt=\"pic\"/>
		<a href=\"shop.php?mod=info&amp;id=$mag[id]\">$mag[name]</a><br/>
		Цена: ".number_format($mag[cena])." Аден "; 
		//[<a href=\"sell.php?act=ask&amp;id=$mag[id]\">купить</a>]<br/>";
echo "<hr/>";
}
echo"<br/><a href=\"shop.php?\">Назад</a>";
break;
case 'info':
$req = mysql_query("SELECT * FROM `shop` WHERE `city` != '' and `id`='".mysql_real_escape_string($_GET[id])."'");

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
$tip='Левая серьга'; //серьга
break;
case 'rpoyas':
$tip='Правая серьга'; //серьга
break;
case 'plash':
$tip='Плащ';
break;
case 'pants':
$tip='Штаны';
break;
case 'ruki':
$tip='Рукавицы';
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
Цена: ".number_format($mag[cena], 0, ',', "'")." Аден <br/><br/>";

if ($tip=="Оружие"){
echo "
Физ. атака: $mag[patt]<br/>
Маг. атака: $mag[matt]<br/>
Уровень: $mag[nlvl]<br/><br/>

SoulShot: x$mag[soul]<br/>
SpiritShot: x$mag[spirit]<br/><br/>";}else{

echo "
Физ. защ.: $mag[pdef]<br/>
Маг. защ.: $mag[mdef]<br/>
Уровень: $mag[nlvl]<br/><br/>";}


echo "
Грейд: $st<br/><br/></div><div class=inoy>
";
echo "<a href=\"sell.php?act=ask&amp;id=$mag[id]\">Купить</a>";
echo"<a href=\"shop.php?\">Назад</a></div>";
break;

case 'soulshots':

if (isset($_GET[t])){
$colnew=$udata[almaz]-1;
$co = 100; // количество наживки
if ($colnew>=0){

$req = mysql_query("SELECT * FROM `soulshots` WHERE `usr` = '$log'");
$res=mysql_num_rows($req);
$rs = mysql_fetch_array($req);
if($res==0){
mysql_query("INSERT INTO `l2warmobi`.`soulshots` (`id` ,`usr` ,`kol` )
VALUES (NULL , '$log', '100');");
$nk=$rs[kol]+$co;
echo "<p><font color=blue>Вы купили $co Shots. У Вас теперь $nk Shots.</font></p>";
}else{
$nk=$rs[kol]+$co;
mysql_query("UPDATE `soulshots` SET `kol` = '$nk' WHERE `usr` = '$log'");
echo "<p><font color=blue>Вы купили $co Shots. У Вас теперь $nk Shots.</font></p>";

}
mysql_query("UPDATE `users` SET `almaz` = '$colnew' WHERE `usr` = '$log' LIMIT 1");


}else{
echo "<p><font color=red>Не хватает Coin of Luck</font></p>";
}
}else{

echo "<p><font color=#057F46><b>Купить Shots:</b></font></p>";

echo"<div class=inoy>";
echo"<a href=\"shop.php?mod=soulshots&t\"> <img src=\"pic/skr/s.jpeg\" height=30 width=30> Shots x100 <font color=silver> [1 CoL] </font></a>";
echo"</div>";

}
break;




}
include($path.'inc/down.php');
?>