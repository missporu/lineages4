<?php

if($_GET[mod]=='ataka'){
$header=TRUE;
}else{
$textl='Битва';
}

$headmod = 'fight';//фикс. места

include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
$timer=time()+300;
////////////////////////
$req = mysql_query("SELECT * FROM `tmp_zamok` WHERE `usr` = '$log' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Вы ненаходитесь в бою!";include($path.'inc/down.php');exit;}
$m = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `guards` WHERE `id` = '$m[mob]' LIMIT 1");
$mob = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `pit` WHERE `usr` = '$log'");
$avto=mysql_num_rows($req);
if($avto==1){
$pit = mysql_fetch_array($req);
}
function timer(){
global $log;
$time=time();
mysql_query("UPDATE `tmp` SET `ltime` = '$time' WHERE `usr` = '$log'");
}
///////////////////////
function lose(){
global $log,$pas,$m,$pit,$mob,$udata;

$time=time();
$losetime=$m[ltime]+120;

if($udata[hp]<=0 or $time>$losetime){

$nloses=$udata[loses]+1;
if($mob[hp]<=0){
mysql_query("UPDATE `guards` SET `hp` = '0',`status`='off',`oponent`='$time' WHERE `id` = '$m[mob]'");
}else{
mysql_query("UPDATE `guards` SET `hp` = '$mob[hp]',`status`='on',`oponent`='not' WHERE `id` = '$m[mob]'");
}

mysql_query("UPDATE `mesto` SET `place` = 'gorod',`city` = '0' WHERE `usr` = '$log'");     

mysql_query("UPDATE users SET loses = '$nloses',hp='0' WHERE usr = '$log'");//пишем данные в плэера
mysql_query("UPDATE regenerator SET last = '$time' WHERE usr = '$log'");//сбиваем регенерацию
mysql_query("DELETE FROM `tmp_zamok` WHERE usr='$log'");//чистим логи
$time=time()+1200;

mysql_query("INSERT INTO
        `out` SET
        `usr` = '$log',
        `timeout` = '$time'");

//питы
if($pit[status]==on){
if($pit[hp]<=0){
mysql_query("UPDATE pit SET status = 'die' WHERE `usr` = '$log'");
}
}
echo"Вы проиграли бой!<br/>";
echo"<a href=\"pers.php?\">Продолжить</a>";
include($path.'inc/down.php');
exit;
}
}
function win(){
global $log,$pas,$m,$mob,$pit,$udata;

$time=time();

if($mob[hp]<=0){

$nwins=$udata[wins]+1;
$nexp=$udata[exp]+$mob[exp]+$mob[lvl];
//питы
if($pit[status]==on){
if($pit[hp]<=0){
mysql_query("UPDATE pit SET status = 'die' WHERE `usr` = '$log'");
}else{
$pexp=round($mob[exp]/2);
$pexp=$pit[exp]+$pexp;
mysql_query("UPDATE pit SET exp='$pexp' WHERE `usr` = '$log'");
}
}

$sm=rand(1,$mob[sm]);
if($sm==1){
$nmoney=$udata[money]+$mob[money];
}

mysql_query("UPDATE `guards` SET `hp` = '0',`status`='off',`oponent`='$time' WHERE `id` = '$m[mob]'");
if(!empty($nmoney)){
mysql_query("UPDATE users SET wins = '$nwins',exp='$nexp',money='$nmoney' WHERE usr = '$log'");//пишем данные в плэера
}else{
mysql_query("UPDATE users SET wins = '$nwins',exp='$nexp' WHERE usr = '$log'");
}
mysql_query("DELETE FROM `tmp_zamok` WHERE usr='$log'");//чистим логи

mysql_query("UPDATE regenerator SET last = '$time' WHERE usr = '$log'");//сбиваем регенерацию

echo"Вы победили в бою с $mob[name]!<br/>";
if(!empty($drop[name])){
echo"Выпало: $drop[name]<br/>";
}
echo"+$mob[exp] опыта<br/>";
if(!empty($nmoney)){
echo"+$mob[money] монет<br/>";
}
if(!empty($pexp)){
echo"+$pexp опыта получил $pit[name]<br/>";
}
echo"<a href=\"zamok.php?\">Продолжить</a>";
include($path.'inc/down.php');
exit;
}
}
function pit(){
global $log,$pas,$pit,$udata;
if($pit[status]==on){
if($pit[hp]<=0){
mysql_query("UPDATE pit SET status = 'die' WHERE `usr` = '$log'");
}
}
}
function mein(){
global $log,$pas,$m,$pit,$mob,$udata;
timer();
lose();
win();
pit();
if(!empty($pit[id])){
if($pit[status]==on){
echo"<b>$pit[name]:</b> ($pit[hp]/$pit[hpall])<br/>";
}}
echo"<b>$mob[name]:</b> ($mob[hp]/$mob[hpall])<br/>";
echo "<form action='fight.php?mod=ataka' method='post'>";
echo "<b>Атака:</b><br/>
<select name=\"udar\">
<option value=\"1\">Голова</option>
<option value=\"2\">Туловище</option>
<option value=\"3\">Ноги</option>";
$req = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$log'");
if(mysql_num_rows($req)>=1)
{
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

echo"<option value=\"mag,$mag[id]\">$mag[name]($mag[uron],$mag[mp],$mag[hp],$mag[plushp])</option>";
}
}
echo"</select><br/>";
echo "<b>Защита:</b><br/>
<select name=\"block\">
<option value=\"1\">Голова</option>
<option value=\"2\">Туловище</option>
<option value=\"3\">Ноги</option>
</select><br/>";
echo "<input type='submit' value='Ок' /></form>";
log_msg($tlog='battle');
}
//////////
function ataka(){
global $log,$pas,$m,$pit,$timer,$mob,$udata;

//защита юзера рандом
$_POST[block]=rand(1,3);

//атака юзера рандом
 if ($udar=='at') {$udar=rand(1,5);}
///////////////////////////////////////////////////////////////////////////////


// если в клане то увеличуем параметры игрока
	if(!empty($udata[clan]))
{
$reqcla = mysql_query("SELECT * FROM `clan` where `lider`='$udata[clan]'");
$clan = mysql_fetch_array($reqcla);

$udata[patt]=$udata[patt]+($udata[patt]*($clan[patt]/100));
$udata[matt]=$udata[matt]+($udata[matt]*($clan[matt]/100));
$udata[pdef]=$udata[pdef]+($udata[pdef]*($clan[pdef]/100));
$udata[mdef]=$udata[mdef]+($udata[mdef]*($clan[mdef]/100));
}





////AI
$mudar=rand(1,3);
$mblock=rand(1,3);
////AI PITA
$pudar=rand(1,3);
$pblock=rand(1,3);
/////////////
$ud = explode(",",$_POST[udar]);
if($ud[0]=='mag'){
$req = mysql_query("SELECT * FROM `mag` WHERE `id` = '".mysql_real_escape_string($ud[1])."' and `usr` = '$log' LIMIT 1");
if (mysql_num_rows($req)==0){
mysql_query("INSERT INTO log SET usr='$log',text='Нет такого умения',kto='system',place='battle',timer='$timer'");
header ("Location: fight.php?");exit; 
}
$mag = mysql_fetch_array($req);

$mag[lvl]=$mag[lvl]-1;
$magmp=explode("|",$mag[mp]);
$mag[mp]=$magmp[$mag[lvl]];//мп

$maghp=explode("|",$mag[hp]);
$mag[hp]=$maghp[$mag[lvl]];//хп

$maghp=explode("|",$mag[plushp]);
$mag[plushp]=$maghp[$mag[lvl]];//+хп

$maghp=explode("|",$mag[uron]);
$mag[uron]=$maghp[$mag[lvl]];//+урон

if ($mag[hp]>=$udata[hp]){
mysql_query("INSERT INTO log SET usr='$log',text='Нехватает здоровья',kto='system',place='battle',timer='$timer'");
header ("Location: fight.php?");exit; 
}

if ($mag[mp]>$udata[mp]){
mysql_query("INSERT INTO log SET usr='$log',text='Нехватает маны',kto='system',place='battle',timer='$timer'");
header ("Location: fight.php?");exit; 
}

$bonus=rand(1,25);


if ($udata[klas]=="wizard") {$uron = $udata[matt];} // если маг, то маг атака работает
if ($udata[klas]=="fighert") {$uron = $udata[patt];} // если воин, то физ атака работает



//if (empty($bonus) or $bonus == 0){$bonus = 1;} // если бонус равен 0 или нет значения то от равен 1

//$uron=$uron*$bonus;
//----------

if($udata[klas]=='wizard')	{ // если маг скил умножает атаку на 0,001 и плюсует её

	$uron2 = $mag[uron] * 0.00467 * $uron; // выщитуем маг урон
	$uron = $uron2 + $uron + $bonus;
								}else	{ // иначе когда воин просто скил плюс к урону
			
			$uron = $mag[uron] + $uron + $bonus;
										}

$uron="".number_format($uron, 0, ',', "")."";


if ($udata[klas]=="wizard") {$mobdef = $mob[mdef];} // защита маг
if ($udata[klas]=="fighert") {$mobdef = $mob[pdef];} // защита физ

$uron=$uron-$mobdef;

if($uron<=0){$uron=round(0,1);}
$newmob=$mob[hp]-$uron;

if ($udata[hp]>=$udata[hpall]){}else{
if ($mag[tip]=="hpot"){$mag[plushp] = $uron*($mag[uron]/300);}
}
$newmp=$udata[mp]-$mag[mp];
$newhp=$udata[hp]-$mag[hp]+$mag[plushp];
mysql_query("UPDATE `users` SET `mp` = '$newmp',`hp` = '$newhp' WHERE `usr` = '$log'");

if ($mag[plushp]>0){$hp111="/ +$mag[plushp] HP ";}

mysql_query("INSERT INTO log SET usr='$log',text='$smskrit $mag[name] $kuda -$uron $hp111',kto='user',place='battle',timer='$timer'");

}else{
if($udar==0 or empty($udar)){$bonus=1.05;$kuda='в голову';}
if($udar==1){$bonus=1.05;$kuda='в голову';}
if($udar==2){$bonus=1.03;$kuda='по туловищу';}
if($udar==3){$bonus=1.00;$kuda='по ногам';}
if($udar==4){$bonus=1.01;$kuda='по рукам';}
if($udar==5){$bonus=1.02;$kuda='в плечо';}


if ($udata[klas]=="wizard") {$uron = $udata[matt];} // если маг, то маг атака работает
if ($udata[klas]=="fighert") {$uron = $udata[patt];} // если воин, то физ атака работает

if ($udata[klas]=="wizard") {$mobdef = $mob[mdef];} // защита маг
if ($udata[klas]=="fighert") {$mobdef = $mob[pdef];} // защита физ

if($uron >= $mobdef) {

$uron=round($uron*$bonus);
$uron=$uron-$mobdef;

if($uron<=0){$uron=round(0,1);}
$newmob=$mob[hp]-$uron;

$msg=rand(0,2);
if($msg=="0"){$sms="Ты бьёшь $mob[name] $kuda! -$uron";}
if($msg=="1"){$sms="Ты атакуешь $mob[name] $kuda! -$uron";}
if($msg=="2"){$sms="Ты бьёшь $mob[name] $kuda! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='user',place='battle',timer='$timer'");

}else{
$newmob=$mob[hp];

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] пригнулся от твоего удара!";}
if($msg=="1"){$sms="$mob[name] блокировал твой удар!";}
if($msg=="2"){$sms="$mob[name] увернулся от твоего удара!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='user',place='battle',timer='$timer'");
}
}
//////////////////
///////////////////
if($mudar==1){$bonus=1.25;$kuda='в голову';}
if($mudar==2){$bonus=1;$kuda='по туловищу';}
if($mudar==3){$bonus=0.70;$kuda='по ногам';}


#********************************#
if($mob[lovk]<$udata[lovk]){
$ms_l=rand(1,100);
$mshans_lovk=round(($udata[lovk]-$mob[lovk])*5);
}
#********************************#

if($_POST[block]!=$mudar and ($mob[lovk]>=$udata[lovk] or $ms_l>$mshans_lovk)){
/////protect//////////////////////////////
//////////////////////////////////////////////////////
switch($mudar){
case '1':
$protect=round(($udata[prot]+$udata[pgolova])/3);
break;
case '2':
$protect=round(($udata[prot]+$udata[pbody])/3);
break;
case '3':
$protect=round(($udata[prot]+$udata[pnogi])/3);
break;
}
//////////////////////////////////////////////////////
/////////////////////////////////////////////////////
//////////////////////////////////////////////////////
$uron=rand($mob[umin],$mob[umax]);

$krit=rand(1,100);
if($krit<=$mob[krit]){

$makrit=rand(1,100);
if($makrit<=$udata[antikrit]){

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] наносит крит-удар $kuda, но ты блокируешь!";}
if($msg=="1"){$sms="$mob[name] бьёть крит-удар $kuda, но ты угинаешься!";}
if($msg=="2"){$sms="$mob[name] наносит крит-удар $kuda, но ты отпрыгиваешь!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");

}else{
$mno=round(($uron/100)*$mob[ukrit]);
$uron=$uron+$mno;
$uron=$uron-$protect;
$uron=round($uron*$bonus);
if($uron<=0){$uron=round(0,1);}
$newhp=$udata[hp]-$uron;

mysql_query("UPDATE `users` SET `hp` = '$newhp' WHERE `usr` = '$log'");

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] наносит крит-удар $kuda! -$uron";}
if($msg=="1"){$sms="$mob[name] бьёт крит-удар $kuda! -$uron";}
if($msg=="2"){$sms="$mob[name] наносит крит-удар $kuda! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");
}
}else{
$uron=$uron-$protect;
$uron=round($uron*$bonus);
if($uron<=0){$uron=round(0,1);}
$newhp=$udata[hp]-$uron;

mysql_query("UPDATE `users` SET `hp` = '$newhp' WHERE `usr` = '$log'");

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] сильно бьёт $kuda! -$uron";}
if($msg=="1"){$sms="$mob[name] атакует $kuda! -$uron";}
if($msg=="2"){$sms="$mob[name] метко бьёт $kuda! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");
}
}else{
$msg=rand(0,2);
if($msg=="0"){$sms="Ты угнулся от удара!";}
if($msg=="1"){$sms="Ты блокировал удар!";}
if($msg=="2"){$sms="Ты увернулся от удара!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");
}
///////////////////////
//////////////////////////
if($pit[status]==on){
///////////////////////////
////////////////////////////

#********************************#
if($pit[lovk]<$mob[lovk]){
$ps_l=rand(1,100);
$pshans_lovk=round(($mob[lovk]-$pit[lovk])*5);
}
#********************************#

if($pudar==1){$bonus=1.25;$kuda='в голову';}
if($pudar==2){$bonus=1;$kuda='по туловищу';}
if($pudar==3){$bonus=0.70;$kuda='по ногам';}
/////////////
if($pudar!=$mblock and ($pit[lovk]>=$pit[lovk] or $ps_l>$pshans_lovk)){

if($pudar==1){$mprotect='pgolova';}
if($pudar==2){$mprotect='pbody';}
if($pudar==3){$mprotect='pnogi';}

$uron=rand($pit[umin],$pit[umax])+$pit[sila];

$krit=rand(1,100);
if($krit<=$pit[krit]){

$makrit=rand(1,100);
if($makrit<=$mob[antikrit]){

$msg=rand(0,2);
if($msg=="0"){$sms="$pit[name] наносит крит-удар $kuda, но $mob[name] блокирует!";}
if($msg=="1"){$sms="$pit[name] бьёт крит-удар $kuda, но $mob[name] угинается!";}
if($msg=="2"){$sms="$pit[name] наносит крит-удар $kuda, но $mob[name] отпрыгивает!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='user',place='battle',timer='$timer'");
}else{
$mno=round(($uron/100)*$pit[ukrit]);
$uron=$uron+$mno;
$uron=$uron-$mob[$mprotect];
$uron=round($uron*$bonus);
if($uron<=0){$uron=round(0,1);}
$newmob=$newmob-$uron;

mysql_query("UPDATE `guards` SET `hp` = '$newmob' WHERE `id` = '$m[mob]'");

$msg=rand(0,2);
if($msg=="0"){$sms="$pit[name] наносит крит-удар $kuda $mob[name]! -$uron";}
if($msg=="1"){$sms="$pit[name] бьёт крит-удар $kuda $mob[name]! -$uron";}
if($msg=="2"){$sms="$pit[name] наносит крит-удар $kuda $mob[name]! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='user',place='battle',timer='$timer'");
}
}else{
$uron=$uron-$mob[$mprotect];
$uron=round($uron*$bonus);
if($uron<=0){$uron=round(0,1);}
$newmob=$newmob-$uron;

mysql_query("UPDATE `guards` SET `hp` = '$newmob' WHERE `id` = '$m[mob]'");

$msg=rand(0,2);
if($msg=="0"){$sms="$pit[name] бьёт $mob[name] $kuda! -$uron";}
if($msg=="1"){$sms="$pit[name] атакует $mob[name] $kuda! -$uron";}
if($msg=="2"){$sms="$pit[name] бьёт $mob[name] $kuda! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='user',place='battle',timer='$timer'");
}
}else{
$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] угнулся от удара $pit[name]!";}
if($msg=="1"){$sms="$mob[name] блокировал удар $pit[name]!";}
if($msg=="2"){$sms="$mob[name] увернулся от удара $pit[name]!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='user',place='battle',timer='$timer'");
}
//////////////////
///////////////////
if($mudar==1){$bonus=1.25;$kuda='в голову';}
if($mudar==2){$bonus=1;$kuda='по туловищу';}
if($mudar==3){$bonus=0.70;$kuda='по ногам';}

if($pblock!=$mudar){
/////protect//////////////////////////////
////////////////////////////////////////////////////////
//////////////////////////////////////////////////////
switch($mudar){
case '1':
$protect=round(($pit[prot]+$pro[golova]+$pro[weapon])/3);
break;
case '2':
$protect=round(($pit[prot]+$pro[body]+$pro[weapon])/3);
break;
case '3':
$protect=round(($pit[prot]+$pro[nogi]+$pro[weapon])/3);
break;
}
//////////////////////////////////////////////////////
/////////////////////////////////////////////////////
//////////////////////////////////////////////////////
$uron=rand($mob[umin],$mob[umax]);

$krit=rand(1,100);
if($krit<=$mob[krit]){

$makrit=rand(1,100);
if($makrit<=$pit[antikrit]){

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] наносит крит-удар $kuda, но $pit[name] блокирует!";}
if($msg=="1"){$sms="$mob[name] бьёть крит-удар $kuda, но $pit[name] угинается!";}
if($msg=="2"){$sms="$mob[name] наносит крит-удар $kuda, но $pit[name] отпрыгивает!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");

}else{
$mno=round(($uron/100)*$mob[ukrit]);
$uron=$uron+$mno;
$uron=$uron-$protect;
$uron=round($uron*$bonus);
if($uron<=0){$uron=round(0,1);}
$newhp=$pit[hp]-$uron;

mysql_query("UPDATE `pit` SET `hp` = '$newhp' WHERE `usr` = '$log'");

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] наносит крит-удар $kuda $pit[name]! -$uron";}
if($msg=="1"){$sms="$mob[name] бьёт крит-удар $kuda $pit[name]! -$uron";}
if($msg=="2"){$sms="$mob[name] наносит крит-удар $kuda $pit[name]! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");
}
}else{
$uron=$uron-$protect;
$uron=round($uron*$bonus);
if($uron<=0){$uron=round(0,1);}
$newhp=$pit[hp]-$uron;

mysql_query("UPDATE `pit` SET `hp` = '$newhp' WHERE `usr` = '$log'");

$msg=rand(0,2);
if($msg=="0"){$sms="$mob[name] сильно бьёт $kuda $pit[name]! -$uron";}
if($msg=="1"){$sms="$mob[name] атакует $kuda $pit[name]! -$uron";}
if($msg=="2"){$sms="$mob[name] метко бьёт $kuda $pit[name]! -$uron";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");
}
}else{
$msg=rand(0,2);
if($msg=="0"){$sms="$pit[name] угнулся от удара!";}
if($msg=="1"){$sms="$pit[name] блокировал удар!";}
if($msg=="2"){$sms="$pit[name] увернулся от удара!";}

mysql_query("INSERT INTO log SET usr='$log',text='$sms',kto='enemy',place='battle',timer='$timer'");
}
}
mysql_query("UPDATE `guards` SET `hp` = '$newmob' WHERE `id` = '$m[mob]'");
/////////////////////////////////////////////////
header ("Location: fight.php?");exit; //в бой
}
/////страница!!начало
if($_GET[mod]=='ataka'){
ataka();
}else{
mein();
}
include($path.'inc/down.php');
?>
