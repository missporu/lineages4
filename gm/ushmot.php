﻿<?
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

if ($udata['dostup'] >= 4){

echo "<p><hr/></p><center>";

echo"<p>Создать вещь</p>";


echo "</center><p><hr/></p>";


// --------------------------- загрузка картинки и создание вещи ------------------------------------

if(empty($_POST['nw'])){
echo '<form action="?" method="post" enctype="multipart/form-data">';


echo '
<b> Картинка шмота: </b></h2><br/>
- размер 32*32 картинки <br/>
- Для Люкс размер 64*64 использовать <br/>
- формат рекомендуем <b>png, gif, jpg</b> <br/>
 
 <br/> Название вещи:<br/>

 
 <input type=text name=nw> <br/>

  Выбор изобр:<br/>

 <input type=file name=uploadfile><br/><br/>
';




echo"Игрок<br/>
<input class='input' type=\"text\" size=\"10\" name=\"usr\"/><br/>";

echo "Тип:<br/>
<select name=\"tip\">

<option value=\"ykr\">Украшение</option>
<option value=\"golova\">Шлем</option>
<option value=\"body\">Доспехи</option>
<option value=\"ruki\">Рукавицы</option>
<option value=\"weapon\">Оружие</option>
<option value=\"shit\">Щит</option>
<option value=\"pants\">Штаны</option>
<option value=\"nogi\">Сапоги</option>
<option value=\"plash\">Плащ</option>
<option value=\"amulet\">Амулет</option>
<option value=\"poyas\">Левая серёжка</option>
<option value=\"rpoyas\">Правая серёжка</option>
<option value=\"kolco\">Правое кольцо</option>
<option value=\"rkolco\">Левое кольцо</option>
</select><br/>";

/*
echo"Имя<br/>
<input class='input' type=\"text\" size=\"10\" name=\"name\"/><br/>";
*/
echo"Цена<br/>
<input class='input' type=\"text\" size=\"10\" name=\"cena\"/><br/>";

echo"Физ атака - P.Att<br/>
<input class='input' type=\"text\" size=\"10\" name=\"patt\"/><br/>";
echo"Маг атака - M.Att<br/>
<input class='input' type=\"text\" size=\"10\" name=\"matt\"/><br/>";

echo"Физ защита P.Def<br/>
<input class='input' type=\"text\" size=\"10\" name=\"pdef\"/><br/>";

echo"Маг защита - M.Def<br/>
<input class='input' type=\"text\" size=\"10\" name=\"mdef\"/><br/>";

echo "Грейд:<br/>
<select name=\"nlvl\">
<option value=\"ps\">Пусто</option>
<option value=\"0\"> NG (0)</option>
<option value=\"20\"> D (20)</option>
<option value=\"40\"> C (40)</option>
<option value=\"52\"> B (52)</option>
<option value=\"62\"> A (62)</option>
<option value=\"76\"> S (76)</option>
<option value=\"91\"> R (96)</option>
<option value=\"111\"> R+ (111)</option>
</select><br/>";


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

echo"SoulShot (кол-во)<br/>
<input class='input' type=\"text\" size=\"10\" name=\"soul\"/><br/>";
echo"SpiritShot (кол-во)<br/>
<input class='input' type=\"text\" size=\"10\" name=\"spirit\"/><br/>";


echo '<input class="button" type="submit" value="Создать" /></form>';
}else{



/*if ($_FILES['uploadfile']['type']=="image/jpg"){*/

	  
// Каталог, в который мы будем принимать файл:
$uploaddir = '../shmot/';
$uploadfile = $uploaddir.basename($_POST['nw'].'.png');

// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{

$size = getimagesize($uploadfile); // с помощью этой функции мы можем получить размер пикселей изображения 
if ($size[0] < 138 && $size[1] < 230) { // если размер изображения не более 128 пикселей по ширине и не более 210 по высоте
}else {echo "Размер пикселей превышает допустимые нормы (ширина не более - 32 пикселей, высота не более 32)";
 unlink($uploadfile); // удаление файла 
 
   include($path.'inc/down.php'); exit; 
   }

echo "<h3>Файл успешно загружен на сервер для персонажа $_POST[nw]</h3>";

}
else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3> $uploaddir "; include($path.'inc/down.php'); exit; }
/*
// тип файла не подходит
}else{ echo "<h3>Ошибка! Формат файла не подходит!</h3> $_FILES[uploadfile][name]. $uploaddir "; include($path.'inc/down.php'); exit; }
*/


$_POST['name'] = $_POST['nw'];


if ($_POST['tip']=="weapon"){
if ($_POST['tip2']=="ps"){echo "Тип оружия не выбран<hr/>";}
if ($_POST['nlvl']=="ps"){echo "Клас оружия не выбран"; include($path.'inc/down.php'); exit;}}
if(empty($_POST['cena'])){$_POST['cena']=100000;}
if(empty($_POST['pdef'])){$_POST['pdef']=0;}
if(empty($_POST['mdef'])){$_POST['mdef']=0;}
if(empty($_POST['patt'])){$_POST['patt']=0;}
if(empty($_POST['matt'])){$_POST['matt']=0;}

if(empty($_POST['soul'])){$_POST['soul']=0;}
if(empty($_POST['spirit'])){$_POST['spirit']=0;}
mysql_query("INSERT INTO
        `item` SET
        `usr` = '".$_POST['usr']."',
        `tip` = '".$_POST['tip']."',
        `ruka` = '".$_POST['tip2']."',
        `name` = '".$_POST['name']."',
        `cena` = '".$_POST['cena']."',
        `patt` = '".$_POST['patt']."',
        `matt` = '".$_POST['matt']."',
        `pdef` = '".$_POST['pdef']."',
        `mdef` = '".$_POST['mdef']."',
        `time` = '".$_POST['time']."',
        `soul` = '".$_POST['soul']."',
        `spirit` = '".$_POST['spirit']."',
        `nlvl` = '".$_POST['nlvl']."',
        `image` = 'not'");
        ///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////
$text = " <font color=#669966><b> Игрок ".$log." создал Вам вещь ".$_POST['name']."! Пользуйтесь на здоровье =)</b></font>";
$usrreg = mysql_query("SELECT * FROM `users` WHERE `usr` = '".$_POST['usr']."'");
While($usr = mysql_fetch_assoc($usrreg)){
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Админка', `user_to` = '".$_POST['usr']."', `time` = '".$time."', `read` = 1, `mail_msg` = '".$text."'"); // отправляем сообщение
}

echo "Вещь ".$_POST['name']." создана игроку ".$_POST['usr']."!<br/>";

}
echo"<br/><a href=\"index.php?\">Назад</a>";


//-------------------   


}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
}
include($path.'inc/down.php');
?>