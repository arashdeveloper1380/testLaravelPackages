<?php

namespace Session;

class Session {
    private $sessionName;

    public function __construct($sessionName) {
        $this->sessionName = $sessionName;
        session_name($this->sessionName);
        session_start();
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function has($key){
        return isset($_SESSION[$key]);
    }

    public function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy() {
        session_unset();
        session_destroy();
    }
}