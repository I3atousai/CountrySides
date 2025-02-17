<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\RecoveryController;

$data = RecoveryController::index();

Component::render("public/head");
Component::render("public/recovery");
Component::render("public/foot");
 