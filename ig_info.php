<? 
define('PROTECTOR', 1); 

$headmod = 'obm_fs_ad'; 

$textl='Открытие сундуков'; 
include('inc/path.php'); 
include($path.'inc/db.php'); 
include($path.'inc/auth.php'); 
include($path.'inc/func.php'); 
going(); 
include($path.'inc/core.php'); 
include($path.'inc/head.php'); 
include($path.'inc/zag.php'); 
// расчёт онлайна


if ($udata[time]<60){$tim = "$udata[time] сек";} // cек

if ($udata[time]>59 and $udata[time]<3600)    { // мин и cек
                                                
                                                $time_min = floor($udata[time]/60);
                                                $time_sek = floor($udata[time]-($time_min*60));
                                                
                                            
                                            $tim = "$time_min мин $time_sek сек";
                                            } 


if ($udata[time]>=3600 and $udata[time]<86400)    { // часы, мин и cек
                                                
                                                $time_ch = floor($udata[time]/3600); // сколько часов                                        
                                                $udata[time] = floor($udata[time]-($time_ch*3600)); // остача часов
                                                
                                                $time_min = floor($udata[time]/60);
                                                
                                                $time_sek = floor($udata[time]-($time_min*60));
                                                
                                                    if ($time_sek<0) {
                                                                    $time_min=$time_min-1;
                                                                    $time_sek = floor($udata[time]-($time_min*60));
                                                                    }
    
                                            $tim = "$time_ch ч. $time_min мин. $time_sek сек.";
                                            } 
                                            
                                            
if ($udata[time]>=86400)    { // дни, часы, мин и cек
                                                
                                                $time_dd = floor($udata[time]/86400); // сколько дней                                        
                                                $udata[time] = floor($udata[time]-($time_dd*86400)); // остача дня

                                                
                                                
                                                $time_ch = floor($udata[time]/3600); // сколько часов                                        
                                                $udata[time] = floor($udata[time]-($time_ch*3600)); // остача часов
                                                
                                                $time_min = floor($udata[time]/60);
                                                
                                                $time_sek = floor($udata[time]-($time_min*60));
                                                
                                                    if ($time_sek<0) {
                                                                    $time_min=$time_min-1;
                                                                    $time_sek = floor($udata[time]-($time_min*60));
                                                                    }
    
                                            $tim = "<b>$time_dd</b> дн. <b>$time_ch</b> ч. <b>$time_min</b> мин. <b>$time_sek</b> сек.";
                                            }
echo"<font color=lightskyblue><u>Иголки</font> начнут выпадать когда вы проведёте в игре: <font color=darkorange>5 часов!</font></u><br/><br/><font color=lightskyblue>Вы провели в игре</font>: <font color=darkorange>$tim</font>";
?>
<?
include($path.'inc/down.php');
?>