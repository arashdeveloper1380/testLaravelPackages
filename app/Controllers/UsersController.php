<?php

namespace App\Controllers;
require_once 'Helper/helpers.php';

use Illuminate\Http\Request;
use Rakit\Validation\Validator;

class UsersController
{
    protected $request;

    public function __construct(){
        $this->request = Request::capture();
    }

    public function index()
    {
        $name = "arash";
        return view('index',compact('name'));
    }

    public function store()
    {
        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, [
            'name' => 'required',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            dd($validation->errors());
        }
        
        $name = $this->request->get('name');
        var_dump($name);
    }
}