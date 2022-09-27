<?
define('PROTECTOR', 1);

$textl='GM-Panel WebMoney';
///////////////////////
	$path='../';			//
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');
///////////////


if ($udata[dostup] < 4){
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
echo "<b><font color=red><p><center>Доступ закрыт!</center></p></font></b>";
mysql_query("INSERT INTO `block` (`id`, `usr`, `log`, `ban_time`, `text`, `cena`) VALUES (NULL, '$log', 'Shiki', '4985139097', 'что то пошло не так....', '')");
mysql_query("INSERT INTO `msg_r` SET `user_from` = 'Система', `user_to` = 'Shiki', `time` = '$times | $date', `read` = 1, `mail_msg` = 'Пытался зайти в гм панель $udata[usr]' ");
include($path.'inc/down.php');
exit;}

switch($_GET[mod]){
default:


//--------Просмотр заказов-------------//

echo '<p><font color=#336666><b>Список покупок через WebMoney Merchant:</b></font></p><hr/>';

	   if($_GET['page']<=0){
		$page = 1;
		}else{
		$page = intval($_GET['page']);
		}
		$from = ($page-1)*10;
		
		        $avto = (mysql_query("SELECT * FROM webmoney_log"));
            $pages1=$avto/10;
            $pages=round($avto/10);
            if($pages1>$pages){
            $pages=$pages+1;
            }



$zakazavto = (mysql_query("SELECT * FROM `webmoney_log`"));
$zak = mysql_query("SELECT * FROM `webmoney_log` ORDER BY id DESC LIMIT $from,10");
if ($zakazavto > 0){




   While($zakaz = mysql_fetch_array($zak))
   {
		echo "<div class=dot>";
		echo"";
		echo"Перс: <a href=\"/search.php?nick=$zakaz[usr]&amp;go=go\"><b>$zakaz[usr]</b></a> <font color=gold>(ID: $zakaz[id]) </font><br/>";
		$zakaz[col] = $zakaz[col]/100;
		echo"WMR: <b>".number_format($zakaz[col], 2, ',', "`")."</b><br/>";
		echo"Полученно: <b>$zakaz[data]</b><br/>";
		echo"<b>$zakaz[text]</b><br/>";

		echo "</div>";
	}
echo "<hr/>";	
}else{echo '<p><font color=#336666><b> Нет заказов =( </b></font></p><hr/>';}
//----------------------------------------------//
echo "</div><hr><p>Страниц: "; navig2($page, '?mod=logwm&', $pages);


break;

}

echo "<br/><div class=inoy><a href=\"/gm/\">Назад</a></div></div>";

include($path.'inc/down.php');
?>