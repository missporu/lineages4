<?php

if($_SERVER['HTTP_ACCEPT_ENCODING']){
$compress=strtolower($_SERVER['HTTP_ACCEPT_ENCODING']);}
else{$compress=strtolower($_SERVER['HTTP_TE']);}
if(substr_count($compress,'deflate')){
function compress_output_deflate($output){
return gzdeflate($output,9);}
$method='deflate';
header('Content-Encoding: deflate');
ob_start('compress_output_deflate');
ob_implicit_flush(0);}
elseif(substr_count($compress,'gzip')){
function compress_output_gzip($output){
return gzencode($output,9);}
$method='gzip';
header('Content-Encoding: gzip');
ob_start('compress_output_gzip');
ob_implicit_flush(0);}
elseif(substr_count($compress,'x-gzip')){
function compress_output_x_gzip($output){
$x="\x1f\x8b\x08\x00\x00\x00\x00\x00";
$size=strlen($output);
$crc=crc32($output);
$output=gzcompress($output,9);
$output=substr($output, 0, strlen($output) - 9);
$x.=$output;
$x.=pack('V',$crc);
$x.=pack('V',$size);
return $x;}
$method='x-gzip';
header('Content-Encoding: x-gzip');
ob_start('compress_output_x_gzip');
ob_implicit_flush(0);}
function info_compress(){
$alltraf=$row["alltraf"];
$pagesize=round((ob_get_length())/1024,1);
$alltraf=$alltraf+$pagesize;
mysql_query ("Update users set alltraf='".$alltraf."', lasttraf='".$pagesize."' where id='".$id."'");
list($msec, $sec) = explode(chr(4), microtime());
$tgen=round(($sec + $msec) - 0, 3);
global $method,$compress,$div4,$div9,$akcii,$title,$us,$kols,$_SERVER,$newtoday;
if($method){
$contents=ob_get_contents();
$in=strlen($contents);
if($method=='deflate'){$sjatie="gzip";
$out=strlen(gzdeflate($contents,9));}
elseif($method=='gzip'){$sjatie="gzip";
$out=strlen(gzencode($contents,9));}
elseif($method=='x-gzip'){$sjatie="gzip";
$out=strlen(gzcompress($contents,4));}
$percent=round(100-(100/($in/$out)),1);
print'<center>[ '.$sjatie.': '.$percent.'% | '.$tgen.' сек ] '.$pagesize.' кб </center>';}
else{print'[ gzip:off ] '.$pagesize.' ';}

// Коопирайт не снимать... можете изменить текст, но ссылку не убирайте...
if(!empty($newtoday)){
echo "<br />";}
}

?>