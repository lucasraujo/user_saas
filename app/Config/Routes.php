<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use App\Controllers\Home;
use App\Controllers\Login;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [login::class, 'index']);
$routes->get('/home', [Home::class, 'index']);



$routes->addPlaceholder('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{8,12}');

$routes->group('api', function ($routes) {
    $routes->post('login', [AuthController::class, 'login']);

    $routes->group("users", static function ($routes) {
        $routes->get("", [UserController::class, 'getAllUsers'], ['filter' => 'jwt']);
        $routes->get("(:uuid)", [UserController::class, 'getUser'], ['filter' => 'jwt']);
        $routes->post("", [UserController::class, 'createUser'], ['filter' => 'jwt']);
        $routes->patch("(:uuid)", [UserController::class, 'updateUser'], ['filter' => 'jwt']);
        $routes->delete("(:uuid)", [UserController::class, 'deleteUser'], ['filter' => 'jwt']);
    });
});
