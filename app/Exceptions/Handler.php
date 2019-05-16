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
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ApiModelNotFoundException) {

            return $this->createErrorApiResponse($exception->getMessage() , 404);
        }

        if ($exception instanceof ApiAuthenticationException) {

            return $this->createErrorApiResponse($exception->getMessage() , 401);
        }

        return parent::render($request, $exception);
    }

    protected function createErrorApiResponse(string $message, int $code): JsonResponse
    {
        $structuringDataFromApi = new StructuringExceptionDataForApi(
            $message,
            $code
        );

        return response()->json($structuringDataFromApi->getStructuringDataForApi(), $code);
    }
}
