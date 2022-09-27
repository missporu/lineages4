<?

define('PROTECTOR', 1);
$headmod = 'gallery';//фикс. места
$textl='Фото пользователей';
include('inc//path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

if (isset($_GET[del])){


if($udata[dostup] >= 2)
{
if(empty($_GET[del])){
echo"<hr/><font color=red><p>Не выбран пост!</p></font>";
}else{
$asd = mysql_query("SELECT * FROM gallery_kom WHERE id='".mysql_real_escape_string($_GET[del])."' LIMIT 1");
$avto=mysql_num_rows($asd);
if($avto==0){
echo'<hr/><font color=red><p>Нет такого поста!</p></font>';
}else{
mysql_query("DELETE FROM `gallery_kom` WHERE id='".mysql_real_escape_string($_GET[del])."' LIMIT 1");
echo'<hr/><font color=#084fc9><p>Пост успешно удалён!</p></font>';
}
}
}else{
echo "Ошибка!Доступ закрыт!";
}

}






//////////////////////////////		Коментарии	/////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET[kom])){


//-------------------------------------------
if (!empty($_POST[text])) // если естьтекст записуем сообщение
{

$msg = $_POST[text];
$msg = htmlspecialchars(stripslashes(trim($msg)));
$log = htmlspecialchars(stripslashes(trim($log)));
$currHour=date("H",time());
$currDate=date("d.m.Y", time());
$currTime=date("$currHour:i", time());

// пишем антифлуд
$req6546 = mysql_query("SELECT * FROM `gallery_kom` WHERE `usr` = '$log' && `id_tm` = '".mysql_real_escape_string($_GET[kom])."' ORDER BY id DESC LIMIT 1");
$pr = mysql_fetch_array($req6546);
if($pr[text] == $msg){
echo'<font color=#9E0000>Антифлуд!</font><br/>';}else{

$ressave = mysql_query("INSERT INTO `gallery_kom` SET
`id_tm` = '".mysql_real_escape_string($_GET[kom])."',
        `text` = '$msg',
        `data` = '$currDate в $currTime',
        `usr` = '$log'"); // создаем строку с ответом
		
		

		 
				if 		($ressave == 'true')	{echo "<hr><font color=#007F46>Сообщение добавленно!</font>";}
				else	{echo "<font color=red><p> Неудача ! </p></font>";}  // неудачно =)
}
}
//----------------------------------------------






$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_kom` WHERE `id_tm` = '".mysql_real_escape_string($_GET[kom])."'"), 0);


echo "<p><font color=#47ba82>Коментарии ($count2):</font></p>";


echo "<form method=\"post\" action=\"gallery.php?kom='.htmlspecialchars($_GET[kom]).'\">";
echo "Текст сообщения:<br/>";
echo "<textarea name=\"text\" rows=3></textarea><br/>";
echo "<input type=\"submit\" value=\"Отправить\" class=\"ibutton\"></form><hr/>";



//---выщитует страницы----------

$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_kom` WHERE `id_tm` = '".mysql_real_escape_string($_GET[kom])."'"), 0);
	if($count > 0){
		$pages = ceil($count/10);
		if(isset($_GET['page'])){
			$page = abs(intval($_GET['page']));
		}else{
			$page = 1;
		}
		$from = ($page-1)*10;
}
//-------------------------------

$req = mysql_query("SELECT * FROM `gallery_kom` WHERE id_tm = '".mysql_real_escape_string($_GET[kom])."' ORDER BY id DESC LIMIT $from, 10");
$avt = mysql_num_rows($req);

if($avt>=1)
{


function smilesmsg($string54545){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string54545=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="" height="30" width="30">',$string54545);
}}
closedir ($dir);
return $string54545;  }



While($tk = mysql_fetch_array($req))
{
$us = mysql_query("SELECT * FROM `users` WHERE usr = '$tk[usr]' LIMIT 1");
$usr = mysql_fetch_array($us);
if ($usr[dostup]>=4)						{$color = '<font color=lime>'; $color2 = '<font color=#5e995c>';}
if ($usr[dostup]==2 or $usr[dostup]==3)	{$color = '<font color=#0026FF>'; $color2 = '<font color=#6DC2FF>';}
if ($usr[dostup]==1) 					{$color = '<font color=#7F6A00>'; $color2 = '<font color=#A09353>';}
if ($usr[dostup]==0) 					{$color = ''; $color2 = '';}


if($udata[dostup]>=2){
$silka = " <a href=\"gallery.php?kom=$_GET[kom]&amp;del=$tk[id]\"><font color=red><small> [x] </small></font></a>";
}


$text = $tk[text];

$text = smilesmsg($text);
$text = nl2br($text);

echo "<div class=msg><a href=\"search.php?nick=$tk[usr]&amp;go=go\">$color $tk[usr] </font></a> <font color=grey><small>$tk[data]</small></font> $silka </div>
<div class=msg>
$color2 $text</font></div><hr/>";
}

echo "<div class=dot><p>";
	navig2($page, 'gallery.php?kom='.$_GET[kom].'&amp;', $pages);
echo "</p></div>";
	
}else{
echo "Сообщений нет<hr/>";}

//////////////////////////////////





echo"<br/><div class=silka><a href=\"/gallery.php?\">Назад</a></div>";

include($path.'inc/down.php');

}
















switch($_GET['mod']){
default:

// Переменная хранит число сообщений выводимых на станице
$num = 5;
// Извлекаем из URL текущую страницу
$page = $_GET['page'];
// Определяем общее число сообщений в базе данных
$result = mysql_query("SELECT COUNT(*) FROM `gallery`");
$posts = mysql_result($result, 0);
// Находим общее число страниц
$total = intval(($posts - 1) / $num) + 1;
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
// Вычисляем начиная к какого номера
// следует выводить сообщения
$start = $page * $num - $num;

$req=mysql_query("SELECT * FROM `gallery` ORDER by `id` DESC LIMIT $start, $num");

if(mysql_num_rows($req) > 0){

while($row = mysql_fetch_array($req)){

echo '<table><tr>';
echo '<td><a href=gallery.php?mod=big&id='.$row['id'].'><img src="pic/gallery/'.$row['foto'].'" width="90" height="90" alt="'.$row['user'].'" /></a></td>';
echo'<td><div align =left>Загрузил: <a href=search.php?nick='.$row['user'].'&go=go>'.$row['user'].'</a><br />
Описание: '.$row['koment'].'<br/>';
echo'<a href=gallery.php?mod=big&id='.$row['id'].'>Подробнее</a>|';
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_kom` WHERE `id_tm` = '$row[id]'"), 0);
echo "<a href=\"gallery.php?kom=$row[id]\"><font color=#47ba82>Коментарии ($count2)</font></a></div>";

echo"(<a href='gallery.php?mod=gallery_stat&type=plus&id_n=$row[id]'><img src='/pic/u.gif' alt='pic'> $row[plus] | <a href='gallery.php?mod=gallery_stat&type=minus&id_n=$row[id]'><img src='/pic/d.gif' alt='pic'> $row[minus]</a>)<div class=\"line\" style=\"clear: left\"></div>";
echo'</td><hr></tr></table>';

}

echo '<a href=gallery.php?mod=load>Загрузить фото</a>';

// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<br><a href=?page=1>1</a> ... ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' ... <a href=?page=' .$total. '>' .$total. '</a>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href=?page='. ($page - 2) .'>'. ($page - 2) .'</a>  ';
if($page - 1 > 0) $page1left = '<a href=?page='. ($page - 1) .'>'. ($page - 1) .'</a>  ';
if($page + 2 <= $total) $page2right = '  <a href=?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = '  <a href=?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

// Вывод меню

echo "<div class='pages'>";
echo $pervpage.$page2left.$page1left.'<b><span>'.$page.'</span></b>'.$page1right.$page2right.$nextpage;

}else{
echo 'Добавленых фотографий еще нет!<br />';
echo '<a href=gallery.php?mod=load>Загрузить фото</a>';
}

break;
case 'gallery_stat':
if($_GET['type'] == 'plus'){
$req = mysql_query("SELECT * FROM `gallery_stat` WHERE `id_news` = '".abs(intval($_GET['id_n']))."' and `nick` = '$log'");
if(mysql_num_rows($req) > 0){
echo 'Вы уже оценили это фото!';
include($path.'inc/down.php');
exit;
}
mysql_query("UPDATE `gallery` SET `plus`=`plus`+1 WHERE `id` = '".abs(intval($_GET['id_n']))."'");
mysql_query("INSERT INTO `gallery_stat` SET `nick` = '$log', `id_news` = '".abs(intval($_GET['id_n']))."'");
header('Location: gallery.php');
}
if($_GET['type'] == 'minus'){
$req = mysql_query("SELECT * FROM `gallery_stat` WHERE `id_news` = '".abs(intval($_GET['id_n']))."' and `nick` = '$log'");
if(mysql_num_rows($req) > 0){
echo 'Вы уже оценили это фото!';
include($path.'inc/down.php');
exit;
}
mysql_query("UPDATE `gallery` SET `minus`=`minus`+1 WHERE `id` = '".abs(intval($_GET['id_n']))."'");
mysql_query("INSERT INTO `gallery_stat` SET `nick` = '$log', `id_news` = '".abs(intval($_GET['id_n']))."'");
header('Location: gallery.php');
}
break;

case 'big':

$req = mysql_query("SELECT * FROM `gallery` WHERE `id` = '".abs(intval($_GET['id']))."'");
$row = mysql_fetch_array($req);

echo '<a href=pic/gallery/'.$row['foto'].'><img src="pic/gallery/'.$row['foto'].'" width="150" height="150" alt="'.$row['user'].'" /></a><br />
Загрузил: <a href=search.php?nick='.$row['user'].'&go=go>'.$row['user'].'</a><br />Описание: '.$row['koment'];
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_kom` WHERE `id_tm` = '$row[id]'"), 0);
echo "<br/><a href=\"gallery.php?kom=$row[id]\"><font color=#47ba82>Коментарии ($count2)</font></a>";
echo"(<a href='gallery.php?mod=gallery_stat&type=plus&id_n=$row[id]'><img src='/pic/u.gif' alt='pic'> $row[plus] | <a href='gallery.php?mod=gallery_stat&type=minus&id_n=$row[id]'><img src='/pic/d.gif' alt='pic'> $row[minus]</a>)<div class=\"line\" style=\"clear: left\"></div><hr>";


break;

case 'load':

if($_GET['ask'] == 2){



//проверяем загрузку файла на наличие ошибок
if($_FILES['uploadfile']['error'] > 0)
{
 //в зависимости от номера ошибки выводим соответствующее сообщение
 //UPLOAD_MAX_FILE_SIZE - значение установленное в php.ini
 //MAX_FILE_SIZE значение указанное в html-форме загрузки файла
 switch ($_FILES['uploadfile']['error'])
 {
 case 1: echo 'Размер файла превышает допустимое значение UPLOAD_MAX_FILE_SIZE'; break;
 case 2: echo 'Размер файла превышает допустимое значение MAX_FILE_SIZE'; break;
 case 3: echo 'Не удалось загрузить часть файла'; break;
 case 4: echo 'Файл не был загружен'; break;
 case 6: echo 'Отсутствует временная папка.'; break;
 case 7: echo 'Не удалось записать файл на диск.'; break;
 case 8: echo 'PHP-расширение остановило загрузку файла.'; break;
 }
 exit;
}
 
//проверяем MIME-тип файла
if($_FILES['uploadfile']['type'] != 'image/gif' && $_FILES['uploadfile']['type'] != 'image/png' && $_FILES['uploadfile']['type'] != 'image/jpeg')
{
 echo 'Вы пытаетесь загрузить не графический файл.';
 exit;
}
 
//проверяем не является ли загружаемый файл php скриптом,
//при необходимости можете дописать нужные типы файлов
$blacklist = array(".php", ".phtml", ".php3", ".php4");
foreach ($blacklist as $item)
{
 if(preg_match("/$item\$/i", $_FILES['uploadfile']['name']))
 {
 echo "Нельзя загружать скрипты.";
 exit;
 }
}
 
//папка для загрузки
$uploaddir = 'pic/gallery/';

if($_FILES['uploadfile']['type'] == 'image/gif'){
$type = '.gif';
}elseif($_FILES['uploadfile']['type'] == 'image/png'){
$type = '.png';
}elseif($_FILES['uploadfile']['type'] == 'image/jpeg'){
$type = '.jpeg';
}

//новое сгенерированное имя файла
$newFileName=date('YmdHis').rand(10,100).$type;
//путь к файлу (папка.файл)
$uploadfile = $uploaddir.$newFileName;
 
//загружаем файл move_uploaded_file
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){
echo '<font color=red>Вы успешно загрузили фотографию в галерею<br /><a href=gallery.php>Продолжить</a></font><hr>';

}else{
 echo "Ошибка загрузки файла.\n";
 }
//считываем содержания файла
$fp = fopen($uploadfile, 'r');
$contents = fread($fp, filesize ($uploadfile));
fclose($fp);

mysql_query("INSERT INTO `gallery` SET `koment` = '".mysql_real_escape_string($_POST['koment'])."', `foto` = '$newFileName', `user` = '$log'");



}

?>

<form enctype="multipart/form-data" action="gallery.php?mod=load&ask=2" method="post">
 Коментарий:<br />
<input name="koment" maxlength="500" title="koment"  /> <br/>
 Загружаемый файл:<br /><input type="file" name="uploadfile"><br />
 <input type="submit" value="Загрузить">
</form>

<?

break;


}
include($path.'inc/down.php');
?>