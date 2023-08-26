<?php

namespace App\Controllers;
require_once 'helpers.php';

use App\Models\User;
use Illuminate\Http\Request;
use Rakit\Validation\Validator;
use Auth\Auth;
use Core\App\App;
use Core\Redirect\Redirect;
use Core\Response\Response;
use Core\Support\Arr\Arr;
use Core\Support\Path\Path;
use Core\Support\Url\Url;
use JWTAuth\JWTAuth;
use Session\Session;
use View\View;

class UsersController extends Controller{
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

        // $array = [
        //     'user' => [
        //         'name'  => 'arash',
        //         'email' => 'arash@gmail.com'
        //     ]
        // ];
        // $arr = ['name' => 'arash', 'hasan' => 12, 'mahamad' => true];
        // dd(Arr::first($arr));
        // dd(Arr::excerpt($arr, ['name', 'hasan']));
        // if(Arr::exists($arr, 'name')){
        //     return 1;
        // }else{
        //     return 0;
        // }

        // echo Arr::last($arr);
        // echo Arr::join($arr, ',');

        // echo Arr::has($array, 'user.name');
        // echo Arr::get($array, 'user.email');
        // Arr::add($array, 'user.name', 'hasan');
        // echo $array ['user'] ['name'];

        // $users = [
        //     ['id' => 1, 'name' => 'arash'],
        //     ['id' => 2, 'name' => 'ali'],
        //     ['id' => 3, 'name' => 'kazim'],
        // ];
        // dd(Arr::pluck($users, 'name'));
        // $data = [
        //     'name' => 'John',
        //     'age' => 30,
        //     'email' => 'john@example.com',
        //     'address' => '123 Main St',
        // ];
        
        // $filteredData = Arr::only($data, ['name', 'email']);
        // dd(Arr::only($data, ['name', 'address']));

        // $result = Arr::keyBy($users, 'name');
        // dd($result);

        $sort = [5, 2, 6, 1];
        // dd(arr()->sort($sort));
        // dd(Arr::sort($sort));

        $logger = App::container()->resolve('Core\Logger\Logger');
        $logger->log("this is container logger");
        $name = "login page ";
        return view('index',compact('name'));
    }

    public function dashboard(){
        $session = new Session();
        if($session->get('user_id') || $session->get('jwt_token')){
            return view('dashboard');
        }
        Redirect::to('/');

    }

    public function register(){
        return view('register');
    }

    public function registerStore(){

        $registerValidator = new Validator;

        $validation = $registerValidator->make($_POST + $_FILES, [
            'name'      => 'required',
            'email'     => 'required|email',
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


        $user = Auth::login($this->request->get('email'), $this->request->get('password'));
        if($user){
            Redirect::to('/dashboard');
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