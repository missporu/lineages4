<?
define('PROTECTOR', 1); 
$head = 'podarok';//фикс. места 
$textl='новогодний подарок';
include($path.'inc/db.php');  
include($path.'inc/auth.php');  
include($path.'inc/func.php');  
include($path.'inc/core.php');  
include($path.'inc/head.php');  
include($path.'inc/regfunc.php');  
include($path.'inc/zag.php');
if($log!='Shiki'){echo'Error';include('inc/down.php');exit;}
echo'<center><img src="pic/new_year.gif" width="300"></center>';
$stage = mysql_fetch_assoc(mysql_query("SELECT * FROM `account` WHERE `id` = ".$udata['account']." order by `stage_p_ny` desc limit 1"));
$stage = ($stage['stage_p_ny']);
echo "<table class='post'>";
if(isset($_GET['take'])){
if ($stage<1) {
echo "<div class='block_light'><hr><center><b><font color=aqua>Поздравляем вы получили  Новогодний подарок </font><br/><b>вы получили украшение <font color=yellow>New Year 2019</font></b><br/><b>вы получили оружие <font color=darkorange>Lineages 2019</font></b><br/><b>вы получили плащ <font color=darkorange>Cloack 2019</font></b><br/><b>вы получили <font color=gold>VIP карта х500</font></b><br/><font color=lime>С новым годом :)</font><hr></center></div>";

echo'<br/><a href="good.php">В город</a>';
mysql_query("INSERT INTO  
`res` SET  
`usr` = '$log',
`name` = 'Вип карта х500',  
`lat_name` = 'VIP 500',  
`tip` = 'vip',  
`what` = 'res',  
`give` = '0',  
`kol` = '1',  
`cena` = '0'");

mysql_query("INSERT INTO
`item` SET  
`usr` = '$log',  
`tip` = 'weapon',
`ruka` = 'me4',
`name` = 'Lineages 2019',
`cena` = '2000',  
`patt` = '7000',
`matt` = '7000',
`soul` = '5',
`spirit` = '5',
`image` = 'not'");

mysql_query("INSERT INTO
`item` SET 
`usr` = '$log', 
`tip` = 'ykr',
`ruka` = '', 
`name` = 'New Year 2019',
`cena` = '2000', 
`pdef` = '7000',
`mdef` = '7000',
`soul` = '0',
`spirit` = '0',
`image` = 'not'");

mysql_query("INSERT INTO 
`item` SET  
`usr` = '$log',  
`tip` = 'plash', 
`ruka` = 'ps',  
`name` = 'Cloak 2019', 
`cena` = '2000',  
`pdef` = '7000', 
`mdef` = '7000', 
`soul` = '0', 
`spirit` = '0', 
`image` = 'not'");
mysql_query("UPDATE `account` SET `stage_p_ny` = `stage_p_ny` + '1' WHERE `id` = ".$udata['account']."");
}
include('inc/down.php');exit;}
if($stage==0){
echo"<br><center><b>Вы можете забрать подарок только один раз!</b><br><b><font color=red>подарок содержит</b></font>:<br/><font color=lightskyblue><b>Новогоднее Украшение<br/>Новогоднее Оружие<br/>Новогодний плащ</b></font><br><b><font color=gold>VIP карта x500</font></b><br/><font color=lime>Приятной игры</font></span></b><br /><form action='podarok_ny.php?take' method='post'><br/>
<center><span class='btn'><span class='end'><input class='label' type='submit' name='take' value='Забрать'/>
</form></center>";
}
if($stage==1){
echo "<center><b><font color=red>Вы уже получили свой подарок</font>! <br/><font color=lightskyblue>С  2019 годом</font></b></centet><br><br><a href=\"gorod.php?\"><b>В город</b></a><br/>";}
echo "</table>";
include('inc/down.php');
?>
