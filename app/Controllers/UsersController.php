<?php

namespace App\Controllers;
require_once 'Helper/helpers.php';
use View\View;
use Illuminate\Http\Request;

class UsersController
{
    protected $request;

    public function __construct(){
        $this->request = Request::capture();
    }

    public function index()
    {
        $name = "arash";
        // View::renderBlade('index',compact('name'));
        return view('index',compact('name'));
    }

    public function store()
    {
        $name = $this->request->get('name');
        var_dump($name);
    }
}