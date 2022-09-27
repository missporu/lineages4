<?php
define('PROTECTOR', 1);

$textl='Справка по смайлам';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


echo'<div class="slot_menu">';
	echo '<div class="slot_menu">[b]текст[/b] - <b>жирный текст</b></div>';
	echo '<div class="slot_menu">[u]текст[/u] - <u>подчеркнутый текст</u></div>';
	echo '<div class="slot_menu">[i]текст[/i] - <i>наклонный текст</i></div>';
	echo '<div class="slot_menu">[s]текст[/s] - <s>зачеркнутый текст</s></div>';
echo "<div class='slot_menu'>[user]ник[/user] - <a href='/search.php?nick=&$log&go=go'>$log</a></div>";
	echo '<div class="slot_menu">[item]Айди вещи[/item] - <a href="/inventar.php?mod=in&id=34781">Вещь №34781</a></div>';	
echo'</div>';




include($path.'inc/down.php');
?>
