<?php

use Core\App\App;
use Core\Container\Container;
use Core\Logger\Logger;

$container = new Container();

$container->bind('Core\Logger\Logger', function(){
    return new Logger();
});

App::setContainer($container);