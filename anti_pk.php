<?php

$textl='Анти ПК';
///////////////////////
include('inc/path.php');
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////



switch($_GET[mod]){
default:




if (isset($_GET[del]) && $_GET[del]!==yes){ // удаление после подтверждения
echo "<p><font color=green>Вы уверены что хотите удалить Анти-ПК акаунт? CoL не вернуться.</font><br/>
<a href=\"anti_pk.php?del=yes\"><font color=red>Да</font></a> |
<a href=\"anti_pk.php?\"><font color=lime>Нет</font></a>
</p><hr/>";
}


if ($_GET[del]==yes){// удаление после подтверждения
$req222 = mysql_query("SELECT * FROM `anti_pk` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$resvip = mysql_query("DELETE FROM `anti_pk` WHERE `usr` = '$log' LIMIT 1");
					if ($resvip == 'true')
					{
					echo "<p><font color=red>Акаунт аннулирован!</font></p><hr/>";
					}
					}
			}		





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-------------	Оплата акаунта	--------------------//
if (isset($_GET[go])){


$req222 = mysql_query("SELECT * FROM `anti_pk` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
echo'<font color=red><p>У Вас уже есть Анти-ПК Аккаунт!</p></font>';
 echo"<br/><a href=\"anti_pk.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}


// считаем цену

$_POST[dney] = round($_POST[dney]);

if ($_POST[dney]<=0 or is_numeric($_POST[dney])==FALSE){
echo "<p><font color=red><b>Ошибка! Вводите цифры больше ноля !!! </b></font></p>";
echo "<div class=silka><a href=\"anti_pk.php\">Назад</a></div>";
include($path.'inc/down.php');EXIT;
}

$cena = $_POST[dney] * 25; // цена за день 25 колов
$ntm = 60*60*24*$_POST[dney]; // время плюс
		
$nalmaz = $udata[almaz]-$cena;		

if($nalmaz<0){
echo'<font color=red><p>Недостаточно Coin of Luck!</p></font>';
}else{


$times=time()+$ntm;

mysql_query("INSERT INTO
        `anti_pk` SET
        `usr` = '$log',
        `tip` = '$_POST[vip]',
        `time` = '$times'");

mysql_query("UPDATE `users` SET
         `almaz` = '$nalmaz'
          WHERE usr = '$log'");
		
		
//echo'<font color=#FF6A00><b><p>Анти-ПК аккаунт активирован!</p></b></font><hr/>';

}

}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//-------------	Информация -------------	//
echo "<font color=#998313><p> За 25 Coin of Luck в сутки ты можешь прямо сейчас подписаться на Анти-ПК аккаунт 
и тем самым защитить себя от нападений.<hr>
<font color=lime>*Никто из игроков не сможет нападать и Вы тоже (на арене не действует)! </font><hr>
Подписка будет длиться выбранное время и потом закончится, но отменить подписку можно в любой момент (без компенсации Coin of Luck). Согласен?</p></font>";


$req22 = mysql_query("SELECT * FROM `anti_pk` WHERE `usr` = '$log' LIMIT 1");
$avto=mysql_num_rows($req22);
if($avto==1){
$vip = mysql_fetch_array($req22);
$del = "<a href=\"anti_pk.php?del\"><font color=red>[x]</font></a>";
echo'<hr/><p> <font color=#008282> Анти-ПК акаунт активирован!!</b> '.$del.'</p>';
$vip[time]=$vip[time]-time();


												$time_dd = floor($vip[time]/86400); // сколько дней										
												$vip[time] = floor($vip[time]-($time_dd*86400)); // остача дня

												
												
												$time_ch = floor($vip[time]/3600); // сколько часов										
												$vip[time] = floor($vip[time]-($time_ch*3600)); // остача часов
												
												$time_min = floor($vip[time]/60);
												
												$time_sek = floor($vip[time]-($time_min*60));
												
													if ($time_sek<0) {
																	$time_min=$time_min-1;
																	$time_sek = floor($udata[time]-($time_min*60));
																	}
	
											echo "<b>$time_dd</b> дн. <b>$time_ch</b> ч. <b>$time_min</b> мин. <b>$time_sek</b> сек.";




echo "</font><hr/>";
}else{


echo '<hr/><form action="/anti_pk.php?go" method="post">';
echo"<br/><b>На сколько дней:</b><br/>
<font color=grey><small>[min 1]  [25col / 1 день] </small></font><br/>
<input class='input' type=\"text\" size=\"3\" name=\"dney\" maxlength=\"4\"/>";
echo '<input class="button" type="submit" value="Оплатить" /></form>';

}

break;

}

echo "<br/><div class=inoy><a href=\"/col_bonus.php?\">Назад</a></div></div>";

include($path.'inc/down.php');
?>