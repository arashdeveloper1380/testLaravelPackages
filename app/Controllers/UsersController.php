<?php

namespace App\Controllers;
require_once 'Helper/helpers.php';

use App\Models\User;
use Illuminate\Http\Request;
use Rakit\Validation\Validator;
use Auth\Auth;

class UsersController
{
    protected $request;

    public function __construct(){
        $this->request = Request::capture();
    }

    public function index()
    {
        $name = "welcome ";
        return view('index',compact('name'));
    }

    public function store()
    {
        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, [
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            dd($validation->errors());
        }

        $login = Auth::login($this->request->get('email'), md5($this->request->get('password')));
        if($login){
            return Auth::user();
        }
        dd("not match");
    }
}