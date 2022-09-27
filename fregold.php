<?
    #Создайте колонку biznes_time в базе user
    #Также создайте biznes_dohod
    

define('PROTECTOR', 1);
$textl='Бонус при Покупке';
include('inc/path.php'); 
include($path.'inc/db.php'); 
include($path.'inc/auth.php'); 
include($path.'inc/func.php'); 
include($path.'inc/core.php'); 
include($path.'inc/head.php');
include($path.'inc/zag.php');
if($udata[biznes_lvl]<1){  
$bl=10;}
elseif($udata[biznes_lvl]>=1 and $udata[biznes_lvl]<2){  
$bl=20;}
elseif($udata[biznes_lvl]>=2 and $udata[biznes_lvl]<3){  
$bl=30;}
elseif($udata[biznes_lvl]>=3 and $udata[biznes_lvl]<4){  
$bl=40;}
elseif($udata[biznes_lvl]>=4 and $udata[biznes_lvl]<5){  
$bl=50;}
elseif($udata[biznes_lvl]>=5 and $udata[biznes_lvl]<6){  
$bl=60;}
elseif($udata[biznes_lvl]>=6 and $udata[biznes_lvl]<7){ 
$bl=60;}
elseif($udata[biznes_lvl]>=7 and $udata[biznes_lvl]<8){ 
$bl=70;}
elseif($udata[biznes_lvl]>=8 and $udata[biznes_lvl]<9){ 
$bl=80;}
elseif($udata[biznes_lvl]==9){
$bl=90;}

if($udata[biznes_dohod]<1){$bd =10;}
if($udata[biznes_dohod]==1){$bd =15;}
if($udata[biznes_dohod]==2){$bd =20;}
if($udata[biznes_dohod]==3){$bd =25;}
if($udata[biznes_dohod]==4){$bd =30;}
if($udata[biznes_dohod]==5){$bd =35;}
if($udata[biznes_dohod]==6){$bd =40;}
if($udata[biznes_dohod]==7){$bd =45;}
if($udata[biznes_dohod]==8){$bd =50;}
if($udata[biznes_dohod]==9){$bd =55;}
if($udata[biznes_dohod]==10){$bd =60;}


if($udata['lvl'] < 111) {
echo '<div class="main block">Добыча доступна с 111 уровня!';
include($path.'inc/down.php');
exit();
}
if($_GET['act'] == up) {
if($udata['almaz'] < $bd) {
echo '<div class="main block">Недостаточно Blue Coin!</div>';
}
if($udata['biznes_dohod'] > $bl){
echo'<font color="red"><b>Достигнут максимальный уровень!</b></font><br/><br/><center><a href="fregold.php"><b>Вернуться обратно</b></a></center>';
include($path.'inc/down.php'); 
exit; 
}else{
mysql_query("UPDATE `users` SET `almaz` = `almaz` - '$bl', `biznes_dohod` = `biznes_dohod` + 1, `biznes_lvl` = `biznes_lvl` + 1 WHERE `id` = '".$usr['id']."'");
header ('location: ?');
exit();
}
}

if($_GET['act'] == ce) {
if($udata['biznes_time'] > time()) {
echo '<div class="main block center">Ошибка!</div>';
}else{
mysql_query("UPDATE `users` SET `almaz` = `almaz` + '$bd', `biznes_time` = '".(time() + 7200)."' where `id` = '".$usr['id']."'");
header ('location: ?');
exit();
}
}
if($udata['biznes_time'] < time()){
$udata['biznes_time'] = time() - 60;
}
echo '<img src="pic/rud.jpg" height="130" width="330"><br>';
echo"<b><center><font color='orange'>ваш уровень рудника: [$udata[biznes_lvl]]</font> <img src='pic/up.png' height='16' width='16'></b></center>";
echo '<div class="main block">Твой доход за 2 часа составляет: '.$bd.' <img src="/pic/coin.png" height="16" width="16"><br>';

if($udata['biznes_time'] > time()) {
echo '<div class="dot">Успей забрать свой доход через: <b><font color="violette">'.tl($udata['biznes_time'] - time()).'</b></font></div><br/><center>';
echo"<div style=\"text-align:center;margin:10 auto\"><div class=\"pic\"><a href=\"fregold.php?\"><font color='grey'>Обновить</font></a>";
}else{
echo '<br/><b><center><font color="lime">Забирай</font> <font color="yellow">Coin of Luck</font></b></center><br/>';
}
echo ' </div>';
if($udata['biznes_time'] < time()) {
if($udata['biznes_dohod']<10){
echo '<div class="main menuList"><a href="?act=up">Повысить доход за '.$bl.' <img src="/pic/coin.png" height="16" width="16"></a></li></div>';
}
echo '<div class="mini-line"></div>';
echo '<div class="main menuList"><a href="?act=ce">Забрать '.$bd.' <img src="/pic/coin.png" height="16" width="16"></a></li></div>';
}
include ($path.'inc/down.php');
?>
