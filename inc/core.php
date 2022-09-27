<?php 
defined('PROTECTOR') or die('Error: restricted access');
// //////////////////////////////////////////////////////
if ($user_id=='1'){

    pit_eda(); //питы
ref(); //рефы
    clanwarn(); //напали
    auto_clean(); //чистим логи
    
}

$_GET['id'] = intval($_GET['id']);

///Новые игроки Сегодня /////
$data = date("y/m/d");
				$zak = mysql_query("SELECT * FROM `new_usr` WHERE `data` != '$data'");
						While($zakaz = mysql_fetch_array($zak))
							{
								//$time=time()+2;
								mysql_query("DELETE FROM `new_usr` WHERE `id`='$zakaz[id]'");
							}
////////////////////////////////////////////


// --- --- --- таблица рекорда игры --- --- --- //
$rekord = mysql_query("SELECT * FROM `rekord`");
$rek = mysql_fetch_array($rekord);

$times = date("H:i:s");
$date = date("d.m.Y");


$rekonline=explode('|',$rek[online]);
$reknewusr=explode('|',$rek[new_reg]);
 
 
 //---рекорд онлайна
 $online = mysql_num_rows(mysql_query("SELECT * FROM online WHERE laikas > '$timeout'"));
	if ($online>$rekonline[0]){
						$res = mysql_query ("UPDATE rekord SET online='$online|$date|$times'");
							}

 //---рекорд регистраций
 $newusers = mysql_num_rows(mysql_query("SELECT * FROM new_usr"));
	if ($newusers>$reknewusr[0]){
						$res = mysql_query ("UPDATE rekord SET new_reg='$newusers|$date|$times'");
							}
							
if(!$active && $auth){ //Если не выбран персонаж то переносим его на страницу выбора или создания перса (кабинет))
    header("Location: office.php?error=1");
    exit;
}

class checkin{



    function check($str){
        if (function_exists('iconv')) {
            $str = iconv("UTF-8", "UTF-8", $str);
        }

        $str = preg_replace('#(\.|\?|!|\(|\)){3,}#', '\1\1\1', $str);

        $str = nl2br($str);
        $str = preg_replace('!\p{C}!u', '', $str);
        $str = str_replace('<br />', "\n", $str);

        $str = preg_replace('# {2,}#', ' ', $str);

        $str = preg_replace("/(\n)+(\n)/i", "\n\n", $str);

        return trim($str);
    }

function sec2day($sec=NULL)
{
$days = floor($sec/86400);
$hours = floor(($sec/3600)-$days*24);
$minuts = floor(($sec-$hours*3600-$days*86400)/60);
$seconds = $sec-($minuts*60+$hours*3600+$days*86400);

if ($days!=0)$days = $days.' дн. ';
else $days = NULL;
if ($hours!=0)$hours = $hours.' ч. ';
else $hours = NULL;
if ($minuts!=0)$minuts = $minuts.' мин. ';
else $minuts = NULL;

$sectoday = $days.''.$hours.''.$minuts.''.$seconds.' сек.';

return $sectoday;
}





function display_pagin($my_page, $total, $script, $display){
    if(empty($display)){
    $display = 10;
    }
    
    $last_page = ceil($total/$display);
            if(!$my_page || $my_page < 1 || $my_page > $last_page){ 
        $my_page = 1; 
         }
            //Постраничка - ВЫВОД
    echo '<div class="navigation">';
    if($my_page > 1){
        echo '<a href="'.$script.''.($my_page-1).'">Назад</a>';
    }
    if($my_page < $last_page){
        echo '<a href="'.$script.''.($my_page+1).'">Вперед</a>';
    }
    echo '</div>';
   
    
} //function pagination

function pagin(){
    $display = 10;
$my_page = abs(intval($_GET['p']));
$start = ($my_page-1)*$display;
            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }
}

function GetUserAgent() {
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		$agent = $_SERVER['HTTP_USER_AGENT'];

		if (stripos($agent, 'Avant Browser') !== false) {
			return 'Avant Browser';
		} elseif (stripos($agent, 'Acoo Browser') !== false) {
			return 'Acoo Browser';
		} elseif (stripos($agent, 'MyIE2') !== false) {
			return 'MyIE2';
		} elseif (preg_match('|Iron/([0-9a-z\.]*)|i', $agent, $pocket)) {
			return 'SRWare Iron ' . subtok($pocket[1], '.', 0, 2);
		} elseif (preg_match('|Chrome/([0-9a-z\.]*)|i', $agent, $pocket)) {
			return 'Chrome ' . subtok($pocket[1], '.', 0, 3);
		} elseif (preg_match('#(Maxthon|NetCaptor)( [0-9a-z\.]*)?#i', $agent, $pocket)) {
			return $pocket[1] . $pocket[2];
		} elseif (stripos($agent, 'Safari') !== false && preg_match('|Version/([0-9]{1,2}.[0-9]{1,2})|i', $agent, $pocket)) {
			return 'Safari ' . subtok($pocket[1], '.', 0, 3);
		} elseif (preg_match('#(NetFront|K-Meleon|Netscape|Galeon|Epiphany|Konqueror|Safari|Opera Mini|Opera Mobile)/([0-9a-z\.]*)#i', $agent, $pocket)) {
			return $pocket[1] . ' ' . subtok($pocket[2], '.', 0, 2);
		} elseif (stripos($agent, 'Opera') !== false && preg_match('|Version/([0-9]{1,2}.[0-9]{1,2})|i', $agent, $pocket)) {
			return 'Opera ' . $pocket[1];
		} elseif (preg_match('|Opera[/ ]([0-9a-z\.]*)|i', $agent, $pocket)) {
			return 'Opera ' . subtok($pocket[1], '.', 0, 2);
		} elseif (preg_match('|Orca/([ 0-9a-z\.]*)|i', $agent, $pocket)) {
			return 'Orca ' . subtok($pocket[1], '.', 0, 2);
		} elseif (preg_match('#(SeaMonkey|Firefox|GranParadiso|Minefield|Shiretoko)/([0-9a-z\.]*)#i', $agent, $pocket)) {
			return $pocket[1] . ' ' . subtok($pocket[2], '.', 0, 3);
		} elseif (preg_match('|rv:([0-9a-z\.]*)|i', $agent, $pocket) && strpos($agent, 'Mozilla/') !== false) {
			return 'Mozilla ' . subtok($pocket[1], '.', 0, 2);
		} elseif (preg_match('|Lynx/([0-9a-z\.]*)|i', $agent, $pocket)) {
			return 'Lynx ' . subtok($pocket[1], '.', 0, 2);
		} elseif (preg_match('|MSIE ([0-9a-z\.]*)|i', $agent, $pocket)) {
			return 'IE ' . subtok($pocket[1], '.', 0, 2);
		} else {
			$agent = preg_replace('|http://|i', '', $agent);
			$agent = strtok($agent, '( ');
			$agent = substr($agent, 0, 22);
			$agent = subtok($agent, '.', 0, 2);

			if (!empty($agent)) {
				return $agent;
			} 
		} 
	} 
	return 'Unknown';
} 

function getusagfull() {
		if(!empty($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])){
			$usagf=$_SERVER['HTTP_X_OPERAMINI_PHONE_UA'];
		}elseif(!empty($_SERVER['HTTP_X_OPERAMINI_PHONE'])){
			$usagf=$_SERVER['HTTP_X_OPERAMINI_PHONE'];
		}else{
			$usagf=htmlspecialchars(stripslashes(getenv('HTTP_USER_AGENT')));
		} 
	return $usagf;
} 

function getip()
{
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown")) $ip = getenv("HTTP_CLIENT_IP");
   elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) $ip = getenv("HTTP_X_FORWARDED_FOR");
   elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) $ip = getenv("REMOTE_ADDR");
   elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR'];
   else $ip = "unknown";
   return($ip);
}


}	
/*		
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	ini_set('error_reporting', E_ALL);*/
//----------------------------------------------//
?>