<?
define('PROTECTOR', 1);

$textl='Рыбалка';
///////////////////////
//	$path='../';			//
//////////////////////
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////


switch($_GET[f]){
default:
//-

echo '<p><font color=#057F46><b>Покупка Киркы!: </b></font>';


echo"<div class=inoy>";
echo"<a href=\"?f=kir\">Купить кирку</a>";
echo"</div>";

break;


case 'kir':

if (isset($_GET[t])){
if ($_GET[t] != 0 and $_GET[t] <= 1){

if ($_GET[t]==1){$name='Кирка';$patt=1000; $matt=1000; $nlvl=111;$cena=500;}

$colnew=$udata[almaz]-$cena;
if ($colnew>=0){
// --записуем кирку
mysql_query("INSERT INTO
        `item` SET
        `usr` = '$log',
        `tip` = 'weapon',
`ruka` = 'rudnik',
        `name` = '$name',
`cena` = '500',
        `patt` = '$patt',
        `matt` = '$matt',
        `pdef` = '0',
        `mdef` = '0',
        `time` = '$mag[time]',
        `soul` = '0',
        `spirit` = '0',
        `nlvl` = '$nlvl',
        `image` = 'not'");
mysql_query("UPDATE `users` SET `almaz` = '$colnew' WHERE `usr` = '$log' LIMIT 1");
//--------------------------

echo "<div class=dot><p><font color=#057F46><b>Кирка $name куплена!</b></font></p></div>";
echo"<div class=inoy><a href=\"?\"> К рыбаку </a></div>";
}else{
echo "<div class=dot><p><font color=red><b>Не хватает Coin of Luck!</b></font></p></div>";
echo"<a href=\"?\"> Назад </a>";
}}
}else{


echo "<p><font color=#057F46><b>Купить кирку: </b></font><font color=grey>Нажав на кирку, вы её купите...</font></p><hr/>";

echo"<div class=inoy>";
echo"<a href=\"?f=kir&t=1\"> <img src=\"shmot/Кирка.png\" height=30 width=30> Кирка <font color=silver> [500 CoL] </font></a>";
echo"</div>";

}

break;

include($path.'inc/down.php');


break;




}

echo "<hr/><div class=silka><a href=\"/gorod.php\">В город</a></div>";
echo"<div class=silka><a href=\"/rudnik.php\">К Руднику</a></div>";


include($path.'inc/down.php');
?>