<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use App\Service\Guard;
use App\Model\Favorites;

Guard::only_user_api();

$fav = Favorites::query(
    get: ['*'],
    params: [
        ['id_tour', '=', $_POST['id_tour'], 'value', "AND"],
        ['id_user', '=', $_SESSION['auth']['id'], 'value']
        ]
);
if ($fav) {
    Favorites::delete([
        ['id_tour', '=', $_POST['id_tour'], 'value', "AND"],
        ['id_user', '=', $_SESSION['auth']['id'], 'value']
    ]);
}else {
    $add = Favorites::add($_POST);
    if (!$add) {
        die("Пост не добавлен");
    }
}



