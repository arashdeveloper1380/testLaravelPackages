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
     * @param array  $array
     * @param string  $key
     * @param mixed  $value
     * @return array
     */
    public static function add(&$array, $key, $value);


    /**
     * @param array  $array
     * @param string  $separator
     * @return string
     */

     public static function join($array, $separator);


     /**
     * @param array  $array
     * @param string  $key
     * @return array
     */
    public static function keyBy($array, $key);


    /**
     * @param array  $array
     * @return string
     */
     public static function last($array);


     /**
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function only($array, $keys);


    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function pluck($array, $key);


    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function whereNotNull($array);


    /**
     * @param array $array
     * @param string $key
     * @return bool
     */
    public static function exists($array, $key);


    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function excerpt($array, $key);


    /**
     * @param array $array
     * @return string
     */
    public static function first($array, $keyOrValue);


    /**
     * @param array $array
     * @return string
     */
    public function sort($array);

}