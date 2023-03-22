<?php

namespace App\Traits;

trait Response
{
    /**
     * @param  array<string, mixed>  $data
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
     * @param  array<string, mixed>  $data
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
