<?
define('PROTECTOR', 1);

$textl='Рудник';
//////////////////////
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
if($udata[lvl]<111){echo'Рудник доступен с 111 уровня';include('inc/down.php');exit;}
$vr = mysql_query("SELECT * FROM `sahta` WHERE `usr` = '$log'");
$v = mysql_fetch_array($vr);
if($v[tip]=='1'){
echo'<img src="pic/rud.jpg" height="160" width="330">'; 
echo '<p><font color=#336666><b> Вы стоите возле каких то руин. Здесь можно найти много чего полезного</font></b></p><hr/>';
echo"<b><font color='orange'>Вы уже спускались в рудник!<br/> новый спуск доступен  только через:</font> <font color='violette'><u>".tl($v[time]-time())."</u></font></b><br/><hr><a href='gorod.php'>В город</a>";include('inc/down.php');exit;}
///////////////


switch($_GET[mod]){
default:
//-
$data = date("d F Yг. в H:i", strtotime("+20 seconds"));
//-
$data = str_replace("January","Января",$data);
$data = str_replace("February","Февраля",$data);
$data = str_replace("March","Марта",$data);
$data = str_replace("April","Апреля",$data);
$data = str_replace("May","Мая",$data);
$data = str_replace("June","Июня",$data);
$data = str_replace("July","Июля",$data);
$data = str_replace("August","Августа",$data);
$data = str_replace("September","Сентября",$data);
$data = str_replace("October","Октября",$data);
$data = str_replace("November","Ноября",$data);
$data = str_replace("December","Декабря",$data);


// -------------- долго ловит рыбку---------------------
$tim = time();

$req = mysql_query("SELECT * FROM `rudnik` WHERE `time`<='$tim' and `usr`='$log' Limit 1");
$avto=mysql_num_rows($req);

if($avto==1){
   $col = mysql_fetch_array($req);
      
echo "<p><font color=red>Вы долго добывали камни! Время вышло...</font></p><hr/>";
	  
	  
mysql_query("DELETE FROM `rudnik` WHERE `id` = '$col[id]' LIMIT 1");
}



//----------------урон рыбке если есть--------------------
$req = mysql_query("SELECT * FROM `rudnik` WHERE `usr` = '$log' LIMIT 1");
$fish = mysql_fetch_array($req); $avto=mysql_num_rows($req);
if ($avto > 0){


if (isset($_GET[udar])){ $uroli = yesmp;} if (isset($_GET[vl])){ $uroli = yesmp;} if (isset($_GET[vp])){ $uroli = yesmp;}
if ($uroli == yesmp){
////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $req1 = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `id` = '$udata[id]' LIMIT 1");
  $udata45 = mysql_fetch_assoc($req1);
//-------------------------------------
// ------атака прошла-----------
$newmp=$udata45[mp]-$fish[mp];
//$newhp=$udata45[hp]-$fish[mp];
if ($newmp>=0){
mysql_query("UPDATE `users` SET `mp` = '$newmp' WHERE `usr` = '$log'");
}else{//нет маны, нет рыбалки

echo "<p><font color=blue>Не хватает <b>MP</b></font></p><hr/>";

echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";
echo "<div class=inoy><a href=\"/inventar.php?mod=res&tip=elexirs\">Искать эликсир</a></div>";

include($path.'inc/down.php');


}
}
//-----------------------------------
///////////////////////////////////////////////////////////////////////////////////////
 
$ur = rand(1,3); if (isset($_GET[udar])){ $uro = 1;} if (isset($_GET[vp])){ $uro = 2;} if (isset($_GET[vl])){ $uro = 3;}

if ($ur == $uro)
{


///////////////////////////////////////////////////////////////////////////////
$re = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `ruka`='rudnik' and `image`='yes'");
$item = mysql_fetch_array($re);

$patt = rand($item[patt]/2,$item[patt]);
$matt = rand($item[matt]/2,$item[matt]);
if ($udata[klas]=="wizard") {$uron = $matt;} // если маг, то маг атака работает
if ($udata[klas]=="fighert") {$uron = $patt;} // если воин, то физ атака работает

$ur = $fish[hp]-$uron;
if ($ur <=0) { // разбил булыжник


// рыбок от уровня игрока
if($udata[lvl]<111){
$st=1;}
elseif($udata[lvl]>=111 and $udata[lvl]<125){
$st=rand(1,2);}
elseif($udata[lvl]>=125 and $udata[lvl]<150){
$st=rand(1,3);}
elseif($udata[lvl]>=150 and $udata[lvl]<175){
$st=rand(1,4);}
elseif($udata[lvl]>=175){
$st=rand(1,5);}
//------------------------------

mysql_query("UPDATE `users` SET `crystal` = `crystal` + '$st' WHERE `usr` = '".$udata['usr']."'");

//-----------------------------------------------------------------------------------

/*
// делаем от багоюзства каждый день когда 18,00 не дает килы
$date = date("d.m.Y");
$times = date("H:i");

$datans = date("H:i");
if ($datans !== '00:25' or $datans !== '00:24' or $datans !== '00:26'){

// записуем в рейтинги недели для мобов
$reqev = mysql_query("SELECT * FROM `fish_log_w` WHERE `ids` = '$udata[id]' and `usr` = '$log'");
////////////////////////////
$eve = mysql_fetch_array($reqev);
if(mysql_num_rows($reqev)>=1) // если уже участвует в рейтинге то дописываем
{
$skoko=$eve[skoko]+$co;
mysql_query("UPDATE fish_log_w SET skoko='$skoko' WHERE ids='$udata[id]' and usr='$log'");} // дописываем +1 к количеству

else{ // если нет игрока в рейтинге то создаем ему
mysql_query("INSERT INTO fish_log_w SET usr='$log',ids='$udata[id]',skoko='$co'"); // создаем таблицу юзеру
}
}

$date = date("d.m.Y");
$times = date("H:i");
$data1 = date("H:i");
if ($data1 !== '00:25' or $data1 !== '00:24' or $data1 !== '00:26'){
// записуем в рейтинги недели для мобов
$reqev = mysql_query("SELECT * FROM `fish_log` WHERE `ids` = '$udata[id]' and `usr` = '$log'");
////////////////////////////
$eve = mysql_fetch_array($reqev);
if(mysql_num_rows($reqev)>=1) // если уже участвует в рейтинге то дописываем
{
$skoko=$eve[skoko]+$co;
mysql_query("UPDATE fish_log SET skoko='$skoko' WHERE ids='$udata[id]' and usr='$log'");} // дописываем +1 к количеству
else{ // если нет игрока в рейтинге то создаем ему
mysql_query("INSERT INTO fish_log SET usr='$log',ids='$udata[id]',skoko='$co'"); // создаем таблицу юзеру
}
}
*/

//-----------------------------------------------------------------------------------



//	---	//	---	//	---	//	//	 	ЗАДАНИЯ		//	//	---	//	---	//	---	//
/*
if ($udata[lvl]>49){
$reqev = mysql_query("SELECT * FROM job_fish WHERE `usr` = '$log' Limit 1");
////////////////////////////
$jm = mysql_fetch_array($reqev);
if(mysql_num_rows($reqev)>=1){ // если уже участвует  то дописываем
if ($jm[kill]!=='off'){ // если уже получил вознагр то табла не созд
$kill=$jm[kill]+$co; if ($kill>500){$kill=500;}
mysql_query("UPDATE job_fish SET `kill` = '$kill' WHERE `usr` = '$log' Limit 1");}} // дописываем +1 к количеству
else{ // если нет игрока в рейтинге то создаем ему
mysql_query("INSERT INTO job_fish SET `usr` = '$log', `kill`='1', `data`='no'"); // создаем таблицу юзеру
}}
//-----------------------------------------------------------------------------
//----------------------- КЛАН ЗАДАНИЕ
if ($udata[lvl]>76){
$cl = mysql_query("SELECT * FROM `clan` WHERE `lider` = '$udata[clan]'");
$clan = mysql_fetch_array($cl); 
$reqev = mysql_query("SELECT * FROM cl_job_fish WHERE `clan` = '$clan[name]' LIMIT 1");
////////////////////////////  
$jm = mysql_fetch_array($reqev);  
if(mysql_num_rows($reqev)>=1){ // если уже участвует  то дописываем  
if ($jm[kill]!=='off'){ // если уже получил вознагр то табла не созд  
$kill=$jm[kill]+$co; if ($kill>10000){$kill=10000;}  
mysql_query("UPDATE cl_job_fish SET `kill` = '$kill' WHERE `clan` = '$clan[name]' Limit 1");}} // дописываем +1 к количеству
else{ // если нет игрока в рейтинге то создаем ему  
mysql_query("INSERT INTO cl_job_fish SET `clan` = '$clan[name]', `kill`='$co', `data`='no'"); // создаем таблицу юзеру
}} 

if($udata[clan]){ 
$reqe = mysql_query("SELECT * FROM cl_job_fish_log WHERE `usr` = '$log' LIMIT 1");
////////////////////////////   
$jm = mysql_fetch_array($reqe);   
if(mysql_num_rows($reqe)>=1){ // если уже участвует  то дописываем   
$kill=$jm[kill]+$co; 
mysql_query("UPDATE cl_job_fish_log SET `kill` = '$kill' WHERE `usr` = '$log' and `clan` = '$clan[name]' Limit 1");} // дописываем +1 к количеству
else{ // если нет игрока в рейтинге то создаем ему   
mysql_query("INSERT INTO cl_job_fish_log SET `clan` = '$clan[name]', `kill`='$co', `usr` = '$log', `data`='no'"); // создаем таблицу юзеру
}}
//-----------------КОНЕЦ
*/



echo "<p><font color=grey>Добыто $st <img src='pic/crystal.png' height='20' width='20'></font></p>";
echo "<div class=dot><p>Всего $udata[crystal] <img src='pic/crystal.png' height='20' width='20'> у вас</p></div>";

$tim = time()+3600;
mysql_query("INSERT INTO `sahta` SET `usr` = '$log', `tip` = '1', `time` = '$tim'");
mysql_query("DELETE FROM `rudnik` WHERE `id` = '$fish[id]' and `usr` = '$log'");

echo "<div class=inoy><a href=\"rudnik.php\">К руднику</a>";
echo "<a href=\"/gorod.php\">В город</a></div>";


include($path.'inc/down.php');

}
else { // записуем данные новое ХП

mysql_query ("UPDATE `rudnik` SET `hp` = '$ur' WHERE `usr` = '$log' LIMIT 1"); // пишем данные рыбки суммой

echo "<p> <font color=whiteblue>Нанесли урон Булыжнику </font><font color=red> <b>".number($uron)." HP</b> </font> </p>";

}
}
echo'<img src="pic/rud.jpg" height="160" width="330">';
}
//--------Открываем БД и проверяем ловит игрок рыбу уже или нет-------------//
$req = mysql_query("SELECT * FROM `rudnik` WHERE `usr` = '$log' LIMIT 1");
$fish = mysql_fetch_array($req);
$avto=mysql_num_rows($req);

if ($avto > 0){ 

$t = tl($fish[time]-$tim);

echo "<div class=dot>";
echo "Осталось добывать: $t <br/>";
echo "<b>Булыжник: <font color=red>Прочность</font></b> (".number($fish[hp])." / ".number($fish[hpall]).")";
echo "</div>";

$t44 = rand(1,2);
if ($t44==1){$tt = "Удар слабый...";}
if ($t44==2){$tt = "Вы ударили мимо...";}

echo "<div class=dot><font color=grey> $tt </font></div>
<hr/><p><b>Добывать <font color=blue>-$fish[mp]MP</font></b></p>";


echo "<div class=inoy><a href=\"?udar\">Ударить </a>";



include($path.'inc/down.php');

}

//--------Открываем БД и проверяем-------------//
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `ruka`='rudnik' and `image`='yes'");
$fish = mysql_fetch_array($req);
$avto=mysql_num_rows($req);

// --------кирка одета--------------------//
if ($avto > 0){ 

// -- если ловить тогда ---//
if (isset($_GET[go])){ $fs=rand(1,2);


if ($fs == 2){ // один шанс из трёх удачно закинуть наживку

if($udata[lvl]>=111){
$hp=5000; $mp=50;}

$time=time()+900;

mysql_query("INSERT INTO rudnik SET usr='$log',time='$time',hp='$hp',mp='$mp',hpall='$hp',lvl='$udata[lvl]'");

echo "<font color=grey> Вы нашли место на добычу... </font><hr/>";

echo "<div class=inoy><a href=\"?\">Добывать</a></div>";

include($path.'inc/down.php');


}else{

$t45 = rand(1,2);
if ($t45==1){$tt = "Бродя по руинам вы заблудились.....";}
if ($t45==2){$tt = "вы всё ещё пытаетесь найти подходящее место...";}

echo "<font color=grey> $tt </font><hr/>";

echo "<div class=inoy><a href=\"?go\">Искать место</a></div>";
echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";
include($path.'inc/down.php');

}}
//--------- кирка одета предложение что делать----------//
echo '<p><font color=#336666><b>Рудник:</b></font></p><hr/>';

echo'<img src="pic/rud.jpg" height="160" width="330">';
echo "<font color=grey> Вы стоите возле каких то руин. Здесь можно найти много чего полезного.
В руках уже приготовлена кирка: </font><hr/>";

echo "<div class=inoy><a href=\"?go\">Искать место для добычи</a></div>";
echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";

echo "<hr/>";	
}else{

// ------кирка не одета------------------//

echo'<img src="pic/rud.jpg" height="160" width="330">';
echo '<p><font color=#336666><b> Вы стоите возле каких то руин. Здесь можно найти много чего полезного.
Перед раскопками нужно одеть кирку. </b></font></p><hr/>';

echo "<div class=inoy><a href=\"/inventar.php?mod=item&o=weapon\">Искать кирку</a></div>";
echo "<div class=inoy><a href=\"/kirka.php\">Покупка Киркы</a></div>";
echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";

}
//----------------------------------------------//


break;

}


include($path.'inc/down.php');
?>