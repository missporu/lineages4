<?php

/**
 * @author FROSTY
 * @copyright 2014
 */

define('PROTECTOR', 1);

$headmod = 'adm_panel';//фикс. места

$textl='Админ-панель';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

if($udata['dostup']<4){
echo'Доступ закрыт!';
$mysql->query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '".$log."', 'DiNo', '4985139097', 'Попытка входав админпанель', '')");
include($path.'inc/down.php');
exit;
}
$id=(int)$_GET['id'];
//Кланы
//Города + Добавление
//Окресности + добавление
//new - Создание мобов в нужном количестве в разных локациях (рандомно распределить)
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }

$start = ($my_page-1)*$display;

$case=htmlspecialchars(trim($_GET['a']));
switch($case){

default:
echo '<div class="title">Редактирование кланов</div>';
$all_clans = mysql_query("SELECT * FROM `clan` ORDER BY `id` DESC LIMIT $start,$display");
if(mysql_num_rows($all_clans)){
while($clan = mysql_fetch_assoc($all_clans)){
        
        if(empty($clan['logo'])){
$logo = '<img src="pic/clan_logo/pusto.png" align="left" width="32" height="32" alt="/" style="margin-right:10px;border:1px solid #383838">';
}else{
$logo = '<img src="pic/clan_logo/'.$clan['logo'].'" align="left" width="32" height="32" alt="/" style="margin-right:10px;border:1px solid #383838">';
}
        
        echo '<a href="editors.php?a=edit&amp;id='.$clan['id'].'"><div class="slot_menu">'.$logo.''.$clan['name'].'<br />'.$clan['lider'].'</div></a>';
    }
    $all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `clan`"),0);
    checkin::display_pagin($my_page, $all_posts, 'editors.php?p=');
}else{
 echo '<div class="error">Ошибка! Кланов для редактирования не найдено!</div>';   
}

break;

case 'pit':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `pitomec` ORDER BY id DESC LIMIT $start,$display");
$avto= mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"editors.php?a=pit_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"editors.php?a=pit_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `pitomec`"),0);
checkin::display_pagin($my_page, $all_posts, 'editors.php?a=pit&p='); 
echo"<a href=\"editors.php?\">Назад</a>";
break;


case 'pititem':
$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;

$req = mysql_query("SELECT * FROM `pit_shop` ORDER BY id DESC LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_assoc($req))
{
echo"<b>$mag[name]</b> [<a href=\"editors.php?a=pititem_del&amp;id=$mag[id]\">удалить</a>] [<a href=\"editors.php?a=pititem_red&amp;id=$mag[id]\">изм</a>]<br/>";
}
}else{
echo"<b>Нет вещей</b><br/>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `pit_shop`"),0);
checkin::display_pagin($my_page, $all_posts, 'editors.php?a=pititem&p='); 
echo"<a href=\"editors.php?\">Назад</a>";
break;

case'pititem_red':
if(empty($id)){
echo"Ошибка невыбран питомец!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `pit_shop` WHERE `id`='$id' LIMIT 1");

if (mysql_num_rows($req)==0){echo"Такой вещи нет нет.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="editors.php?a=pititem_red&amp;id='.$id.'" method="post">';


echo "Тип:<br/>
<select name=\"tip\">
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Броня</option>
<option value=\"nogi\">Ботинки</option>
</select><br/>";

echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";

echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";

echo"Сила<br/>
<input class='input' type=\"text\" value=\"$item[sila]\" size=\"10\" name=\"sila\"/><br/>";

echo"Защита<br/>
<input class='input' type=\"text\" value=\"$item[prot]\" size=\"10\" name=\"prot\"/><br/>";

echo"Раса<br/>
<input class='input' type=\"text\" value=\"$item[rasa]\" size=\"10\" name=\"rasa\"/><br/>";

echo"Лвл<br/>
<input class='input' type=\"text\" value=\"$item[nlvl]\" size=\"10\" name=\"nlvl\"/><br/>";



echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{

mysql_query("UPDATE `pit_shop` SET
`city` = 'fornost',
`tip` = '$_POST[tip]',
`name` = '$_POST[name]',
`cena` = '$_POST[cena]',
`sila` = '$_POST[sila]',
`prot` = '$_POST[prot]',
`rasa` = '$_POST[rasa]',
`nlvl` = '$_POST[nlvl]'
WHERE `id` = '$id' ");

echo'Вещь '.$_POST[name].' изменена!<br/>';
}
echo"<a href=\"editors.php?\">Назад</a>";
break;

case'pititem_add':
if(empty($_POST[name])){
echo '<form action="editors.php?a=pititem_add" method="post">';


echo "Тип:<br/>
<select name=\"tip\">
<option value=\"weapon\">Оружие</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Броня</option>
<option value=\"nogi\">Ботинки</option>
</select><br/>";

echo"Имя<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"name\"/><br/>";

echo"Цена<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"cena\"/><br/>";

echo"Сила<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"sila\"/><br/>";

echo"Защита<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"prot\"/><br/>";

echo"Раса<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"rasa\"/><br/>";

echo"Лвл<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"nlvl\"/><br/>";



echo '<input class="button" type="submit" value="Добавить" /></form>';
}else{




mysql_query("INSERT INTO `pit_shop` SET
`id` = 'NULL',
`city` = 'fornost',
`tip` = '$_POST[tip]',
`name` = '$_POST[name]',
`cena` = '$_POST[cena]',
`sila` = '$_POST[sila]',
`prot` = '$_POST[prot]',
`rasa` = '$_POST[rasa]',
`nlvl` = '$_POST[nlvl]'
");
echo'Вещь '.$_POST[name].' Добавлена!<br/>';
}
echo"<a href=\"editors.php?\">Назад</a>";
break;

case 'pititem_del':
if(empty($id)){
echo"Ошибка невыбрана вещь!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `pit_shop` where `id`='$id'");
$avto= mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `pit_shop` WHERE `id`='$id'");
echo'Вещь удалена!<br/>';
echo"<a href=\"editors.php?\">Назад</a>";
break;





case 'pit_del':
if(empty($id)){
echo"Ошибка невыбран питомец!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `pitomec` where `id`='$id'");
$avto= mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}
mysql_query("DELETE FROM `pitomec` WHERE `id`='$id'");
echo'Питомец удален!<br/>';
echo"<a href=\"editors.php?\">Назад</a>";
break;


case'pit_add':

if(empty($_POST[name])){
echo '<form action="editors.php?a=pit_add" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"name\"/><br/>";

echo "Раса:<br/>
<select name=\"rasa\">
<option value=\"wolf\">Волк</option>
<option value=\"dog\">Собака</option>
<option value=\"dragon\">Дракон</option>
</select><br/>";

echo"Жизни<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"hp\"/><br/>";

echo"Все жизни<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"hpall\"/><br/>";

echo"Атака<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"sila\"/><br/>";

echo"Защита<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"prot\"/><br/>";

echo"Цена<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"cena\"/><br/>";

echo"Уровень<br/>
<input class='input' type=\"text\"  size=\"10\" name=\"lvl\"/><br/>";

echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{


mysql_query("
INSERT INTO `pitomec` (`id`, `city`, `name`, `rasa`, `hp`, `hpall`, `sila`, `prot`, `cena`, `lvl`, `klas`) VALUES (NULL, 'fornost', '".mysql_real_escape_string($_POST[name])."', '".mysql_real_escape_string($_POST[rasa])."', '".mysql_real_escape_string($_POST[hp])."', '".mysql_real_escape_string($_POST[hpall])."', '".mysql_real_escape_string($_POST[sila])."', '".mysql_real_escape_string($_POST[prot])."', '".mysql_real_escape_string($_POST[cena])."', '".mysql_real_escape_string($_POST[lvl])."', 'not')
");
echo'Питомец '.$_POST[name].' добавлен!<br/>';
}
echo"<a href=\"editors.php?\">Назад</a>";
break;

case'pit_red':
if(empty($id)){
echo"Ошибка невыбран питомец!";
include($path.'inc/down.php');
exit;
}
$req = mysql_query("SELECT * FROM `pitomec` WHERE `id`='$id' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Такого питомца не существует.";include($path.'inc/down.php');exit;}
$item = mysql_fetch_assoc($req);
if(empty($_POST[name])){
echo '<form action="editors.php?a=pit_red&amp;id='.$id.'" method="post">';
echo"Имя<br/>
<input class='input' type=\"text\" value=\"$item[name]\" size=\"10\" name=\"name\"/><br/>";

echo "Раса:<br/>
<select name=\"rasa\">
<option value=\"wolf\">Волк</option>
<option value=\"dog\">Собака</option>
<option value=\"dragon\">Дракон</option>
</select><br/>";

echo"Жизни<br/>
<input class='input' type=\"text\" value=\"$item[hp]\" size=\"10\" name=\"hp\"/><br/>";

echo"Все жизни<br/>
<input class='input' type=\"text\" value=\"$item[hpall]\" size=\"10\" name=\"hpall\"/><br/>";

echo"Атака<br/>
<input class='input' type=\"text\" value=\"$item[sila]\" size=\"10\" name=\"sila\"/><br/>";

echo"Защита<br/>
<input class='input' type=\"text\" value=\"$item[prot]\" size=\"10\" name=\"prot\"/><br/>";

echo"Цена<br/>
<input class='input' type=\"text\" value=\"$item[cena]\" size=\"10\" name=\"cena\"/><br/>";

echo"Уровень<br/>
<input class='input' type=\"text\" value=\"$item[lvl]\" size=\"10\" name=\"lvl\"/><br/>";

echo '<input class="button" type="submit" value="Изменить" /></form>';
}else{


mysql_query("UPDATE `pitomec` SET
`name` = '$_POST[name]',
`rasa` = '$_POST[rasa]',
`hp` = '$_POST[hp]',
`hpall` = '$_POST[hpall]',
`sila` = '$_POST[sila]',
`prot` = '$_POST[prot]',
`cena` = '$_POST[cena]',
`lvl` = '$_POST[lvl]'
WHERE `id` = '$id' ");
echo'Питомец '.$_POST[name].' изменен!<br/>';
}
echo"<a href=\"editors.php?\">Назад</a>";
break;



case 'edit':
$id = (int)$_GET['id'];
$select = mysql_query("SELECT * FROM `clan` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
    echo '<div class="title">'.$clan['name'].'</div>';
    echo '<div class="slot_menu"><a href="editors.php?a=edit&amp;id='.$id.'&amp;image">Изменить лого</a></div>';
    echo '<div class="slot_menu"><a href="editors.php?a=edit&amp;id='.$id.'&amp;lider">Изменить лидера</a></div>';
    echo '<div class="slot_menu"><a href="editors.php?a=edit&amp;id='.$id.'&amp;zam">Изменить заместителя</a></div>';
    
$general = '<div class="slot_menu"><a href="editors.php?a=edit&amp;id='.$id.'">Основное</a></div>';    
    
    
    //Логотип*************
    if(isset($_GET['image'])){
   //Изменяем картинку     
        if(empty($clan['logo'])){
$logo = '<img src="pic/clan_logo/pusto.png"  width="50" height="50" alt="/">';

}else{
$logo = '<img src="pic/clan_logo/'.$clan['logo'].'"  width="50" height="50" alt="/">';
}
        $text = '<a href="editors.php?a=choose_logo&amp;id='.$id.'">Выбрать лого</a>';
        
        echo '<div class="slot_menu">Текущее лого:<br />'.$logo.'<br />'.$text.'<br /></div>';
    
        echo $general;
        break;
    }
    
    
    //ЛИДЕР*********
    if(isset($_GET['lider'])){ 

$clan_pers=mysql_query("SELECT * FROM `users` WHERE `clan` = '$clan[lider]' AND `usr` != '$clan[lider]'");
echo '<hr />Текущий лидер: '.$clan['lider'].'';
while($all_users=mysql_fetch_assoc($clan_pers)){
    echo '<div class="slot_menu"><a href="editors.php?a=lider&amp;id='.$id.'&amp;lider='.$all_users['id'].'">'.$all_users['usr'].' - Назначить лидером</a></div>';
}

        echo $general;
        break;
    }
    
        //ЛИДЕР*********
    if(isset($_GET['zam'])){ 

$clan_pers = mysql_query("SELECT * FROM `users` WHERE `clan` = '$clan[lider]' AND `usr` != '$clan[zam]'");
echo '<hr />Текущий заместитель: '.$clan['zam'].'';
while($all_users= mysql_fetch_assoc($clan_pers)){
    echo '<div class="slot_menu"><a href="editors.php?a=zam&amp;id='.$id.'&amp;zam='.$all_users['id'].'">'.$all_users['usr'].' - Назначить заместителем</a></div>';
}

        echo $general;
        break;
    }
    
    //Основная часть
    
    
    echo '<form method="POST" action="editors.php?a=save">';
    echo '<input type="hidden" name="id" value="'.$id.'" />';
    
    echo 'Название:<br />';
    echo '<input type="text" name="name" value="'.$clan['name'].'" /><br />';
    
    echo 'Уровень:<br />';
    echo '<input type="text" name="lvl" value="'.$clan['lvl'].'" /><br />';
    
    echo 'Опыт:<br />';
    echo '<input type="text" name="exp" value="'.$clan['exp'].'" /><br />';
    
    echo 'Point:<br />';
    echo '<input type="text" name="point" value="'.$clan['point'].'" /><br />';
    
	echo 'Деньги:<br />';
	echo '<input type="text" name="money" value="'.$clan['money'].'" /><br />';
    
    echo 'CoL:<br />';
    echo '<input type="text" name="col" value="'.$clan['col'].'" /><br />';
    
    echo 'Информация:<br />';
    echo '<input type="text" name="desk" value="'.$clan['desk'].'" /><br />';
    
    echo 'Физ. Атака:<br />';
    echo '<input type="text" name="patt" value="'.$clan['patt'].'" /><br />';
    
    echo 'Маг. Атака:<br />';
    echo '<input type="text" name="matt" value="'.$clan['matt'].'" /><br />';
    
    echo 'Физ. Защита:<br />';
    echo '<input type="text" name="pdef" value="'.$clan['pdef'].'" /><br />';
    
    echo 'Маг. Защита:<br />';
    echo '<input type="text" name="mdef" value="'.$clan['mdef'].'" /><br />';
    
    echo 'Адена:<br />';
    echo '<input type="text" name="aden" value="'.$clan['aden'].'" /><br />';
    
    echo 'Репутация:<br />';
    echo '<input type="text" name="rep" value="'.$clan['rep'].'" /><br />';
    
    echo '<input type="submit" value="Сохранить" />';
    
    echo '</form>';
    
    echo '<br /><div class="slot_menu"><a href="editors.php?a=delete_clan&amp;id='.$id.'" style="color: red;">Удалить этот клан</a></div>';
    
}else{
    echo '<div class="error">Ошибка! Такой клан не найден!</div>';
}
break;



case 'delete_clan':
$id = (int)$_GET['id'];
$select = mysql_query("SELECT * FROM `clan` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
    
if(isset($_GET['yes'])){
mysql_query("DELETE from `clan` WHERE `id` = '$id'");
$alls = mysql_query("SELECT * FROM `users` WHERE `clan` = '$clan[lider]'");
while($r = mysql_fetch_assoc($alls)){
mysql_query("UPDATE `users` SET `clan` = NULL WHERE `id` = '$r[id]'");
        $i++;
    }
    echo 'Ну красава, теперь '.$i.' пидрил остались без клана';
    break;
}else{
    echo '<div class="error" style="color: white;">Вы уверенные что хотите удалить клан <span style="color: green;">'.$clan['name'].'</span>? - <a style="color: red;" href="editors.php?a=delete_clan&amp;id='.$id.'&amp;yes">Угу</a> / <a style="color: yellow;" href="editors.php?a=edit&amp;id='.$id.'">Неа</a></div>';
}

}else{
    echo '<div class="error">Ошибка! Такой клан не найден!</div>';
}
break;

case 'save':
$id = (int)$_POST['id'];
$select = mysql_query("SELECT * FROM `clan` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
    
    
    /*Все значения*/
    $matt = abs(intval($_POST['matt']));
    $patt = abs(intval($_POST['patt']));
    $pdef = abs(intval($_POST['pdef']));
    $mdef = abs(intval($_POST['mdef']));
    $aden = abs(intval($_POST['aden']));
    $rep = abs(intval($_POST['rep']));
    $col = abs(intval($_POST['col']));
    $money = abs(intval($_POST['money']));
    $point = abs(intval($_POST['point']));
    $exp = abs(intval($_POST['exp']));
    $lvl = abs(intval($_POST['lvl']));
    /*Текст значения*/
    $name = mysql_real_escape_string($_POST['name']);
    $desk = mysql_real_escape_string($_POST['desk']);
    /*Все значения*/
     $error = 0;
    
    //Проверки...
    
    if($matt > 200 || $patt > 200 || $pdef > 200 || $mdef > 200){
        $error = 'Неверное значение физ атаки/маг атаки/маг защити/физ защиты. Эти значения не могут быть выше 200';
    }
    
    if($rep > 1000000){
        $error = 'Репутация не может быть выше 1000000';
    }
    
    if(mb_strlen($name) > 30 || mb_strlen($name) < 3){
        $error = 'Ошибка! Название клана должно быть не менее 3-х символов но не более 30';
    }
    
        if(mb_strlen($desk) > 500){
        $error = 'Ошибка! Информация клана должна местить не более чем 500 символов';
    }
    
    if($error){
        echo '<div class="error">'.$error.'</div>';
        break;
    }
       
    //Проверки...
    
mysql_query("UPDATE `clan` SET `matt` = '$matt',`patt` = '$patt',`pdef` = '$pdef',`mdef` = '$mdef',`money` = '$aden',`col` = '$col',`pdef` = '$pdef',`money` = '$money',`point` = '$point',`lvl` = '$lvl',`exp` = '$exp',`name` = '$name',`desk` = '$desk' WHERE `id` = '$id'");
//Фух ебать писать...
    echo 'Сохранение прошло успешно! - <a href="editors.php?a=edit&amp;id='.$id.'">'.$clan['name'].'</a>';
    }else{
    echo '<div class="error">Ошибка! Такой клан не найден!</div>';
}
break;

case 'zam':
$id = (int)$_GET['id']; //Клан который редачим
$lider = (int)$_GET['zam']; //`id` - > `users` Выбранный заместитель
$select = mysql_query("SELECT * FROM `clan` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
$lid = mysql_query("SELECT * FROM `users` WHERE `id` = '$lider'");
    
    if($lid['clan'] != $clan['lider']){
        echo '<div class="error">Ошибка! Выбранный кандидат не является участником данного клана! Если вы выбрали его из списка то скорее всего он только что покинул клан...</div>';
        break;
    }
       
    if($lid['usr'] == $clan['lider']){         
mysql_query("UPDATE `clan` SET `zam` = '$lid[usr]' WHERE `id` = '$id'");
mysql_query("UPDATE `clan` SET `lider` = '$clan[zam]' WHERE `id` = '$id'");
        
$all_perses = mysql_query("SELECT * FROM `users` WHERE `clan` = '$clan[lider]'");
while($update = mysql_fetch_assoc($all_perses)){
mysql_query("UPDATE `users` SET `clan` = '$clan[zam]' WHERE `id` = '$update[id]'");
        }
        
        
    }else{
mysql_query("UPDATE `clan` SET `zam` = '$lid[usr]' WHERE `id` = '$id'");
    }
    echo 'Все отлично! Заместитель клана изменен <a href="editors.php?a=edit&amp;id='.$id.'">Назад к редактированию</a>';
    
    }else{
    echo '<div class="error">Ошибка! Такой клан не найден!</div>';
}
break;


case 'lider':
(int)$_GET['id']; //Клан который редачим
$lider = (int)$_GET['lider']; //`id` - > `users` Выбранный лидер
$select = mysql_query("SELECT * FROM `clan` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
$lid = mysql_query("SELECT * FROM `users` WHERE `id` = '$lider'");
    
if($lid['clan'] != $clan['lider']){
        echo '<div class="error">Ошибка! Выбранный кандидат не является участником данного клана! Если вы выбрали его из списка то скорее всего он только что покинул клан...</div>';
        break;
    }
    
$all_perses = mysql_query("SELECT * FROM `users` WHERE `clan` = '$clan[lider]'");
while($update = mysql_fetch_assoc($all_perses)){
mysql_query("UPDATE `users` SET `clan` = '$lid[usr]' WHERE `id` = '$update[id]'");
        }
    
    if($lid['usr'] == $clan['zam']){         
mysql_query("UPDATE `clan` SET `lider` = '$lid[usr]' WHERE `id` = '$id'");
mysql_query("UPDATE `clan` SET `zam` = '$clan[lider]' WHERE `id` = '$id'");
    }else{
mysql_query("UPDATE `clan` SET `lider` = '$lid[usr]' WHERE `id` = '$id'");
    }
    echo 'Все отлично! Лидер клана изменен <a href="editors.php?a=edit&amp;id='.$id.'">Назад к редактированию</a>';
    
    }else{
    echo '<div class="error">Ошибка! Такой клан не найден!</div>';
}
break;


case 'choose_logo':

$id = (int)$_GET['id'];
$select = mysql_query("SELECT * FROM `clan` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);


if(empty($_GET[name])){
$dira = opendir ("pic/clan_logo");
while ($filea = readdir ($dira)) 
{if (( $filea != ".") && ($filea != ".."))
{$aa[]=$filea;}}
closedir ($dira);
$totala = count($aa)-1;

for ($ia = 0; $ia < $totala; $ia++){

$data_namea[]=$aa[$ia];
}

foreach($data_namea as $ka=>$va)
{
$dat_screena[]="</div><div class=inoy><a href=\"editors.php?a=choose_logo&amp;id=$id&amp;name=$data_namea[$ka]\"> <img src=\"pic/clan_logo/$data_namea[$ka]\" alt=\"lg\"/> - выбрать</a></div><div class=menu>";

}


$totala = count($dat_screena);



if (empty($_GET['logs'])) $logs = 0;
else $logs = $_GET['logs'];
if ($totala < $logs + 10){ $end = $totala; }
else {$end = $logs + 10; }
for ($ia = $logs; $ia < $end; $ia++){

echo"$dat_screena[$ia]";

}


if ($logs != 0) {echo '<a href="editors.php?a=choose_logo&amp;logs='.($logs - 10).'&amp;mod=cl_logo&amp;id='.$id.'">&#x41D;&#x430;&#x437;&#x430;&#x434;</a> ';}
if ($totala > $logs + 10) {echo ' <a href="editors.php?a=choose_logo&amp;logs='.($logs + 10).'&amp;id='.$id.'">&#x414;&#x430;&#x43B;&#x435;&#x435;</a>';}

echo"<br/>Всего: $totala логотипов<br/>";
}else{
$name = htmlspecialchars(stripslashes(addslashes($_GET[name])));

if(!@file("pic/clan_logo/$name")){echo"Такого логотипа не существует."; include($path.'inc/down.php'); exit;}
$reqcl = mysql_query("SELECT * FROM `clan` where `lider`='$udata[clan]'");
$clan = mysql_fetch_assoc($reqcl);


mysql_query("UPDATE `clan` SET `logo` = '$name' WHERE `id` = '$id'");

echo 'Логотип установлен. <a href="editors.php?a=edit&amp;id='.$id.'">Назад к редактированию</a>';
}


    
}else{
    echo '<div class="error">Ошибка! Такой клан не найден!</div>';
}

break;

case 'mobs':
$id = abs(intval($_GET['id']));
if($id){
$select = mysql_query("SELECT * FROM `mobs` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$mob = mysql_fetch_assoc($select);
        
        if(isset($_POST['save'])){
            
            $name = mysql_real_escape_string($_POST['name']);
            $lvl = (int)$_POST['lvl'];
            if(mb_strlen($name) > 150){
                echo '<div class="error">Ошибка! Имя моба не может быть длиннее 65 символов</div>'; break;
            }
$vse_mobu = mysql_query("SELECT * FROM `mobs` WHERE `name` = '$mob[name]'");
while($vse = mysql_fetch_assoc($vse_mobu)){
mysql_query("UPDATE
        `mobs` SET
        `name` = '$_POST[name]',
        `lvl` = '$_POST[lvl]',
        `money` = '$_POST[money]',
        `msh` = '$_POST[msh]',
        `exp` = '$_POST[exp]',
        `hp` = '$_POST[hp]',
`hpall` = '$_POST[hpall]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `okra` = '$_POST[okra]',
        `status` = 'on',
        `time` = '$_POST[time]',
        `oponent` = 'not',
        `drop` = '$_POST[drop]',
        `shans` = '$_POST[shans]',
        `tip` = '$_POST[tip]',
        `quest` = '$_POST[quest]' 
         WHERE `id` = '$vse[id]'");
         
         }
         
         echo '<a href="editors.php?a=mobs&amp;id='.$id.'">Сохранение прошло успешно!</a>';
         break;
         
        }

        echo '<div class="title"><a href="editors.php?a=mobs">'.$mob['name'].'</a></div>';
        
echo '<form method="POST" action="editors.php?a=mobs&id='.$id.'">';

echo 'Тип:<br/>
<select name="tip">';
if($mob['tip'] == 'life'){
    echo '<option value="life" selected>Обычный</option>';
    echo '<option value="boss">Босс</option>';
}else{
    echo '<option value="life">Обычный</option>';
    echo '<option value="boss" selected>Босс</option>';
}
echo '</select><br/><hr/>';

echo"Имя<br/>
<input class='input' value='".$mob['name']."' type=\"text\" size=\"10\" name=\"name\"/><br/><hr/>";
echo"Уровень<br/>
<input class='input' value='".$mob['lvl']."' type=\"text\" size=\"10\" name=\"lvl\"/><br/><hr/>";
echo"Урон (Patt/Matt)<br/>
<input class='input' value='".$mob['patt']."' type=\"text\" size=\"3\" name=\"patt\"/>";
echo"|<input class='input' value='".$mob['matt']."' type=\"text\" size=\"3\" name=\"matt\"/><br/><hr/>";
echo"Жизни:<br/>		";
echo"<input class='input' value='".$mob['hp']."' type=\"text\" size=\"10\" name=\"hp\"/>";
echo"|<input class='input' value='".$mob['hpall']."' type=\"text\" size=\"10\" name=\"hpall\"/><br/><hr/>";
echo"Защита (Pdef/Mdef)<br/>
<input class='input' value='".$mob['pdef']."' type=\"text\" size=\"3\" name=\"pdef\"/>";
echo"|<input class='input' value='".$mob['mdef']."' type=\"text\" size=\"3\" name=\"mdef\"/><br/><hr/>";
echo"Шанс выпадания дропа (1-100%)<br/>
<input class='input' value='".$mob['shans']."' type=\"text\" size=\"10\" name=\"shans\"/><br/>";
echo"Дроп (пример: 1/4/6)<br/>";
echo "<a href=\"adm_panel.php?mod=17\">Список</a><br/>";
echo "</b><input class='input' value='".$mob['drop']."' type=\"text\" size=\"20\" name=\"drop\"/><hr/>";
echo"Шанс выпадания монет в % от 1 до 100 
<br/>Исклучение: (0=100%)<br/>
<input class='input' value='".$mob['msh']."' type=\"text\" size=\"10\" name=\"msh\"/><br/><hr/>";
echo"Кол. монет:<br/>
<input class='input' value='".$mob['money']."' type=\"text\" size=\"10\" name=\"money\"/><br/><hr/>";
echo"Опыта:<br/>
<input class='input' value='".$mob['exp']."' type=\"text\" size=\"10\" name=\"exp\"/><br/><hr/>";
echo"Квэст:(нету-оставить пустым)<br/>
<input class='input' value='".$mob['quest']."' type=\"text\" size=\"10\" name=\"quest\"/><br/><hr/>";
echo"Время смерти (cек):<br/>
<input class='input' value='".$mob['time']."' type=\"text\" size=\"10\" name=\"time\"/><br/><hr/>";
echo"Окра: <br/>
<input class='input' value='".$mob['okra']."' type=\"text\" size=\"10\" name=\"okra\"/>";
        echo '<input type="submit" name="save" value="Сохранить" />';
        echo '</form>';
}else{
        echo 'Ошибка! Такого моба не найдено!';
        break;
    }
}else{
    echo '<div class="title">Выберите моба для редактирования</div>';
if($_POST['search']){
$all_mob = mysql_query("SELECT * FROM `mobs` WHERE `name` LIKE '".mysql_real_escape_string($_POST[search])."' LIMIT $start,$display");
echo '<a href="editors.php?a=mobs">Сброс</a>';
$all_mobs = mysql_result(mysql_query("SELECT * FROM `mobs` WHERE `name` LIKE '".mysql_real_escape_string($_POST[search])."'"),0);
}else{
$all_mob = mysql_query("SELECT * FROM `mobs` GROUP BY `name` ORDER BY id DESC LIMIT $start,$display");
   $all_mobs = mysql_result(mysql_query("SELECT * FROM `mobs` GROUP BY `name`"),0);
}

while($mob = mysql_fetch_assoc($all_mob)){
echo '<div class="slot_menu"><a href="editors.php?a=mobs&amp;id='.$mob['id'].' ">'.$mob['name'].' / '.$mob['lvl'].'</a><a href="/editors.php?a=del_mob&amp;id='.$mob['id'].'">  удалить</a></div>';
};
//$all_mobs = mysql_num_rows($all_mob);

checkin::display_pagin($my_page, $all_mobs, 'editors.php?a=mobs&amp;p=');

echo '<br />';
echo '<form action="editors.php?a=mobs" method="POST"><input type="text" value="'.mysql_real_escape_string($_POST['search']).'" name="search" /> <input type="submit" value="Поиск" /></form>';

echo '<hr />';
}

break;

case 'del_mob':
if($udata['dostup']>3){
$id=abs(intval($_GET['id']));
$select = mysql_query("SELECT * FROM `mobs` WHERE `id` = '".$id."'");
if(mysql_num_rows($select)){
mysql_query("DELETE FROM `mobs` WHERE `id` ='".$id."' LIMIT 1");
echo'Моб с айди '.$id.' удален успешно';}else{
echo"Такого монстра не существует.";
break;
}
}
break;

case 'city':
$id = (int)$_GET['id'];
if($id){
$select = mysql_query("SELECT * FROM `gorod` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$gorod = mysql_fetch_assoc($select);
        
        if(isset($_POST['save'])){
            
            $name = mysql_real_escape_string($_POST['name']);
            $cena = abs(intval($_POST['cena']));
			$lvl = abs(intval($_POST['lvl']));
            if(mb_strlen($name) > 150){
                echo '<div class="error">Ошибка! Имя локации не может быть длиннее 150 символов</div>'; break;
            }
            
mysql_query("UPDATE `gorod` SET `cena` = '$cena', `name` = '$name',`lvl` = '$lvl' WHERE `id` = '$id'");
            
            echo '<a href="editors.php?a=city&id='.$id.'">Сохранение прошло успешно!</a>';
            break;
        }

        echo '<div class="title"><a href="editors.php?a=city">'.$gorod['name'].'</a></div>';
        echo '<form method="POST" action="editors.php?a=city&id='.$id.'">';
        echo 'Название:<br />';
        echo '<input type="text" name="name" value="'.$gorod['name'].'" /><br />';        
        echo 'Цена за телепорт:<br />';
        echo '<input type="text" name="cena" value="'.$gorod['cena'].'" /><br />';
		echo 'Уровень доступа:<br />';
        echo '<input type="text" name="lvl" value="'.$gorod['lvl'].'" /><br />';
        echo '<input type="submit" name="save" value="Сохранить" />';
        echo '</form>';
        
        echo '<br /><div class="slot_menu"><a href="">Удалить</a></div>';
        
    }else{
        echo 'Ошибка! Такого города не найдено!';
        break;
    }
}else{
    echo '<div class="title">Выберите город для редактирования</div>';
$all_gorod = mysql_query("SELECT * FROM `gorod`");
while($gorod  =mysql_fetch_assoc($all_gorod)){
  echo '<a href="editors.php?a=city&amp;id='.$gorod['id'].' "><div class="slot_menu">'.$gorod['name'].' / '.$gorod['cena'].'</div></a> <a href="editors.php?a=delete_city&amp;id='.$gorod['id'].' " style="color: red;">Удалить этот город</a>';
};

}

break;

case 'delete_city':
$id = (int)$_GET['id'];
$select = mysql_query("SELECT * FROM `gorod` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
    
if(isset($_GET['yes'])){
mysql_query("DELETE from `gorod` WHERE `id` = '$id'");
    echo 'Ну красава, теперь нету города '.$clan['name'].'';
    break;
}else{
    echo '<div class="error" style="color: white;">Вы уверенные что хотите удалить город<span style="color: green;">'.$clan['name'].'</span>? - <a style="color: red;" href="editors.php?a=delete_city&amp;id='.$id.'&amp;yes">Угу</a> / <a style="color: yellow;" href="editors.php?a=city&amp;id='.$id.'">Неа</a></div>';
}

}else{
    echo '<div class="error">Ошибка! Такой город не найден!</div>';
}
break;

case 'okr':
$id = (int)$_GET['id'];
if($id){
$select =mysql_query("SELECT * FROM `okra` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$gorod = mysql_fetch_assoc($select);
        
        if(isset($_POST['save'])){
            
            $name = mysql_real_escape_string($_POST['name']);
            $gorod = mysql_real_escape_string($_POST['gorod']);
            $cena = abs(intval($_POST['cena']));
            if(mb_strlen($name) > 150){
                echo '<div class="error">Ошибка! Имя локации не может быть длиннее 150 символов</div>'; break;
            }
            if(mb_strlen($gorod) > 150){
                echo '<div class="error">Ошибка! Имя локации не может быть длиннее 150 символов</div>'; break;
            }
mysql_query("UPDATE `okra` SET `cena` = '$cena', `name` = '$name', `gorod` = '$gorod' WHERE `id` = '$id'");
            
            echo '<a href="editors.php?a=okr&id='.$id.'">Сохранение прошло успешно!</a>';
            break;
        }

        echo '<div class="title"><a href="editors.php?a=okr">'.$gorod['name'].'</a></div>';
        echo '<form method="POST" action="editors.php?a=okr&id='.$id.'">';
        echo 'Название:<br />';
        echo '<input type="text" name="name" value="'.$gorod['name'].'" /><br />';  
         echo 'Название:<br />';
        echo '<input type="text" name="gorod" value="'.$gorod['gord'].'" /><br />';        
        echo 'Цена за телепорт:<br />';
        echo '<input type="text" name="cena" value="'.$gorod['cena'].'" /><br />';
        echo '<input type="submit" name="save" value="Сохранить" />';
        echo '</form>';
        
        
        
    }else{
        echo 'Ошибка! Такого города не найдено!';
        break;
    }
}else{
    echo '<div class="title">Выберите окру для редактирования</div>';

$display = 10;
$my_page = (int)$_GET['p'];
            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
$start = ($my_page-1)*$display;
$all_gorod = mysql_query("SELECT * FROM `okra` ORDER BY id DESC LIMIT $start,$display");
while($gorod = mysql_fetch_assoc($all_gorod)){
  echo '<a href="editors.php?a=okr&amp;id='.$gorod['id'].' "><div class="slot_menu">'.$gorod['name'].' / '.$gorod['gorod'].'/'.$gorod['cena'].'</div></a> <a href="editors.php?a=delete_okra&amp;id='.$gorod['id'].' " style="color: red;">Удалить эту окру</a>';
};
$all_mobs = mysql_result(mysql_query("SELECT COUNT(*) FROM `okra`"),0);
checkin::display_pagin($my_page, $all_mobs, 'editors.php?a=okr&amp;p='); 
}

break;

case 'delete_okra':
$id = (int)$_GET['id'];
$select = mysql_query("SELECT * FROM `okra` WHERE `id` = '$id'");
if(mysql_num_rows($select)){
$clan = mysql_fetch_assoc($select);
    
if(isset($_GET['yes'])){
mysql_query("DELETE from `okra` WHERE `id` = '$id'");
    echo 'Ну красава, теперь нету окры '.$clan['name'].'';
    break;
}else{
    echo '<div class="error" style="color: white;">Вы уверенные что хотите удалить окру <span style="color: green;">'.$clan['name'].'</span>? - <a style="color: red;" href="editors.php?a=delete_okra&amp;id='.$id.'&amp;yes">Угу</a> / <a style="color: yellow;" href="editors.php?a=okra&amp;id='.$id.'">Неа</a></div>';
}

}else{
    echo '<div class="error">Ошибка! Такой город не найден!</div>';
}
break;

case 'add_okr':
if(empty($_POST[name])){
echo '<form action="/editors.php?a=add_okr" method="post">';
echo"Название<br/>
<input class='input' type=\"text\" size=\"10\" name=\"name\"/><br/><hr/>";
echo"Город<br/>
<input class='input' type=\"text\" size=\"10\" name=\"gorod\"/><br/><hr/>";
echo"Цена<br/>
<input class='input' type=\"text\" size=\"10\" name=\"cena\"/><br/><hr/>";
echo '<input class="button" type="submit" value="Создать" /></form>';
}else{
    
$exist = mysql_result(mysql_query("SELECT * FROM `okra` WHERE `name` = '".mysql_real_escape_string($_POST[name])."' AND `gorod` = '$_POST[gorod]'"),0);
    if($exist){
        echo '<div class="error">Ошибка! Такая окрестность в этом городе уже существует! <a href="editors.php?a=okr">Попробуйте поискать ее тут</a></div>';
    break;
    }
    
mysql_query("INSERT INTO `okra` (`id`, `name`, `gorod`, `cena`) VALUES (NULL, '".mysql_real_escape_string($_POST[name])."','$_POST[gorod]',  '$_POST[cena]')");
echo'Город '.$_POST[name].' успешно добавлен! Нивкоем случае не обновляйте страницу!<br/>';
}
echo"<a href=\"adm_panel.php?\">Назад</a>";
break;


case 'add_city':
if(empty($_POST[name])){
echo '<form action="/editors.php?a=add_city" method="post">';
echo"Название<br/>
<input class='input' type=\"text\" size=\"10\" name=\"name\"/><br/><hr/>";
echo"Цена<br/>
<input class='input' type=\"text\" size=\"10\" name=\"cena\"/><br/><hr/>";
echo '<input class="button" type="submit" value="Создать" /></form>';
}else{
    
$exist = mysql_result(mysql_query("SELECT * FROM `gorod` WHERE `name` = '".mysql_real_escape_string($_POST[name])."'"),0);
    if($exist){
        echo '<div class="error">Ошибка! Такой город уже существует! <a href="editors.php?a=city">Попробуйте поискать его тут</a></div>';
    break;
    }
mysql_query("INSERT INTO `gorod` (`id`, `name`, `cena`) VALUES (NULL, '".mysql_real_escape_string($_POST[name])."', '$_POST[cena]')");
echo'Город '.$_POST[name].' успешно добавлен! Нивкоем случае не обновляйте страницу!<br/>';
}
echo"<a href=\"adm_panel.php?\">Назад</a>";
break;

case 'new_clan':

$users = mysql_query("SELECT `id`,`clan` FROM `users`");
while($us=mysql_fetch_assoc($users)){
    if($us['clan']){
$user_clan = mysql_query("SELECT `id` FROM `clan` WHERE `lider` = '$us[clan]'");
mysql_query("UPDATE `users` SET `clan_id` = '$user_clan[id]' WHERE `id` = '$us[id]'");
    }

}

break;


/**
 * Mod Author: FROSTY!?
 * Mail: valik619@inbox.ru
 * vk.com/valik619
 * 21:43 - 23.02.2014
 */

case 'create_mob':

        if(isset($_POST['save'])){
           // $mobs_num = $_POST['mobs_num'];
            $name = $_POST['name'];
            $lvl = (int)$_POST['lvl'];
            if(mb_strlen($name) > 150){
                echo '<div class="error">Ошибка! Имя моба не может быть длиннее 65 символов</div>'; break;
            }
            $limit = abs(intval($_POST['okra']));
$vse_okr = mysql_query("SELECT * FROM `okra` ORDER BY RAND() LIMIT $limit");
            $mobs_num = abs(intval($_POST['mobs_num']));
while($vse = mysql_fetch_assoc($vse_okr)){
                
while($num <= $mobs_num){        
mysql_query("INSERT INTO
        `mobs` SET
        `name` = '".mysql_real_escape_string($name)."',
        `lvl` = '$_POST[lvl]',
        `money` = '$_POST[money]',
        `msh` = '$_POST[msh]',
        `exp` = '$_POST[exp]',
        `hp` = '$_POST[hp]',
        `hpall` = '$_POST[hp]',
        `patt` = '$_POST[patt]',
        `matt` = '$_POST[matt]',
        `pdef` = '$_POST[pdef]',
        `mdef` = '$_POST[mdef]',
        `okra` = '$vse[name]',
        `status` = 'on',
        `time` = '$_POST[time]',
        `oponent` = 'not',
        `drop` = '$_POST[drop]',
        `shans` = '$_POST[shans]',
        `tip` = '$_POST[tip]',
        `quest` = '$_POST[quest]'");
$num++; //Типа добавили одного
} 
         $okr++;
$num = 0;
         }
         
         echo '<a href="editors.php?a=create_mob">Создание прошло успешно! В Каждой окресности по '.$num.' мобов / Количество окресностей в которые были добавлены боты: '.$okr.'</a>';
         break;
         
        }

        echo '<div class="title"><a>Создаем моба</a></div>';
        
echo '<form method="POST" action="editors.php?a=create_mob">';

echo 'Тип:<br/>
<select name="tip">';
if($mob['tip'] == 'life'){
    echo '<option value="life" selected>Обычный</option>';
    echo '<option value="boss">Босс</option>';
}else{
    echo '<option value="life">Обычный</option>';
    echo '<option value="boss" selected>Босс</option>';
}
echo '</select><br/><hr/>';

echo"Имя<br/>
<input class='input'  type=\"text\" size=\"10\" name=\"name\"/><br/><hr/>";
echo"Уровень<br/>
<input class='input' type=\"text\" size=\"10\" name=\"lvl\"/><binput class='input' type=\"text\" size=\"10\" name=\"cena\"/r/><hr/>";
echo"Урон (Patt/Matt)<br/>
<input class='input' type=\"text\" size=\"3\" name=\"patt\"/>";
echo"|<input class='input' type=\"text\" size=\"3\" name=\"matt\"/><br/><hr/>";
echo"Жизни:<br/>		";
echo"<input class='input' type=\"text\" size=\"10\" name=\"hp\"/><br/><hr/>";
echo"Защита (Pdef/Mdef)<br/>
<input class='input' type=\"text\" size=\"3\" name=\"pdef\"/>";
echo"|<input class='input' type=\"text\" size=\"3\" name=\"mdef\"/><br/><hr/>";
echo"Шанс выпадания дропа (1-100%)<br/>
<input class='input'  type=\"text\" size=\"10\" name=\"shans\"/><br/>";
echo"Дроп (пример: 1/4/6)<br/>";
echo "<a href=\"adm_panel.php?mod=17\">Список</a><br/>";
echo "</b><input class='input' type=\"text\" size=\"20\" name=\"drop\"/><hr/>";
echo"Шанс выпадания монет в % от 1 до 100 
<br/>Исклучение: (0=100%)<br/>
<input class='input' type=\"text\" size=\"10\" name=\"msh\"/><br/><hr/>";
echo"Кол. монет:<br/>
<input class='input' type=\"text\" size=\"10\" name=\"money\"/><br/><hr/>";
echo"Опыта:<br/>
<input class='input' type=\"text\" size=\"10\" name=\"exp\"/><br/><hr/>";
echo"Квэст:(нету-оставить пустым)<br/>
<input class='input' type=\"text\" size=\"10\" name=\"quest\"/><br/><hr/>";
echo"Время смерти (cек):<br/>
<input class='input' type=\"text\" size=\"10\" name=\"time\"/><br/><hr/>";
echo"Количество окресностей: <br />(моб будет расскидан в каждую, рандомно выбранную)<br/>
<input class='input' type=\"text\" size=\"10\" name=\"okra\"/><br/><hr/>";

echo"Количество мобов: <br />(в одной окресности)<br/>
<input class='input' type=\"text\" size=\"10\" name=\"mobs_num\"/><br/><hr/>";

        echo '<input type="submit" name="save" value="Добавить" />';
        echo '</form>';

break;




}

include($path.'inc/down.php');

?>