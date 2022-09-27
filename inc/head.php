<?php
defined('PROTECTOR') or die('Error: restricted access');

$path2='';
//include($path2.'inc/gzips.php');
////////////////////////////////////////////////////////
//ini_set(‘zlib.output_compression’, ‘On’);
//ini_set(‘zlib.output_compression_level’, ’1′);

$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
////////////////////////////
$mestouser = mysql_fetch_assoc($req);
///////////////////
if(empty($header)){
///////
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-type: text/html; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo "\n" . '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
echo "\n" . '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">';
echo "\n" . "<head><meta http-equiv='content-type' content='application/xhtml+xml; charset=utf-8'/>
";
echo "\n" . '
<meta name="keywords" content="
l2war.mobi,l2war.mobi,онлайн,игра,lineage,wap,бесплатно,играть,линейдж 2 онлайн,l2 ОНЛАЙН,битвы,атака,бои,осады,la2,warriors,mmorpg,l2,www.l2war.mobi,онлайн lineage 2,l2 jykfqy,wap.l2war.mobi,онлайн игра,www.l2war.mobi,грэн каин,wap.l2war.mobi,buhf,jykfqy,,tcgkfnyj,jcfls,buhfnm,Lineage,lineage,новинка,2013,хит игра
" />
<meta name="description" content="
Сказочный мир LineAge II наполненный чудесами и опасностями, 
неведомыми монстрами и отважными героями, потрясающими осадами, 
в которых принимают участие сотни персонажей. 
Создай клан и поведи свой отряд на штурм замка, сражаясь плечом к плечу с союзниками против общего врага. 
Взлёты и падения, радость победы и горечь потери, новые друзья и заклятые враги, любовь и ненависть – всё это Вы сможете найти в игровом мире LineAge II
" /><title>'.$log.' .: Lineage II :. </title>';


/*опции настройка тем. Если есть, то выбранную включаем, нету, стандарт*/

$user_opt = mysql_fetch_array(mysql_query("SELECT theme FROM `options` where `usr`='$log' LIMIT 1"));
if (empty($user_opt[theme])){$style = 'osn';}else{$style = $user_opt[theme];}
echo "\n" . '<link rel="stylesheet" href="/theme/'.$style.'.css" type="text/css" />';
echo "\n" . '<link rel="stylesheet" href="/theme/frosty.css" type="text/css" />';
/*------------------------------------------------------------------------------------------------------*/ ?>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><?php




echo "\n" . '</head><body>';

echo '<table>
<tr>
<td class="lt1"></td><td class="t1"><div>Онлайн Игра <b>Lineage II</b></div></td><td class="rt1"></td>
</tr>
<tr>
<td class="l"></td>
<td class="centertd">';

///////////////////
}
///получаем положение
?>