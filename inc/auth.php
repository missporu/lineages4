<?
defined('PROTECTOR') or die('Error: restricted access');



$user_id = 0; //гость
if (isset ($_SESSION['nick']) && isset ($_SESSION['password'])) {
    $udata1['usr'] = $_SESSION['nick'];
    $pas = $_SESSION['password'];
} 
// //////////////////////////////////////////////////////////
// јвторизаци¤ по COOKIE                                   //
// //////////////////////////////////////////////////////////
 elseif (isset ($_COOKIE['nick']) && isset ($_COOKIE['password'])) {
    $udata1['usr'] = $_COOKIE['nick'];
    $_SESSION['nick'] = $udata1['usr'];
    $pas = $_COOKIE['password'];
    $_SESSION['password'] = $pas;
} 
$req = mysql_query("SELECT * FROM `account` WHERE `nick` = '".mysql_real_escape_string($udata1['usr'])."' and `pass`='".mysql_real_escape_string($pas)."' LIMIT 1");
// //////////////////////////
$avto = mysql_num_rows($req);

if ($avto == 1) {

$account  = mysql_fetch_assoc(mysql_query("SELECT * FROM `account` WHERE `nick` = '".mysql_real_escape_string($udata1['usr'])."' LIMIT 1"));
    $user_id = 1; //авторизованый
    $auth = 1;
    $uid = $account['id']; //ID акаунта
    $active = $account['active']; //јктивный персонаж аккаунта а точнее его ID
    
    
    if($active){ //≈сли выбран персонаж то загружаем его данные
    $udata = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$active'"));
    
    $in_battle = mysql_num_rows(mysql_query("SELECT * FROM tmp WHERE usr = '$log' LIMIT 1"));
	
	$_SESSION['log'] = $udata['usr'];
    $_SESSION['klas'] = $udata['klas'];
    $_SESSION['storona'] = $udata['storona'];
    $log = $udata['usr'];

   
    include($path.'inc/online.php');
    include($path.'inc/regeneration.php');

    // ///////////последний визит
    $dater = date("d F, Y", time());
    $time = date("H:i:s", time());
    $dater = str_replace("January", "января", $dater);
    $dater = str_replace("February", "февраля", $dater);
    $dater = str_replace("March", "марта", $dater);
    $dater = str_replace("April", "апреля", $dater);
    $dater = str_replace("May", "мая", $dater);
    $dater = str_replace("June", "июня", $dater);
    $dater = str_replace("July", "июля", $dater);
    $dater = str_replace("August", "августа", $dater);
    $dater = str_replace("September", "сентября", $dater);
    $dater = str_replace("October", "октября", $dater);
    $dater = str_replace("November", "ноября", $dater);
    $dater = str_replace("December", "декабря", $dater);

    mysql_query("UPDATE `users` SET `lvisit` = '$dater $time' WHERE usr = '$log' LIMIT 1");
    
    // /получаем местоположение
    if (isset($headmod)) {
        mysql_query("UPDATE `mesto` SET `place` = '$headmod' WHERE `usr` = '$log' LIMIT 1");
    } //фиксируем положение

     }else{
        $active = 0;
    }
    
    }else{
        $auth = 0; //ёзер не авторизирован
    }
//------    
    if(isset($_GET[site])){
    $_SESSION['site']=$_GET[site];
    }
//------
	    if(isset($_GET[ref])){
    $_SESSION['ref']=$_GET[ref];
    }
//------
	    if(isset($_GET[themes])){
    $_SESSION['themes']=$_GET[themes];
    }
//------



//-------------записуем данные браузера, время и IP-----------------------
// определяем реальный IP
if (!empty($_SERVER['HTTP_CLIENT_IP']))
 {   $ip=$_SERVER['HTTP_CLIENT_IP']; }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {  $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; }
 else
 {   $ip=$_SERVER['REMOTE_ADDR']; }//к сожалению не всегда содержит реальное значение IP

$brows = $_SERVER['HTTP_USER_AGENT'];
//$ip=$_SERVER['REMOTE_ADDR'];
$times = date("d.m.Y  -/-  H:i:s");


$ip_br = "$ip ||| $brows ||| $times";

mysql_query("UPDATE `users` SET `ip_br` = '$ip_br' WHERE usr = '$log'"); // пишем пароль если нет
mysql_query("UPDATE `account` SET `ip` = '$ip' WHERE `id` = '".$uid."'");

//----------------------------------------------------------------------------------------
ob_start();	
?>