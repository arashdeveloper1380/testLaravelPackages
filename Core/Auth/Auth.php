<?php

namespace Auth;

use App\Models\User;

Class Auth {

    public static function login($email, $password){
        $user = User::query()->where('email',$email)->first();
        if($password === $user->password){
            $_SESSION ['user_id'] = $user->id;
            return true;
        }
    }

    public static function logout(){
        if(isset($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
        }
    }

    public static function user(){
        if(isset($_SESSION['user_id'])){
            $user = User::find($_SESSION['user_id']);
            return $user;
        }
        return null;
    }

    public static function check(){
        return isset($_SESSION['user_id']);
    }

}