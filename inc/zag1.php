<?
defined('PROTECTOR') or die('Error: restricted access');

if ($user_id=='1'){
if(empty($header)){
////////////////////////////////////////////////////////
echo'<div class="gameBorder">';
$t=time();

$req = mysql_query("SELECT * FROM `ban` WHERE `usr` = '$log' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);
if ($avto == 1) {
    $ban = mysql_fetch_array($req);
    
    if($ban[ban_time]<$t){
    mysql_query("DELETE FROM `ban` WHERE `usr` = '$log'");
    }else{
    echo"Вы находитесь в бане! Причина: $ban[text]! Осталось: ";
    
$ban[ban_time]=$ban[ban_time]-time();
if($ban[ban_time]<60){
echo "$ban[ban_time] сек.";
}elseif($ban[ban_time]>60 and $ban[ban_time]<3600){
$ban[ban_time]=round($ban[ban_time]/60);
echo "$ban[ban_time] мин.";
}else{
$ban[ban_time]=round($ban[ban_time]/3600);
echo "$ban[ban_time] часов";
}
    include($path.'inc/end.php');exit;
    }
    }

//////////////////////////
/////////////////////
include($path.'inc/lvl.php');
echo'<div class="head">';
echo'<a href="pers.php?"><font color="#e4b214"><b>'.$log.'</b></font></a> 
<img src="pic/up.png"/><b><font color=grey>'.$udata[lvl].'  lvl.</font></b><br/>
<img src="pic/hp.png"/>'.$udata[hp].'
<img src="pic/mp.png"/>'.$udata[mp].'
<img src="pic/main/1/monet.png"/>'.$udata[money].'
<img src="pic/main/1/almaz.png"/>'.$udata[almaz];
//domin();
echo'</div>';
echo'</div>';
if($inpk=='1' and $headmod != 'pk'){
echo'<div class="info" align="center">';
echo"<a href=\"../pk.php?\"><b>В бой</b></a>";
echo'</div>';
}
if($inar=='1' and $headmod != 'combat'){
echo'<div class="info" align="center">';
echo"<a href=\"../combat.php?\"><b>В бой</b></a>";
echo'</div>';
}
$q = mysql_query("SELECT COUNT(*) FROM `msg_r` WHERE `user_to` = '$log' AND `read` = '1';");
$new_mail = mysql_result($q, 0);if($new_mail > 0){
echo'<div class="info" align="center">';
echo"<a href=\"../msg.php?mod=read\"><b>Почта($new_mail)</b></a>";
echo"</div>";}

$req = mysql_query("SELECT * FROM `item_aura` WHERE `usr` = '$log' and `status`='1'");
$avto=mysql_num_rows($req);
if($avto==1){
$aur = mysql_fetch_array($req);

$req = mysql_query("SELECT * FROM `aurs` WHERE `usr`='$log'");
////////////////////////////
$avto=mysql_num_rows($req);
$aro = mysql_fetch_array($req);

echo'<div class="info">';
echo"<b>Аура:</b> $aur[name] ";

$aro[actimer]=$aro[actimer]-time();
if($aro[actimer]<60){
echo "осталось: $aro[actimer] сек.";
}else{
$aro[actimer]=round($aro[actimer]/60);
echo "осталось: $aro[actimer] мин.";
}
echo'</div>';
}
$req = mysql_query("SELECT * FROM `out` WHERE `usr` = '$log'");
$avto=mysql_num_rows($req);
if($avto==1){
////////////////////////////
$aro = mysql_fetch_array($req);

echo'<div class="info">';
echo"<b>Отдых(замок):</b> ";

$aro[timeout]=$aro[timeout]-time();
if($aro[timeout]<60){
echo "осталось: $aro[timeout] сек.";
}else{
$aro[timeout]=round($aro[timeout]/60);
echo "осталось: $aro[timeout] мин.";
}
echo'</div>';
}

$req = mysql_query("SELECT * FROM `clanwar` WHERE `clan` = '$udata[clan]'");
$avto=mysql_num_rows($req);
if($avto==1){
////////////////////////////
$aro = mysql_fetch_array($req);

echo'<div class="info">';
echo"<b>ВНИМАНИЕ НА ВАШ ГОРОД НАПАЛИ!!!</b> ";
echo'</div>';
}
echo'<div class="menu"></b></a>';
///////////////////////////////////////////////////////////////////////////////
}}
else
{
echo "Ошибка!Вы не авторизованы!<a href='index.php'>Авторизуйтесь</a>";include($path.'inc/end.php');exit;
}
?>
