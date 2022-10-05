<?php

$headmod = 'bazar';//фикс. места
$textl='Базар ресурсов';
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



$display = 10;
$my_page = abs(intval($_GET['p']));

            if(!$my_page || $my_page < 1){ 
        $my_page = 1; 
         }

$start = ($my_page-1)*$display;

$case=htmlspecialchars(trim($_GET['mod']));
switch($case){
    
default:
$my = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM `sell_res` WHERE `pers_id` = '$active'"));
$my = $my['COUNT(*)'];
echo'<font color=green>Базар ресурсов.</font> / <a href="bazar_res.php?mod=my">Мои продажи ['.$my.']</a><br/>';
echo"<div class=inoy><a href=\"bazar_res.php?mod=sell\">Выставить ресурсы на продажу</a></div><hr/>";
$b = mysql_query("SELECT * FROM `sell_res` WHERE `city` = '$udata[city]' AND `pers_id` != '$active'");
$error = 0;
if(!mysql_num_rows($b)){
    $error = 'В этом городе не продают ресурсов!'; break;
}

$array = mysql_query("SELECT * FROM `sell_res` WHERE `city` = '$udata[city]' AND `pers_id` != '$active' ORDER BY `time` DESC LIMIT $start,$display");
while($res = mysql_fetch_assoc($array)){
    
    $mag = mysql_fetch_assoc(mysql_query("SELECT * FROM `res` WHERE `id` = '$res[res_id]'"));
    
    echo "<a href=\"bazar_res.php?mod=buy&id=$res[id]\"><img src=\"/pic/skr/$mag[name].gif\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/> $mag[name]<br/> [$res[number] штук] <hr/></a>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `sell_res` WHERE `city` = '$udata[city]' AND `pers_id` != '$active'"),0);

checkin::display_pagin($my_page, $all_posts, 'bazar_res.php?mod=sell&amp;p=');

if($error) echo '<div class="error">'.$error.'</div>';

break;


case'sell';
$id = abs(intval($_GET['id']));

if($id){
    $req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' and `id` = '$id'");
    if(mysql_num_rows($req)){
         $info = mysql_fetch_assoc($req);
    //Отображаем ресурс который выбран на продаж
    if($info['tip'] == 'res') $type = 'Ресурс';
    if($info['tip'] == 'elexir') $type = 'Элексир';
    if($info['tip'] == 'scroll') $type = 'Свиток';
    echo '<div class="inoy">';
    
echo "<img src=\"/pic/skr/$info[name].gif\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/> $info[name]<br/>Тип: $type<hr/>";
echo '<form action="bazar_res.php?mod=add_sell" method="POST">';
echo '<input type="hidden" name="res_id" value="'.$id.'" />'; // Что бы гет не использовать
//А то бывают умники которым так и кортит изменить ИД в адресной строке
echo 'Количество: (Мин.1 - Макс.'.$info['kol'].')<br />';
echo '<input type="number" name="num" value="'.$info['kol'].'" max='.$info['kol'].' min="1" /><br />';

echo 'Цена: (Минимум 1 Аден)<br />';
echo '<input type="number" name="cena" value="" min="1" /><br />';

echo 'Валюта:<br />';
echo '<select name="money">';
echo '<option disabled>Выберите валюту</option>';

echo '<option value="aden">Aden</option>';
echo '<option value="col">Coin of Luck</option>';

echo '</select><br />';

echo '<input type="submit" value="Выставить на продажу">';
echo '<br /><hr>';

echo '</form>';


echo '</div>';//.inoy
    }else{ echo '<div class="error">Это не ваш ресурс!</div>'; }
    
    }
    
    
$req = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' LIMIT $start,$display");
$avto=mysql_num_rows($req);
if($avto>=1){
while($mag = mysql_fetch_assoc($req)){
echo "<a href=\"bazar_res.php?mod=sell&id=$mag[id]\"><img src=\"/pic/skr/$mag[name].gif\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/> $mag[name]<br/> [$mag[kol] штук] <hr/></a>";
}
$all_posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `res` WHERE `usr` = '$log'"),0);

checkin::display_pagin($my_page, $all_posts, 'bazar_res.php?mod=sell&amp;p=');

}else{echo'Ресурсов нет';}


break;


case 'add_sell';
$id = abs(intval($_POST['res_id']));
$num = abs(intval($_POST['num'])); //Количество
$cena = abs(intval($_POST['cena'])); //Цена
$money = $_POST['money'];

$error = 0;
if($money != 'col' && $money != 'aden'){
    $error = 'Не выбрана валюта продажи! (Аден или КоЛ)'; 
break; 
}

if(!$id){
    $error = 'Не найден ИД ресурса!'; 
break; 
}
$pizdej = mysql_result(mysql_query("SELECT COUNT(*) FROM `res` WHERE `id` = '$id' AND `usr` = '$log'"),0);

if(!$pizdej){
    $error = 'Вы уверенны что владеете этим ресурсом? А то чевота его найти нивазможна. Не пиздишь ли ты часом?'; 
    break;
}

$info = mysql_fetch_assoc(mysql_query("SELECT * FROM `res` WHERE `id` = '$id' AND `usr` = '$log' LIMIT 1"));

if($num > $info['kol']){
    $error = 'У вас нет такого количества этого ресурса! У вас всего '.$info['kol'].''; 
    break;    
}

    $kol2 = $info['kol']-$num;
    mysql_query("UPDATE `res` SET `kol` = '$kol2' WHERE `id` = '$id'"); //Удаляем ресурсы из ресов юзера. 
    //Ну типа перемещаем их на базар


//Тут обавляем ресурсы в таблицу
mysql_query("INSERT INTO `sell_res` (`pers_id`,`res_id`,`price`,`price_type`,`time`, `city`, `number`) 
VALUES 
('$active', '$id', '$cena', '".mysql_real_escape_string($money)."', '".(time()*3600*48)."', '$udata[city]', '$num');");
echo '<div class="ok">Все ресурсы успешно добавлены на продажу!</div>';
echo'<a href="bazar_res.php">Назад</a>';


if($error){
    echo '<div class="error">'.$error.'</div>';
}

break;


case 'buy':
$id = abs(intval($_GET['id']));
$resource = mysql_query("SELECT * FROM `sell_res` WHERE `id` = '$id'");
if(mysql_num_rows($resource)){
    $bazar = mysql_fetch_assoc($resource);
    $info = mysql_fetch_assoc(mysql_query("SELECT * FROM `res` WHERE `id` = '$bazar[res_id]'"));

$prodavec = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$bazar[pers_id]'"));

echo "<img src=\"/pic/skr/$info[name].gif\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/> $info[name]<br/> [$bazar[number] штук] <hr/>";
    echo 'Цена: '.$bazar['price'].' '.$bazar['price_type'].'<br />';
    echo 'Продавец: '.$prodavec['usr'].'<br />';
    echo '<form action="bazar_res.php?mod=res" method="POST" />';
    echo 'Сколько вы хотите купить?<br />';
    echo '<input type="number" max="'.$bazar['number'].'" name="num" />';
    echo '<input type="hidden" name="id" value="'.$id.'" />';
    echo '<input type="submit" value="Купить" />';
    echo '</form>';
}else{
    echo '<div class="error">Ошибка! Такого ресурса в продаже не найдено!</div>';
    break;
}

break;

case 'res':
$id = abs(intval($_POST['id'])); // Ид лавочки в таблице sell_res
$num = abs(intval($_POST['num'])); //Количество сколько надо купить

$back = '<a href="bazar_res.php?mod=buy&amp;id='.$id.'">Назад к покупке</a>';

$resource = mysql_query("SELECT * FROM `sell_res` WHERE `id` = '$id'");
if(mysql_num_rows($resource)){
    $bazar = mysql_fetch_assoc($resource); //sell_res
    $info = mysql_fetch_assoc(mysql_query("SELECT * FROM `res` WHERE `id` = '$bazar[res_id]'"));
//res
if($num > $bazar['number']){
    echo '<div class="error">Ошибка! Вы пробуете приобрести более чем продавец может предложить! ('.$num.'/'.$bazar['number'].')</div>';
    echo $back;
    break;
}

if($bazar['pers_id'] == $active){
        echo '<div class="error">Ошибка! Не можно покупать у самого себя!</div>';
    echo $back;
    break;
}
$prodavec = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$bazar[pers_id]'"));
if($bazar['price_type'] == 'aden') {
$typ = $udata['money'];
$pole = 'money';
$test = $prodavec['money'];
}
if($bazar['price_type'] == 'col') {
$typ = $udata['almaz'];
$pole = 'almaz';
$test = $prodavec['almaz'];
}

if($typ < $bazar['price']*$num){ // добавил $num количество покупаемого.
echo '<div class="error">Ошибка! У вас недостаточно '.$bazar['price_type'].' для покупки такого количества данного ресурса! Уменшите количество или накопите больше денег!</div>';
echo $back;
break;
}

//ЕСЛИ ВСЕ ОК
$minus = $typ-$bazar['price']*$num; // добавил $num количество покупаемого.
$plus = $bazar['price']*$num;
$prodavec = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$bazar[pers_id]'"));
$plus = $test+$plus;


mysql_query("UPDATE `users` SET `$pole` = '$plus' WHERE `id` = '$bazar[pers_id]'"); //Деньги начисляем за продажу

mysql_query("UPDATE `users` SET `$pole` = '$minus' WHERE `id` = '$active'"); //Деньги забираем

if($num == $bazar['number']){
    mysql_query("DELETE FROM `sell_res` WHERE `id` = '$id'");
    //Если выкупает ВСЕ ресурсы
}else{
    $ostatok = $bazar['number']-$num;
    mysql_query("UPDATE `sell_res` SET `number` = '$ostatok' WHERE `id` = '$id'");
}

$exist_res = mysql_query("SELECT * FROM `res` WHERE `usr` = '$log' AND `lat_name` = '$info[lat_name]' LIMIT 1");
if(mysql_num_rows($exist_res)){
    $lat = mysql_fetch_assoc($exist_res);
    $vmeste = $num+$lat['kol'];
    mysql_query("UPDATE `res` SET `kol` = '$vmeste' WHERE `id` = '$lat[id]'");
echo 'Вы успешно приобрели '.$info['name'].' х'.$num.'';
echo'<br><a href= "bazar_res.php">Назад</a>';
    //Если уже есть в инвентаре то просто прибавляем количество
}else{
    
    $zapros = mysql_query("INSERT INTO `res` (`id`,`usr`,`name`,`lat_name`,`tip`,`what`,`give`,`kol`,`cena`)
    VALUES 
    ( NULL , '$log', '$info[name]', '$info[lat_name]', '$info[tip]', '$info[what]', '$info[give]', '$num', '$info[cena]');");
if($zapros){
echo 'Вы успешно приобрели '.$info['name'].' х'.$num.'';
echo'<br><a href="bazar_res.php">Назад</a>';
}else{
    echo 'EБAAAA... ошибка в запросе... Это значит что покупка не удалась. Напишите об ошибке администрации как можно скорее. Вам вернут ваши деньги или ресурсы';
echo $back;
}

}

}else{
    echo '<div class="error">Ошибка! Такого ресурса в продаже не найдено!</div>';
    echo $back;
    break;
}


break;



//Удаление с продажи
case 'sniat':
$id = abs(intval($_GET['id'])); // Ид лавочки в таблице sell_res

$resource = mysql_query("SELECT * FROM `sell_res` WHERE `id` = '$id' AND `pers_id` = '$active'");
if(mysql_num_rows($resource)){
    $bazar = mysql_fetch_assoc($resource); //sell_res
    $info = mysql_fetch_assoc(mysql_query("SELECT * FROM `res` WHERE `id` = '$bazar[res_id]'"));
//res

if($bazar['pers_id'] != $active){
        echo '<div class="error">Ошибка! Это не ваш ресурс!</div>';
}

    mysql_query("DELETE FROM `sell_res` WHERE `id` = '$id'"); //Удалили

    $vmeste = $bazar['number']+$info['kol'];
    mysql_query("UPDATE `res` SET `kol` = '$vmeste' WHERE `id` = '$bazar[res_id]'");
echo 'Вы успешно сняли с продажи '.$info['name'].' х'.$bazar['number'].'';
echo'<br><a href="bazar_res.php">Назад</a>';
    //Если уже есть в инвентаре то просто прибавляем количество

}else{
    echo '<div class="error">Ошибка! Такого ресурса в продаже не найдено!</div>';
    echo $back;
    break;
}


break;


case 'my':
$my = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) FROM `sell_res` WHERE `pers_id` = '$active'"));
$my = $my['COUNT(*)'];
if($my){
    
$array = mysql_query("SELECT * FROM `sell_res` WHERE `pers_id` = '$active' ORDER BY `time` DESC");
    while($res = mysql_fetch_assoc($array)){
$mag = mysql_fetch_assoc(mysql_query("SELECT * FROM `res` WHERE `id` = '$res[res_id]'"));
    
    echo "<img src=\"/pic/skr/$mag[name].gif\"  align='left' width='32' height='32' alt='' style='margin-right:10px;border:1px solid #383838'/> $mag[name] [$res[number] штук]<br /><a href='bazar_res.php?mod=sniat&id=$res[id]'><font color=red>Снять с продажи</font></a> <hr/></a>";
}
}else{
    echo '<div class="error">Вы не продаете никаких ресурсов!</div>';
}

break;



}
include($path.'inc/down.php');
?>