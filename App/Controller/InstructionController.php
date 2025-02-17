<?php
namespace App\Controller;

class InstructionController extends ControllerBase
{
    public static function index(): array
    {
        $files = self::get_files();
        array_push($files['foot']['js'], 'index/main');
        array_push($files['head']['css'], 'instruction');
        return [
            ...$files
        ];
    }
}



