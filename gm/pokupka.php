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
echo '<form action="pokupka.php?" method="post">';
    echo"Ник:<br/>   
    <input class='input' type=\"text\" size=\"15\" value=\"".$nick."\" name=\"nick\"/><br/>";   
    echo "   
    Что даем:<br/>   
    <select name=\"what\">   
<option value=\"leg_wolf\">Дикий оборотень</option>
<option value=\"leg_pig\">Мировой вепрь</option>
    </select><br/>";
echo "<input type=\"submit\" value=\"Изменить\" class=\"ibutton\">";
    }else{  
    $a = mysql_query("SELECT * FROM `users` WHERE `usr` = '".$_POST['nick']."'");
    $b = mysql_num_rows($a);  
if($b>0){  
    $c = mysql_fetch_assoc($a);  
      
if($_POST['what']=='leg_wolf'){
mysql_query("INSERT INTO 
`pit` SET 
`usr` = '".$_POST[nick]."',
`name` = 'Дикий оборотень', 
`lord` = '".$_POST[nick]."',
`status` = 'off', 
`rasa` = 'obor', 
`pol` = 'm', 
`lasteda` = '$time', 
`sec` = '86400',  
`lvl` = '0', 
`skill` = '2', 
`hp` = '10000000', 
`hpall` = '10000000', 
`exp` = '0', 
`sila` = '5000000', 
`prot` = '5000000'");

        
$time = date("H:i d.m.y");    
$text = "Игрок <b><a href=\'search.php?nick=Shiki&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам питомца <b><font color=red>Дикий оборотень</font></b>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Акционер', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
if($_POST['what']=='leg_pig'){
mysql_query("INSERT INTO 
`pit` SET 
`usr` = '".$_POST[nick]."',
`name` = 'Мировой вепрь', 
`lord` = '".$_POST[nick]."',
`status` = 'off', 
`rasa` = 'pig', 
`pol` = 'm', 
`lasteda` = '$time', 
`sec` = '86400',  
`lvl` = '0', 
`skill` = '2', 
`hp` = '25000000', 
`hpall` = '25000000', 
`exp` = '0', 
`sila` = '15000000', 
`prot` = '15000000'");


         
$time = date("H:i d.m.y");     
$text = "Игрок <b><a href=\'search.php?nick=Shiki&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам питомца <b><font color=red>Мировой вепрь</font></b>";

mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Акционер', `user_to` = '".$_POST['nick']."', `time` = '$time', `read` = 1, `mail_msg` = '$text'");
}
if($_POST['what']=='300wmr'){


$time = date("H:i d.m.y");
$text = "Игрок <b><a href=\'search.php?nick=Shiki&amp;go=go\'><font color=lime>$log</font></a></b> выдал вам";

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
