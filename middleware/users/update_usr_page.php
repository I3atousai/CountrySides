<?php
session_start();

use App\Helpers\Navigate;
use App\Model\User;
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$nickname = $_POST['name'] ?: null;
$phone = $_POST['phone'] ?: null;
$status = $_POST['status'] ?: null;



if (isset($nickname)) {
    User::update(
        ['name' => $nickname],
        [
            ['id', '=', $_SESSION['auth']['id'], 'value']
        ]
    );
    http_response_code(200);
    echo json_encode([
        'message' => "имя успешно обновилось",
    ]);
}

if (isset($phone)) {
    User::update(
        ['phone' => $phone],
        [
            ['id', '=', $_SESSION['auth']['id'], 'value']
        ]
    );
    http_response_code(200);
    echo json_encode([
        'message' => "номер успешно обновился",
    ]);
}
if (isset($status)) {
    User::update(
        ['status' => $status],
        [
            ['id', '=', $_SESSION['auth']['id'], 'value']
        ]
    );
    http_response_code(200);
    echo json_encode([
        'message' => "статус успешно обновился",
    ]);
}
