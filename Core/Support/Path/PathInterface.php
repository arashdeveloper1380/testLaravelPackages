<?php

namespace Core\Support\Path;

interface PathInterface{

    public static function porotocol();

    public static function app_path();

    public static function database_path();

    public static function public_path();

    public static function assets($path);
}