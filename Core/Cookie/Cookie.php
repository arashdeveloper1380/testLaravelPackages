<?php

namespace Cookie;

class Cookie{
    private $name;
    private $value;
    private $expiration;

    public function __construct($name, $value, $expiration = null) {
        $this->name = $name;
        $this->value = $value;
        $this->expiration = $expiration;
    }

    public function set(){
        if ($this->expiration) {
            setcookie($this->name, $this->value, $this->expiration);
        } else {
            setcookie($this->name, $this->value);
        }
    }

    public function get() {
        return $_COOKIE[$this->name] ?? null;
    }

    public function delete() {
        setcookie($this->name, '', time() - 3600);
    }
}