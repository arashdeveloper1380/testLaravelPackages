<?php

namespace Core\Support\Url;

use Core\Support\Path\Path;
use Core\Support\Url\UrlInterface;

class Url implements UrlInterface{

    public static function url($path = null){
        return Path::porotocol() . $_SERVER['HTTP_HOST'] . "/" . $path;
    }

    public static function route($route_name){
        return Path::porotocol() . $_SERVER['HTTP_HOST'] . "/" . $route_name;
    }

}