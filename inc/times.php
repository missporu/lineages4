<?php
 ##########################################
## Автор: Bopo6eu aka 7up                   #                                                                                                                                                                                      ## Сайт: http://on-say.ru                #                 															                      ## ICQ  :  44-67-47-41                      #                 														 		           ## Версия Лицензионная                      #
## Данная версия скрипта является ПЛАТНОЙ,  #
## вы НЕ ИМЕЕТЕ ПРАВА распрострянять данный #
##  скрипт или какие-либо части его кода... #
  #########################################
//Получить название дня недели
$time=time();
$engDay = date('l');

//Определить название дня недели по-русски
switch($engDay){
case 'Monday': $rusDay = 'Понедельник'; break;
case 'Tuesday': $rusDay = 'Вторник'; break;
case 'Wednesday': $rusDay = 'Среда'; break;
case 'Thursday': $rusDay = 'Четверг'; break;
case 'Friday': $rusDay = 'Пятница'; break;
case 'Saturday': $rusDay = 'Суббота'; break;
default: $rusDay = 'Воскресенье'; break;
}

$t=date('H:i:s', $time); // время, +0 - отличие от времени сервера ##
$d=date('j F Y', $time);// дата
$d = str_replace('January','Января',$d);
$d = str_replace('February','Февраля',$d);
$d = str_replace('March','Марта',$d);
$d = str_replace('April','Апреля',$d);
$d = str_replace('May','Мая',$d);
$d = str_replace('June','Июня',$d);
$d = str_replace('July','Июля' ,$d);
$d = str_replace('August','Августа',$d);
$d = str_replace('September','Сентября',$d);
$d = str_replace('October','Октября',$d);
$d = str_replace('November','Ноября',$d);
$d = str_replace('December','Декабря',$d);

$Chas=date('H',$time);
if($Chas==0){$hi='Доброй ночи';}
if($Chas==1){$hi='Доброй ночи';}
if($Chas==2){$hi='Доброй ночи';}
if($Chas==3){$hi='Доброй ночи';}
if($Chas==4){$hi='Доброй ночи';}
if($Chas==5){$hi='Доброе утро';}
if($Chas==6){$hi='Доброе утро';}
if($Chas==7){$hi='Доброе утро';}
if($Chas==8){$hi='Доброе утро';}
if($Chas==9){$hi='Доброе утро';}
if($Chas==10){$hi='Доброе утро';}
if($Chas==11){$hi='Добрый день';}
if($Chas==12){$hi='Добрый день';}
if($Chas==13){$hi='Добрый день';}
if($Chas==14){$hi='Добрый день';}
if($Chas==15){$hi='Добрый день';}
if($Chas==16){$hi='Добрый день';}
if($Chas==17){$hi='Добрый день';}
if($Chas==18){$hi='Добрый вечер';}
if($Chas==19){$hi='Добрый вечер';}
if($Chas==20){$hi='Добрый вечер';}
if($Chas==21){$hi='Добрый вечер';}
if($Chas==22){$hi='Добрый вечер';}
if($Chas==23){$hi='Доброй ночи';}
if($Chas==24){$hi='Доброй ночи';}

$currHour=date('H',$time);///////////
$currDate=date('d F Y', $time);
$curr=date('i:s', $time);
$currTime=date('$currHour:i:s', $time);
$min=date('i', $time);
$sek=date('s', $time);

$currDate = str_replace('January','Января',$currDate);
$currDate = str_replace('February','Февраля',$currDate);
$currDate = str_replace('March','Марта',$currDate);
$currDate = str_replace('April','Апреля',$currDate);
$currDate = str_replace('May','Мая',$currDate);
$currDate = str_replace('June','Июня',$currDate);
$currDate = str_replace('July','Июля',$currDate);
$currDate = str_replace('August','Августа',$currDate);
$currDate = str_replace('September','Сентября',$currDate);
$currDate = str_replace('October','Оkтября',$currDate);
$currDate = str_replace('November','Ноября',$currDate);
$currDate = str_replace('December','Деkабря',$currDate);
$dney        = date ('j');
$mes        = date ('n');

$dney= '1'-$dney-1; //День до kоторого нужно счuтать
$mes= '1'-$mes;  // Месяц до kоторого нужно счuтать
$ch =$currHour+1 ;
/// В данном случае счuтается до 8 марта
if ($dney < 0)
{
$dney = $dney + 31;
$mes = $mes - 1;
}

if ($mes < 0)
{

$mes = $mes + 12;
}

if ($currHour == '0') $chas = 'часa';
if ($currHour == '1') $chas = 'часa';
if ($currHour == '2') $chas = 'час';
if ($currHour == '3') $chas = 'часов';
if ($currHour == '4') $chas = 'часов';
if ($currHour == '5') $chas = 'часов';
if ($currHour == '6') $chas = 'часов';
if ($currHour == '7') $chas = 'часов';
if ($currHour == '8') $chas = 'часов';
if ($currHour == '9') $chas = 'часов';
if ($currHour == '10') $chas = 'часов';
if ($currHour == '11') $chas = 'часов';
if ($currHour == '12') $chas = 'часов';
if ($currHour == '13') $chas = 'часов';
if ($currHour == '14') $chas = 'часов';
if ($currHour == '15') $chas = 'часов';
if ($currHour == '16') $chas = 'часов';
if ($currHour == '17') $chas = 'часов';
if ($currHour == '18') $chas = 'часов';
if ($currHour == '19') $chas = 'часа';
if ($currHour == '20') $chas = 'часа';
if ($currHour == '21') $chas = 'часа';
if ($currHour == '22') $chas = 'час';
if ($currHour == '23') $chas = 'часов';
if ($currHour == '24') $chas = 'часa';
if ($dney == '0') $days = ' дней';
if ($dney == '1') $days = ' день';
if ($dney == '2') $days = ' дня';
if ($dney == '3') $days = ' дня';
if ($dney == '4') $days = ' дня';
if ($dney == '5') $days = ' дней';
if ($dney == '6') $days = ' дней';
if ($dney == '7') $days = ' дней';
if ($dney == '8') $days = ' дней';
if ($dney == '9') $days = ' дней';
if ($dney == '10') $days = ' дней';
if ($dney == '11') $days = ' дней';
if ($dney == '12') $days = ' дней';
if ($dney == '13') $days = ' дней';
if ($dney == '14') $days = ' дней';
if ($dney == '15') $days = ' дней';
if ($dney == '16') $days = ' дней';
if ($dney == '17') $days = ' дней';
if ($dney == '18') $days = ' дней';
if ($dney == '19') $days = ' дней';
if ($dney == '20') $days = ' дней';
if ($dney == '21') $days = ' день';
if ($dney == '22') $days = ' дня';
if ($dney == '23') $days = ' дня';
if ($dney == '24') $days = ' дня';
if ($dney == '25') $days = ' дней';
if ($dney == '26') $days = ' дней';
if ($dney == '27') $days = ' дней';
if ($dney == '28') $days = ' дней';
if ($dney == '29') $days = ' дней';
if ($dney == '30') $days = ' дней';
if ($dney == '31') $days = ' день';


if($date=='01.01')  echo '<b>C Новым годом! Ура!!! %)</b><br/>';
elseif($date=='07.01')  echo '<b>Всех с Рождеством!</b><br/>';
elseif($date=='12.01')  echo '<b>С днем работников прокуратуры!</b><br/>';
elseif($date=='13.01')  echo '<b>С днем печати! Читаем прессу!</b><br/>';
elseif($date=='21.01')  echo '<b>С днем инженерных войск!</b><br/>';
elseif($date=='25.01')  echo '<b>День российских студентов!!! УРА!!!</b><br/>';
elseif($date=='27.01')  echo '<b>С днем таможни<br/></b>';
elseif($date=='08.02')  echo '<b>С днем Российской науки!</b><br/>';
elseif($date=='09.02')  echo '<b>День рождения гражданской авиации</b><br/>';
elseif($date=='10.02')  echo '<b>С днем дипломата!</b><br/>';
elseif($date=='14.02')  echo '<b>C днем всех влюбленных! Ура, друзья!</b><br/>';
elseif($date=='23.02')  echo '<b>C днем защитника Отечества, друзья!</b><br/>';
elseif($date=='03.03')  echo '<b>С днем писателя!</b><br/>';
elseif($date=='08.03')  echo '<b>Милые дамы с 8 Марта вас!</b><br/>';
elseif($date=='13.03')  echo '<b>День работников геодезии и картографии</b><br/>';
elseif($date=='19.03')  echo '<b>С днем подводника!</b><br/>';
elseif($date=='20.03')  echo '<b>С днем работника торговли!</b><br/>';
elseif($date=='21.03')  echo '<b>С днем поэзии!!! Все сочиняем!</b><br/>';
elseif($date=='27.03')  echo '<b>Международный день театра и день МВД ;)</b><br/>';
elseif($date=='01.04')  echo '<b>1 Апреля никому не верь! ;)</b><br/>';
elseif($date=='03.04')  echo '<b>С днем геолога!</b><br/>';
elseif($date=='11.04')  echo '<b>С днем ПВО! Чистого неба!</b><br/>';
elseif($date=='12.04')  echo '<b>С днем космонавтики! 3,2,1, поехали!!!</b><br/>';
elseif($date=='25.04')  echo '<b>Неделя (!) офисного работника :)</b><br/>';
elseif($date=='30.04')  echo '<b>С днем пожарника! Не шалим с огнем!</b><br/>';
elseif($date=='01.05')  echo '<b>С днем Весны и Труда! А ну все работаем ;)</b><br/>';
elseif($date=='07.05')  echo '<b>С днем радио! Все слушаем!</b><br/>';
elseif($date=='09.05')  echo '<b>С днем Великой Победы! Ура! Ура!! Ура!!!</b><br/>';
elseif($date=='12.05')  echo '<b>С днем медсестёр! :)</b><br/>';
elseif($date=='15.05')  echo '<b>Поздравляю всех с днем семьи!</b><br/>';
elseif($date=='17.05')  echo '<b>С днем связи и коммуникаций! Больше общения, ура!</b><br/>';
elseif($date=='18.05')  echo '<b>А сегодня, кстати, день музеев!</b><br/>';
elseif($date=='22.05')  echo '<b>С днем астрономии! Смотрим на звезды...</b><br/>';
elseif($date=='25.05')  echo '<b>С днем филолога! Пишем правильно!</b><br/>';
elseif($date=='27.05')  echo '<b>День библиотек! Все читаем!</b><br/>';
elseif($date=='28.05')  echo '<b>С днем пограничника! Все на замке!</b><br/>';
elseif($date=='29.05')  echo '<b>День химика. Не балуемся с селитрой ;)</b><br/>';
elseif($date=='01.06')  echo '<b>С днем защиты детей!</b><br/>';
elseif($date=='05.06')  echo '<b>День охраны природы! Берегите её, мать вашу</b>!<br/>';
elseif($date=='08.06')  echo '<b>С днем социального работника!</b><br/>';
elseif($date=='12.06')  echo '<b>С днем работника легкой промышленности!</b><br/>';
elseif($date=='19.06')  echo '<b>С днем медицинского работника! Всем здоровья!!!</b><br/>';
elseif($date=='25.06')  echo '<b>С днем изобретателя :)</b><br/>';
elseif($date=='27.06')  echo '<b>С днем молодежи! Ура!!! И с днем рыболовства! :)</b><br/>';
elseif($date=='02.07')  echo '<b>День кооперации! Все объединяемся :)</b><br/>';
elseif($date=='03.07')  echo '<b>День рождения ГИБДД. Что тут добавить...</b><br/>';
elseif($date=='10.07')  echo '<b>С днем российской почты!</b><br/>';
elseif($date=='17.07')  echo '<b>С днем металлурга!</b><br/>';
elseif($date=='29.07')  echo '<b>C днем системного администратора меня ;)</b><br/>';
elseif($date=='31.07')  echo '<b>С днем ВМФ и торговли!</b><br/>';
elseif($date=='02.08')  echo '<b>С днем ВДВ! Лучше я дома останусь...</b><br/>';
elseif($date=='07.08')  echo '<b>С днем железнодорожника!</b><br/>';
elseif($date=='12.08')  echo '<b>С днем ВВС! Удачного полета!!!</b><br/>';
elseif($date=='13.08')  echo '<b>С днем физкультурника! Физкульт ура!!!</b><br/>';
elseif($date=='14.08')  echo '<b>С днем строителя!</b><br/>';
elseif($date=='21.08')  echo '<b>С днем ВМФ! Спокойного моря, попутного ветра!</b><br/>';
elseif($date=='27.08')  echo '<b>День кино! Все в кинотеатры!</b><br/>';
elseif($date=='28.08')  echo '<b>День шахтера. И в забой отправился парень молодой...</b><br/>';
elseif($date=='01.09')  echo '<b>С днем знаний! Знания-сила!!!</b><br/>';
elseif($date=='02.09')  echo '<b>С днем российской гвардии!<br/></b>';
elseif($date=='04.09')  echo '<b>С днем работников нефтегазовой промышленности!</b><br/>';
elseif($date=='09.09')  echo '<b>С днем красоты! Она спасет мир!!</b>!<br/>';
elseif($date=='11.09')  echo '<b>С днем программиста! Принимаю поздравления!<br/>Да, и с днем танкиста еще ;)</b><br/>';
elseif($date=='18.09')  echo '<b>С днем работников леса!</b><br/>';
elseif($date=='21.09')  echo '<b>С днем PR-менеджера!</b><br/>';
elseif($date=='25.09')  echo '<b>С днем машиностроителя!</b><br/>';
elseif($date=='27.09')  echo '<b>Международный день туризма! Все в поход! :)</b><br/>';
elseif($date=='01.10')  echo '<b>С днем музыки! Дружно слушаем музыку!</b><br/>';
elseif($date=='03.10')  echo '<b>С днем врача и архитектора!</b><br/>';
elseif($date=='04.10')  echo '<b>Всемирный день животных! Поздравляю братьев наших меньших!</b><br/>';
elseif($date=='05.10')  echo '<b>С днем учителя! Спасибо нашим учителям!</b><br/>';
elseif($date=='09.10')  echo '<b>Всемирный день почты! Пишите письма ;)<br/>День работников с/х</b><br/>';
elseif($date=='11.10')  echo '<b>Всемирный день борьбы с последствиями стихийных бедствий</b><br/>';
elseif($date=='16.10')  echo '<b>С днем работников пищевой промышленности и дорожного хозяйства!</b><br/>';
elseif($date=='25.10')  echo '<b>С днем таможенника!</b><br/>';
elseif($date=='30.10')  echo '<b>С днем работников автотранспорта!</b><br/>';
elseif($date=='04.11')  echo '<b>День Согласия и Примирения (народного единения)! Соглашаемся и миримся!</b><br/>';
elseif($date=='05.11')  echo '<b>С днем военной разведки!</b><br/>';
elseif($date=='10.11')  echo '<b>С днем милиции! Ура! ;)</b><br/>';
elseif($date=='12.11')  echo '<b>С днем банковского работника!</b><br/>';
elseif($date=='20.11')  echo '<b>С днем ракетных войск и артиллерии!</b><br/>';
elseif($date=='21.11')  echo '<b>С днем налоговых органов РФ!</b><br/>';
elseif($date=='27.11')  echo '<b>С днем матери!<br/>С днем морской пехоты!</b><br/>';
elseif($date=='07.12')  echo '<b>Международный день гражданской авиации!</b><br/>';
elseif($date=='17.12')  echo '<b>С днем РВСН! Ракеты к бою!!</b>!<br/>';
elseif($date=='18.12')  echo '<b>С днем бухгалтера, риэлтора и работника ЗАГС!</b><br/>';
elseif($date=='20.12')  echo '<b>С днем работников органов безопасности РФ!</b><br/>';
elseif($date=='22.12')  echo '<b>С днем энергетика! Не дай бог свет отключат!</b><br/>';
elseif($date=='27.12')  echo '<b>С днем спасателя!</b><br/>';
elseif($date=='31.12')  echo '<b>C наступающим Новым годом!</b><br/>';
echo"$hi <u>$log</u> !<br/><br/>";
echo"Время: ".date("H:i:s")."<br/>";
echo"Дата: $rusDay, $d<br/>";

?>