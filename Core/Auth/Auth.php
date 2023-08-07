<?php

namespace Auth;

use App\Models\User;
use Rakit\Validation\Validator;

Class Auth {

    public static function register($name, $email, $password){

        $user = User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => md5($password)
        ]);

    }

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

    public static function forgetPassword($email){
        $user = User::query()->where('email', $email)->first();
        if(!$user){
            return "User Not Found";
        }
        $newPassword = self::generateRandomPassword();
        $user->update(['password' => $newPassword]);
    }

    private static function generateRandomPassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    private static function sendPasswordResetEmail($email, $newPassword) {
        //
    }

}