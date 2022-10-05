<?php

$path = '../';
$textl='покупка';
include('inc/path.php');   
include($path.'inc/db.php');   
include($path.'inc/auth.php');   
include($path.'inc/func.php');   
include($path.'inc/core.php');   
include($path.'inc/head.php');  
include($path.'inc/zag.php');
$cen = mysql_query("SELECT * FROM `act_cena`");
$ce = mysql_fetch_array($cen);
//if($log!='Shiki' && $log!='Mira'){echo'перенастройка';include('inc/down.php');exit;}
include_once __DIR__ . '/sett.php';
include_once __DIR__ . '/WapkassaClass.php';
echo'<br/><div class="slot_menu"><center>Покупка <font color=yellow>Coin of Luck</font></center></div><br/>
<div class="line"></div>';

if (!empty($_GET['almaz']) && !empty($wk_cena_col[$_GET['almaz']])) {
    try {
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET);

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_col[$_GET['almaz']], 'Покупка CoL ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(
'user_id' => $usr['id'],
'user' => $usr['usr'],
'type' => 'almaz',
'count' => $_GET['almaz'],
        ));

        // получаем данные для генерации формы
        $formValue = $wapkassa->getValue();

        // генерируем форму
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }
        echo '<button>Оплатить</button>';
echo '</form>';
echo'<br/><a href="/paywk/">Назад</a>';
include($path.'inc/down.php');
        exit;

    } catch (Exception $e) {
        // вывод ошибки
        echo $e->getMessage();
include($path.'inc/down.php');
        exit;
    }
}

?>
<hr><b>Купить <font color=yellow>Coin of Luck</font></b><br/>
<b>100 шт</b>  
<br>Цена: (12 руб.)<br/>  
<div class=""><a href='index.php?almaz=100' class='green'>Купить</a></div>
<hr><b>Купить <font color=yellow>Coin of Luck</font></b><br/>
<b>500 шт</b>  
<br>Цена: (60 руб.)<br/>  
<div class=""><a href='index.php?almaz=500' class='green center'>Купить</a></div>
<hr><b>Купить <font color=yellow>Coin of Luck</font></b><br/>
<b>1`000 шт</b>
<br>Цена: (120 руб.)<br/>  
<div class=""><a href='index.php?almaz=1000' class='green center'>Купить</a></div>
<hr><b>Купить <font color=yellow>Coin of Luck</font></b><br/>
<b>5`000 шт</b>
<br>Цена: (600 руб.)<br/>  
<div class=""><a href='index.php?almaz=5000' class='green center'>Купить</a></div>
<hr><b>Купить <font color=yellow>Coin of Luck</font></b><br/>
<b>10`000 шт</b>
<br>Цена: (1200 руб.)<br/>  
<div class=""><a href='index.php?almaz=10000' class='green'>Купить</a></div><hr>
<?

echo'<br/><div class="slot_menu"><center>Покупка <font color=red>Vote</font><font color=yellow>Coin</font></center></div><br/>
<div class="line"></div>';

if (!empty($_GET['votecoin']) && !empty($wk_cena_vote[$_GET['votecoin']])) {
    try { 
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_vote[$_GET['votecoin']], 'Покупка Vote Coin ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array( 
'user_id' => $usr['id'], 
'user' => $usr['usr'],
'type' => 'votecoin', 
'count' => $_GET['votecoin'], 
        )); 

        // получаем данные для генерации формы 
        $formValue = $wapkassa->getValue(); 

        // генерируем форму 
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) { 
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        } 
echo '<button>Оплатить</button>';
echo '</form>'; 
echo'<br/><a href="/paywk/">Назад</a>';
include($path.'inc/down.php'); 
        exit; 

    } catch (Exception $e) { 
        // вывод ошибки 
        echo $e->getMessage(); 
include($path.'inc/down.php'); 
        exit; 
    } 
}

?>
<hr><b>Купить <font color=red>Vote</font> <font color=yellow>Coin</font></b><br/>
<b>100 шт</b>  
<br>Цена: (15 руб.)<br/>  
<div class=""><a href='index.php?votecoin=100' class='green center'>Купить</a></div>
<hr><b>Купить <font color=red>Vote</font> <font color=yellow>Coin</font></b><br/>  
<b>500 шт</b>  
<br>Цена: (75 руб.)<br/>  
<div class=""><a href='index.php?votecoin=500' class='green center'>Купить</a></div>
<hr><b>Купить <font color=red>Vote</font> <font color=yellow>Coin</font></b><br/>  
<b>1000 шт</b>  
<br>Цена: (150 руб.)<br/>  
<div class=""><a href='index.php?votecoin=1000' class='green center'>Купить</a></div>
<hr><b>Купить <font color=red>Vote</font> <font color=yellow>Coin</font></b><br/>  
<b>5000 шт</b>  
<br>Цена: (750 руб.)<br/>  
<div class=""><a href='index.php?votecoin=5000' class='green center'>Купить</a></div><hr>
<?

echo'<br/><div class="slot_menu"><center>Покупка <font color=violette>Премиум Ключей</font></center></div> 
<div class="line"></div><br/>'; 

if (!empty($_GET['key']) && !empty($wk_cena_key[$_GET['key']])) {
    try {   
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_key[$_GET['key']], 'Покупка Премиум ключей ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(   
'user' => $usr['usr'],
'type' => 'key',   
'count' => $_GET['key'],   
        ));   

        // получаем данные для генерации формы   
        $formValue = $wapkassa->getValue();   

        // генерируем форму   
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {   
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}    
        echo '<button>Оплатить</button>';   
echo '</form>';   
echo'<br/><a href="/paywk/">Назад</a>'; 
include($path.'inc/down.php');   
        exit;   

    } catch (Exception $e) {   
        // вывод ошибки   
        echo $e->getMessage();   
include($path.'inc/down.php');   
        exit;   
    }   
}
?>
<hr><b>Купить <font color=violette>Премиум ключ</font></b><br/>  
<b>1 шт</b>  
<br>Цена: (<?echo"$ce[pk1]";?> руб.)<br/>
<div class=""><a href='index.php?key=1' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>
<b>3 шт</b>
<br>Цена: (<?echo"$ce[pk3]";?> руб.)<br/>
<div class=""><a href='index.php?key=3' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>
<b>5 шт <font color=darkviolet>(+ 1 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk5]";?> руб.)<br/>
<div class=""><a href='index.php?key=6' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>10 шт <font color=darkviolet>(+ 2 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk10]";?> руб.)<br/>
<div class=""><a href='index.php?key=12' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>20 шт <font color=darkviolet>(+ 5 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk20]";?> руб.)<br/>
<div class=""><a href='index.php?key=25' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>30 шт <font color=darkviolet>(+ 8 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk30]";?> руб.)<br/>
<div class=""><a href='index.php?key=38' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>40 шт <font color=darkviolet>(+ 10 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk40]";?> руб.)<br/>
<div class=""><a href='index.php?key=50' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>50 шт <font color=darkviolet>(+ 15 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk50]";?> руб.)<br/>
<div class=""><a href='index.php?key=65' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>75 шт <font color=darkviolet>(+ 30 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk75]";?> руб.)<br/>
<div class=""><a href='index.php?key=105' class='green center'>Купить</a></div>
<hr><b>Купить <font color=violette>Премиум ключи</font></b><br/>  
<b>100 шт <font color=darkviolet>(+ 50 в подарок!)</font></b>  
<br>Цена: (<?echo"$ce[pk100]";?> руб.)<br/>
<div class=""><a href='index.php?key=150' class='green center'>Купить</a></div><hr>

<?


echo'<br/><div class="slot_menu"><center>Покупка <font color=darkorange>Питов</font></center></div>
<div class="line"></div><br/>';

if (!empty($_GET['obor']) && !empty($wk_cena_obor[$_GET['obor']])) {
    try {  
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_obor[$_GET['obor']], 'Покупка Дикий оборотень ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(  
'user' => $usr['usr'],
'type' => 'obor',  
'count' => $_GET['obor'],  
        ));  

        // получаем данные для генерации формы  
        $formValue = $wapkassa->getValue();  

        // генерируем форму  
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {  
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}  
echo'Вы покупаете питомца: <b><font color="red">Дикий Оборотень</font><font color="yellow">[LeG]</font></b>';
        echo '<button>Оплатить</button>';  
echo '</form>';  
echo'<br/><a href="/paywk/">Назад</a>';
include($path.'inc/down.php');  
        exit;  

    } catch (Exception $e) {  
        // вывод ошибки  
        echo $e->getMessage();  
include($path.'inc/down.php');  
        exit;  
    }  
} 


if (!empty($_GET['pig']) && !empty($wk_cena_pig[$_GET['pig']])) {
    try {   
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_pig[$_GET['pig']], 'Покупка Мировой вепрь ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(   
'user' => $usr['usr'],
'type' => 'pig',   
'count' => $_GET['pig'],   
        ));   

        // получаем данные для генерации формы   
        $formValue = $wapkassa->getValue();   

        // генерируем форму   
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {   
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}   
echo'Вы покупаете питомца: <b><font color="red">Мировой вепрь</font><font color="yellow">[LeG]</font></b>';
        echo '<button>Оплатить</button>';   
echo '</form>';   
echo'<br/><a href="/paywk/">Назад</a>';
include($path.'inc/down.php');   
        exit;   

    } catch (Exception $e) {   
        // вывод ошибки   
        echo $e->getMessage();   
include($path.'inc/down.php');   
        exit;   
    }   
}

foreach ($wk_cena_obor as $key => $value) {  
echo "<a href='/paywk/?obor=$key'>Купить <b><font color=red>Дикий оборотень</font><font color=yellow>[LeG]</font></b></a><br>";
}
foreach ($wk_cena_pig as $key => $value) {   
echo "<a href='/paywk/?pig=$key'>Купить <b><font color=red>Мировой вепрь</font><font color=yellow>[LeG]</font></b></a><br>";
}



echo'<br/><div class="slot_menu"><center>Покупка <font color=darkorange>VIP Аккаунтов</font></center></div> 
<div class="line"></div><br/>';
if (!empty($_GET['vip1nd']) && !empty($wk_cena_vip1nd[$_GET['vip1nd']])) {
    try {   
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_vip1nd[$_GET['vip1nd']], 'Покупка VIP x1000 (1 неделя) ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(   
'user' => $usr['usr'], 
'type' => 'vip1nd',   
'count' => $_GET['vip1nd'],   
        ));   

        // получаем данные для генерации формы   
        $formValue = $wapkassa->getValue();   

        // генерируем форму   
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {   
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}   
echo'Вы покупаете : <b><font color="darkorange">VIP x1000 (1 неделя)</font></b><br/>';
        echo '<button>Оплатить</button>';   
echo '</form>';   
echo'<br/><a href="/paywk/">Назад</a>'; 
include($path.'inc/down.php');   
        exit;   

    } catch (Exception $e) {   
        // вывод ошибки   
        echo $e->getMessage();   
include($path.'inc/down.php');   
        exit;   
    }   
}



if (!empty($_GET['vip2nd']) && !empty($wk_cena_vip2nd[$_GET['vip2nd']])) {
    try {   
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_vip2nd[$_GET['vip2nd']], 'Покупка VIP x1000 (2 недели) ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(   
'user' => $usr['usr'], 
'type' => 'vip2nd',   
'count' => $_GET['vip2nd'],   
        ));   

        // получаем данные для генерации формы   
        $formValue = $wapkassa->getValue();   

        // генерируем форму   
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {   
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}   
echo'Вы покупаете: <b><font color="darkorange">VIP x1000 (2 недели)</font></b><br/>';
echo '<button>Оплатить</button>';
echo '</form>';   
echo'<br/><a href="/paywk/">Назад</a>'; 
include($path.'inc/down.php');   
        exit;   

    } catch (Exception $e) {   
        // вывод ошибки   
        echo $e->getMessage();   
include($path.'inc/down.php');   
        exit;   
    }   
}



if (!empty($_GET['vip3nd']) && !empty($wk_cena_vip3nd[$_GET['vip3nd']])) {
    try {   
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_vip3nd[$_GET['vip3nd']], 'Покупка VIP x1000 (3 недели) ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(   
'user' => $usr['usr'], 
'type' => 'vip3nd',   
'count' => $_GET['vip3nd'],   
        ));   

        // получаем данные для генерации формы   
        $formValue = $wapkassa->getValue();   

        // генерируем форму   
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {   
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}   
echo'Вы покупаете питомца: <b><font color="darkorange">VIP x1000 (3 недели)</font></b>'; 
        echo '<button>Оплатить</button>';   
echo '</form>';   
echo'<br/><a href="/paywk/">Назад</a>'; 
include($path.'inc/down.php');   
        exit;   

    } catch (Exception $e) {   
        // вывод ошибки   
        echo $e->getMessage();   
include($path.'inc/down.php');   
        exit;   
    }   
}



if (!empty($_GET['vip1m']) && !empty($wk_cena_vip1m[$_GET['vip1m']])) {
    try {   
        // Инициализация класса с id сайта и секретным ключом
        $wapkassa = new WapkassaClass(WK_ID, WK_SECRET); 

        // основные параметры - сумма и комментарий платежа
$wapkassa->setParams($wk_cena_vip1m[$_GET['vip1m']], 'Покупка VIP x1000 (1 месяц) ID ' . $usr['id']);

        // допольнительные параметры в виде массива, необязательно
        $wapkassa->setParamsAdd(array(   
'user' => $usr['usr'], 
'type' => 'vip1m',   
'count' => $_GET['vip1m'],   
        ));   

        // получаем данные для генерации формы   
        $formValue = $wapkassa->getValue();   

        // генерируем форму   
        echo '<form method="post" action="https://wapkassa.ru/merchant/payment2">';
        foreach ($formValue as $key => $value) {   
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}   
echo'Вы покупаете питомца: <b><font color="darkorange">VIP x1000 (1 месяц)</font></b>'; 
        echo '<button>Оплатить</button>';   
echo '</form>';   
echo'<br/><a href="/paywk/">Назад</a>'; 
include($path.'inc/down.php');   
        exit;   

    } catch (Exception $e) {   
        // вывод ошибки   
        echo $e->getMessage();   
include($path.'inc/down.php');   
        exit;   
    }   
}

foreach ($wk_cena_vip1nd as $key => $value) {   
echo "<a href='/paywk/?vip1nd=$key'>Купить <b><font color=darkorange><img src='/pic/vip.png'>VIP x100</font> <font color=white>на 1 неделю</font></b></a><br>";
}
foreach ($wk_cena_vip2nd as $key => $value) {   
echo "<a href='/paywk/?vip2nd=$key'>Купить <b><font color=darkorange><img src='/pic/vip.png'>VIP x100</font> <font color=white>на 2 недели</font></b></a><br>";
}
foreach ($wk_cena_vip3nd as $key => $value) {   
echo "<a href='/paywk/?vip3nd=$key'>Купить <b><font color=darkorange><img src='/pic/vip.png'>VIP x100</font> <font color=white>на 3 недели</font></b></a><br>";
}
foreach ($wk_cena_vip1m as $key => $value) {   
echo "<a href='/paywk/?vip1m=$key'>Купить <b><font color=darkorange><img src='/pic/vip.png'>VIP x100</font> <font color=white>на 1 месяц</font></b></a><br>";
}
include($path.'inc/down.php');
