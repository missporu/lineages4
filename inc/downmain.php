<?
defined('PROTECTOR') or die('Error: restricted access');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo'</div></div></div><span style=text-align:center;>';
$foot = mysql_fetch_array(mysql_query("SELECT foot FROM `options` where `usr`='$log' LIMIT 1"));
if (empty($foot[foot]) or $foot[foot]==pic){include($path.'inc/foot_pic.php');}else{include($path.'inc/foot_text.php');}

include($path.'inc/nogi.php');
include($path.'inc/endmain.php');
?>
