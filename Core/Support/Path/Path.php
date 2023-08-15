<?php

namespace Core\Support\Path;

class Path implements PathInterface{

    public static function porotocol(){
        return stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    }

    public static function app_path(){

        return $_SERVER['DOCUMENT_ROOT'];

    }

    public static function database_path(){

        return app_path() . "/database";

    }

    public static function public_path(){

        return app_path() . "/public";

    }

    public static function assets($path){

        return self::porotocol() . $_SERVER['HTTP_HOST'] . "/public/" . $path;

    }

}