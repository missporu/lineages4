<?
defined('PROTECTOR') or die('Error: restricted access');
$req1 = mysql_query("SELECT * FROM `aluko`");   
$aluko = mysql_fetch_array($req1);


if ($user_id=='1'){
if(empty($header)){

// загружаем страницу автонастроек aden
    include($path.'inc/avtoopt.php');
   
//    include($path.'inc/antimat.php'); // антимат
//////////////////////////////////
																																													
////////////////////////////////////////////////////////
echo'<div class="gameBorder"><div class="fon">';

$t=time();

////////////////эвенты //////////////
domin_eve_mob_w();
domin_eve_pk_w();
domin_eve_fish_w();





////////////////////////////////////

mysql_query("DELETE FROM `sahta` WHERE `time` <= '$t' and `usr` = '$log'"); // чистим вышедшее время в руднике
mysql_query("DELETE FROM `anti_pk` WHERE `time` <= '$t'"); // Anti PK чистим прошедшие
mysql_query("DELETE FROM `vip` WHERE `time` <= '$t'"); // ВИП акаунты чистим прошедшие
mysql_query("DELETE FROM `color_text` WHERE `time` <= '$t'"); // цвет текста чистим прошедшие


//-----			ЗАДАНИЯ			------------
$date = date("d.m.Y");
mysql_query("DELETE FROM `job_mob` WHERE `data` != '$date' and `data` != 'no'"); // Задания чистим МОБЫ
mysql_query("DELETE FROM `job_fish` WHERE `data` != '$date' and `data` != 'no'"); // Задания чистим РЫБЫ
mysql_query("DELETE FROM `job_pvp` WHERE `data` != '$date' and `data` != 'no'"); // Задания чистим PvP
mysql_query("DELETE FROM `job_col` WHERE `data` != '$date' and `data` != 'no'"); // Задания чистим CoL
mysql_query("DELETE FROM `cl_job_mob` WHERE `data` != '$date' and `data` != 'no'"); // Задания клана
mysql_query("DELETE FROM `cl_job_mob_log` WHERE `data` != '$date' and `data` != 'no'"); // Задания клана
mysql_query("DELETE FROM `cl_job_fish` WHERE `data` != '$date' and `data` != 'no'"); // Задания клана
mysql_query("DELETE FROM `cl_job_fish_log` WHERE `data` != '$date' and `data` != 'no'"); // Задания клана

	
//-----------------------------------------------------------------------------------------
// если мёрв выполнить																	 //
$reqin = mysql_query("SELECT * FROM `smert` WHERE `usr`='$log' and `life`='no'");		 //
$magia = mysql_num_rows($reqin);
if ($magia!=0) 
{
$magia = mysql_fetch_array($reqin);


$res = mysql_query ("UPDATE users SET
        hp='$magia[hp]',
        mp='$magia[mp]'
		 WHERE usr='$log' LIMIT 1");


$adres = $_SERVER['SCRIPT_NAME'];




if($adres!="/baf.php" && $adres!="/adm_panel.php" && $adres!="/res.php" && $adres!="/chat.php" && $adres!="/main.php" && $adres!="/index.php" && $adres!="/pers.php" && $adres!="/online.php" && $adres!="/forum/*" && $adres!="/msg.php"){

echo'<div class="menu">';

echo"<b> Вы убиты!</b>";
echo"<br/> Выберите способ воскрешения.<br/>";

$exp = $udata[exp]*0.005;
$exp2 = $udata[exp]*0.002;

if ($udata[lvl]<=9)	{echo"<br/><a href=\"res.php?mod=11\">Воскреснуть </a> <br/> До 9 уровня Вас воскрешают без потери опыта.";}else{
	echo"<br/><a href=\"res.php?mod=1\">Воскреснуть самому. Утеря ".number_format($exp, 0, ',', ' ')." EXP </a>";
	echo"<br/><a href=\"res.php?mod=2\">Заплатить целителю 200`000 Аден.  Утеря ".number_format($exp2, 0, ',', ' ')." EXP </a>";}

	
	
echo "</div>";



include($path.'inc/down.php');
exit;}

echo "</div>";
}																						 //
//else {echo " Вы живы <hr/>";} // нет значения											 //
//-----------------------------------------------------------------------------------------
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////
// запись Смерти юзера
$reqin = mysql_query("SELECT * FROM `smert` WHERE `usr`='$log' and `life`='no'");		 //
$magia = mysql_num_rows($reqin);
if ($udata[hp]<=0 and $magia==0)
{
$res = mysql_query ("INSERT INTO `smert` SET
        `usr` = '$log',
        `hp` = '$udata[hp]',
        `mp` = '$udata[mp]',
        `life` = 'no',
        `kom`='Убил моб'");
$loses=$udata[loses];

$ress = mysql_query ("UPDATE users SET
        loses='$loses',
        hp='$udata[hp]'
		 WHERE usr='$log' LIMIT 1");
}
////////////////////////////////////////////////////////////////////////////////////////////////
// загрузка из функции /////////
mysql_query("DELETE FROM `paty` WHERE `act` = 'kill' && `act2` = 'kill'"); // чистим пати

/////////////////////
include($path.'inc/lvl.php');


echo'<div class="head">';


include($path.'inc/opit.php');

if ($exp>100) 
{
$lvlplus="<font color=red>+</font>";
$exp=100;
}

$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$col = mysql_fetch_array($req222);
echo '<div align="left"><font color="#'.$col[color].'"><b>'.$log.'</b></font>';
}else{
echo '<div align="left"><font color="#e4b214"><b>'.$log.'</b></font>';}
echo '<b><font color=grey> | ['.$udata[lvl].']  Ур'.$lvlplus.'</font></b><br/></div>';






if ($udata[hp]>=0){
$hprez=$udata[hp]/$udata[hpall]*100;
$mprez=$udata[mp]/$udata[mpall]*100;

if ($hprez>100) {$hprez=100;};
if ($mprez>100) {$mprez=100;};
} else {$udata[hp]=0; $hprez=0;}



// полоса жизней
//echo '<div style="border:0px solid #330000;background:#282828 url(../theme/pic/fon.png) repeat-x top;height:9px;width:100%;border-radius:1px;"><div style="background:#990000 url(../theme/pic/hp.png) repeat-x top;height:9px;border-radius:1px;width:'.$hprez.'%;"> </div></div>';
echo "<div style='height:15px;background: #330000 url(../theme/pic/exp2.gif) repeat-x top;width:100%; font-size: 15px; position: relative;'>
<div style='height:15px;background: #990000 url(../theme/pic/hp.gif) repeat-x top;width:$hprez%;font-size: 11px; position: relative;'><div style='position: static;'><p align='left'><nobr>&nbsp;&nbsp;HP&nbsp;&nbsp;&nbsp;&nbsp;$udata[hp]/$udata[hpall]</nobr></p></div></div></div>";

// полоса маны
//echo '<div style="border:0px solid #000066;background:#282828 url(../theme/pic/fon.png) repeat-x top;height:9px;width:100%;border-radius:1px;"><div style="background:#3333FF url(../theme/pic/mp.png) repeat-x top;height:9px;border-radius:1px;width:'.$mprez.'%;"> </div></div>';
echo "<div style='height:15px;background: #000066 url(../theme/pic/exp2.gif) repeat-x top;width:100%; font-size: 15px;position: relative;'>
<div style='height:15px;background: #3333FF url(../theme/pic/mp.gif) repeat-x top;width:$mprez%;font-size: 11px; position: relative;'><div style='position: static;'><p align='left'><nobr>&nbsp;&nbsp;MP&nbsp;&nbsp;&nbsp;&nbsp;$udata[mp]/$udata[mpall]</nobr></p></div></div></div>";


// отображает опыт старая
//echo '<br/><div style="background:1px #999999;height:2px;"><div style="background-color:#9900FF;height:2px;width:'.$exp.'%;"></div></div>';

// отображает опыт
echo '<div style="height:15px;background: #757575 url(../theme/pic/exp2.gif) repeat-x top;width:100%; font-size: 15px; position: relative;">
<div style="height:15px;background: #B300FF url(../theme/pic/exp.gif) repeat-x top;width:'.$exp.'%;font-size: 11px; position: relative;"><div style="position: static;"><NOBR><p align="left">&nbsp;&nbsp;EXP&nbsp;&nbsp;&nbsp;&nbsp;'.$exp.'%</p></NOBR></div></div></div>';
echo "<br/></div>";

$drakon = mysql_fetch_array(mysql_query("SELECT drakon FROM `options` where `usr`='$log' LIMIT 1"));
if(empty($drakon['drakon']) or $drakon['drakon']=='yes') {
if($aluko[health]>0 and $udata[lvl]>50){
echo'<div class="slot_menu"><center><img src="/pic/minidrakon.png"><a href="/info_valakas.php?"> <font color=yellow><b>Прилетел Valakas</b></font></a><img src="/pic/minidrakon.png"></center></div>';}
}
if ($udata['news'] == '1')   
{
$nw = mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 1");
$new = mysql_fetch_assoc($nw);
if (isset($_GET['news']))
{   
mysql_query("UPDATE `users` SET `news` ='0' WHERE `id`='".$udata['id']."'"); 
header("Location:/news.php?kom=".$new['id']."");
exit;   
}
echo'<center><div class="dot"><font color="whiteblue">Новая тема в новостях! </font><b>('.$new['title'].')</b><br/><a href="/?news">Читать</center></a></div>';
}



///////////////////////////////////////////////////////////

//-------оплатить разблок-----------------
if (isset($_GET[block_del])){
$req = mysql_query("SELECT * FROM `block` WHERE `usr` = '$log' LIMIT 1");
$avto = mysql_num_rows($req);
if ($avto == 1) {
  
  $ban = mysql_fetch_array($req);    

  if ($ban[cena]>0){
  
$colnew = $udata[almaz]-$ban[cena];

if ($colnew >=0)
{

mysql_query ("UPDATE users SET almaz='$colnew' WHERE usr='$log' LIMIT 1"); // пишем данные игрока с новой суммой

mysql_query("DELETE FROM `block` WHERE `usr` = '$log'"); //удаляем блок

echo "<p><b><font color=green>Блок снят</font></b></p>";

}else
{
echo "<div class=dot><p><b><font color=red>Недостаточно Coin of Luck</font></b></p></div>";
}

}}
}

//------------------------------------------------
$adres = $_SERVER['SCRIPT_NAME'];
if($adres!="/adm_panel.php" && $adres!="/main.php" && $adres!="/search.php" && $adres!="/auto.php" && $adres!="/index.php" && $adres!="/pers.php" && $adres!="/online.php" && $adres!="/tiket.php"){

// если игрок заблочен
$req = mysql_query("SELECT * FROM `block` WHERE `usr` = '$log' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);
if ($avto == 1) {
    $ban = mysql_fetch_array($req);    
    if($ban[ban_time]<$t){
    mysql_query("DELETE FROM `block` WHERE `usr` = '$log'");
    }else{
	echo "<div class=menu>";

    echo"<b><font color=red>Ваш персонаж был Заблокирован!</font></b><br/>
	<font color=grey><b>Кем:<b></font><a href=\"search.php?nick=$ban[log]&amp;go=go\"> $ban[log]</a><br/>
	<font color=lime><b>Причина:</b></font> <font color=green>$ban[text]!</font> <br/>Осталось: ";
$ban[ban_time]=$ban[ban_time]-time();
if($ban[ban_time]<60){
echo "$ban[ban_time] сек.";
}elseif($ban[ban_time]>60 and $ban[ban_time]<3600){
$ban[ban_time]=round($ban[ban_time]/60);
echo "$ban[ban_time] мин.";
}else{$ban[ban_time]=round($ban[ban_time]/3600);
echo "$ban[ban_time] часов";}
echo "</b>"; 

 if ($ban[cena]>0){
 echo "<br/><font color=#2F4F4F> Цена разбл: - $ban[cena] CoL</font>";
 echo'<div class=inoy> <a href="?block_del">&#187; Оплатить</a> </div>';
}

echo "<hr/><p><font color=#989898>Если вы считаете, что заблокированны несправедливо, можете обратится в \"Поддержку\"!</p></font><hr/></b></div></div></center>";
 include($path.'inc/downmain.php');exit;}}




// если игрок заблочен
$ip=htmlspecialchars(stripslashes($_SERVER['REMOTE_ADDR']));
$req = mysql_query("SELECT * FROM `block_ip` WHERE `ip` = '$ip' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);
if ($avto == 1) {
    $ban = mysql_fetch_array($req);    
    if($ban[ban_time]<$t){
    mysql_query("DELETE FROM `block_ip` WHERE `ip` = '$ip'");
    }else{
	echo "<div class=menu>";

    echo"<b><font color=red>Ваш персонаж был Заблокирован!</font></b><br/>
	<font color=grey><b>Кем:<b></font><a href=\"search.php?nick=$ban[log]&amp;go=go\"> $ban[log]</a><br/>
	<font color=lime><b>Причина:</b></font> <font color=green>$ban[text]!</font> <br/>Осталось: ";
$ban[ban_time]=$ban[ban_time]-time();
if($ban[ban_time]<60){
echo "$ban[ban_time] сек.";
}elseif($ban[ban_time]>60 and $ban[ban_time]<3600){
$ban[ban_time]=round($ban[ban_time]/60);
echo "$ban[ban_time] мин.";
}else{$ban[ban_time]=round($ban[ban_time]/3600);
echo "$ban[ban_time] часов";}
echo "</b>"; 

 if ($ban[cena]>0){
 echo "<br/><font color=#2F4F4F> Цена разбл: - $ban[cena] CoL</font>";
 echo'<div class=inoy> <a href="?block_del">&#187; Оплатить</a> </div>';
}

echo "<hr/><p><font color=#989898>Если вы считаете, что заблокированны несправедливо, можете обратится в \"Поддержку\"!</p></font><hr/></b></div></div></center>";
 include($path.'inc/downmain.php');exit;}}
 }





//--------	----------	 админка	---------------------


///////////////////////////////////
$wm = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm`"));// новые заявки пополнения WebMoney
if ($wm!==0){$wm1="+$wm";}

if($udata[dostup]>=4){

if($udata[dostup]==5){$gmsilka = '<a href="/gm/redactor.php">Редакторы</a> | <a href="/gm">GM<font color=red>'.$wm1.'</font></a> 		| ';}

$tk7 = mysql_query("SELECT * FROM `tiket_tm` WHERE news != ''");
$avt = mysql_num_rows($tk7);

/////////////////////////////////////////////////////////////////////////////////////
// щитаем количество постов новых													//
if ($avt>=1){																		//
While($tk = mysql_fetch_array($tk7))												//
{																					//
$rez = $tk[news] + $rez;															//
}}																					//
if ($rez>0){$rezl = "(+$rez)";}														//

echo "<div class=dot><div class=admin><center>";
echo'<b> '.$gmsilka.'

   

<a href="/adm_chat.php?">АЧ</a> 		|  

<a href="/adm_panel.php?">АП</a> 		|  
<a href="/tiket_adm.php">ЦП '.$rezl.'</a> 	<br/>
</b>';
echo "</center></div></div>";
}
/*
if($udata['time']>=3600*5 && mt_rand(0,100) == 15) {
$code = intval(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/snowmans/db/db.dat'));
echo '<div class="slot_menu"><a href="/snowmans/index.php?act=snow&amp;code=', $code, '"><center><img src="pic/snowman.png" height="16" width="16" alt="snow" /><b><font color=lightskyblue>Выпала Иголка</a></font></b></center></div>';
}
*/

if($udata[dostup]==2 or $udata[dostup]==3){
echo "<div class=dot><div class=admin><center>";

echo'	<a href="/mod_panel.php?">МД-П</a> | 
		<a href="/adm_chat.php?">Адм-Чат</a> |	
		<a href="/tiket_adm.php">ЦП '.$rezl.'</a>
		';	//
																					//
echo "</center></div></div>";																//
}
if($udata[time]<3600*24*7){
if($udata[dostup]<1 or $udata[usr]=='Shiki'){
$frazy = mysql_fetch_array(mysql_query('SELECT * FROM `text` ORDER BY RAND() LIMIT 1'));
//echo '<div class=news><img src="/pic/anonser.png" alt="" height="20" width="20"> <font color=gold>' . $frazy['text'] . '</font></div>';
}}
///////////////////////////////////////////////////////////////////////////////////////////

$reqac = mysql_query("SELECT * FROM `academy` WHERE `student` = '$log' LIMIT 1");
$ac = mysql_num_rows($reqac); 

if($ac>0){
if($udata[lvl]>72){
$reqclan = mysql_query("SELECT * FROM `clan` where `lider`='$udata[clan]'");
$clan = mysql_fetch_array($reqclan);
$clanrep=$clan[rep]+1;
mysql_query("UPDATE clan SET rep = '$clanrep' WHERE lider = '$udata[clan]' LIMIT 1");
mysql_query("UPDATE users SET clan = '' WHERE usr = '$log' LIMIT 1");
mysql_query("DELETE FROM academy WHERE student = '$log' LIMIT 1");
}
}   


if($udata[dostup] > 4){
$reqac = mysql_query("SELECT * FROM `item` WHERE `time` >1");
$ac = mysql_num_rows($reqac); 
if($ac>0){
mysql_query("DELETE FROM `item` WHERE `time`  >1 ");
}}


$reqis = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
    $prov = mysql_fetch_array($reqis);    

if($prov[place]=="chat" or $prov[place]=="forum_in" or $prov[place]=="tchat" or $prov[place]=="msg"){


// если игрок забанен
$req = mysql_query("SELECT * FROM `ban` WHERE `usr` = '$log' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);
if ($avto == 1) {
    $ban = mysql_fetch_array($req);    
    if($ban[ban_time]<$t){
    mysql_query("DELETE FROM `ban` WHERE `usr` = '$log'");
    }else{
echo'<div class="foot"><center>';
    echo"<b><font color=red>Ваш персонаж был забанен!</font></b><br/> <font color=lime><b>Причина:</font> <font color=green>$ban[text]!</font> <br/>Осталось: ";
$ban[ban_time]=$ban[ban_time]-time();
if($ban[ban_time]<60){
echo "$ban[ban_time] сек.";
}elseif($ban[ban_time]>60 and $ban[ban_time]<3600){
$ban[ban_time]=round($ban[ban_time]/60);
echo "$ban[ban_time] мин.";
}else{$ban[ban_time]=round($ban[ban_time]/3600);
echo "$ban[ban_time] часов";}
echo "</b>"; 
echo "<br/><br/>Вам закрыт доступ в Почту, Чат и Форум.<br/><br/>";
 include($path.'inc/down.php');exit;}}}
//////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////


if($inpk=='1' and $headmod != 'pk'){
echo'<div class="info" align="center">';
echo"<a href=\"pk.php?\"><b>В бой</b></a>";
echo'</div>';
}
if($inar=='1' and $headmod != 'combat'){
echo'<div class="info" align="center">';
echo"<a href=\"combat.php?\"><b>В бой</b></a>";
echo'</div>';
}
$q = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`!='Система' AND `user_from`!='Рассылка от администрации' AND `read` = '1';");
$new_mail = mysql_result($q, 0);
if($new_mail > 0){
echo'<div class=silka><div class="info" align="center"><div style="font-size: 13px;border-bottom		:#000033 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';
echo"<a href=\"/msg.php?mod=read\"><font color=#CCCCCC><b>Сообщения +$new_mail </font></b></a></div></div>";
echo"</div>";}

$qras = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`='Рассылка от администрации' AND `read` = '1';");
$new_ras = mysql_result($qras, 0);
if($new_ras > 0){
echo'<div class=silka><div class="info" align="center"><div style="font-size: 13px;border-bottom		:#000033 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';
echo"<a href=\"/msg.php?mod=ras\"><font color=#CCCCCC><b>Рассылки +$new_ras </font></b></a></div></div>";
echo"</div>";}

$qsys = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `user_from`='Система' AND `read` = '1';");
$new_sys = mysql_result($qsys, 0);
if($new_sys > 0){
echo'<div class=silka><div class="info" align="center"><div style="font-size: 13px;border-bottom		:#000033 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';
echo"<a href=\"/msg.php?mod=sys\"><font color=#CCCCCC><b>Системные +$new_sys </font></b></a></div></div>";
echo"</div>";}





////////////		Вернуться в бой 	//////////////
//-------------------------------------
$adres = $_SERVER['SCRIPT_NAME'];
if($adres!="/battle.php" and $in_battle=='1'){ 
echo'<div class=silka><div class="info" align="center"><div style="font-size: 13px;border-bottom		:#000033 solid  1px; padding		: 1% 1% 1% 1%; width:200px;">';
echo"<a href=\"/battle.php\"><font color=#CCCCCC><b>&#187 Вы находитесь в бою &#171 </font></b></a></div></div>";
echo"</div>";}
///////////////////////////////////////////////////////////////////////////////


////////////		Мой питомец	//////////////
//-------------------------------------
$pita345 = mysql_query("SELECT id,hp,hpall,lvl,name,lasteda FROM `pit` WHERE `usr` = '$log' and `status`='on'");
$avtopit = mysql_num_rows($pita345);     
$adres = $_SERVER['SCRIPT_NAME'];
if($avtopit==1 and $adres!="/pit.php"  and $adres!="/pitomec.php"){ $pit = mysql_fetch_array($pita345);
if ($pit[hp]>=0){
$hprezpit=$pit[hp]/$pit[hpall]*100;

if ($hprezpit>100) {$hprezpit=100;};
} else {$pit[hp]<=0; $hprezpit=0;}

echo "<br/><div class=\"paty\"><div style=margin-left:7px;><b> Питомец: <a href=\"/pit.php?mod=mypit\">$pit[name]</a> - $pit[lvl] ур.</b><br/>";

echo '<span style="top:9px;left:2%;color:#FF6633;"> <b>HP:</b>    '.number_format($pit[hp], 0, ',', "`").' / '.number_format($pit[hpall], 0, ',', "`").'</span>&nbsp;&nbsp;';
echo '<span style=color:orange;>';
		$pit[lasteda]=$pit[lasteda]-time();
if($pit[lasteda]<60){
echo "[$pit[lasteda] сек.]<br/>";
}elseif($pit[lasteda]>60 and $pit[lasteda]<3600){
$pit[lasteda]=round($pit[lasteda]/60);
echo "[$pit[lasteda] мин.]<br/>";
}else{
$pit[lasteda]=round($pit[lasteda]/3600);
echo "[$pit[lasteda] ч.]<br/>";
}
echo '</span><br/>';

//echo '<div style="border:1px solid #330000;font-size: 9px;background:1px #282828;height:10px;width:120px;"><div style="background-color:#990000;height:10px;width:'.$hprezpit.'%;"></div></div>';
echo "</div></div>";
}
/*
echo"<hr><font color=orange>Аден</font>:<font color=grey> ".number($udata[money])."</font><br/>";
echo"<font color=yellow>Coin of Luck</font>: <font color=grey>".number($udata[almaz])."</font><br/>";
echo"<font color=red>Vote</font><font color=yellow>Coin</font>: <font color=grey>".number($udata[votecoin])."</font><br/>";
echo"<a href='ig_info.php'><font color=lightskyblue>Иголки</font></a>:<font color=grey> ".number($udata[ig])."</font><hr><br/>";
*/
$ram = mysql_fetch_array(mysql_query("SELECT ramka FROM `options` where `usr`='$log' LIMIT 1"));
if($ram['ramka']=='yes') {
echo"<div class='slot_menu'><img src='/pic/adena.png' height='20' width='20'> <font color='orange'>".number($udata[money])."</font> | <img src='/pic/coin.png' height='20' width='20'> <font color='yellow'>".number($udata[almaz])."</font> | <img src='/pic/vote.png' height='20' width='20'> <font color='whiteblue'>".number($udata[votecoin])."</font> | <img src='/pic/crystal.png'><font color='silver'>".number($udata[crystal])."</font></div><hr>";
}


///////////////////////////////////////////////////////////////////////////////


//--------озеро----------
$adres = $_SERVER['SCRIPT_NAME']; $avto = mysql_num_rows(mysql_query("SELECT * FROM `fish` WHERE `usr` = '$log' LIMIT 1"));
if($adres!="/fish.php" && $adres!="/adm_panel.php" && $adres!="/res.php" && $avto==1){
echo'<div class=silka align="center"><div style="font-size: 13px;border-bottom:#000033 solid  1px; padding: 1% 1% 1% 1%; width:200px;">';
echo"<a href=\"/fish.php\"><span style=color:#3636FF;>&#187 Вернуться к рыбалке &#171 </span></a></div></div>";}
//----------------------------------



////////////		Навыки игрока показ 	//////////////
//-------------------------------------
$adres = $_SERVER['SCRIPT_NAME'];
if($adres!="/pers.php"){
  if($udata[skill]>0){echo"<div><div class=\"info\"><div class=silka><b><a href=\"/pers.php?\"><font color=#969696>&#187 Активные навыки </font><font color=red>+".$udata[skill]."</font></a></b></div></div>";}
}
  //-------------------------------------
///////////////////////////////////////////////////////////////////////////////
		
	//-----Создание анкеты---------
		$ank = mysql_query("SELECT * FROM `anketa` WHERE `nik` = '$log'");
		$ank=mysql_num_rows($ank);
	
		if($ank == 0)
		{
		echo " <div class=\"info\"><div class=silka><b><a href=\"/anketa.php?&go=4\"><font color=silver>&#187 Создать анкету</font></a></div></div>";
		}

	//------------------------------//------------------------
	
	// -------- Приглашения в клан ----------------
	$req = mysql_query("SELECT * FROM `invite` WHERE `usr` = '$log'");
	$inv=mysql_num_rows($req);

	if($inv > 0)
		{
		echo " <div class=\"info\"><div class=silka><b><a href=\"index.php?mod=inv\"><font color=silver>&#187 Приглашения в клан </font><font color=grey> +$inv </font></a></div></div>";
		}
	
	//------------------------------//------------------------
// -------- Приглашения замуж----------------
$req = mysql_query("SELECT * FROM `zamuj` WHERE `usr` = '$log'");
$avto=mysql_num_rows($req);
if($avto>=1){
echo'<div class="info">';
echo"<a href=\"zayavka.php\">Предложение замуж</a>";

echo'</div>';
}
$supp = mysql_query("SELECT * FROM `option_game` WHERE `id` = '1'");
$supp = mysql_fetch_array($supp); 
if($supp['tex'] == on){
$adres = $_SERVER['SCRIPT_NAME'];
if ($udata[dostup]<4 && $adres!="/chat.php" && $adres!="/ticket.php"){
echo "<hr/><p><font color=red>Приносим свои извинения. Проводятся технические работы! Но Вы можете пока пообщаться в нашем <a href=\"chat.php\"><b>Чате</b> !</a></p></font><hr/></b></div></div></center>";
include($path.'inc/end.php');exit;}

$adres = $_SERVER['SCRIPT_NAME'];
}
if($adres!="/paty.php" && $adres!="/forum.php"){
	
		// ---- Пати ------
// Создавший (usr)

	// приглашение
		$paty = mysql_query("SELECT * FROM `paty` WHERE `usr` = '$log' and `act` = 'no'");
		$avto=mysql_num_rows($paty);
	if ($avto>=1){
		$usr = mysql_fetch_array($paty);

echo "<div class=\"paty\"><b>Вам предлогает пати <a href=\"search.php?nick=$usr[usr]&amp;go=go\">$usr[usr]</a> </b><br/>";
echo "<p> <b><a href=\"paty.php?&pt=yes\">Согласен</a></b> | ";
echo " <b><a href=\"paty.php?&pt=kill\">Отказатся</a></b></p></div>";
}else{



		$pgl = mysql_query("SELECT * FROM `paty` WHERE `usr` = '$log' and `act` != 'kill'");
		$avt=mysql_num_rows($pgl);
		

		if($avt >= 1)
		{
		$pgl = mysql_fetch_array($pgl);
		$u = mysql_query("SELECT * FROM `users` WHERE `usr` = '$pgl[usr2]'");
		$usr = mysql_fetch_array($u);
if ($usr[hp]>=0){
$php=$usr[hp]/$usr[hpall]*100;
$pmp=$usr[mp]/$usr[mpall]*100;

if ($hprez>100) {$hprez=100;};
if ($mprez>100) {$mprez=100;};
} else { $php=0;}

		$pgl2 = mysql_query("SELECT * FROM `paty` WHERE `usr` = '$log' and `act2` = 'yes' Limit 1");
		$avt2=mysql_num_rows($pgl2);
if ($avt2>=1){

		echo "<div class=\"paty\"><font color=lime><b>*</b></font><b> Пати с <a href=\"search.php?nick=$usr[usr]&amp;go=go\">$usr[usr]</a> - $usr[lvl] ур.</b><br/>";
echo '</center>	<span style="top:9px;left:2%;color:#FF6633;"> <b>HP:</b>    '.$usr[hp].' / '.$usr[hpall].'</span><div style="border:1px solid #330000;font-size: 9px;background:1px #282828;height:10px;width:120px;"><div style="background-color:#990000;height:10px;width:'.$php.'%;"></div></div>';
echo '			<span style="top:9px;left:2%;color:#33FFFF;"> <b>MP:</b>    '.$usr[mp].' / '.$usr[mpall].'</span><div style="border:1px solid #000066;font-size: 9px;background:1px #282828;height:10px;width:120px;"><div style="background-color:#3333FF;height:10px;width:'.$pmp.'%;"></div></div>';
		echo "<div class=\"silka\"> <b><a href=\"paty.php?&pt=kill\">Покинуть пати</a></b></div></div>";
		}else { 
		if ($pgl[act2]=="kill"){$sm="<font color=red> Игрок отказался от участия в пати.</font>";}else{$sm="Игроку выслано приглашение.";}
echo "<div class=\"paty\"><font color=lime><b>*</b></font><b> Пати с <a href=\"search.php?nick=$usr[usr]&amp;go=go\">$usr[usr]</a> - $usr[lvl] ур.</b><br/>";
echo " $sm";
		echo "<div class=\"silka\"> <b><a href=\"paty.php?&pt=kill\">Покинуть пати</a></b></div></div>";
}
 }
}
 
 
 ////////////////////
 	// приглашение
		$paty2 = mysql_query("SELECT * FROM `paty` WHERE `usr2` = '$log' and `act2` = 'no'");
		$avto2=mysql_num_rows($paty2);
	if ($avto2>=1){
		$usr = mysql_fetch_array($paty2);
	
	if ($usr[usr]=='***'){
echo "<div class=\"paty\"><b>Вам предлогали пати! </b><br/>";
echo "<font color=red>Игрок отказался от учасия.</font> <br/>";
echo " <b><div class=silka><a href=\"paty.php?&pt=kill\">Отказатся так же</a></b></div></div>";
}else{

echo "<div class=\"paty\"><b>Вам предлогает пати <a href=\"search.php?nick=$usr[usr]&amp;go=go\">$usr[usr]</a> </b><br/>";
echo "<p> <b><a href=\"paty.php?&pt=yes\">Согласен</a></b> | ";
echo " <b><a href=\"paty.php?&pt=kill\">Отказатся</a></b></p></div>";}
}else{

// принявший (usr2)		
		$p = mysql_query("SELECT * FROM `paty` WHERE `usr2` = '$log' and `act2` != 'kill'");
		$avt=mysql_num_rows($p);
		

		if($avt >= 1)
		{
		$p = mysql_fetch_array($p);
		$u = mysql_query("SELECT * FROM `users` WHERE `usr` = '$p[usr]'");
		$usr = mysql_fetch_array($u);
if ($usr[hp]>=0){
$php=$usr[hp]/$usr[hpall]*100;
$pmp=$usr[mp]/$usr[mpall]*100;

if ($hprez>100) {$hprez=100;};
if ($mprez>100) {$mprez=100;};
} else { $php=0;}

		$pgl2 = mysql_query("SELECT * FROM `paty` WHERE `usr2` = '$log' and `act` = 'yes' Limit 1");
		$avt2=mysql_num_rows($pgl2);
if ($avt2>=1){

		echo "<div class=\"paty\"><font color=blue><b>*</b></font><b> Пати с <a href=\"search.php?nick=$usr[usr]&amp;go=go\">$usr[usr]</a> - $usr[lvl] ур.</b><br/>";
echo '</center>	<span style="top:9px;left:2%;color:#FF6633;"> <b>HP:</b>    '.$usr[hp].' / '.$usr[hpall].'</span><div style="border:1px solid #330000;font-size: 9px;background:1px #282828;height:10px;width:120px;"><div style="background-color:#990000;height:10px;width:'.$php.'%;"></div></div>';
echo '			<span style="top:9px;left:2%;color:#33FFFF;"> <b>MP:</b>    '.$usr[mp].' / '.$usr[mpall].'</span><div style="border:1px solid #000066;font-size: 9px;background:1px #282828;height:10px;width:120px;"><div style="background-color:#3333FF;height:10px;width:'.$pmp.'%;"></div></div>';
		echo "<div class=\"silka\"> <b><a href=\"paty.php?&pt=kill\">Покинуть пати</a></b></div></div>";
		}else { 
		if ($p[act]=="kill"){$sm="<font color=red> Игрок отказался от участия в пати.</font>";}else{echo "Игроку выслано приглашение.";}
echo "<div class=\"paty\"><font color=lime><b>*</b></font><b> Пати с <a href=\"search.php?nick=$usr[usr]&amp;go=go\">$usr[usr]</a> - $usr[lvl] ур.</b><br/>";
echo " $sm";
		echo "<div class=\"silka\"> <b><a href=\"paty.php?&pt=kill\">Покинуть пати</a></b></div></div>";
}
 }

}
}
////////////////////////////////////////////////////////////////
color_akk();
baf();
////////////////////////////////////////////////////************************************************

$req = mysql_query("SELECT * FROM `baf` WHERE `usr` = '$log'");
$avto = mysql_num_rows($req);
if($avto>=1){


While($aur = mysql_fetch_array($req))
{

if ($aur[tip]=='bafkrit'){$tip="Критов";}
if ($aur[tip]=='bafat'){$tip="Атаки";}
if ($aur[tip]=='bafzash'){$tip="Защиты";}
if ($aur[tip]=='bafzat'){$tip="Защиты и Атаки";}

if ($aur[tip]=='5kad'){$tip=" +2k Att & Def ";}
if ($aur[tip]=='40kad'){$tip=" +10k Def & Att ";}
if ($aur[tip]=='300'){$tip=" +300% Def & Att ";}
if ($aur[tip]=='4001'){$tip=" +400% Def & Att ";}
if ($aur[tip]=='4002'){$tip=" +400% Def & Att ";}
if ($aur[tip]=='4003'){$tip=" +400% Def & Att ";}

if ($aur[tip]=='200kad'){$tip=" +60k Def & Att ";}
if ($aur[tip]=='777kad'){$tip=" +60k Def & Att ";}
if ($aur[tip]=='200'){$tip=" +200% Def & Att ";}


echo'<div class="info">';
echo"<b>Баф  $tip  </b>";

$aur[time]=$aur[time]-time();
if($aur[time]<60){
if ($aur[time]<=0){$aur[time]=0;}
echo " - $aur[time] сек.";
}else{
$aur[time]=round($aur[time]/60);
echo " - $aur[time] мин.";
echo"$del <a href=\"baf_vip.php?mod=baf&de=del\"><font color=red>[x]</font></a>";
if ($_GET[de]==del && $_GET[ye]!==yes){
echo "<p><font color=green>Вы уверены что хотите удалить Баф?</font><br/>
<a href=\"baf_vip.php?mod=baf&de=del&ye=yes\"><font color=red>Да</font></a> |
<a href=\"baf_vip.php?mod=baf\"><font color=grey>Нет</font></a></p><hr/>";}
if ($_GET[de]==del && $_GET[ye]==yes){
$req1 = mysql_query("SELECT * FROM `baf` WHERE `usr` = '$log' LIMIT 1");
//$avto=mysql_num_rows($req222);
if($avto==1){
$avto1=mysql_num_rows($req1);
 if($avto1>0){ 
$timebaf = time();
$resvip = mysql_query("UPDATE `baf` SET `time` = '$timebaf'  WHERE usr = '$log'");}
if ($resvip == 'true'){
echo "<p><font color=red>Баф успешно удален! Обновите страницу</font></p><hr/>";}}}
}
echo' </div>';
}
}
	
//-------------------лог бафов--------------------------
$req = mysql_query("SELECT * FROM `baf_log` WHERE `usr` = '$log'");
$avto = mysql_num_rows($req);
if($avto>=1){
While($baf = mysql_fetch_array($req))
{
echo "<div class=dot>$baf[text]</div>";

mysql_query("DELETE FROM `baf_log` WHERE usr='$log'");//чистим логи

}}
///////*************************************************



echo'<div class="menu"></b></a>';



// онлайн считает
include($path.'inc/avto_online.php');
//интервал между загрузкой страниц
include($path.'inc/interval.php');




////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `id` = '$udata[id]' LIMIT 1");
  $udata = mysql_fetch_assoc($req);
//-------------------------------------
///////////////////////////////////////////////////////////////////////////////




}}
else
{
echo "<div class=gameBorder><div class=menu><br/><b>Ошибка!Вы не авторизованы!</b><br/><br/><div class=silka><a href='index.php'>Авторизуйтесь</a></div></div>";include($path.'inc/end.php');exit;
}
?>