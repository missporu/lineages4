<?php

////////////////////////////////////////////////////////////
// Выводим информацию внизу страницы                      //
////////////////////////////////////////////////////////////

//////////////		реклама		///////////////////////////
include($path.'inc/nogi.php');
include($path.'inc/foot_inf.php');

echo'</body></html>';
echo " <div class=lich>\n";


// счётчики крутяться
//echo '<marquee behavior="scroll" direction="up" height="15px" scrollamount="3">';
echo '<span align="center">'; // щетчики остальных

//echo '<a href="http://wap.top.wapstart.ru/?s=22985"><img src="http://counter.wapstart.ru/index.php?c=27973;b=1;r=0;s=27973" alt="Каталог сайтов Top.WapStart.ru" title="Каталог сайтов Top.WapStart.ru" /></a>';


/*
<br/></a></noscript>

<a href="http://waplog.net/c.shtml?530690"><img src="http://c.waplog.net/530690.cnt" alt="waplog" /></a>


</br><a href="http://vk.com/wap_line_ru">Наша група вконтакте</a>
</br>
<?

//echo "<p><small><span style=color:grey;></marquee>";




/*
?>
<script src="http://mobiads.ru/4715.js" type="text/javascript"></script>
<?
*/

///echo "</p></small></span>";

	info_compress();

ob_end_flush();
exit;
?>