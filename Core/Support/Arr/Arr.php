<?php

namespace Core\Support\Arr;

use Core\Support\Arr\ArrInterface;

class Arr implements ArrInterface{

    /** 
     * @param array $array
     * @param string $key
     * @param mixed $default
     * @return mixed
     **/
    
    public static function get($array, $key, $default = null){

        if(is_null($key)){
            return $array;
        }

        if(isset($array[$key])){
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment){
            if(!is_array($array) || !array_key_exists($segment, $array)){
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;

    }

    /**
     * @param  array  $array
     * @param  string  $key
     * @return bool
     */

    public static function has($array, $key){
        if(empty($array) || is_null($key)){
            return false;
        }

        if(array_key_exists($key, $array)){
            return true;
        }

        foreach (explode('.', $key) as $segment){
            if(!is_array($array) || !array_key_exists($segment, $array)){
                return false;
            }

            $array = $array[$segment];
        }

        return true;
    }

    /**
     * @param  array  $array
     * @param  string  $key
     * @param  mixed  $value
     * @return array
     */
    public static function add(&$array, $key, $value){
        if(is_null($key)){
            return $array = $value;
        }

        $keys = explode('.', $key);

        while(count($keys) > 1){
            $key = array_shift($keys);

            if(!isset($array[$key]) || !is_array($array[$key])){
                $array[$key] = [];
            }

            $array = &$array[$key];

        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    /**
     * @param  array  $array
     * @param  string  $key
     * @param  mixed  $value
     * @return string
     */
    public static function join($array, $separator){
        return implode($separator, $array);
    }

    /**
     * @param  array  $array
     * @param  string  $key
     * @return array
     */
    public static function keyBy($array, $key){
        $result = [];

        foreach ($array as $item){
            if(isset($item[$key])){
                $result[$item[$key]] = $item;
            }
        }

        return $result;
    }


    /**
     * @param  array  $array
     * @return string
     */
    public static function last($array){
        if(empty($array)){
            return null;
        }

        return end($array);
    }


    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function only($array, $keys){
        return array_intersect_key($array, array_flip($keys));
    }


    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function pluck($array, $key){
        if(empty($array) || is_null($array)){
            return [];
        }
        return array_column($array, $key);
    }


}