<?php
   
$textl='Valakas';
include('inc/path.php');  
include($path.'inc/db.php');  
include($path.'inc/auth.php');  
include($path.'inc/func.php');  
include($path.'inc/core.php');  
include($path.'inc/head.php');  
include($path.'inc/regfunc.php');  
include($path.'inc/zag.php');
if(empty($udata[clan])){echo"Вы не в клане!"; include($path.'inc/down.php'); exit;}
$reqcla = mysql_query("SELECT patt,matt,pdef,mdef FROM `clan` where `lider`='$udata[clan]'");
$clan = mysql_fetch_array($reqcla); 
$reqwep = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `tip`='weapon' and `image`='yes'");
$mag = mysql_fetch_array($reqwep); 

$reqshot = mysql_query("SELECT * FROM `soulshots` WHERE `usr` = '$log' and `nlvl` = '$mag[nlvl]' ");
$shot=mysql_fetch_array($reqshot); 
if($shot[kol]>0){ 
if($shot[kol] > 1){mysql_query("UPDATE `soulshots` SET `kol` = `kol`-1 WHERE `usr` = '$log' and `status` = '0' ");}else
{mysql_query(" DELETE FROM `l2warmobi`.`soulshots` WHERE `soulshots`.`id` = $shot[id] ");}



$udata[patt]=($udata[patt]+($udata[patt]*($clan[patt]/100)))*2;
$udata[matt]=round(($udata[matt]+($udata[matt]*($clan[matt]/100)))*1.5); 
$udata[pdef]=$udata[pdef]+($udata[pdef]*($clan[pdef]/100)); 
$udata[mdef]=$udata[mdef]+($udata[mdef]*($clan[mdef]/100)); 
}else{ 
$udata[patt]=$udata[patt]+($udata[patt]*($clan[patt]/100)); 
$udata[matt]=$udata[matt]+($udata[matt]*($clan[matt]/100)); 
$udata[pdef]=$udata[pdef]+($udata[pdef]*($clan[pdef]/100)); 
$udata[mdef]=$udata[mdef]+($udata[mdef]*($clan[mdef]/100)); 
}
if ($udata[klas]=="wizard") {$def = $udata[mdef];} // если маг, то маг def работает
if ($udata[klas]=="fighert") {$def = $udata[pdef];} // если воин, то физ def работает

$df1=  round(rand($def/50,$def/100));
$df2 = round(rand($def/50,$pdef/100));
$aluk_def = round(rand($df1,$df2));

if ($udata[klas]=="wizard") {$uron = $udata[matt];} // если маг, то маг атака работает
if ($udata[klas]=="fighert") {$uron = $udata[patt];} // если воин, то физ атака работает

$my_atk = round(rand($uron,$uron*2)-$aluk_def);
if ($my_atk<1)
{
$my_atk = $udata['lvl']+rand($udata['lvl'],$udata['lvl']/2);
}
$aluko = mysql_fetch_assoc(mysql_query("SELECT * FROM `aluko_cl` ORDER BY `id` LIMIT 1"));
if($aluko['health']==0){
echo '<div class="main"><div class="block_zero center"><center>
<center><img src="pic/pdrakon.png"></center><br>
<font color="darkorange"><b>Valakas</b></font> <font color=gold>повержен, но он может неожиданно ожить, будьте на готове!</div></font></center></br>';
include 'inc/down.php';
exit;
}
if($my_atk >$aluko['health'] and $aluko['health']!=0){
mysql_query("UPDATE `aluko_cl` SET `health`=0 WHERE `id`='".$aluko['id']."'")or die (mysql_error());
echo "<div class='main'><center><img src='pic/minidrakon.png'>Valakas повержен, оживает он <u><font color='red'>Суббота - Восстановление</font></u> в неожиданное (любое) для игроков  время!</div></center>";
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `aluko_log_cl`"),0);
if($total>0){
//$q_nagr = mysql_query("SELECT * FROM `aluko_log_cl` GROUP BY `id` ORDER BY RAND()");
/*50 лучших */
$top_q  = mysql_query("SELECT SUM(uron) , `user_id` FROM  `aluko_log_cl` GROUP BY  `user_id` ORDER BY  SUM(uron) DESC LIMIT 50");
$topes_us = 'Результат сражения с Valakas:<br> ';
while($top= mysql_fetch_assoc($top_q)){
$max_uron = mysql_result(mysql_query("SELECT SUM( uron ) FROM `aluko_log_cl` WHERE `user_id`='".$top['user_id']."'"),0);
$col=rand(1,50);
$vote=rand (1,20);
// Рассчёт награды
if($max_uron >100){
$nag = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$top['user_id']."'"));
$time = date("H:i d.m.y");
$text = "В сражении с клановым боссом<b><font color=darkorange>Valakas-ом</font></b> <br/><font color=lime>Вы получили:</font><br/><font color=yellow>Coin of Luck</font> <u>$col шт.</u><br/> <font color=red>Vote</font><font color=yellow>Coin</font> <u>$vote шт.</u> ";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Поле Боя', `user_to` = '".$nag['usr']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
mysql_query("UPDATE `users` SET `almaz` = `almaz` +".$col.", `votecoin` = `votecoin` +".$vote." WHERE `id` = '".$top['user_id']."'");
}
$name_top = mysql_fetch_assoc(mysql_query("SELECT `usr` FROM `users` WHERE `id`='".$top['user_id']."' LIMIT 1"));
$topes_us.= '<span class="usr">'.$name_top['usr'].'</span> (Нанес '.$max_uron.' урона )<br>';
}
#sleep(1);
//////
mysql_query("TRUNCATE TABLE  `aluko_log_cl`");
}
include 'inc/down.php';
exit;
}
$aluko['health'] = $aluko['health']-$my_atk;    
$aluko_sl = array('ударил','нанес урон','порезал','пробил','задел');
shuffle($aluko_sl);
if($udata[lvl]<50){ 
$ma=25;} 
elseif($udata[lvl]>=50 and $udata[lvl]<80){ 
$ma=50;} 
elseif($udata[lvl]>=80 and $udata[lvl]<111){ 
$ma=75;} 
elseif($udata[lvl]>=111 and $udata[lvl]<140){ 
$ma=100;} 
elseif($udata[lvl]>=140 and $udata[lvl]<160){ 
$ma=125;} 
elseif($udata[lvl]>=160 and $udata[lvl]<180){ 
$ma=150;} 
elseif($udata[lvl]>=180 and $udata[lvl]<200){ 
$ma=200;} 
elseif($udata[lvl]>=200 and $udata[lvl]<220){ 
$ma=250;} 
elseif($udata[lvl]>=220 and $udata[lvl]<240){ 
$ma=325;} 
elseif($udata[lvl]>=240 and $udata[lvl]<260){ 
$ma=475;} 
elseif($udata[lvl]>=260 and $udata[lvl]<280){ 
$ma=675;} 
elseif($udata[lvl]>=280 and $udata[lvl]<300){ 
$ma=850;}
if($udata['mp']<$ma){
echo "<div id='error'><center><font color='#c06060'>Для нападения надо минимум <img src='/pic/skr/MP-1000.gif'/> $ma маны</font></center></div>";
echo'<center>Здоровье Valakas:<font color="orange"> '.$aluko['health'].'</font>/<font color="green">'.$aluko['max_health'].'</font></center>';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log_cl` ORDER BY `time` DESC LIMIT 3");
echo '</div><div class="main"><div class="block_zero"><center><font color="yellow">Лог боя</font><br>';
while($aluko_log = mysql_fetch_assoc($aluko_log_q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
echo '<a href="search.php?id='.$ank['id'].'">'.$ank['usr'].'</a> '.$aluko_log['text'].'<br>';
}
echo '</center>';
include 'inc/down.php';
exit;
}
if($udata['hp']<550){
echo '<div id="error"><font color="#c06060"><center>Вы погибли в бою , дождитесь окончания боя или восстановите здоровье!</font></center></div>';
echo'<center>Здоровье Valakas:<font color="green"> '.$aluko['health'].'</font>/<font color="green">'.$aluko['max_health'].'</font></center>';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log_cl` ORDER BY `time` DESC LIMIT 5");
echo '</div><div class="main"><div class="block_zero"><center><font color="yellow">Лог боя</font><br>';
while($aluko_log = mysql_fetch_assoc($aluko_log_q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
echo '<a href="search.php?id='.$ank['id'].'">'.$ank['usr'].'</a> '.$aluko_log['text'].'<br>';
}
echo '</center>';
include 'inc/down.php';
exit;
}
mysql_query("INSERT INTO `aluko_log_cl` SET `user_id`='".$udata['id']."',`text`='".$aluko_sl[0]." <b><font color=red>Valakas</font></b> на <b><font color=darkorange>".number_format($my_atk, 0, ',', " ")."</font></b>',`time`='".time()."',`uron`='".$my_atk."'");

if($udata[lvl]<50){
$ma=25;}
elseif($udata[lvl]>=50 and $udata[lvl]<80){
$ma=50;}
elseif($udata[lvl]>=80 and $udata[lvl]<111){
$ma=75;}
elseif($udata[lvl]>=111 and $udata[lvl]<140){
$ma=100;}
elseif($udata[lvl]>=140 and $udata[lvl]<160){
$ma=125;}
elseif($udata[lvl]>=160 and $udata[lvl]<180){
$ma=150;}
elseif($udata[lvl]>=180 and $udata[lvl]<200){
$ma=200;}
elseif($udata[lvl]>=200 and $udata[lvl]<220){
$ma=250;}
elseif($udata[lvl]>=220 and $udata[lvl]<240){
$ma=325;}
elseif($udata[lvl]>=240 and $udata[lvl]<260){
$ma=475;}
elseif($udata[lvl]>=260 and $udata[lvl]<280){
$ma=675;}
elseif($udata[lvl]>=280 and $udata[lvl]<300){
$ma=850;}
$_hp = rand(1,300);
$_mp = $ma;
mysql_query("UPDATE `aluko_cl` SET `health`=`health`-".$my_atk." WHERE `id`='".$aluko['id']."'");
mysql_query('UPDATE `users` SET `hp` = `hp` - '.$_hp.' WHERE `id` = "'.$udata['id'].'"');
mysql_query('UPDATE `users` SET `mp` = `mp` - '.$_mp.' WHERE `id` = "'.$udata['id'].'"');
$all_uron = mysql_result(mysql_query("SELECT SUM( uron )FROM `aluko_log_cl` WHERE `user_id`='".$udata['id']."'"),0);
$perc_health_aluko = round($aluko['health']/$aluko['max_health']*100,2);
$hea = $aluko[max_health]*100/100;
$hea2 = $aluko[max_health]*50/100;
$hea3 = $aluko[max_health]*70/100;
$hea4 = $aluko[max_health]*15/100;
if($aluko[health]< $hea){
$color = "<font color=darkorange>";}
if($aluko[health]< $hea2){
$color = "<font color=darkred>";}
if($aluko[health]< $hea3){
$color = "<font color=red>";}
if($aluko[health]< $hea4){
$color = "<font color=darkKhaki>";}
$aluko_text = array('я уничтожу вас смертные!','твоя душа принадлежит мне!','жалкие людишки!','ха-ха-ха','вам меня не победить!','сколько не старайтесь ничего не получится!','я испепелю тебя!','Г-р-р-р-р-р-р');
shuffle($aluko_text);
$r_kush=rand(1,100); 
$kush=rand(1,3);
if ($r_kush<=10){
$kushnew=$clan[col]+$kush;
mysql_query("UPDATE `clan` SET `col` = `col` +'$kushnew' WHERE `lider` = '$udata[clan]' LIMIT 1");
echo"<b><font color='lime'>за нанесение урона вы нашли для клана:</font> <font color='darkorange'>$kush</font> <font color='yellow'>Coin of Luck</font><br/><br/></b>";
}
echo "<div class='main'>
<div class='block_zero center'>
<center><img src='pic/pdrakon.png'><br>
<div class='separ'></div>
<font color=lightskyblue><b>Самое сильное существо ожило!<br> Хватай меч и сражайся</b></font></center><br>
<div class='separ'></div>
<center><font color=violette><b><img src='pic/rech.png'> $aluko_text[0] <img src='pic/rech.png'></font></b></center><br/>
<center><div class=slot_menu>Здоровье: $color".number_format($aluko[health], 0, ',', " ")."</font> / <font color=darkorange>".number_format($aluko[max_health], 0, ',', " ")."</font></div></center>
<div class=separ></div>
<center>
<br><div style=\"text-align:center;margin:10 auto\"><div class=\"pic\"><a href=\"valakas_cl.php?\">Атаковать</a>";
echo"<b><font color='lightskyblue'>Вы теряете за удар: $_mp маны</font></b>";
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log_cl` ORDER BY `time` DESC LIMIT 10");
echo '</div><div class="dot"><div class="block_zero"><center><font color="aqua"><b>Лог боя:</b></font><br>';
while($aluko_log = mysql_fetch_array($aluko_log_q))
{
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
?>
<div class ='content'/>
<span class ='float:left;'/>
<img src='/pic/battle.png' alt='*'/>
<a href='/search.php?nick=<?=$row['usr'];?>&amp;go=go'>
<?=$row['usr']?>
</a></span> | <?=$aluko_log['text'];?></div>
<div class='dot-line'></div>
<?
}
$queryLiders  = mysql_query("SELECT SUM( uron ) , `user_id`  FROM  `aluko_log_cl`GROUP BY  `user_id` ORDER BY  SUM( uron ) DESC LIMIT 10");
?>
<div align='left'>
<br/><center><font color=whiteblue><b>Топ 10 Воинов:</b></font></center></div>
<?
$alPos = 0;
while ($liders = mysql_fetch_array($queryLiders))
{
$alPos++;
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$liders['user_id']."'"));
$damageUs = mysql_result(mysql_query("SELECT SUM( uron ) , `user_id` FROM  `aluko_log_cl`WHERE `user_id`='".$liders['user_id']."'"),0);
?>  
<?
echo"<div class ='content'/>
<div align='left'>
$alPos)<img src='/pic/battle.png' alt='*'/>";
echo"<a href='search.php?nick=$row[usr]&amp;go=go'>";
echo"$row[usr]</a></span> <font color=lime>Урон:</font>
<span class ='float:right;'/>
<font color=darkorange>".number_format($damageUs, 0, ',', " ")."</font>
</span></div>
<div class ='dl'/></div>";
}
echo '</center></div></div></div></br></br>';
include 'inc/down.php';
?>