<?php

$headmod = 'baf';//фикс. места

$textl='Баф зона';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////

//---------------------
$nick=$_GET[nick];
$id=$_GET[id];
//---------------------
/*
if ($udata[prava]<4){
echo'Закрито на доработки!<br/>';
echo"<br/><a href=\"pers.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}
*/

echo "</div> <div class = fon>";

switch($_GET[mod]){

default:

if (!empty($nick)) {$_POST[nick] = $nick;}  // если значение ник не пустое то пост ник равен нику

if(empty($_POST[nick])){
echo '<form action="baf.php?" method="post">';
echo"Ник:<br/>
<input class='input' type=\"text\" size=\"15\" value=\"$nick\" name=\"nick\"/><br/>";




echo '<input class="button" type="submit" value="Редакт." /></form><br/>';

echo"<div class=silka>		<a href=\"baf.php?&nick=$log\">Бафнуть себя</a>	</div>";

}else{

if (!empty($_POST[nick])) {$nick = $_POST[nick];} // если значение пост ник не пустое то знаение ник равно ему

$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '".mysql_real_escape_string($nick)."'");

$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка, такого игрока нет!<br/>';
echo"<br/><a href=\"baf.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}


$req = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$log' and 
`tip` = 'bafat' or `usr` = '$log' and
`tip` = 'pmdef' or `usr` = '$log' and
`tip` = 'bafzat' or `usr` = '$log' and
`tip` = 'resp' or `usr` = '$log' and
`tip` = 'bafhp' or `usr` = '$log' and
`tip` = 'bafmp'");

if(mysql_num_rows($req)>=1)
{

echo"<b></div><div class=inoy>Скилы (+Сила/-MP):</b><br/><br/>";

While($mag = mysql_fetch_array($req))
{
$mag[lvl]=$mag[lvl]-1;
$magmp=explode("|",$mag[mp]);
$mag[mp]=$magmp[$mag[lvl]];//мп

$maghp=explode("|",$mag[hp]);
$mag[hp]=$maghp[$mag[lvl]];//хп

$maghp=explode("|",$mag[plushp]);
$mag[plushp]=$maghp[$mag[lvl]];//+хп

$maghp=explode("|",$mag[uron]);
$mag[uron]=$maghp[$mag[lvl]];//+урон



if ($mag[tip]=="bafat"){$sms="Атака  +$mag[uron]/-$mag[mp]"; $adres="<a href=\"baf.php?mod=add&nick=$nick&id=$mag[id]\">";}
if ($mag[tip]=="pmdef"){$sms="P.Def и M.Def +$mag[uron]/-$mag[mp]"; $adres="<a href=\"baf.php?mod=add&nick=$nick&id=$mag[id]\">";}
if ($mag[tip]=="bafzat"){$sms="Def и Att +$mag[uron]/-$mag[mp]"; $adres="<a href=\"baf.php?mod=add&nick=$nick&id=$mag[id]\">";}
if ($mag[tip]=="bafhp"){$sms="+HP $mag[uron]/-$mag[mp]"; $adres="<a href=\"baf.php?mod=add&nick=$nick&id=$mag[id]\">";}
if ($mag[tip]=="bafmp"){$sms="+MP $mag[uron]/-$mag[mp]"; $adres="<a href=\"baf.php?mod=add&nick=$nick&id=$mag[id]\">";}

if ($mag[tip]=="resp"){
$reqi = mysql_query("SELECT * FROM `users` WHERE `usr`='".mysql_real_escape_string($nick)."'");
$usr = mysql_fetch_array($reqi);

$respaun=(100-$mag[uron])*0.00001;
$exp = $usr[exp]*$respaun;
$exp1 = $usr[exp]-$exp;
$hp = $usr[hpall]/2;

$sms="-".number_format($exp, 0, ',', ' ')." EXP/-$mag[mp] MP/$mag[uron]%"; $adres="<a href=\"baf.php?mod=add&nick=$nick&id=$mag[id]\">";
}


echo" $adres $mag[name] <font color=#FFFFFF>[$sms]</font></a> ";
}
echo "<br/>";
}else{echo "У Вас нет умений для бафа...";}}
break;

case 'add':

$reqi2 = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$log' and `id` = '".mysql_real_escape_string($id)."'");
$avtos2=mysql_num_rows($reqi2);
if($avtos2==0){
echo'Ошибка, такого скила нет!<br/>';
 echo"<br/><div class=silka><a href=\"baf.php?&nick=$nick\">Назад</a>";
include($path.'inc/down.php');
exit;
}


$magiya=mysql_fetch_array($reqi2);

$magiya[lvl]=$magiya[lvl]-1;

$magur=explode("|",$magiya[uron]);
$magiya[uron]=$magur[$magiya[lvl]];//+урон

$magmp=explode("|",$magiya[mp]);
$magiya[mp]=$magmp[$magiya[lvl]];//+мана
$mpbaf=$udata[mp]-$magiya[mp];

if ($mpbaf<0){
echo "Недостаточно маны<br/>";
echo"<br/><div class=silka><a href=\"baf.php?&nick=$nick\">Назад</a>";
include($path.'inc/down.php');
exit;
}

$reqi = mysql_query("SELECT * FROM `users` WHERE `usr`='".mysql_real_escape_string($nick)."'");
$usr = mysql_fetch_array($reqi);

/// воскрешение игрока /////////////////
if ($magiya[tip]=="resp"){

$respaun=(100-$magiya[uron])*0.00001;
$exp = $usr[exp]*$respaun;
$exp1 = $usr[exp]-$exp;
$hp = $usr[hpall]*($magiya[uron]/100);


$req = mysql_query("SELECT * FROM `smert` WHERE `usr`='".mysql_real_escape_string($nick)."' and `life`='no'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Игрок жив. Вы не можете его воскресить.</br>";
 echo"<br/><div class=silka><a href=\"baf.php?&nick=$nick\">Назад</a>";
include($path.'inc/down.php');exit;}

$res = mysql_query ("UPDATE users SET
        exp='$exp1',
        hp='$hp'
WHERE usr='".mysql_real_escape_string($nick)."' LIMIT 1");


mysql_query("DELETE FROM `smert` WHERE `usr`='".mysql_real_escape_string($nick)."' and `life`='no'");

					if ($res == 'true')
					{
echo "Вы воскресили '. htmlspecialchars($nick).' ! Игрок потерял ".number_format($exp, 0, ',', ' ')." опыта ";
					}				
					else
					{
					echo " Неудача. Вернитесь и повторите запрос. После 5 неудачных попыток обратесь к Администрации.";  // неудачно =)
					}

}else{
/////////////////////////////////

if ($magiya[tip]!=="bafat" && $magiya[tip]!=="pmdef" && $magiya[tip]!=="bafmp" && $magiya[tip]!=="bafzat" && $magiya[tip]!=="bafhp" && $magiya[tip]!=="bafmp")
{
echo" Ошибка, скил не подходит!<br/>";
 echo"<br/><div class=silka><a href=\"baf.php?&nick=$nick\">Назад</a>";
include($path.'inc/down.php');
exit;
} 

if ($mpbaf<0){echo "Недостаточно маны<br/>";
// echo"<br/><a href=\"baf.php?&nick=$nick\">Назад</a>";
}else{

// баф на атаку
if ($magiya[tip]=="bafat"){$tt=1800; $bafmatt=$magiya[uron]*$usr[patt]/100; $bafpatt=$magiya[uron]*$usr[matt]/100; $bafat=($bafmatt+$bafpatt)/2; $sms="баф на атаку. Сила +$magiya[uron]. Каст отнял $magiya[mp] MP";}
// баф на защиту
if ($magiya[tip]=="pmdef"){$tt=1800; $pdef=$magiya[uron]*$usr[pdef]/100; $mdef=$magiya[uron]*$usr[mdef]/100; $pmdef=($pdef+$mdef)/2; $sms="баф на защиту. Сила +$magiya[uron]. Каст отнял $magiya[mp] MP";}
//баф на защ и атаку
if ($magiya[tip]=="bafzat"){$tt=1800; 
$bafmatt=$magiya[uron]*$usr[patt]/100; $bafpatt=$magiya[uron]*$usr[matt]/100; $bafat=($bafmatt+$bafpatt)/2; 
$pdef=$magiya[uron]*$usr[pdef]/100; $mdef=$magiya[uron]*$usr[mdef]/100; $pmdef=($pdef+$mdef)/2; 
$sms="баф на атаку и защиту. Сила +$magiya[uron]. Каст отнял $magiya[mp] MP";}
// баф на пополнение ХП
if ($magiya[tip]=="bafhp"){$bafhp=$magiya[uron]; $tt=0; $sms="баф на жизни. Сила +$magiya[uron]. Каст отнял $magiya[mp] MP";}
// баф на пополнение MП
if ($magiya[tip]=="bafmp"){$bafmp=$magiya[uron]; $tt=0; $sms="баф на ману. Сила +$magiya[uron]. Каст отнял $magiya[mp] MP";}


$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '".mysql_real_escape_string($nick)."'");
$avto=mysql_num_rows($req);
if($avto==0){
echo'Ошибка, такого игрока нет!';
 echo"<br/><div class=silka><a href=\"baf.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}
$mag = mysql_fetch_array($req);

if ($magiya[tip]=="bafhp" && $mag[hp]>=$mag[hpall]){echo "У игрока полно жизней!<br/>";}else{


$req1 = mysql_query("SELECT * FROM `baf` WHERE `usr` = '".mysql_real_escape_string($nick)."' LIMIT 1");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя активировать больше одного бафа!</br>';
 echo"<br/><a href=\"baf.php?&nick=$nick\">Назад</a>";
include($path.'inc/down.php');exit;
}

$reqi = mysql_query("SELECT * FROM `users` WHERE `usr`='".mysql_real_escape_string($nick)."' LIMIT 1");
$usr = mysql_fetch_array($reqi);


$time=time()+1800; // бафы на 30 мин
if ($tt==0){}else{
mysql_query("INSERT INTO
        `baf` SET
        `usr` = '$nick',
        `tip` = '$magiya[tip]',
        `bafat` = '$bafat',
        `pmdef` = '$pmdef',
        `time` = '$time'");}

$patt=$bafat+$usr[patt];
$matt=$bafat+$usr[matt];
$pdef=$pmdef+$usr[pdef];
$mdef=$pmdef+$usr[mdef];
$nhp=$bafhp+$usr[hp];
$nmp=$bafmp+$usr[mp];



$rezult = mysql_query("UPDATE `users` SET
         `patt` = '$patt',
         `matt` = '$matt',
         `pdef` = '$pdef',
         `mdef` = '$mdef',
         `hp` = '$nhp',
         `mp` = '$nmp'
WHERE usr = '".mysql_real_escape_string($nick)."'");

mysql_query("UPDATE `users` SET `mp`='$mpbaf' WHERE usr = '$log'");

// пишем юзеру сообщение кто его бафнул
if ($nick!=$log){
$time = date("H:i d.m.y");
$text = "
Вам дал  <a href=\"search.php?nick=$log&amp;go=go\">$log</a> $sms .
";

mysql_query("INSERT INTO `baf_log` SET `usr` = '$nick', `text` = '$text'");
}
		  
echo"Вы использовали <b>$magiya[name]</b> $sms  на $tt секунд!<br/>";
}}}
 echo"<br/><div class=silka><a href=\"baf.php?&nick=$nick\">Назад</a>";
break;

}
include($path.'inc/down.php');
?>