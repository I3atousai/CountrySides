<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Controller\TourController;
use App\Helpers\Component;

$data = TourController::index();


Component::render("public/head");
Component::render("tour/main");
Component::render("public/foot");

