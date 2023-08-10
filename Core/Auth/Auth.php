<?php

namespace Auth;

require_once 'vendor/autoload.php';

use App\Models\User;
use Core\Redirect\Redirect;
use Rakit\Validation\Validator;
use Mailer\Mailer;
use Session\Session;

Class Auth {

    public static function register($name, $email, $password){
        $user = User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => md5($password)
        ]);

    }

    public static function login($email, $password){
        $session = new Session();

        $user = User::query()->where('email',$email)->first();
        try { 
            if($user){
                if($password === $user->password){
                    $session->set('user_id', $user->id);
                    return true;
                }
            }
        } catch (\Throwable $th) {
            return "error : " . $th->getMessage();
        }
        
    }

    public static function logout(){
        $session = new Session();
        if($session->has('user_id')){
            $session->remove('user_id');
            Redirect::to('/');
        }
    }

    public static function user(){
        $session = new Session();
        if($session->has('user_id')){
            $user = User::find($_SESSION['user_id']);
            return $user;
        }
        return null;
    }

    public static function check(){
        $session = new Session();
        return $session->has('user_id');
    }

    public static function forgetPassword($email){
        $user = User::query()->where('email', $email)->first();
        if(!$user){
            return "User Not Found";
        }
        $newPassword = self::generateRandomPassword();
        $user->update(['password' => $newPassword]);

        $message = "new password is : {$newPassword}";

        self::sendPasswordResetEmail($user->email, $user->name, 'new password', $message);
    }

    private static function generateRandomPassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    private static function sendPasswordResetEmail($email, $name, $subject = '', $message= '') {

        $mailer = new Mailer();

        $mailer->make()
        ->setTo($email, $name)
        ->setFrom('zxcv.arash1380@gmail.com', 'arash narimani')
        ->setSubject($subject)
        ->setMessage($message)
        ->send();
    }
}