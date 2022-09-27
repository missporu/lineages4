<?
define('PROTECTOR', 1);

//------------ЧАСТЫЕ КЛИКИ ИНТЕРВАЛ ДЕЛАЕМ--------------------------



if ($log!=='KraToS'){

$time1 = time(); 


$reqint = mysql_query("SELECT * FROM `interval` WHERE `usr` = '$log'");

if(mysql_num_rows($reqint)>=1) // если уже есть таблица
{

$int = mysql_fetch_array($reqint);
$time2 = $int[time]+0;




if ($time1 < $time2){

//header ('Location: ?'); 


echo "<p><font color=red><center><b>Не так быстро! <br/> Интервал  1 сек. при открытии страницы!</b></font></p>";

echo"<div class = inoy><br/><a href=\"?\">Продолжить</a></center></div></center>";

include($path.'inc/end.php');exit;


}

mysql_query("UPDATE `interval` SET time='$time1' WHERE usr='$log'");} /*new time*/ else{//создаём таблицу
mysql_query("INSERT INTO `interval` SET usr='$log',id='$udata[id]',time='$time1'"); // создаем таблицу юзеру
}



}


//-----------------------------------------------------------------------------------------


?>