<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DeliveryController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper(['Request', 'Response']);
    }

    public function createDelivery($client_uuid)
    {

    }

    public function getDelivery($delivery_uuid)
    {

    }
}
