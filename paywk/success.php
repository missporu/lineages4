<?php
define('PROTECTOR', 1);
$path = '../';  
$textl='покупка'; 
include('inc/path.php');   
include($path.'inc/db.php');   
include($path.'inc/auth.php');   
include($path.'inc/func.php');   
include($path.'inc/core.php');   
include($path.'inc/head.php');  
include($path.'inc/zag.php');
echo'<div class="content"> Покупка прошла успешно.</div>';
echo'<br/><a href="/paywk/">Обратно к покупкам</a>';
include($path.'inc/down.php');
?>
