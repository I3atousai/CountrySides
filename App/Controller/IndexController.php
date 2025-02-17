<?php
namespace App\Controller;

use App\Controller\ControllerBase;
use App\Model\Tour;
use App\Model\TourPhotos;

class IndexController extends ControllerBase
{
    public static function index(): array
    {
        
        $files = self::get_files();
        array_push($files['head']['css'], 'index');
        array_push($files['foot']['js'], 'index/main');

       

        return [
            ...$files,
        ];
    }
}



