<?php
define('PROTECTOR', 1);

$headmod = 'msg';//фикс. места

$textl='Письма';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


echo "<p><font color=#057F46><b>Ваша почта:</b></font></p><hr/>";


switch($_GET[mod]){

default:
$q = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`!='Система' AND `user_from`!='Рассылка от администрации' AND `read` = '1';");
$new_mail = mysql_result($q, 0);
$w = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`!='Система' AND `user_from`!='Рассылка от администрации'");
$old_mail = mysql_result($w, 0);
$qo = mysql_query("SELECT COUNT(*) FROM `msg_i` WHERE `user_from` = '$log'");
$new_mailo = mysql_result($qo, 0);

$sys = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`='Система' AND `read` = '1';");
$new_sys = mysql_result($sys, 0);
$osys= mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`='Система'");
$old_sys = mysql_result($osys, 0);


$ras = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`='Рассылка от администрации' AND `read` = '1';");
$new_ras = mysql_result($ras, 0);
$oras= mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`='Рассылка от администрации'");
$old_ras = mysql_result($oras, 0);

echo "<div class=inoy>";
echo "<a href=\"msg.php?mod=add_conts\">Новый контакт</a>";
echo "<a href=\"msg.php?mod=read\">Входящие <font color=#ffffff>[+$new_mail/$old_mail]</font></a>";
echo "<a href=\"msg.php?mod=vxod\">Исходящие <font color=#ffffff>[$new_mailo]</font></a>";
echo "<a href=\"msg.php?mod=sys\">Системные <font color=#ffffff>[+$new_sys/$old_sys]</font></a>";
echo "<a href=\"msg.php?mod=ras\">Рассылки <font color=#ffffff>[+$new_ras/$old_ras]</font></a>";
echo "<a href=\"msg.php?mod=write_message\">Мои контакты</a>";
echo "<br/><a href=\"msg.php?mod=delete_all\">Очистить почту</a><br/>";
echo "</div><br/>";
echo"<div class=silka><a href=\"main.php?\">Назад</a></div>";
break;

case 'add_conts':
echo "<form action=\"msg.php?mod=save_conts\" method=\"post\">Игрок:<br/>";
echo "<input type=\"text\" value=\"$nk\" name=\"nick\"><br/>";
echo "<input type=\"submit\" value=\"Поиск\" class=\"ibutton\"></form>";

echo "<br/><a href=\"msg.php?\">Назад</a>";
break;

case 'write_message':

echo "<form method=\"post\" action=\"msg.php?mod=save_message\">Кому:";
echo "&nbsp;&nbsp;<select name=\"to\">";
$using = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log'");
$u2 = mysql_fetch_array($using);
$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `users`"),0);
$whiel = mysql_query("SELECT contact FROM `msg_users` WHERE `usr` = '$u2[usr]'");
$lists = mysql_fetch_array($whiel);
do{
printf("<option value=\"%s\">%s</option><br/>",$lists[contact],$lists[contact]);
} while($lists = mysql_fetch_array($whiel));
echo "</select><br/>";
echo "Текст письма:<br/>";
echo "<textarea name=\"text\" rows=3></textarea><br/><br/>";
echo "<input type=\"submit\" value=\"Отправить\" class=\"ibutton\"></form>";
echo "<br/><a href=\"msg.php?\">Назад</a><br/>";
break;

case 'wr':
if(!empty($_GET[go_user])){
echo "<form method=\"post\" action=\"msg.php?mod=save_info&amp;to=$_GET[go_user]\">Кому:<b>$_GET[go_user]</b>";
echo "<br/>Текст письма:<br/>";
echo "<textarea name=\"text\" rows=3></textarea><br/><br/>";
echo "<input type=\"submit\" value=\"Отправить\" class=\"ibutton\"></form>";
echo"<br/><a href=\"msg.php?\">Назад</a><br/>";
}else{
echo'Не выбран получатель!';
}
break;

case 'save_info':

		if($udata[time]<3600){				
echo "<p>Для общения в почте нужно провести на сайте 1час!</p>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');}


// проверяем не закрыл игрок почту
$reqch = mysql_query("SELECT * FROM `options` where `usr`='".mysql_real_escape_string($_GET[to])."' LIMIT 1");
$avtoch=mysql_num_rows($reqch);
$priv = mysql_fetch_array($reqch);

if($avtoch>0) { //делаем двойное условие
				// если есть таблицы почта включена
		if($priv[privat]==no && $udata[dostup]<2){				
echo "<p>Игрок закрыл свою почту!</p>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');

}}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// игнор лист //--------------
$reqtmp = mysql_query("SELECT * FROM `msg_ignor` WHERE `contact` = '$log' and `usr` = '".mysql_real_escape_string($_GET[to])."' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){
echo'<p>Вы находитесь в игноре у этого персонажа!</p>';
echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');
exit;
}
//////////////////////////////
if ($_POST[text] != "" && $_GET[to] != "")
{
if (isset($_POST[text]))
{
$text = htmlspecialchars(stripslashes($_POST[text]));
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
}
if (isset($_GET[to]))
{
$to = $_GET[to];
}
$time = date("H:i d.m.y");


mysql_query("INSERT INTO `msg_r` SET `user_from` = '$log', `user_to` = '$to', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
mysql_query("INSERT INTO `msg_i` SET `user_from` = '$log', `user_to` = '$to', `time` = '$time',`mail_msg` = '$text'");

echo "Вы успешно отправили письмо для $to<br/> Дата отправления: $time";

echo "<br/><a href=\"msg.php?\">Назад</a><br/>";
}
elseif ($_POST[text] == "" ||  $_POST[text] == null )
{
echo "Вы не ввели текст письма<br/>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
elseif ($_GET[to] == "" || $_GET[to] == null)
{
echo "Не выбран отправитель!<br/>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
else 
{
echo "Ошибка!<br/>";

echo "<a href=\"msg.php?\">Назад</a><br/>";
}
break;

case 'save_message':


// проверяем не закрыл игрок почту
$reqch = mysql_query("SELECT * FROM `options` where `usr`='".mysql_real_escape_string($_POST[to])."' LIMIT 1");
$avtoch=mysql_num_rows($reqch);
$priv = mysql_fetch_array($reqch);

if($avtoch>0) { //делаем двойное условие
				// если есть таблицы почта включена
		if($priv[privat]==no && $udata[dostup]<2){				
echo "<p>Игрок закрыл свою почту!</p>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');

}}

// игнор лист //--------------
$reqtmp = mysql_query("SELECT * FROM `msg_ignor` WHERE `contact` = '$log' and `usr` = '".mysql_real_escape_string($_POST[to])."' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){
echo'<p>Вы находитесь в игноре у этого персонажа!</p>';
echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');
exit;
}
//////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if($udata[time]<3600){				
echo "<p>Для общения в почте нужно провести 1 час на сайте!</p>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');
}



if ($_POST[text] != "" && $_POST[to] != "")
{
if (isset($_POST[text]))
{
$text = htmlspecialchars(stripslashes($_POST[text]));
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
}
if (isset($_POST[to]))
{
$to = $_POST[to];
}
$time = date("H:i d.m.y");




mysql_query("INSERT INTO `msg_r` SET `user_from` = '$log', `user_to` = '$to', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
mysql_query("INSERT INTO `msg_i` SET `user_from` = '$log', `user_to` = '$to', `time` = '$time',`mail_msg` = '$text'");
echo "Вы успешно отправили письмо для $to<br/> Дата отправления: $time<br/>";

echo "<a href=\"msg.php?\">Назад</a><br/>";
}
elseif ($_POST[text] == "" ||  $_POST[text] == null )
{
echo "Вы не ввели текст письма<br/>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
elseif ($_POST[to] == "" || $_POST[to] == null)
{
echo "Не выбран отправитель!";

echo "<br/><a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
else 
{
echo "Ошибка!<br/>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
break;

case 'vxod':

$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_i` WHERE user_from = '$log'"),0);
if ($result == 0)
{
echo "<b>Почта пуста</b>!<br/>";
echo "<a href=\"msg.php?\">Назад</a><br/>";
}else{
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 5;
if($_GET[page] == "0")
{$i = 0;}
else{$i = ($_GET[page]*5)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/5);
$message = mysql_query("SELECT * FROM msg_i WHERE user_from = '$log'  ORDER BY id DESC LIMIT $num,5");
while($msg = mysql_fetch_array($message))
{
$text = $msg[mail_msg];
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
//$text = strip_tags($text);
$from = strip_tags($msg['user_to']);
echo "<b>Кому:</b>$from<br/><b>Дата Добавления</b>: <small>$msg[time]</small><br/><b>Письмо</b>: $text
<br/><a href=\"msg.php?user=$from&amp;mod=answer\">Ответить</a>|<a href=\"msg.php?iden=$msg[id]&amp;mod=delete_mess_vxod\">Удалить</a>
<br/>";
} 

if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?mod=vxod&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?mod=vxod&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo "<br/><a href=\"msg.php?\">Назад</a></div>";
}
break;







case 'read':


function smilesmsg($string54545){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
//if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string54545=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="">',$string54545);
}
closedir ($dir);
return $string54545;  }



$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE user_to = '$log' AND user_from!='Cистема' AND user_from!='Рассылка от администрации' "),0);
if ($result == 0)
{
echo "<b>Почта пуста!</b><br/>";
}
else {
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 5;
if($_GET[page] == "0")
{$i = 0;}
else{$i = ($_GET[page]*5)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/5);
$message = mysql_query("SELECT * FROM msg_r WHERE user_to = '$log' AND user_from!='Cистема' AND user_from!='Рассылка от администрации' ORDER BY id DESC LIMIT $num,5");
while($msg = mysql_fetch_array($message))
{
if ($msg[read] == 1)
{
mysql_query("UPDATE `msg_r` SET `read` = 0 WHERE `user_to` = '$log'");
}
if ($msg[read] == 1)
{
$read = "<font color=red>Не прочитано<br/></font>";
} else
{
$read = "";
}



$text = $msg[mail_msg];
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);

$text = smilesmsg($text);
$text = nl2br($text);
//$text = strip_tags($text); <b><font color=grey>Текст:</font></b>
$from = strip_tags($msg['user_from']);
echo "<p><div class=msg><b><font color=grey>От:</font> </b><b><a href='search.php?nick=".$from."&amp;go=go'>$from</a><font color=#686868></b> <small>$msg[time]</small></font>
<br/> $read ";

 echo "</div><div class=msg> $text </div>";
 
 echo '<div class=silka><div class=dot><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;text-align			:center;">
<a class="top_menu_link" href="/msg.php?user='.$from.'&amp;mod=answer" title="Ответить">Ответить</a></td><td style="vertical-align:top;width:19%;text-align			:center;">
<a class="top_menu_link" href="/msg.php?iden='.$msg[id].'&amp;mod=delete_mess" title="Удалить">Удалить</a></td></tr></table>
</div></div></p><hr>';

//echo "<a href=\"msg.php?user=$from&amp;mod=answer\">Отв.</a> | <a href=\"msg.php?iden=$msg[id]&amp;mod=delete_mess\">Удал.</a><br/><br/><hr>";

} 

if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?mod=read&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?mod=read&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo "<br/><a href=\"msg.php?\">Назад</a></div>";
}
break;



case 'sys':


function smilesmsg($string54545){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
//if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string54545=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="" height="30" width="30">',$string54545);
}
closedir ($dir);
return $string54545;  }



$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE user_to = '$log' and user_from='Система' "),0);
if ($result == 0)
{
echo "<b>Почта пуста!</b><br/>";
}
else {
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 5;
if($_GET[page] == "0")
{$i = 0;}
else{$i = ($_GET[page]*5)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/5);
$message = mysql_query("SELECT * FROM msg_r WHERE user_to = '$log'  and user_from='Система' ORDER BY id DESC LIMIT $num,5");
while($msg = mysql_fetch_array($message))
{
if ($msg[read] == 1)
{
mysql_query("UPDATE `msg_r` SET `read` = 0 WHERE `user_to` = '$log'");
}
if ($msg[read] == 1)
{
$read = "<font color=red>Не прочитано<br/></font>";
} else
{
$read = "";
}



$text = $msg[mail_msg];
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);

$text = smilesmsg($text);
$text = nl2br($text);
//$text = strip_tags($text); <b><font color=grey>Текст:</font></b>
$from = strip_tags($msg['user_from']);
echo "<p><div class=msg><b><font color=grey>От:</font> </b><b>Cистема<font color=#686868></b> <small>$msg[time]</small></font>
<br/> $read ";

 echo "</div><div class=msg> $text </div>";
 




} 

if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?mod=sys&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?mod=sys&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo "<br/><a href=\"msg.php?\">Назад</a></div>";
}
break;



case 'ras':


function smilesmsg($string54545){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
//if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string54545=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="" height="30" width="30">',$string54545);
}
closedir ($dir);
return $string54545;  }



$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE user_to = '$log' and user_from='Рассылка от администрации' "),0);
if ($result == 0)
{
echo "<b>Почта пуста!</b><br/>";
}
else {
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0") 
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 5;
if($_GET[page] == "0")
{$i = 0;}
else{$i = ($_GET[page]*5)+1;}
$viso = mysql_num_rows(mysql_query("SELECT komentaras FROM komentarai"));
$puslap = floor($viso/5);
$message = mysql_query("SELECT * FROM msg_r WHERE user_to = '$log'  and user_from='Рассылка от администрации' ORDER BY id DESC LIMIT $num,5");
while($msg = mysql_fetch_array($message))
{
if ($msg[read] == 1)
{
mysql_query("UPDATE `msg_r` SET `read` = 0 WHERE `user_to` = '$log'");
}
if ($msg[read] == 1)
{
$read = "<font color=red>Не прочитано<br/></font>";
} else
{
$read = "";
}



$text = $msg[mail_msg];
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);
$text = eregi_replace("(l2servak|l 2 s e r v a k . r u|l2servak.ru|.mobi|.ua|.tk|.ru|.org|.net|.info|.com|game-l2.ru|l2wap.ru|l2full.ru|game-l2.ru|l2mobile.ru|l3pvp.ru|ln8.ru|l3pvp|ln8|l3new.ru|l3new|wapl2pvp.ru|wapl2pvp|l2mo.ru|miru.mobi|l2pirates.ru|waplin.ru|l2mobi.su|l2war.mobi|wapl2pvp.tk|war-lin.ru|l2mobi.h1r.biz|l2mir.h1r.biz|l2perchiki.tk|barbars.su|l3new.tk|l3waps.ru|l3mobile.ru|darklineage.ru|l2mobi.su|l2|l3|mobi|lineage|lin|line|war|la2|la3|l3pvp|ru|mobi|tk|ua|com)", "Реклама запрещена", $text);

$text = smilesmsg($text);
$text = nl2br($text);
//$text = strip_tags($text); <b><font color=grey>Текст:</font></b>
$from = strip_tags($msg['user_from']);
echo "<p><div class=msg><b><font color=grey>От:</font> </b><b>Cистема<font color=#686868></b> <small>$msg[time]</small></font>
<br/> $read ";

 echo "</div><div class=msg> $text </div>";
 




} 

if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?mod=ras&amp;page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?mod=ras&amp;page=$next\">next</a><br/>";}
else
{echo "next<br/>";}
echo "<br/><a href=\"msg.php?\">Назад</a></div>";
}
break;




case 'delete_all':
mysql_query("DELETE FROM msg_r WHERE (user_to='$log')") or die("не пашет!");
mysql_query("DELETE FROM msg_i WHERE (user_from='$log')") or die("не пашет!");
echo"Все письма успешно удалены!<br/>";
echo"<a href=\"msg.php\">В почту</a><br/>";
break;

case 'delete_all_vxod':

mysql_query("DELETE FROM msg_i WHERE (user_from='$log')") or die("не пашет!");
echo"Все письма успешно удалены!<br/>";
echo"<a href=\"msg.php?mod=vxod\">В письма</a><br/>";
break;

case 'answer':

?>

<script language="javascript" type="text/javascript">
<!--
var ie=document.all?1:0;
var ns=document.getElementById&&!document.all?1:0;

function InsertSmile(SmileId)
{
    if(ie)
    {
    document.all.message.focus();
    document.all.message.value+=" "+SmileId+" ";
    }

    else if(ns)
    {
    document.forms['guestbookmsg'].elements['text'].focus();
    document.forms['guestbookmsg'].elements['text'].value+=" "+SmileId+" ";
    }

    else
    alert("Ваш браузер не поддерживается!");
}
// -->
</script>

<?




if (isset($_GET[user]))
{

echo "<form method=\"post\" action=\"msg.php?mod=send_message\" name=\"guestbookmsg\">Кому: $_GET[user]<br/>";
$usr = htmlspecialchars($_GET[user]);
echo "Текст письма:<br/>";
echo "<input type=\"hidden\" name=\"to\" value=\"$usr\">";
echo "<textarea name=\"text\" rows=5 cols=15 wrap=\"off\"></textarea><br/><input type=\"submit\" value=\"Отправить\" class=\"ibutton\">";


?>

<script language="JavaScript">
        function xhs(id) {
            t=document.getElementById(id);
                if(t.style.display=='none') t.style.display='';
                else t.style.display='none'
            return false;
        }
    </script>
<input type="button" value=" =) " onclick="xhs('id123')" />
<table id="id123" style="display: none;">


</form>
<?

//----------------------------------------
$dir = opendir ("pic/smiles");
while ($file = readdir ($dir)) 
{ if (ereg (".gif$", "$file"))
{$a[]=$file;}}  
closedir ($dir); 
sort($a);

$total = count($a); $start = 0; // стар значени от какого
if ($total < $start + 460){ $end = $total; }
else {$end = $start + 460; }

echo "<tr>";

for ($i = $start; $i < $end; $i++){ 

$smkod=str_replace(".gif","",$a[$i]);


if ($i==10){echo "</tr><tr>";}if ($i==20){echo "</tr><tr>";}if ($i==30){echo "</tr><tr>";}if ($i==40){echo "</tr><tr>";}
if ($i==50){echo "</tr><tr>";}if ($i==60){echo "</tr><tr>";}if ($i==70){echo "</tr><tr>";}if ($i==80){echo "</tr><tr>";}
if ($i==90){echo "</tr><tr>";}if ($i==100){echo "</tr><tr>";}
if ($i==110){echo "</tr><tr>";}if ($i==120){echo "</tr><tr>";}if ($i==130){echo "</tr><tr>";}if ($i==140){echo "</tr><tr>";}
if ($i==150){echo "</tr><tr>";}if ($i==160){echo "</tr><tr>";}if ($i==170){echo "</tr><tr>";}if ($i==180){echo "</tr><tr>";}
if ($i==190){echo "</tr><tr>";}

if ($i==200){echo "</tr><tr>";}


?>
    <td style="cursor: pointer;" class="dot" onclick='InsertSmile("<?echo":$smkod";?>")'><img src='/pic/smiles/<?echo"$a[$i]";?>' title="<?echo":$smkod";?>" height='20' width='20' alt='<?echo"$smkod";?>' / ></td>
<?

}
echo "</tr>";


echo "</table></div>";



echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
else
{

echo "Ошибка!НЕ выбран получатель!<br/>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
break;

case 'send_message':

// проверяем не закрыл игрок почту
$reqch = mysql_query("SELECT * FROM `options` where `usr`='$_POST[to]' LIMIT 1");
$avtoch=mysql_num_rows($reqch);
$priv = mysql_fetch_array($reqch);

if($avtoch>0) { //делаем двойное условие
				// если есть таблицы почта включена
		if($priv[privat]==no && $udata[dostup]<2){				
echo "<p>Игрок закрыл свою почту!</p>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');

}}
// игнор лист //--------------
$reqtmp = mysql_query("SELECT * FROM `msg_ignor` WHERE `contact` = '$log' and `usr` = '$_POST[to]' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){
echo'<p>Вы находитесь в игноре у этого персонажа!</p>';
echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');
exit;
}
//////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if($udata[time]<3600){				
echo "<p>Писать в приват можно проведя 1 час в игре!</p>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
include($path.'inc/down.php');}


/////////////////////////////////////
if ($_POST[text] != "" && $_POST[to] != "")
{
$time = date("H:i d.m.y");
mysql_query("INSERT INTO `msg_r` SET `user_from` = '$log', `user_to` = '$_POST[to]', `time` = '$time', `read` = 1, `mail_msg` = '$_POST[text]'");
mysql_query("INSERT INTO `msg_i` SET `user_from` = '$log', `user_to` = '$_POST[to]', `time` = '$time',`mail_msg` = '$_POST[text]'");
echo "Вы успешно отправили письмо для $_POST[to]";
echo "<br/><a href=\"msg.php?\">Назад</a><br/>";
}
elseif ($_POST[text] == ""){

echo "Вы не ввели текст письма<br/>";

echo "<a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
elseif ($_POST[to] == "" || $_POST[to] == null)
{

echo "Не выбран отправитель!";

echo "<br/><a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
else 
{

echo "Ошибка!!!";

echo "<br/><a href=\"msg.php?mod=write_message\">Назад</a><br/>";
}
break;

case 'delete_mess':

if (isset($_GET[iden]))
{
mysql_query("DELETE FROM `msg_r` WHERE `id` = '".intval($_GET['iden'])."' LIMIT 1");
mysql_query("OPTIMIZE TABLE `msg_r`");

echo "Вы успешно удалили письмо!<br/>";
} else
{
echo "Ошибка!<br/>";
}
echo "<a href=\"msg.php?mod=read\">Назад</a><br/>";
break;

case 'delete_mess_vxod':

if (isset($_GET[iden]))
{
mysql_query("DELETE FROM `msg_i` WHERE `id` = '".intval($_GET['iden'])."' LIMIT 1");
mysql_query("OPTIMIZE TABLE `msg_r`");





if (isset($_GET[$p_1_20])){
echo "





";
echo"<a href=\"faq.php?id=34&p_1_20\">1-20</a> |";
echo"<a href=\"faq.php?id=34&p_21_40\">21-40</a> |";
echo"<a href=\"faq.php?id=34&p_41_60\">41-60</a> |";
echo"<a href=\"faq.php?id=34&p_61_80\">61-80</a> |";
echo"<a href=\"faq.php?id=34&p_81_100\">81-100</a> |";
echo"<a href=\"faq.php?id=34&p_101_111\">101-111</a>";
}













echo "Вы успешно удалили письмо!<br/>";
} else
{
echo "Ошибка!<br/>";
}
echo "<a href=\"msg.php?mod=vxod\">Назад</a><br/>";
break;

case 'save_conts':

if (empty($_POST[nick])){$_POST[nick]=$n;}

$_POST[nick] = htmlspecialchars($_POST[nick]);
$find = mysql_num_rows(mysql_query("SELECT usr FROM users WHERE usr LIKE '%$_POST[nick]%'"));

if ($_POST[nick] != "")
{
echo "Найдено игроков: <i>$find</i><br/>";

echo "<form action=\"msg.php?mod=adding\" method=\"post\">
<select name=\"user\" value=\"one\"><option name=\"one\">--Выбрать--</option>";
$useras = mysql_query("SELECT usr FROM users WHERE usr LIKE '%$_POST[nick]%'");
while ($users = mysql_fetch_array($useras))
{
$users = strip_tags($users['usr']);
echo "<option name=\"$users\">$users</option>";
}
echo "</select><br/><a href=\"search.php?go=adding&nick=$_POST[nick]\"> +Добавить</a><br/>";
echo "<br/>";
}
elseif (empty($_POST[nick])) {
echo "<b>Вы не ввели имя в поле!</b><br/>";
}
else
{
echo "Нет такого бойца!<br/>";
}
echo "<a href=\"msg.php?\">Назад</a><br/>";
break;

case 'info_m':

$_GET[nick] = htmlspecialchars($_GET[nick]);
$find = mysql_num_rows(mysql_query("SELECT usr FROM users WHERE usr LIKE '%$_GET[nick]%'"));

if ($_GET[nick] != "")
{
echo "Найдено бойцов: <i>$find</i><br/>";

echo "<form action=\"msg.php?mod=adding\" method=\"post\">
<select name=\"user\" value=\"one\"><option name=\"one\">--Выбрать--</option>";
$useras = mysql_query("SELECT usr FROM users WHERE usr LIKE '%$_GET[nick]%'");
while ($users = mysql_fetch_array($useras))
{
$users = strip_tags($users['usr']);
echo "<option name=\"$users\">$users</option>";
}
echo "</select><br/><input type=\"submit\" value=\"Ok\" class=\"ibutton\"></form>";

echo "<br/><a href=\"msg.php?\">Назад</a><br/>";
}
elseif ($_GET[nick] == "") {
echo "<b>ERROR!</b><br/>";
echo "<a href=\"msg.php?\">Назад</a><br/>";
}
else
{
echo "Нет такого бойца!<br/>";
echo "<a href=\"msg.php?\">Назад</a><br/>";
}
break;

case 'ad':

echo"Вы уверены что хотите добавить $n в контакты/друзья?<br/><br/>";
echo "<a href=\"msg.php?mod=adding&n=$n\">Да</a> | ";
echo "<a href=\"search.php?nick=$n&go=go\">Нет</a>";

break;

case 'adding':

$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
$avto = mysql_fetch_array($req);
                        if($avto=="0"){
			echo'Нет такого игрока!';
			include($path.'inc/down.php');
			include($path.'inc/meny.php');
			exit;}
	$usdata = mysql_fetch_array($req);
			if(empty($_GET[nick])){
			echo"Ошибка не выбран игрок!";
			include($path.'inc/down.php');
			include($path.'inc/meny.php');
			exit;}

$req = mysql_query("SELECT * FROM `msg_users` WHERE `usr`= '$log' and `contact` = '".mysql_real_escape_string($_GET['nick'])."' LIMIT 1");
$avto=mysql_num_rows($req);
	if($avto==1){
		echo'У вас уже есть этот персонаж в контактах!';
		include($path.'inc/down.php');
		include($path.'inc/meny.php');
	exit;}
        if($_GET[nick]==$log){
		echo'Cебя добавить нельзя!<br/>';
		include($path.'inc/down.php');
		include($path.'inc/meny.php');
	exit;}
mysql_query("INSERT INTO `msg_users` SET `usr` = '$log', `contact` = '$_GET[nick]'");

echo "<p>$_GET[nick] успешно добавлен в контакты!</p>";
echo"<a href=\"search.php?go=go&amp;nick=$nick\">Назад</a>";
break;
}

include($path.'inc/down.php');
?>
