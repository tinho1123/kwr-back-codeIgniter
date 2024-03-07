<?php

namespace Config;

$routes = Services::routes();

$routes->addPlaceholder([
    'uuid' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{8,12}',
    "e2e" => '[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{8,12}',
]);

$routes->group('product', ["filter" => \App\Filters\AuthenticationUser::class], static function ($routes) {
    $routes->post('', [\App\Controllers\ProductController::class, 'createProduct']);
    $routes->get('', [\App\Controllers\ProductController::class, 'getProduct']);
});
