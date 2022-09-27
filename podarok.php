<?

define('PROTECTOR', 1);
$textl='Ежедневный Бонус';
include('inc/path.php'); 
include($path.'inc/db.php'); 
include($path.'inc/auth.php'); 
include($path.'inc/func.php'); 
include($path.'inc/core.php'); 
include($path.'inc/head.php'); 
include($path.'inc/regfunc.php'); 
include($path.'inc/zag.php');
mysql_query("DELETE FROM `paty` WHERE `usr` = '$log' or `usr2` = '$log'");
$gift = mysql_fetch_assoc(mysql_query("SELECT * FROM `user_podarok` WHERE `user_id` = ".$usr['id']." order by `last_auth` desc limit 1"));

$time = ($gift['last_auth']);
$now = $now = strtotime('next day 00:00'); 
echo "<table class='post'>";

if(isset($_GET['take'])){
if ($time < $now) {

$col_rand=rand(1,25);
$col_new =$udata[almaz]+$col_rand;
$aden_rand=rand(1000000,10000000);
$aden_new = $udata[money]+$aden_rand;
$vote_rand=rand(1,20);
$vote_new = $udata[votecoin]+$vote_rand;
echo "<div class='block_light'><hr><center><b><font color=aqua>Поздравляем вы получили подарок </font> <br/><br/><font color=red>Выпало</font>: $col_rand <font color=yellow>Coin of Luck</font><br/><font color=red>Выпало</font>: $vote_rand <font color=red>Vote</font><font color=yellow>Coin</font><br/><font color=red>Выпало</font>: ".number_format($aden_rand, 0, ',', " ")." <font color=orange>Адены</font><br/><br/><font color=lime>Приятной игры!</font><hr></center></div>";
echo'<br/><a href="good.php">В город</a>';
mysql_query("UPDATE `users` SET `almaz` = '$col_new', `votecoin` = '$vote_new', `money` = '$aden_new' WHERE `id` = '".$usr['id']."'");
if(mysql_result(mysql_query("SELECT count(user_id) from `user_podarok` where `user_id` = '".$usr['id']."'"),0) == 0){
mysql_query("INSERT INTO `user_podarok` SET `last_auth` = '$now', `stage` = '1', `user_id` = ".$usr['id']."");
}else{
mysql_query("UPDATE `user_podarok` SET `last_auth` = '$now', `stage` = `stage` + '1' WHERE `user_id` = ".$usr['id']."");
}
}
include('inc/down.php');exit;}



if ($time < time()) {
echo "<center><b><br>Вы можете забрать подарок только один раз в день!<br><br> Подарок содержит<br><font color=yellow>Coin of Luck</font>: 1 -25<img width='16' height='16' src='inc/coin.png' alt='o'> <br><font color=red>Vote</font><font color=yellow>Coin</font></font>: 1-20<img width='16' height='16' src='pic/adena.png' alt='o'><br> <font color=orange>Адены</font>: 1.000.000 - 10.000.000 <img width='16' height='16' src='inc/coin.png' alt='o'><br><br><font color=red>Напоминаем еще раз, подарок можно забрать только один раз в день!</font><br><span class='green'><font color=lime>Приятной игры</font></span></b><br />
<form action='podarok.php?take' method='post'><br/>
<center><span class='btn'><span class='end'><input class='label' type='submit' name='take' value='Забрать'/>
</form></center>";
} else {
echo "<center><b>Вы уже получали сегодня свой подарок!</br>Приходите через: <font color=violette>".tl($time - time())."</font></centet><br><br><a href=podarok.php>обновить</a><br/></b>";
}
echo "</table>";
include('inc/down.php');
?>