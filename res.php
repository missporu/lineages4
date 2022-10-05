<?php

$headmod = 'res';//фикс. места

$textl='Воскрешение';

include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


$reqin = mysql_query("SELECT * FROM `smert` WHERE `usr`='$log' and `life`='no'");		 //
$magia = mysql_num_rows($reqin);
$magia = mysql_fetch_array($reqin);
if ($magia!=0)  {}else
{
echo " <p><b>Вы живы !</p></b><hr/>";
include($path.'inc/down.php');
exit;}
 // нет значения											 //
																						 //



switch($_GET[mod]){

default:

echo'<div class="menu">';

echo " <center><img src='../img/roz/res.jpg'  width='300' height='130' alt='' style='margin-right:10px;border:1px solid #383838' class='dot'></div><hr/>";
echo"<b> Выберите способ воскрешения.<br/></b>";

$exp = $udata[exp]*0.005;
$exp2 = $udata[exp]*0.002;

if ($udata[lvl]<=9)	{echo"<br/><a href=\"res.php?mod=11\">Воскреснуть </a> <br/> До 9 уровня Вас воскрешают без потери опыта.";}else{
	echo"<br/><a href=\"res.php?mod=1\">Воскреснуть самому. Утеря ".number_format($exp, 0, ',', ' ')." EXP </a>";
	echo"<br/><a href=\"res.php?mod=2\">Заплатить целителю 200`000 Аден.  Утеря ".number_format($exp2, 0, ',', ' ')." EXP </a>";}

	
	
echo "</div>";



include($path.'inc/down.php');
exit;

echo "</div>";
break;
////////////////////////////////////////////////////////////
///////////			СПОсОбЫ ВоскРешеНия		///////////////
case '11';
if ($udata[lvl]>=10) {echo"Ошибка! <br/><a href=\"res.php?\">Назад.</a>";}

$exp = $udata[exp];
$hp = $udata[hpall]/2;

$res = mysql_query ("UPDATE users SET
        exp='$exp',
        hp='$hp'
		 WHERE usr='$log' LIMIT 1");

$req = mysql_query("SELECT * FROM `smert` WHERE `usr`='$log' and `life`='no'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}

mysql_query("DELETE FROM `smert` WHERE `usr`='$log' and `life`='no'");

					if ($res == 'true')
					{
					echo "Вы были воскрещены! Потеряно <b>0</b> опыта ";
					}				
					else
					{
					echo " Неудача. Вернитесь и повторите запрос. После 5 неудачных попыток обратесь к Администрации.";  // неудачно =)
					}
break;


case '1';
$exp = $udata[exp]*0.005;
$exp1 = $udata[exp]-$exp;
$hp = $udata[hpall]/2;

$res = mysql_query ("UPDATE users SET
        exp='$exp1',
        hp='$hp'
		 WHERE usr='$log' LIMIT 1");

$req = mysql_query("SELECT * FROM `smert` WHERE `usr`='$log' and `life`='no'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}

mysql_query("DELETE FROM `smert` WHERE `usr`='$log' and `life`='no'");

					if ($res == 'true')
					{
					echo "Вы были воскрещены! Потеряно ".number_format($exp, 0, ',', ' ')." опыта ";
					}				
					else
					{
					echo " Неудача. Вернитесь и повторите запрос. После 5 неудачных попыток обратесь к Администрации.";  // неудачно =)
					}
break;


case '2';
if ($udata[money]<200000) 
	{
	echo"Недостаточно денег!";
	echo"<br/><br/><a href=\"res.php?\">Назад</a>";
	include($path.'inc/down.php');exit;
	}
$exp = $udata[exp]*0.002;
$exp1 = $udata[exp]-$exp;
$hp = $udata[hpall]/2;
$money = $udata[money]-200000;

$res = mysql_query ("UPDATE users SET
        exp='$exp1',
        hp='$hp',
        money='$money'
		 WHERE usr='$log' LIMIT 1");

$req = mysql_query("SELECT * FROM `smert` WHERE `usr`='$log' and `life`='no'");
$avto=mysql_num_rows($req);
if($avto==0){echo"Ошибка!";include($path.'inc/down.php');exit;}

mysql_query("DELETE FROM `smert` WHERE `usr`='$log' and `life`='no'");

					if ($res == 'true')
					{
					echo "Вы были воскрещены! Потеряно ".number_format($exp, 0, ',', ' ')." опыта ";
					}				
					else
					{
					echo " Неудача. Вернитесь и повторите запрос. После 5 неудачных попыток обратесь к Администрации.";  // неудачно =)
					}
break;




}
include($path.'inc/down.php');
?>
