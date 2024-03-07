<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Ramsey\Uuid\Uuid;

class ProductController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper(["Request", "Response"]);
    }

    public function createProduct()
    {
        $body = getBody();
        $user = getUser();
        print_r($user);
        die;

        if (
            !$this->validate([
                "uuid" => Uuid::uuid4(),
                "fk_company" => 1,
                "name" => $body->name,
                "description" => $body->description,
                "amount" => $body->amount,
                "quantity" => $body->quantity,
                "user_insert" => "",
            ])
        ) {
            return responseKWR(["return" => false, "message" => 'error fields', "data" => $this->validator->getErrors()], 406);
        }


        return responseKWR(["return" => false, "message" => 'success'], 200);

    }
    public function getProduct()
    {

    }
}
