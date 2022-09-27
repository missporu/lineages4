<?php
define('PROTECTOR', 1);

$textl='Регистрация аккаунта';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
//include($path.'inc/regfunc.php');

$iiii = mysql_fetch_assoc(mysql_query("SELECT reg FROM option_game WHERE id = 1"));

if ($iiii['reg']=='off'){
echo "<div class=dot> Регистрация закрыта</div>";
echo'<a href="/index.php">Назад</a>';
include($path.'inc/endmain.php');
	exit;
}



if($user_id==0){
echo'<div class="gameBorder">';


echo'<b>Регистрация аккаунта</b><br/><br/>';
echo'<div style="color:#7F0000;text-align:center;"> <b>После создания аккаунта вы сможете создать один или несколько персонажей на нем и прокачивать их одновременно</b></div></div>';

function first()
{

echo '<div class="account_reg">';
echo '<form action="account.php?mod=goreg" method="post">';

echo '<br />';
echo 'Логин: <br /> <small>max 10, A-z-0-9</small> <br />
<input class="input" type="text" size="10" name="nick" maxlength="15" />';
echo '<br />';

echo 'Пароль: <br /><small>max 15 , латиница и цифры</small><br />
<input class="input" name="pass" size="10" type="password" maxlength="15"/><br/>';

echo"Пароль:<br/>
<small>Повторите пароль</small><br/>
<input class='input' name=\"repass\" size=\"10\" type=\"password\" maxlength=\"15\"/><br/>";




echo'<p>Введите текст на картинке:</p>
<p><img src="kcaptcha/index.php?'.session_name().'='.session_id().'"></p>
<p><input type="text" name="keystring"></p>';


echo "<p>Регистрируясь, Вы автоматически соглашаетесь с <a href=\"rules.php\">правилами игры</a>.</p>";

echo '<input class="button" type="submit" value="Регистрация" /></form>';
echo "</div>";
echo '</div>';
echo'<a href="index.php">Назад</a><hr/>';
}




function goreg()
{

if(eregi("[^a-z0-9-]",$_POST['nick']))
{
echo"Логин содержит запрещенные символы.<br/>
<a href=\"account.php?\">Вернуться к регистрации</a><br/>"; 
include($path.'inc/end.php'); exit;
}






$ip=htmlspecialchars(stripslashes($_SERVER['REMOTE_ADDR']));
$pass = $_POST['pass'];
$_POST['nick'] = addslashes($_POST['nick']);
$reg_nick = htmlspecialchars($_POST['nick']);
    
$_POST['pass'] = addslashes($_POST['pass']);    
$reg_pass = htmlspecialchars($_POST['pass']);

$_POST['repass'] = addslashes($_POST['repass']);
$reg_repass = htmlspecialchars($_POST['repass']);
    

	
$tkrs = mysql_query("SELECT * FROM `account` WHERE `nick` = '".mysql_real_escape_string($reg_nick)."'");
$tkr = mysql_num_rows($tkrs);



if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']){
}else{
	echo'Неверно введен проверочный код<br>';
echo "<a href=\"account.php?\">Назад</a></div>";
include($path.'inc/end.php');
exit;
}
if (@preg_replace("[A-za-zА-яа-я0-9-_]+", "", $reg_nick)){
    
echo "Используете запрещённые символы в логине!<br/>";
echo "<a href=\"account.php?\">Назад</a></div>";
}


elseif (($tkr < 1) &&($reg_nick) && ($reg_pass) && ($reg_repass) && ($reg_pass == $reg_repass))
{
//Первая проверка на существования такого же логина
//Вторая для проверки на количество аккаунтов данного юзера
//Ну а дальше все понятно
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

$reg_pass = md5($reg_pass);

if(!empty($_GET[ref])){
$req = mysql_query("SELECT `ip` FROM `users` WHERE `id` = '".mysql_real_escape_string($_GET[ref])."' LIMIT 1");
// //////////////////////////
$avto = $mysql->num_rows($req);

if ($avto == 1) {
    $refer = $mysql->fetch_assoc($req);
    
    if($ip!=$refer[ip]){
    
    mysql_query("INSERT INTO
        `account` SET
        `nick` = '".$reg_nick."',
        `pass` = '".$reg_pass."',
        `ip` = '".$ip."',
        `ref` = '".mysql_real_escape_string($_GET['ref'])."',
        `lvisit` = '$dater $time'");
    }
    
    }
}else{
    mysql_query("INSERT INTO
        `account` SET
        `nick` = '".$reg_nick."',
        `pass` = '".$reg_pass."',
        `ip` = '".$ip."',
        `lvisit` = '$dater $time'");
    }

//-----------



$_SESSION['nick'] = $reg_nick;
$_SESSION['password'] = $reg_pass;
Setcookie("reg", "1", 3600*24);
echo "Добро пожаловать в игру Lineage 3!<br/>";
echo "Логин: $reg_nick<br/>
Пароль: $pass</div>";
echo "<div class=\"inoy\"><a href=\"account.php?mod=intro\">Далее</a></div>";
}
else if(!$reg_nick)
{
echo "Вы оставили пустое поле: Логин!<br/>";
echo "<a href=\"account.php?\">Назад</a></div>";
}
elseif(!$reg_pass)
{
echo "Вы оставили пустое поле: Пароль!<br/>";
echo "<a href=\"account.php?\">Назад</a></div>";
}
elseif(!$reg_repass)
{
echo "Вы оставили пустое поле: Пароль(повторно)!<br/>";
echo "<a href=\"account.php?\">Назад</a></div>";
}
elseif($reg_pass != $reg_repass)
{
echo "Пароли не совпадают!<br/>";
echo "<a href=\"account.php?\">Назад</a></div>";
}
elseif($tkr > 0)
{
echo "Аккаунт с таким логином уже существует! Выберите другой<br/>";
echo "<a href=\"account.php?\">Назад</a></div>";
}
}

function intro(){
if(empty($_SESSION['nick']) or empty($_SESSION['password'])){
echo "Ошибка!</div>";
echo "<div class=\"foot\"><a href=\"account.php?\">Назад</a></div>";
}else{

echo 'Здравствуй! И так немного о игре:<br />
1.Ты можешь создать несколько персонажей на одном аккаунте, не надо регистрировать несколько аккаунтов<br />
2.Для начала игры тебе надо создать персонажа и войти ним в игру<br />
3.Если у тебя есть вопросы обращайся в ЦП или в онлайн чат [Доступно после создания персонажа]';

echo '<hr/><div class="inoy"><a href="office.php?act=new">Создать персонажа</a>';
}
}
if($_GET['mod'] == "")
{first();}
elseif($_GET['mod'] == "goreg")
{goreg();}
elseif($_GET['mod'] == "intro")
{intro();}


}else{
echo 'Здравствуй! И так немного о игре:<br />
1.Ты можешь создать несколько персонажей на одном аккаунте, не надо регистрировать несколько аккаунтов<br />
2.Для начала игры тебе надо создать персонажа и войти ним в игру<br />
3.Если у тебя есть вопросы обращайся в ЦП или в онлайн чат [Доступно после создания персонажа]';

echo '<hr/><div class="inoy"><a href="office.php?act=new">Создать персонажа</a>';

}

include($path.'inc/end.php');
?>