<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 5/15/19
 * Time: 8:14 PM
 */

namespace App\Http\Controllers;

use App\Http\Api\StructuringDataForApi;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    /**
     * @param $data
     * @param bool $success
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function createApiResponse(
        int $statusCode,
        string $message,
        bool $success = true,
        $data = null
    ): JsonResponse
    {
        $structuringDataFromApi = new StructuringDataForApi(
            $success,
            $data,
            $message
        );

        return response()->json($structuringDataFromApi->getStructuringDataForApi(), $statusCode);
    }
}