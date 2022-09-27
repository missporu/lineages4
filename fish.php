<?
define('PROTECTOR', 1);

$textl='Рыбалка';
///////////////////////
//	$path='../';			//
//////////////////////
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
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

$req = mysql_query("SELECT * FROM `fish` WHERE `time`<='$tim' and `usr`='$log' Limit 1");
$avto=mysql_num_rows($req);

if($avto==1){
   $col = mysql_fetch_array($req);
      
echo "<p><font color=red>Вы долго ловили рыбку! Она сорвалась....</font></p><hr/>";
	  
	  
mysql_query("DELETE FROM `fish` WHERE `id` = '$col[id]' LIMIT 1");
}



//----------------урон рыбке если есть--------------------
$req = mysql_query("SELECT * FROM `fish` WHERE `usr` = '$log' LIMIT 1");
$fish = mysql_fetch_array($req); $avto=mysql_num_rows($req);
if ($avto > 0){


if (isset($_GET[ns])){ $uroli = yesmp;} if (isset($_GET[vp])){ $uroli = yesmp;} if (isset($_GET[vl])){ $uroli = yesmp;}
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
 
$ur = rand(1,3); if (isset($_GET[ns])){ $uro = 1;} if (isset($_GET[vp])){ $uro = 2;} if (isset($_GET[vl])){ $uro = 3;}

if ($ur == $uro)
{


///////////////////////////////////////////////////////////////////////////////

if ($udata[klas]=="wizard") {$uron = $udata[matt];} // если маг, то маг атака работает
if ($udata[klas]=="fighert") {$uron = $udata[patt];} // если воин, то физ атака работает

$ur = $fish[hp]-$uron;
if ($ur <=0) { // убил рыбку


// рыбок от уровня игрока
if($udata[lvl]<40){
$st=1;}
elseif($udata[lvl]>=40 and $udata[lvl]<72){
$st=1;}
elseif($udata[lvl]>=72 and $udata[lvl]<100){
$st=2;}
elseif($udata[lvl]>=100 and $udata[lvl]<130){
$st=2;}
elseif($udata[lvl]>=130 and $udata[lvl]<160){
$st=3;}
elseif($udata[lvl]>=160){
$st=3;}
//------------------------------
// рыбок от уровня удки
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `tip`='weapon' and `image`='yes' and `ruka`='fish'");
$mag = mysql_fetch_array($req);
$u = explode("*",$mag[name]);

if($mag[nlvl]==0){$st_ud=1;}
if($mag[nlvl]==40){$st_ud=2;}
if($mag[nlvl]==62){$st_ud=3;}
if($mag[nlvl]==96){$st_ud=4;}
if($mag[nlvl]==111){$st_ud=20;}

//-----------------------------------
// сколько рыбинок в итоге
$co_n = rand(1,$st);
$co_r = rand(1,$st_ud);

$co = $co_n * $co_r;
//----------------------------------- пишем в инвентарь ----------------------
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `lat_name` = 'fish'");
$res=mysql_num_rows($req);
$rs = mysql_fetch_array($req);
if($res==0){
mysql_query("INSERT INTO
        `res` SET
        `usr` = '$log',
        `name` = 'Fish',
        `lat_name` = 'fish',
        `tip` = 'res',
        `what` = 'fish',
        `give` = '0',
        `kol` = '$co',
        `cena` = '10000'");
$nk=$rs[kol]+$co;
}else{
$nk=$rs[kol]+$co;
mysql_query("UPDATE `res` SET `kol` = '$nk' WHERE `usr` = '$log' and `lat_name` = 'fish'");
}
//------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------


// делаем от багоюзства каждый день когда 18,00 не дает килы
$date = date("d.m.Y");
$times = date("H:i");

$datans = date("H:i-w");
if ($datans !== '00:00-0' or $datans !== '00:00-0' or $datans !== '00:01-0'){

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
//-----------------------------------------------------------------------------------



//	---	//	---	//	---	//	//	 	ЗАДАНИЯ		//	//	---	//	---	//	---	//
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




if(($udata['rib_och'])>=1){
$rib_och= $udata['rib_och']+$co;
mysql_query("UPDATE `users` SET `rib_och`='".$rib_och."' WHERE `usr`='".$log."' ");} 
else{ 
mysql_query("UPDATE `users` SET `rib_och`='".$co."' WHERE `usr`='".$log."'"); }
echo "<p><font color=grey>Словленно $co рыбок!</font></p>";
echo "<div class=dot><p>Всего $nk рыбок у вас в сумке!</p></div>";

mysql_query("DELETE FROM `fish` WHERE `id` = '$fish[id]' and `usr` = '$log'");

echo "<div class=inoy><a href=\"?go\">Забросить снова</a>";
echo "<a href=\"/fish_r.php\">Разделать</a></div>";
echo "<a href=\"/gorod.php\">В город</a></div>";


include($path.'inc/down.php');

}
else { // записуем данные новое ХП

mysql_query ("UPDATE fish SET hp='$ur' WHERE usr='$log' LIMIT 1"); // пишем данные рыбки суммой

echo "<p> <font color=blue>Нанесли урон рыбке </font><font color=red> <b>".number_format($uron, 0, ',', "`")." HP</b> </font> </p>";


}
}
else
{
$fishno = rand(1,3);
if ($fishno == 1) {$fh45555 = "Рыбка уклонилась...";}
if ($fishno == 2) {$fh45555 = "Рыбка предвидела ваше действие...";}
if ($fishno == 3) {$fh45555 = "Рыбка почти сорвалась...";}
echo "<p> $fh45555 </p>";
}

}

//--------Открываем БД и проверяем ловит игрок рыбу уже или нет-------------//
$req = mysql_query("SELECT * FROM `fish` WHERE `usr` = '$log' LIMIT 1");
$fish = mysql_fetch_array($req);
$avto=mysql_num_rows($req);

if ($avto > 0){ 

$t = $fish[time]-$tim;

echo "<div class=dot>";
echo "Осталось рыбачить: $t сек <br/>";
echo "<b>Рыбка <font color=red>HP</font></b> ".number_format($fish[hp], 0, ',', "`")." / ".number_format($fish[hpall], 0, ',', "`")."";
echo "</div>";

$t44 = rand(1,4);
if ($t44==1){$tt = "Сопротивляется...";}
if ($t44==2){$tt = "Не понятно что делает...";}
if ($t44==3){$tt = "Ничего не делает ...";}
if ($t44==4){$tt = "Уплывает...";}

echo "<div class=dot><font color=grey> $tt </font></div>
<hr/><p>` ` ` <b><u>Тянуть <font color=blue>-$fish[mp]MP</font>:</u></b> ` ` `</p>";


echo "<div class=inoy><a href=\"?ns\">На себя </a>";
echo "<a href=\"?vp\">Вправо </a>";
echo "<a href=\"?vl\">Влево </a></div>";



include($path.'inc/down.php');

}

//--------Открываем БД и проверяем-------------//
$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `ruka`='fish' and `image`='yes'");
$fish = mysql_fetch_array($req);
$avto=mysql_num_rows($req);

// --------удочка одета--------------------//
if ($avto > 0){ 

// -- если ловить тогда ---//
if (isset($_GET[go])){ $fs=rand(1,2);


// -забираем наживку---
$req22 = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `lat_name` = 'lure'");
$res=mysql_num_rows($req22);
$rs = mysql_fetch_array($req22);
if($res==0){
echo "<p><font color=red>У Вас нет наживки...</font></p><hr/>";

echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";
echo "<div class=inoy><a href=\"/fishing.php\">Рыбак</a></div>";

include($path.'inc/down.php');

}else{
$nk=$rs[kol]-1;
mysql_query("UPDATE `res` SET `kol` = '$nk' WHERE `usr` = '$log' and `lat_name` = 'lure'");

if($nk <= 0){ //удаляем
mysql_query("DELETE FROM `res` WHERE `id` = '$rs[id]' LIMIT 1");

}
}





if ($fs == 2){ // один шанс из трёх удачно закинуть наживку

if($udata[lvl]<20){
$hp=1444; $mp=17;}
elseif($udata[lvl]>=20 and $udata[lvl]<40){
$hp=2133; $mp=26;}
elseif($udata[lvl]>=40 and $udata[lvl]<52){
$hp=4511; $mp=41;}
elseif($udata[lvl]>=52 and $udata[lvl]<62){
$hp=6213; $mp=66;}
elseif($udata[lvl]>=62 and $udata[lvl]<76){
$hp=9223; $mp=82;}
elseif($udata[lvl]>=76){
$hp=25000; $mp=99;}

$time=time()+90;

mysql_query("INSERT INTO fish SET usr='$log',time='$time',hp='$hp',mp='$mp',hpall='$hp',lvl='$udata[lvl]'");

echo "<font color=grey> Рыбка клюнула... </font><hr/>";

echo "<div class=inoy><a href=\"?\">Ловить</a></div>";

include($path.'inc/down.php');


}else{

$t45 = rand(1,4);
if ($t45==1){$tt = "Рыбка не клюнула.....";}
if ($t45==2){$tt = "Эх, еще немного...";}
if ($t45==3){$tt = "Рыбка, рыбка...Нет...показалось...";}
if ($t45==4){$tt = "Ботинок попался !";}

echo "<font color=grey> $tt </font><hr/>";

echo "<div class=inoy><a href=\"?go\">Забросить</a></div>";
echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";
include($path.'inc/down.php');

}}
//--------- удочка одета предложение что делать----------//
echo '<p><font color=#336666><b>Рыбалка:</b></font></p><hr/>';

echo "<font color=grey> Вы стоите на берегу большого озера. Здесь можно порыбачить.
В руках уже приготовлена удочка: </font><hr/>";

echo "<div class=inoy><a href=\"?go\">Забросить</a></div>";
echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";
echo "<div class=inoy><a href=\"/fish_r.php\">Разделать</a></div>";
echo "<div class=inoy><a href=\"/fishing.php\">Рыбак</a></div>";

echo "<hr/>";	
}else{

// ------удочка не одета------------------//

echo '<p><font color=#336666><b> Вы стоите на берегу большого озера. Здесь можно порыбачить.
Перед рыбалкой нужно одеть удочку. </b></font></p><hr/>';

echo "<div class=inoy><a href=\"/inventar.php?mod=item&o=weapon\">Искать удочку</a></div>";
echo "<div class=inoy><a href=\"/fishing.php\">Рыбак</a></div>";
echo "<div class=inoy><a href=\"/gorod.php\">В город</a></div>";

}
//----------------------------------------------//


break;

}


include($path.'inc/down.php');
?>