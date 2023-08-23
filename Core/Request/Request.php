<?php

namespace Core\Request;

class Request{

    protected $input;

    public function __construct(){
        $this->input = $_REQUEST;
    }
    
    public function all(){
        return $this->input;
    }

    public function get($key, $default = null){
        return isset($this->input[$key]) ? $this->input[$key] : $default;
    }

    public function has($key) : bool{
        return isset($this->input[$key]);
    }

    public function only($keys){
        $values = [];

        foreach ($keys as $key){
            if(isset($this->input[$key])){
                $values[$key] = $this->input[$key];
            }
        }
    }

    public function except($keys){
        $values = $this->input;

        foreach ($keys as $key){
            unset($values[$key]);
        }
        return $values;
    }

}