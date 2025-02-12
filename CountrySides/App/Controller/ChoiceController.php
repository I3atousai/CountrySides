<?php
namespace App\Controller;

class ChoiceController extends ControllerBase
{
    public static function index(): array
    {
        $files = self::get_files();
        array_push($files['foot']['js'], 'choice/main');
        array_push($files['head']['css'], 'choice');
        return [
            ...$files
        ];
    }
}



