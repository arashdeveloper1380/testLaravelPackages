<?php

namespace App\Controllers;
require_once 'helpers.php';

use App\Models\User;
use Illuminate\Http\Request;
use Rakit\Validation\Validator;
use Auth\Auth;
use Core\Redirect\Redirect;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Core\Response\Response;

class UsersController
{
    protected $request;

    public function __construct(){
        $this->request = Request::capture();
    }

    public function index()
    {
        // return Response::json([
        //     'users'     => getData('users'),
        //     'status'    => 200,
        // ], 200);

        // return Response::success(getData('users'));
        // return Response::error(getData('users'));

        // return response([
        //     'users'     => getData('users'),
        //     'status'    => 200
        // ]);
        // dd(auth());
        // dd(getAuthUser(1));
        // $name = "welcome ";
        // return view('index',compact('name'));
    }

    public function register(){
        return view('register');
    }

    public function registerStore(){

        $registerValidator = new Validator;

        $validation = $registerValidator->make($_POST + $_FILES, [
            'name'      => 'required',
            'email'     => 'required|email|unique',
            'password'  => 'required',
        ]);

        $validation->validate();

        if($validation->fails()){
            dd($validation->errors());
        }

        Auth::register(
            $this->request->get('name'),
            $this->request->get('email'),
            $this->request->get('password'),
        );
    }


    public function login()
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
            Redirect::back();
        }
        dd("not match");
    }

    public function resset(){
        return view('resset');
    }

    public function ressetStore(){
        $email = $this->request->get('email');
        Auth::forgetPassword($email);
    }
}