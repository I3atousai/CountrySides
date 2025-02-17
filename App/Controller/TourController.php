<?php
namespace App\Controller;
session_start();
use App\Model\Tour;
use App\Model\TourPhotos;

class TourController extends ControllerBase
{
    public static function index(): array
    {

        $files = self::get_files();
        array_push($files['foot']['js'], 'tour/main');
        array_push($files['head']['css'], 'tour');

        $tour = Tour::get_one($_GET["id"]);
        $images = TourPhotos::query(
            get: ['image'],
            params: [
                ['id_tour', '=', $tour['id'], 'value']
            ]
        );
        $tour['images'] = $images;
        

        return [
            ...$files,
            "tour" => $tour
        ];
    }
}



