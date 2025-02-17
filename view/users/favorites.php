<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use App\Helpers\Component;
use App\Controller\FavoritesController;
$data = FavoritesController::index();

Component::render("public/head");
Component::render("favorites/main");
Component::render("public/foot");
