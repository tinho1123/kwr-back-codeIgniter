<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;


class LoginController extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
        helper(['Request', 'Response']);
    }

    public function signInUser() {

     if(!$this->validate([
        "email" =>"required|max_length[254]|valid_email",
        "password" => "required|max_length[255]|min_length[6]"
     ])) {
        return responseKWR(['return' => false, 'message' => 'error fields', 'data'=> $this->validator->getErrors()], 406);
     }
    $encrypter = \Config\Services::encrypter();
    $key = getenv('jwt.secret');
    
    $message = $key.'asdasdas'.$key;
    $email = base64_encode($encrypter->encrypt($message));
    $iat = time();
    $exp = $iat + 3600;
    $payload = array(
            "iss"   => "Issuer of the JWT",
            "aud"   => "Audience that the JWT",
            "sub"   => "Subject of the JWT",
            "iat"   => $iat, 
            "exp"   => $exp, 
            "email" => $email,
        );

        $token = \Firebase\JWT\JWT::encode($payload, $key, 'HS256');

     return responseKWR(['return' => true, 'message' => 'success','data' => $token], 200);
    }

     public function signUpUser() {
          if(!$this->validate(
            [
            'name'      => "required|max_length[254]",
            "document"  => "required|max_length[14]|min_length[11]", 
            "email"     => "required|max_length[254]|valid_email", 
            "password"  => "required|max_length[255]|min_length[6]", 
     ])) {
        return responseKWR(['return' => false, 'message' => 'error fields', 'data'=> $this->validator->getErrors()], 406);
     }

     return responseKWR(['return' => true, 'message' => 'success'], 200);
    }

    public function signInClient() {

     if(!$this->validate([
        "email" =>"required|max_length[254]|valid_email",
        "password" => "required|max_length[255]|min_length[6]"
     ])) {
        return responseKWR(['return' => false, 'message' => 'error fields', 'data'=> $this->validator->getErrors()], 406);
     }

     

     return responseKWR(['return' => true, 'message' => 'success'], 200);
    }

    public function signUpClient() {
          if(!$this->validate(
            [
            'name'      => "required|max_length[254]",
            "document"  => "required|max_length[14]|min_length[11]", 
            "email"     => "required|max_length[254]|valid_email", 
            "password"  => "required|max_length[255]|min_length[6]", 
     ])) {
        return responseKWR(['return' => false, 'message' => 'error fields', 'data'=> $this->validator->getErrors()], 406);
     }

     return responseKWR(['return' => true, 'message' => 'success'], 200);
    }
}
