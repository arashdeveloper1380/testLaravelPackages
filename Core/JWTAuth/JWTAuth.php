<?php

namespace JWTAuth;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Mailer\Mailer;
use Session\Session;

class JWTAuth {

    protected static $secret_key = 'arash_narimani';

    public static function register($name, $email, $password){
        
        $user = User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => md5($password)
        ]);

    }

    public static function login($email, $passwoord){
        $session = new Session();
        $user = User::query()->where('email', $email)->first();
        if($passwoord === $user->password){

            $payload = [
                'user_id'   => $user->id,
                'email'     => $user->email
            ];

            $jwt = JWT::encode($payload, self::$secret_key, 'HS256');
            $session->set('jwt_token', $jwt);
            // $_SESSION['jwt_token'] = $jwt;

            return true;
        }
    }

    public static function logout(){
        $session = new Session();
        if($session->has('jwt_token')){
            $session->remove('jwt_token');
        }

    }

    public static function user(){
        $session = new Session();
        if($session->has('jwt_token')){
            $jwt = $session->get('jwt_token');
            // $jwt = $_SESSION['jwt_token'];
            $decoded = JWT::decode($jwt, self::$secret_key);

            try {

                $user = User::query()->where($jwt->user->id);
                return $user;

            } catch (\Throwable $th) {

                echo "Invalid token: " . $th->getMessage();

            }
        }
        return null;

    }

    public static function check(){
        $session = new Session();
        return $session->get('jwt_token');

    }

    public static function forgetPassword($email){
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            return "User Not Found";
        }
        $newPassword = self::generateRandomPassword();
        $user->update(['password' => $newPassword]);

        $message = "new password is : {$newPassword}";

        self::sendPasswordResetEmail($user->email, $user->name, 'new password', $message);
    }

    private static function generateRandomPassword($length = 8){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    private static function sendPasswordResetEmail($email, $name, $subject = '', $message = ''){

        $mailer = new Mailer();

        $mailer->make()
            ->setTo($email, $name)
            ->setFrom('zxcv.arash1380@gmail.com', 'arash narimani')
            ->setSubject($subject)
            ->setMessage($message)
            ->send();
    }

}