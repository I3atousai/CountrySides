<?php

use App\Helpers\Navigate;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <?php
    foreach ($data['head']['css'] as $file) { ?>
        <link rel="stylesheet" href="<?php Navigate::css($file) ?>">
    <?php } ?>

    <?php
    foreach ($data['head']['service'] as $file) { ?>
        <script src="<?php Navigate::service($file) ?>"></script>
    <?php } ?>

    <?php
    foreach ($data['head']['js'] as $file) { ?>
        <script src="<?php Navigate::js($file) ?>"></script>
    <?php } ?>

    <title>CountrySides</title>
</head>

<body>
    <header>
        
        <img class="logo_head" src="<?php Navigate::image("public/logo.png") ?>" alt="" />
        <a class="bold fs24" href="<?php Navigate::link('index') ?>">Главная Страница</a>
        <?php if (!isset($_SESSION['auth'])) {?>
            <a class="bold fs24" href="<? Navigate::view('public/choice') ?>">Вход/Регистрация</a>
            <?php } else {?>
                <a class="bold fs24" href="<? Navigate::view('users/favorites') ?>">Избранное</a>
                
                <a class="bold fs24" href="<? Navigate::view('users/profile') ?>">Мой Профиль</a>
        <?php }?>
    </header>