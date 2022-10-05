<?php

$headmod = 'online';//фикс. места

$textl='Игроки онлайн';
include('inc/path.php');
//include('inc/gzips.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


echo "</div><div class=inoy>";
echo "<b><p>Игроки онлайн:</p></b><hr/> ";


///////////////
$taim = 150;
$date = time();
$timeout = $date - $taim;
////////////////
   if($_GET['page']<=0){
		$page = 1;
		}else{
		$page = intval($_GET['page']);
		}
		$from = ($page-1)*10;
		
		        $avto = mysql_num_rows(mysql_query("SELECT `usr` FROM `online` WHERE `laikas` > '$timeou'"));
            $pages1=$avto/10;
            $pages=round($avto/10);
            if($pages1>$pages){
            $pages=$pages+1;
            }


$asd = mysql_query("SELECT laikas, usr FROM online WHERE laikas > '$timeou' ORDER BY `lvl` DESC LIMIT $from,10");

$i=1;
While($visi = mysql_fetch_array($asd))
{
echo ' ';echo idlog_online($idlog=$visi[usr]).'';

}

echo "</div><hr><p>Страниц: "; navig2($page, 'online.php?', $pages);
echo "</p>";



include($path.'inc/down.php');
?>
