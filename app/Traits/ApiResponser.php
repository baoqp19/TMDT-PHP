<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    /**
     * Trả về phản hồi thành công.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data = null, $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'SUCCESS',
            'message' => $message ?? 'Operation completed successfully.',
            'data' => $data
        ], $code);
    }

    /**
     * Trả về phản hồi lỗi.
     *
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse(string $message = null, int $code = 400): JsonResponse
    {
        return response()->json([
            'status' => 'FAIL',
            'message' => $message ?? 'An error occurred.',
            'data' => null
        ], $code);
    }
}
