<?
define('PROTECTOR', 1); 

$headmod = 'sunduk_s'; 

$textl='Открытие сундуков'; 
include('inc/path.php'); 
include($path.'inc/db.php'); 
include($path.'inc/auth.php'); 
include($path.'inc/func.php'); 
include($path.'inc/core.php'); 
include($path.'inc/head.php'); 
include($path.'inc/zag.php');
$title="Тайник";


/*
if($log!='Shiki'){echo'проходит обновление!';include('inc/down.php');exit;}
*/

$m = mysql_query("SELECT * FROM `a_key` WHERE `usr` = '$log'");
$mif = mysql_fetch_array($m);

///////////////////
$reqev = mysql_query("SELECT * FROM `a_key` WHERE `usr` = '$log'");
$eve = mysql_fetch_array($reqev); 
if($eve=='0'){
mysql_query("INSERT INTO `a_key` SET `usr` = '$log', `mif_ykr` = '0', `mif_golova` = '0', `mif_weapon` = '0', `mif_shit` = '0', `mif_ruki` = '0', `mif_body` = '0', `mif_pants` = '0', `mif_nogi` = '0', `mif_plash` = '0', `mif_amulet` = '0', `mif_poyas` = '0', `mif_rpoyas` = '0', `mif_kolco` = '0', `mif_rkolco` = '0'"); // создаем таблицу юзеру
}
///////////////////

if (isset($_SESSION['msg'])){
echo "<div class='title'><center>$_SESSION[msg]</div></center>";
$_SESSION['msg']=NULL;}


$cenakey=2500;
if(isset($_GET['buyKey'])){
###Цена за ключи

if($user[gold]<$cenakey){
$_SESSION['msg']="Недостаточно WMR! Нужно 25";
header('location:?');
exit();
}
mysql_query("UPDATE `users` SET `key`='".($udata[key]+1)."',`wmr`='".($udata[wmr]-$cenakey)."' WHERE `id`='$usr[id]'");
header('location:?');
}
###1 sunduk
if($_GET['open']==1){
if($udata[key]<1){
$_SESSION['msg']="Купите ключи!";
header('location:?');
exit();
}
$nominal=rand(1,4);
if($nominal==1){
//Сколько выпадет осколков ключа

$sum = rand(1,100);
$name='Осколков';
mysql_query("UPDATE `users` SET `key`='".($udata[key]-1)."',`chkey`='".($udata[chkey]+$sum)."' WHERE `id`='$usr[id]'");


	

}
if($nominal==2){
//Сколько выпадет колов

$sum = rand(100,150);
$img="<img src='pic/coin.png' height='20' width='20'>";
$name="<font color='yellow'>Coin of Luck</font>";
mysql_query("UPDATE `users` SET `key`='".($udata[key]-1)."',`almaz`='".($udata[almaz]+$sum)."' WHERE `id`='$usr[id]'");


	

}

if($nominal==3){
//Сколько выпадет кристалов заточки

$sum = rand(8,80);
$img="<img src='pic/crystal.png' height='20' width='20'>";
$name="Кристалов заточки";
mysql_query("UPDATE `users` SET `key`='".($udata[key]-1)."',`crystal`='".($udata[crystal]+$sum)."' WHERE `id`='$usr[id]'");
}
if($nominal==4){
$sum = rand(1,5);
$name="<font color='whiteblue'>Blue Coin</font>"; 
mysql_query("UPDATE `users` SET `key`='".($udata[key]-1)."',`almaz_blue`='".($udata[almaz_blue]+$sum)."' WHERE `id`='$usr[id]'");
}

$_SESSION['msg']="Открыв сундук вы обнаружили $sum $img $name";
header('location:?');
exit;
}

#ВИП СУНДУК
if($_GET['open']==vip){
if($udata[key]<10){
$_SESSION['msg']="Нужно 10 ключей!";
header('location:?');
exit();
}
$nominal=rand(1,4);
if($mif[mif_weapon]=='0'){
$item = rand(1,100);
if($item==3){
$name_it = '<br/><font color="lightskyblue">Вам выпала мифическая вещь:</font> <font color="red">EXCLUSIVE Bow</font><br/>';
mysql_query("INSERT INTO  
`item` SET  
`usr` = '$log', 
`tip` = 'weapon',  
`ruka` = 'luk',  
`name` = 'EXCLUSIVE Bow',  
`cena` = '200000',  
`patt` = '3500000',  
`matt` = '3500000',  
`pdef` = '0',  
`mdef` = '0',  
`soul` = '50',  
`spirit` = '50',  
`nlvl` = '175', 
`mif` = '1',
`image` = 'not'");

mysql_query("UPDATE `a_key` SET `mif_weapon` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_golova]=='0'){ 
$item = rand(1,100); 
if($item==5){ 
$name_it2 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Helmet</font><br/>'; 
mysql_query("INSERT INTO   
`item` SET   
`usr` = '$log',  
`tip` = 'golova',   
`ruka` = 'ps',   
`name` = 'EXCLUSIVE Helmet',   
`cena` = '200000',   
`patt` = '0',   
`matt` = '0',   
`pdef` = '1200000',   
`mdef` = '1200000',
`soul` = '0',   
`spirit` = '0',   
`nlvl` = '175',  
`mif` = '1', 
`image` = 'not'"); 

mysql_query("UPDATE `a_key` SET `mif_golova` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_shit]=='0'){  
$item = rand(1,100);  
if($item==7){  
$name_it3 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Shield</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'shit',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Shield',
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_shit` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_ruki]=='0'){  
$item = rand(1,100);  
if($item==9){  
$name_it4 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Gloves</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'ruki',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Gloves',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_ruki` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_body]=='0'){  
$item = rand(1,100);  
if($item==11){  
$name_it5 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Armor</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'body',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Armor',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '2000000',    
`mdef` = '2000000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_body` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_pants]=='0'){  
$item = rand(1,100);  
if($item==13){  
$name_it6 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Pants</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'pants',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Pants',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_pants` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_nogi]=='0'){  
$item = rand(1,100);  
if($item==15){  
$name_it7 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Boots</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'nogi',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Boots',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_nogi` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_plash]=='0'){  
$item = rand(1,100);  
if($item==17){  
$name_it8 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Cloak</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'plash',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Cloak',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_plash` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_amulet]=='0'){  
$item = rand(1,100);  
if($item==19){  
$name_it9 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Amulet</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'amulet',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Amulet',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_amulet` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_poyas]=='0'){  
$item = rand(1,100);  
if($item==2){  
$name_it10 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Earring (левая)</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'poyas',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Earring',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_poyas` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_rpoyas]=='0'){  
$item = rand(1,100);  
if($item==5){  
$name_it11 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Earring (правая)</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'rpoyas',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Earring',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_rpoyas` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_kolco]=='0'){  
$item = rand(1,100);  
if($item==8){  
$name_it12 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Ring (левое)</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'kolco',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Ring',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_kolco` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_rkolco]=='0'){  
$item = rand(1,100);  
if($item==6){  
$name_it13 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Ring (правое)</font><br/>';  
mysql_query("INSERT INTO    
`item` SET    
`usr` = '$log',   
`tip` = 'rkolco',    
`ruka` = 'ps',    
`name` = 'EXCLUSIVE Ring',    
`cena` = '200000',    
`patt` = '0',    
`matt` = '0',    
`pdef` = '1200000',    
`mdef` = '1200000',    
`soul` = '0',    
`spirit` = '0',    
`nlvl` = '175',   
`mif` = '1',  
`image` = 'not'");  

mysql_query("UPDATE `a_key` SET `mif_rkolco` = '1' WHERE `usr` = '$log'");
}}


if($mif[mif_ykr]=='0'){   
$item = rand(1,100);   
if($item==14){   
$name_it13 = '<br/><font style="color: lightskyblue">Вам выпала мифическая вещь:</font> <font style="color: red">EXCLUSIVE Decoration</font><br/>';   
mysql_query("INSERT INTO     
`item` SET     
`usr` = '$log',    
`tip` = 'ykr',     
`ruka` = 'ps',     
`name` = 'EXCLUSIVE Decoration',     
`cena` = '200000',     
`patt` = '0',     
`matt` = '0',     
`pdef` = '1200000',     
`mdef` = '1200000',     
`soul` = '0',     
`spirit` = '0',     
`nlvl` = '175',    
`mif` = '1',   
`image` = 'not'");   

mysql_query("UPDATE `a_key` SET `mif_ykr` = '1' WHERE `usr` = '$log'");
}}
if($nominal==1){
//Сколько выпадет осколков ключа
$sum = rand(100,1000);

$name="Осколков";
mysql_query("UPDATE `users` SET `key`='".($udata[key]-10)."',`chkey`='".($udata[chkey]+$sum)."' WHERE `id`='$udata[id]'");
}
if($nominal==2){
//Сколько выпадет колов 

$sum = rand(150,1500); 
$img="<img src='pic/coin.png' height='20' width='20'>"; 
$name="<font color='yellow'>Coin of Luck</font>"; 
mysql_query("UPDATE `users` SET `key`='".($udata[key]-10)."',`almaz`='".($udata[almaz]+$sum)."' WHERE `id`='$usr[id]'");
}
if($nominal==3){
//Сколько выпадет кристалов заточки 

$sum = rand(80,400);
$img="<img src='pic/crystal.png' height='20' width='20'>"; 
$name="Кристалов заточки"; 
mysql_query("UPDATE `users` SET `key`='".($udata[key]-10)."',`crystal`='".($udata[crystal]+$sum)."' WHERE `id`='$usr[id]'");
}

if($nominal==4){ 
$sum = rand(5,15); 
$name="<font color='whiteblue'>Blue Coin</font>";  
mysql_query("UPDATE `users` SET `key`='".($udata[key]-10)."',`almaz_blue`='".($udata[almaz_blue]+$sum)."' WHERE `id`='$usr[id]'"); 
}

$_SESSION['msg']="Открыв сундук вы обнаружили ".number($sum)." $img $name $name_it $name_it2 $name_it3 $name_it4 $name_it5 $name_it6 $name_it7 $name_it8 $name_it9 $name_it10 $name_it11 $name_it12 $name_it13 $name_it14";
header('location:?');
exit;
}




 echo '<div class="block">'; 
echo "

<div class='content'><center><img src='/pic/stashroom.png'/ height='120' width='290'><br/>
У вас: ".number($udata[key])."<img src='/pic/key.png'/> ключей.<br/>";
echo '
<a class="btn2" href="?buyKey">Купить ключ за 25 WMR';
echo '
</a>
</center></div>';
echo "<div class='line'></div>";
echo "<div class='content'><center><font color='#FFFAFA'><center>Выберите сундук</font></center></div>";
echo '
<div class="content"><center>
<a href="?open=1"><img src="/pic/0.png" alt="[-o-]"></a>
<a href="?open=1"><img src="/pic/0.png" alt="[-o-]"></a>
<a href="?open=1"><img src="/pic/0.png" alt="[-o-]"></a>
<a href="?open=1"><img src="/pic/0.png" alt="[-o-]"></a>
<br></center></div><div class"line"></div></br>
<div class="content"><center>
<center><font color="gold">Vip сундук</font></center>
<a href="?open=vip"><img src="/pic/0.png" alt="[-o-]"></a>
<br></center></div><div class"line"></div>
';

echo'<br/><a href="?info">Инфо</a></br><br/>';

echo '<div class"line"></div>

<div class="content"/>
  

   


<font color="orange">В сундуках можно найти следующее: LUX Шмот, CoL, Кристаллы заточки, Серебро, Осколки, Blue Coin в разных количествах! В VIP сундуке награда увеличена<br/>P.S Мифические вещи выпадают только в VIP сундуке! </font>';

if(isset($_GET['info'])){
if($eve[mif_weapon]=='1'){$m_w = '<font color="lime">Получено</font>';}elseif($eve[mif_weapon]=='0'){$m_w = '<font color="red">Неполучено</font>';}
if($eve[mif_ykr]=='1'){$m_y = '<font color="lime">Получено</font>';}elseif($eve[mif_ykr]=='0'){$m_y = '<font color="red">Неполучено</font>';}
if($eve[mif_golova]=='1'){$m_g = '<font color="lime">Получено</font>';}elseif($eve[mif_golova]=='0'){$m_g = '<font color="red">Неполучено</font>';}
if($eve[mif_shit]=='1'){$m_s = '<font color="lime">Получено</font>';}elseif($eve[mif_shit]=='0'){$m_s = '<font color="red">Неполучено</font>';}
if($eve[mif_ruki]=='1'){$m_r = '<font color="lime">Получено</font>';}elseif($eve[mif_ruki]=='0'){$m_r = '<font color="red">Неполучено</font>';}
if($eve[mif_body]=='1'){$m_b = '<font color="lime">Получено</font>';}elseif($eve[mif_body]=='0'){$m_b = '<font color="red">Неполучено</font>';}
if($eve[mif_pants]=='1'){$m_p = '<font color="lime">Получено</font>';}elseif($eve[mif_pants]=='0'){$m_p = '<font color="red">Неполучено</font>';}
if($eve[mif_nogi]=='1'){$m_n = '<font color="lime">Получено</font>';}elseif($eve[mif_nogi]=='0'){$m_n = '<font color="red">Неполучено</font>';}
if($eve[mif_plash]=='1'){$m_pl = '<font color="lime">Получено</font>';}elseif($eve[mif_plash]=='0'){$m_pl = '<font color="red">Неполучено</font>';}
if($eve[mif_amulet]=='1'){$m_a = '<font color="lime">Получено</font>';}elseif($eve[mif_amulet]=='0'){$m_a = '<font color="red">Неполучено</font>';}
if($eve[mif_poyas]=='1'){$m_po = '<font color="lime">Получено</font>';}elseif($eve[mif_poyas]=='0'){$m_po = '<font color="red">Неполучено</font>';}
if($eve[mif_rpoyas]=='1'){$m_rp = '<font color="lime">Получено</font>';}elseif($eve[mif_rpoyas]=='0'){$m_rp = '<font color="red">Неполучено</font>';}
if($eve[mif_kolco]=='1'){$m_ko = '<font color="lime">Получено</font>';}elseif($eve[mif_kolco]=='0'){$m_ko = '<font color="red">Неполучено</font>';}
if($eve[mif_rkolco]=='1'){$m_rk = '<font color="lime">Получено</font>';}elseif($eve[mif_rkolco]=='0'){$m_rk = '<font color="red">Неполучено</font>';}
echo"<br/><br/>
<hr><font color='gold'>Мифическое Украшение</font>: ($m_y)<br/>
<font color='gold'>Мифическое Оружие</font>: ($m_w)<br/>
<font color='gold'>Мифический Шлем</font>: ($m_g)<br/>
<font color='gold'>Мифический Щит</font>: ($m_s)<br/>
<font color='gold'>Мифические Перчатки</font>: ($m_r)<br/>
<font color='gold'>Мифический Доспех</font>: ($m_b)<br/>
<font color='gold'>Мифические Поножжи</font>: ($m_p)<br/>
<font color='gold'>Мифические Сапоги</font>: ($m_n)<br/>
<font color='gold'>Мифический Плащ</font>: ($m_pl)<br/>
<font color='gold'>Мифический Амулет</font>: ($m_a)<br/>
<font color='gold'>Мифическая Серьга(левая)</font>: ($m_po)<br/>
<font color='gold'>Мифическая Серьга(правая)</font>: ($m_rp)<br/>
<font color='gold'>Мифическое Кольцо(левое)</font>: ($m_ko)<br/>
<font color='gold'>Мифическое Кольцо(правое)</font>: ($m_rk)<hr>
";
echo'<br/><a href="prem_key.php">Скрыть</a>';include('inc/down.php');exit;}


echo '
</div>';



echo "</div>";

include('inc/down.php');
?>

