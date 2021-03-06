<?php

namespace App\Exceptions;

use App\Http\Api\StructuringExceptionDataForApi;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     * @return JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ApiModelNotFound) {
            return $this->createErrorApiResponse($exception->getMessage(), 404);
        }

        if ($exception instanceof ApiAuthentication) {
            return $this->createErrorApiResponse($exception->getMessage(), 401);
        }

        if ($exception instanceof ApiUserRegister) {
            return $this->createErrorApiResponse($exception->getMessage(), 422);
        }

        return parent::render($request, $exception);
    }

    /**
     * @param string $message
     * @param int    $code
     * @return JsonResponse
     */
    protected function createErrorApiResponse(string $message, int $code): JsonResponse
    {
        $structuringDataFromApi = new StructuringExceptionDataForApi(
            $message,
            $code
        );

        return response()->json($structuringDataFromApi->getStructuringDataForApi(), $code);
    }
}
