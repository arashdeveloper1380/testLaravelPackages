<?php

namespace App\Controllers;

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
        View::renderBlade('index',compact('name'));
    }

    public function store()
    {
        
        $name = $this->request->get('name');
        var_dump($name);
    }
}