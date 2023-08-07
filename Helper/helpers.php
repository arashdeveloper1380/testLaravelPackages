<?php

use Core\Redirect\Redirect;
use View\View;

if(!function_exists('dd')){
    function dd($value){
        dump($value);
    }
}

if(!function_exists('dd')){
    function view($view, $param = []){
        return View::renderBlade($view,$param);
    }
}