<?php

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
$path='../';			//
///////////////////////
//////////////////////
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if (isset($_GET[tex_off]) and $udata[dostup]>=5){ //Отключить 
mysql_query("UPDATE `option_game` SET `tex` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}

if (isset($_GET[chat_off]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `chat` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[act300_off]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `act300` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[act500_off]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `act500` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}

if (isset($_GET[reg_off]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `reg` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[serv_off]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `igra` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[reit_off]) and $udata[dostup]>=5){ //Отключить
$time = date("H:i");
$msg = "<font color=red><b>Выключен опыт х2</b></font>";
mysql_query("INSERT INTO komentarai SET nick = 'Система', komentaras = '$msg', kada = '$data', time = '$time'");
mysql_query("UPDATE `option_game` SET `reit` = 'off' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[reit_on]) and $udata[dostup]>=5){ //Отключить
$time = date("H:i");
$msg = "<font color=lime><b>Включен опыт х2</b></font>";
mysql_query("INSERT INTO komentarai SET nick = 'Система', komentaras = '$msg', kada = '$data', time = '$time'");
mysql_query("UPDATE `option_game` SET `reit` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[tex_on]) and $udata[dostup]>=5){ //Отключить 
mysql_query("UPDATE `option_game` SET `tex` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}

if (isset($_GET[chat_on]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `chat` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[reg_on]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `reg` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[serv_on]) and $udata[dostup]>=5){ //Отключить
mysql_query("UPDATE `option_game` SET `igra` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[act300_on]) and $udata[dostup]>=5){ //Отключить 
 mysql_query("UPDATE `option_game` SET `act300` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}


if (isset($_GET[act500_on]) and $udata[dostup]>=5){ //Отключить 
 mysql_query("UPDATE `option_game` SET `act500` = 'on' WHERE `id` = '1'");
header ("Location: /gm/index.php?",false);exit;}
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////

if ($udata[dostup]==5){

switch($_GET[mod]){

default:
echo "<div class=adm>";
echo "<font color=#007F7F><b><center>GM-Panel</center><br/></b></font>";
echo "</div>";

echo "<div class=adm>";
$wm = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm`"));


echo' <a href="wm.php?">&#187; Заявки покупок WM  <font color=red>+'.$wm.'</font></a>';
echo' <a href="actions.php?">&#187; <font color=darkviolet>Выдать акцию</font> </a>';
echo' <a href="pokupka.php?">&#187; <font color=darkviolet>Выдать игровую покупку (Пит)</font> </a>';
echo' <a href="pokupka_vip.php?">&#187; <font color=darkviolet>Выдать вип карту</font> </a>';
echo' <a href="red_act.php?">&#187; <font color=darkorange>Редактировать цены акции</font> </a>';
echo' <a href="red_aluk.php?">&#187; <font color=darkorange><b>Возродить Valakas</b></font> </a>';
echo' <a href="skill.php?">&#187; Изменить скилы </a>';
echo' <a href="mail_vh.php?">&#187; Вся почта</a>';
echo' <a href="msg.php?">&#187; Читать почту</a>';
echo' <a href="vhod.php?">&#187; IP Данные игрока</a>';
echo' <a href="poisk.php?">&#187; Поиск по  IP</a>';
echo' <a href="logi.php?">&#187; Логи переводов</a>';
echo' <a href="msg_all.php?">&#187; Рассылка сообщений</a>';
echo' <a href="msg_adm.php?">&#187; Рассылка сообщений всей администрации</a>';
echo' <a href="lvl_new.php?">&#187; Добавить уровней</a>';
echo' <a href="ava.php?">&#187; Аватарки</a>';
echo' <a href="/passer.php?">&#187; Сменить пароль аккаунту</a>';
echo "</div>";


$in_chat = mysql_query("SELECT * FROM option_game WHERE id = 1");
$iiii =mysql_fetch_array ($in_chat);
if($iiii[act300]=='on'){
echo'<a href="index.php?act300_off">&#187; Выключить акцию 300R</a><br/>';
}else{
echo'<a href="index.php?act300_on">&#187; Включить акцию 300R</a><br/>';
}

if($iiii[act500]=='on'){
echo'<a href="index.php?act500_off">&#187; Выключить акцию 500R</a><br/>';
}else{
echo'<a href="index.php?act500_on">&#187; Включить акцию 500R</a><br/>';
}

if ($iiii[reg]=='on'){
echo'<a href="index.php?reg_off">&#187; Закрыть регу</a><br/>';
}else{
echo'<a href="index.php?reg_on">&#187; Открыть регу</a><br/>';
}

if ($iiii[chat]=='on'){
echo'<a href="index.php?chat_off">&#187; Закрыть чат</a><br/>';
}else{
echo'<a href="index.php?chat_on">&#187; Открыть чат</a><br/>';
}
if ($iiii[igra]=='on'){
echo'<a href="index.php?serv_off">&#187; Закрыть сервер</a><br/>';
}else{
echo'<a href="index.php?serv_on">&#187; Открыть сервер</a><br/>';
}
if ($iiii[reit]=='on'){
echo'<a href="index.php?reit_off">&#187; Выключить множитель х2</a><br/>';
}else{
echo'<a href="index.php?reit_on">&#187; Включить множитель х2</a><br/>';
}

if ($iiii[tex]=='on'){ 
echo'<a href="index.php?tex_off">&#187; <font color="lime">Закончить тех работы</font></a><br/>'; 
}else{ 
echo'<a href="index.php?tex_on">&#187; <font color="red">Начать тех работы</font></a><br/>'; 
}

echo"<br/><div class=silka>		<a href=\"?\">Назад</a>			</div>";



break;
}
}else{
mysql_query("INSERT INTO `l2warmobi`.`block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'Хорошо сосеш,заходи еще', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>