<?php

use Core\Container\Container;
use Core\QueryBuilder\QueryBuilder;

$container = new Container();

$container->bind('Core\QueryBuilder\QueryBuilder',  function (){
    return QueryBuilder::qb('localhost', 'mini', 'root', '');
});

$query_builder = $container->resolve('Core\QueryBuilder\QueryBuilder');

dd($query_builder);