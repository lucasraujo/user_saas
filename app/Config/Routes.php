<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;
use App\Controllers\AuthController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->addPlaceholder('uuid','[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{8,12}');

$routes->group('auth', function($routes) {
    $routes->post('login', [AuthController::class, 'login']);
});

$routes->group("user", static function ($routes) {
    $routes->get("all", [UserController::class, 'getAllUsers'], ['filter' => 'jwt']);
    $routes->get("(:uuid)", [UserController::class, 'getUser'], ['filter' => 'jwt']);
    $routes->post("", [UserController::class, 'createUser'], ['filter' => 'jwt']);
    $routes->patch("(:uuid)", [UserController::class, 'updateUser'], ['filter' => 'jwt']);
    $routes->delete("(:uuid)", [UserController::class, 'deleteUser'],['filter' => 'jwt']);
});
