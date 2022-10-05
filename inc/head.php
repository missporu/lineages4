<?php
date_default_timezone_set('Europe/Moscow');
//session_start();
//ob_start();
//$timeregen = microtime(as_float: TRUE);
require_once 'setting.php';

$req = mysql_query("SELECT * FROM `mesto` WHERE `usr` = '$log' LIMIT 1");
$mestouser = mysql_fetch_assoc($req); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Сказочный мир LineAge IV наполненный чудесами и опасностями, неведомыми монстрами и отважными героями, потрясающими осадами, в которых принимают участие сотни персонажей. Создай клан и поведи свой отряд на штурм замка, сражаясь плечом к плечу с союзниками против общего врага. Взлёты и падения, радость победы и горечь потери, новые друзья и заклятые враги, любовь и ненависть – всё это Вы сможете найти в игровом мире LineAge IV">
    <meta name="keywords" content="войнушка, онлайн-игра, игра онлайн, онлайн, игра, компьютера, мобильного, телефона, играть, браузерная, новая, игрок, ролевая, стратегия"/>
    <meta name="robots" content="all"/>
    <meta name="author" content="misspo">
    <link rel="icon" href="//<?= Site::getDomen() ?>/favicon.ico"><?php
    $page = new Page();
    if (empty($title)) {
        $page->title = $page->name;
    } else $page->setTitle($title);

    echo '<title>' . $page->title . ' </title>'; ?>
    <meta property="og:title" content="<?= $page->title ?>"/>
    <meta property="og:description"
          content="Новая браузерная онлайн-игра, в которую можно играть с компьютера и мобильного телефона!"/>
    <meta property="og:image" content="//<?= Site::getDomen() ?>/images/logotips/logo.jpg"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="400"/>
    <meta property="og:image:height" content="300"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="//<?= Site::getDomen() ?>"/>
    <meta property="og:image:secure_url" content="https://<?= Site::getDomen() ?>"/>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="//<?= Site::getDomen() ?>/theme/osn.css">
    <link rel="stylesheet" href="//<?= Site::getDomen() ?>/theme/frosty.css">
    <link rel="stylesheet" href="//<?= Site::getDomen() ?>/theme/style.css">

    <!-- IE 10 css -->
    <link rel="stylesheet" href="//<?= Site::getDomen() ?>/style/ie10-viewport-bug-workaround.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<table>
    <tr>
        <td class="lt1"></td><td class="t1"><div><b>Lineage IV</b></div></td><td class="rt1">
        </td>
    </tr>
    <tr>
    <td class="l"></td>
    <td class="centertd"><?php

if (isset($_SESSION['info'])) { ?>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $_SESSION['info'] ?>
            </div>
        </div>
    </div>
    </div><?php
    $_SESSION['info'] = NULL;
}

if (isset($_SESSION['error'])) { ?>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $_SESSION['error'] ?>
            </div>
        </div>
    </div>
    </div><?php
    $_SESSION['error'] = NULL;
}

if (isset($_SESSION['ok'])) { ?>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $_SESSION['ok'] ?>
            </div>
        </div>
    </div>
    </div><?php
    $_SESSION['ok'] = NULL;
}