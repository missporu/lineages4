<?php

$headmod = 'Подарки';//фикс. места

$textl='подарки';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');



////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $reqdsdfrfd = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `id` = '$udata[id]' LIMIT 1");
  $users = mysql_fetch_assoc($reqdsdfrfd);
//-------------------------------------
///////////////////////////////////////////////////////////////////////////////


if (!isset($users) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}


$ank=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1"));

if(empty($ank[usr])){
echo'<font color=red>Нет такого игрока!</font>';
echo"<br/><div class=silka><a href=\"/?\">Главная</a>";
include($path.'inc/down.php');exit;
}



if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('gifts\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));


$p = (isset($_GET['p'])) ? htmlspecialchars($_GET['p']) : null;



switch($p){

case 'send_gifts':



$pid = intval($_GET['pid']);

if (isset($_GET['go'])){

if ($users[id]==$ank[id]){echo "<font color=red><p>Себе дарить нельзя</p></font>";
include($path.'inc/down.php');exit;
}

$curr=date("d.m.y / H:i");
$cena = 50;
$msg=$_POST['msg'];
$ank['id'];
if($ank==0){
msg ('Пользователь не найден :(');
}else{if (isset($users) & $users['almaz']<=$cena){
echo "<font color=red><p>У Вас не достаточно Coin of Luck :(</p></font>";
}else{
////////////////////
mysql_query("UPDATE `users` SET `almaz` = '".($users['almaz']-$cena)."' WHERE `id` = '$users[id]' LIMIT 1");
//mysql_query("UPDATE `users` SET `almaz` = '".($ank['almaz']+$cena)."' WHERE `id` = '$ank[id]' LIMIT 1");
////////////////////
$time = date("H:i d.m.y");
$text = " <font color=#9DC8E7>К вам пришёл подарок!</font>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = '$users[usr]', `user_to` = '$ank[usr]', `time` = '$time', `read` = 1, `mail_msg` = '$text'"); // отправляем сообщение
////////////////////
mysql_query("INSERT INTO `gifts` (`id_user`, `ot_id`, `text`, `time`, `id_gifts`) values('$ank[id]', '$users[id]', '".mysql_real_escape_string($msg)."', '$time', '$pid')");
////////////////////

echo "<div class=msg><p>Отправка подарка успешно завершена :)</p></div>";
echo "<div class=inoy><a href='search.php?nick=$ank[usr]&go=go'>Продолжить</a></div> ";

}}
include($path.'inc/down.php');}

echo"<img src='/gifts/".$pid.".gif' alt='' class='icon'/>";

echo "<form method=\"post\" action=\"gifts.php?p=send_gifts&id=$ank[id]&pid=".htmlspecialchars($pid)."&go\">";
echo "Получатель:<b> $ank[usr]</b><br/><br />\n";
echo "Ваше сообщение:<br/>";
echo "<input type=\"text\" name=\"msg\" value=\"\"/><br />\r\n";
echo "<input type=\"submit\" value=\"Подарить\" />";
echo "</form>\n";
echo'<small>С вашего счета будет снято 50 СoL</small>';

include($path.'inc/down.php');

break;
}
$pod = (isset($_GET['pod'])) ? htmlspecialchars($_GET['pod']) : null;


////////////


switch($pod) {


case '1':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/105.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=105\">Чашка кофе</a></div>";
echo "<div class=msg><img src='/gifts/1.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=1\">Гламурные тапочки</a></div>";
echo "<div class=msg><img src='/gifts/24.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=24\">Роза</a></div>";
echo "<div class=msg><img src='/gifts/26.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=26\">Машинка с клубничкой</a></div>";
echo "<div class=msg><img src='/gifts/5.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=5\">Банан</a></div>";
echo "<div class=msg><img src='/gifts/6.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=6\">Праздничный торт</a></div>";
echo "<div class=msg><img src='/gifts/7.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=7\">Кейс с деньгами</a></div>";
echo "<div class=msg><img src='/gifts/9.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=9\">Коктейль</a></div>";
echo "<div class=msg><img src='/gifts/10.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=10\">Гусеница</a></div>";
echo "<div class=msg><img src='/gifts/30.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=30\">Белые розы</a></div>";
echo "<div class=msg><img src='/gifts/11.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=11\">Подсолнух в очках</a></div>";
echo "<div class=msg><img src='/gifts/107.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=107\">Роза с сердечком</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=2\">Дальше</a></div>";

break;
case '2':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/12.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=12\">Самая любимая</a></div>";
echo "<div class=msg><img src='/gifts/127.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=127\">Чмок - приветик</a></div>";
echo "<div class=msg><img src='/gifts/13.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=13\">С Днем рождения! Пух</a></div>";
echo "<div class=msg><img src='/gifts/28.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=28\">С Днем рождения! Пятачок</a></div>";
echo "<div class=msg><img src='/gifts/113.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=113\">С Днем рождения!</a></div>";
echo "<div class=msg><img src='/gifts/14.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=14\">Шарик - Сердце</a></div>";
echo "<div class=msg><img src='/gifts/15.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=15\">Любимой подруге</a></div>";
echo "<div class=msg><img src='/gifts/16.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=16\">Мой герой!</a></div>";
echo "<div class=msg><img src='/gifts/18.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=18\">Соска</a></div>";
echo "<div class=msg><img src='/gifts/19.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=19\">Обручальные кольца</a></div>";
echo "<div class=msg><img src='/gifts/20.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=20\">Букет красных роз</a></div>";
echo "<div class=msg><img src='/gifts/21.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=21\">Светлое</a></div>";
echo "<div class=msg><img src='/gifts/118.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=118\">Темное</a></div>";
echo "<div class=msg><img src='/gifts/108.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=108\">Розовые сердца</a></div>";
echo "<div class=msg><img src='/gifts/121.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=121\">Букет</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=1\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=3\"> Дальше</a></div>";

break;
case '3':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/22.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=22\">Главный элемент</a></div>";
echo "<div class=msg><img src='/gifts/3.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=3\">Просто ангел</a></div>";
echo "<div class=msg><img src='/gifts/23.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=23\">Мотоцикл</a></div>";
echo "<div class=msg><img src='/gifts/2.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=2\">С Днем Победы</a></div>";
echo "<div class=msg><img src='/gifts/129.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=129\">Настоящий полковник</a></div>";
echo "<div class=msg><img src='/gifts/125.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=125\">Тачка</a></div>";
echo "<div class=msg><img src='/gifts/27.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=27\">Танк</a></div>";
echo "<div class=msg><img src='/gifts/17.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=17\">Гитара</a></div>";
echo "<div class=msg><img src='/gifts/29.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=29\">Золотая звезда</a></div>";
echo "<div class=msg><img src='/gifts/38.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=38\">Супермен</a></div>";
echo "<div class=msg><img src='/gifts/40.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=40\">Hummer</a></div>";
echo "<div class=msg><img src='/gifts/106.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=106\">Красный шарик</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=2\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=4\"> Дальше</a></div>";

break;
case '4':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/31.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=31\">Ключик от сердца</a></div>";
echo "<div class=msg><img src='/gifts/8.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=8\">Стринги</a></div>";
echo "<div class=msg><img src='/gifts/32.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=32\">Розы сердечком</a></div>";
echo "<div class=msg><img src='/gifts/33.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=33\">Рубиновый кулон</a></div>";
echo "<div class=msg><img src='/gifts/34.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=34\">Оранжевая роза</a></div>";
echo "<div class=msg><img src='/gifts/35.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=35\">Принцесса</a></div>";
echo "<div class=msg><img src='/gifts/36.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=36\">Любовь</a></div>";
echo "<div class=msg><img src='/gifts/37.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=37\">Малинка</a></div>";
echo "<div class=msg><img src='/gifts/126.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=126\">Карамелька</a></div>";
echo "<div class=msg><img src='/gifts/39.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=39\">Свадебный торт</a></div>";
echo "<div class=msg><img src='/gifts/4.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=4\">Туалетная бумага</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=3\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=5\"> Дальше</a></div>";

break;
case '5':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/41.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=41\">Sexy</a></div>";
echo "<div class=msg><img src='/gifts/119.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=119\">The best</a></div>";
echo "<div class=msg><img src='/gifts/42.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=42\">Клубничка</a></div>";
echo "<div class=msg><img src='/gifts/43.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=43\">Звездный привет</a></div>";
echo "<div class=msg><img src='/gifts/44.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=44\">Корзина с тюльпанами</a></div>";
echo "<div class=msg><img src='/gifts/45.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=45\">Рыжик в коробке</a></div>";
echo "<div class=msg><img src='/gifts/46.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=46\">Симпатия</a></div>";
echo "<div class=msg><img src='/gifts/47.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=47\">Мишка с шариком</a></div>";
echo "<div class=msg><img src='/gifts/48.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gift&id=$ank[id]&pid=48\">Фотокамера</a></div>";
echo "<div class=msg><img src='/gifts/49.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=49\">Распустившаяся роза</a></div>";
echo "<div class=msg><img src='/gifts/50.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=50\">Большая роза</a></div>";
echo "<div class=msg><img src='/gifts/100.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gift&id=$ank[id]&pid=100\">Голуби</a></div>";
echo "<div class=msg><img src='/gifts/101.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gift&id=$ank[id]&pid=101\">Перстень</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=4\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=6\"> Дальше</a></div>";

break;

case '6':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/51.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=51\">Зайка</a></div>";
echo "<div class=msg><img src='/gifts/52.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=52\">Сокровище</a></div>";
echo "<div class=msg><img src='/gifts/53.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=53\">Баксы</a></div>";
echo "<div class=msg><img src='/gifts/54.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=54\">Купидон</a></div>";
echo "<div class=msg><img src='/gifts/55.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=55\">Подарки</a></div>";
echo "<div class=msg><img src='/gifts/57.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=57\">Шампанское</a></div>";
echo "<div class=msg><img src='/gifts/58.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=58\">Сердце</a></div>";
echo "<div class=msg><img src='/gifts/59.gif'  < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gift&id=$ank[id]&p&id=59\">Super GIRL</a></div>";
echo "<div class=msg><img src='/gifts/102.gif'  < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=102\">I love you</a></div>";
echo "<div class=msg><img src='/gifts/56.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=56\">Скованные одной цепью</a></div>";
echo "<div class=msg><img src='/gifts/114.gif'  < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=114\">Супер девушка</a></div>";
echo "<div class=msg><img src='/gifts/117.gif'  < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=117\">Красавица</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=5\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=7\"> Дальше</a></div>";

break;
case '7':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/61.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=61\">Ты супер!</a></div>";
echo "<div class=msg><img src='/gifts/62.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=62\">Супер МУЖИК</a></div>";
echo "<div class=msg><img src='/gifts/63.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=63\">Конфеты</a></div>";
echo "<div class=msg><img src='/gifts/64.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=64\">Розовый мишка</a></div>";
echo "<div class=msg><img src='/gifts/65.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=65\">Брильянт</a></div>";
echo "<div class=msg><img src='/gifts/66.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=66\">Оскар</a></div>";
echo "<div class=msg><img src='/gifts/60.gif'  < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=60\">Футбольный мяч</a></div>";
echo "<div class=msg><img src='/gifts/67.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=67\">Крутой перец</a></div>";
echo "<div class=msg><img src='/gifts/120.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=120\">Boss</a></div>";
echo "<div class=msg><img src='/gifts/68.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gift&id=$ank[id]&p&id=68\">Бомба</a></div>";
echo "<div class=msg><img src='/gifts/69.gif' < width='45' height='45' alt=''>  <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=69\">Розовые розы</a></div>";
echo "<div class=msg><img src='/gifts/70.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=70\">Тигренок</a></div>";
echo "<div class=msg><img src='/gifts/71.gif'  < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=71\">Туфельки</a></div>";
echo "<div class=msg><img src='/gifts/72.gif'  < width='45' height='45' alt=''>t <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=72\">Виски</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=6\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=8\">Дальше</a></div>";

break;
case '8':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/99.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=99\">Яхта</a></div>";
echo "<div class=msg><img src='/gifts/103.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=103\">Розовый шарик</a></div>";
echo "<div class=msg><img src='/gifts/124.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=124\">Тортик - сердце</a></div>";
echo "<div class=msg><img src='/gifts/128.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=128\">Шоколадные сердца</a></div>";
echo "<div class=msg><img src='/gifts/104.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=104\">Коробка с конфетами. Сердечко</a></div>";
echo "<div class=msg><img src='/gifts/109.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=109\">Котенок в коробке</a></div>";
echo "<div class=msg><img src='/gifts/110.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=110\">Корзина с фруктами</a></div>";
echo "<div class=msg><img src='/gifts/111.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=111\">Золотой череп</a></div>";
echo "<div class=msg><img src='/gifts/112.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=112\">Сигары</a></div>";
echo "<div class=msg><img src='/gifts/115.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=115\">Привет!</a></div>";
echo "<div class=msg><img src='/gifts/116.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=116\">Кубок</a></div>";
echo "<div class=msg><img src='/gifts/112.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=122\">Бабочка на цветке</a></div>";
echo "<div class=msg><img src='/gifts/123.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=123\">Бабочка</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=7\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=9\">Дальше</a></div>";


break;
case '9':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/73.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=73\">Новогодняя белочка</a></div>";
echo "<div class=msg><img src='/gifts/74.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=74\">Новогодние свечи</a></div>";
echo "<div class=msg><img src='/gifts/75.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=75\">Новогодний шарик</a></div>";
echo "<div class=msg><img src='/gifts/76.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=76\">Новогодний подарок</a></div>";
echo "<div class=msg><img src='/gifts/77.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=77\">Котенок</a></div>";
echo "<div class=msg><img src='/gifts/78.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=78\">Пингвиненок</a></div>";
echo "<div class=msg><img src='/gifts/79.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=79\">Бокал Шампанского</a></div>";
echo "<div class=msg><img src='/gifts/80.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=80\">Снеговик</a></div>";
echo "<div class=msg><img src='/gifts/81.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=81\">Свеча</a></div>";
echo "<div class=msg><img src='/gifts/82.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=82\">Елочная игрушка</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=8\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=10\">Дальше</a></div>";

break;
case '10':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/83.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=83\">Я очень сильно люблю</a></div>";
echo "<div class=msg><img src='/gifts/84.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=84\">С днем св.Валентина!</a></div>";
echo "<div class=msg><img src='/gifts/85.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=85\">ЛЮБЛЮ</a></div>";
echo "<div class=msg><img src='/gifts/86.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=86\">Сердечки</a></div>";
echo "<div class=msg><img src='/gifts/87.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=87\">СЕРДЦЕ</a></div>";
echo "<div class=msg><img src='/gifts/88.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=88\">В зеленом цвете</a></div>";
echo "<div class=msg><img src='/gifts/89.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=89\">Мое сердце</a></div>";
echo "<div class=msg><img src='/gifts/90.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=90\">Дарю тебе свое сердце</a></div>";
echo "<div class=msg><img src='/gifts/91.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=91\">Рубиновая валентинка</a></div>";
echo "<div class=msg><img src='/gifts/92.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=92\">Еще сердце</a></div>";
echo "<div class=msg><img src='/gifts/93.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=93\">LOVE</a></div>";
echo "<div class=msg><img src='/gifts/94.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=94\">Два сердца</a></div>";
echo "<div class=msg><img src='/gifts/95.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=95\">Мое сердце- тебе!</a></div>";
echo "<div class=msg><img src='/gifts/96.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=96\">Две половинки</a></div>";
echo "<div class=msg><img src='/gifts/97.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=97\">Как птички</a></div>";
echo "<div class=msg><img src='/gifts/98.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=98\">8 Марта</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=9\">Назад</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=11\">Дальше</a></div>";

break;
case '11':
echo "<p>Выбери подарок для  $ank[usr]</p><hr/>";

echo "<div class=msg><img src='/gifts/130.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=130\">Христос Воскрес</a></div>";
echo "<div class=msg><img src='/gifts/131.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=131\">ХВ</a></div>";
echo "<div class=msg><img src='/gifts/132.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=132\">Христос Воскрес</a></div>";
echo "<div class=msg><img src='/gifts/133.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=133\">Кролик</a></div>";
echo "<div class=msg><img src='/gifts/134.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=134\">Куличи</a></div>";
echo "<div class=msg><img src='/gifts/135.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=135\">Поздравление</a></div>";
echo "<div class=msg><img src='/gifts/136.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=136\">Поздравление</a></div>";
echo "<div class=msg><img src='/gifts/137.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=137\">Яйцо в корзине</a></div>";
echo "<div class=msg><img src='/gifts/138.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=138\">Христос Воскрес</a></div>";
echo "<div class=msg><img src='/gifts/139.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=139\">С праздником</a></div>";
echo "<div class=msg><img src='/gifts/140.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=140\">Поздравляю</a></div>";
echo "<div class=msg><img src='/gifts/141.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=141\">Свеча</a></div>";
echo "<div class=msg><img src='/gifts/142.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=142\">Кулич</a></div>";
echo "<div class=msg><img src='/gifts/143.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=143\">Крест</a></div>";
echo "<div class=msg><img src='/gifts/144.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=144\">С Пасхой!</a></div>";
echo "<div class=msg><img src='/gifts/145.gif' < width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=145\">Цыплята</a></div>";
echo "<div class=inoy><a href=\"gifts.php?id=$ank[id]&pod=10\">Назад</a></div>";
}
if ($k_page>1)str("/podarki/gifts.php?id=$ank[id]&pod",$k_page,$page); // Вывод страниц




include($path.'inc/down.php');
?>