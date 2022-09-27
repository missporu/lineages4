<?
define('PROTECTOR', 1);

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

switch($_GET[act]){

default:
$req = mysql_query("SELECT * FROM `shop_ny` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");

$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка, такой вещи нет!';
include($path.'inc/down.php');
exit;
}
$mag = mysql_fetch_array($req);
///////////////

$nmoney=$udata[ig]-$mag[cena];

if($nmoney<0){
echo'Нехватает Иголок!';
include($path.'inc/down.php');
exit;
}

$ncena2222 = $mag[cena]*100000; // продажа в ломбард

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$log',
        `tip` = '$mag[tip]',
        `ruka` = '$mag[tip2]',
        `name` = '$mag[name]',
        `cena` = '$mag[cena]',
        `patt` = '$mag[patt]',
        `matt` = '$mag[matt]',
        `pdef` = '$mag[pdef]',
        `mdef` = '$mag[mdef]',
        `time` = '$mag[time]',
        `soul` = '$mag[soul]',
        `spirit` = '$mag[spirit]',
        `nlvl` = '$mag[nlvl]',
        `image` = 'not'");

//////////////////////////////////////////////////////////////////////////////////////////////     


mysql_query("UPDATE users SET ig = '$nmoney' WHERE usr = '$log'");

echo"
Вещь $mag[name] куплена и помещена в инвентарь!<br/>
Иголок потрачено: $mag[cena]<br/>
Иголок осталось: $nmoney<br/>
";
echo"<a href=\"shop_ny.php?\">Назад</a>";

break;

case 'ask':
echo'Вы действительно хотите купить эту вещь?<br/>';
echo"<a href=\"sell_ny.php?id=$_GET[id]\">Да</a> | ";
echo"<a href=\"shop_ny.php?\">Нет</a>";
break;
}
include($path.'inc/down.php');
?>