<?php
defined('PROTECTOR') or die('Error: restricted access');




function nav2($link, $link_name){
	echo '<br/><a href="'.$link.'">'.$link_name.'</a>';
}
function sec($sec){
	$sec = htmlspecialchars(mysql_real_escape_string($sec));
	return $sec;
}
function navig($page, $link, $pages){
	if($pages > 1){
		echo 'cтраницы:<br/>';
		for($i = 1; $i <= $pages; $i++){
			if($i != $page){
				echo '<a href="'.$link.'page='.$i.'">'.$i.'</a> ';
			}else{
				echo '<u>'.$i.'</u> '; // выводим активую страницу текстом
			}
		}
		echo '<br/>';
	}else{
		echo 'cтраницы:<br/><u>1</u><br/>';
	}	
}


?>