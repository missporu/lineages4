<?php 

if($config['gzip']=="1"){

error_reporting(0); 

// степень компресии, возможные варианты от 0 до 9 
// Больше 4 или 5 ставить не следует, в степени компрессии выигрыша нет, а нагрузка на сервер растет 
$step = 5; 

// Узнаем какие типы сжатия поддерживает браузер 
if($_SERVER['HTTP_ACCEPT_ENCODING']){ 
$compress = strtolower($_SERVER['HTTP_ACCEPT_ENCODING']); 
} 
else{ 
$compress = strtolower($_SERVER['HTTP_TE']); 
} 


// Если поддерживается deflate 
if(substr_count($compress,'deflate')) 
{ 
function compress_output_deflate($output){ 
global $step; 
return gzdeflate($output, $step); 
} 

$method = 'deflate'; 
header('Content-Encoding: deflate'); 
ob_start('compress_output_deflate'); 
ob_implicit_flush(0); 
} 
// Если поддерживается gzip 
elseif(substr_count($compress,'gzip')) 
{ 
function compress_output_gzip($output){ 
global $step; 
return gzencode($output, $step); 
} 

$method = 'gzip'; 
header('Content-Encoding: gzip'); 
ob_start('compress_output_gzip'); 
ob_implicit_flush(0); 
} 
// Если поддерживается x-gzip 
elseif(substr_count($compress,'x-gzip')) 
{ 
function compress_output_x_gzip($output){ 
global $step; 
$size = strlen($output); 
$crc = crc32($output); 
$output = gzcompress($output, $step); 
$output = substr($output, 0, strlen($output) - 4); 
return "\x1f\x8b\x08\x00\x00\x00\x00\x00".$output.pack('V',$crc).pack('V',$size); 
} 

$method = 'x-gzip'; 
header('Content-Encoding: x-gzip'); 
ob_start('compress_output_x_gzip'); 
ob_implicit_flush(0); 
} 


// Инфа о проценте сжатия и др. 
function info_compress() 
{ 
global $method, $step; 

$contents = ob_get_contents(); 
// Сколько весит исходная страница 
$in = strlen($contents); 


switch($method){ 
default: 
print 'Сжатие не поддерживается<br/>IN: '.$in; 
break; 

case 'deflate': 
$out = strlen(gzdeflate($contents, $step)); 

print 'IN: '.round($in/1024,2).' kb<br/> 
OUT: '.round($out/1024,2).' kb<br/> 
Сжатие: '.round(100-(100/($in/$out)),1).' %<br/> 
Метод: '.$method.'<br/>'; 
break; 

case 'gzip': 
$out = strlen(gzencode($contents, $step)); 

print 'IN: '.round($in/1024,2).' kb<br/> 
OUT: '.round($out/1024,2).' kb<br/> 
Сжатие: '.round(100-(100/($in/$out)),1).' %<br/> 
Метод: '.$method.'<br/>'; 
break; 

case 'x-gzip': 
$out = strlen(gzcompress($contents, $step)); 

print 'IN: '.round($in/1024,2).' kb<br/> 
OUT: '.round($out/1024,2).' kb<br/> 
Сжатие: '.round(100-(100/($in/$out)),1).' %<br/> 
Метод: '.$method.'<br/>'; 
break; 
} 

return; 
} 
} 
?>