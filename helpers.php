<?php

use Core\Redirect\Redirect;
use View\View;
use Illuminate\Database\Capsule\Manager as DB;

use function GuzzleHttp\default_ca_bundle;

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

if(!function_exists('assets')){
    function assets($path){
        return projectPath() . '/public/' . $path;
    }
}

if(!function_exists('tpl')){
    function tpl($path){
        return projectPath() . '/tpl/' . $path . '.blade.php';
    }
}

if(!function_exists('getUsers')){
    function getUsers($where = null, $orderBy = null, $limit = null){

        $query = DB::table('users');

        if ($where) {
            $query->where($where);
        }

        if ($orderBy) {
            $query->orderByRaw($orderBy);
        }

        if($orderBy){
            $query->limit($limit);
        }

        return $query->get();

    }
}
