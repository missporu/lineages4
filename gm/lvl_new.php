<?
define('PROTECTOR', 1);

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel New LvL';
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

switch($_GET[mod]){

default:
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$asd = mysql_query("SELECT * FROM lvl ORDER BY `lvl` DESC LIMIT 1");
$lv = mysql_fetch_array($asd);

if(!empty($_POST[exp]))  {
//--проверка---
if ($lv[exp]<$_POST[exp]){ // новые значения выше обезательно
//-------------
$lv[lvl]++; // на один выше чем есть
mysql_query("INSERT INTO `lvl` SET `lvl` = '$lv[lvl]', `exp` = '$_POST[exp]'"); // пишем результат
}}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  

$asd2 = mysql_query("SELECT * FROM lvl ORDER BY `lvl` DESC LIMIT 1");
$lv = mysql_fetch_array($asd2);
$lv[lvl] = $lv[lvl]+2;

  
$asd = mysql_num_rows(mysql_query("SELECT * FROM lvl")); // сколько уровней

   echo "<hr/><p><b><font color=grey> В игре $asd уровн. </font></b></p><hr/>";

echo "<div class=dot>";
echo '<form action="lvl_new.php?" method="post">';
echo" <b><font color=green> Создать </font><br/> ";
echo" Next LvL: ".number_format($lv[lvl], 0, ',', "`")." <br/> ";
echo" Next EXP (опыт): </b><br/> <input class='input' type=\"text\"  value=\"$lv[exp]\" name=\"exp\"/> <br/>";
echo '<input class="button" type="submit" value="Добавить" /></form></center>';
echo "</div>";



//////////
// Выводим уровни

echo "<hr/>";

   if($_GET['page']<=0){
		$page = 1;
		}else{
		$page = intval($_GET['page']);
		}
		$from = ($page-1)*10;
		
		        $avto = mysql_num_rows(mysql_query("SELECT `lvl` FROM `lvl`"));
            $pages1=$avto/10;
            $pages=round($avto/10);
            if($pages1>$pages){
            $pages=$pages+1;
            }


$reqvh = mysql_query("SELECT * FROM `lvl` ORDER BY `lvl` DESC LIMIT $from,10");
$avto=mysql_num_rows($reqvh);
if ($avto>0){ 

echo '<div style="vertical-align:top;width:100%;border:solid;border-width:1px;color:#993300;padding:3px">';

echo '<center>
<table style="width:100%" cellspacing="0" cellpadding="0"><tr>
<td style="vertical-align:top;width:19%;border: 2px double;border-width:1px;color:#3366FF;padding:2px">
 Уровень </td><td style="vertical-align:top;width:19%;border: 2px double;border-width:1px;color:#3366FF;padding:2px">
 Опыт </td></tr></table></center>
';


While($lvl = mysql_fetch_array($reqvh))
{
$lvl[lvl]++; // уровень будет при таком опыте
echo '<center>
<table style="width:100%" cellspacing="0" cellpadding="0"><tr>
                   <td style="vertical-align:top;width:19%;border: 2px double;border-width:1px;color:#3366FF;padding:2px">
'.number_format($lvl[lvl], 0, ',', "`").' </td><td style="vertical-align:top;width:19%;border: 2px double;border-width:1px;color:#3366FF;padding:2px">
'.number_format($lvl[exp], 0, ',', "`").' </td></tr></table></center>
';
}
echo '</div>';}
else{echo "<br/><p><b><u>Нет уровней</b></u><br/><br/></p>";}
// -------------------------

echo "</div><hr><p>Страниц: "; navig2($page, '?', $pages);


echo "<hr/>";
echo "<br/><a href=\"/gm/\">Назад</a></div>";




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
break;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
}
include($path.'inc/down.php');
?>