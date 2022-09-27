<?
defined('PROTECTOR') or die('Error: restricted access');


// ответ в чате
$avto_chat = mysql_num_rows(mysql_query("SELECT * FROM `chat_otv` WHERE `usr` = '$log' LIMIT 1"));
if ($avto_chat == 1) {$chat_otvet = '<font color=#01DFD7>(+)</font>';}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$req = mysql_query("SELECT id FROM `pit` WHERE `usr` = '$log' and `status`='on'");
$avto=mysql_num_rows($req);
if($avto==1){
echo"<div class=down> <a href=\"/pit.php?mod=mypit\"><b>Мой зверь</b></a></div>";
}
echo '<div class="down">';

if($mestouser['city']=='0' or $mestouser['city']=='1'){
if ($inryd=='1'){

echo '<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/to_gorod.php" title="Город">Город</a></td><td style="vertical-align:top;width:19%;">
<a class="top_menu_link" href="/rydnik.php?" title="Рудник">Рудник</a></td></tr></table>
</div>';


}else{
echo '<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/to_gorod.php" title="Город">Город</a></td><td style="vertical-align:top;width:19%;">
<a class="top_menu_link" href="/to_world.php?" title="Окресности">Окресности</a></td></tr></table>
</div>';
}
}elseif($mestouser['city']=='2'){
echo '<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/zamok.php" title="Замок">Замок</a></td><td style="vertical-align:top;width:19%;">
<a class="top_menu_link" href="/to_gorod.php?" title="Город">Город</a></td></tr></table>
</div>';
}elseif($mestouser['city']=='3'){
echo '<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/towers.php" title="Башни">Башни</a></td><td style="vertical-align:top;width:19%;">
<a class="top_menu_link" href="/to_gorod.php?" title="Город">Город</a></td></tr></table>
</div>';
}


if(!empty($udata['clan']) and $in_battle=='0'){ // если в клане то
$req1 = mysql_query("SELECT * FROM `aluko_cl`");
$aluko = mysql_fetch_array($req1);
if ($aluko[health]>=1) {$clan_v = '<font color=#01DFD7>(+)</font>';}
echo '
<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/clanroom.php" title="Клан"> Клан '.$clan_v.' </a></td><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/inventar.php" title="Шмот (инвентарь)">Шмот</a></td><td style="vertical-align:top;width:19%;">
<a class="top_menu_link" href="/pers.php" title="Персонаж">Перс</a></td></tr></table>
</div>';
}else{ //иначе
echo '
<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/inventar.php" title="Шмот (инвентарь)">Шмот</a></td><td style="vertical-align:top;width:19%;">
<a class="top_menu_link" href="/pers.php?" title="Персонаж">Перс</a></td></tr></table>
</div>';
}

 echo '
<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A"><a class="top_menu_link" href="/msg.php" title="Почта">
 Почта </a></td><td style="vertical-align:top;width:19%;border-right:solid;border-width:1px;color:#1D1C1A"><a class="top_menu_link" href="/chat.php" title="Чат">
Чат '.$chat_otvet.'</a></td><td style="vertical-align:top;width:19%;"><a class="top_menu_link" href="/forum" title="Форум">
Форум</a></td></tr></table>
</div>';

echo '
<div id="navi"><table style="width:100%" cellspacing="0" cellpadding="0"><tr><td style="vertical-align:top;width:50%;border-right:solid;border-width:1px;color:#1D1C1A">
<a class="top_menu_link" href="/index.php" title="Главная">Главная</a></td><td style="vertical-align:top;width:50%;">
<a class="top_menu_link" href="/exit.php" title="Выход"><font color=red>Выход</font></a></td></tr></table>
</div>';
?>
