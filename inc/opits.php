<?



//--------------------search ---страница инфы пользователя----------------------

$asd2 =$mysql->num_rows($mysql->query("SELECT * FROM lvl")); // сколько уровней
$lv2 = $mysql->super_query("SELECT * FROM lvl WHERE `lvl` = '".$usdata['lvl']."' LIMIT 1"); // бало

$ln2 = $usdata['lvl']-1;
$lvnext2 = $mysql->super_query("SELECT * FROM lvl WHERE `lvl` = '".$ln2."' LIMIT 1"); // нужно для нового

$exp2=round((($usdata['exp']-$lvnext2['exp'])/($lv2['exp']-$lvnext2['exp']))*100,2);


if($usdata['lvl']>=$asd2){ $exp2=100;}




?>
