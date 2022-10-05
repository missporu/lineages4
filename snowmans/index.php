<?php

$path = '../';
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
$home = 'http://'.$_SERVER['HTTP_HOST'];
$id = isset($_GET['id']) ? intval($_GET['id']) : ''; 
$id = empty($id) ? $udata['id'] : $id; 

if($udata['time']<3600*5){
echo'Ваш онлайн ниже 5часов.Вы не можете учавствовать в игре!';
include($path.'inc/down.php');
exit;}

if (!$udata['id']) { 
echo 'Только для зарегистрированых<br /><a href="', htmlspecialchars($_SERVER['HTTP_REFERER']), '">Назад</a>'; 
include($path.'inc/down.php');
exit; 
}

$act = isset($_GET['act']) ? htmlspecialchars($_GET['act']) : '';
if($act != 'snow' && $act != 'top') {
$req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id'");
if (mysql_num_rows($req))
$usr = mysql_fetch_assoc($req);
else {
    echo 'Такой кользователь не существует!<br /><a href="', htmlspecialchars($_SERVER['HTTP_REFERER']), '">Назад</a>'; 
include($path.'inc/down.php');
    exit; 
}
}
switch ($act) { 
case 'snow':
$textl = 'Снеговик'; 
$headmod = 'snowmans'; 
echo '<div class="phdr">Собери Иголки</div>';
$code = isset($_GET['code']) ? abs(intval($_GET['code'])) : '';
$code2 = intval(file_get_contents('./db/db.dat'));
if($code == $code2) {
file_put_contents('./db/db.dat', mt_rand(10000, 9999999));
$r_s = mt_rand(1,3);
mysql_query("UPDATE `users` SET `ig` = `ig`+$r_s  WHERE `id` = '" . $udata['id'] . "'");
echo '<div class="gmenu">Вы собрали  ', $r_s, ' Иголки<br/>
Их можно потратить в локациях таких как <a href="/2019.php"><font color=lightskyblue>Снежный Бунт</font></a> или же <a href="/shop_ny.php"><font color=lightskyblue>Новогодний Магазин</font></a> </div>';
} else
echo '<div class="rmenu">Иголки иссохли, и вы не успели их собрать :( </div>';
echo '<br/><div class="phdr"><a href="', htmlspecialchars($_SERVER['HTTP_REFERER']), '">Назад</a></div>';
break;
}
include($path.'inc/down.php');
?>