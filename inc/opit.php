<?


$asd = mysql_num_rows(mysql_query("SELECT * FROM lvl")); // сколько уровней
$lv = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$udata[lvl]' LIMIT 1")); // бало

$ln = $udata[lvl]-1;
$lvnext = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$ln' LIMIT 1")); // нужно для нового

$exp=round((($udata[exp]-$lvnext[exp])/($lv[exp]-$lvnext[exp]))*100,2);

if($exp>"100"){ $exp="100";}

if($udata[lvl]>=$asd){ $exp="100";}

//--------------------search ---страница инфы пользователя----------------------

$asd2 = mysql_num_rows(mysql_query("SELECT * FROM lvl")); // сколько уровней
$lv2 = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$usdata[lvl]' LIMIT 1")); // бало

$ln2 = $usdata[lvl]-1;
$lvnext2 = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$ln2' LIMIT 1")); // нужно для нового

$exp2=round((($usdata[exp]-$lvnext2[exp])/($lv2[exp]-$lvnext2[exp]))*100,2);


if($usdata[lvl]>=$asd2){ $exp2=100;}



?>
