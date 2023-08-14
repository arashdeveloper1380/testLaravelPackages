<?php

require 'vendor/autoload.php';
require_once 'Config/database.php';
use Tracy\Debugger;

Debugger::enable();

use App\Controllers\UsersController;
use Auth\Auth;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

$container = new Container();
$request = Request::capture();
$dispatcher = new Dispatcher($container);
$router = new Router($dispatcher, $container);

// web
$router->get('/', [UsersController::class, 'index']);
$router->get('/register', [UsersController::class, 'register']);
$router->post('/register-store', [UsersController::class, 'registerStore']);
$router->post('/login', [UsersController::class, 'login']);
$router->get('/reset', [UsersController::class, 'reset']);
$router->post('/reset', [UsersController::class, 'resetStore']);
$router->get('/logout', [Auth::class, 'logout']);
$router->get('/dashboard', [UsersController::class, 'dashboard']);


// api
include 'api.php';

$response = $router->dispatch($request);
$response->send();