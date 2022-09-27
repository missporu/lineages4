<?php

header("Content-type:text/html; charset=utf-8");
$currHour=date("H",time());///////////   
$currDate=date("d F Y", time());
$curr=date("i:s", time());
$currTime=date("$currHour:i:s", time()); 
$min=date("i", time());
 $sek=date("s", time());
 
$currDate = str_replace("January","Января",$currDate);
$currDate = str_replace("February","Февраля",$currDate);
$currDate = str_replace("March","Марта",$currDate);
$currDate = str_replace("April","Апреля",$currDate);
$currDate = str_replace("May","Мая",$currDate);
$currDate = str_replace("June","Июня",$currDate);
$currDate = str_replace("July","Июля",$currDate);
$currDate = str_replace("August","Августа",$currDate);
$currDate = str_replace("September","Сентября",$currDate);
$currDate = str_replace("October","Октября",$currDate);
$currDate = str_replace("November","Ноября",$currDate);
$currDate = str_replace("December","Декабря",$currDate); 
$dney		= date ("j");
$mes		= date ("n");

$dney= "".$set['mod_new_year_day'].""-$dney-1; //День до которого нужно считать
$mes= "".$set['mod_new_year_mes'].""-$mes;  // Месяц до которого нужно считать
$ch =$currHour+1 ;
	/// В данном случае считается до 8 марта
if ($dney < 0)
{
	$dney = $dney + 31;
	$mes = $mes - 1;
}

if ($mes < 0)
{
	
	$mes = $mes + 12;
}

if ($currHour == "0") $chas = "часa";
if ($currHour == "1") $chas = "часa";
if ($currHour == "2") $chas = "час";
if ($currHour == "3") $chas = "часов";
if ($currHour == "4") $chas = "часов";
if ($currHour == "5") $chas = "часов";
if ($currHour == "6") $chas = "часов";
if ($currHour == "7") $chas = "часов";
if ($currHour == "8") $chas = "часов";
if ($currHour == "9") $chas = "часов";
if ($currHour == "10") $chas = "часов";
if ($currHour == "11") $chas = "часов";
if ($currHour == "12") $chas = "часов";
if ($currHour == "13") $chas = "часов";
if ($currHour == "14") $chas = "часов";
if ($currHour == "15") $chas = "часов";
if ($currHour == "16") $chas = "часов";
if ($currHour == "17") $chas = "часов";
if ($currHour == "18") $chas = "часов";
if ($currHour == "19") $chas = "часа";
if ($currHour == "20") $chas = "часа";
if ($currHour == "21") $chas = "часа";
if ($currHour == "22") $chas = "час";
if ($currHour == "23") $chas = "часов";
if ($currHour == "24") $chas = "часa";
///Здесь не трогать специально под время такие окончания
if ($dney == "0") $days = "дней";
if ($dney == "1") $days = "день";
if ($dney == "2") $days = "дня";
if ($dney == "3") $days = "дня";
if ($dney == "4") $days = "дня";
if ($dney == "5") $days = "дней";
if ($dney == "6") $days = "дней";
if ($dney == "7") $days = "дней";
if ($dney == "8") $days = "дней";
if ($dney == "9") $days = "дней";
if ($dney == "10") $days = "дней";
if ($dney == "11") $days = "дней";
if ($dney == "12") $days = "дней";
if ($dney == "13") $days = "дней";
if ($dney == "14") $days = "дней";
if ($dney == "15") $days = "дней";
if ($dney == "16") $days = "дней";
if ($dney == "17") $days = "дней";
if ($dney == "18") $days = "дней";
if ($dney == "19") $days = "дней";
if ($dney == "20") $days = "дней";
if ($dney == "21") $days = "день";
if ($dney == "22") $days = "дня";
if ($dney == "23") $days = "дня";
if ($dney == "24") $days = "дня";
if ($dney == "25") $days = "дней";
if ($dney == "26") $days = "дней";
if ($dney == "27") $days = "дней";
if ($dney == "28") $days = "дней";
if ($dney == "29") $days = "дней";
if ($dney == "30") $days = "дней";
if ($dney == "31") $days = "день";

if ($mes == "0") $mon = "месяцев";
if ($mes == "1") $mon = "месяц";
if ($mes == "2") $mon = "месяца";
if ($mes == "3") $mon = "месяца";
if ($mes == "4") $mon = "месяца";
if ($mes == "5") $mon = "месяцев";
if ($mes == "6") $mon = "месяцев";
if ($mes == "7") $mon = "месяцев";
if ($mes == "8") $mon = "месяцев";
if ($mes == "9") $mon = "месяцев";
if ($mes == "10") $mon = "месяцев";
if ($mes == "11") $mon = "месяцев";
if ($mes == "12") $mon = "месяцев";


      


echo "<img src='".$home."/pic/ded_snegur2.gif'>До Нового Года осталось ";

echo '<b>';
echo $dney." $days ";
echo 24-$ch." $chas ";
echo 60-$min." мин. и ";
echo 60-$sek." сек. <br/>";
echo '</b>';
echo'<div class="dot"><center><a href="shop_ny.php">НоВоГоДнИй МаГаЗиН</center></a></div>';
?>