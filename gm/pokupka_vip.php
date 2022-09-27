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
if($_POST['what']=='vip50'){$vip='VIP 50';}
if($_POST['what']=='vip150'){$vip='VIP 150';}
if($_POST['what']=='vip1000'){$vip='VIP 1000';}
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '".$_POST[nick]."' and `lat_name` = '$vip'");
$res=mysql_num_rows($req); 
$rs = mysql_fetch_array($req);
///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////

if ($udata[dostup] == 5){
//------Выдача акции-------
if(!empty($_GET['nick']))  {$_POST['nick']=$_GET['nick'];}   
    if(empty($_POST['nick'])){   
echo '<form action="pokupka_vip.php?" method="post">';
    echo"Ник:<br/>   
    <input class='input' type=\"text\" size=\"15\" value=\"".$nick."\" name=\"nick\"/><br/>";   
    echo "   
    Что даем:<br/>   
    <select name=\"what\">   
<option value=\"vip50\">Вип карта х50</option>
<option value=\"vip150\">Вип карта х150</option>
<option value=\"vip1000\">Вип карта х1000</option>
    </select><br/>";
echo "<input type=\"submit\" value=\"Изменить\" class=\"ibutton\">";
    }else{  
    $a = mysql_query("SELECT * FROM `users` WHERE `usr` = '".$_POST['nick']."'");
    $b = mysql_num_rows($a);  
if($b>0){  
    $c = mysql_fetch_assoc($a);  
      
if($_POST['what']=='vip50'){
if($res==0){
mysql_query("INSERT INTO
`res` SET 
`usr` = '".$_POST[nick]."',
`name` = 'Вип карта х50', 
`lat_name` = 'VIP 50', 
`tip` = 'vip', 
`what` = 'res', 
`give` = '0', 
`kol` = '1', 
`cena` = '0'");
}else{ 
$nk=$rs[kol]+1; 
mysql_query("UPDATE `res` SET `kol` = '$nk' WHERE `usr` = '".$_POST[nick]."' and `lat_name` = '$vip'");}

        
$time = date("H:i d.m.y");    
$text = "Игрок <b><a href=\'search.php?nick=$log&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам <b><font color=darkorange> Вип карта х50</font></b>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Хранитель карт', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
if($_POST['what']=='vip150'){
if($res==0){
mysql_query("INSERT INTO 
`res` SET 
`usr` = '".$_POST[nick]."', 
`name` = 'Вип карта х150', 
`lat_name` = 'VIP 150', 
`tip` = 'vip', 
`what` = 'res', 
`give` = '0', 
`kol` = '1', 
`cena` = '0'");
}else{  
$nk=$rs[kol]+1;  
mysql_query("UPDATE `res` SET `kol` = '$nk' WHERE `usr` = '".$_POST[nick]."' and `lat_name` = '$vip'");}


         
$time = date("H:i d.m.y");     
$text = "Игрок <b><a href=\'search.php?nick=$log&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам <b><font color=darkorange>Вип карта х150</font></b>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Хранитель карт', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
if($_POST['what']=='vip1000'){
if($res==0){
mysql_query("INSERT INTO 
`res` SET 
`usr` = '".$_POST[nick]."', 
`name` = 'Вип карта х1000', 
`lat_name` = 'VIP 1000', 
`tip` = 'vip', 
`what` = 'res', 
`give` = '0', 
`kol` = '1', 
`cena` = '0'");
}else{  
$nk=$rs[kol]+1;  
mysql_query("UPDATE `res` SET `kol` = '$nk' WHERE `usr` = '".$_POST[nick]."' and `lat_name` = '$vip'");}


$time = date("H:i d.m.y");
$text = "Игрок <b><a href=\'search.php?nick=$log&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам <b><font color=darkorange>Вип карта х1000</font></b>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Хранитель карт', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
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
