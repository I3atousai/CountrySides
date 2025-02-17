<?php

namespace App\Controller;
use App\Helpers\Navigate;

class ControllerBase
{
    public static function get_params(array $required = []): array
    {
        foreach ($required as $key) {
            if (!isset($_GET[$key]) || $_GET[$key] == "") {
                Navigate::link("index.php", [], "redirect");
            }
        }
        return $_GET;
    }

    public static function get_files(): array
    {
        $head = [
            'css' => ['reset'],
            'js' => [],
            'service' => []
        ];
        $foot = [
            'css' => [],
            'js' => ['public/main'],
            'service' => []
        ];
        return [
            'head' => $head,
            'foot' => $foot
        ];
    }

}