<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use App\Model\User;
use App\Helpers\Navigate;
use App\Service\Guard;

// Валидация
Guard::only_guest();

$_POST['password_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
$_POST['role'] = 'user';
unset($_POST['password']);

$add = User::add($_POST);

if ($add) {
    Navigate::view("public/login", [], "redirect");
} else {
    echo "Не удалось добавить пользователя, или такой пользователь уже существует";
}
