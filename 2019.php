<?php
define('PROTECTOR', 1); 
  
$textl='Бонус при Покупке'; 
include('inc/path.php'); 
include($path.'inc/db.php'); 
include($path.'inc/auth.php'); 
include($path.'inc/func.php'); 
include($path.'inc/core.php'); 
include($path.'inc/head.php'); 
include($path.'inc/regfunc.php'); 
include($path.'inc/zag.php');
if($udata[dostup]<4){echo'Открытие локаци 1 Декабря =)<br/>';echo"<br/><a href=\"gorod.php?\">Назад</a>";include($path.'inc/down.php');exit;}
if(isset($_GET['poluchit'])){ 
if($udata['ig']>=300){
mysql_query("UPDATE `users` SET `ig` = `ig` -'300' WHERE `usr`='$log'");
$col_rand=rand(1,34);
$col_new =$udata[almaz]+$col_rand; 
$vote_rand=rand(1,17);
$vote_new = $udata[votecoin]+$vote_rand;
echo "<div class=dot><div class='block_light'><hr><center><b><font color=aqua>Поздравляем вы получили подарок от снеговика  </font> <br/><br/><font color=lightskyblue>Подарок за помощь</font>: $col_rand <font color=yellow>Coin of Luck</font><br/><font color=lightskyblue>Подарок за помощь</font>: $vote_rand <font color=red>Vote</font><font color=yellow>Coin</font><br/><br/><font color=lightskyblue><img src='pic/snoww.png'>Happy New Year<img src='pic/snoww.png'></font></hr></center></div></div></b><br/>";
mysql_query("UPDATE `users` SET `almaz` = '$col_new', `votecoin` = '$vote_new' WHERE `id` = '".$usr['id']."'");
}else{ 
$_SESSION['err'] ='У вас не достаточно Иголок';
} 
} 
echo'<div class="menu"><font color=lightskyblue>
<center><img src="pic/ultral.jpg"></center>
<center> Вот уже почти 2019 год...
</center> 
<center>Снеговик не мог обойти и нас, храбрых воинов.
</center> 
<center>Для каждого уже лежит подарок. Каждый не мало сделал в этом году.
</center> 
<center>Но отпустить мы его не можем! 
</center> 
<center>У Снеговика случилась беда, и он решил обратится за помощью к нам!
</center> 
<center>Какой же храбрый воин откажет в помощи? 
Подарок просто так не получает никто, сперва нужно сделать доброе дело!
</center> 
<center>Подлые демоны украли иголки для ёлки!
</center> 
<center>Верни мне 300 иголок и я щедро отблагодарю тебя!</font></center></div>
' 
; 
echo "<div class='player center blue'>У вас иголок: ".number_format($udata[ig], 0, ',', " ")."</div>";

echo "</div><div class='mini-line'></div>"; 
echo "<div class='player menuList'>"; 
echo "<br/><div class=dot><a href='?poluchit'><img src='pic/snowman.png'>Дать снеговику иголки</a></div><br/><br/>";
echo "</div>"; 

  

include($path.'inc/foot_text.php'); 
include($path.'inc/end.php');
?>