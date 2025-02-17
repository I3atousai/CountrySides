<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Service\Guard;
use App\Helpers\Navigate;

Guard::only_user();

unset($_SESSION['auth']);

Navigate::view("public/login", [], "redirect");






