<?php

include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
place_city();
place_zamok();
place_tower();
include($path.'inc/core.php');



// анти откат //

$ant_ot = mysql_num_rows(mysql_query("SELECT * FROM `mesto` WHERE `anti_otkat` = '$_SESSION[anti_otk]' and `usr` = '$udata[usr]' LIMIT 1"));
if ($ant_ot==0){
header ('Location: okrestnosti.php?');exit; 
}

$anti_otkat=rand(741,942431);
mysql_query("UPDATE `mesto` SET `anti_otkat`='$anti_otkat' WHERE `usr` = '$log'"); // пишем новые данные

//----------------




$time=time();
////////////////////////////////////////////////////////
if ($user_id==1){
if ($inaw==1){
include($path.'inc/head.php');
include($path.'inc/zag.php');
echo'У вас бой на арене!';
include($path.'inc/down.php');exit;
}
///////////////
$id=htmlspecialchars($_GET[id]);
if(empty($_GET[k])){
/////////////////////////////////////////////////////
////////////////////////
$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
$mestouser = mysql_fetch_assoc($req);
////////////////////////////

$req = mysql_query("SELECT * FROM `mobs` WHERE `okra` = '$mestouser[mesto]' and `id` = '".mysql_real_escape_string($_GET[id])."' LIMIT 1");
////////////////////////////
if (mysql_num_rows($req)==0){
$textl='Битва';
include($path.'inc/head.php');
include($path.'inc/zag.php');
echo"Такого монстра не существует.";include($path.'inc/down.php');exit;}
///////////////////////////// 
$mob = mysql_fetch_assoc($req);
if($mob['status']=='battle' or $mob['status']=='off'){
header ('Location: okrestnosti.php?');exit;
}

if ($mob[hp]<=0){
mysql_query("DELETE FROM `tmp` WHERE usr='$log' LIMIT 1");//выходим из боя
mysql_query("INSERT INTO log SET usr='$log',text='Монстр $mob[name] уже убит!',kto='system',place='battle',timer='$timer'");
header ('Location: okrestnosti.php?');exit;
}

mysql_query("UPDATE `mobs` SET `status` = 'battle',`oponent`='$log' WHERE `city` = '$udata[city]' and `location`='$udata[location]' and `id`='$id' LIMIT 1");

mysql_query("INSERT INTO `tmp` SET `usr` = '$log',`mob` = '$id',`location`='$udata[location]',`city` = '$udata[city]',`ltime`='$time'");

$timer=time()+300;

del_log($lpl='battle');

mysql_query("INSERT INTO log SET usr='$log',text='$log против $mob[name]! Бой начался!',kto='system',place='battle',timer='$timer'");

header ('Location: battle.php?');exit; 
}elseif($_GET['k']=='pk'){
$req = mysql_query("SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($_GET[id])."'");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto=="0"){
$textl='Битва';
include($path.'inc/head.php');
include($path.'inc/zag.php');
echo'Нет такого игрока!';
include($path.'inc/down.php');exit;
}
$pk = mysql_fetch_assoc($req);

$req = mysql_query("SELECT * FROM `pk` WHERE `usr` = '$pk[usr]' LIMIT 1");
$avto=mysql_num_rows($req);

if($avto>="1"){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Игрок уже в бою!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;

}


$reqtmp = mysql_query("SELECT * FROM `tmp` WHERE `usr` = '$pk[usr]' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){
$textl='Битва';
//include($path.'inc/head.php');
//include($path.'inc/zag.php');
mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Игрок уже в бою!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}

$reqtmp = mysql_query("SELECT * FROM `tmp_zamok` WHERE `usr` = '$pk[usr]' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Игрок уже в бою!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}



$reqtmp = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$pk[usr]' and `place` != 'okrestnosti' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Игрок не в окресностях!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}


$reqtmp = mysql_query("SELECT * FROM `tmp_zamok` WHERE `usr` = '$log' LIMIT 1");
if (mysql_num_rows($reqtmp)>=1){header ("Location: battle.php?");exit;}

if($pk[usr]==$log){
$textl='Битва';
mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='На себя напасть нельзя!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}

if($pk[dostup]>3){
$textl='Битва';
mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Админа бить нельзя =)',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}


///////////////// совпадение окр и места //////////////////

$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$pk[usr]'");
$mpk = mysql_fetch_array($req);
$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log'");
$mypk = mysql_fetch_array($req);

if($mpk[mesto] != $mypk[mesto] or $mpk[page] != $mypk[page] or $mpk[place] != $mypk[place]){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Игрок не рядом!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}

///////////////////////////////////////////////////////////

$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$pk[usr]'");
$mpk = mysql_fetch_assoc($req);
$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log'");
$mypk = mysql_fetch_assoc($req);


/*
/////////////////////////////////////////////////////////////////////
$raz1 = $pk[lvl] - $udata[lvl];
if ($raz1 < 0){$raz1 = $raz1*-1;}

if($raz1 > 5){ // разница более 5 уровней
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Разница более 5 уровней!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}
/////////////////////////////////////////////////////////////////////
*/


$reqvip = mysql_query("SELECT * FROM `anti_pk` WHERE `usr` = '$pk[usr]' LIMIT 1");
$avto=mysql_num_rows($reqvip);
if($avto==1){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Анти-ПК акаунт!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}

$reqvip = mysql_query("SELECT * FROM `anti_pk` WHERE `usr` = '$udata[usr]' LIMIT 1");
$avto=mysql_num_rows($reqvip);
if($avto==1){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Анти-ПК акаунт!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}





if($pk[lvl]<100){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='На слабых нападать нельзя!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}



if($udata[lvl]<100){
$textl='Битва';

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='PK с 100 уровня!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}


$timeout = time() - 150;

$asd = mysql_num_rows(mysql_query("SELECT laikas, usr FROM online WHERE laikas > '$timeout' AND usr='$pk[usr]'"));
////////////////////////////

if($asd=='0'){
$textl='Битва';
include($path.'inc/head.php');
include($path.'inc/zag.php');

mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Этот игрок Офф-Лайн!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;


}
if($pk['hp']<='0'){
$textl='Битва';
mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Игрок убит!',kto='user',place='battle',timer='$timer',new='1'");

header ('Location: okrestnosti.php?');exit;
}

//del_log($lpl='pk');

$timer=time()+300;
//////////////////////////////////////////////////////////////////////////////////////////////////
// PK сразу снимает ХП

$reqpk = mysql_query("SELECT * FROM `users` where `id`='$id'");
$pk = mysql_fetch_array($reqpk);
// щитаем урон

if ($udata[klas]=="wizard") {$uron = $udata[matt]-$pk[mdef];}   // если маг, то  работает маг атака и маг защита
if ($udata[klas]=="fighert") {$uron = $udata[patt]-$pk[pdef];}  // если воин, то работает физ атака и защита

If ($uron<0){$uron=0;} // если урон в минуса то он равен 0 иначе плюсует без этого кода

$pkmoney=round($pk[money]/100);
$pkmon=rand(1,$pkmoney); // щитаем сколько забрать денег

if ($pk[hp]>$uron){

$nhp=$pk[hp]-$uron;

mysql_query("UPDATE users SET hp = '$nhp' WHERE `id` = '$id'");
mysql_query("INSERT INTO logpk SET usr='$pk[usr]',text='Вас атаковал в PK $udata[usr] <b>-$uron</b>!',kto='enemy',place='battle',timer='$timer',new='1'");
mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Вы атаковали в PK $pk[usr] <b>-$uron</b>!',kto='user',place='battle',timer='$timer',new='1'");


header ('Location: okrestnosti.php?');exit;

}else{

$nhp=$pk[hp]-$uron;
$nloses=$pk[loses]+1;
$nmon2=$pk[money]-$pkmon;
If ($nmon2<0){$nmon2=0;} // защиту от минус значения
mysql_query("UPDATE users SET hp = '$nhp',loses = '$nloses',money = '$nmon2' WHERE `id` = '$id'"); // пишем данные утакававшего


$nwin=$udata[wins]+1;
$nmon=$udata[money]+$pkmon;
// проверяем на совмесность в клане

$nkarma=$udata[karma]+1; // карма
mysql_query("UPDATE users SET karma = '$nkarma',money = '$nmon',wins = '$nwin' WHERE `usr` = '$log'");
mysql_query("INSERT INTO logpk SET usr='$pk[usr]',text='Вас убил в PK $udata[usr] <b>-$pkmon Аден</b>!',kto='enemy',place='battle',timer='$timer',new='1'");
mysql_query("INSERT INTO logpk SET usr='$udata[usr]',text='Вы убили в PK $pk[usr] <b>+$pkmon Аден</b>!',kto='user',place='battle',timer='$timer',new='1'");


//-----------------------------------------------------------------------------------

$date = date("d.m.Y");
$times = date("H:i");

$datans = date("H:i-w");
if ($datans == '00:00-0'){ /* в 3 часа дня воскресенье  когда время 15,00 ничего не делает*/}else{ /*иначе*/

// записуем в рейтинги недели
$reqev = mysql_query("SELECT * FROM `eve_pk_w` WHERE `ids` = '$udata[id]' and `usr` = '$log'");
////////////////////////////
$eve = mysql_fetch_array($reqev);
if(mysql_num_rows($reqev)>=1) // если уже участвует в рейтинге то дописываем
{
$skoko=$eve[skoko]+1;
mysql_query("UPDATE eve_pk_w SET skoko='$skoko' WHERE ids='$udata[id]' and usr='$log'");} // дописываем +1 к количеству

else{ // если нет игрока в рейтинге то создаем ему
mysql_query("INSERT INTO eve_pk_w SET usr='$log',ids='$udata[id]',skoko='1'"); // создаем таблицу юзеру
}
}

$date = date("d.m.Y");
$times = date("H:i");

$datans = date("H:i");
if ($datans == '00:25'){ /* в 3 часа дня воскресенье  когда время 15,00 ничего не делает*/}else{ /*иначе*/

// записуем в рейтинги недели
$reqev = mysql_query("SELECT * FROM `eve_pk` WHERE `ids` = '$udata[id]' and `usr` = '$log'");
////////////////////////////
$eve = mysql_fetch_array($reqev);
if(mysql_num_rows($reqev)>=1) // если уже участвует в рейтинге то дописываем
{
$skoko=$eve[skoko]+1;
mysql_query("UPDATE eve_pk SET skoko='$skoko' WHERE ids='$udata[id]' and usr='$log'");} // дописываем +1 к количеству

else{ // если нет игрока в рейтинге то создаем ему
mysql_query("INSERT INTO eve_pk SET usr='$log',ids='$udata[id]',skoko='1'"); // создаем таблицу юзеру
}
}
//-----------------------------------------------------------------------------------


header ('Location: okrestnosti.php?');exit;

}



}else{
echo'Ошибка!';include($path.'inc/down.php');exit;}
}else
{
echo 'Ошибка!Вы не авторизованы!<a href="index.php"> <br/><br/>Авторизуйтесь</a>';require_once 'inc/end.php';exit;
}
?>