<?php

$path = '../';  
include($path.'inc/db.php');   
include_once __DIR__ . '/sett.php';
include_once __DIR__ . '/WapkassaClass.php';

try {
    // Инициализация класса с id сайта и секретным ключом
    $wapkassa = new WapkassaClass(WK_ID, WK_SECRET);

    // Проверка обработчика (PING)
    if ($wapkassa->ping($_POST)) {
        // возврат успешной проверки
        echo $wapkassa->successPing();
    } else {
        // Парсинг входящих параметров
        $params = $wapkassa->parseRequest($_POST);

        $params['id']; // id платежа в системе wapkassa
        $params['site_id']; // id площадки
        $params['time']; // время оплаты в unixtime
        $params['comm']; // комментарий платежа
        $params['amount']; // сумма платежа
        $params['add']; // массив с допольнительными параметрами

        // собственный код зачисления платежа на сайте
if ($params['add']['type'] == 'almaz' && !empty($wk_cena_col[$params['add']['count']]) && $wk_cena_col[$params['add']['count']] <= $params['amount']) {
mysql_query("UPDATE `users` SET `almaz` = `almaz` + " . $params['add']['count'] . " WHERE `id` = '".$params['add']['user_id']."'");
//-----logi------   
$time = date("H:i");
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."$log&amp;go=go\">".$params['add']['user']."</a> купил ".$params['add']['count']." <font color=yellow>Coin of Luck</font>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---


}elseif ($params['add']['type'] == 'key' && !empty($wk_cena_key[$params['add']['count']]) && $wk_cena_key[$params['add']['count']] <= $params['amount']) {  
mysql_query("UPDATE `users` SET `key` = `key` + ".$params['add']['count']." WHERE `usr` = '".$params['add']['user']."'");
//-----logi------    
$time = date("H:i"); 
$date = date("d.m.y"); 
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил ".$params['add']['count']." <font color=violette>Премиум ключей</font>"; 
$timelog = date("H:i");     
$datelog = date("d.m.y");     
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---


}elseif ($params['add']['type'] == 'votecoin' && !empty($wk_cena_vote[$params['add']['count']]) && $wk_cena_vote[$params['add']['count']] <= $params['amount']) { 
mysql_query("UPDATE `users` SET `votecoin` = `votecoin` + ".$params['add']['count']." WHERE `id` = '".$params['add']['user_id']."'");
//-----logi------   
$time = date("H:i");
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил ".$params['add']['count']." <font color=darkorang>VoteCoin</font>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---


}elseif ($params['add']['type'] == 'obor' && !empty($wk_cena_obor[$params['add']['count']]) && $wk_cena_obor[$params['add']['count']] <= $params['amount']) {  
mysql_query("INSERT INTO  
`pit` SET  
`usr` = '".$params['add']['user']."',
`name` = 'Дикий оборотень',  
`lord` = '".$params['add']['user']."',
`status` = 'off',  
`rasa` = 'obor',  
`pol` = 'm',  
`lasteda` = '$time',  
`sec` = '86400',   
`lvl` = '0',  
`skill` = '2',  
`hp` = '10000000',  
`hpall` = '10000000',  
`exp` = '0',  
`sila` = '5000000',  
`prot` = '5000000'");
//-----logi------
$time = date("H:i");   
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил <b><font color=red>Дикий оборотень</font><font color=yellow>[LeG]</font></b>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---

$time = date("H:i d.m.y");
$text = "<font color=lime>покупка пошла успешно!</font><br/> Зачислено: <b><font color=red>Дикий оборотень</font><font color=yellow>[LeG]</font></b>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$params['add']['user']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


}elseif ($params['add']['type'] == 'pig' && !empty($wk_cena_pig[$params['add']['count']]) && $wk_cena_pig[$params['add']['count']] <= $params['amount']) {  
mysql_query("INSERT INTO  
`pit` SET  
`usr` = '".$params['add']['user']."', 
`name` = 'Мировой вепрь',  
`lord` = '".$params['add']['user']."', 
`status` = 'off',  
`rasa` = 'pig',  
`pol` = 'm',  
`lasteda` = '$time',  
`sec` = '86400',   
`lvl` = '0',  
`skill` = '2',  
`hp` = '25000000',  
`hpall` = '25000000',  
`exp` = '0',  
`sila` = '15000000',  
`prot` = '15000000'");
//-----logi------
$time = date("H:i");   
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил <b><font color=red>Мировой вепрь</font><font color=yellow>[LeG]</font></b>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---

$time = date("H:i d.m.y"); 
$text = "<font color=lime>покупка пошла успешно!</font><br/> Зачислено: <b><font color=red>Мировой вепрь</font><font color=yellow>[LeG]</font></b>"; 
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$params['add']['user']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


}elseif ($params['add']['type'] == 'vip1nd' && !empty($wk_cena_vip1nd[$params['add']['count']]) && $wk_cena_vip1nd[$params['add']['count']] <= $params['amount']) {
$times=time()+604800;
mysql_query("INSERT INTO  
`vip` SET  
`usr` = '".$params['add']['user']."',  
`tip` = '100',
`time` = '$times'");
//-----logi------
$time = date("H:i");   
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил <b><font color=darkorange>VIP x100</font> <font color=white> на 1 неделю</font></b>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---

$time = date("H:i d.m.y"); 
$text = "<font color=lime>покупка пошла успешно!</font><br/> Зачислено: <b><font color=darkorange>VIP x100 на (1 неделю)</font></b>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$params['add']['user']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


}elseif ($params['add']['type'] == 'vip2nd' && !empty($wk_cena_vip2nd[$params['add']['count']]) && $wk_cena_vip2nd[$params['add']['count']] <= $params['amount']) {
$times=time()+1209600;
mysql_query("INSERT INTO  
`vip` SET  
`usr` = '".$params['add']['user']."',  
`tip` = '100',
`time` = '$times'");
//-----logi------
$time = date("H:i");   
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил <b><font color=darkorange>VIP x100</font> <font color=white> на 2 недели</font></b>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---

$time = date("H:i d.m.y"); 
$text = "<font color=lime>покупка пошла успешно!</font><br/> Зачислено: <b><font color=darkorange>VIP x100 на (2 недели)</font></b>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$params['add']['user']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


}elseif ($params['add']['type'] == 'vip3nd' && !empty($wk_cena_vip3nd[$params['add']['count']]) && $wk_cena_vip3nd[$params['add']['count']] <= $params['amount']) {
$times=time()+1814400;
mysql_query("INSERT INTO  
`vip` SET  
`usr` = '".$params['add']['user']."',  
`tip` = '100',
`time` = '$times'");
//-----logi------
$time = date("H:i");   
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил <b><font color=darkorange>VIP x100</font> <font color=white> на 3 недели</font></b>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---

$time = date("H:i d.m.y"); 
$text = "<font color=lime>покупка пошла успешно!</font><br/> Зачислено: <b><font color=darkorange>VIP x100 на (3 недели)</font></b>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$params['add']['user']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");


}elseif ($params['add']['type'] == 'vip1m' && !empty($wk_cena_vip1m[$params['add']['count']]) && $wk_cena_vip1m[$params['add']['count']] <= $params['amount']) {
$times=time()+2592000;
mysql_query("INSERT INTO  
`vip` SET  
`usr` = '".$params['add']['user']."',  
`tip` = '100',
`time` = '$times'");
//-----logi------
$time = date("H:i");   
$date = date("d.m.y");
$text = "[$date / $time]  Игрок <a href=\"/search.php?nick=".$params['add']['user']."&amp;go=go\">".$params['add']['user']."</a> купил <b><font color=darkorange>VIP x100</font> <font color=white> на 1 месяц</font></b>";
$timelog = date("H:i");    
$datelog = date("d.m.y");    
mysql_query("INSERT INTO `logi_paywk` (`id` ,`tip` ,`text` )VALUES (NULL , 'item', '$text')");
//----end---

$time = date("H:i d.m.y"); 
$text = "<font color=lime>покупка пошла успешно!</font><br/> Зачислено: <b><font color=darkorange>VIP x100 на (1 месяц)</font></b>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$params['add']['user']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
        // возврат успешной обработки
        echo $wapkassa->successPayment();
    }
} catch (Exception $e) {
    // вывод ошибки
    echo 'Ошибка: ' . $e->getMessage() . PHP_EOL;
}