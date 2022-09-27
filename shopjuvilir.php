<?
define('PROTECTOR', 1);

$headmod = 'shopjuvilir';//фикс. места

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


switch($_GET[mod]){

default:
echo "<div class=inoy>";
echo"<a href=\"shopjuvilir.php?mod=mag&amp;o=amulet\">Амулеты</a>";
echo"<a href=\"shopjuvilir.php?mod=mag&amp;o=kolco\">Левые кольца</a></div>";
echo"<a href=\"shopjuvilir.php?mod=mag&amp;o=rkolco\">Правые кольца</a></div>";
break;

case 'mag':
if($_GET[o]!=amulet && $_GET[o]!=kolco&& $_GET[o]!=rkolco){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop` WHERE `city` != '' and `tip`='$_GET[o]' and `nlvl`='$lvlus' ORDER BY cena");
////////////////////////////



echo"<b>Класы:</b> | ";
if ($lvlus==0){echo"NG | ";}else{ echo"<a href=\"shopjuvilir.php?mod=mag&lvlus=0&o=$_GET[o]\">NG</a> | ";}
if ($lvlus==20){echo"D | ";}else{ echo"<a href=\"shopjuvilir.php?mod=mag&lvlus=20&o=$_GET[o]\">D</a> | ";}
if ($lvlus==40){echo"C | ";}else{ echo"<a href=\"shopjuvilir.php?mod=mag&lvlus=40&o=$_GET[o]\">C</a> | ";}
if ($lvlus==52){echo"B | ";}else{ echo"<a href=\"shopjuvilir.php?mod=mag&lvlus=52&o=$_GET[o]\">B</a> | ";}
if ($lvlus==62){echo"A | ";}else{ echo"<a href=\"shopjuvilir.php?mod=mag&lvlus=62&o=$_GET[o]\">A</a> | ";}
if ($lvlus==76){echo"S | <br/>";}else{ echo"<a href=\"shopjuvilir.php?mod=mag&lvlus=76&o=$_GET[o]\">S</a> |<br/>";}

if (empty($lvlus)) {$lvlus = '0';}

if($lvlus<20){$st="NG";}
elseif($lvlus>=20 and $lvlus<40){$st="D";}
elseif($lvlus>=40 and $lvlus<52){$st="C";}
elseif($lvlus>=52 and $lvlus<62){$st="B";}
elseif($lvlus>=62 and $lvlus<76){$st="A";}
elseif($lvlus>=76){$st="S";}

echo "<br/><b>Клас:</b> $st<hr/>";
///////////////////////////
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<img src=\"shmot/$mag[name].png\" alt=\"pic\"/> 
<a href=\"shopjuvilir.php?mod=info&amp;id=$mag[id]\">$mag[name]</a><br/>
Цена: $mag[cena] Аден <hr/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
echo"<br/><a href=\"shopjuvilir.php?\">Назад</a>";
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
case 'amulet':
$tip='Амулет';
break;
case 'kolco':
$tip='Левое кольцо';
break;
case 'rkolco':
$tip='Правое кольцо';
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



echo "
Физ. защ.: $mag[pdef]<br/>
Маг. защ.: $mag[mdef]<br/><br/>";

echo"<br/><a href=\"sell.php?act=ask&amp;id=$mag[id]\">Купить</a><br/><a href=\"shopjuvilir.php?\">Назад</a>";
break;
}
include($path.'inc/down.php');
?>