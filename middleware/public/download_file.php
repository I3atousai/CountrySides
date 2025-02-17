<?php
session_start();

use App\Helpers\Navigate;
use App\Model\User;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$file = $_FILES['file'];
$path = $_POST['path'];

$type = $file['type'];
$type = explode('/', $type)[1];
$new_name = "PHOTO-" . rand(0, 999999) . ".$type";
$new_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/image/$path/$new_name";
$url = Navigate::$URL . "/assets/image/$path/$new_name";

if (move_uploaded_file($file["tmp_name"], $new_path)) {
    if ($path == "users") {
        User::update(
            ['avatar' => $new_name],
            [
                ['id', '=', $_SESSION['auth']['id'], 'value']
            ]
        );
    }
    http_response_code(200);
    echo json_encode([
        'message' => "Файл успешно скачен",
        'url' => $url
    ]);
    exit();
}

http_response_code(400);
echo json_encode([
    'message' => "Не удалось скачать файл",
]);


