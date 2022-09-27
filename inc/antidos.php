<?php
/*
$sitetime=time();
$brow=htmlspecialchars(stripslashes(getenv('HTTP_USER_AGENT')));

$self = $_SERVER['SCRIPT_NAME'];

$ip_addr = preg_replace('|[^0-9\.]|', '', $_SERVER['REMOTE_ADDR']);
if ($ip_addr==""){
echo '<b>Ошибка! У вас отсутствует IP-адрес (REMOTE_ADDR)</b>'; exit;
}

//------------------------- Очистка старых файлов ---------------------------///*
if ($opendir = opendir("data/datados")) {
while (false !== ($doslog = readdir($opendir))) {
if ($doslog != "." and $doslog != "..") {

$file_array_filemtime = filemtime("data/datados/$doslog");
if ($file_array_filemtime < ($time-60)) {
unlink("data/datados/$doslog"); 
}}}}

//-------------------------- Проверка на время -----------------------------//
$loginc = "data/datados/".$ip_addr.".dat";

if(file_exists($loginc)){
$file_dos_time = file($loginc);
$file_dos_str= explode("|",$file_dos_time[0]);

if($file_dos_str[1] < ($sitetime-60)) {
unlink($loginc);
}}

$sitetime=time();
$brow=htmlspecialchars(stripslashes(getenv('HTTP_USER_AGENT')));

$self = $_SERVER['SCRIPT_NAME'];

//------------------------------ Запись логов -------------------------------//
$write = '|'.$sitetime.'|Время: '.date("Y-m-d / H:i:s",$sitetime).'|Browser: '.$brow.'|Referer: '.$http_referer.'|URL: '.$self.'|Пользователь: '.$log.'|';
$fp=fopen($loginc,"a+");
flock ($fp,LOCK_EX);
fputs($fp,"$write\r\n");
flock ($fp,LOCK_UN);
fclose($fp);
@chmod ($fp, 0666);
@chmod ($loginc, 0666);

//----------------------- Автоматическая бликировка ------------------------//
if (count(file($loginc)) > $config_doslimit && $config_doslimit>0) {

unlink($loginc);

$banlines=file("data/bans.dat");
foreach($banlines as $banvalue){
$bancell = explode("|", $banvalue);
$banarray[]=$bancell[1];
}


//-------------------------- Запись IP в базу --------------------------------//
if(!in_array($ip_addr,$banarray)){

$fp=fopen("data/bans.dat","a+");
flock ($fp,LOCK_EX);
fputs($fp,"|$ip_addr|\r\n"); 
fflush ($fp); 
flock ($fp,LOCK_UN);                                           
fclose($fp);  

$logdat = "data/datalog/bans.dat";
$hostname = gethostbyaddr($ip_addr);

$write = '|Заблокирован доступ для IP|IP: '.$ip_addr.'|Время: '.date("Y-m-d / H:i:s",$sitetime).'|Хост: '.$hostname.'|Referer: '.$http_referer.'|Browser: '.$brow.'|URL: '.$request_uri.'|Пользователь: '.$username.'|';

$fp=fopen($logdat,"a+");
flock ($fp,LOCK_EX);
fputs($fp,"$write\r\n");
flock ($fp,LOCK_UN);
fclose($fp);
chmod ($fp, 0666); 
chmod ($logdat, 0666); 

$file=file($logdat); 
$i = count($file);
if ($i>=$config_maxlogdat) {
$fp=fopen($logdat,"w");
flock ($fp,LOCK_EX);
unset($file[0],$file[1]);
fputs($fp, implode("",$file));
flock ($fp,LOCK_UN);
fclose($fp);
}}}

//-------------------------- Запрет на вход --------------------------------//
$old_ips = file("data/bans.dat");
foreach($old_ips as $old_ip_line){
$ip_arr = explode("|", $old_ip_line);

$ip_check_matches = 0;
$db_ip_split = explode(".", $ip_arr[1]);
$this_ip_split = explode(".", $ip_addr);

for($i_i=0;$i_i<10;$i_i++){
if ($this_ip_split[$i_i] == $db_ip_split[$i_i] or $db_ip_split[$i_i] == '*') {
$ip_check_matches += 1;}}

if ($ip_check_matches == 10) {
if($php_self!='/pages/banip.php'){ header ("Location: index,php");   exit;}} //бан по IP
}
*/
?>
