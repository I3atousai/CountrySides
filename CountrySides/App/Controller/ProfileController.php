<?php
namespace App\Controller;

use App\Controller\ControllerBase;
use App\Model\Link;
use App\Model\User;
use App\Service\Guard;

class ProfileController extends ControllerBase
{
    public static function index(): array
    {
        Guard::only_user();
        $files = self::get_files();
        array_push($files['head']['css'], 'profile');
        array_push($files['foot']['js'], 'profile/main');
        array_push($files['foot']['service'], 'file/file');
        $links = Link::query(
            get: ["*"],
            fetch_mode: "all",
            params: [
                ['id_user', "=", $_SESSION['auth']['id'], 'value']
            ]
        );

        $user = User::get_one($_SESSION['auth']['id']);

        return [
            ...$files,
            "user" => $user,
            'links' => $links
        ];
    }
}



