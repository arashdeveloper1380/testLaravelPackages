<?php

namespace App\Controllers;

use Illuminate\Http\Request;

class UsersController
{
    public function index()
    {
        require_once 'index.php';
    }

    public function store()
    {
        $request = Request::capture();
        $name = $request->get('name');
        var_dump($name);
    }
}