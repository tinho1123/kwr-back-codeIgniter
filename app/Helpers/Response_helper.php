<?php

use CodeIgniter\HTTP\Response;

function responseKWR($message, $statusCode)
{
    $response = service('response');

    $response->setStatusCode($statusCode);
    $response->setBody(json_encode($message));
    $response->setHeader('Content-type', 'application/json');
    $response->noCache();
    $response->send();
}
