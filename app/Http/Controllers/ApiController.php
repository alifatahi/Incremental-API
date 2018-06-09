<?php
/**
 * Created by PhpStorm.
 * User: West
 * Date: 5/19/2018
 * Time: 11:28 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;
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
        return $this
            ->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }


    /**
     * @param  $lessons
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithPagination($lessons, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $lessons->total(),
                'total_pages' => ceil($lessons->total() / $lessons->perPage()),
                'current_page' => $lessons->currentPage(),
                'limit' => $lessons->perPage()
            ],
        ]);
        return $this->respond($data);
    }


    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this
            ->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message);
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($message)
    {
        return $this
            ->setStatusCode(IlluminateResponse::HTTP_CREATED)
            ->respond(['message' => $message]);
    }
}
