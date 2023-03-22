<?php

namespace App\Traits;

trait Response
{
    /**
     * @param  mixed  $data
     * @param string $message
     * @param int $status
     */
    public function success(string $message, $data = [], int $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * @param  mixed  $data
     * @param string $message
     * @param int $status
     */
    public function error(string $message, $data = [], int $status = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
