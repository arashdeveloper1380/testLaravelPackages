<?php

namespace App\Controllers\Api;
require_once 'helpers.php';

use App\Models\User;
use Core\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Request;
use Rakit\Validation\Validator;
use Core\App\App;

class UsersController{

    public function index(){
        $select = ['id', 'name'];
        // dd(implode(', ', $select));

        $result = qb()->table('users')
            ->where('id', '!=', 7)
            ->orderBy('id', 'DESC')
            ->limit('1')
            ->get();

        return response([
            'users'     => $result,
            'status'    => 200
        ]);
    }

    public function find($id){
        $findUser = qb()->table('users')->find($id);
        return response([
            'user'      => $findUser,
            'status'    => 200
        ]);
    }

    public function store(){
        $name       = $_POST['name'];
        $phone      = $_POST['phone'];
        $email      = $_POST['email'];
        $password   = md5($_POST['password']);

        $validatorStore = new Validator;
        $validation = $validatorStore->make($_POST + $_FILES, [
            'name'      => 'required',
            'phone'     => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
        $validation->validate();

        if($validation->fails()){
            $errors = $validation->errors();
            return response([
                'errors' => [
                    $errors->firstOfAll()
                ],

            ]);
        }

        $newUser = qb()->table('users')
        ->insert([
            'name'      => $name,
            'phone'     => $phone,
            'email'     => $email,
            'password'  => $password
        ]);

        return response([
            'user'      => $newUser,
            'message'   => 'created new user',
            'status'    => 200
        ]);
    }

    public function destroy(){
        // $user = qb()->table('users')->where('id', '=', 17)->first();
        // if(!$user){
        //     dd("not found"); 
        // }
    
        $user = qb()->table('users')->where('id', '=', 20)->delete();
        return response([
            'message'   => 'deleted user',
            'status'    => 200
        ]);
    }

    public function join(){
        $userJoin = qb()->table('users')->join('orders','users.id', '=', 'orders.user_id')->get();

        return response([
            'user'      => $userJoin,
            'status'    => 200,
        ]);
    }

    public function update($id){
        $user = qb()->table('users')->where('id', '=', $id)->update(['name' => 'arash_narimani']);
        dd($user);
        return response([
            'user'      => $user,
            'message'   => 'user updated',
            'status'    => 200,
        ]);
    }
    
}