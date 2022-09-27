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

if ($udata[dostup]==5 or $log == KraToS){

switch($_GET[mod]){

default:
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<div class=adm>";
echo "<font color=grey><b><center>Изменение скилов</center><br/></b></font>";
echo' <a href="skill.php?mod=spisok">Все скилы </a>';

echo "</div>";

///////////////////// сохраняем изменения ///////////////////////
if ($_GET[mod]==save)
	{
	
if(!empty($_GET[skill]))  {$_POST[skill]=$_GET[skill];}
 
		$req = mysql_query("SELECT * FROM `shop_mag` where `lat_name`='$_POST[skill]'");
		$avto=mysql_num_rows($req);
		$skill = mysql_fetch_array($req);
		if($avto==0){
			echo"<font color=red><p>Нет такого умения!</p></font>";
					}else	{
			
	$res = mysql_query ("UPDATE shop_mag SET
        city='$_POST[city]',
        klas='$_POST[klas]',
        storona='$_POST[storona]',
        prof='$_POST[prof]',
        name='$_POST[name]',
        lat_name='$_POST[lat_name]',
        tip='$_POST[tip]',
        ruka='$_POST[ruka]',
        uron='$_POST[uron]',
        mp='$_POST[mp]',
        hp='$_POST[hp]',
        plushp='$_POST[plushp]',
        plusmp='$_POST[plusmp]',
        cena='$_POST[cena]',
        lv='$_POST[lv]',
        lvl='$_POST[lvl]',
        lvlmax='$_POST[lvlmax]',
        nead_res='$_POST[nead_res]'
		 WHERE lat_name='$_POST[skill]' LIMIT 1");



					if ($res == 'true')
					{
								echo "<font color=#007F7F><p>Сохраненно!</p></font>";
					}
					else
					{
								echo "<font color=red><p>Ошибка!</p></font>";
					}

	}						}
////////////////////////////////////////////////////////////////
if(!empty($_GET[skill]))  {$_POST[skill]=$_GET[skill];}
   
if(empty($_POST[skill])){
echo '<form action="?" method="post">';
echo"Название умения: (lat_name) - полное (Название 2)<br/>
<input class='input' type=\"text\" size=\"15\" value=\"$skill\" name=\"skill\"/><br/>";

echo '<input class="button" type="submit" value="Поехали" /></form>';
}else{

$req = mysql_query("SELECT * FROM `shop_mag` where `lat_name`='$_POST[skill]'");
$avto=mysql_num_rows($req);
$skill = mysql_fetch_array($req);
if($avto==0){
echo"<font color=red><p>Нет такого умения!</p></font>";
echo '<form action="?" method="post">';
echo"Название умения:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"$skill\" name=\"skill\"/><br/>";

echo '<input class="button" type="submit" value="Поехали" /></form>';

include($path.'inc/down.php');exit;}

// умение обнаруженно

echo "<p>Редактор <b>$_POST[skill]</b> (ID: $skill[id]) !</p><hr/>";

echo "<form action=\"?mod=save&skill=$_POST[skill]\" method=\"POST\">";

echo "Город: <br/>
<input type=\"text\" name=\"city\" size=\"50\" value=\"$skill[city]\" maxlength=\"25\"/> <hr/>";

echo "Клас: <br/>
<input type=\"text\" name=\"klas\" size=\"50\" value=\"$skill[klas]\" maxlength=\"25\"/> <hr/>";

echo "Сторона: <br/>
<input type=\"text\" name=\"storona\" size=\"50\" value=\"$skill[storona]\" maxlength=\"25\"/> <hr/>";

echo "Профа: <br/>
<input type=\"text\" name=\"prof\" size=\"50\" value=\"$skill[prof]\" maxlength=\"25\"/> <hr/>";

echo "Название 1 : <br/>
<input type=\"text\" name=\"name\" size=\"50\" value=\"$skill[name]\" maxlength=\"25\"/> <hr/>";

echo "Название 2: <br/>
<input type=\"text\" name=\"lat_name\" size=\"50\" value=\"$skill[lat_name]\" maxlength=\"25\"/> <hr/>";

echo "Тип: <br/>
<input type=\"text\" name=\"tip\" size=\"50\" value=\"$skill[tip]\" maxlength=\"25\"/> <hr/>";

echo "Рука: <br/>
<input type=\"text\" name=\"ruka\" size=\"50\" value=\"$skill[ruka]\" maxlength=\"25\"/> <hr/>";

echo "Урон (разделять \"|\"): <br/>
<textarea name=\"uron\" rows=3 cols=45 wrap=\"off\">$skill[uron]</textarea> <hr/>";

echo " -MP (разделять \"|\"): <br/>
<textarea name=\"mp\" rows=3 cols=45 wrap=\"off\">$skill[mp]</textarea> <hr/>";

echo " -HP (разделять \"|\"): <br/>
<textarea name=\"hp\" rows=3 cols=45 wrap=\"off\">$skill[hp]</textarea> <hr/>";


echo " +HP (разделять \"|\"): <br/>
<textarea name=\"plushp\" rows=3 cols=45 wrap=\"off\">$skill[plushp]</textarea> <hr/>";

echo " +MP (разделять \"|\"): <br/>
<textarea name=\"plusmp\" rows=3 cols=45 wrap=\"off\">$skill[plusmp]</textarea> <hr/>";

echo " Цена SP (разделять \"|\"): <br/>
<textarea name=\"cena\" rows=3 cols=45 wrap=\"off\">$skill[cena]</textarea> <hr/>";

echo " Уровни (разделять \"|\"): <br/>
<textarea name=\"lv\" rows=3 cols=45 wrap=\"off\">$skill[lv]</textarea> <hr/>";

echo " С какого уровня (разделять \"|\"): <br/>
<textarea name=\"lvl\" rows=3 cols=45 wrap=\"off\">$skill[lvl]</textarea> <hr/>";

echo " Макс уровень (разделять \"|\"): <br/>
<textarea name=\"lvlmax\" rows=3 cols=45 wrap=\"off\">$skill[lvlmax]</textarea> <hr/>";

echo " Ресурсы (AnimalSkin,27|AnimalBone,5): <br/>
<textarea name=\"nead_res\" rows=3 cols=45 wrap=\"off\">$skill[nead_res]</textarea> <hr/>";

echo "<input type=\"submit\" value=\"Изменить\" class=\"ibutton\">";

}
echo"<br/><div class=silka>		<a href=\"/gm/\">Назад</a>			</div>";

break;


case 'spisok';

echo "<hr/>";
$req = mysql_query("SELECT * FROM `shop_mag` WHERE `id`>='0' ORDER BY `id` ASC");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo"<div class=inoy><a href=\"skill.php?skill=$mag[lat_name]\"> <font color=orange>$mag[id])</font> <b><font color=green>$mag[lat_name]</font></b> | $mag[klas] | $mag[storona]</a></div>";
}
}else{
echo"<b>Скилов нет</b><br/>";
}

break;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{

echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
}
include($path.'inc/down.php');
?>