<?php

$headmod = 'changenick';//фикс. места
$textl='Смена ника';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
$time=time();
if(!isset($_POST['ok'])){
echo'<div class="error">Цена смены ника 1000 CoL</div>';
echo'<form action="" method="POST">Новый ник:<br/><small>min 4, max 10, A-z-0-9</small> <br />
<input type="text" class="form" class="input" name="usr" maxlength="30" value="" size="20" maxlength="50" /><br/><br/>
<input name="ok" type="submit" class="button" value="Восстановить" /><br/>';
}else{
////остаток колов после смены ника.
$cost = $udata['almaz']-1000;
////проверка ширины кармана =D
if($cost<0){
echo '<div class="error">У вас недостаточно CoL</div>';
include($path.'inc/down.php');
exit;}
////фильтр на разную каку введеного ника
$nick=checkin::check($_POST['usr']);
////пустота ника
if(!$nick){
echo '<div class="error">Выберите Ник!</div>';
include($path.'inc/down.php');
exit;}elseif(mb_strlen($nick) < 4 || mb_strlen($nick) > 10) {
echo'Ошибка! Ник должен быть не менее 4-х символов но не более 10';
include($path.'inc/down.php'); 
exit; 
}

////проверка на занятость
$tkr = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `usr` = '".mysql_real_escape_string($nick)."'"));
if($tkr!=0){
 echo '<div class="error">Такое имя уже существует! Назовите своего персонажа по-другому!</div>';   
include($path.'inc/down.php');
exit;}



if(!preg_match('~[^a-z0-9]+~iu', $nick)) {
////и понеслась смена ника.
mysql_query("UPDATE `users` SET `clan` = '".mysql_real_escape_string($nick)."' WHERE `clan` = '".$log."'");
mysql_query("UPDATE `soulshots` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `users` SET `alli` = '".mysql_real_escape_string($nick)."' WHERE `alli` = '".$log."'");
mysql_query("UPDATE `adm_chat` SET `nick` = '".mysql_real_escape_string($nick)."' WHERE `nick` = '".$log."'");
mysql_query("UPDATE `anti_pk` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `baf` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `baf_log` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `ban` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `ban` SET `log` = '".mysql_real_escape_string($nick)."' WHERE `log` = '".$log."'");
mysql_query("UPDATE `bank` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `bazar` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `bazar_col` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `bazar_vip` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `blacklist` SET `mkon0` = '".mysql_real_escape_string($nick)."' WHERE `mkon0` = '".$log."'");
mysql_query("UPDATE `blacklist` SET `mkon2` = '".mysql_real_escape_string($nick)."' WHERE `mkon2` = '".$log."'");
mysql_query("UPDATE `block` SET `log` = '".mysql_real_escape_string($nick)."' WHERE `log` = '".$log."'");
mysql_query("UPDATE `block_account` SET `log` = '".mysql_real_escape_string($nick)."' WHERE `log` = '".$log."'");
mysql_query("UPDATE `chat_otv` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `clan` SET `lider` = '".mysql_real_escape_string($nick)."' WHERE `lider` = '".$log."'");
mysql_query("UPDATE `clan` SET `zam` = '".mysql_real_escape_string($nick)."' WHERE `zam` = '".$log."'");
mysql_query("UPDATE `clanchat` SET `clan` = '".mysql_real_escape_string($nick)."' WHERE `clan` = '".$log."'");
mysql_query("UPDATE `clanchat` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `clanlog` SET `clan` = '".mysql_real_escape_string($nick)."' WHERE `clan` = '".$log."'");
mysql_query("UPDATE `clanwar` SET `clan` = '".mysql_real_escape_string($nick)."' WHERE `clan` = '".$log."'");
mysql_query("UPDATE `clan_alliance` SET `glava` = '".mysql_real_escape_string($nick)."' WHERE `glava` = '".$log."'");
mysql_query("UPDATE `color_akk` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `eve_mob` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `fish` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `fish_log` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `fortuna` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `forum_msg` SET `login` = '".mysql_real_escape_string($nick)."' WHERE `login` = '".$log."'");
mysql_query("UPDATE `forum_topics` SET `authour` = '".mysql_real_escape_string($nick)."' WHERE `authour` = '".$log."'");
mysql_query("UPDATE `gallery` SET `login` = '".mysql_real_escape_string($nick)."' WHERE `login` = '".$log."'");
mysql_query("UPDATE `gallery_koments` SET `nick` = '".mysql_real_escape_string($nick)."' WHERE `nick` = '".$log."'");
mysql_query("UPDATE `golos_gallery` SET `nick` = '".mysql_real_escape_string($nick)."' WHERE `nick` = '".$log."'");
mysql_query("UPDATE `interval` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `invite` SET `clan` = '".mysql_real_escape_string($nick)."' WHERE `clan` = '".$log."'");
mysql_query("UPDATE `invite` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `item` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `logi` SET `kto` = '".mysql_real_escape_string($nick)."' WHERE `kto` = '".$log."'");
mysql_query("UPDATE `logi` SET `komu` = '".mysql_real_escape_string($nick)."' WHERE `komu` = '".$log."'");
mysql_query("UPDATE `job_fish` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `job_mob` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `job_pvp` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `karma` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `karma` SET `from` = '".mysql_real_escape_string($nick)."' WHERE `from` = '".$log."'");
mysql_query("UPDATE `kill_mob` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `komentarai` SET `nick` = '".mysql_real_escape_string($nick)."' WHERE `nick` = '".$log."'");
mysql_query("UPDATE `kontakts` SET `mkon0` = '".mysql_real_escape_string($nick)."' WHERE `mkon0` = '".$log."'");
mysql_query("UPDATE `kontakts` SET `mkon2` = '".mysql_real_escape_string($nick)."' WHERE `mkon2` = '".$log."'");
mysql_query("UPDATE `kraft` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `log` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `log_battle` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `log_dii` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `mag` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `mesto` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `msg_r` SET `user_to` = '".mysql_real_escape_string($nick)."' WHERE `user_to` = '".$log."'");
mysql_query("UPDATE `msg_r` SET `user_from` = '".mysql_real_escape_string($nick)."' WHERE `user_from` = '".$log."'");
mysql_query("UPDATE `news` SET `nick` = '".mysql_real_escape_string($nick)."' WHERE `nick` = '".$log."'");
mysql_query("UPDATE `news_kom` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `online` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `online_time` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `opros` SET `char` = '".mysql_real_escape_string($nick)."' WHERE `char` = '".$log."'");
mysql_query("UPDATE `options` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `out` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `paty` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `paty` SET `usr2` = '".mysql_real_escape_string($nick)."' WHERE `usr2` = '".$log."'");
mysql_query("UPDATE `pit` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `pit` SET `lord` = '".mysql_real_escape_string($nick)."' WHERE `lord` = '".$log."'");
mysql_query("UPDATE `pit_item` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `raids` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `raids_time` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `raids_usr` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `raids_usr` SET `glava` = '".mysql_real_escape_string($nick)."' WHERE `glava` = '".$log."'");
mysql_query("UPDATE `regenerator` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `rekc` SET `kto` = '".mysql_real_escape_string($nick)."' WHERE `kto` = '".$log."'");
mysql_query("UPDATE `rekc` SET `kogo` = '".mysql_real_escape_string($nick)."' WHERE `kogo` = '".$log."'");
mysql_query("UPDATE `res` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `sklad` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `smert` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `tchat` SET `nick` = '".mysql_real_escape_string($nick)."' WHERE `nick` = '".$log."'");
mysql_query("UPDATE `tiket_m` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `tiket_tm` SET `avtor` = '".mysql_real_escape_string($nick)."' WHERE `avtor` = '".$log."'");
mysql_query("UPDATE `tmp_zamok` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `vhod` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `vip` SET `usr` = '".mysql_real_escape_string($nick)."' WHERE `usr` = '".$log."'");
mysql_query("UPDATE `zamok` SET `clan` = '".mysql_real_escape_string($nick)."' WHERE `clan` = '".$log."'");
mysql_query("UPDATE `users` SET `brak` = '".mysql_real_escape_string($nick)."' WHERE `brak` = '".$log."'");
////записываем в историю новый ник и дату смены.
mysql_query("INSERT INTO `nick_history` (`id`, `id_user`, `old_nick`, `nick`, `time`) VALUES (NULL, '".$udata['id']."', '".$log."', '".mysql_real_escape_string($nick)."', '$time')");
////НЕ ТРОГАТЬ
mysql_query("UPDATE `users` SET `usr` = '".mysql_real_escape_string($nick)."' , `almaz` = '$cost' WHERE `usr` = '".$log."'");
////вывели поздравление. и огорчили о потери колов.
echo'<div class="slot_menu">Ваш ник успешно имзменен на '.$nick.',после смены ника у Вас осталось '.$cost.' CoL</div>';
}else{
echo '<div class="error">Ник содержит запрещенные символы!</div>';
include($path.'inc/down.php');
exit;
}
}

include($path.'inc/down.php');
?>

