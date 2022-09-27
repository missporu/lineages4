<?
define('PROTECTOR', 1);

$headmod = 'zaksms';//фикс. места

$textl='Покупка Монет';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
going();
place_okr();
place_zamok();
place_tower();
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');


switch($_GET[mod]){
default:

// --- --- удалить заказ --- --- //
if (isset($_GET[del])){
$reqcolpovtor = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `usr`='$log' and `id`='$_GET[del]' Limit 1"));
if ($reqcolpovtor==1){
mysql_query("DELETE FROM `zakaz_col_wm` WHERE `id`='".mysql_real_escape_string($_GET[del])."' and `usr`='$log' LIMIT 1");
echo "<p><font color=#339966>Удаленно</font></p><hr/>";
}
}
// -- CoL оставить (записать БД) заявка --//

if (isset($_GET[go])){

		$data = date("d F Yг. в H:i", strtotime("+20 seconds"));

//$data=date("d F Yг");
$data = str_replace("January","Января",$data);
$data = str_replace("February","Февраля",$data);
$data = str_replace("March","Марта",$data);
$data = str_replace("April","Апреля",$data);
$data = str_replace("May","Мая",$data);
$data = str_replace("June","Июня",$data);
$data = str_replace("July","Июля",$data);
$data = str_replace("August","Августа",$data);
$data = str_replace("September","Сентября",$data);
$data = str_replace("October","Октября",$data);
$data = str_replace("November","Ноября",$data);
$data = str_replace("December","Декабря",$data);

//защита//
if ($_POST[col]<=0 or $_POST[col]>2000000000){echo "<p><font color=#990000>Вводите цыфры от 1 до 2kkk</font></p><hr/>";}else{
//-
$reqcolpovtor = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `usr`='$log' and `col`='$_POST[col]' Limit 1"));
if ($reqcolpovtor==1){echo "<p><font color=#990000>Повтор запроса</font></p><hr/>";}else{
//-
if (empty($_POST[com]) or $_POST[com] == "Укажите WM перевода (R,U,B,Z). Код транзикции!"){echo "<p><font color=#990000>Не указан коментраий</font></p><hr/>";}else{
//-
//-----//

mysql_query("INSERT INTO
        `zakaz_col_wm` SET
        `usr` = '$log',
        `col` = '$_POST[col]',
        `com` = '$_POST[com]',
        `data` = '$data'");

echo "<p><font color=green>Заявка принята. Ожидайте! </font></p><hr/>";
		
}}}
}
//--------Заявки узера уже созданны-------------//
$zakazavto = mysql_num_rows(mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `usr`='$log'"));
$zak = mysql_query("SELECT * FROM `zakaz_col_wm` WHERE `usr`='$log'");
if ($zakazavto > 0){

echo '<p><font color=#336666>Ваши заявки в обработке:</font></p><hr/>';

   While($zakaz = mysql_fetch_array($zak))
   {
		echo "<div class=dot>";
		echo"WMR: <b>$zakaz[col]</b>&nbsp;&nbsp;";
		echo "<a href=\"?del=$zakaz[id]\"><font color=red>[x]</font></a> <br/>";
		echo"Дата: <b>$zakaz[data]</b><br/>";
		echo"Коментарий: <b>$zakaz[com]</b><br/>";
		echo "</div>";
	}
echo "<hr/>";	
}
//----------------------------------------------//

//--------WMR заполнение заявка---------------
echo '<p><font color=orange>Оставить заявку пополнения через WebMoney</font></p><hr/>';


if (empty($_POST[col])){$col_post = 'Кол-во заказаных WMR';}else{$col_post = ".mysql_real_escape_string($_POS[col]).";}
if (empty($_POST[com])){$com_post = 'Укажите WM перевода (R,U,B,Z). Код транзикции!';}else{$com_post = $_POST[com];}

echo "<form action=\"?go\" method=\"POST\">

<small><font color=grey>Вводите цыфры от 1 до 2kkk</font></small><br/>
<input type=\"text\" name=\"col\" value=\"$col_post\"/> <br/>

<small><font color=grey>Коментраий к заказу (max 100)</font></small><br/>
<textarea name=\"com\" maxlength=\"100\">$com_post</textarea><br/>

<input type=\"submit\" value=\"Отправить\" class=\"ibutton\"><hr/>";


echo '<p><font color=gold> 
Если при переводе коментарии были не заполнены, тогда укажите:<br/>
- сумму заказа<br/>
- время и дату заказа<br/>
- номер транзакции<br/>
- любую информацию подтверждающую Ваш заказ<br/>
иначе<br/>
- просто напишите "Спасибо =)"<br/>

 </font><br/><font color=red>
* Заявки обрабатываются в течении 24 часов.<br/>
** Заявку остовлять после того, как перевели деньги на указанные реквизиты.<br/>
*** За ложные попытки пополнения БЛОК без права на востановление.<br/>
</font></p>';

break;

}

echo "<p> <a href=\"zaksms.php\"> Назад к WMR </a></p><hr>";

include($path.'inc/down.php');
?>