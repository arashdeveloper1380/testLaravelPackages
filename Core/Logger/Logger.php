<?php

namespace Core\Logger;

use Core\Logger\LoggerInterface;

class Logger implements LoggerInterface{

    public function log($message){
        echo "Logging Message: " . $message;
    }

}