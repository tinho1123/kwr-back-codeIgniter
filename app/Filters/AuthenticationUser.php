<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;

class AuthenticationUser implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('Response');
        $usersModel = new \App\Models\UsersModel;

        $encrypter = \Config\Services::encrypter();
        if (empty($getAuthorization = $request->getHeaderLine("Authorization"))) {
            return responseKWR(["return" => false, "message" => lang("Validation.error.authorization.notFound")], 401);
        }
        $getAuthorization = str_replace("Bearer ", "", $getAuthorization);
        $jwt = JWT::decode($getAuthorization, new Key(getenv("jwt.secret"), 'HS256'));

        $authorizationData = $encrypter->decrypt(base64_decode($jwt->email));
        $email = str_replace(getenv('jwt.secret'), '', $authorizationData);

        if (empty($user = $usersModel->where(["email" => $email])->first())) {
            return responseKWR(["return" => false, 'message' => lang('Validation.error.user.notFound')], 401);
        }

        $request->setHeader('USER', $user);
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
