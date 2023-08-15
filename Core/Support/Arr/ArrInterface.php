<?php

namespace Core\Support\Arr;

interface ArrInterface {

    public function add($element);

    public function get($key);

    public function size();
}