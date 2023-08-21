<?php

namespace FgutierrezPHP\AddresesRd\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait InteractsWithHttpResponse
{
    /**
     * @param array $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function success(array $data, string $message = null, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()
            ->json([
                'data' => $data,
                'message' => $message
            ], $status);
    }

    /**
     * @param string|null $message
     * @param array $errors
     * @param int $code
     * @param int $status
     * @return JsonResponse
     */
    protected function error(string $message, array $errors = [], int $code = Response::HTTP_INTERNAL_SERVER_ERROR, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()
            ->json([
                'code' => $code,
                'message' => $message,
                'errors' => $errors
            ], $status);
    }
}
