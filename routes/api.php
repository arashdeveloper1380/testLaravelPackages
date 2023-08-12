<?php

use App\Controllers\Api\UsersController;

$router->prefix('api')->group(function () use ($router) {
    $router->get('/test', [UsersController::class, 'index']);
    $router->get('/store', [UsersController::class, 'store']);
    $router->get('/destroy', [UsersController::class, 'destroy']);
});