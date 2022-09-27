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

if ($udata[dostup] >= 4){

echo "<p><hr/></p><center>";

echo"<a href=\"?nw\">Загрузить аватар</a>";

echo" | <a href=\"?spisok\">Уже с аватарками</a>";

echo "</center><p><hr/></p>";

//-------------------------- уже с аватарками вывод ---------------------------------


if (isset($_GET[spisok])){

if (isset($_GET[sp_del])){
unlink('../foto/'.$_GET[sp_del].'');
echo "<p><font color=red>Удаленно аву перса $_GET[sp_del] </font></p><hr/>";
}

echo "<p>Уже с аватарками !!! (Клацнув на аву вы её удалите)</p><br/>";
if(empty($_GET[name])){}

$dira = opendir ("../foto/");
while ($filea = readdir ($dira)) 
{if (( $filea != ".") && ($filea != ".."))
{$aa[]=$filea;}}
closedir ($dira);
$totala = count($aa);

for ($ia = 0; $ia < $totala; $ia++){

$data_namea[]=$aa[$ia];
}

foreach($data_namea as $ka=>$va)
{
$dat_screena[]="<div class=inoy><a href=\"?spisok&sp_del=$data_namea[$ka]\"><img src=\"../foto/$data_namea[$ka]\" alt=\"\"/><br/>$data_namea[$ka]</a></div>";

}


$totala = count($dat_screena);



if (empty($_GET['logs'])) $logs = 0;
else $logs = $_GET['logs'];
if ($totala < $logs + 10){ $end = $totala; }
else {$end = $logs + 10; }
for ($ia = $logs; $ia < $end; $ia++){

echo"$dat_screena[$ia]";

}

echo "<div class=menu><br/>";
if ($logs != 0) {echo '<a href="home.php?logs='.($logs - 10).'&amp;mod=logo"> назад</a> ';}
if ($totala > $logs + 10) {echo ' <a href="home.php?logs='.($logs + 10).'&amp;mod=logo">вперёд</a>';}

echo"<br/>Всего: $totala эмблем<br/>";






}

// --------------------------- загрузка аватара ------------------------------------


if (isset($_GET[nw])){


echo '
<p><b> Форма для загрузки файлов </b></p></h2>
Файл не должен превышать размеры более чем 128х210 пикселей <br/><br/>
Загружать только файлы формата <b>gif</b> <br/><br/>
<form action=?yes method=post enctype=multipart/form-data>
 
 <hr/> Укажите ник персонажа:<br/>

 
 <input type=text name=nw> <br/><br/>

  Выбор аватара:<br/>

 <input type=file name=uploadfile><br/>
 
 <input type=submit value=Загрузить></form>';
	}  
	  

if (isset($_GET[yes])){
	
//---------------
	
	  echo "<p><b>Результат</b></p><hr/>";


  
	  
if ($_FILES['uploadfile']['type']=="image/gif"){

	  
// Каталог, в который мы будем принимать файл:
$uploaddir = '../foto/';
$uploadfile = $uploaddir.basename($_POST['nw'].'.gif');

// Копируем файл из каталога для временного хранения файлов:
if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
{

$size = getimagesize($uploadfile); // с помощью этой функции мы можем получить размер пикселей изображения 
if ($size[0] < 129 && $size[1]<211) { // если размер изображения не более 128 пикселей по ширине и не более 210 по высоте 
}else {echo "Размер пикселей превышает допустимые нормы (ширина не более - 128 пикселей, высота не более 210)";
 unlink($uploadfile); // удаление файла 
 
   include($path.'inc/down.php'); exit; 
   }

echo "<h3>Файл успешно загружен на сервер для персонажа $_POST[nw]</h3>";

}
else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3> $uploaddir "; include($path.'inc/down.php'); exit; }
// тип файла не подходит
}else{ echo "<h3>Ошибка! Формат файла не подходит!</h3> $uploaddir "; include($path.'inc/down.php'); exit; }

// Выводим информацию о загруженном файле:
/*
echo "<h3>Информация о загруженном на сервер файле: </h3>";
echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadfile']['type']."</b></p>";
echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadfile']['size']."</b></p>";
echo "<p><b>Временное имя файла: ".$_FILES['uploadfile']['tmp_name']."</b></p>";
*/

//-------------------   
}

}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
}
include($path.'inc/down.php');
?>