<?php

namespace App\Controllers\Api;
require_once 'helpers.php';

use App\Models\User;
use Core\QueryBuilder\QueryBuilder;
use Core\Response\Response;
use Illuminate\Http\Request;

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

    public function find(){
        dd(qb()->table('users')->find(1));
    }

    public function store(){
        qb()->table('users')
        ->insert([
            'name'      => 'hasan',
            'phone'     => '09030613874',
            'email'     => 'hasan@gmail.com',
            'password'  => md5("1234")
        ]);

        return response([
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
            'join'      => $userJoin,
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