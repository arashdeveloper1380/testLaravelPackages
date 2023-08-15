<?php

namespace Core\Support\Url;

interface UrlInterface {

    public static function url($path = null);

    public static function route($route_name);

}