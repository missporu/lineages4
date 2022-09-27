<?
define('PROTECTOR', 1);

if($_GET[mod]=='ataka' or $_GET[mod]=='mag'){
$header=TRUE;
}else{
$textl='Битва';
}

$headmod = 'combat';//фикс. места
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
////////////////////////
$req = mysql_query("SELECT * FROM `arena` WHERE `usr` = '$log' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){echo"Вы ненаходитесь в бою!";include($path.'inc/down.php');exit;}
$my = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `arena` WHERE `usr` = '$my[enemy]' LIMIT 1");
$pk = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$my[enemy]' LIMIT 1");
$he = mysql_fetch_array($req);
function timer(){
global $log;
$time=time();
mysql_query("UPDATE `arena` SET `ltime` = '$time' WHERE `usr` = '$log'");
}
///////////////////////
function lose(){
global $log,$pas,$my,$pk,$he,$udata;

$time=time();
$losetime=$my[ltime]+300;

if(empty($pk[ltime])){$pk[ltime]=9290842337;}
if($udata[hp]<=0 or $time>$losetime or $my[pk]==lose){
$nloses=$udata[arenaloses]+1;
if($he[hp]<=0 or ($pk[ltime]+300)<$time){
@ mysql_query("UPDATE arena SET pk = 'lose' WHERE usr = '$he[usr]'");
}else{
@ mysql_query("UPDATE arena SET pk = 'win' WHERE usr = '$he[usr]'");
}
mysql_query("UPDATE users SET arenaloses = '$nloses',hp='0' WHERE usr = '$log'");//пишем данные в плэера
mysql_query("UPDATE regenerator SET last = '$time' WHERE usr = '$log'");//сбиваем регенерацию
mysql_query("DELETE FROM `arena` WHERE usr='$log'");//чистим логи
mysql_query("DELETE FROM `arena_log` WHERE usr='$log'");//чистим логи

mysql_query("UPDATE `mesto` SET `page` = '7',`loca` = 'city' WHERE `usr` = '$log'");//место в локах
echo"Вы проиграли бой на арене!<br/>";
echo"<a href=\"arena.php?\">Продолжить</a>";
include($path.'inc/down.php');
exit;
}
}
function win(){
global $log,$pas,$my,$pk,$he,$udata;

$time=time();
if(empty($pk[ltime])){$pk[ltime]=0;}
if(($he[hp]<=0 or ($pk[ltime]+300)<$time or $my[pk]==win) or (empty($pk[usr]) and $udata[hp]>0)){

$nwins=$udata[arenawins]+1;
$exp=round($he[hpall]/4);
$nexp=round($udata[exp]+$exp);
if($udata[lvl]==0){$udata[lvl]=1;}
$money=round(($he[lvl]*$udata[lvl])/2);
$nmoney=round($udata[money]+$money);

if($he[hp]<=0 or ($pk[ltime]+300)<$time){
@ mysql_query("UPDATE arena SET pk = 'lose' WHERE usr = '$pk[log]'");
}

mysql_query("UPDATE users SET arenawins = '$nwins',exp='$nexp',money='$nmoney' WHERE usr = '$log'");//пишем данные в плэера
mysql_query("DELETE FROM `arena` WHERE usr='$log'");//чистим логи
mysql_query("DELETE FROM `arena_log` WHERE usr='$log'");//чистим логи

$reqm = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
$mm = mysql_fetch_array($reqm);
if(empty($mm[page])){$mm[page]=7;}

echo"Вы победили в бою с $he[usr]!<br/>";
echo"+$exp опыта<br/>";
if($money>0){
echo"+$money монет<br/>";}

echo"<a href=\"arena.php?\">Продолжить</a>";

include($path.'inc/down.php');
exit;
}
}
function goboj(){
global $log,$pas,$my,$pk,$he,$udata;
$rand=rand(1000,9999);
$timer=time()+300;
if($my[xod]=='wait' and $pk[xod]=='not'){
echo'Противник не сделал хода!<br/>';
echo"<a href=\"combat.php?r=$rand\">Обновить</a>";
include($path.'inc/down.php');exit;
}elseif($my[xod]=='wait' and $pk[xod]=='wait'){
////хз///////
if($my[udar]==1){$bonus=1.25;$kuda='в голову';}
if($my[udar]==2){$bonus=1;$kuda='в грудь';}
if($my[udar]==3){$bonus=0.75;$kuda='по ногам';}

if($pk[udar]==1){$bonus=1.25;$kuda='в голову';}
if($pk[udar]==2){$bonus=1;$kuda='в грудь';}
if($pk[udar]==3){$bonus=0.75;$kuda='по ногам';}
///////////////////
if($my[tip]==mag){
$req = mysql_query("SELECT * FROM `mag` WHERE `id` = '$my[mag]' and `usr` = '$log' LIMIT 1");
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

$uron=$mag[uron];

$uron=$uron-$he[prot];
if($uron<=0){$uron=round(0,1);}
$newhp=$he[hp]-$uron;

mysql_query("UPDATE `users` SET `hp` = '$newhp' WHERE `usr` = '$pk[usr]'");
$newmp=$udata[mp]-$mag[mp];
$newhp=$udata[hp]-$mag[hp]+$mag[plushp];
mysql_query("UPDATE `users` SET `mp` = '$newmp',`hp` = '$newhp' WHERE `usr` = '$log'");

mysql_query("INSERT INTO log SET usr='$log',text='Ты используешь $mag[name] $pk[usr]! -$uron',kto='user',place='combat',timer='$timer'");
mysql_query("INSERT INTO log SET usr='$pk[usr]',text='$log использует $mag[name]! -$uron',kto='enemy',place='combat',timer='$timer'");
}else{
if($my[udar]==$pk[block] and $pk[tip]==ataka){
mysql_query("INSERT INTO log SET usr='$log',text='Ты бьёшь $kuda $pk[usr], но он блокировал!',kto='user',place='combat',timer='$timer'");
mysql_query("INSERT INTO log SET usr='$pk[usr]',text='$log бьёт тебя $kuda, но ты блокируешь!',kto='enemy',place='combat',timer='$timer'");

}else{

$uron=round($udata[umin],$udata[umax])+$udata[sila];
$uron=round($uron*$bonus);
////////////////////////////////////////////////////////
//////////////////////////////////////////////////////
switch($my[udar]){
case '1':
$heprotect=round(($he[prot]+$he[pgolova])/3);
break;
case '2':
$heprotect=round(($he[prot]+$he[pbody])/3);
break;
case '3':
$heprotect=round(($he[prot]+$he[pnogi])/3);
break;
}

$uron=$uron-$heprotect;
if($uron<=0){$uron=round(0,1);}
$newhp=$he[hp]-$uron;
mysql_query("UPDATE `users` SET `hp` = '$newhp' WHERE `usr` = '$pk[usr]'");

mysql_query("INSERT INTO log SET usr='$log',text='Ты бьёшь $pk[usr] $kuda! -$uron',kto='user',place='combat',timer='$timer'");
mysql_query("INSERT INTO log SET usr='$pk[usr]',text='$log бьёт тебя $kuda! -$uron',kto='enemy',place='combat',timer='$timer'");
}
}
if($pk[tip]==mag){
$req = mysql_query("SELECT * FROM `mag` WHERE `id` = '$pk[mag]' and `usr` = '$pk[usr]' LIMIT 1");
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

$uron=$mag[uron];

$uron=$uron-$udata[prot];
if($uron<=0){$uron=round(0,1);}
$newhp=$udata[hp]-$uron;
mysql_query("UPDATE `users` SET `hp` = '$newhp' WHERE `usr` = '$log'");
$newmp=$he[mp]-$mag[mp];
$newhp=$he[hp]-$mag[hp]+$mag[plushp];
mysql_query("UPDATE `users` SET `mp` = '$newmp',`hp` = '$newhp' WHERE `usr` = '$pk[usr]'");

mysql_query("INSERT INTO log SET usr='$pk[usr]',text='Ты используешь $mag[name] $log! -$uron',kto='user',place='combat',timer='$timer'");
mysql_query("INSERT INTO log SET usr='$log',text='$pk[usr] использует $mag[name]! -$uron',kto='enemy',place='combat',timer='$timer'");
}else{
if($pk[udar]==$my[block] and $my[tip]==ataka){
mysql_query("INSERT INTO log SET usr='$pk[usr]',text='Ты бьёшь $kuda $log, но он блокировал!',kto='user',place='combat',timer='$timer'");
mysql_query("INSERT INTO log SET usr='$log',text='$pk[usr] бьёт тебя $kuda, но ты блокируешь!',kto='enemy',place='combat',timer='$timer'");
}else{

$uron=round($he[umin],$he[umax])+$he[sila];
$uron=round($uron*$bonus);
////////////////////////////////////////////////////////
//////////////////////////////////////////////////////
switch($pk[udar]){
case '1':
$protect=round(($udata[prot]+$udata[pgolova])/3);
break;
case '2':
$protect=round(($udata[prot]+$udata[pbody])/3);
break;
case '3':
$protect=round(($udata[prot]+$pro[pnogi])/3);
break;
}

$uron=$uron-$protect;
if($uron<=0){$uron=round(0,1);}
$newhp=$udata[hp]-$uron;

mysql_query("UPDATE `users` SET `hp` = '$newhp' WHERE `usr` = '$log'");

mysql_query("INSERT INTO log SET usr='$pk[usr]',text='Ты бьёшь $log $kuda! -$uron',kto='user',place='combat',timer='$timer'");
mysql_query("INSERT INTO log SET usr='$log',text='$pk[usr] бьёт тебя $kuda! -$uron',kto='enemy',place='combat',timer='$timer'");
}}
////////////////////конец хода
$time=time();
mysql_query("UPDATE `arena` SET `xod` = 'not',`ltime`='$time' WHERE `usr` = '$log'");
mysql_query("UPDATE `arena` SET `xod` = 'not',`ltime`='$time' WHERE `usr` = '$pk[usr]'");
echo'Ход окончен!<br/>';
echo"<a href=\"combat.php?r=$rand\">Продолжить</a>";
include($path.'inc/down.php');exit;
///////////////////////////////
}
}
function mein(){
global $log,$pas,$my,$pk,$he,$udata;
timer();
lose();
win();
goboj();
echo'<form action="combat.php?mod=ataka" method="post">';
echo '<table border="0" align="left">';

echo "
 <tr>
<td class=\"zagolovok\" width=\"50%\"><strong>Удар:</strong></td>
<td class=\"zagolovok\" width=\"50%\"><strong>Блок:</strong></td>
</tr>
<tr>
<td>
<select  name=\"udar\">
<option value=\"1\">Голова</option>
<option value=\"2\">Грудь</option>
<option value=\"3\">Ноги</option>
</select>
</td>
<td>
<select  name=\"block\">
<option value=\"1\">Голова</option>
<option value=\"2\">Грудь</option>
<option value=\"3\">Ноги</option>
</select>
</td>
</tr>
</table>
";

echo '<input class="button" type="submit" value="Ok" /></form><br/>';

$ma = mysql_query("SELECT * FROM `mag` WHERE `usr` = '$log' LIMIT 1");
if(mysql_num_rows($ma)>=1)
{
While($mag = mysql_fetch_array($ma))
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

echo"<br/><a href=\"combat.php?mod=mag&amp;id=$mag[id]\">$mag[name]</a> ($mag[uron],$mag[mp],$mag[hp],$mag[plushp])";
}
}else{
echo'<br/><b>Нет умений</b>';
}
log_msg($tlog='combat');
}
//////////
function ataka(){
global $log,$pas,$my,$pk,$udata,$_POST;

if($my[xod]==wait){
header ("Location: combat.php?");exit;
}
if(empty($_POST[udar]) or empty($_POST[block])){
timer();
header ("Location: combat.php?");exit;
}

$time=time();

mysql_query("UPDATE `arena` SET `xod` = 'wait',`tip` = 'ataka',`ltime`='$time',`block`='".mysql_real_escape_string($_POST[block])."',`udar`='$_POST[udar]' WHERE `usr` = '$log'");

header ("Location: combat.php?");exit;
}
/////////////////
function mag(){
global $log,$pas,$my,$pk,$udata;
$timer=time()+300;
if($my[xod]==wait){
header ("Location: combat.php?");exit;
}
$req = mysql_query("SELECT * FROM `mag` WHERE `id` = '".mysql_real_escape_string($_GET[id])."' and `usr` = '$log' LIMIT 1");

if (mysql_num_rows($req)==0){
mysql_query("INSERT INTO log SET usr='$log',text='Нет такого умения!',kto='system',place='combat',timer='$timer'");
header ("Location: combat.php?");exit; 
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
mysql_query("INSERT INTO log SET usr='$log',text='Нехватает здоровья!',kto='system',place='combat',timer='$timer'");
header ("Location: combat.php?");exit; 
}

if ($mag[mp]>$udata[mp]){
mysql_query("INSERT INTO log SET usr='$log',text='Нехватает маны!',kto='system',place='combat',timer='$timer'");
header ("Location: combat.php?");exit; 
}

$time=time();

mysql_query("UPDATE `pk` SET 
        `xod` = 'wait',
        `tip` = 'mag',
        `ltime`='$time',
`mag`='".mysql_real_escape_string($_GET[id])."' WHERE `usr` = '$log'");
        
header ("Location: combat.php?");exit; 
}
/////страница!!начало
if($_GET[mod]=='ataka'){
ataka();
}elseif($_GET[mod]=='mag' and $_GET[id]>'0'){
mag();
}else{
mein();
}
include($path.'inc/down.php');
?>
