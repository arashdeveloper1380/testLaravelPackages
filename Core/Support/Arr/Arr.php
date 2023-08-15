<?php

namespace Core\Support\Arr;

use Core\Support\Arr\ArrInterface;

class Arr implements ArrInterface{
    private $array;

    public function __construct() {
        $this->array = [];
    }

    public function add($element) {
        $this->array = [$element];
    }

    public function get($index) {
        return $this->array[$index] ?? null;
    }

    public function size(){
        return count($this->array);
    }

}