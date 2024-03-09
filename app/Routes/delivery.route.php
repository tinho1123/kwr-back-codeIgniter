<?php

namespace Config;

$routes = Services::routes();

$routes->addPlaceholder([
    "client_uuid" => "[0-9a-f]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}",
    "delivery_uuid" => "[0-9a-f]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}",
]);

$routes->group('delivery', static function ($routes) {
    $routes->post('(:client_uuid)', [\App\Controllers\DeliveryController::class, 'createDelivery']);
    $routes->get('(:delivery_uuid)', [\App\Controllers\DeliveryController::class, 'getDelivery']);
});