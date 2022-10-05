<?php

$headmod = 'search';//фикс. места

$textl='Персонаж';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if(empty($_POST[nick])){
$nick=$_GET[nick];
}else{
$nick=$_POST[nick];}
$nick = htmlspecialchars(stripslashes($nick));

switch($_GET[go]) {

default:

if($_GET[act]!=deluser and $_GET[act]!=mag){


echo "<form action=\"search.php?go=go\" method=\"post\">Введите ник:<br/>";
echo "<input name=\"nick\" maxlength=\"10\" title=\"nick\" emptyok=\"true\"/><br/>";
echo "<input type=\"submit\" value=\"Найти\" /></form>";

}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////// Доступно только с правами выше 3 //////////////////////////////////////////////////////
if($_GET[act]==deluser && $udata[dostup]>3){
echo'Удалить игрока игрока <b>'.$nick.'</b><br/>';
echo'<a href="adm_panel.php?mod=deluser&nick='.$nick.' ">Удалить</a><br/>';
echo'<a href="search.php?nick='.$nick.'&go=go">Не удалять</a><br/>';
}


if($_GET[act]==mag && $udata[dostup]>3){

echo " Умения игрока <b>$nick</b> <br/><br/>";

if($_GET[activ]==yes){

mysql_query("UPDATE `mag` SET `activ` = 'yes' WHERE  id = '$_GET[id]'");} // скил активен

if($_GET[activ]==no){

mysql_query("UPDATE `mag` SET `activ` = 'no' WHERE  id = '$_GET[id]'");}	//скил отключ

if($_GET[activ]==del){

if (!empty($_POST[result])){
$ressave = mysql_query("DELETE FROM `mag` WHERE id = '$_POST[result]'");	//удаляем скил

				if ($ressave == 'true')
					{
					echo '<font color=#007F46><p>Умение удаленно '.$nick.' - '.$_POST[result].' !</p></font>'; // удачно
					}
					else
					{
					echo "<font color=red><p> Ошибка доступа! </p></font>";  // неудачно =)
					}

//mysql_query("UPDATE `mag` SET `activ` = 'no' WHERE usr = '$nick' and id = '$_GET[id]'");
}else{echo "<font color=#007F7F><p>Вы не выбрали умение!</p></font> ";}

}

$req = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$nick'");
if(mysql_num_rows($req)>=1)
{
While($mag = mysql_fetch_array($req))
{
$maglvl=$mag[lvl]-1;
$magmp=explode("|",$mag[mp]);
$mag[mp]=$magmp[$maglvl];//мп

$maghp=explode("|",$mag[hp]);
$mag[hp]=$maghp[$maglvl];//хп

$maghp=explode("|",$mag[plushp]);
$mag[plushp]=$maghp[$maglvl];//+хп

$maghp=explode("|",$mag[uron]);
$mag[uron]=$maghp[$maglvl];//+урон
echo'<div class="event">';

if ($mag[ruka]=='me4'){$tp="Меч";}
if ($mag[ruka]=='kas'){$tp="Кастет";}
if ($mag[ruka]=='rap'){$tp="Рапиру";}
if ($mag[ruka]=='luk'){$tp="Лук";}
if ($mag[ruka]=='kin'){$tp="Кинжал";}

if ($mag[tip]=='atack'){$tip="Атака";}
if ($mag[tip]=='bafkrit'){$tip="Баф Критов";}
if ($mag[tip]=='bafat'){$tip="Баф Атаки";}
if ($mag[tip]=='bafzash'){$tip="Баф Защиты";}
if ($mag[tip]=='bafzat'){$tip="Баф Защиты и Атаки";}
if ($mag[tip]=='hpot'){$tip="Отжор";}
if ($mag[tip]=='hp'){$tip="Реген. HP";}
if ($mag[tip]=='mp'){$tip="Реген. MP";}
if ($mag[tip]=='bafmp'){$tip="Баф на ману";}
if ($mag[tip]=='bafhp'){$tip="Баф на жизни";}
if ($mag[tip]=='resp'){$tip="Респ. игрока";}
if ($mag[tip]=='spoil'){$tip="Спойлинг";}
if ($mag[tip]=='spoilall'){$tip="Спойлинг всех вещей";}

echo "<form action=\"search.php?act=mag&activ=del&nick=$nick\" method=\"POST\">";


echo"<hr/><img src=\"pic/skils/$mag[name].jpg\" alt=\"pic\"/> ";

echo " <label><input type='radio' name='result' value='$mag[id]' /></label>\n";

if ($mag[activ]=='' or $mag[activ]=='yes'){
echo"	<a href=\"search.php?act=mag&activ=no&id=$mag[id]&nick=$nick\"><b><font color=green>$mag[name]</font></b></a>				";}
if ($mag[activ]=='no'){
echo"	<a href=\"search.php?act=mag&activ=yes&id=$mag[id]&nick=$nick\"><b><font color=red>$mag[name]</font></b></a>				";}


echo"<br/>Уровень: $mag[lvl]<br/>";


echo"Класс: ";
if($mag[klas]=="wizard"){echo"Маг<br/>";}
if($mag[klas]=="fighert"){echo"Воин<br/>";}
echo"Урон: $mag[uron]<br/>";
echo"Забирает маны: $mag[mp]<br/>";
echo"Забирает здоровья: $mag[hp]<br/>";
echo"Даёт здоровья: $mag[plushp]<br/>";
echo"Тип умения: $tip</div>";
if ($mag[ruka] =="not" or $mag[ruka]==""){}else
{
echo "<font color=grey>Для использования нужно держать в руках <b>$tp</b></font><br/>";
}

}
}else{
echo '<b>Нет умений!</b>';
}
/////////////

echo "<hr/>";
echo " <div class=menu><input type='submit' name='ok' value='Удалить умение' /></div>\n";

echo "<font color = lime>  ** Выберите скил из списка если хотите удалить его. </font><br/>";
echo "<font color = lime> - <font color=red>Красное</font> умение означает выключенно.<br/>
-<font color=green> Зелёное</font> активно. <br/>
- <b>Клацнув на скил Вы его \"активируете\" или \"отключите\".</b></small>
";

echo "</font><hr/>";
echo"<br/><a href=\"search.php?&nick=$nick\">Назад</a>";
}
//////////////////////////////////////////////////////////////////////////////////////////////




break;

// игнор ////////////////////////////////////////////////////////





case 'dr':
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
$avto=mysql_num_rows($req);
			if($avto=="0"){
			echo'Нет такого игрока!';
			include($path.'inc/down.php');
			include($path.'inc/meny.php');
			exit;}
	$usdata = mysql_fetch_array($req);
			if(empty($_GET[nick])){
			echo"Ошибка невыбран игрок!";
			include($path.'inc/down.php');
			include($path.'inc/meny.php');
			exit;}
$req = mysql_query("SELECT * FROM `msg_ignor` WHERE `usr`= '$log' and `contact` = '".mysql_real_escape_string($_GET['nick'])."' LIMIT 1");
$avto=mysql_num_rows($req);
	if($avto==1){
		echo'У вас уже есть этот персонаж в игноре!';
		include($path.'inc/down.php');
		include($path.'inc/meny.php');
	exit;}
			if($usdata[dostup]>1){
				echo'Администрацию добавлять в игнор запрещено!<br/>';
				include($path.'inc/down.php');
				include($path.'inc/meny.php');
			exit;}
	if($_GET[nick]==$log){
		echo'Cебя добавить нельзя!<br/>';
		include($path.'inc/down.php');
		include($path.'inc/meny.php');
	exit;}
//mysql_query("INSERT INTO info_ignor SET usr='$log',msg='$log добавил в игнор лист $_GET[nick].'");
mysql_query("INSERT INTO `msg_ignor` SET `usr` = '$log', `contact` = '$_GET[nick]'");

echo "<p>$_GET[nick] успешно добавлен в игнор!</p>";
echo"<a href=\"search.php?go=go&amp;nick=$nick\">Назад</a>";
break;

////*******

case 'del_ign':
if(empty($_GET[contact])){
echo"Ошибка невыбран игрок!";
include($path.'inc/down.php');
include($path.'inc/meny.php');
exit;
}
$req = mysql_query("SELECT * FROM `msg_ignor` where `contact`='".mysql_real_escape_string($_GET['contact'])."'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');
include($path.'inc/meny.php');
exit;}

//mysql_query("INSERT INTO info_ignor SET usr='$log',msg='$log удалил с игнор листа '".mysql_real_escape_string($_GET['contact'])."'");
mysql_query("DELETE FROM `msg_ignor` WHERE `contact` = '".mysql_real_escape_string($_GET['contact'])."'");
echo"<p>$_GET[contact] удалён из игнор листа!</p>";
echo"<a href=\"search.php?go=go&amp;nick=$_GET[contact]\">Назад</a>";

break;

////////////////////////////////////////////////

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

//////////------------//////////////------------------///////////

case 'go':

if($nick=="admin"){echo '<center><br>Ник Админа <b>KraToS</b>!<br></center>';include($path.'inc/down.php');exit;}

$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
///////////////////////////
$avto=mysql_num_rows($req);

if($avto=="0"){
echo'Нет такого игрока!';
include($path.'inc/down.php');exit;
}

$usdata = mysql_fetch_array($req);
////////////////////////////


///////////////////////////
// звания




if ($usdata[st]==0) {$st='Бродяга';}
if ($usdata[st]==1) {$st='Вассал';}
if ($usdata[st]==2) {$st='Старейшина';}
if ($usdata[st]==3) {$st='Мудрец';}


if(!empty($usdata[clan])){
$req = mysql_query("SELECT `emblema` FROM `clan` WHERE `lider` = '$usdata[clan]'");
$wh = mysql_fetch_array($req);

if(!empty($wh[emblema])){
echo "<img src=\"pic/clan/$wh[emblema]\" alt=\"clan\"/> <b>$nick</b> [$st]<br/>";}else{
echo" <b>$nick</b> [$st]<br/>";
}
}else{
echo" <b>$nick</b> [$st]<br/>";}
if($usdata[dostup]==5){
echo"<font color=red><b> Создатель </b></font><br/>";
}
if($usdata[dostup]==4){
echo"<font color=lime><b> Администратор </b></font><br/>";
}
if($usdata[dostup]==3){
echo"<font color=blue><b> Старший Модератор </b></font><br/>";
}
if($usdata[dostup]==2){
echo"<font color=blue><b> Модератор </b></font><br/>";
}
if($usdata[dostup]==1){
echo"<font color=silver><b> Консультант </b></font><br/>";
}

if($udata['dostup']>1 and $udata['dostup']>=$usdata['dotup']){
$acc=mysql_fetch_assoc(mysql_query("SELECT * FROM `account` WHERE `id` = '".$usdata['account']."' "));
echo'Персонаж находится на аккаунте <b>'.$acc['nick'].'</b></br>';
}

echo'Ресетов '.$usdata[res].' ';
echo"<font color='grey'><b>";
if($usdata[klas]=="wizard"){$kl="m";$kln="Маг";}
if($usdata[klas]=="fighert"){$kl="f";$kln="Воин";}

if($usdata[storona]=="ork"){echo"<b>Орк</b> ";}
if($usdata[storona]=="elf"){echo"<b>Cветлый Эльф</b> ";}
if($usdata[storona]=="darkelf"){echo"<b>Темный Эльф</b> ";}
if($usdata[storona]=="human"){echo"<b>Человек</b> ";}
if($usdata[storona]=="gnom"){echo"<b>Гном</b> ";}
if($usdata[storona]=="kamael"){echo"<b>Камаэль</b> ";}



echo $kln;

echo"</b></font></b>";

$whiel = mysql_query("SELECT * FROM `msg_users` WHERE `user_id` = '$udata[id]'");
$lists = mysql_fetch_array($whiel);

if ($nick == $lists[contact]){echo "<br/>";} else{echo "<a href=\"search.php?go=adding&nick=$nick\"> + </a><br>";}
if ($usdata[prof]=='' or $usdata[prof]=='no'){$usdata[prof]='Нет';}
echo "Проффесия: <font color=#FF6A00>$usdata[prof]</font><br/>";
// если есть бафы
$reqi222 = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$log' and 
`tip` = 'bafat' or `usr` = '$log' and
`tip` = 'bafkrit' or `usr` = '$log' and
`tip` = 'bafzash' or `usr` = '$log' and
`tip` = 'resp' or `usr` = '$log' and
`tip` = 'bafzat' or `usr` = '$log' and
`tip` = 'bafhp'");

//////////////////////////////////////////////////////////////////////////////////////////////
//	статус 
if (!empty($usdata[status])){
echo '<div style="border:1px solid #404040;padding:3px;background:1px #252525;height:0px auto;width:128px auto;">';
echo "<small><font color=#277C56><center> $usdata[status] </center></font></small>";
echo '</div>';
}
if($usdata[lvl]<20){
$st="NG";}
elseif($usdata[lvl]>=20 and $usdata[lvl]<40){
$st="D";}
elseif($usdata[lvl]>=40 and $usdata[lvl]<52){
$st="C";}
elseif($usdata[lvl]>=52 and $usdata[lvl]<62){
$st="B";}
elseif($usdata[lvl]>=62 and $usdata[lvl]<76){
$st="A";}
elseif($usdata[lvl]>=76){
$st="S";}



	echo '<table><tr>';
if (is_file('foto/'.$usdata[usr].'.gif'))
{
echo'<td><img src="foto/'.$usdata[usr].'.gif" alt="pic" style="margin-right:10px;border:2px solid #383838"/></td>'; } else {
echo"<td><img src='pic/avatar/$usdata[storona]/$kl/$usdata[pol]/$st.png' style='margin-right:10px;border:2px solid #383838'/></td>"; }
echo '<td align="left">';

if (!empty($usdata[zamujem])){
echo '<div style="border:1px solid #404040;padding:3px;background:1px #252525;height:0px auto;width:128px;">';
echo'<font color=#277C56><left>В браке с <a href="/search.php?nick='.$usdata[zamujem].'&go=go">'.$usdata[zamujem].'</left></a></font><br/>';
echo '</div>';
}
echo"<font color=red><b>Жизни:</b> $usdata[hp]/$usdata[hpall]</font><br/>";
echo"<font color=#0094FF><b>Мана:</b> $usdata[mp]/$usdata[mpall]</font><br/>";

$reqbf = mysql_query("SELECT * FROM `baf` WHERE `usr`='$nick'");
$avto=mysql_num_rows($reqbf);
while($mag = mysql_fetch_array($reqbf))
{
$at=$mag[bafat]+$at;
$df=$mag[pmdef]+$df;
if (!empty($mag[bafat])){$bafat="<font color=grey><small>+	[".number_format($at, 0, ',', "`")."]</small></font>";}
if (!empty($mag[pmdef])){$pmdef="<font color=grey><small>+	[".number_format($df, 0, ',', "`")."]</small></font>";}
}

echo"<b>Физ. защ. (P.Def):</b> ".number_format($usdata[pdef], 0, ',', "`")." <font color=grey> $pmdef</font>";
echo"<br/>";
echo"<b>Маг. защ. (M.Def):</b> ".number_format($usdata[mdef], 0, ',', "`")." <font color=grey> $pmdef</font>";
echo'<br/>';
echo"<b>Физ атака (P.Att):</b> ".number_format($usdata[patt], 0, ',', "`")." <font color=grey> $bafat</font>";
echo'<br/>';
echo"<b>Маг атака (M.Att):</b> ".number_format($usdata[matt], 0, ',', "`")." <font color=grey> $bafat</font>";
if(!empty($usdata[clan])){
$req = mysql_query("SELECT * FROM `clan` WHERE `lider` = '$usdata[clan]' LIMIT 1");
$clan = mysql_fetch_array($req);
echo"<br/>В клане: <b><a href=\"clan.php?id=$clan[id]\">$clan[name]</a></b><br/>";}else{
echo"</br>";}
$req = mysql_query("SELECT * FROM `karma` WHERE `usr` = '$nick'");
$avto=mysql_num_rows($req);
echo'<b>Рейтинг: '.$avto.'</b><br/>';
$req = mysql_query("SELECT * FROM `karma` WHERE `usr` = '$nick' and `from`='$log' LIMIT 1");
$avto=mysql_num_rows($req);
if($avto==0 and $udata[lvl]>=101 and $log!=$nick){
echo"<a href=\"karma.php?usr=$nick\">[увеличить рейтинг]</a><br/>";
}
echo'<br/>Побед: '.$usdata[wins].'<br/>';
echo'Поражений: '.$usdata[loses].' <br/>';

$reqpit= mysql_query("SELECT * FROM `pit` WHERE `usr` = '$nick' and `status` = 'on' LIMIT 1");
$avto=mysql_num_rows($reqpit);
if($avto==1){
$pit = mysql_fetch_array($reqpit);
if($pit[rasa]==obor || $pit[rasa]==pig){$color = '<font color=red>';}
if($pit[rasa]==obor || $pit[rasa]==pig){$l ='<font color=yellow>[LeG]</font>';}
echo"Пит: <b><a href=\"pit.php?id=$pit[id]\">$color$pit[name]</font></a>$l</b><br/>";
}
$laikas = 150;
$dabar = time();
$timeout = $dabar - $laikas;
$asd = mysql_num_rows(mysql_query("SELECT laikas, usr FROM online WHERE laikas > '$timeout' AND usr='$nick'"));
////////////////////////////
if($asd==0 && $usdata[dostup]<3){
echo"Статус: <font color=red>Off</font><br/>";
echo"Последнее посещение: $usdata[lvisit]<br/><br/>";
}else{
$reqs = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$nick' LIMIT 1");
$mesto = mysql_fetch_array($reqs);//место
if($mesto[city]==0){
echo"Локация: <b>Город</b><br/>";
}elseif($mesto[city]==1){
$reqs = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$nick' LIMIT 1");
$wor = mysql_fetch_array($reqs);//место
echo"Локация: <b> $wor[mesto] </b><br/>";
}else{
echo"Локация: <b>Замок</b><br/>";
}
if ($usdata[titul]=='' or $usdata[titul]=='no')
 {$usdata[titul]='Нет';}
 echo "Титул: <font color=orange>$usdata[titul]</font><br/>";
echo"Статус: <font color=lime><b>On</b></font><br/><br/>";
}

echo'</td></tr></table>';


						echo "<hr/>";

$reqvip = mysql_query("SELECT * FROM `vip` WHERE `usr` = '$nick' LIMIT 1");
$avto=mysql_num_rows($reqvip);
if($avto==1){
$vip = mysql_fetch_array($reqvip);
echo' <font color=#008282><b>VIP Акаунт x'.$vip[tip].'!</b> <br/>';
$vip[time]=$vip[time]-time();



												$time_dd = floor($vip[time]/86400); // сколько дней										
												$vip[time] = floor($vip[time]-($time_dd*86400)); // остача дня

												
												
												$time_ch = floor($vip[time]/3600); // сколько часов										
												$vip[time] = floor($vip[time]-($time_ch*3600)); // остача часов
												
												$time_min = floor($vip[time]/60);
												
												$time_sek = floor($vip[time]-($time_min*60));
												
													if ($time_sek<0) {
																	$time_min=$time_min-1;
																	$time_sek = floor($udata[time]-($time_min*60));
																	}
	
											echo "<b>$time_dd</b> дн. <b>$time_ch</b> ч. <b>$time_min</b> мин. <b>$time_sek</b> сек.";



echo "</font><br/>";
}



///////////////////	Anti PK AKK 	////////////////////

$reqanti = mysql_query("SELECT * FROM `anti_pk` WHERE `usr` = '$nick' LIMIT 1");
$avtoanti=mysql_num_rows($reqanti);
if($avtoanti==1){
$anti = mysql_fetch_array($reqanti);
echo'<font color=#b54545><b>АнтиРК Акаунт!</b> <br/>';
$anti[time]=$anti[time]-time();
$antitime_dd = floor($anti[time]/86400); // сколько дней										
$anti[time] = floor($anti[time]-($antitime_dd*86400)); // остача дня
$antitime_ch = floor($anti[time]/3600); // сколько часов										
$anti[time] = floor($anti[time]-($antitime_ch*3600)); // остача часов
$antitime_min = floor($anti[time]/60);
$antitime_sek = floor($anti[time]-($antitime_min*60));
if ($antitime_sek<0) {
$antitime_min=$antitime_min-1;
$antitime_sek = floor($udata[time]-($antitime_min*60));
}
echo "<b>$antitime_dd</b> дн. <b>$antitime_ch</b> ч. <b>$antitime_min</b> мин. <b>$time_sek</b> сек.";
echo "</font><hr/>";
}

////////////////////////////////////////////////////////
$t=time();

$req = mysql_query("SELECT * FROM `block_account` WHERE `acc_id` = '$usdata[account]' LIMIT 1");
$avto = mysql_num_rows($req);
if ($avto == 1) {
$ban = mysql_fetch_assoc($req);
$banus = mysql_query("SELECT * FROM `users` WHERE `usr` = '$ban[log]' ");
$user = mysql_fetch_assoc($banus);
 echo"
<font color=red>Аккаунт был заблокирован! </font><br/> 
<font color=grey><b>Кем:<b></font><a href=\"search.php?nick=$ban[log]&amp;go=go\"> $ban[log]</a><br/>
<font color=green>Причина:</font> <font color=orange>$ban[text]!</font><br/>";
}


$req = mysql_query("SELECT * FROM `block` WHERE `usr` = '$usdata[usr]' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);
if ($avto == 1) {
    $ban = mysql_fetch_array($req);
    
    if($ban[ban_time]<$t){
    mysql_query("DELETE FROM `block` WHERE `usr` = '$usdata[usr]'");
    }else{
    echo"<b>
	<font color=red>Игрок был заблокирован! </font><br/> 
	<font color=grey><b>Кем:<b></font><a href=\"search.php?nick=$ban[log]&amp;go=go\"> $ban[log]</a><br/>
	<font color=green>Причина: <font color=orange>$ban[text]!</font><br/> 
	Осталось:</font> <font color=grey>";
    
$ban[ban_time]=$ban[ban_time]-time();

if ($ban[ban_time]>=86400){
$ban[ban_time]=round($ban[ban_time]/86400);

if ($ban[ban_time]>3650){
$ban[ban_time]=round($ban[ban_time]/365);
echo " более 10 лет";}elseif ($ban[ban_time]>365){
$ban[ban_time]=round($ban[ban_time]/365);
echo " больше $ban[ban_time] г.";}

else{
echo " Осталось: $ban[ban_time] дн.";}

}


if($ban[ban_time]<60){
echo " $ban[ban_time] сек.";
}elseif($ban[ban_time]>60 and $ban[ban_time]<3600){
$ban[ban_time]=round($ban[ban_time]/60);
echo " $ban[ban_time] мин.";
}elseif($ban[ban_time]>3600 and $ban[ban_time]<86400){
$ban[ban_time]=round($ban[ban_time]/3600);
echo " $ban[ban_time] часов.";
}
 
 if ($udata[dostup]>3){
 echo "<br/><font color=lime> ID - $ban[id] </font> <a href=\"adm_panel.php?mod=block&amp;id=$ban[id]&amp;delbl=1\"><font color=red>[x]</font></a>";
 
 if ($ban[cena]>0){echo "<br/><font color=#2F4F4F> Цена разбл: - $ban[cena] CoL</font>";}
 
 }
 
 }
 
 if ($udata[dostup]>2){
 echo'<a href="/gm/blok.php?usr='.$usdata[usr].'&b='.$ban[id].'"><div class=dot> &#187; Редактировать </div></a>';
}
 
    echo "</font></b></b><br/><br/>";}
	echo "</b>";
//-----------------------------------------------------------------------------------------
////////////////////////////////////////////////////////
$t=time();

$req = mysql_query("SELECT * FROM `ban` WHERE `usr` = '$usdata[usr]' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);
if ($avto == 1) {
    $ban = mysql_fetch_array($req);
    
    if($ban[ban_time]<$t){
    mysql_query("DELETE FROM `block` WHERE `usr` = '$usdata[usr]'");
    }else{
    echo"<b>
	<font color=#990606>Игрок ЗАБАНЕН! </font><br/> 
	<font color=#35546b><b>Кем:<b></font><a href=\"search.php?nick=$ban[log]&amp;go=go\"> $ban[log]</a><br/>
	<font color=#35546b>Причина: <font color=#734a15>$ban[text]!</font><br/> 
	<font color=#35546b>Осталось:</font></font> <font color=grey>";
    
$ban[ban_time]=$ban[ban_time]-time();

if ($ban[ban_time]>=86400){
$ban[ban_time]=round($ban[ban_time]/86400);

if ($ban[ban_time]>3650){
$ban[ban_time]=round($ban[ban_time]/365);
echo " более 10 лет";}elseif ($ban[ban_time]>365){
$ban[ban_time]=round($ban[ban_time]/365);
echo " больше $ban[ban_time] г.";}

else{
echo "  $ban[ban_time] дн.";}

}


if($ban[ban_time]<60){
echo " $ban[ban_time] сек.";
}elseif($ban[ban_time]>60 and $ban[ban_time]<3600){
$ban[ban_time]=round($ban[ban_time]/60);
echo " $ban[ban_time] мин.";
}elseif($ban[ban_time]>3600 and $ban[ban_time]<86400){
$ban[ban_time]=round($ban[ban_time]/3600);
echo " $ban[ban_time] часов.";
}

 if ($udata[dostup]>3){
 echo "<br/><font color=#ff5e00> Номер блока <u>$ban[id]</u> </font> <a href=\"adm_panel.php?mod=12&amp;id=$ban[id]\"><font color=red>[x]</font></a>";
 
 if ($ban[cena]>0){echo "<br/><font color=#2F4F4F> Цена разбл: - $ban[cena] CoL</font>";}
 
 }
 
 }
 
 
    echo "</font></b></b><hr/>";}
	echo "</b>";
//-----------------------------------------------------------------------------------------

include($path.'inc/opit.php');

if ($exp2>100){ $lvlplus="<font color=red> + </font>"; $exp2=100;}
echo '<table><tr>';
echo'<td>';
echo"Уровень: $usdata[lvl] <font color=grey>($exp2%$lvlplus)</font><br/>";
echo"Опыт: ".number_format($usdata[exp], 0, ',', "`")."<br/>";
echo"SP: ".number_format($usdata[sp], 0, ',', "`")."<br/>";
echo'</td>';
echo'<td>';
if($udata[dostup]>2){

echo"<font color=grey>Адена: ".number_format($usdata[money], 0, ',', "`")."</font><br/>";
echo"<font color=grey>Gold Bar: ".number_format($usdata[gold], 0, ',', "`")."</font><br/>";
echo"<font color=grey>Постов чата: ".number_format($usdata['post'], 0, ',', "`")."</font><br/>";
echo"<font color=grey><font color=lightskyblue>Иголок</font>: ".number_format($usdata['ig'], 0, ',', "`")."</font><br/>";
echo"<font color=grey>VoteCoin: ".number_format($usdata[votecoin], 0, ',', "`")."</font><br/>";
echo"<font color=grey>Coin of Luck: ".number($usdata[almaz])."</font><br/>";
echo"<font color=grey>Blue Coin: ".number($usdata[almaz_blue])."</font><br/>";
echo"<font color=grey>Серебро: ".number($usdata[serebro])."</font><br/>";
echo"<font color=grey>Ключи: ".number($usdata[key])."</font><br/>";
echo"<font color=grey>Частицы ключа: ".number($usdata[chkey])."</font><br/>";
}
if($udata[dostup]>4){
$usdata[wmr] = $usdata[wmr]/100;
echo"<font color=#CC6633><b>WMR: ".number_format($usdata[wmr], 2, ',', "`")."</font></b>";
echo'</td>';
}
echo'</tr></table>';






//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////			В Р Е М Я 		О Н Л А Й Н А		 //////////////////////////////////////////////



// расчёт онлайна


if ($usdata[time]<60){$tim = "$usdata[time] сек";} // cек

if ($usdata[time]>59 and $usdata[time]<3600)	{ // мин и cек
												
												$time_min = floor($usdata[time]/60);
												$time_sek = floor($usdata[time]-($time_min*60));
												
											
											$tim = "$time_min мин $time_sek сек";
											} 


if ($usdata[time]>=3600 and $usdata[time]<86400)	{ // часы, мин и cек
												
												$time_ch = floor($usdata[time]/3600); // сколько часов										
												$usdata[time] = floor($usdata[time]-($time_ch*3600)); // остача часов
												
												$time_min = floor($usdata[time]/60);
												
												$time_sek = floor($usdata[time]-($time_min*60));
												
													if ($time_sek<0) {
																	$time_min=$time_min-1;
																	$time_sek = floor($usdata[time]-($time_min*60));
																	}
	
											$tim = "$time_ch ч. $time_min мин. $time_sek сек.";
											} 
											
											
if ($usdata[time]>=86400)	{ // дни, часы, мин и cек
												
												$time_dd = floor($usdata[time]/86400); // сколько дней										
												$usdata[time] = floor($usdata[time]-($time_dd*86400)); // остача дня

												
												
												$time_ch = floor($usdata[time]/3600); // сколько часов										
												$usdata[time] = floor($usdata[time]-($time_ch*3600)); // остача часов
												
												$time_min = floor($usdata[time]/60);
												
												$time_sek = floor($usdata[time]-($time_min*60));
												
													if ($time_sek<0) {
																	$time_min=$time_min-1;
																	$time_sek = floor($usdata[time]-($time_min*60));
																	}
	
											$tim = "<b>$time_dd</b> дн. <b>$time_ch</b> ч. <b>$time_min</b> мин<b>$time_sek</b> сек.";
											}


echo"<div class=dot><a href=\"anketa.php?go=go&nick=$nick\">Анкета</a></div>";
echo"<div class=dot><a href=\"search.php?go=shmot&amp;nick=$nick\">Снаряжение</a></div>";
$nickus =mysql_result(mysql_query("SELECT COUNT(*) FROM `nick_history` WHERE `id_user` = '$usdata[id]'"), 0);
 echo'<div class=dot><a href="historynick.php?id='.$usdata[id].'">История ников</a> ['.$nickus.']</div>';
$req654s55 = mysql_query("SELECT * FROM `rekc` WHERE `kogo` = '$nick'");
$rekc=mysql_num_rows($req654s55);
echo'<div class=dot>Рекомендации: <a href="/rekc.php?who='.$nick.'">'.$rekc.'</a> | <a href="/rekc.php?nick='.$nick.'&">[+]</a></div>';
 $gallery =mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `user` = '$usdata[usr]'"), 0);
echo'<div class=dot><a href="search.php?go=gallery_user&nick='.$nick.'">Фотографии юзера</a>['.$gallery.']</div>';
if($udata[dostup]>2 and $udata[dostup]>=$usdata[dotup]){
echo'<a href="players.php?a=account&amp;id='.$usdata[account].'">Все персонажи этого аккаунта</a></div>';}
echo "<div class=dot><font color=#007F46>$usdata[dat_reg]</font></div>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<table class='msg'>";
echo"<td class='dot'>";
$k_p = mysql_num_rows(mysql_query("SELECT * FROM `gifts` WHERE `id_user` = '$usdata[id]'"));
if ($k_p > 0){
echo "<div class=silka><small><a href=\"gifts_2.php?id=$usdata[id]\" title=\"Все\">Все подарки <font color=silver>($k_p)</font></a></small>";
}

$k_post = mysql_num_rows(mysql_query("SELECT * FROM `gifts` WHERE `id_user` = '$usdata[id]' LIMIT 1"));

if ($k_post==0)
{
echo '<sub>Нет подарков</sub>';
}

$q = mysql_query("SELECT * FROM `gifts` WHERE `id_user` = '$usdata[id]' ORDER BY time DESC LIMIT 4");
while ($f = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '$f[ot_id]' LIMIT 1"));
echo" <img src='/gifts/".$f['id_gifts'].".gif' width='32' height='32' alt='' class='icon'/> ";
}
echo "<div class=inoy><a href=\"/gifts.php?id=$usdata[id]&pod=1\">Подарить подарок</a></div></td></tr></table>";
$ip_br = explode("|||",$usdata[ip_br]);
if($usdata[usr]!='Shiki'){echo"<b><font color=lime>Активность</font>:</b><font color=darkorang> $ip_br[2]</font></div>";}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////---------------////////////////---------------------////////////////////-------------------------/////////////////////
				//// 		мини админка		////////////
				echo "<div class=admin><center>";
				///////// 	GM -  создатель 	////////////
				if($udata[dostup] == 5)
				{



				}
				////////	Admin 	//////////////////
				if($udata[dostup] >= 4)
				{
				echo "<hr/>";
                                echo" | <a href=\"adm_panel.php?mod=red&nick=$nick\"> Ред </a> ";
                                echo" | <a href=\"adm_panel.php?mod=shmot&nick=$nick\"> Шмот </a>  ";
				echo" | <a href=\"search.php?act=mag&nick=$nick\"> Скилы </a> ";
                                echo" | <br/>";
				echo" | <a href=\"/gm/poisk.php?&p=poisk_ip&ip=$usdata[ip]\">Поиск мультов</a> ";
				echo" | <a href=\"/gm/vhod.php?nick=$nick\"> Входы </a> ";
                                echo" | <a href=\"search.php?act=deluser&nick=$nick\">Удаление</a> ";
				echo" | <a href=\"adm_panel.php?mod=10&amp;usr=$nick\"> Бан(блок) </a> ";
                                echo" | <br/>";
				echo" | <a href=\"/gm/msg.php?nick=$nick\">П-Вх</a>";
				echo" | <a href=\"/gm/my_msg.php?nick=$nick\">П-Исх</a>";
				echo' | <a href="adm_panel.php?mod=block_acc&amp;id='.$usdata['account'].'" style="font-weight: bold; color: red;">Блокировка аккаунта</a>';
				}

				///////// модер и ст.модер  ///////////
				if($udata[dostup] == 2 or $udata[dostup] == 3)
				{
                                                        echo" | <a href=\"/gm/poisk.php?&p=poisk_ip&ip=$usdata[ip]\">Поиск мультов</a> ";
				echo"<a href=\"mod_panel.php?mod=1&amp;usr=$nick\">Бан(блок)</a> ";
						if($udata[dostup] == 3)
						{
						echo" | <a href=\"/gm/msg.php?nick=$nick\">Почта (Вход)</a>";
						echo" | <a href=\"/gm/my_msg.php?nick=$nick\">Почта (Исх)</a>";
						echo" | <a href=\"/gm/vhod.php?nick=$nick\">Входы</a> ";
						}
				}
				///////////////////////////////////////
				echo "</center></div></b></b></font></font>";
if ($udata[dostup]>1 and $usdata[dostup]<5){ // мд и выше видят IP

$ip_br = explode("|||",$usdata[ip_br]);

if (empty($ip_br[0])){$ip_br[0] = "нет данных";}
if (empty($ip_br[1])){$ip_br[1] = "нет данных";}
if (empty($ip_br[2])){$ip_br[2] = "нет данных";}

echo "<div class=dot><font color=grey>
<b> IP: </b> <u>$ip_br[0]</u> <br/>
<b> Браузер: </b> $ip_br[1] <br/>
<b> Время: </b> $ip_br[2]</font></div>";
echo"<div class=dot><font color=#00B2EE>Провёл на сайте:</font><font color=#7EC0EE> $tim </font>";
echo"<br/><font color=darkorange>ID: $usdata[id]</font></div>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"<hr/> </div>";

echo'<center>';
echo"<a href=\"baf_vip.php?&nick=$usdata[usr]\">Бафнуть игрока</a>";
echo" | <a href=\"paty.php?nick=$usdata[usr]\">Предложить пати</a>  ";
echo"| <a href='msg.php?go_user=$nick&mod=wr'>Написать письмо</a>  ";
$req = mysql_query("SELECT * FROM `msg_ignor` WHERE `usr` = '$log' and `contact` = '$nick'");
$avto=mysql_num_rows($req);
if($avto==1){
////////////////////////////
While($nick = mysql_fetch_array($req))
{
echo"|<a href=\"search.php?go=del_ign&contact=$nick[contact]\"><font color=red>Убрать с игнора </font></a>";
}}else{
echo"|<a href=\"search.php?go=dr&nick=$nick\"><font color=orange> »Добавить в игнор </font></a>";
}
echo'</center>';
break;

case 'gallery_user':
echo "<p><font color=#057F46><b>Фотографии пользователя $nick!</b></font></p>";
$req=mysql_query("SELECT * FROM `gallery` WHERE `user` = '$nick' ORDER by `id` DESC LIMIT 0,10");
if(mysql_num_rows($req) > 0){
while($row = mysql_fetch_array($req)){
echo '<a href=gallery.php?mod=big&id='.$row['id'].'><img src="pic/gallery/'.$row['foto'].'" width="90" height="90" alt="'.$row['user'].'" /></a><br /><a href=gallery.php?mod=big&id='.$row['id'].'>Подробнее</a>|';
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_kom` WHERE `id_tm` = '$row[id]'"), 0);
echo "<a href=\"gallery.php?kom=$row[id]\"><font color=#47ba82>Коментарии ($count2)</font></a>";
echo"(<a href='gallery.php?mod=gallery_stat&type=plus&id_n=$row[id]'><img src='/pic/u.gif' alt='pic'> $row[plus] | <a href='gallery.php?mod=gallery_stat&type=minus&id_n=$row[id]'><img src='/pic/d.gif' alt='pic'> $row[minus]</a>)<div class=\"line\" style=\"clear: left\"></div><hr>";
}
echo '<a href=gallery.php?mod=load>Загрузить фото</a>';
}else{
echo 'Добавленых фотографий еще нет!<br />';
echo '<a href=gallery.php?mod=load>Загрузить фото</a>';
}
break;


case 'blog_user':
echo "<p><font color=#057F46><b>Блог пользователя $nick!</b></font></p>";
//-------------------------------------- Удаление коментариев ---------------------------------------------------------
if (isset($_GET[del])){
if($udata[dostup] >= 2)
{
if(empty($_GET[del])){
echo"<hr/><font color=red><p>Не выбран пост!</p></font>";
}else{
$asd = mysql_query("SELECT * FROM blog_kom WHERE id='$_GET[del]' LIMIT 1");
$avto=mysql_num_rows($asd);
if($avto==0){
echo'<hr/><font color=red><p>Нет такого поста!</p></font>';
}else{
mysql_query("DELETE FROM `blog_kom` WHERE id='$_GET[del]' LIMIT 1");
echo'<hr/><font color=#084fc9><p>Пост успешно удалён!</p></font>';
}
}
}else{
echo "Ошибка!Доступ закрыт!";
}
}
/////////////////////////////		Коментарии	/////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET[kom])){
//-------------------------------------------
if (!empty($_POST[text])) // если естьтекст записуем сообщение
{
$msg = $_POST[text];
$msg = htmlspecialchars(stripslashes(trim($msg)));
$log = htmlspecialchars(stripslashes(trim($log)));
$currHour=date("H",time());
$currDate=date("d.m.Y", time());
$currTime=date("$currHour:i", time());

// пишем антифлуд
$req6546 = mysql_query("SELECT * FROM `blog_kom` WHERE `usr` = '$log' && `id_tm` = '$_GET[kom]' ORDER BY id DESC LIMIT 1");
$pr = mysql_fetch_array($req6546);
if($pr[text] == $msg){
echo'<font color=#9E0000>Антифлуд!</font><br/>';}else{

$ressave = mysql_query("INSERT INTO `blog_kom` SET
        `id_tm` = '$_GET[kom]',
        `text` = '$msg',
        `data` = '$currDate в $currTime',
        `usr` = '$log'"); // создаем строку с ответом
		
		

		 
				if 		($ressave == 'true')	{echo "<hr><font color=#007F46>Сообщение добавленно!</font>";}
				else	{echo "<font color=red><p> Неудача ! </p></font>";}  // неудачно =)
}
}
//----------------------------------------------





$asd = mysql_query("SELECT * FROM `blog` WHERE `id` = '$_GET[kom]' and `nick` = '$log' LIMIT 1");
$dsa = mysql_fetch_array($asd);

$title = strip_tags($dsa['title']);
$time = strip_tags($dsa['time']);
echo "<hr/><b><font color=#6D7F3F>$title </b><small>
[$time]</small><br/></font>
<font color=grey>$text ".$dsa['text']."</font><br/>";


//----cчётчик комов
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_kom` WHERE `id_tm` = '$_GET[kom]'"), 0);


echo "<p><font color=#47ba82>Коментарии ($count2):</font></p>";


echo "<form method=\"post\" action=\"blog_user.php?kom=$_GET[kom]\">";
echo "Текст сообщения:<br/>";
echo "<textarea name=\"text\" rows=3></textarea><br/>";
echo "<input type=\"submit\" value=\"Отправить\" class=\"ibutton\"></form><hr/>";



//---выщитует страницы----------

	$count = mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_kom` WHERE `id_tm` = '$_GET[kom]'"), 0);
	if($count > 0){
		$pages = ceil($count/10);
		if(isset($_GET['page'])){
			$page = abs(intval($_GET['page']));
		}else{
			$page = 1;
		}
		$from = ($page-1)*10;
}
//-------------------------------

$req = mysql_query("SELECT * FROM `blog_kom` WHERE id_tm = '$_GET[kom]' ORDER BY id DESC LIMIT $from, 10");
$avt = mysql_num_rows($req);

if($avt>=1)
{


function smilesmsg($string54545){
$dir = opendir ("pic/smiles"); 
while ($file = readdir ($dir)) {
if (ereg (".gif$", "$file")){
$file2=str_replace(".gif","",$file);
$string54545=str_replace(":$file2",'<img src="pic/smiles/'.$file.'" alt="" height="30" width="30">',$string54545);
}}
closedir ($dir);
return $string54545;  }



While($tk = mysql_fetch_array($req))
{
$us = mysql_query("SELECT * FROM `users` WHERE usr = '$tk[usr]' LIMIT 1");
$usr = mysql_fetch_array($us);
if ($usr[dostup]>=4)						{$color = '<font color=lime>'; $color2 = '<font color=#5e995c>';}
if ($usr[dostup]==2 or $usr[dostup]==3)	{$color = '<font color=#0026FF>'; $color2 = '<font color=#6DC2FF>';}
if ($usr[dostup]==1) 					{$color = '<font color=#7F6A00>'; $color2 = '<font color=#A09353>';}
if ($usr[dostup]==0) 					{$color = ''; $color2 = '';}


if($udata[dostup]>=2){
$silka = " <a href=\"blog_user.php?kom=$_GET[kom]&amp;del=$tk[id]\"><font color=red><small> [x] </small></font></a>";
}


$text = $tk[text];

$text = smilesmsg($text);
$text = nl2br($text);

echo "<div class=msg><a href=\"search.php?nick=$tk[usr]&amp;go=go\">$color $tk[usr] </font></a> <font color=grey><small>$tk[data]</small></font> $silka </div>
<div class=msg>
$color2 $text</font></div><hr/>";
}

echo "<div class=dot><p>";
	navig2($page, 'blog_user.php?kom='.$_GET[kom].'&amp;', $pages);
echo "</p></div>";
	
}else{
echo "Сообщений нет<hr/>";}

//////////////////////////////////





echo"<br/><div class=silka><a href=\"/blog_user.php?\">Назад</a></div>";

include($path.'inc/down.php');

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


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
$viso = mysql_num_rows(mysql_query("SELECT `title` FROM `blog` WHERE `nick` = '$nick'"));
$puslap = floor($viso/10);
if (is_double($num) || !is_integer($num))
{
echo "Ошибка!<br/>";
}
else {
$asd = mysql_query("SELECT `id`,`title`, `text`,`time` FROM `blog` WHERE `nick` = '$nick' ORDER BY id DESC LIMIT $num,10");
while($dsa = mysql_fetch_array($asd))
{
$i2 = $i++;
$title = strip_tags($dsa['title']);
$time = strip_tags($dsa['time']);
echo "<hr/><b><font color=#6D7F3F>$title </b><small>
[$time]</small><br/></font>
<font color=grey>$text ".$dsa['text']."</font><br/>";


$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_kom` WHERE `id_tm` = '$dsa[id]'"), 0);

echo "<div class=silka><a href=\"blog_user.php?kom=$dsa[id]\"><font color=#47ba82>Коментарии ($count2)</font></a></div>";


}
//echo '<br/>';
echo '<hr/>';
if ($_GET[page] > 0)
{
echo "<a href=\"blog_user.php?page=$back\">back</a>";
}
elseif ($_GET[page] == 0)
{
echo "back";
}
echo"|";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"blog_user.php?page=$next&\">next</a><br/>";}
else
{echo "next<br/>";}
}
echo"<a href=\"blog.php?\">Назад</a>";
break;


case 'shmot':
echo "<div class=silka>";
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
$usdata = mysql_fetch_array($req);

echo"<b>Снаряжение игрока $nick:</b><br/><br/>";
$i=1;
while($i<=14){
switch($i){
case '1':
$tip='Украшение';
$gt='ykr';
break;
case '2':
$tip='Шлем';
$gt='golova';
break;
case '3':
$tip='Доспех';
$gt='body';
break;
case '4':
$tip='Оружие';
$gt='weapon';
break;
case '5':
$tip='Рукавицы';
$gt='ruki';
break;
case '6':
$tip='Штаны';
$gt='pants';
break;
case '7':
$tip='Сапоги';
$gt='nogi';
break;
case '8':
$tip='Щит';
$gt='shit';
break;
case '9':
$tip='Амулет';
$gt='amulet';
break;
case '10':
$tip='Левая серьга';
$gt='poyas';
break;
case '11':
$tip='Правая серьга';
$gt='rpoyas';
break;
case '12':
$tip='Левое кольцо';
$gt='kolco';
break;
case '13':
$tip='Правое кольцо';
$gt='rkolco';
break;
case '14':
$tip='Плащ';
$gt='plash';
break;

}
$req = mysql_query("SELECT id,name FROM `item` WHERE `usr` = '$nick' and `tip`='$gt' and `image`='yes'");
$mag = mysql_fetch_array($req);
$u = explode("*",$mag[name]);
if($gt!='skolco'){
//echo"$tip: ";
$req = mysql_query("SELECT id,name FROM `item` WHERE `usr` = '$nick' and `tip`='$gt' and `image`='yes'");
$avto=mysql_num_rows($req);
if($avto==0){
echo"<img src=\"shmot/pusto/$gt.gif\" alt=\"pic\"/>  Ничего не одето <hr/>";
}else{
$mag = mysql_fetch_array($req);
echo"<a href='inventar.php?mod=in&amp;id=$mag[id]'> <img src=\"shmot/$u[0].png\" alt=\"pic\"/> <b>$mag[name]</b></a><hr/>";
}}else{
$req = mysql_query("SELECT id,name FROM `item` WHERE `usr` = '$nick' and `tip`='$gt' and `image`='yes'");
$avto=mysql_num_rows($req);
if($avto==0){
echo"<img src=\"shmot/pusto/$gt.gif\" alt=\"pic\"/>  Ничего не одето<hr/> ";
echo"<img src=\"shmot/pusto/$gt.gif\" alt=\"pic\"/>  Ничего не одето<hr/> ";
}elseif($avto==1){
$mag = mysql_fetch_array($req);
echo"<a href='inventar.php?mod=in&amp;id=$mag[id]'> <img src=\"shmot/$u[0].png\" alt=\"pic\"/> <b>$mag[name]</b></a><hr/>";
echo"<img src=\"shmot/pusto/$gt.gif\" alt=\"pic\"/>  Ничего не одето<hr/> ";
}elseif($avto==2){
While($best = mysql_fetch_array($req))
{		$u = explode("*",$best[name]);
echo"<a href='inventar.php?mod=in&amp;id=$best[id]'> <img src=\"shmot/$u[0].png\" alt=\"pic\"/> <b>$best[name]</b></a><hr/>";
}
}
}
$i++;
}
echo"<br/><a href=\"search.php?go=go&amp;nick=$nick\">Назад</a>";
echo "</div>";
break;




case 'stats':
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
$usdata = mysql_fetch_array($req);
echo"<b>Статистика:</b><br/>

Побед на арене: $usdata[arenawins]<br/>
Поражений на арене: $usdata[arenaloses]<br/>
Побед: ".$usdata[wins]."<br/>
Поражений: $usdata[loses]<br/>";
echo"<br/><a href=\"search.php?go=go&amp;nick=$nick\">Назад</a>";

break;

case 'mag':
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$nick'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto=="0"){
echo'Нет такого игрока!';
include($path.'inc/down.php');exit;
}

echo "<p><font color=grey>Умения игрока <b>$nick</b></font></p><hr/>";
$req = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$nick'");
if(mysql_num_rows($req)>=1)
{
While($mag = mysql_fetch_array($req))
{
$maglvl=$mag[lvl]-1;
$magmp=explode("|",$mag[mp]);
$mag[mp]=$magmp[$maglvl];//мп

$maghp=explode("|",$mag[hp]);
$mag[hp]=$maghp[$maglvl];//хп

$maghp=explode("|",$mag[plushp]);
$mag[plushp]=$maghp[$maglvl];//+хп

$maghp=explode("|",$mag[uron]);
$mag[uron]=$maghp[$maglvl];//+урон


if ($mag[ruka]=='me4'){$tp="Меч";}
if ($mag[ruka]=='kas'){$tp="Кастет";}
if ($mag[ruka]=='rap'){$tp="Рапиру";}
if ($mag[ruka]=='luk'){$tp="Лук";}
if ($mag[ruka]=='kin'){$tp="Кинжал";}


if ($mag[tip]=='atack'){$tip="Атака";}
if ($mag[tip]=='bafkrit'){$tip="Баф Критов";}
if ($mag[tip]=='bafat'){$tip="Баф Атаки";}
if ($mag[tip]=='bafzash'){$tip="Баф Защиты";}
if ($mag[tip]=='bafzat'){$tip="Баф Защиты и Атаки";}
if ($mag[tip]=='hpot'){$tip="Отжор";}
if ($mag[tip]=='hp'){$tip="Реген. HP";}
if ($mag[tip]=='mp'){$tip="Реген. MP";}
if ($mag[tip]=='bafmp'){$tip="Баф на ману";}
if ($mag[tip]=='bafhp'){$tip="Баф на жизни";}
if ($mag[tip]=='resp'){$tip="Респ. игрока";}
if ($mag[tip]=='spoil'){$tip="Спойлинг";}
if ($mag[tip]=='spoilall'){$tip="Спойлинг всех вещей";}

echo'<div class="event">';

echo"<img src=\"pic/skils/$mag[name].jpg\" alt=\"pic\"/> ";

echo"<b>$mag[name]:</b><br/>";
// видно ток админам и выше
if ($udata[dostup]>3) {

echo"<font color=#007F46>  $mag[lat_name] </font></b><br/>";

$lv=explode("|",$mag[lv]); // уровень начала скила
echo"<font color=#007F46>Доступно с $lv[0] уровня</font></b><br/>";

}
/////////////////////////////
echo"Уровень: $mag[lvl]<br/>";
echo"Класс: ";
if($mag[klas]=="wizard"){echo"Маг<br/>";}
if($mag[klas]=="fighert"){echo"Воин<br/>";}
echo"Урон: $mag[uron]<br/>";
echo"Забирает маны: $mag[mp]<br/>";
echo"Забирает здоровья: $mag[hp]<br/>";
echo"Даёт здоровья: $mag[plushp]<br/>";
echo"Тип умения: $tip</div>";

if ($mag[ruka] =="not" or $mag[ruka]==""){}else
{
echo "<font color=grey>Для использования нужно держать в руках <b>$tp</b></font><br/>";
}
echo "<hr/>";
}
}else{
echo '<b>Нет умений!</b>';
}
echo"<a href=\"search.php?go=go&amp;nick=$nick\">Назад</a>";


break;
}
include($path.'inc/down.php');
?>