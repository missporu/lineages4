<?


$tm = time(); // time

$req12345 = mysql_query("SELECT * FROM online_time WHERE usr ='$log' LIMIT 1");
$avt12345 = mysql_fetch_array($req12345);
/////////////////////////////////////////////////////////////////////////////
$tmmax = $tm - 1800;
mysql_query("DELETE FROM online_time WHERE tm < '$tmmax'");//удаляем логи 

/*	-	-	-	Создаём таблицу если нет		-	-	-	*/
/* $avto =mysql_fetch_array ($req); */
if(($avt12345)==0) {
mysql_query("INSERT INTO online_time SET usr = '$log', tm = '$tm', sek = '0'");
}
else
{
/*	-	-	-	-	-	-	-	-	-	-	-	-	*/

/*			Считаем результаты 				*/

$req54554654 = mysql_query("SELECT * FROM online_time WHERE usr ='$log' LIMIT 1");
$onl = mysql_fetch_array($req54554654);


$seknew = $tm - $onl[tm]; // +сек онлайна
if ($seknew > 1800){$seknew = 0;} // если афк 1800сек то приравниваем к нолю

$sek = $onl[sek] + $seknew; // резулт

//-------------------------------------
  $req987846565 = mysql_query("SELECT * FROM users WHERE usr = '$log' LIMIT 1");
  $udata = mysql_fetch_array($req987846565);
//-------------------------------------

$udatatime = $udata[time]+$seknew; // секунд всего
$udatatimebon = $udata[time_bon]+$seknew; // секунд бонус

/*										*/

////
//////////
//////////
/* и так результаты щитаються нормально*/
//////////
////////////
///////////////

/*       		Пишем результаты		*/


		mysql_query ("UPDATE online_time SET
         tm = '$tm',
         sek = '$sek'
		 WHERE usr = '$log' LIMIT 1");

		mysql_query ("UPDATE users SET
		 time = '$udatatime',
		 time_bon = '$udatatimebon'
		 WHERE usr = '$log' LIMIT 1");


}
/* записываються тоже нормально*/


// бонус за онлайн

if ($udata[time_bon]>36000)
{
if ($udata[dostup]==0){$col = 25;}
if ($udata[dostup]==1){$col = 30;} 
if ($udata[dostup]==2){$col = 40;}
if ($udata[dostup]==3){$col = 50;}
if ($udata[dostup]>3){$col = 150;}


$alm = $udata[almaz]+$col;
mysql_query ("UPDATE users SET `almaz` = '$alm',`time_bon` = '0' WHERE usr='$log' LIMIT 1");

$time = date("H:i d.m.y");
$text = " <font color=#CD6600>Бонус за онлайн +<b>$col</b> Coin of Luck.</font>";
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = '$log', `time` = '$time', `read` = 1, `mail_msg` = '$text'"); 

}


?>