<?php


//-------------------------------------
  $req654654 = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' and `dostup` >= '4' LIMIT 1"));
	if ($req654654==1){$kol = 3600;}//100 часов админу
 //-------------------------------------

$laikas = 150;
$dabar = time();
$timeout = $dabar - $laikas;

$dabar = $dabar+$kol+1800;//+30 минут онлайна

mysql_query("DELETE FROM online WHERE laikas<$timeout");
$ar_yra = mysql_num_rows(mysql_query("SELECT usr FROM online WHERE usr = '$log' LIMIT 1"));
if ($ar_yra == '0')
{
mysql_query("INSERT INTO online SET usr = '$log', laikas = '$dabar',`lvl`='$udata[lvl]'");
}
elseif($ar_yra > '0')
{
mysql_query("UPDATE online SET laikas = '$dabar',`lvl`='$udata[lvl]' WHERE usr = '$log' LIMIT 1");
}

/*
If ($_GET[newtm]==258){
$minus = 19*60;

$newtm = time()+86400-$minus;
mysql_query("UPDATE `time` SET `eve_mob` = '$newtm'"); //  записуем следущее время запуска


$newtm = time()+86400-$minus;
mysql_query("UPDATE `time` SET `eve_pk` = '$newtm'"); //  записуем следущее время запуска


$newtm = time()+86400-$minus;
mysql_query("UPDATE `time` SET `eve_fish` = '$newtm'"); //  записуем следущее время запуска

echo "$newtm - $minus";
}
*/
?>
