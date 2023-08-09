<?php

use Core\Redirect\Redirect;
use View\View;
use Illuminate\Database\Capsule\Manager as DB;

if(!function_exists('dd')){
    function dd($value){
        dump($value);
    }
}

if(!function_exists('view')){
    function view($view, $param = []){
        return View::renderBlade($view,$param);
    }
}

if(!function_exists('projectPath')){
    function projectPath(){
        $_SERVER['DOCUMENT_ROOT'];
    }
}