<?php
namespace Config;

$routes = Services::routes();

$routes->addPlaceholder([
    'uuid'                                 =>  '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{8,12}',
    "e2e"                                  =>  '[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{8,12}',
]);

$routes->group('user', static function ($routes) {
    $routes->post('sign-in', [\App\Controllers\LoginController::class, 'signInUser']);
    $routes->post('sign-up', [\App\Controllers\LoginController::class, 'signUpUser']);
});

$routes->group('client', static function ($routes) {
    $routes->post('sign-in', [\App\Controllers\LoginController::class, 'signInClient']);
    $routes->post('sign-up', [\App\Controllers\LoginController::class, 'signUpClient']);
});
