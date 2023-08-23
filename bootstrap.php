<?php

use Core\Container\Container;
use Core\QueryBuilder\QueryBuilder;
use Core\Request\Request;

$container = new Container();

$container->bind('Core\Request\Request',  function (){
    return new Request();
});

$request = $container->resolve('Core\Request\Request');

dd($request);