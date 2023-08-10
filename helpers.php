<?php

use Auth\Auth;
use Core\Redirect\Redirect;
use Core\Response\Response;
use View\View;
use Illuminate\Database\Capsule\Manager as DB;
use Session\Session;

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