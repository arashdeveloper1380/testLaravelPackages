<?php

namespace App\Controllers\Api;
require_once 'helpers.php';

use App\Models\User;
use Illuminate\Http\Request;

class UsersController{

    public function index(){
        return response([
            'users'     => db()->table('users')->get(),
            'status'    => 200
        ]);
    }
    
}