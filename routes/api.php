<?php

use App\Controllers\Api\UsersController;

$router->prefix('api')->group(function () use ($router) {
    $router->get('/test', [UsersController::class, 'index']);
    $router->get('/find/{id}', [UsersController::class, 'find']);
    $router->post('/store', [UsersController::class, 'store']);
    $router->get('/destroy', [UsersController::class, 'destroy']);
    $router->get('/join', [UsersController::class, 'join']);
    $router->get('/update/{id}', [UsersController::class, 'update']);
});