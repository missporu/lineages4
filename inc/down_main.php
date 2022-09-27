<?php

include_once("inc/ini.php");

$self = $_SERVER['SCRIPT_NAME'];
$time=time();

mysql_query("UPDATE `users` SET `udata55`='$self' WHERE `udata0`='$log'");
mysql_query("UPDATE `users` SET `udata56`='$time' WHERE `udata0`='$log'");

echo '</div></div>';

include_once"inc/check.php";

echo '<div class="warning s">';
include_once"inc/xtotut.php";
echo '</div>';

if($_SESSION['version'] == 'new'){

?>
<div class="b"><hr />
<?if(!empty($udata37)){?>
<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;
"><a class="top_menu_link" href="okrestnosti" title="В окресности">
В окресности</a></td></tr></table>
</div>
<?}?>
<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;
width:19%;
border-right:solid;
border-width:1px;
color:#1D1C1A"><a class="top_menu_link" href="msg" title="Почта">
Почта</a></td><td style="vertical-align:top;
width:19%;
border-right:solid;
border-width:1px;
color:#1D1C1A"><a class="top_menu_link" href="chat" title="Чат">
Чат</a></td><td style="vertical-align:top;
width:19%;
"><a class="top_menu_link" href="forum.php" title="Форум">
Форум</a></td></tr></table>
</div><br /><div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;
width:19%;
"><a class="top_menu_link" href="gorod" title="Город">Город</a></td></tr></table>

</div><div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;
width:19%;
border-right:solid;
border-width:1px;
color:#1D1C1A"><a class="top_menu_link" href="inventar" title="Инвентарь">
Инвентарь</a></td><td style="vertical-align:top;
width:19%;
"><a class="top_menu_link" href="pers" title="Персонаж">
Персонаж</a></td></tr></table>
</div><div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;
"><a class="top_menu_link" href="main?&id=rating_all" title="Рейтинги">
Рейтинги</a></td></tr></table>
</div>



<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr>
<?if(!empty($udata23)){?>
<td style="vertical-align:top;
width:19%;
border-right:solid;
border-width:1px;
color:#1D1C1A"><a class="top_menu_link" href="clanroom" title="Комната клана">
Клан</a></td><?}?>
<?if(!empty($udata90)){?>
<td style="vertical-align:top;
width:19%;
"><a class="top_menu_link" href="aliroom" title="Персонаж">
Альянс</a></td><?}?>


</tr></table>
</div>


</div>
</div></td>
<td class="r"></td>
</tr>
<tr>
<td class="lb"></td>
<td valign="top" class="bb"></td>
<td class="rb"></td>
</tr></table>
<?
echo"<center><a href=\"pers.php?go=refer\">Позвать друзей</a></center><br/>";
echo '<center><a href="faq.php?">Помощь</a> |<a href=\'main?&amp;id=rules\'> <font color=grey>Правила</font></a> |<a href=\'tickets\'><font color=grey> Поддержка</font></a></center></br></br> ';
echo'<center><font color=grey>© line-age.mobi, 2013</font></center>';
echo'<center><a href="http://waplog.net/c.shtml?530690"><img src="http://c.waplog.net/530690.cnt" alt="waplog" /></a></center></br></br> ';
echo'<center><a href="http://vk.com/line_age.mobi">Наша група вконтакте</a></center></br></br> ';
echo"
<center>
( <a href=\"version?go=new\">WAP</a> | <a href=\"version?go=web\">WEB</a>)<br>";
echo"</center>";
}elseif($_SESSION['version'] == 'web'){
?>






<td width="19" class="r"></td>
</tr>
<tr>

<td width="19" height="22" class="lb">&nbsp;</td>
<td height="22" valign="top" class="bb">&nbsp;</td>
<td width="19" height="22" class="rb">&nbsp;</td>
</tr></table>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="lt1">&nbsp;</td>
<td height="48" class="t1"><div align="center"><b>Чат</b></div></td>
<td class="rt1">&nbsp;</td>
</tr>
<tr>
<td width="19" class="l"></td>
<td class="centertd">

<?
$qi = mysql_query("SELECT * from `gb` ORDER by `dbid` DESC LIMIT 10");
if (mysql_affected_rows()==0)
{
echo "Сообщений ещё нет!";
}
else
{
while($row=mysql_fetch_array($qi))


{
$row['text'] = replase_smile($row['text']);

$row['text']=($row['text']);

$d = time()-$row['date'];

echo '<br><a href="search.php?nick='.$row['login'].'&amp;go=go">'.$row['login'].'</a> ('.sec2day($d).' назад)<br>'.$row['text'].' ,   <a href="chat.php?nick='.$row['login'].'&amp;go=go">ответить</a> '; if($udata67==200 or $udata67==100 ){echo"<a href=\"chat.php?go=del&amp;dbid=".$row['dbid']."\">[х]</a>";};

}
}

?>

<div align="left"><hr><form action="chat.php?go=add" method="post"><div align="center">Cообщение<br>
<input class="inp" type="text" name="text" title="Сообщение" value=""><br>

<input class="but" type="submit" value="Написать"></div></form></div></td>
<td width="19" class="r"></td>
</tr>
<tr>
<td width="19" height="22" class="lb"></td>
<td height="22" valign="top" class="bb"></td>
<td width="19" height="22" class="rb"></td>
</tr></table>

</td><td valign="top" width="25%">

<!-- Правый блок "Навигация" -->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="lt1">&nbsp;</td>
<td height="48" class="t1"><div align="center"><b>Навигация</b></div></td>
<td class="rt1">&nbsp;</td>
</tr>
<tr>
<td width="19" class="l"></td>
<td class="centertd">
<div align="center" class="menu">

<?
echo'<a href=\'main.php\'>Моё меню</a>';
echo'<a href=\'inventar.php\'>Инвентарь</a>';
echo'<a href=\'gorod.php\'>В город</a>';
if(!empty($udata37)){echo'<a href=\'okrestnosti.php\'>В окресности</a>';}
if(!empty($udata23)){echo'<a href=\'clanroom.php\'>Комната клана</a>';}
if(!empty($udata90)){echo'<a href=\'aliroom.php\'>Комната альянса</a>';}

?>

</div></td>
<td width="19" class="r"></td>
</tr>
<tr>
<td width="19" height="22" class="lb"></td>
<td height="22" valign="top" class="bb"></td>
<td width="19" height="22" class="rb"></td>
</tr></table>

<!-- Правый нижний блок "онлайна" -->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<?
       $pr_q = mysql_query("SELECT * from `users` where `udata56`>('".time()."'-'600')");
       $pts = mysql_num_rows($pr_q);
?>
<td class="lt1">&nbsp;</td><td height="48" class="t1"><div align="center"><b>Сейчас в игре <a href="ho.php"><font color="#00CA33" face="Georgia"><?echo $pts;?></font></a></b></div></td>
<td class="rt1">&nbsp;</td>
</tr>
<tr>
<td width="19" class="l"></td>
<td class="centertd">

<?
$pr_q = mysql_query("SELECT * from `users`  where `udata56`>('".time()."'-'600') order by `udata19` desc LIMIT 25 ");
$i = 1;
while($arr = mysql_fetch_array($pr_q)) {
$aglava=mysql_query("SELECT * FROM `clan` WHERE `clan0`='$arr[udata23]'  ");
$arrs= mysql_fetch_array($aglava);
$ggg=$arrs['clan2'];



echo "<br>".$i.".";$sss=$arr['udata23'];
if($sss!==""){


if(!empty($ggg)){
echo"<img src=\"pic/clan/$ggg\" alt=\"clan\"/>";}}
if($arr['udata86'] >= "1"){
 	echo "<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=red>".$arr['udata0']."</font></a>  (".$arr['udata9']." уровень) ";}else
if($arr['udata67'] == "200"){
echo "<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=lime>".$arr['udata0']."</font></a>  (".$arr['udata9']." уровень) ";}else
if($arr['udata67'] == "100"){
echo "<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=blue>".$arr['udata0']."</font></a>  (".$arr['udata9']." уровень) ";}else
if($arr['udata75']=="vip"){
	echo "<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=gold>".$arr['udata0']."</font></a>  (".$arr['udata9']." уровень) ";}else
if($arr['udata25']!==""){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"".$arr['udata25']."\"><up>".$arr['udata0']."</up></font></a> (".$arr['udata9']." уровень)";}else
	if($arr['udata9']=="80"){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"#008B8B\"><up>".$arr['udata0']."</up></font></a> (".$arr['udata9']." уровень)";}else
if($arr['udata9']=="81"){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"#00CDCD\"><up>".$arr['udata0']."</up></font></a> (".$arr['udata9']." уровень)";}else
if($arr['udata9']=="82"){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"#00EEEE\"><up>".$arr['udata0']."</up></font></a> (".$arr['udata9']." уровень)";}else
if($arr['udata9']=="83"){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"#00CDCD\"><up>".$arr['udata0']."</up></font></a> (".$arr['udata9']." уровень)";}else
if($arr['udata9']=="84"){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"#00FFFF\"><up>".$arr['udata0']."</up></font></a> (".$arr['udata9']." уровень) ";}else
if($arr['udata9']=="85"){
echo"<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\"><font color=\"#FF4500\"><up><b>".$arr['udata0']."</b></up></font></a> (".$arr['udata9']." уровень)";}else{
echo "<a href=\"search.php?&amp;nick=".$arr['udata0']."&go=go\">".$arr['udata0']."</a>  (".$arr['udata9']." уровень) ";}
 $i=$i+1;

}

?>

<div align="center" class="menu"><br /><a href="main.php?id=online">Весь список</a></div></td>
<td width="19" class="r"></td>
</tr>
<tr>
<td width="19" height="22" class="lb"></td>
<td height="22" valign="top" class="bb"></td>
<td width="19" height="22" class="rb"></td>
</tr></table>
</td></tr>




<!-- подвал -->
</table>
<div class="qu">&nbsp;</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="left">
<a href="pers.php?go=pers"><img src="css/web/a3.jpg" align="absmiddle" border="0" alt="Персонаж"> - Персонаж</a>&nbsp;
<a href="inventar.php"><img src="css/web/a1.jpg" align="absmiddle" border="0" alt="Инвентарь"> - Инвентарь</a>&nbsp;
<a href="msg.php"><img src="css/web/a4.jpg" align="absmiddle" border="0" alt="Личная почта"> - Личная почта</a>&nbsp;
<a href="setting.php"><img src="css/web/a5.jpg" align="absmiddle" border="0" alt="Настройки"> - Настройки</a>&nbsp;
<a href="faq.php"><img src="css/web/a6.jpg" align="absmiddle" border="0" alt="F.A.Q."> - F.A.Q.</a>&nbsp;</td>
<td align="right">
<a href="exit.php?"><img src="css/web/a7.jpg" align="absmiddle" border="0" alt="Покинуть игру"> - Выйти</a>&nbsp;</td>

</tr></table>

<div class="qu">&nbsp;</div>


<br><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
</tr></table></body></html>

<?}?>