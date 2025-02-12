<?php

namespace App\Service;

use App\Helpers\Navigate;
session_start();

class Guard
{
    public static function only_guest()
    {
        if (isset($_SESSION['auth']) && ($_SESSION['auth']['role'] == "user" ||  $_SESSION['auth']['role'] == "guide")) {
            Navigate::view("users/profile", [], "redirect");
        }
        if (isset($_SESSION['auth']) && $_SESSION['auth']['role'] == "admin") {
            Navigate::view("admins/profile", [], "redirect");
        }
    }
    public static function only_user()
    {
        if (!isset($_SESSION['auth'])) {
            Navigate::view("public/login", [], "redirect");
        }
        if (isset($_SESSION['auth']) && $_SESSION['auth']['role'] == "admin") {
            Navigate::view("admins/profile", [], "redirect");
        }
    }

    public static function only_user_api()
    {
        if (!isset($_SESSION['auth']) || $_SESSION['auth']['role'] != 'user') {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            die();
        }
    }

    public static function only_admin()
    {
        if (!isset($_SESSION['auth'])) {
            Navigate::view("public/login", [], "redirect");
        }
        if (isset($_SESSION['auth']) && $_SESSION['auth']['role'] == "user") {
            Navigate::view("users/profile", [], "redirect");
        }
    }
}
