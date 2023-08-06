<?php

namespace App\Controllers;

<<<<<<< HEAD
use View\View;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use View\View;
>>>>>>> 39ac8c1966316976d40155a803388a5c1246cd2c

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