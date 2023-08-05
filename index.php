<?php

require 'vendor/autoload.php';

use App\Controllers\UsersController;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

$container = new Container();
$request = Request::capture();
$dispatcher = new Dispatcher($container);
$router = new Router($dispatcher, $container);

$router->get('/', [UsersController::class,'index']);
$router->post('/store', [UsersController::class,'store']);

$response = $router->dispatch($request);
$response->send();