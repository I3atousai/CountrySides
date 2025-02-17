<?php 

namespace App\Helpers;

class Component{

    public static function render(string $path): void{
        global $data;
        require $_SERVER['DOCUMENT_ROOT'] . "/components/$path.php";
    }

}
