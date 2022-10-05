<?php

// ответ в чате
$avto_chat = mysql_num_rows(mysql_query("SELECT * FROM `chat_otv` WHERE `usr` = '$log' LIMIT 1"));
if ($avto_chat == 0) {$chat_otvet = '4at.jpg';}else{$chat_otvet = '4at2.JPG';}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


echo '</div></div>';
echo '<div class="lich">
<span style="
border		:#666 solid 2px;
background			: #2B2B2B;
padding-left		: 0px;
padding				:2% 0% 2% 0%;
display :table;
width :100%;
text-align			:center;
">';
$adres = $_SERVER['SCRIPT_NAME'];
if($adres=="/chat.php"){$hwgm = 'height=35 width=35';}
echo '<table style="width:100%" cellspacing="0" cellpadding="0"><tr>';
echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="index.php"><img src="/pic/down/menu.png" alt="Меню"/></a></td>';
echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="/to_gorod.php?"><img src="/pic/down/c0011.jpg" alt="Город"/></a></td>';
echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="/to_world.php?"><img src="/pic/down/okresnosti.jpg" alt="Окра"/></a></td>';
echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="/pers.php?"><img src="/pic/down/a3.jpg" alt="Перс"/></a></td>';
echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="/inventar.php?"><img src="/pic/down/a1.jpg" alt="Шмот"/></a></td>';
if(!empty($udata['clan']) and $in_battle=='0'){echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="/clanroom.php?"><img src="/pic/down/klan.png" alt="Клан"/></a></td>';}
echo '<td style="vertical-align:top;width:11%;border-right:solid;border-width:1px;color:#1D1C1A"><a href="/chat.php?"><img src="/pic/down/'.$chat_otvet.'" alt="Чат"/></a></td>';
echo '</tr></table>';
echo '</span></div>';
?>
