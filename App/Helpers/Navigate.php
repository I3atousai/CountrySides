<?php

namespace App\Helpers;

class Navigate
{
    public static string $URL = "http://countrysides";

    public static function css(string $file, string $mode = "echo")
    {
        $link = self::$URL . "/assets/css/$file.css";
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        }
    }

    public static function js(string $file, string $mode = "echo")
    {
        $link = self::$URL . "/assets/js/$file.js";
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        }
    }

    public static function service(string $file, string $mode = "echo")
    {
        $link = self::$URL . "/assets/service/$file.js";
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        }
    }

    public static function image(string $file, string $mode = "echo")
    {
        $link = self::$URL . "/assets/image/$file";
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        }
    }

    public static function view(string $path, array $params = [], string $mode = "echo")
    {
        $link = self::$URL . "/view/$path";
        if ($params) {
            $link .= "?";
            foreach ($params as $key => $value) {
                $link .= "$key=$value&";
            }
            $link = substr($link, 0, -1);
        }
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        } else if ($mode == "redirect") {
            header("Location: $link");
            exit();
        }
    }

    public static function link(string $path, array $params = [], string $mode = "echo")
    {
        $link = self::$URL . "/$path";
        if ($params) {
            $link .= "?";
            foreach ($params as $key => $value) {
                $link .= "$key=$value&";
            }
            $link = substr($link, 0, -1);
        }
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        } else if ($mode == "redirect") {
            header("Location: $link");
            exit();
        }
    }

    public static function middleware(string $path, string $mode = "echo")
    {
        $link = self::$URL . "/middleware/$path";
        if ($mode == "echo") {
            echo $link;
        } else if ($mode == "return") {
            return $link;
        } else if ($mode == "redirect") {
            header("Location: $link");
            exit();
        }
    }
}
