<?php
/**
 * Created by PhpStorm.
 * User: West
 * Date: 5/19/2018
 * Time: 11:28 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

/**
 * Class ApiController
 *  This class is for Create Response Method
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * @var
     *  Default is Success
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param string $message
     */
    public function respondNotFound($message = "Not Found")
    {
//        Set Status Code then Error Message
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }


    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
//        Return Response with data , status code , headers
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
//        Declare Error Respond
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}
