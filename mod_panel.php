<?
define('PROTECTOR', 1);

$headmod = 'mod_panel';//фикс. места

$textl='Модер-панель';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');



if($udata[dostup]<2){
echo'Доступ закрыт!';
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'KraToS', '4985139097', 'Хорошо сосеш,заходи еще', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в модер панель $udata[usr]' ");
include($path.'inc/down.php');
exit;
}

switch($_GET[mod]){

default:
echo"<hr/><a href=\"mod_panel.php?mod=rules\"><font color=red>Правила для МД</font></a><br/>";

echo"<hr/><a href=\"mod_panel.php?mod=1\">Наложить бан</a><br/>";
echo"<hr/><a href=\"mod_panel.php?mod=moder_event\">Сообщить о эвенте</a><br/>";
echo"<hr/><a href=\"/gm/logi.php\">Логи</a><br/>";
echo"<hr/><a href=\"mod_panel.php?mod=2\">Список забаненых</a><br/>";
break;



///////////////////////////////////////////////////////////
case 'moder_event':
echo 'Эвенты от модеров!<br><br>';
if(empty($_POST[name])){
echo '<form action="mod_panel.php?mod=moder_event" method="post">';
echo"Название:<br/>
<input class='input' type=\"text\" size=\"20\" name=\"name\"/><br/>";
echo'Текст:<br/>
<textarea name="text" cols="30" rows="10"></textarea><br/>';
echo '<input class="button" type="submit" value="Добавить" /></form>';
}else{
mysql_query("INSERT INTO `moder_event` SET
        `title` = '$_POST[name]',
        `text` = '$_POST[text]',
        `nick` = '$log',`time`='".date("d.m.y")."'");
echo'Заголовок: <b>'.$_POST[name].'!</b><br/>';
echo'Текст: <b>'.$_POST[text].'!</b><br/>';
echo"<a href=\"adm_panel.php?\">Назад</a>";
}
break;



case 'rules':
echo "<hr/><font color=#0094FF>
1) Для Модеров действуют те же правила что и для игроков.<hr/>
2) МД должны быть примером для остальных игроков, поэтому хорошо обдумывайте ваши действия.<hr/>
3) Если МД не знает как поступить в данной ситуации, нужно обратится к Админу для решения проблемы, что бы потом избежать ненужных конфликтов. <hr/>
4) За ненормативную лексику давать бан от 2 до 5 часов максимум.<hr/>
5) За оскорбление администрации МД имеет право дать бан на 24 часа (если Модератор считает что оскорбление слишком грубое, он может дать доказательства Админу, который решит что далее делать с игроком).<hr/>
6) МД имеет право дать блок за рекламу посторонних ресурсов на нашем сервере (если это было специально). Если игрок случайно оговорился о другом сайте, коментарий быстро удалить а игрока предупредить в приват о нарушении.<hr/>
7) Если МД считает, что игрок багоюз, он имеет право дать ему блок максимум на 12 часов, указав что до выяснения. <hr/>
8) Запрещено наказывать по просьбе других игроков или за нарушения в личке, для этого есть список игнора. <hr/>
9) Запрещено материться, оскорблять и поддаваться на провокации игроков. <hr/>
10) Запрещено банить без причины. (нужно указывайте понятную причину бана).<hr/>
11) Если игрок нарушил правила в первый раз и не слишком грубое нарушение то ему выноситься устное предупреждение.<hr/>
12) Запрещено разглашать кому либо информацию полученную в модер части сайта, будь то модер чат или любая другая страница.<hr/>
13) Запрещены наказания по личной неприязни и прочим проявлениям, модератор должен быть безпристрастен.<hr/>
~Запрещается жалет игрока Будь это мать,отец,брат,сестра,друг<hr/>
<b>При несоблюдении каких либо пунктов из правил лешает МД своей должности БЕЗ ПРАВА НА ВОСТАНОВЛЕНИЕ.</b><hr/></font>
";
break;
///////////////////////////////////////////////////////////

case '1':
if(empty($_POST[nick])){
echo '<form action="mod_panel.php?mod=1" method="post">';
echo"Логин:<br/>
<input class='input' type=\"text\" size=\"10\" value=\"$_GET[usr]\" name=\"nick\"/><br/>";

echo "Наложить:<br/>
<select name=\"tip\">
<option value=\"ban\">Бан</option>
<option value=\"block\">Заблокировать</option>
</select><br/>";

echo"Причина бана:<br/>
<input class='input' type=\"text\" size=\"10\" name=\"text\"/><br/>";

echo"Время бана:<br/>
<input class='input' type=\"text\" size=\"10\" name=\"time\"/><br/>";

echo "Тип времени:<br/>
<select name=\"times\">
<option value=\"sec\">Секунд</option>
<option value=\"min\">Минут</option>
<option value=\"cha\">Часов</option>
</select><br/>";

echo '<input class="button" type="submit" value="Забанить" /></form>';
}else{
$req = mysql_query("SELECT * FROM `users` where `usr`='".mysql_real_escape_string($_POST[nick])."'");
$nick = mysql_fetch_array($req);
$avto=mysql_num_rows($req);
if($avto==0){echo"Нет такого игрока!";include($path.'inc/down.php');exit;}

$tip = html($_POST[tip]);
$req = mysql_query("SELECT * FROM `$tip` where `usr`='".mysql_real_escape_string($_POST[nick])."'");
$avto=mysql_num_rows($req);
if($avto==1){echo"Игрок уже в бане(блоке)!";include($path.'inc/down.php');exit;}
if($udata[dostup] < $nick[dostup]){echo'вы младше по званию!';include('inc/down.php');exit;}

if($_POST[times]==sec){$_POST[time]=$_POST[time];}
if($_POST[times]==min){$_POST[time]=$_POST[time]*60;}
if($_POST[times]==cha){$_POST[time]=$_POST[time]*3600;}

$time_ban=time()+$_POST[time];

mysql_query("INSERT INTO
        `$_POST[tip]` SET
        `usr` = '$_POST[nick]',
        `log` = '$log',
        `text` = '$_POST[text]',
        `ban_time` = '$time_ban'");

echo'Игрок '.$_POST[nick].' забанен(заблочен)!<br/>';
}
echo"<a href=\"mod_panel.php?\">Назад</a>";
break;

case '2':
$time=time();
$req = mysql_query("SELECT * FROM `ban` WHERE `ban_time`>'$time'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<b>$mag[usr]</b> [<a href=\"mod_panel.php?mod=3&amp;id=$mag[id]\">снять бан</a>]<br/>";
}
}else{
echo"<b>Нет забаненых!</b><br/>";
}
echo"<a href=\"mod_panel.php?\">Назад</a>";
break;
case '3':
if(empty($_GET[id])){
echo"Ошибка невыбран игрок!";
include($path.'inc/down.php');
exit;
}

$req = mysql_query("SELECT * FROM `ban` where `id`='".mysql_real_escape_string($_GET[id])."'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}

mysql_query("DELETE FROM `ban` WHERE `id`='".mysql_real_escape_string($_GET[id])."'");
echo'Бан снят!<br/>';
echo"<a href=\"mod_panel.php?\">Назад</a>";
break;
}
include"inc/down.php";
?>