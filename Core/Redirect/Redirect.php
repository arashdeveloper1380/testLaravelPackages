<?php

namespace Core\Redirect;

class Redirect {

    protected static $data = [];

    public static function back(){

        $referer = $_SERVER['HTTP_REFERER'];

        if (!empty($referer)) {
            header("Location: $referer");
        }
        exit();

    }

    public static function to($url, $statusCode = 302) {

        header('Location: ' . $url, true, $statusCode);
        exit();

    }
    
}