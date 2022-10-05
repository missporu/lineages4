<?php

$headmod = 'st';//фикс. места

$textl='Звание';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
switch($_GET[mod]){

default:

// получаем Вассал
if (isset($_GET[v])){
if ($udata[wins]>=2500 && $udata[almaz]>=100 && $udata[st]<1){
$new_alm = $udata[almaz]-100; 
mysql_query ("UPDATE users SET almaz='$new_alm', st='1' WHERE usr='$log' LIMIT 1"); // пишем данные игрока с новой суммой
}}

// получаем Старейшина
if (isset($_GET[s])){
if ($udata[wins]>=10000 && $udata[almaz]>=500 && $udata[st]<2){
$new_alm = $udata[almaz]-500; 
mysql_query ("UPDATE users SET almaz='$new_alm', st='2' WHERE usr='$log' LIMIT 1"); // пишем данные игрока с новой суммой
}}

// получаем Мудрец
if (isset($_GET[m])){
if ($udata[wins]>=22500 && $udata[almaz]>=1155 && $udata[st]<3){
$new_alm = $udata[almaz]-1155; 
mysql_query ("UPDATE users SET almaz='$new_alm', st='3' WHERE usr='$log' LIMIT 1"); // пишем данные игрока с новой суммой
}}

////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $req = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `id` = '$udata[id]' LIMIT 1");
  $udata = mysql_fetch_assoc($req);
//-------------------------------------
///////////////////////////////////////////////////////////////////////////////


//------------------------------------------------------------------------------
// звания
if ($udata[st]==0) {$st='Бродяга';}
if ($udata[st]==1) {$st='Вассал';}
if ($udata[st]==2) {$st='Старейшина';}
if ($udata[st]==3) {$st='Мудрец';}

echo "<font color=grey><p>";
if ($udata[st]==3){
echo "Рад видеть тебя снова здесь $st ! Ты получил уже максимальный уровень звания ! Извени, мне предложить тебе нечего... Прощай!";}
else{
echo 'Ооо... '.$st.'! Добро пожаловать, '.$log.'! 
Вижу решил получить звание... Да... 
С ним проще бродить по миру и доверия больше! Доступно 4 звания. 1-е ,"Бродяга", даёться сразу, остальные три 
("Вассал","Старейшина" и "Мудрец") нужно зароботать. Ниже список дел для получения званий:';
echo "</font></p><hr/>";


echo "<div class=inoy>";
if ($udata[st]<1) {echo "<a href=\"?v\"> Вассал / 2`500 побед / 100 CoL </a>";}
if ($udata[st]<2) {echo "<a href=\"?s\"> Старейшина / 10`000 побед / 500 CoL </a>";}
if ($udata[st]<3) {echo "<a href=\"?m\"> Мудрец / 22`500 побед / 1155 CoL </a>";}
echo "</div>";
}


break;
}
include($path.'inc/down.php');
?>