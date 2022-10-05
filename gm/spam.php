<?php

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

if($udata[dostup]<4){
echo'Доступ закрыт!';
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'Попытка входав админпанель', '')");
include($path.'inc/down.php');
exit;
}


if(!isset($_GET['edit'])){
if(isset($_GET['del']))
{
$id_message = ( int ) $_GET ['id'];
$q = mysql_query ( "SELECT * FROM `spam` WHERE `id` = '$id_message' LIMIT 1" );

if (! mysql_num_rows ( $q )) {
		header ( 'Refresh: 1; url=?' );
	echo '<div class="err">Антиспам-замена не найдена</div>';
	include_once '../sys/inc/tfoot.php';
	exit ();
}
else
{
mysql_query ( "DELETE FROM `spam` WHERE `id` = '$id_message' LIMIT 1" );
echo  '<div class="msg">Успешно</div>';
}
}


if(isset($_POST['eto']) || isset($_POST['na']))
{

$eto = $_POST ['eto'];
$a = $_POST ['a'];
$act = $_POST ['act'];
$ban = $_POST ['ban'];
$ban_time = $_POST ['ban_time'];
$spam_level = $_POST ['spam_level'];
if($ban=='0')$ban_time='0';
$q = mysql_query ( "SELECT * FROM `spam` WHERE `na` = '$a' AND `eto` = '$eto' LIMIT 1" );
$q = mysql_query ( "SELECT * FROM `spam` WHERE `eto` = '$eto' LIMIT 1" );

if (mysql_num_rows ( $q ) != 0 || mysql_num_rows ( $q ) != 0 ) {
		header ( 'Refresh: 1; url=?' );
	echo '<div class="err">Ошибка! Такая запись уже есть в базе!</div>';
	include($path.'inc/down.php');
	exit ();
}
if($eto == '' || $a == '' || $ban_time == ''){echo '<div class="err">Заполните все поля</div>';

header ( 'Refresh: 1; url=?');
include($path.'inc/down.php');
exit;
}
mysql_query("INSERT INTO `spam` (`eto`,`na`,`ban`,`ban_time`,`act`,`spam_level`) VALUES ('$eto','$a','$ban','$ban_time','$act','$spam_level')");
echo '<div class="msg">Успешно</div>';

}
echo "<center><form method='post' action='?$passgen'>\n";
echo "Адрес:<br /><input type='text' name='eto' maxlength='320' /><br />\n";
echo "Заменяем на:<br /><textarea name='a'></textarea><br />\n";
echo "<label><input type='checkbox' checked='checked' name='act' value='1' />Запись активна</label><br />\n";
echo "<label><input type='checkbox' name='ban' value='1' />АвтоБАН</label><br />\n";
echo "Банить на(в минутах):<br /><input type='text' name='ban_time' value='0' maxlength='320' /><br />\n";
echo "Уровень спама увеличивается на:<br /><input type='text' name='spam_level' value='0' maxlength='320' /><br />\n";
echo "<input type='submit' value='Добавить' />\n";
echo "</form><br /></center>\n";
}

else
{

$id_message = ( int ) $_GET ['id'];
$q = mysql_query ( "SELECT * FROM `spam` WHERE `id` = '$id_message' LIMIT 1" );

if ($q['id']==0) {
		header ( 'Refresh: 1; url=?' );
	echo '<div class="err">Антиспам-замена не найдена</div>';
	include($path.'inc/down.php');
	exit ();
}
if(isset($_POST['eto']) && isset($_POST['na']))
{
$na=$_POST['na'];
$eto=$_POST['eto'];
$act = $_POST ['act'];
$ban = $_POST ['ban'];
$ban_time = $_POST ['ban_time'];
$spam_level = $_POST ['spam_level'];
if($ban=='0')$ban_time='0';
mysql_query("UPDATE `spam` SET `eto`='$eto',`na`='$na',`act`='$act',`ban`='$ban',`ban_time`='$ban_time',`spam_level`='$spam_level' WHERE `id`='".$q['id']."'");
echo'Успешно';
header ( 'Refresh: 1; url=?' );
	include($path.'inc/down.php');
	exit ();
}
echo "<center><form method='post' action='?edit&amp;id=".$q['id']."&amp;$passgen'>\n";
echo "Адрес:<br /><input type='text' name='eto' maxlength='320' value='".$q['eto']."' /><br />\n";
echo "Заменяем на:<br /><textarea name='na'>".$q['na']."</textarea><br />\n";
if($q['act']=='1')$act="checked='checked'";
echo "<label><input type='checkbox' $act name='act' value='1' />Запись активна</label><br />\n";
if($q['ban']=='1')$ban="checked='checked'";
echo "<label><input type='checkbox' name='ban' $ban value='1' />АвтоБАН</label><br />\n";
echo "Банить на(в минутах):<br /><input type='text' name='ban_time' value='".$q['ban_time']."' maxlength='320' /><br />\n";
echo "Уровень спама увеличивается на:<br /><input type='text' name='spam_level' value='".$q['spam_level']."' maxlength='320' /><br />\n";
echo "<input type='submit' value='Изменить' />\n";
echo "</form></center>\n";


}


$times = date("H:i");
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }

$start = ($my_page-1)*$display;

$q=mysql_query("SELECT * FROM `spam` ORDER BY `id` DESC LIMIT $start, $display");
while ($s = mysql_fetch_assoc($q))
{
echo "<table class='post'>\n";


echo "<tr><td class='icon14'>\n";
echo "<img src='stop.png' alt='' />";
echo "  </td>\n";

echo "<td class='p_t'>\n";
echo 'Спам: <font color="red">'.$s['eto'].'</font> заменено на: <font color="green">'.$s['na'].'</font></tr><tr>';
if($s['act']=='1')$act='<font color="green">Активная запись</font><br />';else $act='<font color="red">Неактивная запись</font><br />';
if($s['ban']=='1')$ban='<font color="green">АвтоБАН активен : '.$s['ban_time'].' минут</font><br />';else $ban='<font color="red">АвтоБАН неактивен</font><br />';
echo '</td><td class="p_m" colspan="2">'.$act.''.$ban.'Уровень спама : '.$s['spam_level'].'<center>[<a href="?del&amp;id='.$s['id'].'">Удалить</a>][<a href="?edit&amp;id='.$s['id'].'">Изменить</a>]</center></td></tr><br />';

echo "</table>\n";
}

$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `spam`"),0);

checkin::display_pagin($my_page, $all_posts, 'spam.php?p=');


include($path.'inc/down.php');
?>