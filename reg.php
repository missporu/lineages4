<?php

$textl='Регистрация';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');

$in_chat = mysql_query("SELECT reg FROM option_game WHERE id = 1");
$iiii =mysql_fetch_array ($in_chat);
if ($iiii[reg]=='off'){
echo "<div class=dot> Регистрация закрыта</div>";
echo'<a href="/index.php">Назад</a>';
include($path.'inc/endmain.php');
	exit;
}
if ($user_id==0){

echo'<div class="gameBorder">';









echo'<b>Регистрация</b><br/><br/>';
echo'<div style="color:#7F0000;text-align:center;"> <b>При регистрации вы получите 30миллионов аден на развитие и набор новичка с норм статами для кача</b></div></div>';

function first()
{
$ref=rand(0,10000);
$_SESSION[kod]=$ref;

if(!empty($_GET[site])){
echo "<form action=\"reg.php?mod=goreg\" method=\"post\">";
}else{
echo '<form action="reg.php?mod=goreg" method="post">';
}
echo"Логин:<br/>
<font color=grey><small>max 15 ,  \"A-z-0-9\" </small></font><br/>
<input class='input' type=\"text\" size=\"10\" name=\"nick\" maxlength=\"15\"/><br/>";

echo"Пароль:<br/>
<font color=grey><small>max 15 , латиница и цифры</small></font><br/>
<input class='input' name=\"pass\" size=\"10\" type=\"password\" maxlength=\"15\"/><br/>";

echo"Пароль:<br/>
<font color=grey><small>Повторите пароль</small></font><br/>
<input class='input' name=\"repass\" size=\"10\" type=\"password\" maxlength=\"15\"/><br/>";

echo"Ваш e-mail:<br/>
<font color=grey><small>Нужен для востановления пароля<br/>
<small>(изменить нельзя)</small>
</small></font><br/>
<input class='input' type=\"text\" size=\"10\" name=\"email\" maxlength=\"50\"/><br/>";

echo "Расса:<br/>
<select name=\"storona\">
<option value=\"human\">Человек</option>
<option value=\"gnom\">Гном</option>
<option value=\"elf\">Светлый эльф</option>
<option value=\"darkelf\">Темный эльф</option>
<option value=\"ork\">Орк</option>
</select>";

echo "<br/>";

echo "Укажите ваш пол:<br/>
<select name=\"pol\"><option value=\"m\">Парень</option>
<option value=\"w\">Девушка</option></select><br/>";

echo "Выберите класс:<br/>
<select  name=\"klas\">
<option value=\"wizard\">Маг</option>
<option value=\"fighert\">Воин</option></select><br/>";

echo"Введите код: <b><font color=green>$ref</font></b>
<br/><input class='input' type=\"text\" name=\"kod\" maxlength=\"6\"/>";


echo "<p>Регистрируясь, Вы автоматически соглашаетесь с <a href=\"rules.php\">правилами игры</a>.</p>";

echo '<input class="button" type="submit" value="Регистрация" /></form>';
echo "</div>";
echo'<a href="index.php">Назад</a><hr/>';



}

function goreg()
{

if(eregi("[^a-z0-9-]",$_POST[nick]))
{
echo"Логин содержит запрещенные символы.<br/>
<a href=\"reg.php?\">Вернуться к регистрации</a><br/>"; 
include($path.'inc/end.php'); exit;
}


if(
$_POST[storona]!='human' and 
$_POST[storona]!='gnom' and 
$_POST[storona]!='elf' and 
$_POST[storona]!='darkelf' and 
$_POST[storona]!='ork'
){
echo "Невыбрана сторона персонажа!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}

if($_POST[klas]!='fighert' and $_POST[klas]!='wizard'){
echo "Невыбран класс персонажа!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}

if($_POST[storona]=='gnom' and $_POST[klas]=='wizard'){
echo "Гномы не могут быть магами!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}else{


if($_POST[pol]!='m' and $_POST[pol]!='w'){
echo "Невыбран пол персонажа!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}


$ip=htmlspecialchars(stripslashes($_SERVER['REMOTE_ADDR']));
$pass = $_POST[pass];
$_POST[nick] = addslashes("$_POST[nick]");
$_POST[nick] = htmlspecialchars($_POST[nick]);
    
$_POST[pass] = addslashes("$_POST[pass]");       
$_POST[pass] = htmlspecialchars($_POST[pass]);

$_POST[repass] = addslashes("$_POST[repass]");
$_POST[repass] = htmlspecialchars($_POST[repass]);
    
$_POST[email] = addslashes("$_POST[email]");       
$_POST[email] = htmlspecialchars($_POST[email]);
	
$tkr = mysql_query("SELECT * FROM `users` WHERE `usr` = '$_POST[nick]'");
$tkr=mysql_num_rows($tkr);

$bips = mysql_query("SELECT * FROM `users` WHERE `ip` = '$ip'");
$bip=mysql_num_rows($bips);

if($_SESSION[kod]!=$_POST[kod])
{
unset($_SESSION[kod]);
echo "Не правильно введён защитный код!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
elseif (@preg_replace("[A-za-zА-яа-я0-9-_]+", "", $_POST[nick]) || @preg_replace("[A-za-z0-9]+", "", $_POST[pass]) || @preg_replace("[A-za-z0-9]+", "", $_POST[repass]))
{
echo "Используете запрещённые символы!<br/>";
echo "<a href=\"reg.php?site='.htmlspecialchars($_GET[site]).'\">Назад</a></div>";
}


elseif (ereg("/[0-9a-z_]+@[0-9a-z_^\.]", "", $_POST[email]))
{
echo "Не правильно введён e-mail!</div>";
echo "<a href=\"reg.php?site='.htmlspecialchars($_GET[site]).'\">Назад</a></div>";
}


elseif (($tkr < 1) && ($bip < 7) && ($_POST[nick] != "") && ($_POST[pass] != "") && ($_POST[repass] != "") && ($_POST[pass] == $_POST[repass]))
{

$dater=date("d F, Y", time());
$time=date("H:i:s", time());
$dater = str_replace("January","января",$dater);
$dater = str_replace("February","февраля",$dater);
$dater = str_replace("March","марта",$dater);
$dater = str_replace("April","апреля",$dater);
$dater = str_replace("May","мая",$dater);
$dater = str_replace("June","июня",$dater);
$dater = str_replace("July","июля",$dater);
$dater = str_replace("August","августа",$dater);
$dater = str_replace("September","сентября",$dater);
$dater = str_replace("October","октября",$dater);
$dater = str_replace("November","ноября",$dater);
$dater = str_replace("December","декабря",$dater);

$_POST[pass] = md5($_POST[pass]);

$storona = $_POST[storona];

if($_POST[storona]=="human"){$city="Talking Island Village"; $all=50;}
if($_POST[storona]=="gnom"){$city="Dwarven Village"; $all=100;}
if($_POST[storona]=="elf"){$city="Elven Village";  $all=60;}
if($_POST[storona]=="darkelf"){$city="Dark Elven Village"; $all=75;}
if($_POST[storona]=="ork"){$city="Orc Village";  $all=100;}
if($_POST[storona]=="kamael"){$city="Kamael Village";  $all=100;}


if($_POST[klas]=="wizard"){
$mp = 100 + $all; $hp = 100 + $all;
$patt = 23; 
$matt = 56;
$pdef = 63;
$mdef = 52;
}


if($_POST[klas]=="fighert"){
$mp=80+$all; $hp=120+$all;
$patt = 55;
$matt = 21;
$pdef = 68;
$mdef = 49;
}



if(!empty($_GET[ref])){
$req = mysql_query("SELECT `ip` FROM `users` WHERE `id` = '".mysql_real_escape_string($_GET[ref])."' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);

if ($avto == 1) {
    $refer = mysql_fetch_array($req);
    
    if($ip!=$refer[ip]){
    
    mysql_query("INSERT INTO
        `users` SET
        `usr` = '$_POST[nick]',
        `pass` = '$_POST[pass]',
        `email` = '$_POST[email]',
        `ip` = '$ip',
        `pol` = '$_POST[pol]',
        `storona` = '$_POST[storona]',
        `lvl` = '0',
        `money` = '30000000',
        `almaz` = '0',
        `skill` = '3',
        `hp` = '$hp',
        `hpall` = '$hp',
        `mp` = '$mp',
        `mpall` = '$mp',
        `exp` = '0',
        `patt` = '$patt',
        `matt` = '$matt',
        `pdef` = '$pdef',
        `mdef` = '$mdef',
        `klas` = '$_POST[klas]',
        `city` = '$city',
`ref` = '".mysql_real_escape_string($_GET[ref])."',
        `lvisit` = '$dater $time'");
    
    }
    
    }
}else{
    mysql_query("INSERT INTO
        `users` SET
        `usr` = '$_POST[nick]',
        `pass` = '$_POST[pass]',
        `email` = '$_POST[email]',
        `ip` = '$ip',
        `pol` = '$_POST[pol]',
        `storona` = '$_POST[storona]',
        `lvl` = '0',
        `money` = '30000000',
        `almaz` = '0',
        `skill` = '3',
        `hp` = '$hp',
        `hpall` = '$hp',
        `mp` = '$mp',
        `mpall` = '$mp',
        `exp` = '0',
        `patt` = '$patt',
        `matt` = '$matt',
        `pdef` = '$pdef',
        `mdef` = '$mdef',
        `klas` = '$_POST[klas]',
        `city` = '$city',
        `lvisit` = '$dater $time'");
}


mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'golova',
        `name` = 'Newbie Helmet of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'weapon',
        `name` = 'Newbie Weapon of l2war.mobi',
        `cena` = '60',
        `patt` = '1500',
        `matt` = '1500',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'shit',
        `name` = 'Newbie Shield of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'ruki',
        `name` = 'Newbie Gloves of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'body',
        `name` = 'Newbie Body of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'pants',
        `name` = 'Newbie Gaunt of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'nogi',
        `name` = 'Newbie Boots of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");


mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'amulet',
        `name` = 'Newbie Neklace of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'poyas',
        `name` = 'Newbie Earring of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'rpoyas',
        `name` = 'Newbie Earring of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");


mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'kolco',
        `name` = 'Newbie Ring of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");


mysql_query("INSERT INTO
        `item` SET
        `usr` = '$_POST[nick]',
        `tip` = 'rkolco',
        `name` = 'Newbie Ring of l2war.mobi',
        `cena` = '60',
        `patt` = '0',
        `matt` = '0',
        `pdef` = '250',
        `mdef` = '250',
        `soul` = '0',
        `spirit` = '0',
        `image` = 'not'");

		
if($_POST[klas]=="wizard"){
mysql_query("INSERT INTO
        `mag` SET
        `usr` = '$_POST[nick]',
        `name` = 'Magic attack',
        `lat_name` = 'mag_strela',
        `tip` = 'atack',
        `klas` = 'wizard',
        `uron` = '3|5|8|9|10|11|12|13|15|17',   
        `mp` = '9|10|12|13|14|15|16|17|18|19',   
        `lv` = '1|1|1|3|3|3|5|5|7|7',   
        `hp` = '0|0|0|0|0|0|0|0|0|0',   
        `plushp` = '0|0|0|0|0|0|0|0|0|0',   
        `lvlmax` = '8',   
        `cena` = '5|10|20|38|54|80|112|180|260',        
        `lvl` = '1'");
}
if($_POST[klas]=="fighert"){
mysql_query("INSERT INTO
        `mag` SET
        `usr` = '$_POST[nick]',
        `name` = 'Strong blow',
        `lat_name` = 'siln_udar',
        `tip` = 'atack',
        `klas` = 'fighert',
        `uron` = '20|35|48|61|74|87|100|133|157|240',   
        `mp` = '7|9|10|11|12|13|14|15|16|17',   
        `lv` = '1|1|1|3|3|3|5|5|7|7',   
        `hp` = '0|0|0|0|0|0|0|0|0|0',   
        `plushp` = '0|0|0|0|0|0|0|0|0|0',   
        `lvlmax` = '8',   
        `cena` = '5|10|20|38|54|80|112|180|260',
        `lvl` = '1'");
}

// если сайт реферала


		
///////////////////////////////////

mysql_query("INSERT INTO `mesto` SET `usr` = '$_POST[nick]',`place` = 'main',`page` = '0',`mesto` = 'Shadow of the Monster Tree',`city` = '0'");

$date = time();
mysql_query("INSERT INTO regenerator SET usr = '$_POST[nick]', last = '$date'");









// пишем в чат что в игре новый игрок
$time = date("H:i");
$msg = "<font color=#FF6A00>В игре появился новый игрок под псевдонимом 
<a href=\"search.php?nick=$_POST[nick]&amp;go=go\">$_POST[nick]</a>. 
Давайте вместе поможем ему освоится в нашем мире!</font>
";mysql_query("INSERT INTO komentarai SET nick = 'Система', komentaras = '$msg', kada = '$data', time = '$time'");

$actime=time()+86400;
$data = date("y/m/d");
mysql_query("INSERT INTO
        `new_usr` SET
        `usr` = '$_POST[nick]',
        `data` = '$data',
        `time` = '$actime'");

//-----------
$time = date("H:i d.m.y");
$text = "Добро пожаловать в игру Lineage 3!
Этот мир ждёт тебя, путешествуй, сражайся и просто отдыхай!
Тебе в помощь дали доспех и оружие, лучше одень их сразу в  <a href=\"inventar.php\">инвентаре</a>! 
Вопросы задавать в <a href=\"chat.php\">чате</a>! Администрация на вопросы по игре не отвечает! 
Писать только насчёт найденых багов, недочётов и с предложениями! Рекомендуем ознакомится с <a href=\"faq.php\">библиотекой</a> игры!
Приятного времяпровождения!
";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'KraToS', `user_to` = '$_POST[nick]', `time` = '$time', `read` = 1, `mail_msg` = '$text'");

$_SESSION['log'] = $_POST[nick];
$_SESSION['pas'] = $_POST[pass];
$_SESSION['klas'] = $_POST[klas];
$_SESSION['storona'] = $storona;

echo "Добро пожаловать в игру Lineage 3!<br/>";
echo "Логин: $_POST[nick]<br/>
Пароль: $pass</div>";
echo "<div class=\"inoy\"><a href=\"reg.php?mod=intro\">Далее</a></div>";
}
else if($_POST[nick] == "")
{
echo "Вы оставили пустое поле: Логин!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
elseif($_POST[pass] == "")
{
echo "Вы оставили пустое поле: Пароль!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
elseif($_POST[repass] == "")
{
echo "Вы оставили пустое поле: Пароль(повторно)!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
elseif($_POST[pass] != $_POST[repass])
{
echo "Пароли не совпадают!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
elseif($tkr > 0)
{
echo "Логин занят, выберите другой!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
elseif($bip > 7)
{
echo "Не стоит заводить столько много аккаунтов!<br/>";
echo "<a href=\"reg.php?\">Назад</a></div>";
}
}
}
function intro(){
if(empty($_SESSION['log']) or empty($_SESSION['pas']) or empty($_SESSION['storona']) or empty($_SESSION['klas'])){
echo "Ошибка!</div>";
echo "<div class=\"foot\"><a href=\"reg.php?\">Назад</a></div>";
}else{

//if($_SESSION['storona']=='white'){ ты выбрал путь} // дописать стиорону


echo'<br/>Не проходи мимо, Ты новичёк ещё, поэтому прочти несколько советов!<br/>
<b>Вы получили 10миллионов аден и VIP акк х25 на 3 часа!</b><br/>
1. Зайдя в игру сразу зайди в инвентарь и одень вещи!<br/>
2. На первый час в Lineage 3 тебе дана Слабая аура шока, используй её с умом. Лучше невыходить сразу с игры!<br/>
3. Для того чтобы стать более сильным ты должен получать опыт и подымать свой уровень,<br/>
за каждый уровень ты получаешь 3 очка опыта, которые можешь распределить на физ. параметры!<br/> Убивая монстров, они находяться в МИРЕ, будешь получать опыт, деньги, вещи.<br/>
4. Советуем пройти все квесты у наставника, так вы быстрей раскачаетесь. Все вещи можно купить на Торговой площади!<br/>
5. Ответы на вопросы ты всегда найдёшь в чате или в библиотеке! ';
echo "<hr/><div class=\"inoy\"><a href=\"index.php?\">Войти в игру</a>";
}
}
if($_GET[mod] == "")
{first();}
elseif($_GET[mod] == "goreg")
{goreg();}
elseif($_GET[mod] == "intro")
{intro();}


}else
{
echo'<br/>Не проходи мимо, Ты новичёк ещё, поэтому прочти несколько советов!<br/>
<b>Вы получили 10миллионов аден и VIP акк х25 на 3 часа!</b><br/>
1. Зайдя в игру сразу зайди в инвентарь и одень вещи!<br/>
2. На первый час в Lineage 3 тебе дана Слабая аура шока, используй её с умом. Лучше невыходить сразу с игры!<br/>
3. Для того чтобы стать более сильным ты должен получать опыт и подымать свой уровень,<br/>
за каждый уровень ты получаешь 3 очка опыта, которые можешь распределить на физ. параметры!<br/> Убивая монстров, они находяться в МИРЕ, будешь получать опыт, деньги, вещи.<br/>
4. Советуем пройти все квесты у наставника, так вы быстрей раскачаетесь. Все вещи можно купить на Торговой площади!<br/>
5. Ответы на вопросы ты всегда найдёшь в чате или в библиотеке! ';
echo "<hr/><div class=\"inoy\"><a href=\"index.php?\">Войти в игру</a>";


}

include($path.'inc/end.php');
?>
