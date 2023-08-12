<?php

namespace App\Controllers\Api;
require_once 'helpers.php';

use App\Models\User;
use Core\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class UsersController{

    public function index(){
        $select = ['id', 'name'];
        // dd(implode(', ', $select));

        $result = qb()->table('users')
            ->where('id', '!=', 7)
            ->where('name', '=', 'arash')
            ->orderBy('id', 'DESC')
            ->get();

        return response([
            'users'     => $result,
            'status'    => 200
        ]);
    }
    
}