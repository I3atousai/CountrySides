<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Helpers\Component;
use App\Controller\InstructionController;

$data = InstructionController::index();

Component::render("public/head");
Component::render("public/instruction");
Component::render("public/foot");
