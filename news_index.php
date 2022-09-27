<?php
define('PROTECTOR', 1);

$headmod = 'news_index';//фикс. места

$textl='Новости';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
//include($path.'inc/zag.php');


echo "<p><font color=#057F46><b>Новости игры!</b></font></p>";
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
$viso = mysql_num_rows(mysql_query("SELECT title FROM news"));
$puslap = floor($viso/10);
if (is_double($num) || !is_integer($num))
{
echo "Ошибка!<br/>";
}
else {
$asd = mysql_query("SELECT title, text, time FROM news ORDER BY id DESC LIMIT $num,10");
while($dsa = mysql_fetch_array($asd))
{
$i2 = $i++;
$title = strip_tags($dsa['title']);
$time = strip_tags($dsa['time']);
echo "";
echo "<p><hr/></p><div class=dot><b><font color=#6D7F3F>$title </b><small>
[$time]</small><br/></font>
<font color=grey>$text ".nl2br($dsa['text'])."</font>";
echo "</div>";
}





echo '<p><hr/></p><center>';
if ($_GET[page] > 0)
{
echo "<a href=\"?page=$back\"><---</a>";
}
elseif ($_GET[page] == 0)
{
echo "<---";
}
echo"-|-";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"?page=$next&\">---></a><br/>";}
else
{echo "---><br/>";}
}







echo "</center><br/><br/><div class=silka> <a href=\"index.php?\">Назад </a></div><br/>";


echo'</div></td>
<td class="r"></td>
</tr>
<tr>
<td class="lb"></td>
<td valign="top" class="bb"></td>
<td class="rb"></td>';
echo "</tr></table></body></html>";

//--------------------------------
include_once("inc/endmain.php");
//--------------------------------










?>
