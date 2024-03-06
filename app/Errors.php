<?php

namespace App;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Errors extends Controller
{

  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
  }

  public function routeNotFound()
  {
    $response = service('response');
    $response->setStatusCode(404);
    $response->setBody(json_encode(["return" => false, "message" => $_SERVER['REQUEST_URI'] . " is a invalid endpoint"]));
    $response->setHeader('Content-type', 'application/json');
    $response->noCache();
    $response->send();
  }
}
