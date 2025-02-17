<?php
namespace App\Controller;

use App\Controller\ControllerBase;
use App\Model\Favorites;
use App\Model\TourPhotos;
use App\Model\User;
use App\Service\Guard;

class FavoritesController extends ControllerBase
{
    public static function index(): array
    {
        Guard::only_user();
        $files = self::get_files();
        array_push($files['head']['css'], 'favorites');
        array_push($files['foot']['js'], 'favorites/main');

        return [
            ...$files,
        ];
    }
}



