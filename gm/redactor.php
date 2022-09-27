<?
define('PROTECTOR', 1);

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
	$path='../';			//
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

if ($udata['dostup']==5){ 
echo'Редакторы</br>';
echo'<li><a href="ushmot.php">Создать вещь игроку</a></li>';
echo'<li><a href="/editors.php">Редактор кланов</a></li>';
echo'<li><a href="/editors.php?a=okr">Редактор окрестностей</a></li>';
echo'<li><a href="/editors.php?a=city">Редактор городов</a></li>';
echo'<li><a href="/editors.php?a=mobs">Редактор Мобов</a></li>';
echo'<li><a href="/editors.php?a=pit">Редактор питомцев</li>';
echo'<li><a href="/editors.php?a=pititem">Редактор вещей питомцев</li>';
echo'<li><a href="/editors.php?a=add_city">Добавить город</a></li>';
echo'<li><a href="/editors.php?a=add_okr">Добавить окру</a></li>';
echo'<li><a href="/adm_panel.php?mod=5">Добавить моба</li>';
echo'<li><a href="/editors.php?a=create_mob">Добавить мобов пачками в разные окры</li>';
echo'<li><a href="/editors.php?a=pit_add">Добавить питомцев</li>';
echo'<li><a href="/editors.php?a=pititem_add">Добавить вещи питомцев</li>';

}else{
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'Попытка попасть в управление запуском', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в редактор $udata[usr]' ");
}
include($path.'inc/down.php');
?>