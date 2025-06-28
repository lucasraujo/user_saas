<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->addPlaceholder('uuid','[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{8,12}');

$routes->group("user", static function ($routes) {
    $routes->get("all", [UserController::class, 'getAllClients']);
    $routes->get("(:uuid)", [UserController::class, 'getClient']);
    $routes->post("", [UserController::class, 'createClient']);
    $routes->patch("(:uuid)", [UserController::class, 'updateClient']);
    $routes->delete("(:uuid)", [UserController::class, 'deleteClient']);
});
