<?
define('PROTECTOR', 1);

$headmod = 'col_bonus';//фикс. места

$textl='NPC магазин';

$path='';

include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
/*
if ($log != 'KraToS'){
echo'Закрыто на доработки! Скоро будет работать.<br/>';
echo"<br/><a href=\"gorod.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}*/

$col=$_GET[col];
$alm=$_POST[alm];

switch($_GET[mod]){

default:
echo "<b><font color=#007F46>Добро пожаловать в NPC Магазин!</font></b><br/><hr>";
echo "<b> У Вас <font color=#FF6A00><u>$udata[almaz]</u> Coin of Luck</font> !</b><br/>";
echo "</div><div class=fon><div class=inoy>";
echo"<a href=\"changenick.php?\"><font color=#007F46>&#187; Смена ника</font></a>";
echo"<a href=\"col_bonus.php?mod=res\"><font color=#007F46>&#187; Ресеты</font></a> у вас $udata[res] ресетов";
echo"<a href=\"shop_vip.php?mod=0\">&#187; V.I.P. Вещи</a>";
echo"<a href=\"shop_gold.php?\">&#187; GOLD Магазин</a>";
echo"<a href=\"col_bonus.php?mod=vip_akk\">&#187; V.I.P. Акаунты</a>";
echo"<a href=\"anti_pk.php\">&#187; Анти-ПК акаунт</a>";
echo"<a href=\"col_bonus.php?mod=color_akk\">&#187; Цветной ник</a>";
echo"<a href=\"col_bonus.php?mod=color_text\">&#187; Цветной текст <font color=darkorange><b>Exclusive</b></font></a>";
echo"<a href=\"obm_fs_ad.php?\">» Обмен Festival Aden на CoL</a>";
echo"<a href=\"col_bonus.php?mod=dop\">&#187; Дополнительные возможности</a>";
echo"<a href=\"col_bonus.php?mod=0\">&#187; Заточка оружия</a>";
echo"<a href=\"vip_scroll.php?mod=0\">&#187; Заточка вещей</a>";
//echo"<a href=\"col_bonus.php?mod=im_sh\">&#187; Именная вещь <span style=color:red;><b>NeW</b></font></a>";
echo '<hr>';
echo"</div>";
echo "<div class=inoy>";

echo"<a href=\"col_bonus.php?mod=4\">&#187; Cбросить очки параметров </a>";

echo "</div></div><div class=menu>";
break;

/*
/////// VIP акаунты /////
case "im_sh";
echo "<p><b><span style=color:#40AE7E;>Именная вещь:</span></b></p><hr/>";
echo "<span style=color:#6FAACF;>
У Вас есть возможность заказать именную вещь. 
Цена данной услуги <b>700 CoL</b> или <b>400 WMR</b> (любой способ). 
При заказе меняеться название вещи и по желанию её изображение.
</span><br/>
<br/>
<span style=color:#B0813B;>
&#187 Для заказа именной вещи нужно писать в <a href=\"/tiket.php?\"><span style=color:grey;>&#187Поддержку&#171</span></a>.<br/>
&#187 В пункте <b>&#187Тема сообщения&#171</b> указать <u><b>Именная вещь</b></u>. <br/>
&#187 В пункте <u><b>Введите сообщение</b></u> указать старое и новое название вещи (адрес новой картинки размером 32 х 32 px). 
Для точности указать её параметры и тип.<hr/> 
<span style=color:#597071;>
<b>Например:</b><br/>
<b>Blade of Serenity</b> Оружие (тут параметры) переименовать на <b>Moe Krutoe Nazvanie</b>
</span><hr/>
&#187 Название не должно превышать 11 символов включая пробел. <br/><br/>

<span style=color:#F52D00;>
&#187 Перед заказом убедитесь что у Вас есть данная сума на счету. <br/>
&#187 Заказуйте именные вещи и проще в случае кражи доказать/найти вашу вещь <br/>
&#187 <b>В А Ж Н О ! </b> Переименовать вещь можно только один раз.<br/><br/>
</span>";

echo "<div class=inoy><a href=\"/tiket.php?\"> --> Оформить заказ </a>";
echo "<a href=\"/col_bonus.php?\"> <-- NPC Магазин </a></div>";
break;

*/
/////// VIP акаунты /////
case "color_text";


if ($_GET[d]==del && $_GET[y]!==yes){// удаление после подтверждения
echo "<p><font color=green>Вы уверены что хотите удалить цветной текст?</font><br/>
<a href=\"col_bonus.php?mod=color_text&d=del&y=yes\"><font color=red>Да</font></a> |
<a href=\"col_bonus.php?mod=color_text\"><font color=grey>Нет</font></a>
</p><hr/>";
}


if ($_GET[d]==del && $_GET[y]==yes){// удаление после подтверждения
$req222 = mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$log."' LIMIT 1"); // защита от нескольких акк
$avto= mysql_num_rows($req222);
if($avto==1){
$resvip = mysql_query("DELETE FROM `color_text` WHERE `usr` = '".$log."' LIMIT 1");
                    if ($resvip == 'true')
                    {
                    echo "<p><font color=red>Цветной текст аннулирован!</font></p><hr/>";
                    }
                    }
            }        






if (!empty($_POST['color'])) // если есть данные то пишем их
{

$req222 = mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$log."' LIMIT 1"); // защита от нескольких акк
$avto= mysql_num_rows($req222);
if($avto==1){echo'<font color=red><p>У Вас уже есть Цветной текст!</p></font>';}else{


        
$nalmaz = $udata[almaz]-2500;

if($nalmaz<0){
echo'<font color=red><p>Недостаточно Coin of Luck!</p></font>';
}else{


$times=time()+2592000;
mysql_query("INSERT INTO
        `color_text` SET
        `usr` = '".$log."',
        `color` = '$_POST[color]',
        `time` = '$times'");

mysql_query("UPDATE `users` SET
         `almaz` = '$nalmaz'
          WHERE usr = '".$log."'");
        
        
echo'<font color=#FF6A00><b><p>Цветной текст активирован!</p></b></font>';

}
}
}

echo "<p><font color=#007F46>Добро пожаловать в мою хижину, Герой! 
У тебя есть возможность выделятся среди других игроков, заказав себе цветной текст за <font color=yellow>Coin of Luck</font>...</font></p>";

$req22 = mysql_query("SELECT * FROM `color_text` WHERE `usr` = '".$log."' LIMIT 1");
$avto= mysql_num_rows($req22);
if($avto==1){
$vip = mysql_fetch_assoc($req22);
$del = "<a href=\"col_bonus.php?mod=color_text&d=del\"><font color=red>[x]</font></a>";
echo "<hr/><p> <font color=#008282>Молодец! <b>Теперь твой текст такого цвета - <font color=$vip[color]>Цвет</font> !</b>$del</p>";
$vip[time]=$vip[time]-time();

if($vip[time]<60)
{
if ($vip[time]<=0){$vip[time]=0;}
echo "Осталось: $vip[time] сек.";}

if ($vip[time]>60 && $vip[time]<86400){$vip[time]=round($vip[time]/3600);
echo "Осталось: $vip[time] мин.";}

if ($vip[time]>=86400){$vip[time]=round($vip[time]/86400);
echo "Осталось: $vip[time] дн.";}
echo "</font><hr/>";
}else{

echo "<form action='?mod=color_text' method=post>
<font color=#C64F00>Введите желаемый цвет текст:</font><br/>
<input class='input' type=\"text\" name=\"color\" maxlength=\"6\"/><br/>
<input type='submit' value='Заказать' name='submit' />";

echo "<hr/>";
echo'<a href="/vote_bon.php?mod=tablcolors">Помощь в выборе цвета</a><br/>';
echo "<font color=#C64F00>* Цветной текст покупаются на срок в 30 дней за 2500 CoL.</font>";
echo "<hr/>";}

echo"<div class=inoy><a href=\"col_bonus.php?\">Назад</a></div>";
break;
case "color_akk";


if ($_GET[d]==del && $_GET[y]!==yes){// удаление после подтверждения
echo "<p><font color=green>Вы уверены что хотите удалить цветной аккаунт?</font><br/>
<a href=\"col_bonus.php?mod=color_akk&d=del&y=yes\"><font color=red>Да</font></a> |
<a href=\"col_bonus.php?mod=color_akk\"><font color=grey>Нет</font></a>
</p><hr/>";
}


if ($_GET[d]==del && $_GET[y]==yes){// удаление после подтверждения
$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$resvip = mysql_query("DELETE FROM `color_akk` WHERE `usr` = '$log' LIMIT 1");
					if ($resvip == 'true')
					{
					echo "<p><font color=red>Цветной аккаунт аннулирован!</font></p><hr/>";
					}
					}
			}		






if (!empty($_POST[vip])) // если есть данные то пишем их
{

$req222 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){echo'<font color=red><p>У Вас уже есть Цветной ник!</p></font>';}else{


		if ($_POST[vip] == 'EE3B3B' or $_POST[vip] == '595E21')	{$cena = 700;}else {$cena = 400;}
		
$nalmaz = $udata[almaz]-$cena;		

if($nalmaz<0){
echo'<font color=red><p>Недостаточно Coin of Luck!</p></font>';
}else{


$times=time()+2592000;
mysql_query("INSERT INTO
        `color_akk` SET
        `usr` = '$log',
        `color` = '$_POST[vip]',
        `time` = '$times'");

mysql_query("UPDATE `users` SET
         `almaz` = '$nalmaz'
          WHERE usr = '$log'");
		
		
echo'<font color=#FF6A00><b><p>Цветной ник активирован!</p></b></font>';

}
}
}

echo "<p><font color=#007F46>Добро пожаловать в мою хижину, Герой! 
У тебя есть возможность выделятся среди других игроков, заказав себе цветной ник за Coin of Luck...</font></p>";

$req22 = mysql_query("SELECT * FROM `color_akk` WHERE `usr` = '$log' LIMIT 1");
$avto=mysql_num_rows($req22);
if($avto==1){
$vip = mysql_fetch_array($req22);
$del = "<a href=\"col_bonus.php?mod=color_akk&d=del\"><font color=red>[x]</font></a>";
echo "<hr/><p> <font color=#008282>Молодец! <b>Теперь твой ник такого цвета - <font color=#$vip[color]>$log</font>!</b>$del</p>";
$vip[time]=$vip[time]-time();

if($vip[time]<60)
{
if ($vip[time]<=0){$vip[time]=0;}
echo "Осталось: $vip[time] сек.";}

if ($vip[time]>60 && $vip[time]<86400){$vip[time]=round($vip[time]/3600);
echo "Осталось: $vip[time] мин.";}

if ($vip[time]>=86400){$vip[time]=round($vip[time]/86400);
echo "Осталось: $vip[time] дн.";}
echo "</font><hr/>";
}else{

echo "<hr/><b><font color=grey>Список доступных цветов: (Ник/код цвета)</font><br/>";
echo "<font color=#A020F0>$log - A020F0</font><br/>";
echo "<font color=#FF006E>$log - FF006E</font><br/>";
echo "<font color=#00FF90>$log - 00FF90</font><br/>";
echo "<font color=#EE3B3B>$log - EE3B3B</font> (VIP цвет)<br/>";
echo "<font color=#595E21>$log - 595E21</font> (VIP цвет)<br/>";

echo '<form action="col_bonus.php?mod=color_akk" method="post">';
echo "<hr/><font color=grey>Цвет / Стоимость:</b></font><br/>
<select name=\"vip\">
<option value=\"A020F0\">A020F0 / 400 CoL</option>
<option value=\"FF006E\">FF006E / 400 CoL </option>
<option value=\"00FF90\">00FF90 / 400 CoL</option>
<option value=\"EE3B3B\">EE3B3B / 700 CoL</option>
<option value=\"595E21\">595E21 / 700 CoL</option>
</select>";
echo '<br/><input class="button" type="submit" value="Заказать" /></form>';

echo "<hr/>";
echo "<font color=#C64F00>* Цветные ники покупаются на срок в 30 дней.</font>";
echo "<hr/>";}

echo"<div class=inoy><a href=\"col_bonus.php?\">Назад</a></div>";
break;






/////// VIP акаунты /////
case "vip_akk";

if ($_GET[d]==del && $_GET[y]!==yes){// удаление после подтверждения
echo "<p><font color=green>Вы уверены что хотите удалить VIP акаунт?</font><br/>
<a href=\"col_bonus.php?mod=vip_akk&d=del&y=yes\"><font color=red>Да</font></a> |
<a href=\"col_bonus.php?mod=vip_akk\"><font color=grey>Нет</font></a>
</p><hr/>";
}


if ($_GET[d]==del && $_GET[y]==yes){// удаление после подтверждения
$req222 = mysql_query("SELECT * FROM `vip` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
$resvip = mysql_query("DELETE FROM `vip` WHERE `usr` = '$log' LIMIT 1");
					if ($resvip == 'true')
					{
					echo "<p><font color=red>VIP акаунт аннулирован!</font></p><hr/>";
					}
					}
			}		

if (!empty($_POST[vip])) // если есть данные то пишем их
{


$req222 = mysql_query("SELECT * FROM `vip` WHERE `usr` = '$log' LIMIT 1"); // защита от нескольких акк
$avto=mysql_num_rows($req222);
if($avto==1){
echo'<font color=red><p>У Вас уже есть VIP Акаунт!</p></font>';
 echo"<br/><a href=\"col_bonus.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}




		if ($_POST[vip] == 2)	{$cena = 30; $yesakk = 'yesgame';}
		if ($_POST[vip] == 5)	{$cena = 60; $yesakk = 'yesgame';}
		if ($_POST[vip] == 10)	{$cena = 100; $yesakk = 'yesgame';}
		
				//мини защита желательно переписать
		if ($yesakk !== 'yesgame'){
echo'<font color=red><p>Ошибка! Вернитесь на главную...</p></font>';
 echo"<br/><a href=\"col_bonus.php?\">Назад</a>";
include($path.'inc/down.php');
exit;
}

		
		
$nalmaz = $udata[almaz]-$cena;		

if($nalmaz<0){
echo'<font color=red><p>Недостаточно Coin of Luck!</p></font>';
}else{


$times=time()+2592000;
mysql_query("INSERT INTO
        `vip` SET
        `usr` = '$log',
        `tip` = '$_POST[vip]',
        `time` = '$times'");

mysql_query("UPDATE `users` SET
         `almaz` = '$nalmaz'
          WHERE usr = '$log'");
		
		
echo'<font color=#FF6A00><b><p>VIP Акаунт активирован!</p></b></font>';

}
}


echo "<p><font color=#007F46>Добро пожаловать в мою хижину, Герой! 
Я много странствовал и в итоге узнал несколько важных вещей, которые помогают получать больше опыта с убитых монстров. Что бы доказать право на знание этого секрета, принеси мне указанное количество Coin of Luck...</font></p>";

$req22 = mysql_query("SELECT * FROM `vip` WHERE `usr` = '$log' LIMIT 1");
$avto=mysql_num_rows($req22);
if($avto==1){
$vip = mysql_fetch_array($req22);
$del = "<a href=\"col_bonus.php?mod=vip_akk&d=del\"><font color=red>[x]</font></a>";
echo'<hr/><p> <font color=#008282> Поздравляю! <b>Твой VIP Акаунт x'.$vip[tip].'!</b> '.$del.'</p>';
$vip[time]=$vip[time]-time();

if($vip[time]<60)
{
if ($vip[time]<=0){$vip[time]=0;}
echo "Осталось: $vip[time] сек.";}

if ($vip[time]>60 && $vip[time]<86400){$vip[time]=round($vip[time]/3600);
echo "Осталось: $vip[time] мин.";}

if ($vip[time]>=86400){$vip[time]=round($vip[time]/86400);
echo "Осталось: $vip[time] дн.";}
echo "</font><hr/>";
}else{

echo '<form action="col_bonus.php?mod=vip_akk" method="post">';
echo "<hr/><font color=grey>Знание / Стоимость:</font><br/>
<select name=\"vip\">
<option value=\"2\">Опыт х2 / 30 CoL</option>
<option value=\"5\">Опыт х5 / 60 CoL</option>
<option value=\"10\">Опыт х10 / 100 CoL </option>
</select>";
echo '<br/><input class="button" type="submit" value="Заказать" /></form>';

echo "<hr/>";
echo "<font color=#C64F00>* VIP Акаунты покупаются на срок в 30 дней.</font>";
echo "<hr/>";}

echo"<div class=inoy><a href=\"col_bonus.php?\">Назад</a></div>";
break;


//////////// заточка оружия ////////////////////////
case '0':
echo "</div></div></div><div class=menu>";
echo"<font color=green><b>Заточка оружия!</b><br/>";
//echo"1 Coin of Luck заточки даёт +2 к P.Att и M.Att или +4 k одному из параметров атаки!<br/>";
echo"<u> У Вас ".number($udata[crystal])." <img src='pic/crystal.png'> </u></font><hr/>";

echo "<form action=\"col_bonus.php?mod=scl_weapon\" method=\"POST\">";

echo " <label><input type='radio' name='result' value='patt' /></label>\n Точить  P.Att +4 (Физ)<hr/>";
echo " <label><input type='radio' name='result' value='matt' /></label>\n Точить  M.Att +4 (Маг)<hr/>";


echo "<div class=menu><b><font color=grey>Введите количество:</font></b><br/>
<input type=\"text\" name=\"alm\" size=\"5\" maxlength=\"9\"/> ";

echo "<input type='submit' name='ok' value='Точить' /><hr/></div>\n";

echo"<br/><a href=\"col_bonus.php?\">Назад</a>";
break;
//***--------------------------------------------------------------------------------------
case 'scl_weapon':
if($alm<='0'){echo'На 0 <img src="pic/crystal.png"> точить нельзя!';echo"<br/><a href=\"col_bonus.php?\">Назад</a>";include($path.'inc/down.php');exit;}
if($udata[crystal]-$alm<0){echo'Недостаточно <img src="pic/crystal.png">';echo"<br/><a href=\"col_bonus.php?\">Назад</a>";include($path.'inc/down.php');exit;}
$almaznew=$udata[crystal]-$alm;

if (empty($_POST[result])){
echo "Вы не выбрали тип заточки!";include($path.'inc/down.php');exit;}


$req = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `tip`='weapon' and `image`='yes' LIMIT 1");
$avto=mysql_num_rows($req);
if($avto=='0'){
echo'<p><b><font color=grey>Точится можно только с одетым оружием!</font></b></p>';
echo"<div class=silka><a href=\"col_bonus.php?\">Назад</a></div>";
include($path.'inc/down.php');
exit;
}



//////////////////////////////////////////////////////////////////////	
if ($_POST[result]=="patt"){ // если точить только физ атаку
$it = mysql_fetch_array($req);
$toch=$alm*4;
$u = explode("|",$mag[give]);
$npatt = $toch + $udata[patt];
$nmatt = $udata[matt];
$w=explode("*",$it[name]);
if(empty($w[1])){
$nam="$w[0]*$alm";
}else{
$kol=$w[1]+$alm;
$nam="$w[0]*$kol";}

$patt = $toch + $it[patt];
$matt = $it[matt];}
///////////////////////////////////////////////////////////////////////////
if ($_POST[result]=="matt"){ // если точить только маг атаку
$it = mysql_fetch_array($req);
$toch=$alm*4;
$u = explode("|",$mag[give]);
$npatt =  $udata[patt];
$nmatt = $toch + $udata[matt];
$w=explode("*",$it[name]);
if(empty($w[1])){
$nam="$w[0]*$alm";
}else{
$kol=$w[1]+$alm;
$nam="$w[0]*$kol";}

$patt = $it[patt];
$matt = $toch + $it[matt];}
/////////////////////////////////////////////////////////////////////////
if($it[ruka]=='rudnik'){echo'Точить кирку нельзя!';include('inc/down.php');exit;}

mysql_query("UPDATE `users` SET 
`patt` = '$npatt',
`crystal` = '$almaznew',
`matt` = '$nmatt'  
WHERE usr = '$log'");
mysql_query("UPDATE `item` SET
      `patt` = '$patt',
      `matt` = '$matt',
`toch` = '$alm',
`name` = '$nam'
       WHERE `usr` = '$log' and `tip`='weapon' and `image`='yes'");
       
$msg="<b>Оружие заточено!</b><br/>Новый урон: P.Att - $patt(+$toch) / M.Att - $matt(+$toch)<br/>";

echo "$msg";
echo"<br/><a href=\"col_bonus.php?\">Назад</a>";
break;




///////////////////////////////////////
case'4';

$req1 = mysql_query("SELECT * FROM `baf` WHERE `usr` = '$log' LIMIT 1");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя cбрасывать параметры под бафом!</br>';
include($path.'inc/down.php');exit;
}
$req1 = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image` = 'yes'");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя cбрасывать параметры с одетыми вещами!</br>';
include($path.'inc/down.php');exit;
}
echo'<b>Сброс параметров</b><br/>';
echo'<b>ПЕРЕД СБРОСОМ ПАРАМЕТРОВ СНИМИТЕ ВСЕ ВЕЩИ</b><br/>';
echo'Стоимость услуги: <b>1`000 <font color="yellow">CoL</font></b><br/>';
echo'<a href="col_bonus.php?mod=4col">Сбросить</a><br/>';
break;

case'4col';

echo'<b>Сброс параметров</b><br/>';
$req1 = mysql_query("SELECT * FROM `baf` WHERE `usr` = '$log' LIMIT 1");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя cбрасывать параметры под бафом!</br>';
include($path.'inc/down.php');exit;
}
if($udata[almaz]<1000){
echo'У Вас недостаточно СоL';
include($path.'inc/down.php');
exit;
}
$req1 = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image` = 'yes'");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя cбрасывать параметры с одетыми вещами!</br>';
include($path.'inc/down.php');exit;
}
if($udata[storona]=="human"){$all=50;}
if($udata[storona]=="gnom"){$all=100;}
if($udata[storona]=="elf"){$all=60;}
if($udata[storona]=="darkelf"){$all=75;}
if($udata[storona]=="ork"){$all=100;}
if($udata[storona]=="kamael"){$all=100;}
if($udata[klas]=="wizard"){
$hplvl=(100*$udata[lvl]);
$mp = 100 + $all + $hplvl; $hp = 100 + $all+$hplvl;
$patt = 23; 
$matt = 56;
$pdef = 63;
$mdef = 52;
}
if($udata[klas]=="fighert"){
$hplvl=100*$udata[lvl];
$mp=80 + $all + $hplvl; $hp=120 + $all + $hplvl;
$patt = 55;
$matt = 21;
$pdef = 68;
$mdef = 49;
}
mysql_query("UPDATE `users` SET `almaz` = `almaz` - '1000' WHERE `usr` = '$log' ");
mysql_query("UPDATE `users` SET `hp`='$hp',`hpall`=$hp,`mp`='$mp',`mpall`='$mp',`patt` = '$patt', `matt` = '$matt', `pdef` = '$pdef', `mdef` = '$mdef' WHERE `usr` = '$log' "); 
$skill = ($udata[lvl]*3)+($udata[res]*603);
mysql_query("UPDATE `users` SET `skill` = '$skill' WHERE `usr` = '$log' ");
echo'Очки параметров успешно сброшены!';
break;

case'res';
echo'<b>Ресет</b><br/>';
if($udata[lvl]<255){
echo'Вы не достигли 255 уровня!';
include($path.'inc/down.php');
exit;
}
$req1 = mysql_query("SELECT * FROM `baf` WHERE `usr` = '$log' LIMIT 1");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя делать ресет под бафом!</br>';
include($path.'inc/down.php');exit;
}
if($udata[almaz]<500){
echo'У Вас недостаточно CoL нужно 500';
include($path.'inc/down.php');
exit;
}
$req1 = mysql_query("SELECT * FROM `item` WHERE `usr` = '$log' and `image` = 'yes'");
$avto1=mysql_num_rows($req1);
if($avto1>0){
echo'Нельзя делать ресет с одетыми вещами!</br>';
include($path.'inc/down.php');exit;
}
if($udata[storona]=="human"){$all=50;}
if($udata[storona]=="gnom"){$all=100;}
if($udata[storona]=="elf"){$all=60;}
if($udata[storona]=="darkelf"){$all=75;}
if($udata[storona]=="ork"){$all=100;}
if($udata[storona]=="kamael"){$all=100;}
if($udata[klas]=="wizard"){
$mp = 100 + $all; $hp = 100 + $all;
}
if($udata[klas]=="fighert"){
$mp=80 + $all ; $hp=120 + $all;
}
//Выдача шмотки
if($udata[pol]=="m"){$titul=Воин;}else{$titul=Воин;}
if ($udata[res]=="0"){
mysql_query("UPDATE `users` SET `titul` = '$titul' WHERE `usr` = '$log' ");
mysql_query("INSERT INTO
`item` SET
`usr` = '$log',
         `tip` = 'weapon',
`ruka` = 'luk',
`name` = 'VIP Dragon Grinder',
         `cena` = '2000',
         `patt` = '20000',
         `matt` = '1000',
         `pdef` = '0',
`mdef` = '0',
         `soul` = '1',
`spirit` = '1',
         `image` = 'not'");
}
if($udata[pol]=="m"){$titul1=Воитель;}else{$titul1=Воительница;}
if($udata[res]=="4"){
mysql_query("UPDATE `users` SET `titul` = '$titul1' WHERE `usr` = '$log' ");
mysql_query("UPDATE `ac_titul` SET `res5` = '$titul1' WHERE `usr` = '$log'");
}
if($udata[pol]=="m"){$titul2=Король;}else{$titul2=Королева;}
if($udata[res]=="9"){
mysql_query("UPDATE `users` SET `titul` = '$titul2' WHERE `usr` = '$log' ");
}
if($udata[pol]=="m"){$titul3=Повелитель;}else{$titul3=Повелительница;}
if($udata[res]=="14"){
mysql_query("UPDATE `users` SET `titul` = '$titul3' WHERE `usr` = '$log' ");
}
//Конец
mysql_query("UPDATE `users` SET `almaz` = `almaz` -500,`res` = `res` + 1 WHERE `usr` = '$log' ");
mysql_query("UPDATE `users` SET `hp`='$hp',`hpall`=$hp,`mp`='$mp',`mpall`='$mp',`exp`='0',`lvl`='0',`skill`='1000' WHERE `usr` = '$log' ");
if($udata[res]==0){
mysql_query("INSERT INTO `ac_titul` SET `usr` = '$log', `res1` = '$titul'");
}
echo'Ресет успешно произведен!';
break;

case 'dop';
echo"<b>Дополнительные услуги</b><br/><br/>";
echo"1) Заказ личного аватара/Фотографии 700 Coin of Luck.<br/>";
echo"2) Смена рассы = 1000 Coin of Luck.<br/>";
echo"3) Смена класса персонажа = 1200 Coin of Luck<br/><br>";

echo"<b>Фотография/аватар должна быть размером не больше чем 128x210</b><br/><br/>";

echo '<font color=#0094FF>Для заказа услуги писать в <b>«Центр Поддержки»</b>. При заказе смены рассы, класса персонажа указывать что и на что менять!<br/><br/>
Для смены аватара также писать в <b>ЦП</b> для получения дальнейших указаний по передачи желаемого аватара\Фотографии.<br/></font>';
//-------------------------
echo"<br/><br/><font color=\"lime\">*Coin of Luck будут списаны с вашего лицевого счета. Поэтому для выполнения заказа, у Вас должна быть необходимая сумма CoL.</font><br/>";
echo"<br/><a href=\"col_bonus.php?\">Назад</a>";

break;
////////////////////////////

}
include($path.'inc/down.php');
?>