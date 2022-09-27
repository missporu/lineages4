<?
define('PROTECTOR', 1);

$headmod = 'event';//фикс. места

$textl='Арена';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

switch($_GET[mod]){

default:



if ($_GET[mod]=='r'){
echo "<font color=#527F3F>Первые по рыбалке:</font><br/><br/>";
$req = mysql_query("SELECT * FROM `fish_log_w` WHERE `ids`>'0' ORDER BY `skoko` DESC LIMIT 5");
$avto=mysql_num_rows($req);$i=1;
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo '<div class=inoy> <a href="search.php?nick='.$mag[usr].'&amp;go=go">.: '.$mag[usr].'  <font color=#ffffff> ` '.$mag[skoko].'</font></a> </div>';
$i++;}}else {echo "В даном эвенте нет участников!<br/>";}//написать что в эвенте никто не участвовал
echo "<br/>";
echo "<hr/>";
//----------------------






//--------------первые по мобам---------------------------------


echo "<font color=#527F3F>Первые по убийствам монстров:</font><br/><br/>";
$req = mysql_query("SELECT * FROM `eve_mob_w` WHERE `id`>'0' ORDER BY `skoko` DESC LIMIT 5");
$avto=mysql_num_rows($req);$i=1;
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo '<div class=inoy> <a href="search.php?nick='.$mag[usr].'&amp;go=go">.: '.$mag[usr].'  <font color=#ffffff> ` '.$mag[skoko].'</font></a> </div>';
$i++;}}else {echo "В даном эвенте нет участников!<br/>";}//написать что в эвенте никто не участвовал
echo "<br/>";
echo "<hr/>";
//----------------------

echo "<font color=#527F3F>Первые по убийствам в PK:</font><br/><br/>";
$req = mysql_query("SELECT * FROM `eve_pk_w` WHERE `id`>'0' ORDER BY `skoko` DESC LIMIT 5");
$avto=mysql_num_rows($req); $i=1;
if($avto>=1){
While($mag = mysql_fetch_array($req))
{
echo '<div class=inoy> <a href="search.php?nick='.$mag[usr].'&amp;go=go">.: '.$mag[usr].'  <font color=#ffffff> ` '.$mag[skoko].'</font></a> </div>';
$i++;}}else {echo "В даном эвенте нет участников!<br/>";}//написать что в эвенте никто не участвовал
echo "<br/>";
echo "<hr/>";
//--------------//---------------//------------//-------------//--
}else{

echo "<div class=silka><a href=\"event_w.php?mod=r\">Список первых по эвэнтам</a></div><br/>";


		        $avto45 = mysql_num_rows(mysql_query("SELECT * FROM `event_w`"));

				$str = round($avto45/9);

   if($_GET['page']<=0 or $_GET['page'] >= $str){
		
		$page = $str;
		
		}else{
		$page = intval($_GET['page']);
		}

		$from = ($page-1)*9;
		
		        $avto = mysql_num_rows(mysql_query("SELECT * FROM `event_w`"));
            $pages1=$avto/9;
            $pages=round($avto/9);
            if($pages1>$pages){
            $pages=$pages+1;
            }
			


			if ($avto > 0){




$req = mysql_query("SELECT * FROM `event_w` WHERE `id` >= '0' ORDER BY `id` ASC LIMIT $from,9");
////////////////////////////
//if(mysql_num_rows($req)>=1){

While($eve = mysql_fetch_array($req))
{

echo "<hr/> $eve[text] ";

}

echo "</div><hr><p>Страниц: "; navig2($page, '?', $pages);

}else{echo "<div class=menu><div class=menu>Нет Эвэнтов.";}

//echo "<br/>";
//echo '<div style="border-bottom		:#666 solid  1px; padding		: 1% 1% 1% 1%; width:120px;">';

/*if ($_GET[page] > 0)
{
echo "<a href=\"event_w.php?page=$back\">Назад</a>";
}
elseif ($_GET[page] == 0)
{
echo "Назад";
}
echo" | ";
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"event_w.php?page=$next\">Далее</a>";}
else
{echo "Далее";}
*/
echo "</div>";
break;

}



}
include($path.'inc/down.php');
?>