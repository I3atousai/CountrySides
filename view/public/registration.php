<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\RegistrationController;

$data = RegistrationController::index();

Component::render("public/head");
Component::render("registration/main");
Component::render("public/foot");