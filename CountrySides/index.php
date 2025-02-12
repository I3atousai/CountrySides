<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use App\Controller\IndexController;
use App\Helpers\Component;
$data = IndexController::index();

Component::render("public/head");
Component::render("index/main");
Component::render("public/foot");