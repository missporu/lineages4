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
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////
if ($udata[dostup]>3){
$id=abs(intval($_GET['id']));
switch($_GET[mod]){

default:
echo'<a href="?mod=shop">Редактор простых вещей</a><br/>';
echo'<a href="?mod=shop_gold">Редактор GOLD вещей</a><br/>';
echo'<a href="?mod=shop_vip">Редактор VIP вещей</a><br/>';
echo'<a href="?mod=shop_lux">Редактор LUX вещей</a><br/>';
echo'<a href="?mod=shop_ny">Редактор Новогодних вещей</a><br/>';

echo'<a href="?mod=shop_chat">Редактор Чат вещей</a><br/>';
/*echo'<a href="?mod=shop_olimp">Редактор Olimp вещей</a><br/>';
echo'<a href="?mod=shop_shadow">Редактор Теневых вещей</a><br/>';*/
break;
case 'shop_shadow':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop_shadow` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shopshadow_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shopshadow_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop_shadow`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop_shadow&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case 'shop':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shop_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shop_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case 'shop_gold':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop_gold` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shopgold_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shopgold_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop_gold`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop_gold&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;


case 'shop_vip':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop_vip` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shopvip_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shopvip_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop_vip`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop_vip&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case 'shop_lux':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop_lux` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shoplux_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shoplux_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop_lux`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop_lux&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case 'shop_ny':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop_ny` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shopny_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shopny_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop_ny`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop_ny&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;






case'shop_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop` where `id`='$id'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `shop` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopgold_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_gold` where `id`='$id'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `shop_gold` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopvip_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_vip` where `id`='$id'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `shop_vip` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shoplux_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_lux` where `id`='$id'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `shop_lux` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopny_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_ny` where `id`='$id'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `shop_ny` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case 'shop_chat':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `shop_chat` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"redshmot.php?mod=shopchat_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"redshmot.php?mod=shopchat_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `shop_chat`"),0);
checkin::display_pagin($my_page, $all_posts, 'redshmot.php?mod=shop_chat&p='); 
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopchat_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_chat` where `id`='$id'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `shop_chat` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopchat_red':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_chat` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такой вещи не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="redshmot.php?mod=shop_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";
echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";
echo"Город<br/>
<input class='input' type=\"text\" value=\"$item[city]\" size=\"10\" name=\"city\"/><br/>";
echo "Тип:<br/>
<select name=\"tip\">
<option value=\"grocery\">Украшение</option>
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"pants\">Штаны</option>
<option value=\"plash\">Пояс</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"shit\">Щит</option>
<option value=\"amulet\">Амулет</option>
<option value=\"kolco\">Левое кольцо</option>
<option value=\"rkolco\">Правое кольцо</option>
</select><br/>";
echo"P.Att<br/>
<input class='input' type=\"text\" value=\"$item[patt]\" size=\"10\" name=\"patt\"/><br/>";
echo"M.Att<br/>
<input class='input' type=\"text\" value=\"$item[matt]\" size=\"10\" name=\"matt\"/><br/>";
echo"P.Def<br/>
<input class='input' type=\"text\" value=\"$item[pdef]\" size=\"10\" name=\"pdef\"/><br/>";
echo"M.Def<br/>
<input class='input' type=\"text\" value=\"$item[mdef]\" size=\"10\" name=\"mdef\"/><br/>";
echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[soul]\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[spirit]\" size=\"10\" name=\"spirit\"/><br/>";
echo"Требуемый уровень<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";
echo "Тип оруж.:<br/>
<select name=\"tip2\">
<option value=\"ps\">Пусто</option>
<option value=\"ydar\">Ударное</option>
<option value=\"luk\">Луки</option>
<option value=\"kin\">Кинжалы</option>
<option value=\"sdv\">Сдвоенное</option>
<option value=\"kas\">Кастеты</option>
<option value=\"kniga\">Книги</option>
<option value=\"koppik\">Копья/Пики</option>
<option value=\"me4\">Мечи</option>
<option value=\"rap\">Рапиры</option>
<option value=\"arbalet\">Арбалеты</option>
</select><br/>";
echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{
mysql_query("UPDATE `shop_chat` SET
        `name` = '$_POST[name]',
        `cena` = '$_POST[cena]',
        `city` = '$_POST[city]',
        `tip` = '$_POST[tip]',
        `tip2` = '$_POST[tip2]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `soul` = '$_POST[soul]',
        `spirit` = '$_POST[spirit]',
        `nlvl` = '$_POST[nlvl]' WHERE id='$id' LIMIT 1");
echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"redshmot.php?\">Назад</a>";
break;


case'shop_red':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такой вещи не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="redshmot.php?mod=shop_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";
echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";
echo"Город<br/>
<input class='input' type=\"text\" value=\"$item[city]\" size=\"10\" name=\"city\"/><br/>";
echo "Тип:<br/>
<select name=\"tip\">
<option value=\"grocery\">Украшение</option>
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"pants\">Штаны</option>
<option value=\"plash\">Пояс</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"shit\">Щит</option>
<option value=\"amulet\">Амулет</option>
<option value=\"kolco\">Левое кольцо</option>
<option value=\"rkolco\">Правое кольцо</option>
</select><br/>";
echo"P.Att<br/>
<input class='input' type=\"text\" value=\"$item[patt]\" size=\"10\" name=\"patt\"/><br/>";
echo"M.Att<br/>
<input class='input' type=\"text\" value=\"$item[matt]\" size=\"10\" name=\"matt\"/><br/>";
echo"P.Def<br/>
<input class='input' type=\"text\" value=\"$item[pdef]\" size=\"10\" name=\"pdef\"/><br/>";
echo"M.Def<br/>
<input class='input' type=\"text\" value=\"$item[mdef]\" size=\"10\" name=\"mdef\"/><br/>";
echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[soul]\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[spirit]\" size=\"10\" name=\"spirit\"/><br/>";
echo"Требуемый уровень<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";
echo "Тип оруж.:<br/>
<select name=\"tip2\">
<option value=\"ps\">Пусто</option>
<option value=\"ydar\">Ударное</option>
<option value=\"luk\">Луки</option>
<option value=\"kin\">Кинжалы</option>
<option value=\"sdv\">Сдвоенное</option>
<option value=\"kas\">Кастеты</option>
<option value=\"kniga\">Книги</option>
<option value=\"koppik\">Копья/Пики</option>
<option value=\"me4\">Мечи</option>
<option value=\"rap\">Рапиры</option>
<option value=\"arbalet\">Арбалеты</option>
</select><br/>";
echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{
mysql_query("UPDATE `shop` SET
        `name` = '$_POST[name]',
        `cena` = '$_POST[cena]',
        `city` = '$_POST[city]',
        `tip` = '$_POST[tip]',
        `tip2` = '$_POST[tip2]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `soul` = '$_POST[soul]',
        `spirit` = '$_POST[spirit]',
        `nlvl` = '$_POST[nlvl]' WHERE id='$id' LIMIT 1");
echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopgold_red':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_gold` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такой вещи не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="redshmot.php?mod=shopgold_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";
echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";
echo"Город<br/>
<input class='input' type=\"text\" value=\"$item[city]\" size=\"10\" name=\"city\"/><br/>";
echo "Тип:<br/>
<select name=\"tip\">
<option value=\"grocery\">Украшение</option>
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"pants\">Штаны</option>
<option value=\"plash\">Пояс</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"shit\">Щит</option>
<option value=\"amulet\">Амулет</option>
<option value=\"kolco\">Левое кольцо</option>
<option value=\"rkolco\">Правое кольцо</option>
</select><br/>";
echo"P.Att<br/>
<input class='input' type=\"text\" value=\"$item[patt]\" size=\"10\" name=\"patt\"/><br/>";
echo"M.Att<br/>
<input class='input' type=\"text\" value=\"$item[matt]\" size=\"10\" name=\"matt\"/><br/>";
echo"P.Def<br/>
<input class='input' type=\"text\" value=\"$item[pdef]\" size=\"10\" name=\"pdef\"/><br/>";
echo"M.Def<br/>
<input class='input' type=\"text\" value=\"$item[mdef]\" size=\"10\" name=\"mdef\"/><br/>";
echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[soul]\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[spirit]\" size=\"10\" name=\"spirit\"/><br/>";
echo"Требуемый уровень<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";
echo "Тип оруж.:<br/>
<select name=\"tip2\">
<option value=\"ps\">Пусто</option>
<option value=\"ydar\">Ударное</option>
<option value=\"luk\">Луки</option>
<option value=\"kin\">Кинжалы</option>
<option value=\"sdv\">Сдвоенное</option>
<option value=\"kas\">Кастеты</option>
<option value=\"kniga\">Книги</option>
<option value=\"koppik\">Копья/Пики</option>
<option value=\"me4\">Мечи</option>
<option value=\"rap\">Рапиры</option>
<option value=\"arbalet\">Арбалеты</option>
</select><br/>";
echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{
mysql_query("UPDATE `shop_gold` SET
        `name` = '$_POST[name]',
        `cena` = '$_POST[cena]',
        `city` = '$_POST[city]',
        `tip` = '$_POST[tip]',
        `tip2` = '$_POST[tip2]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `soul` = '$_POST[soul]',
        `spirit` = '$_POST[spirit]',
        `nlvl` = '$_POST[nlvl]' WHERE id='$id' LIMIT 1");
echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"redshmot.php?\">Назад</a>";
break;


case'shopvip_red':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_vip` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такой вещи не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="redshmot.php?mod=shopvip_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";
echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";
echo"Город<br/>
<input class='input' type=\"text\" value=\"$item[city]\" size=\"10\" name=\"city\"/><br/>";
echo "Тип:<br/>
<select name=\"tip\">
<option value=\"grocery\">Украшение</option>
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"pants\">Штаны</option>
<option value=\"plash\">Пояс</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"shit\">Щит</option>
<option value=\"amulet\">Амулет</option>
<option value=\"kolco\">Левое кольцо</option>
<option value=\"rkolco\">Правое кольцо</option>
</select><br/>";
echo"P.Att<br/>
<input class='input' type=\"text\" value=\"$item[patt]\" size=\"10\" name=\"patt\"/><br/>";
echo"M.Att<br/>
<input class='input' type=\"text\" value=\"$item[matt]\" size=\"10\" name=\"matt\"/><br/>";
echo"P.Def<br/>
<input class='input' type=\"text\" value=\"$item[pdef]\" size=\"10\" name=\"pdef\"/><br/>";
echo"M.Def<br/>
<input class='input' type=\"text\" value=\"$item[mdef]\" size=\"10\" name=\"mdef\"/><br/>";
echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[soul]\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[spirit]\" size=\"10\" name=\"spirit\"/><br/>";
echo"Требуемый уровень<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";
echo "Тип оруж.:<br/>
<select name=\"tip2\">
<option value=\"ps\">Пусто</option>
<option value=\"ydar\">Ударное</option>
<option value=\"luk\">Луки</option>
<option value=\"kin\">Кинжалы</option>
<option value=\"sdv\">Сдвоенное</option>
<option value=\"kas\">Кастеты</option>
<option value=\"kniga\">Книги</option>
<option value=\"koppik\">Копья/Пики</option>
<option value=\"me4\">Мечи</option>
<option value=\"rap\">Рапиры</option>
<option value=\"arbalet\">Арбалеты</option>
</select><br/>";
echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{
mysql_query("UPDATE `shop_vip` SET
        `name` = '$_POST[name]',
        `cena` = '$_POST[cena]',
        `city` = '$_POST[city]',
        `tip` = '$_POST[tip]',
        `tip2` = '$_POST[tip2]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `soul` = '$_POST[soul]',
        `spirit` = '$_POST[spirit]',
        `nlvl` = '$_POST[nlvl]' WHERE id='$id' LIMIT 1");
echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shoplux_red':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_lux` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такой вещи не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="redshmot.php?mod=shoplux_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";
echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";
echo"Город<br/>
<input class='input' type=\"text\" value=\"$item[city]\" size=\"10\" name=\"city\"/><br/>";
echo "Тип:<br/>
<select name=\"tip\">
<option value=\"grocery\">Украшение</option>
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"pants\">Штаны</option>
<option value=\"plash\">Пояс</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"shit\">Щит</option>
<option value=\"amulet\">Амулет</option>
<option value=\"kolco\">Левое кольцо</option>
<option value=\"rkolco\">Правое кольцо</option>
</select><br/>";
echo"P.Att<br/>
<input class='input' type=\"text\" value=\"$item[patt]\" size=\"10\" name=\"patt\"/><br/>";
echo"M.Att<br/>
<input class='input' type=\"text\" value=\"$item[matt]\" size=\"10\" name=\"matt\"/><br/>";
echo"P.Def<br/>
<input class='input' type=\"text\" value=\"$item[pdef]\" size=\"10\" name=\"pdef\"/><br/>";
echo"M.Def<br/>
<input class='input' type=\"text\" value=\"$item[mdef]\" size=\"10\" name=\"mdef\"/><br/>";
echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[soul]\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[spirit]\" size=\"10\" name=\"spirit\"/><br/>";
echo"Требуемый уровень<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";
echo "Тип оруж.:<br/>
<select name=\"tip2\">
<option value=\"ps\">Пусто</option>
<option value=\"ydar\">Ударное</option>
<option value=\"luk\">Луки</option>
<option value=\"kin\">Кинжалы</option>
<option value=\"sdv\">Сдвоенное</option>
<option value=\"kas\">Кастеты</option>
<option value=\"kniga\">Книги</option>
<option value=\"koppik\">Копья/Пики</option>
<option value=\"me4\">Мечи</option>
<option value=\"rap\">Рапиры</option>
<option value=\"arbalet\">Арбалеты</option>
</select><br/>";
echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{
mysql_query("UPDATE `shop_lux` SET
        `name` = '$_POST[name]',
        `cena` = '$_POST[cena]',
        `city` = '$_POST[city]',
        `tip` = '$_POST[tip]',
        `tip2` = '$_POST[tip2]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `soul` = '$_POST[soul]',
        `spirit` = '$_POST[spirit]',
        `nlvl` = '$_POST[nlvl]' WHERE id='$id' LIMIT 1");
echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"redshmot.php?\">Назад</a>";
break;

case'shopny_red':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `shop_ny` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такой вещи не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="redshmot.php?mod=shopny_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";
echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";
echo"Город<br/>
<input class='input' type=\"text\" value=\"$item[city]\" size=\"10\" name=\"city\"/><br/>";
echo "Тип:<br/>
<select name=\"tip\">
<option value=\"grocery\">Украшение</option>
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"pants\">Штаны</option>
<option value=\"plash\">Пояс</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"shit\">Щит</option>
<option value=\"amulet\">Амулет</option>
<option value=\"kolco\">Левое кольцо</option>
<option value=\"rkolco\">Правое кольцо</option>
</select><br/>";
echo"P.Att<br/>
<input class='input' type=\"text\" value=\"$item[patt]\" size=\"10\" name=\"patt\"/><br/>";
echo"M.Att<br/>
<input class='input' type=\"text\" value=\"$item[matt]\" size=\"10\" name=\"matt\"/><br/>";
echo"P.Def<br/>
<input class='input' type=\"text\" value=\"$item[pdef]\" size=\"10\" name=\"pdef\"/><br/>";
echo"M.Def<br/>
<input class='input' type=\"text\" value=\"$item[mdef]\" size=\"10\" name=\"mdef\"/><br/>";
echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[soul]\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" value=\"$item[spirit]\" size=\"10\" name=\"spirit\"/><br/>";
echo"Требуемый уровень<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";
echo "Тип оруж.:<br/>
<select name=\"tip2\">
<option value=\"ps\">Пусто</option>
<option value=\"ydar\">Ударное</option>
<option value=\"luk\">Луки</option>
<option value=\"kin\">Кинжалы</option>
<option value=\"sdv\">Сдвоенное</option>
<option value=\"kas\">Кастеты</option>
<option value=\"kniga\">Книги</option>
<option value=\"koppik\">Копья/Пики</option>
<option value=\"me4\">Мечи</option>
<option value=\"rap\">Рапиры</option>
<option value=\"arbalet\">Арбалеты</option>
</select><br/>";
echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{
mysql_query("UPDATE `shop_ny` SET
        `name` = '$_POST[name]',
        `cena` = '$_POST[cena]',
        `city` = '$_POST[city]',
        `tip` = '$_POST[tip]',
        `tip2` = '$_POST[tip2]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `soul` = '$_POST[soul]',
        `spirit` = '$_POST[spirit]',
        `nlvl` = '$_POST[nlvl]' WHERE id='$id' LIMIT 1");
echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"redshmot.php?\">Назад</a>";
break;





}

}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'Попытка попасть в логи' ;)', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>
