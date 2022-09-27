<?php
define('PROTECTOR', 1);

$headmod = 'chat';//фикс. места

$textl='Чат';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


//----------------------------------
//		ЧАТ ОТКЛЮЧИТЬ/ВКЛЮЧИТЬ
if (isset($_GET[chat_off]) and $udata[dostup]>=2){ //Отключить
mysql_query("UPDATE `option_game` SET `chat` = 'off' WHERE `id` = '1'");
header ("Location: chat.php?",false);exit;}

if (isset($_GET[chat_on]) and $udata[dostup]>=2){ //Отключить
mysql_query("UPDATE `option_game` SET `chat` = 'on' WHERE `id` = '1'");
header ("Location: chat.php?",false);exit;}

//----------------------------------


//---------------------------------------------------------


$in_chat = mysql_query("SELECT chat FROM option_game WHERE id = '1' LIMIT 1");
$iiii =mysql_fetch_array ($in_chat);
if ($iiii[chat]=='off'){
echo "<div class=msg><p>Чат на некоторое время закрыт Администрацией!</p></div>";
if ($udata[dostup]>=2){
echo "<div class=inoy> <a href=\"/chat.php?chat_on\"><font color=green>Открыть чат</font></a> </div>";}
include($path.'inc/down.php');
	exit;
}else{
//---------------------------------------------------------



// при входе в чат чистим таблу с плюсиком
mysql_query("DELETE FROM chat_otv WHERE `usr`='$log'");



switch($_GET[mod]){

default:


function smiles($string){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string=str_replace(":$file2",' <img src="pic/smiles/'.$file.'" alt="" > ',$string);
}}
closedir ($dir);
return $string;  }
/////////////
$rand = rand(1000,9999);
///////////////////

echo'<div class="hid" align="left"><div class=chat2>';

echo "<b>Комнаты:</b>  Общий чат </a>  | 
 <a href=\"tchat.php?\"> Торговый </a><br/><br/>" ;


echo '<a href="smile.php?">Смайлы</a> | ';
echo '<a href="bbcode.php?">ББ коды</a><br/>';
echo "<a href=\"chat.php?r=$rand\">Обновить</a>";
echo "<form action=\"chat.php?mod=writes\" method=\"POST\" name=\"guestbook\">";

if (isset($_GET[otv])){$nick = "$_GET[otv], ";}

echo //"	<input type=\"text\" name=\"zin\" maxlength=\"5000\"/> 
		"	<textarea name=\"zin\" rows=\"2\" maxlength=\"5000\">$nick</textarea><br/>";
		
echo "<input type=\"submit\" value=\"Написать\" class=\"ibutton\">";


echo'</div>';

if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = htmlspecialchars($_GET[page]) + 1;
$back = htmlspecialchars($_GET[page]) - 1;
$num = htmlspecialchars($_GET[page]) * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/10);
$times = date("H:i");
//echo "<center>-=$times=-</center>";
$asd = mysql_query("SELECT * FROM komentarai ORDER BY id DESC LIMIT $num,10");
echo"<div align='left'>";
while($dsa = mysql_fetch_array($asd))
{
$nickas = strip_tags($dsa['nick']);
$koment = $dsa['komentaras'];
$time = strip_tags($dsa['time']);
$koment = smiles(bb_code($koment));


$reqs = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nickas'");
$ud = mysql_fetch_array($reqs);

//////////
$avtos= mysql_num_rows(mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$nickas."' LIMIT 1"));
if($avtos==1){
$color= mysql_fetch_array(mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$nickas."' LIMIT 1"));
$font = '<font color='.$color[color].'>';
$fonts = '</font>';
}else{
$font = '';
$fonts = '';
}
///////
//картинка клана /////////////////////////////
$pic = "";
if(!empty($ud[clan])){
$req6546566 = mysql_query("SELECT `emblema` FROM `clan` WHERE `lider` = '$ud[clan]' LIMIT 1");
$wh = mysql_fetch_array($req6546566);

if(!empty($wh[emblema])){
$pic = "<img src=\"pic/clan/$wh[emblema]\" alt=\"cl\"/>";}}
////////////////////////////////////////////////
$antiyou = "<img src=\"pic/smiles/align2.gif\" alt=\"antiyou\"/>";


if($udata[dostup]>=2){
$silka = " <a href=\"chat.php?mod=del_post&amp;p=$dsa[id]\"><font color=red>[X]</font></a>";
}
if($log=='Shiki'){
$silka2 = " <a href=\"chat.php?mod=red_post&amp;p=$dsa[id]\"><font color=aqua>[red]</font></a>";
}



if($ud[dostup]==5)
{
$nickas1=str2gradient("$nickas.GM", "f11717", "FFFF00");
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b>$font $koment $fonts";
}else{
if ($ud[dostup]==4)
{
$nickas1=str2gradient("$nickas.ADM", "FFA500", "21f117");
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b>$font $koment $fonts";
}else{
if ($ud[dostup]==3)
{
$nickas1=str2gradient("$nickas.SMD", "00FFFF", "FF0000");
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b>$font $koment $fonts";}else{
if ($ud[dostup]==2){ 
$nickas1=str2gradient("$nickas.MD", "551A8B", "AB82FF");
echo " 
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a> 
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b>$font $koment $fonts";
}else{
if ($ud[dostup]==1){ 
$nickas1=str2gradient("$nickas.K", "00FF7F", "1E90FF"); 
echo " 
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a> 
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b>$font $koment $fonts";
}else{

// если есть цветной ник, то грузим цвет
$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$nickas' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$colors = mysql_fetch_array($req222);

echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#$colors[color]> $nickas</font></a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b> $font $koment $fonts ";
}else{


///////////////////////////////////////
if ($dsa['nick']!=='AntiYou')
{
echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"> $nickas</font></a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka $silka2</a>
:<br/></b> $font $koment $fonts ";
}}}}}
}}

echo'<br/>';
}
echo "<hr/></div>";
if($udata[dostup] >= 2)
{
echo "<br/><div class=inoy><a href=\"chat.php?mod=trinti\">Удалить все сообщения</a></div>";
echo "<div class=inoy> <a href=\"?chat_off\"><font color=red>Закрыть чат</font></a></div>";
}
echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

if ($_GET[page] > 0)
{
echo "<a href=\"chat.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"chat.php?page=$next\">Далее</a>";}
else
{echo "Далее";}
echo "</div>";
break;

case 'red_post';
if($log!='Shiki'){echo'Для вас доступ закрыт!';include('inc/down.php');exit;}
$msg = mysql_fetch_array(mysql_query("SELECT * FROM `komentarai` WHERE `id` = '".html($_GET[p])."' LIMIT 1"));

echo '<form action="?mod=red_posts&amp;p='.html($_GET[p]).'" method="post" name="form">';
echo 'Сообщение:<br/><textarea name="text" rows="3">'.$msg['komentaras'].'</textarea><br/>';
echo '<input name="submit" type="submit" value="Редактировать" /></form></div>';
break;
case 'red_posts';
$text = html($_POST['text']);
mysql_query("UPDATE `komentarai` SET `komentaras` = '$text' WHERE `id` = '".html($_GET[p])."' LIMIT 1");
echo'Сообщение отредактировано';
break;
case 'del_post':
if($udata[dostup] >= 2)
{
if(empty($_GET[p])){
echo"Не выбран пост!<br/>";
}else{
$asd = mysql_query("SELECT * FROM komentarai WHERE id='".mysql_real_escape_string($_GET[p])."' LIMIT 1");
$avto=mysql_num_rows($asd);
if($avto==0){
echo'Нет такого поста!<br/>';
}else{
mysql_query("DELETE FROM `komentarai` WHERE id='".mysql_real_escape_string($_GET[p])."' LIMIT 1");
echo'Пост успешно удалён!<br/>';
echo "<a href=\"chat.php?\">Назад</a>";
}
}
}else{
echo "Ошибка!Доступ закрыт!";
}
break;

case 'write':

echo"<b>Сообщение</b><br/>";
echo "<form action=\"chat.php?mod=writes\" method=\"POST\">";
if (isset($_GET[nick]))
{
$_GET[nick] = htmlspecialchars($_GET[nick]);
//echo "<input type=\"text\" name=\"zin\" maxlength=\"250\" value=\"$_GET[nick], \" size=\"20\"/><br/>";
echo "<textarea name=\"zin\" rows=\"3\" maxlength=\"5000\">$_GET[nick], </textarea><br/>";


}
else
{
echo "<textarea name=\"zin\" rows=\"3\" maxlength=\"5000\">$_GET[nick], </textarea><br/>";
}
echo "<input type=\"submit\" value=\"Ok\" class=\"ibutton\"><br/>";
echo "<div class=silka><a href=\"chat.php?\">Назад</a></div>";
break;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
case 'writes':

if ($udata[time]<600){
echo "<b>В чате можно писать проведя 10минут в игре! </b>";
					echo"<br/><br/><a href=\"chat.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}

$msg=$_POST['zin'];

// пишем защиту от повтора сообщений
$pov = mysql_fetch_array(mysql_query("SELECT * FROM komentarai WHERE nick = '$log' ORDER BY id DESC LIMIT 1"));

if ($pov[komentaras]==$msg){
echo "<b>Спам. Запрещенно писать одинаковые сообщения! </b>";
					echo"<br/><br/><a href=\"chat.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}

////////	Добавляем плюс в чат 	///////////////////
$ch_o = explode(",", $msg);


$avt_usr = mysql_num_rows(mysql_query("SELECT usr FROM users WHERE usr = '$ch_o[0]'"));
$avt_cha = mysql_num_rows(mysql_query("SELECT usr FROM chat_otv WHERE usr = '$ch_o[0]'"));
if ($avt_usr > 0 and  $avt_cha == 0){
mysql_query("INSERT INTO `chat_otv` (`id`, `usr`, `time`) VALUES (NULL, '$ch_o[0]', '$timec' )");
}


//////////////////////////////////////////////////

$msg = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|. mobi|. ua|. tk|. ru|. org|. net|. info|. com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line| war|la2|la3)", "Реклама запрещена", $msg);
$msg = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|. mobi|. ua|. tk|. ru|. org|. net|. info|. com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line| war|la2|la3)", "Реклама запрещена", $msg);

$msg=eregi_replace("(СУКА|ХУЙ|ХУИ|ХУЁ|ХУЕ|ИПАЛ|АХХУЕН|ПИТБ|ХУЯ|ХУУ|АХУЕ|ОХУЕ|ХУЕЛ|ОХУИ|ОХУУ|ОХИУ|ОХУЮ|АХУИ|АХИИ|АХИЕ|АХУУ|АХИУ|ПИЗД|ПИСД|ПЫЗД|ПЫСД|ПИЦД|ПЕЗД|ПЕСД|БЛЯД|БЛЯ|БЛАД|БЛЯТ|БЛАТЬ|БЛЙАД|БЛЙАТ|БЛИАД|БЛИАТ| ЕБ|ЙОБ|ИОБ|ЪЕБ|АЁБ|АЁП|АЕБ|АЙОБ|АИОБ|ОЁБ|ОЕБ|УЁБ|УЁП|УЕБ|УЙОБ|УИОБ|ИЕБ|ЫЕБ|МУДИ|МУДА|ЧЛЕН|ЧЛЕП|ПИДОР|ПИДАР|НИДОР|НИДАР|ПЕДИ|ЧМО|ЖОП|ДРАЧИ|ДРАЦХИ|ТВАЮ|ПОЦ|САСИ| ЛОХ| ЛОШ|ЕДРИ|ХЕР|ПИДО|ГОНД|МАНД|ЗАЛУП|ОТХУ|СУЧЕ|СРАН|МУДО|ДАРАС|БАЛЬНИК|СЦУКА)", "***", $msg);
$msg=eregi_replace("(сука|хуй|хуи|хеё|хуе|ипал|аххуен|питв|хуя|ахуе|охуе|хуел|охуи|ахие|пизд|писд|пызд|пысд|пицд|пезд|песд|бляд|бля|блят|блять|блйад|блйат|блиад|блиат|уёбок|уебок|уйоб|член|члеп|пидор|пидар|нидор|нидар|педик|чмо|драчи|драчун|дроч|саси|лох|хер|пидо|гонд|залуп|сучка|дарас|бальник|сцука)", "***", $msg);


$msg=substr($msg, 0, 512);
$msg=stripslashes(htmlspecialchars($msg));
$msg=str_replace("\r\n","<br />",$msg);
$msg=str_replace("\r","<br />",$msg);
$msg=str_replace("\n","<br />",$msg);
$msg = addslashes($msg);
$msg=preg_replace ("|[\r\n]+|si","",$msg);
$a = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai WHERE komentaras = '$msg'"));
$b = mysql_fetch_array(mysql_query("SELECT kada FROM komentarai WHERE nick = '$log' ORDER BY kada DESC LIMIT 1"));
$data_kom = strip_tags($b['kada']);
$data = date("y/m/d H:i:s", strtotime("+20 seconds"));
$data_dbr = date("y/m/d H:i:s");
$time = date("H:i");
if($data_dbr >= $data_kom && $msg != "")
{
mysql_query("INSERT INTO komentarai SET nick = '$log', komentaras = '$msg', kada = '$data', time = '$time'");
mysql_query("UPDATE `users` SET `post` = `post` + 1 WHERE `usr` = '".$log."'");
$rand = rand(1000,9999);
//start
function smiles($string){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="">',$string);
}}
closedir ($dir);
return $string;  }



/////////////
$rand = rand(1000,9999);
///////////////////
echo'<div class="hid" align="left">';
echo "<a href=\"smile.php?\">Смайлы</a><br/>";
echo "<a href=\"chat.php?r=$rand\">Обновить</a>";
echo "<form action=\"chat.php?mod=writes\" method=\"POST\">";
echo //"<input type=\"text\" name=\"zin\" maxlength=\"5000\"/> 
		"	<textarea name=\"zin\" rows=\"3\" maxlength=\"5000\"></textarea><br/>
<input type=\"submit\" value=\"Написать\" class=\"ibutton\"></div>";

if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/10);
$times = date("H:i");
//echo "<center>-=$times=-</center>";
$asd = mysql_query("SELECT * FROM komentarai ORDER BY id DESC LIMIT $num,10");
echo"<div align='left'>";
while($dsa = mysql_fetch_array($asd))
{
$nickas = strip_tags($dsa['nick']);
$koment = $dsa['komentaras'];
$time = strip_tags($dsa['time']);
$koment = smiles($koment);

$reqs = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nickas'");
$ud = mysql_fetch_array($reqs);

//----
$avtos= mysql_num_rows(mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$nickas."' LIMIT 1"));
if($avtos==1){ 
$color= mysql_fetch_array(mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$nickas."' LIMIT 1"));
$font = '<font color='.$color[color].'>'; 
$fonts = '</font>'; 
}else{ 
$font = ''; 
$fonts = ''; 
}
//-----
//картинка клана /////////////////////////////
$pic = "";
if(!empty($ud[clan])){
$req6546566 = mysql_query("SELECT `emblema` FROM `clan` WHERE `lider` = '$ud[clan]' LIMIT 1");
$wh = mysql_fetch_array($req6546566);

if(!empty($wh[emblema])){
$pic = "<img src=\"pic/clan/$wh[emblema]\" alt=\"cl\"/>";}}
////////////////////////////////////////////////
$antiyou = "<img src=\"pic/smiles/align2.gif\" alt=\"antiyou\"/>";

if($udata[dostup]>=2){
$silka = " <a href=\"chat.php?mod=del_post&amp;p=$dsa[id]\"><font color=red>x</font></a>";
}

if($ud[dostup]==5) 
{ 
$nickas1=str2gradient("$nickas.GM", "f11717", "FFFF00"); 
echo " 
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a> 
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a> 
:<br/></b>$font $koment $fonts"; 
}else{ 
if ($ud[dostup]==4) 
{ 
$nickas1=str2gradient("$nickas.ADM", "FFA500", "21f117"); 
echo " 
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a> 
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a> 
:<br/></b>$font $koment $fonts"; 
}else{
if ($ud[dostup]==3) 
{ 
$nickas1=str2gradient("$nickas.SMD", "00FFFF", "FF0000"); 
echo " 
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a> 
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a> 
:<br/></b>$font $koment $fonts";}else{ 
if ($ud[dostup]==2){  
$nickas1=str2gradient("$nickas.MD", "551A8B", "AB82FF"); 
echo "  
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a>  
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a>  
:<br/></b>$font $koment $fonts"; 
}else{ 
if ($ud[dostup]==1){  
$nickas1=str2gradient("$nickas.K", "00FF7F", "1E90FF");  
echo "  
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\">$nickas1</a>  
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a>  
:<br/></b>$font $koment $fonts"; 
}else{
// если есть цветной ник, то грузим цвет
$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$nickas' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$colors = mysql_fetch_array($req222);

echo "
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"><font color=#$colors[color]> $nickas</font></a>
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a>
:<br/></b> $koment ";
}else{


///////////////////////////////////////
if ($dsa['nick']!=='AntiYou')
{
echo " 
<hr/><b>[$time] $pic <a href=\"search.php?nick=$nickas&amp;go=go\"> $nickas</font></a> 
<a href=\"chat.php?otv=$nickas\"> [отв] $silka</a> 
:<br/></b> $font $koment $fonts ";
}}}}}
}}

echo'<br/>';
}
echo "<hr/></div>";
if($udata[dostup] >= 2)
{
echo "<br/><div class=inoy><a href=\"chat.php?mod=trinti\">Удалить все сообщения</a></div>";
echo "<div class=inoy> <a href=\"?chat_off\"><font color=red>Закрыть чат</font></a></div>";
}
echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

if ($_GET[page] > 0)
{
echo "<a href=\"chat.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"chat.php?page='.htmlspecialchars($next).'\">Далее</a>";}
else
{echo "Далее";}
echo "</div>";
//end
}
elseif($data_dbr < $data_kom)
{
$sec = $data_kom-$data_dbr;
$rand = rand(1000,9999);
echo "Защита от Флуда! Подождите $sec секунд<br/>";
echo"<a href=\"chat.php?r=$rand\">Продолжить</a>";
}
elseif($msg == "")
{
$rand = rand(1000,9999);
echo "Вы не написали сообщение!<br/>";
echo"<a href=\"chat.php?r=$rand\">Продолжить</a>";
}
else
{
$rand = rand(1000,9999);
echo "Ошибка!<br/>";
echo"<a href=\"chat.php?r=$rand\">Продолжить</a>";
}
break;

case 'trinti':

if($udata[dostup] >= 2)
{
mysql_query("DELETE FROM komentarai");
echo "Все сообщения удалены!";
echo "<br/><a href=\"chat.php?\">Назад</a><br/></div>";
}
else
{
echo "Ошибка!Доступ закрыт!<br/></div>";
}
break;
}
}
include($path.'inc/down.php');
?>