<?
define('PROTECTOR', 1);

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
    $path='../';            //
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////

if ($udata[dostup] == 5){
//------Выдача акции-------
    if(!empty($_GET['nick']))  {$_POST['nick']=$_GET['nick'];}  
    if(empty($_POST['nick'])){  
echo '<form action="actions.php?" method="post">';
    echo"Ник:<br/>  
    <input class='input' type=\"text\" size=\"15\" value=\"".$nick."\" name=\"nick\"/><br/>";  
    echo "  
    Что даем:<br/>  
    <select name=\"what\">  
<option value=\"100wmr\">Набор новичка (100 WMR)</option>
<option value=\"300wmr\">Акция (300 WMR)</option>
<option value=\"500wmr\">Акция (500 WMR)</option>
    </select><br/>";  
 
echo "<input type=\"submit\" value=\"Изменить\" class=\"ibutton\">";
    }else{  
    $a = mysql_query("SELECT * FROM `users` WHERE `usr` = '".$_POST['nick']."'");
    $b = mysql_num_rows($a);  
    if($b>0){  
    $c = mysql_fetch_assoc($a);  
      
if($_POST['what']=='100wmr'){
mysql_query("INSERT INTO 
`item` SET 
`usr` = '".$_POST['nick']."',
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
         `nlvl` = '0',
         `image` = 'not'");

mysql_query("INSERT INTO  
         `item` SET  
         `usr` = '".$_POST['nick']."', 
         `tip` = 'body',  
         `ruka` = 'ps',  
         `name` = 'VIP Sealed Dark',  
         `cena` = '964',  
         `patt` = '0',  
         `matt` = '0',  
         `pdef` = '5000',  
         `mdef` = '5000',  
         `soul` = '0',  
         `spirit` = '0',
         `nlvl` = '0',
         `image` = 'not'");

mysql_query("UPDATE `users` SET `almaz` = `almaz` +500, `votecoin` = `votecoin` +300, `hp` = `hp` +1000, `hpall` = `hpall` +1000, `mp` = `mp` +1000, `mpall` = `mpall` +1000, `patt` = `patt` +1000, `matt` = `matt` +1000, `pdef` = `pdef` +1000, `mdef` = `mdef` +1000 WHERE `usr` = '".$_POST['nick']."'");
        
$time = date("H:i d.m.y");    
$text = "Игрок <b><a href=\'search.php?nick=Shiki&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам <font color=darkviolet><b>Набор новичка!</b></font></a><br/><br/>+500 <font color=yellow>Coin of Luck</font><br/>+300 <font color=red>Vote</font><font color=yellow>Coin</font><br/>+1000 <font color=wheat>к каждому параметру</font><br/><br/><center><b><font color=darkorange>Благодарим вас за покупку =)</b></center></font>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Акционер', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
if($_POST['what']=='500wmr'){
mysql_query("INSERT INTO 
         `item` SET 
`usr` = '".$_POST['nick']."',
         `tip` = 'weapon', 
         `ruka` = 'luk', 
         `name` = 'Eaglehorn', 
         `cena` = '79222', 
         `patt` = '510000', 
         `matt` = '220000', 
         `pdef` = '5000', 
         `mdef` = '5000', 
         `soul` = '5', 
         `spirit` = '5', 
         `nlvl` = '111',
         `image` = 'not'");

mysql_query("INSERT INTO 
         `item` SET 
         `usr` = '".$_POST['nick']."', 
         `tip` = 'plash', 
         `ruka` = 'ps', 
         `name` = 'LUX Cloak', 
         `cena` = '100000', 
         `patt` = '0', 
         `matt` = '0', 
         `pdef` = '140000', 
         `mdef` = '50000', 
         `soul` = '0', 
         `spirit` = '0', 
         `nlvl` = '111',
         `image` = 'not'");

mysql_query("UPDATE `users` SET `almaz` = `almaz` +5000, `votecoin` = `votecoin` +2500, `hp` = `hp` +10000, `hpall` = `hpall` +10000, `mp` = `mp` +10000, `mpall` = `mpall` +10000, `patt` = `patt` +10000, `matt` = `matt` +10000, `pdef` = `pdef` +10000, `mdef` = `mdef` +10000 WHERE `usr` = '".$_POST['nick']."'");
         
$time = date("H:i d.m.y");     
$text = "Игрок <b><a href=\'search.php?nick=Shiki&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам <font color=darkviolet><b>Акционный набор!</b></font></a><br/><br/>+5000 <font color=yellow>Coin of Luck</font><br/>+2500 <font color=red>Vote</font><font color=yellow>Coin</font><br/>+10.000 <font color=wheat>к каждому параметру</font><br/><br/><center><b><font color=darkorange>Благодарим вас за покупку =)</b></center></font>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Акционер', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
if($_POST['what']=='300wmr'){
mysql_query("INSERT INTO  
`item` SET  
`usr` = '".$_POST['nick']."', 
         `tip` = 'weapon',  
         `ruka` = 'ydar',  
         `name` = 'Demon Edge',  
         `cena` = '11000',  
         `patt` = '100000',  
         `matt` = '50000',  
         `pdef` = '2000',  
         `mdef` = '1000',  
         `soul` = '1',  
         `spirit` = '1',  
         `nlvl` = '111',
         `image` = 'not'");

mysql_query("UPDATE `users` SET `almaz` = `almaz` +1500, `votecoin` = `votecoin` +1000, `hp` = `hp` +5000, `hpall` = `hpall` +5000, `mp` = `mp` +5000, `mpall` = `mpall` +5000, `patt` = `patt` +5000, `matt` = `matt` +5000, `pdef` = `pdef` +5000, `mdef` = `mdef` +5000 WHERE `usr` = '".$_POST['nick']."'");

$time = date("H:i d.m.y");
$text = "Игрок <b><a href=\'search.php?nick=Shiki&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам <font color=darkviolet><b>Акционный набор!</b></font></a><br/><br/>+1500 <font color=yellow>Coin of Luck</font><br/>+1000 <font color=red>Vote</font><font color=yellow>Coin</font><br/>+5000 <font color=wheat>к каждому параметру</font><br/><br/><center><b><font color=darkorange>Благодарим вас за покупку =)</b></center></font>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Акционер', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
echo'<div class="slot_menu">'.$_POST['what'].'  выдан '.$c['usr'].' !!!</div>';
    }else{  
    echo'<div class="slot_menu">Такого пользователя не существует</div>';}
    }  
//--------------конец------------
}else{
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в выдачу акций $udata[usr]' ");
}
include($path.'inc/down.php');
?>
