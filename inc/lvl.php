<?php

$isfffgfgthfg = 0;
while ($isfffgfgthfg < 1){

$new_lvl = 'no';

//if ($udata[usr]==MagPC){
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lv = mysql_fetch_array(mysql_query("SELECT * FROM lvl WHERE `lvl` = '$udata[lvl]' LIMIT 1"));

if (!empty($lv[exp])){
if($udata[exp]>=$lv[exp]){ 
$new_lvl='yes';
}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//}


/// �������� �����. ���� ����� ������� �� ��������� �������, �� ������ �� �������
//$req = mysql_query("SELECT lvl FROM `sab` WHERE usr='$log' ORDER BY lvl DESC LIMIT 1");
//$usr = mysql_fetch_array($req); if (empty($usr[lvl])){$usr[lvl]=1;}

if ($usr[lvl] < $udata[lvl]){

		$paty = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' Limit 1");
		$usr = mysql_fetch_array($paty);

$hp = $usr[hpall]+$usr[lvl];		
$mp = $usr[mpall]+$usr[lvl];		

if ($udata[klas]=="wizard") { // ���� ���
$patt = $usr[patt]+$usr[lvl]*0.03;
$matt = $usr[matt]+$usr[lvl]*0.08;
$pdef = $usr[pdef]+$usr[lvl]*0.03;
$mdef = $usr[mdef]+$usr[lvl]*0.08;
} 
if ($udata[klas]=="fighert") { // ���� ����
$patt = $usr[patt]+$usr[lvl]*0.03;
$matt = $usr[matt]+$usr[lvl]*0.02;
$pdef = $usr[pdef]+$usr[lvl]*0.09;
$mdef = $usr[mdef]+$usr[lvl]*0.02;
} 

$skill = 3;
$lk4584 = 100;}
else{
		$paty = mysql_query("SELECT * FROM `users` WHERE `usr` = '$log' Limit 1");
		$usr = mysql_fetch_array($paty);

$hp = $usr[hpall];		
$mp = $usr[mpall];		

if ($udata[klas]=="wizard") { // ���� ���
$patt = $usr[patt];
$matt = $usr[matt];
$pdef = $usr[pdef];
$mdef = $usr[mdef];
} 
if ($udata[klas]=="fighert") { // ���� ����
$patt = $usr[patt];
$matt = $usr[matt];
$pdef = $usr[pdef];
$mdef = $usr[mdef];
} 

$lk4584 = 1;}


		
if($new_lvl==yes){
$udata[lvl]=$udata[lvl]+1;
$udata[skill]=$udata[skill]+$skill;
$mon7=$udata[lvl]*$lk4584;
$money=$udata[money]+$mon7;
mysql_query("UPDATE users SET 
lvl = '$udata[lvl]',
hp = '$hp',
mp = '$mp',
hpall = '$hp',
mpall = '$mp',
patt = '$patt',
matt = '$matt',
pdef = '$pdef',
money = '$money',
mdef = '$mdef',
skill='$udata[skill]' WHERE usr = '$log' LIMIT 1");
//mysql_query("UPDATE users SET money = '$money' WHERE usr = '$log'");
}else{$isfffgfgthfg = 10;}

}








$req = mysql_query("SELECT * FROM `pit` WHERE `usr` = '$log' and `status` = 'on'");
$avto=mysql_num_rows($req);
if($avto==1){
$pit = mysql_fetch_array($req);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=30000 && $pit[lvl]=="0"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=100000 && $pit[lvl]=="1"){
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=210000 && $pit[lvl]=="2"){
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=420000 && $pit[lvl]=="3"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=840000 && $pit[lvl]=="4"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1700000 && $pit[lvl]=="5"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=3400000 && $pit[lvl]=="6"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=6800000 && $pit[lvl]=="7"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=13000000 && $pit[lvl]=="8"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=22973000 && $pit[lvl]=="9"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=30475000 && $pit[lvl]=="10"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=39516000 && $pit[lvl]=="11"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=50261000 && $pit[lvl]=="12"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=62876000 && $pit[lvl]=="13"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=77537000 && $pit[lvl]=="14"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=94421000 && $pit[lvl]=="15"){
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=113712000 && $pit[lvl]=="16"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=135596000 && $pit[lvl]=="17"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=160267000 && $pit[lvl]=="18"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=187921000 && $pit[lvl]=="19"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=218736000 && $pit[lvl]=="20"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=252997000 && $pit[lvl]=="21"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=290836000 && $pit[lvl]=="22"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=332947000 && $pit[lvl]=="23"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=378201000 && $pit[lvl]=="24"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=428174000 && $pit[lvl]=="25"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=482647000 && $pit[lvl]=="26"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=541856000 && $pit[lvl]=="27"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=606042000 && $pit[lvl]=="28"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=675402000 && $pit[lvl]=="29"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=750330000 && $pit[lvl]=="30"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=830937000 && $pit[lvl]=="31"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=917532000 && $pit[lvl]=="32"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1010337000 && $pit[lvl]=="33"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1109337000 && $pit[lvl]=="34"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1215996000 && $pit[lvl]=="35"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1329323000 && $pit[lvl]=="36"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1449373000 && $pit[lvl]=="37"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=1577978000 && $pit[lvl]=="38"){ 
$new_lvl_pit='yes';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($pit[exp]>=2000000000 && $pit[lvl]=="39"){
$new_lvl_pit='yes';
}
if($pit[exp]>=2500000000 && $pit[lvl]=="40"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3000000000 && $pit[lvl]=="41"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3500000000 && $pit[lvl]=="42"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4000000000 && $pit[lvl]=="43"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4500000000 && $pit[lvl]=="44"){
$new_lvl_pit='yes';
}
if($pit[exp]>=5000000000 && $pit[lvl]=="45"){
$new_lvl_pit='yes';
}
if($pit[exp]>=5500000000 && $pit[lvl]=="46"){
$new_lvl_pit='yes';
}
if($pit[exp]>=6000000000 && $pit[lvl]=="47"){
$new_lvl_pit='yes';
}
if($pit[exp]>=6500000000 && $pit[lvl]=="48"){
$new_lvl_pit='yes';
}
if($pit[exp]>=7000000000 && $pit[lvl]=="49"){
$new_lvl_pit='yes';
}
if($pit[exp]>=10000000000 && $pit[lvl]=="50"){
$new_lvl_pit='yes';
}
if($pit[exp]>=10000000000 && $pit[lvl]=="51"){
$new_lvl_pit='yes';
}
if($pit[exp]>=11000000000 && $pit[lvl]=="52"){
$new_lvl_pit='yes';
}
if($pit[exp]>=12000000000 && $pit[lvl]=="53"){
$new_lvl_pit='yes';
}
if($pit[exp]>=13000000000 && $pit[lvl]=="54"){
$new_lvl_pit='yes';
}
if($pit[exp]>=14000000000 && $pit[lvl]=="55"){
$new_lvl_pit='yes';
}
if($pit[exp]>=15000000000 && $pit[lvl]=="56"){
$new_lvl_pit='yes';
}
if($pit[exp]>=16000000000 && $pit[lvl]=="57"){
$new_lvl_pit='yes';
}
if($pit[exp]>=17000000000 && $pit[lvl]=="58"){
$new_lvl_pit='yes';
}
if($pit[exp]>=18000000000 && $pit[lvl]=="59"){
$new_lvl_pit='yes';
}
if($pit[exp]>=19000000000 && $pit[lvl]=="60"){
$new_lvl_pit='yes';
}
if($pit[exp]>=20000000000 && $pit[lvl]=="61"){
$new_lvl_pit='yes';
}
if($pit[exp]>=21000000000 && $pit[lvl]=="62"){
$new_lvl_pit='yes';
}
if($pit[exp]>=22000000000 && $pit[lvl]=="63"){
$new_lvl_pit='yes';
}
if($pit[exp]>=23000000000 && $pit[lvl]=="64"){
$new_lvl_pit='yes';
}
if($pit[exp]>=24000000000 && $pit[lvl]=="65"){
$new_lvl_pit='yes';
}
if($pit[exp]>=25000000000 && $pit[lvl]=="66"){
$new_lvl_pit='yes';
}
if($pit[exp]>=26000000000 && $pit[lvl]=="67"){
$new_lvl_pit='yes';
}
if($pit[exp]>=27000000000 && $pit[lvl]=="68"){
$new_lvl_pit='yes';
}
if($pit[exp]>=28000000000 && $pit[lvl]=="69"){
$new_lvl_pit='yes';
}
if($pit[exp]>=29000000000 && $pit[lvl]=="70"){
$new_lvl_pit='yes';
}
if($pit[exp]>=30000000000 && $pit[lvl]=="71"){
$new_lvl_pit='yes';
}
if($pit[exp]>=31000000000 && $pit[lvl]=="72"){
$new_lvl_pit='yes';
}
if($pit[exp]>=32000000000 && $pit[lvl]=="73"){
$new_lvl_pit='yes';
}
if($pit[exp]>=33000000000 && $pit[lvl]=="74"){
$new_lvl_pit='yes';
}
if($pit[exp]>=34000000000 && $pit[lvl]=="75"){
$new_lvl_pit='yes';
}
if($pit[exp]>=35000000000 && $pit[lvl]=="76"){
$new_lvl_pit='yes';
}
if($pit[exp]>=36000000000 && $pit[lvl]=="77"){
$new_lvl_pit='yes';
}
if($pit[exp]>=37000000000 && $pit[lvl]=="78"){
$new_lvl_pit='yes';
}
if($pit[exp]>=38000000000 && $pit[lvl]=="79"){
$new_lvl_pit='yes';
}
if($pit[exp]>=39000000000 && $pit[lvl]=="80"){
$new_lvl_pit='yes';
}
if($pit[exp]>=40000000000 && $pit[lvl]=="81"){
$new_lvl_pit='yes';
}
if($pit[exp]>=41000000000 && $pit[lvl]=="82"){
$new_lvl_pit='yes';
}if($pit[exp]>=4200000000 && $pit[lvl]=="83"){
$new_lvl_pit='yes';
}
if($pit[exp]>=43000000000 && $pit[lvl]=="84"){
$new_lvl_pit='yes';
}
if($pit[exp]>=44000000000 && $pit[lvl]=="85"){
$new_lvl_pit='yes';
}
if($pit[exp]>=45000000000 && $pit[lvl]=="86"){
$new_lvl_pit='yes';
}
if($pit[exp]>=46000000000 && $pit[lvl]=="87"){
$new_lvl_pit='yes';
}
if($pit[exp]>=47000000000 && $pit[lvl]=="88"){
$new_lvl_pit='yes';
}
if($pit[exp]>=48000000000 && $pit[lvl]=="89"){
$new_lvl_pit='yes';
}
if($pit[exp]>=99000000000 && $pit[lvl]=="90"){
$new_lvl_pit='yes';
}
if($pit[exp]>=150000000000 && $pit[lvl]=="91"){
$new_lvl_pit='yes';
}
if($pit[exp]>=200000000000 && $pit[lvl]=="92"){
$new_lvl_pit='yes';
}
if($pit[exp]>=300000000000 && $pit[lvl]=="93"){
$new_lvl_pit='yes';
}
if($pit[exp]>=400000000000 && $pit[lvl]=="94"){
$new_lvl_pit='yes';
}
if($pit[exp]>=600000000000 && $pit[lvl]=="95"){
$new_lvl_pit='yes';
}
if($pit[exp]>=800000000000 && $pit[lvl]=="96"){
$new_lvl_pit='yes';
}
if($pit[exp]>=1000000000000 && $pit[lvl]=="97"){
$new_lvl_pit='yes';
}
if($pit[exp]>=1200000000000 && $pit[lvl]=="98"){
$new_lvl_pit='yes';
}
if($pit[exp]>=1400000000000 && $pit[lvl]=="99"){
$new_lvl_pit='yes';
}
if($pit[exp]>=1600000000000 && $pit[lvl]=="100"){
$new_lvl_pit='yes';
}
if($pit[exp]>=1800000000000 && $pit[lvl]=="101"){
$new_lvl_pit='yes';
}
if($pit[exp]>=2000000000000 && $pit[lvl]=="102"){
$new_lvl_pit='yes';
}
if($pit[exp]>=2200000000000 && $pit[lvl]=="103"){
$new_lvl_pit='yes';
}
if($pit[exp]>=2400000000000 && $pit[lvl]=="104"){
$new_lvl_pit='yes';
}
if($pit[exp]>=2600000000000 && $pit[lvl]=="105"){
$new_lvl_pit='yes';
}
if($pit[exp]>=2800000000000 && $pit[lvl]=="106"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3000000000000 && $pit[lvl]=="107"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3200000000000 && $pit[lvl]=="108"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3400000000000 && $pit[lvl]=="109"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3600000000000 && $pit[lvl]=="110"){
$new_lvl_pit='yes';
}
if($pit[exp]>=3800000000000 && $pit[lvl]=="111"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4000000000000 && $pit[lvl]=="112"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4200000000000 && $pit[lvl]=="113"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4400000000000 && $pit[lvl]=="114"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4600000000000 && $pit[lvl]=="115"){
$new_lvl_pit='yes';
}
if($pit[exp]>=4800000000000 && $pit[lvl]=="116"){
$new_lvl_pit='yes';
}
if($pit[exp]>=5000000000000 && $pit[lvl]=="117"){
$new_lvl_pit='yes';
}
if($pit[exp]>=5200000000000 && $pit[lvl]=="118"){
$new_lvl_pit='yes';
}
if($pit[exp]>=5400000000000 && $pit[lvl]=="119"){
$new_lvl_pit='yes';
}
if($pit[exp]>=5800000000000 && $pit[lvl]=="120"){
$new_lvl_pit='yes';
}
if($pit[exp]>=6200000000000 && $pit[lvl]=="121"){
$new_lvl_pit='yes';
}
if($pit[exp]>=6600000000000 && $pit[lvl]=="122"){
$new_lvl_pit='yes';
}
if($pit[exp]>=7000000000000 && $pit[lvl]=="123"){
$new_lvl_pit='yes';
}
if($pit[exp]>=7400000000000 && $pit[lvl]=="124"){
$new_lvl_pit='yes';
}
if($pit[exp]>=7800000000000 && $pit[lvl]=="125"){
$new_lvl_pit='yes';
}
if($pit[exp]>=8200000000000 && $pit[lvl]=="126"){
$new_lvl_pit='yes';
}
if($pit[exp]>=8600000000000 && $pit[lvl]=="127"){
$new_lvl_pit='yes';
}
if($pit[exp]>=9000000000000 && $pit[lvl]=="128"){
$new_lvl_pit='yes';
}
if($pit[exp]>=9400000000000 && $pit[lvl]=="129"){
$new_lvl_pit='yes';
}
if($pit[exp]>=9800000000000 && $pit[lvl]=="130"){
$new_lvl_pit='yes';
}
if($pit[exp]>=10200000000000 && $pit[lvl]=="131"){
$new_lvl_pit='yes';
}
if($pit[exp]>=10600000000000 && $pit[lvl]=="132"){
$new_lvl_pit='yes';
}
if($pit[exp]>=11000000000000 && $pit[lvl]=="133"){
$new_lvl_pit='yes';
}
if($pit[exp]>=11400000000000 && $pit[lvl]=="134"){
$new_lvl_pit='yes';
}
if($pit[exp]>=11800000000000 && $pit[lvl]=="135"){
$new_lvl_pit='yes';
}
if($pit[exp]>=12400000000000 && $pit[lvl]=="136"){
$new_lvl_pit='yes';
}
if($pit[exp]>=12800000000000 && $pit[lvl]=="137"){
$new_lvl_pit='yes';
}
if($pit[exp]>=13200000000000 && $pit[lvl]=="138"){
$new_lvl_pit='yes';
}
if($pit[exp]>=13600000000000 && $pit[lvl]=="139"){
$new_lvl_pit='yes';
}
if($pit[exp]>=17100000000000 && $pit[lvl]=="140"){
$new_lvl_pit='yes';
}
if($pit[exp]>=17500000000000 && $pit[lvl]=="141"){
$new_lvl_pit='yes';
}
if($pit[exp]>=18000000000000 && $pit[lvl]=="142"){
$new_lvl_pit='yes';
}
if($pit[exp]>=18500000000000 && $pit[lvl]=="143"){
$new_lvl_pit='yes';
}
if($pit[exp]>=19000000000000 && $pit[lvl]=="144"){
$new_lvl_pit='yes';
}
if($pit[exp]>=19500000000000 && $pit[lvl]=="145"){
$new_lvl_pit='yes';
}
if($pit[exp]>=20000000000000 && $pit[lvl]=="146"){
$new_lvl_pit='yes';
}
if($pit[exp]>=20500000000000 && $pit[lvl]=="147"){
$new_lvl_pit='yes';
}
if($pit[exp]>=21000000000000 && $pit[lvl]=="148"){
$new_lvl_pit='yes';
}
if($pit[exp]>=21500000000000 && $pit[lvl]=="149"){
$new_lvl_pit='yes';
}
if($pit[exp]>=22000000000000 && $pit[lvl]=="150"){
$new_lvl_pit='yes';
}
if($pit[exp]>=22500000000000 && $pit[lvl]=="151"){
$new_lvl_pit='yes';
}
if($pit[exp]>=23000000000000 && $pit[lvl]=="152"){
$new_lvl_pit='yes';
}
if($pit[exp]>=23500000000000 && $pit[lvl]=="153"){
$new_lvl_pit='yes';
}
if($pit[exp]>=24000000000000 && $pit[lvl]=="154"){
$new_lvl_pit='yes';
}
if($pit[exp]>=24500000000000 && $pit[lvl]=="155"){
$new_lvl_pit='yes';
}
if($pit[exp]>=25000000000000 && $pit[lvl]=="156"){
$new_lvl_pit='yes';
}
if($pit[exp]>=25500000000000 && $pit[lvl]=="157"){
$new_lvl_pit='yes';
}
if($pit[exp]>=26000000000000 && $pit[lvl]=="158"){
$new_lvl_pit='yes';
}
if($pit[exp]>=26500000000000 && $pit[lvl]=="159"){
$new_lvl_pit='yes';
}
if($pit[exp]>=27000000000000 && $pit[lvl]=="160"){
$new_lvl_pit='yes';
}
if($pit[exp]>=28000000000000 && $pit[lvl]=="161"){
$new_lvl_pit='yes';
}
if($pit[exp]>=29000000000000 && $pit[lvl]=="162"){
$new_lvl_pit='yes';
}
if($pit[exp]>=30000000000000 && $pit[lvl]=="163"){
$new_lvl_pit='yes';
}
if($pit[exp]>=31000000000000 && $pit[lvl]=="164"){
$new_lvl_pit='yes';
}
if($pit[exp]>=32000000000000 && $pit[lvl]=="165"){
$new_lvl_pit='yes';
}
if($pit[exp]>=33000000000000 && $pit[lvl]=="166"){
$new_lvl_pit='yes';
}
if($pit[exp]>=34000000000000 && $pit[lvl]=="167"){
$new_lvl_pit='yes';
}
if($pit[exp]>=35000000000000 && $pit[lvl]=="168"){
$new_lvl_pit='yes';
}
if($pit[exp]>=36000000000000 && $pit[lvl]=="169"){
$new_lvl_pit='yes';
}
if($pit[exp]>=37000000000000 && $pit[lvl]=="170"){
$new_lvl_pit='yes';
}
if($pit[exp]>=38000000000000 && $pit[lvl]=="171"){
$new_lvl_pit='yes';
}
if($pit[exp]>=39000000000000 && $pit[lvl]=="172"){
$new_lvl_pit='yes';
}
if($pit[exp]>=40000000000000 && $pit[lvl]=="173"){
$new_lvl_pit='yes';
}
if($pit[exp]>=41000000000000 && $pit[lvl]=="174"){
$new_lvl_pit='yes';
}
if($pit[exp]>=42000000000000 && $pit[lvl]=="175"){
$new_lvl_pit='yes';
}
if($pit[exp]>=43000000000000 && $pit[lvl]=="176"){
$new_lvl_pit='yes';
}
if($pit[exp]>=44000000000000 && $pit[lvl]=="177"){
$new_lvl_pit='yes';
}
if($pit[exp]>=45000000000000 && $pit[lvl]=="178"){
$new_lvl_pit='yes';
}
if($pit[exp]>=46000000000000 && $pit[lvl]=="179"){
$new_lvl_pit='yes';
}
if($pit[exp]>=47000000000000 && $pit[lvl]=="180"){
$new_lvl_pit='yes';
}
if($pit[exp]>=48000000000000 && $pit[lvl]=="181"){
$new_lvl_pit='yes';
}
if($pit[exp]>=49000000000000 && $pit[lvl]=="182"){
$new_lvl_pit='yes';
}
if($pit[exp]>=50000000000000 && $pit[lvl]=="183"){
$new_lvl_pit='yes';
}
if($pit[exp]>=51000000000000 && $pit[lvl]=="184"){
$new_lvl_pit='yes';
}
if($pit[exp]>=52000000000000 && $pit[lvl]=="185"){
$new_lvl_pit='yes';
}
if($pit[exp]>=53000000000000 && $pit[lvl]=="186"){
$new_lvl_pit='yes';
}
if($pit[exp]>=54000000000000 && $pit[lvl]=="187"){
$new_lvl_pit='yes';
}
if($pit[exp]>=55000000000000 && $pit[lvl]=="188"){
$new_lvl_pit='yes';
}
if($pit[exp]>=56000000000000 && $pit[lvl]=="189"){
$new_lvl_pit='yes';
}
if($pit[exp]>=57000000000000 && $pit[lvl]=="190"){
$new_lvl_pit='yes';
}
if($pit[exp]>=58000000000000 && $pit[lvl]=="191"){
$new_lvl_pit='yes';
}
if($pit[exp]>=59000000000000 && $pit[lvl]=="192"){
$new_lvl_pit='yes';
}
if($pit[exp]>=60000000000000 && $pit[lvl]=="193"){
$new_lvl_pit='yes';
}
if($pit[exp]>=61000000000000 && $pit[lvl]=="194"){
$new_lvl_pit='yes';
}
if($pit[exp]>=62000000000000 && $pit[lvl]=="195"){
$new_lvl_pit='yes';
}
if($pit[exp]>=63000000000000 && $pit[lvl]=="196"){
$new_lvl_pit='yes';
}
if($pit[exp]>=64000000000000 && $pit[lvl]=="197"){
$new_lvl_pit='yes';
}
if($pit[exp]>=65000000000000 && $pit[lvl]=="198"){
$new_lvl_pit='yes';
}
if($pit[exp]>=66000000000000 && $pit[lvl]=="199"){
$new_lvl_pit='yes';
}
if($pit[exp]>=90000000000 && $pit[lvl]=="200"){
$new_lvl_pit='no';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($new_lvl_pit==yes){
$pit[lvl]=$pit[lvl]+1;
$pit[skill]=$pit[skill]+3;
$pit[sila]=$pit[sila]+25;
$pit[prot]=$pit[prot]+25;
$pit[hp]=$pit[hp]+200;
$pit[hpall]=$pit[hpall]+200;

mysql_query("UPDATE pit SET lvl = '$pit[lvl]',skill='$pit[skill]',sila='$pit[sila]',prot='$pit[prot]',hp='$pit[hp]',hpall='$pit[hpall]' WHERE usr = '$log' and `status` = 'on' LIMIT 1");
}
}
////////////////////////
//////////////////////////////


?>