<?php


$asd = mysql_num_rows(mysql_query("SELECT * FROM lvl")); // ������� �������
$lv = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$udata[lvl]' LIMIT 1")); // ����

$ln = $udata[lvl]-1;
$lvnext = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$ln' LIMIT 1")); // ����� ��� ������

$exp=round((($udata[exp]-$lvnext[exp])/($lv[exp]-$lvnext[exp]))*100,2);

if($exp>"100"){ $exp="100";}

if($udata[lvl]>=$asd){ $exp="100";}

//--------------------search ---�������� ���� ������������----------------------

$asd2 = mysql_num_rows(mysql_query("SELECT * FROM lvl")); // ������� �������
$lv2 = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$usdata[lvl]' LIMIT 1")); // ����

$ln2 = $usdata[lvl]-1;
$lvnext2 = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$ln2' LIMIT 1")); // ����� ��� ������

$exp2=round((($usdata[exp]-$lvnext2[exp])/($lv2[exp]-$lvnext2[exp]))*100,2);


if($usdata[lvl]>=$asd2){ $exp2=100;}



?>
