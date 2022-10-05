<?php

$headmod = 'main';//фикс. места

$textl='Lineage 2 | Новый мир';

include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

$lim = htmlspecialchars(stripslashes($lim));

$lim=$_GET[lim];


switch($_GET[mod]){

default:


echo "<center><div class=adm><font color=#336666><p> <b>Вы успешно авторизованы! </b></p></font></center><br/>";

//////////
// Выводим прошлые данные входа
if (empty($lim)){$lim=1;} // если лимит не указан то он равен 1
if ($lim>=25){$lim=25;} // больше 25 не выдаст
echo "<font color=#A0A0A0>Показать последние <br/>";

if ($lim == '1'){echo "1 , ";}else{echo "<a href=\"auto.php?lim=1\">1</a> , ";}
if ($lim == '2'){echo "2 , ";}else{echo "<a href=\"auto.php?lim=2\">2</a> , ";}
if ($lim == '3'){echo "3 , ";}else{echo "<a href=\"auto.php?lim=3\">3</a> , ";}
if ($lim == '4'){echo "4 , ";}else{echo "<a href=\"auto.php?lim=4\">4</a> , ";}
if ($lim == '5'){echo "5 `` ";}else{echo "<a href=\"auto.php?lim=5\">5</a> `` ";}

echo " входов.</font>";
$reqvh = mysql_query("SELECT * FROM `vhod` WHERE `usr` = '$log' ORDER BY `id` DESC LIMIT $lim");
$avto=mysql_num_rows($reqvh);
if ($avto>0){
While($vhod = mysql_fetch_array($reqvh))
{
echo "<hr/><font color=#565656><u><b>Данные входа:</b></u><br/>";
echo"<b>Бр.</b> $vhod[brow]<br/>";
echo"<b>IP:</b> $vhod[ip]<br/>";
echo"<b>Дата/время:</b><br/> $vhod[data]<br/></font>";
}
}
else{echo "<br/><b><u>Входов с Вашего акаунта небыло.</b></u><br/><br/>";}
// -------------------------
echo "<hr/>";
echo "<br/>";
echo"<hr/><font color=#3F7F62><b>Ваши данные:</b><br/>";
$browser_name = $_SERVER['HTTP_USER_AGENT'];
echo htmlspecialchars($browser_name);
echo"<br/>";
echo"Ваш IP: ";
$ip=$_SERVER['REMOTE_ADDR'];
echo $ip;
echo "<br/>Дата/время:<br/>";
$times = date("d.m.Y в H:i:s");
echo $times;
echo"";
echo"</font><hr/>";
//--------------------------
echo"<b>Ссылка на автологин</b><br/><br/>
Для входа в игру с автологина скопируйте следущую ссылку:<br/><br/>
<input name=\"enter\" value=\"http://$_SERVER[HTTP_HOST]/avt.php?logi=$log&pass=$udata[ps]\"/><br/><br/>";
echo"<b>Сохраните ссылку, и можете заходить в игру через автологин!</b><br/>";
//--------------------------

        echo"<hr/><div class=inoy><a href=\"index.php?\"><p>Войти</p></a></div></div>";


break;
}
include($path.'inc/downmain.php');
?>
