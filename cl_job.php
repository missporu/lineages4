<?php

$textl='Задания';
///////////////////////
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if($udata[clan]==''){echo'Доступ только игрокам которые находятся в клане!!!';include('inc/down.php');exit;}
$cl = mysql_query("SELECT * FROM `clan` WHERE `lider` = '$udata[clan]'");
$clan = mysql_fetch_array($cl);
///////////////




echo "<div class=msg><p><span style=color:#218F51;><b>Клановые Задания:</b></span></p></div>";


//--------------------------------------------------------------------------//--------------------------------------------------------------------------
echo "<p><hr/></p>";
//--------------------------------------------------------------------------//--------------------------------------------------------------------------


//---выполненно--
if (isset($_GET[jbm])){
$jm = mysql_fetch_array(mysql_query("SELECT * FROM cl_job_mob WHERE `clan` = '$clan[name]' LIMIT 1"));
$ml = mysql_fetch_array(mysql_query("SELECT * FROM cl_job_mob_log WHERE `clan` = '$clan[name]' LIMIT 1"));
if($jm[kill]>=10000){

$newalmaz = $clan[clancoin]+15;

mysql_query("UPDATE clan SET `clancoin` = '$newalmaz'  WHERE `lider` = '$udata[clan]' Limit 1"); // вознаграждение
if($ml[kill]>=10){
$text = 'Ваш клан выполнил задание убить 10`000 монстров, награда +70 Coin of Luck';
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$ml[usr]."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
mysql_query("UPDATE users SET `almaz` = `almaz` +'70' WHERE `usr` = '$ml[usr]'");
mysql_query("UPDATE users SET `almaz` = `almaz` +'70' WHERE `usr` = '$log'");
}

$date = date("d.m.Y");
mysql_query("UPDATE cl_job_mob SET `kill` = 'off',`data` = '$date' WHERE `clan` = '$clan[name]' Limit 1"); // получил вознаграждение
mysql_query("UPDATE cl_job_mob_log SET `kill` = 'off',`data` = '$date' WHERE `clan` = '$clan[name]' Limit 1"); // получил вознаграждение

}}
//---------------




$jm = mysql_fetch_array(mysql_query("SELECT * FROM `cl_job_mob` WHERE `clan` = '$clan[name]' LIMIT 1"));
if(empty($jm[kill])){$mobkill=0;}else{$mobkill=$jm[kill];}

$moball=10000; // при смене менять и в файле battle.php
$mobpr = floor($mobkill / $moball*100);
echo "<div class=dot><font color=silver><b> Убить 10`000 мобов: </b></font><br/>";
if ($mobkill=='off' and $mobkill!==0){echo "<div style=color:#FFB300;padding:1% 1% 1% 1%;>ВЫПОЛНЕНО</div>";}else{echo '	<span style="top:9px;left:2%;color:#485477;"> <b>Процесс:</b>    '.$mobkill.' / '.$moball.'</span><div style="border:1px solid #007E97;font-size: 9px;background:1px #282828;height:10px;width:160px;"><div style="background-color:#7D9A00;height:10px;width:'.$mobpr.'%;"></div></div>';
echo "<div style=color:#2B824E;padding:1% 1% 1% 1%;>+70 CoL -/- +15 Серебра</div>";
echo"<a href=\"?stata\">Статистика</a><br/>";
if ($mobkill>=$moball && $clan[lider]==$log or $clan[zam]==$log)	{echo "<div class=\"silka\"> <b><a href=\"/cl_job.php?jbm\">Завершить</a></b></div>";}
}

if(isset($_GET['stata'])){
echo"<a href=\"cl_job.php\"><font color=grey>Скрыть</font></a><br/><br/>";
$mobl = mysql_query("SELECT * FROM `cl_job_mob_log` WHERE `clan` = '$clan[name]' ORDER BY ABS(`kill`) DESC LIMIT 0,10");
$avto=mysql_num_rows($mobl);
if($avto>=1){
$alPos = 1; 
while ($logm = mysql_fetch_array($mobl))  
{  
$stata = "$alPos). <a href='search.php?nick=$logm[usr]&amp;go=go'>$logm[usr]</a>: $logm[kill]<br/>"; 
$alPos++; 
echo"$stata";
}
}else{
echo"<b>Нет  игроков</b><br/>";
}
}
echo "</div>";



//--------------------------------------------------------------------------//--------------------------------------------------------------------------
echo "<p><hr/></p>";
//--------------------------------------------------------------------------//--------------------------------------------------------------------------





// награда +5 кол -/- + опыт от уровня

//---выполненно--
if (isset($_GET[jbf])){
$jm = mysql_fetch_array(mysql_query("SELECT * FROM cl_job_fish WHERE `usr` = '$log' LIMIT 1"));
$ml = mysql_fetch_array(mysql_query("SELECT * FROM cl_job_fish_log WHERE `clan` = '$clan[name]' LIMIT 1"));
if($jm[kill]>=5000){

$newalmaz = $clan[clancoin]+10;

mysql_query("UPDATE clan SET `clancoin` = '$newalmaz'  WHERE `lider` = '$udata[clan]' Limit 1"); // вознаграждение
if($ml[kill]>=9){ 
$text = 'Ваш клан выполнил задание словить 5`000 рыбы, награда +45 Coin of Luck';
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '".$ml[usr]."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
mysql_query("UPDATE users SET `almaz` = `almaz` +'45' WHERE `usr` = '$ml[usr]'");
mysql_query("UPDATE users SET `almaz` = `almaz` +'45' WHERE `usr` = '$log'");
}

$date = date("d.m.Y");
mysql_query("UPDATE cl_job_fish SET `kill` = 'off',`data` = '$date' WHERE `clan` = '$clan[name]' Limit 1"); // получил вознаграждение
mysql_query("UPDATE cl_job_fish_log SET `kill` = 'off',`data` = '$date' WHERE `clan` = '$clan[name]' Limit 1"); // получил вознаграждение

}}
//---------------




$jm = mysql_fetch_array(mysql_query("SELECT * FROM `cl_job_fish` WHERE `clan` = '$clan[name]' LIMIT 1"));
if(empty($jm[kill])){$mobkill=0;}else{$mobkill=$jm[kill];}

$moball=5000; // при смене менять и в файле fish.php
$mobpr = floor($mobkill / $moball*100);
echo "<div class=dot><font color=silver><b> Словить 5`000 рыб: </b></font><br/>";
if ($mobkill=='off' and $mobkill!==0){echo "<div style=color:#FFB300;padding:1% 1% 1% 1%;>ВЫПОЛНЕНО</div>";}else{echo '	<span style="top:9px;left:2%;color:#485477;"> <b>Процесс:</b>    '.$mobkill.' / '.$moball.'</span><div style="border:1px solid #007E97;font-size: 9px;background:1px #282828;height:10px;width:160px;"><div style="background-color:#7D9A00;height:10px;width:'.$mobpr.'%;"></div></div>';
echo "<div style=color:#2B824E;padding:1% 1% 1% 1%;>+45 CoL -/- +10 Серебра</div>";
echo"<a href=\"?stat\">Статистика</a><br/>";
if ($mobkill>=$moball && $clan[loser]==$log or $clan[zam]==$log)	{echo "<div class=\"silka\"> <b><a href=\"/cl_job.php?jbf\">Завершить</a></b></div>";}
}

if(isset($_GET['stat'])){
echo"<a href=\"cl_job.php\"><font color=grey>Скрыть</font></a><br/><br/>"; 
$mobl = mysql_query("SELECT * FROM `cl_job_fish_log` WHERE `clan` = '$clan[name]' ORDER BY ABS(`kill`) DESC LIMIT 0,10");
$avto=mysql_num_rows($mobl);
if($avto>=1){
$alPos = 1;  
while ($logm = mysql_fetch_array($mobl))   
{   
$stata = "$alPos). <a href='search.php?nick=$logm[usr]&amp;go=go'>$logm[usr]</a>: $logm[kill]<br/>";  
$alPos++;  
echo"$stata"; 
} 
}else{
echo"<b>Нет  игроков</b><br/>";
}
}
		echo "</div>";


//--------------------------------------------------------------------------


//--------------------------------------------------------------------------//--------------------------------------------------------------------------
echo "<p><hr/></p>";
//--------------------------------------------------------------------------//--------------------------------------------------------------------------


include($path.'inc/down.php');
?>