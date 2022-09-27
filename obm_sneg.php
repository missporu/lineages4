<?
define('PROTECTOR', 1);

$headmod = 'obm_sneg';//фикс. места

$textl='Обменник Снежинок на Иголки';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if ($udata[dostup]<4){echo'Открытие локации 1 Декабря =)<br/>';echo"<br/><a href=\"gorod.php?\">Назад</a>";include($path.'inc/down.php');exit;}


switch($_GET[mod]){


default:
$res = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' && `lat_name` = 'Снежинка'"); //проверка есть ли снежинка если да то открываем таблицу
$av = mysql_num_rows($res);
$fa = mysql_fetch_array($res);
$av = $fa[kol];
if (empty($av)){$av = 0;}
if ($av==0){
// если нет снежинки то пишем что пусто

echo "<p><font color=grey><b>У Вас $av Снежинок. Набить Вы их можете убивая монстров.</b></font></p>";

echo "<p><font color=green><b>Курс обмена: <br/> ** 1000 Снежинок = 150 Иголок</b></font></p>";

echo "<div class=silka><a href=\"gorod.php\">В город</a></div>";
}else{
// иначе пишем сколько и выщитуем


echo "<p><font color=grey><b>У Вас $av Снежинок !</b></font></p>";

echo "<p><font color=green><b>Курс обмена: <br/> ** 1000 Снежинок = 150 Иголок</b></font></p>";


$col = $av/1000;
$col = round($col);
$col = $col-1;

echo "<form action=\"obm_sneg.php?mod=yes\" method=\"POST\">";

echo "<div class=menu><b><font color=grey>Max k обмену: 1 = 150 |-| 10 = 1500 Иголок<br/>
+ </b></font><input type=\"text\" name=\"col\" size=\"3\" value=\"$col\" maxlength=\"9\"/> ";

echo "<input type='submit' name='ok' value='Обмен' /><hr/></div>\n";


echo "<div class=silka><a href=\"gorod.php\">В город</a></div>";

}

break;


case "yes";
// пишем защиты

$_POST[col] = round($_POST[col]);

if ($_POST[col]<=0 or is_numeric($_POST[col])==FALSE){
echo "<p><font color=red><b>Ошибка! Вводите цыфры больше ноля !!! </b></font></p>";
echo "<div class=silka><a href=\"obm_sneg.php\">Назад</a></div>";
include($path.'inc/down.php');EXIT;
}

$res = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' && `lat_name` = 'Снежинка'"); //проверка есть ли Снежинка если да то открываем таблицу
$av=mysql_num_rows($res);
$fa = mysql_fetch_array($res);
$av = $fa[kol];

$col = $_POST[col];
$fad = $_POST[col] * 1000;
$nav = $av - $fad;

if ($nav < 0){$navs = round($nav); $u=explode('-',$navs); 
echo "<p><font color=orange><b> Вам нехватает $u[1] Снежинок!!! </b></font></p>";
echo "<div class=silka><a href=\"obm_sneg.php\">Назад</a></div>";
include($path.'inc/down.php');EXIT;
}




/// пишем результат
if($nav<=0){ // если равен нулю или меньше удаляем таблицу
mysql_query("DELETE FROM `res` WHERE `usr`='$log' and `lat_name`='Снежинка' LIMIT 1");//чистим логи
}else{ // иначе переписывем с новым количеством
mysql_query("UPDATE `res` SET `kol` = '$nav' WHERE `usr`='$log' and `lat_name`='Снежинка' LIMIT 1");
}


$reqi = mysql_query("SELECT * FROM `users` WHERE `usr`='$log' LIMIT 1");
$udata = mysql_fetch_array($reqi);

$ig = $udata[ig] + $col * 150; // щитаем иголки

mysql_query("UPDATE `users` SET `ig` = '$ig' WHERE `usr`='$log' LIMIT 1");


echo "<p><font color=grey><b>Обмен успешно выполнен:</b><br/></p>";
echo " У вас было <font color=aqua>Снежинок</font> -> $av шт.<br/>";
echo " Забрали <font color=aqua>Снежинок</font> -> $fad шт.<br/>";
echo " Осталось <font color=aqua>Снежинок</font> -> $nav шт.<br/>";
echo " Зачисленно <font color=orange>Иголок</font> -> $col шт. Всего <font color=orange>Иголок</font> -> $ig шт.<br/></font>";


echo "<div class=silka><a href=\"obm_sneg.php\">Назад</a></br><a href=\"gorod.php\">В город</a></div>";

break;


}
include($path.'inc/down.php');
?>