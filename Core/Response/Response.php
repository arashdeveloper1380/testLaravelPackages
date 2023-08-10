<?php

namespace Core\Response;

class Response {

    public static function json($data = null){
        return json_encode($data);
    }

    public static function make($data = null, $status = 200) {
        $response = array(
            'data' => $data,
            'status' => $status,
        );

        return json_encode($response);
    }

    public static function success($data = null) {
        return self::make($data, 200);
    }

    public static function error($status = 500, $data = null) {
        return self::make($data, $status);
    }

}