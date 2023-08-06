<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use View\View;

class UsersController
{
    protected $request;

    public function __construct(){
        $this->request = Request::capture();
    }
    public function index()
    {
        return View::loadView('index');
    }

    public function store()
    {
        
        $name = $this->request->get('name');
        var_dump($name);
    }
}