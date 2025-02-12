<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\ProfileController;
$data = ProfileController::index();

Component::render("public/head");
Component::render("users/main");
Component::render("public/foot");
