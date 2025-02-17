<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Controller\ChoiceController;
use App\Helpers\Component;

$data = ChoiceController::index();


Component::render("public/head");
Component::render("choice/main");
Component::render("public/foot");

