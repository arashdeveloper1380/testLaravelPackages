<?php

namespace App\Controllers;

use Core\Container\Container;

require_once app_path() . '/bootstrap.php';

class Controller {

    public function __construct(){
        $container = new Container();
        global $logger;
        $logger = $container->resolve('logger');
    }
    
}