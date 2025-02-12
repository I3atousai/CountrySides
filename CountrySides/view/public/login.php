<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\LoginController;

$data = LoginController::index();

Component::render("public/head");
Component::render("login/main");
Component::render("public/foot");
