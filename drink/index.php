<?php

$headmod = 'gm_panel';//фикс. места

$textl='GM-Panel';
///////////////////////
	$path='../';			//
//////////////////////
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/zag.php');

echo '<div class="news"><b>Календарь поводов выпить</b></div>';

echo '<div class="menu">';

echo 'Главное, чтобы была компания хорошая, а повод, как вы сами видите всегда найдется)))<br/><br/>';

echo "<form action='data.php' method='post'>
 Выберите число: <br/>
<select name='chislo'>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
<option value='4'>4</option>
<option value='5'>5</option>
<option value='6'>6</option>
<option value='7'>7</option>
<option value='8'>8</option>
<option value='9'>9</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select><br/><br/>

 Выберите месяц:<br/>
<select name='mes'>
<option value='January'>январь</option>
<option value='February'>февраль</option>
<option value='March'>март</option>
<option value='April'>апрель</option>
<option value='May'>май</option>
<option value='June'>июнь</option>
<option value='July'>июль</option>
<option value='August'>август</option>
<option value='September'>сентябрь</option>
<option value='October'>октябрь</option>
<option value='November'>ноябрь</option>
<option value='December'>декабрь</option>
</select><br/><br/>

<input type='submit' value='Узнать!' /></form>";



echo '</div>';

echo '<a href="/index.php">Назад</a>';
include($path.'inc/down.php');
?>




























