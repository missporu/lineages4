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

// если есть значения ПОСТ тогда ГЕТ равно ПОСТ
if (!empty($_POST[nick])){$_GET[n] = $_POST[nick];}


if (empty($_GET[n])){

echo "<form action=\"msg_pers.php?\" method=\"post\">Переписка с игроком:<br/>";
echo "<input type=\"text\" value=\"'.htmlspecialchars($_GET[n]).'\" name=\"nick\"><br/>";
echo "<input type=\"submit\" value=\"Далее\" class=\"ibutton\"></form>";


}else{

$pers = $_GET[n];

echo "<p><font color=#057F46><b>Переписка с ".htmlspecialchars($_GET[n]).":</b></font></p><hr/>";

function smilesmsg($string54545){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string54545=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="" height="30" width="30">',$string54545);
}}
closedir ($dir);
return $string54545;  }



$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE user_to = '$log'"),0);

$result2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `msg_i` WHERE user_to = '".mysql_real_escape_string($pers)."'"),0);
if ($result == 0 or $result2 == 0)
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





$message = mysql_query("SELECT * FROM msg_r WHERE user_to = '$log'  ORDER BY id DESC LIMIT 5");


$message2 = mysql_query("SELECT * FROM msg_r WHERE user_from = '".mysql_real_escape_string($pers)."'  ORDER BY id DESC LIMIT 5");


while ($msg = mysql_fetch_array($message) or $msg2 = mysql_fetch_array($message2))
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

$text = smilesmsg($text);
$text = nl2br($text);
$text = strip_tags($text); 
echo'<b><font color=grey>Текст:</font></b>';
$from = strip_tags($msg['user_from']);
echo "<p><div class=msg><b><font color=grey>От:</font> </b><b><a href='search.php?nick=".$from."&amp;go=go'>$from</a><font color=#686868></b> <small>$msg[time]</small></font>
<br/> $read ";

 echo "</div><div class=msg> $text </div>";
 
 echo '<div class=silka><div class=dot><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;text-align			:center;">
<a class="top_menu_link" href="/msg.php?user='.$from.'&amp;mod=answer" title="Ответить">Ответить</a></td><td style="vertical-align:top;width:19%;text-align			:center;">
<a class="top_menu_link" href="/msg.php?iden='.$msg[id].'&amp;mod=delete_mess" title="Удалить">Удалить</a></td></tr></table>
</div></div></p><hr>';

echo "<a href=\"msg.php?user=$from&amp;mod=answer\">Отв.</a> | <a href=\"msg.php?iden=$msg[id]&amp;mod=delete_mess\">Удал.</a><br/><br/><hr>";

} 
echo "<a href=\"msg.php?mod=delete_all\">Очистить почту</a><br/>";
if ($_GET[page] > 0)
{
echo "<a href=\"msg.php?mod=read&amp;page=$back\">Назад </a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"msg.php?mod=read&amp;page=$next\"> Далее</a><br/>";}
else
{echo "next<br/>";}
echo "<br/><a href=\"msg.php?\">Назад</a></div>";

}
}


include($path.'inc/down.php');
?>
