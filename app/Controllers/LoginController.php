<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class LoginController extends BaseController
{
   private $usersModel;
   private $clientsModel;
   public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
   {
      parent::initController($request, $response, $logger);
      helper(['Request', 'Response']);
      $this->usersModel = new \App\Models\UsersModel;
      $this->clientsModel = new \App\Models\ClientsModel;
   }

   public function signInUser()
   {
      $body = getBody();

      if (
         !$this->validate([
            "email" => "required|max_length[254]|valid_email",
            "password" => "required|max_length[255]|min_length[6]"
         ])
      ) {
         return responseKWR(['return' => false, 'message' => 'error fields', 'data' => $this->validator->getErrors()], 406);
      }

      if (empty($findUser = $this->usersModel->find(["email" => $body->email]))) {
         return responseKWR(['return' => false, 'message' => lang('Validation.error.user.notFound')], 406);
      }

      if (!password_verify($body->password, $findUser['password'])) {
         return responseKWR(['return' => false, 'message' => lang('Validation.error.user.notFound')], 406);
      }

      $encrypter = \Config\Services::encrypter();
      $key = getenv('jwt.secret');
      $message = $key . $findUser["email"] . $key;
      $email = base64_encode($encrypter->encrypt($message));
      $iat = time();
      $exp = $iat + 3600;

      $payload = array(
         "iss" => $findUser['email'],
         "aud" => "KWR",
         "sub" => $findUser['uuid'],
         'awt' => 'usuario',
         "iat" => $iat,
         "exp" => $exp,
         "email" => $email,
      );

      $token = \Firebase\JWT\JWT::encode($payload, $key, 'HS256');

      return responseKWR(['return' => true, 'message' => 'success', 'data' => $token], 200);
   }

   public function signUpUser()
   {
      $body = getBody();
      if (
         !$this->validate(
            [
               'name' => "required|max_length[254]",
               "document" => "required|max_length[14]|min_length[11]",
               "email" => "required|max_length[254]|valid_email",
               "password" => "required|max_length[255]|min_length[6]",
            ]
         )
      ) {
         return responseKWR(['return' => false, 'message' => 'error fields', 'data' => $this->validator->getErrors()], 406);
      }
      //todo Error Not found User
      if (!empty($this->usersModel->find(['email' => $body->email, 'document' => $body->document]))) {
         return responseKWR(['return' => false, 'message' => lang('Validation.error.user.alreadyRegistered')], 406);
      }

      $this->usersModel->insert([
         "uuid" => Uuid::uuid4()->toString(),
         "fk_company" => 1,
         "name" => $body->name,
         "document" => $body->document,
         "email" => $body->email,
         "password" => password_hash($body->password, PASSWORD_ARGON2I),
      ]);

      return responseKWR(['return' => true, 'message' => 'success'], 200);
   }

   public function signInClient()
   {
      $body = getBody();

      if (
         !$this->validate([
            "email" => "required|max_length[254]|valid_email",
            "password" => "required|max_length[255]|min_length[6]"
         ])
      ) {
         return responseKWR(['return' => false, 'message' => 'error fields', 'data' => $this->validator->getErrors()], 406);
      }

      if (empty($findClient = $this->clientsModel->find(["email" => $body->email]))) {
         return responseKWR(['return' => false, 'message' => lang('Validation.error.user.notFound')], 406);
      }

      if (!password_verify($body->password, $findClient['password'])) {
         return responseKWR(['return' => false, 'message' => lang('Validation.error.user.notFound')], 406);
      }

      $encrypter = \Config\Services::encrypter();
      $key = getenv('jwt.secret');
      $message = $key . $findClient["email"] . $key;
      $email = base64_encode($encrypter->encrypt($message));
      $iat = time();
      $exp = $iat + 3600;

      $payload = array(
         "iss" => $findClient['email'],
         "aud" => "KWR",
         "sub" => $findClient['uuid'],
         'awt' => 'client',
         "iat" => $iat,
         "exp" => $exp,
         "email" => $email,
      );

      $token = \Firebase\JWT\JWT::encode($payload, $key, 'HS256');

      return responseKWR(['return' => true, 'message' => 'success', 'data' => $token], 200);
   }

   public function signUpClient()
   {
      $body = getBody();

      if (
         !$this->validate(
            [
               'name' => "required|max_length[254]",
               "document" => "required|max_length[14]|min_length[11]",
               "email" => "required|max_length[254]|valid_email",
               "password" => "required|max_length[255]|min_length[6]",
            ]
         )
      ) {
         return responseKWR(['return' => false, 'message' => 'error fields', 'data' => $this->validator->getErrors()], 406);
      }

      //todo Error Not found Client
      if (!empty($this->clientsModel->find(['email' => $body->email, 'document' => $body->document]))) {
         return responseKWR(['return' => false, 'message' => lang('Validation.error.user.alreadyRegistered')], 406);
      }

      $this->clientsModel->insert([
         "uuid" => Uuid::uuid4()->toString(),
         "fk_company" => 1,
         "name" => $body->name,
         "document" => $body->document,
         "email" => $body->email,
         "password" => password_hash($body->password, PASSWORD_ARGON2I),
      ]);

      return responseKWR(['return' => true, 'message' => 'success'], 200);
   }
}
