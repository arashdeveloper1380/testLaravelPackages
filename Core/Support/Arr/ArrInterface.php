<?php

namespace Core\Support\Arr;

interface ArrInterface {


    /**
     * @param array $array
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($array, $key, $default = null);


    /**
     * @param array $array
     * @param string $key
     * @return bool
     */
    public static function has($array, $key);

    /**
     * @param  array  $array
     * @param  string  $key
     * @param  mixed  $value
     * @return array
     */
    public static function add(&$array, $key, $value);

}