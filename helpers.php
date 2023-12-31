<?php

use Auth\Auth;
use Core\Support\Path\Path;
use Core\QueryBuilder\QueryBuilder;
use Core\Redirect\Redirect;
use Core\Request\Request;
use Core\Response\Response;
use Core\Support\Arr\Arr;
use Core\Support\Url\Url;
use View\View;
use Illuminate\Database\Capsule\Manager as DB;
use JWTAuth\JWTAuth;
use Session\Session;

// ------------------ Path ------------------

    if(!function_exists('app_path')){
        function app_path(){
            return Path::app_path();
        }
    }

    if(!function_exists('database_path')){
        function database_path(){
            return Path::database_path();
        }
    }

    if(!function_exists('public_path')){
        function public_path(){
            return Path::public_path();
        }
    }


    if(!function_exists('assets')){
        function assets($path){
            return Path::assets($path);
        }
    }

    if(!function_exists('views')){
        function views($path){
            return app_path() . '/resources/views/' . $path . '.blade.php';
        }
    }

// ------------------ Path ------------------



// ------------------ Url ------------------

    if(!function_exists('url')){
        function url($url = null){
            return Url::url($url);
        }
    }

    if(!function_exists('route')){
        function route($route_name){
            return Url::route($route_name);
        }
    }

// ------------------ Url ------------------



// ------------------ Arr ------------------

    if(!function_exists('arr')){
        function arr(){
            return new Arr();
        }
    }

// ------------------ Arr ------------------


// ------------------ Request ------------------

    if(!function_exists('request')){
        function request(){
            return new Request;
        }
    }

// ------------------ Request ------------------


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

if(!function_exists('response')){
    function response($data = null){
        return Response::json($data);
    }
}

if(!function_exists('auth')){
    function auth(){
        return Auth::check();
    }
}

if(!function_exists('getAuthUser')){
    function getAuthUser(){
        return Auth::user(getSession('user_id'));
    }
}

if(!function_exists('getSession')){
    function getSession($key){
        $session = new Session();
        $session->get($key);
    }
}

if(!function_exists('hasSession')){
    function hasSession($key){
        $session = new Session();
        return $session->has($key);
    }
}

if(!function_exists('session')){
    function session() {
        return new Session();
    }
}
if(!function_exists('db')){
    function db(){
        return new DB();
    }
}


if(!function_exists('getData')){
    function getData($table = null, $where = null, $orderBy = null, $limit = null){

        $query = DB::table($table);

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

if(!function_exists('findData')){
    function findData($table, $id){
        $find = DB::table($table)->find($id);
        $find = json_decode(json_encode($find), true);
        return $find;
    }
}

if(!function_exists('qb')){
    function qb(){
        return QueryBuilder::qb('localhost', 'mini', 'root', '');
    }
}

if(!function_exists('urlIs')){
    function urlIs($value){
        return $_SERVER['REQUEST_URI'] === $value;
    }
}