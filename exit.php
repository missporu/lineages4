<?php

$headmod = 'exit';//фикс. места
$textl='Выход';
include('inc/path.php');
include($path.'inc/db.php');
include($path.'inc/auth.php');
include($path.'inc/func.php');
include($path.'inc/core.php');
include($path.'inc/head.php');
include($path.'inc/regfunc.php');
include($path.'inc/zag.php');
echo 'Вы действительно хотите выйти?<br/></br>

<a href="/index.php?mod=exit"><span style="color:red">Да</a></span> | <a href="/"><span style="color:green">Нет</a></span><br><br>';
include($path.'inc/foot_text.php');
include($path.'inc/end.php');
?>