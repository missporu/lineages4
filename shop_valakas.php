<?
define('PROTECTOR', 1);

$headmod = 'shop_valakas';//фикс. места

$textl='Валакас Шоп';
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
//if($udata[dostup]<4){echo'Sorry, делаем что то новое =)<br/>';echo"<br/><a href=\"gorod.php?\">Назад</a>";include($path.'inc/down.php');exit;}

$tip2=$_GET[tip2];
$lvlus=$_GET[lvlus];




switch($_GET[mod]){

default:
echo" <b><font color=darkorange> Валакас Шоп <br/><br/></b>

<font color=#4A667A>Добро пожаловать! Я, Веодольф, страник по другим мирам. Вот, еще когда сам любил странствовать, насобирал кучу вещей в других мирах. 
Теперь пришлость достать их с тайников и выставить на продажу. Как могу, так и обеспечиваю старость!!!</font><hr/>

</font><br/>Выберай что нужно:<br/><br/>";
echo"<div class=inoy><a href=\"shop_valakas.php?mod=weapon\">Магазин оружия</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=shit\">Отдел щитов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=golova\">Отдел шлемов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=body\">Отдел доспехов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=poyas\">Отдел серёжок</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=plash\">Отдел плащей</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=ruki\">Отдел рукавиц</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=pants\">Отдел штанов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=nogi\">Отдел сапог</a></div>";


echo"<br/><div class=inoy> <a href=\"gorod.php\">В город</a></div>";

break;

case 'w':
echo"<a href=\"shop_valakas.php?mod=weapon\">Отдел оружия</a><br/>";
echo"<a href=\"shop_valakas.php?\">Назад</a>";
break;


case 'b':
if(empty($_GET[o])){
echo" <b><font color=darkorange> Валакас Шоп </font></b><br/>Выберай что нужно:<br/><br/>";
echo"<div class=inoy><a href=\"shop_valakas.php?mod=weapon\">Магазин оружия</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=shit\">Отдел щитов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=golova\">Отдел шлемов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=body\">Отдел доспехов</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=poyas\">Отдел серёжок</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=ruki\">Отдел рукавиц</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=nogi\">Отдел сапог</a></div>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=plash\">Отдел плащей</a>";
echo"<a href=\"shop_valakas.php?mod=b&amp;o=pants\">Отдел штанов</a>";
echo"<br/> <div class=inoy><a href=\"gorod.php\">В город</a></div>";

}else{
if($_GET[o]!=shit && $_GET[o]!=golova && $_GET[o]!=body && $_GET[o]!=poyas && $_GET[o]!=plash&& $_GET[o]!=pants && $_GET[o]!=ruki && $_GET[o]!=nogi){
echo'Ошибка!';
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_valakas` WHERE `tip`='$_GET[o]' ORDER BY cena");
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
if ($o=='poyas'){$tp="Серьг";}
if ($o=='pants'){$tp="Штанов";}
echo "<p>Отдел $tp! </p>";


echo "<hr/>";

///////////////////////////
$avto=mysql_num_rows($req);

While($mag = mysql_fetch_array($req))
{
$mag[name] = htmlspecialchars(stripslashes(addslashes($mag[name])));

echo "<div class=silka><a href=\"shop_valakas.php?mod=info&amp;id=$mag[id]\">
<img src=\"shmot/$mag[name].png\"  align='left' width='36' height='36' alt='' style='margin-right:10px;border:1px solid #383838'/>
$mag[name] <br/><span style=color:#C2B6B2;>&nbsp;Цена: ".number_format($mag[cena], 0, ',', " ")." Трофеев Валакаса</span></a></div><hr/>";
}

echo"<br/><div class=inoy><a href=\"shop_valakas.php?mod=b\">Назад</a></div>";

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
if ($tip2=='me4'){$tp="Луки";}
if ($tip2=='rap'){$tp="Мечи";}


if (empty($tip2)) {$tip2='me4';}



echo "<p><font color=grey>Магазин оружия!</p></font>";
echo "<hr/>";
$req = mysql_query("SELECT * FROM `shop_valakas` WHERE  `tip`='weapon' ORDER BY cena");
////////////////////////////
$avto=mysql_num_rows($req);

While($mag = mysql_fetch_array($req))
{
//*********************


echo "<div class=silka><a href=\"shop_valakas.php?mod=info&amp;id=$mag[id]\">
<img src=\"shmot/$mag[name].png\"  align='left' width='36' height='36' alt='' style='margin-right:10px;border:1px solid #383838'/>
$mag[name] <br/><span style=color:#C2B6B2;>&nbsp;Цена: ".number_format($mag[cena], 0, ',', " ")." Трофеев Валакаса</span></a></div><hr/>";

}
echo"<br/><div class=inoy><a href=\"shop_valakas.php?\">Назад</a></div>";
break;
case 'info':
$req = mysql_query("SELECT * FROM `shop_valakas` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");

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


echo"<b></div></div></div><div class=menu><img src=\"shmot/$mag[name].png\" alt=\"pic\"/> $mag[name]</b> <br/>
Тип: $tip <font color=grey>($mag[nlvl] lvl)</font><br/>
Цена: ".number_format($mag[cena], 0, ',', " ")." Трофеев Валакаса <br/><br/>";

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
Грейд: $st<br/><br/></div>
";



echo "<div class=inoy><a href=\"sell_valakas.php?act=ask&amp;id=$mag[id]\">Купить</a>";
echo"<a href=\"shop_valakas.php?\">Назад</a></div><br/>";
break;
}
include($path.'inc/down.php');
?>