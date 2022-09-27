<?
echo "</table></table></div></div></div></div><span style=text-align:center;>";
///////////////////////////////////////////////////////////


//----------низ ссылка обратная-----------
if(!empty($udata[site])){
$u=explode('.',$udata[site]);
include($path.'site/'.$u[0].'.php');
}else{
if(isset($_SESSION['site'])){
//echo"<hr/><a href='$site'>Главная</a><br/>";
echo '<p> <a href="http://'.$site.'"> Главная '.$site.'</a> </p>'; //
}}
//----------------------------------------

if ($user_id!==0){//не авторизован

echo'<p>	<span style=color:grey;> <a href="/faq.php?">Помощь</a> | <a href="/tiket.php?">Поддержка</a> | <a href="/index.php?mod=rules">Правила</span></a>| <a href="/mailadmin.php">Письмо админу</a></span>';
$taim = 150;$date = time();$timeout = $date - $taim;
$online = mysql_num_rows(mysql_query("SELECT * FROM online WHERE laikas > '$timeout'"));
echo "<br/><a href=\"/online.php?\"><span style=color:#2A8B7D;><b>Играет:</span> <span style=color:#B85E09;>[$online]</b></span></a></p>" ;
echo "<b><center><a href=\"/limited2.php?\"><span style=color:#9400D3;>Набор Новичка</span></center><br></b></a>";

$in_a3 = mysql_query("SELECT act300 FROM option_game WHERE id = '1' LIMIT 1");
$act300 =mysql_fetch_array ($in_a3);

if ($act300[act300]=='on'){
echo "<b><center><a href=\"/limited.php?\"><span style=color:#9400D3;>Акция Demon Edge</span></center><br></b></a>";
}
$in_a5 = mysql_query("SELECT act500 FROM option_game WHERE id = '1' LIMIT 1");
$act500 =mysql_fetch_array ($in_a5);

if ($act500[act500]=='on'){
echo "<b><center><a href=\"/limited3.php?\"><span style=color:#9400D3;>Не упусти свой шанс</span></center><br></b></a>";
}
$op = mysql_query("SELECT * FROM `option_game` WHERE `id` = '1'");
$opt = mysql_fetch_array($op);
if(!empty($opt[proc])){ $pokupka = "<b><font color=red>$opt[proc]</font></b>";}
echo'<center><img src="/pic/pokupka.png" height="16" width="16"><a href = "/pokupka.php"> <font color="green">Игровые покупки</font></a> '.$pokupka.'</center><br/>';

}
?> 
<script> 
function moscowTime() { 
    var d = new Date(); 
    d.setHours( d.getHours() + 3, d.getMinutes() + d.getTimezoneOffset()  );
    return d.toTimeString().substring(0,8); 
} 
  
onload = function () { 
  
  setInterval(function () { 
    document.getElementById("server_time").innerHTML = moscowTime();
  }, 100);} 
</script> 
<?
$date = date("d.m.Y");
echo'<center><span id="server_time">'.$time.'</span>  | '.$date.'</center>';
$Y_god = date("Y");
echo '</span><div align="center"><span style=color:#968C7C;font-size:12px;> "Lineage II"<br/>
© '.$_SERVER[HTTP_HOST].' | 2018-'.$Y_god.'  <br/>  </span>';
echo'<center><a href="http://statok.net/go/18308"><img src="//statok.net/imageOther/18308" alt="Statok.net" /></a></center>';


//	info_compress();
?>
