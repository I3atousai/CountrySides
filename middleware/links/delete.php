<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

use App\Service\Guard;
use App\Helpers\Navigate;
use App\Model\Link;

Guard::only_user();

$data = $_POST;

$delete = Link::delete([
    ['id', '=', $data['id'], 'value'],
]);

// unlink("../../links/" . $data['short_link']);
if (!$delete) {
    die("Ссылка не удалена");
}

Navigate::view("users/profile", mode: "redirect");






