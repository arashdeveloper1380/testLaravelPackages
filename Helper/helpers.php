<?php

use View\View;

if(!function_exists('dd')){
    function dd($value){
        dump($value);
    }
}

function view($view, $param = []){
    return View::renderBlade($view,$param);
}