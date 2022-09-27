<?php
define('WK_ID', 2325); //id площадки
define('WK_SECRET', '19970303GERA0303'); //секретный код

$cen = mysql_query("SELECT * FROM `act_cena`");
$ce = mysql_fetch_array($cen);
//цена на premium key количество => цена 
$wk_cena_key = array( 
'1' => $ce[pk1],
'3' => $ce[pk3], 
'6' => $ce[pk5], 
'12' => $ce[pk10], 
'25' => $ce[pk20],
'38' => $ce[pk30],
'50' => $ce[pk40],
'65' => $ce[pk50],
'105' => $ce[pk75],
'150' => $ce[pk100],
);

//цена на CoL количество => цена
$wk_cena_col = array(
'100' => '12.00',
'500' => '60.00',
'1000' => '120.00',
'5000' => '600.00',
'10000' => '1200.00',
);

//цена на Vote Coin количество => цена
$wk_cena_vote = array(
    '100' => '15.00',
    '500' => '75.00',
    '1000' => '150.00',
    '5000' => '750.00',
);

//цена на pit количество => цена 
$wk_cena_obor = array( 
'Дикий Оборотень' => $ce[obor],
);

//цена на pit количество => цена  
$wk_cena_pig = array(  
'Мировой вепрь' => $ce[pig],
);

//цена на vip количество => цена   
$wk_cena_vip1nd = array(   
'VIP x100' => $ce[vip1nd],
);

//цена на vip количество => цена   
$wk_cena_vip2nd = array(   
'VIP x100' => $ce[vip2nd],
);

//цена на vip количество => цена   
$wk_cena_vip3nd = array(   
'VIP x100' => $ce[vip3nd],
);

//цена на vip количество => цена   
$wk_cena_vip1m = array(   
'VIP x100' => $ce[vip1m],
);
