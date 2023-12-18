<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function apiResponse($title = null, $data = null, $message = null, $status = 200): JsonResponse
    {
        $array = ["$title" => $data, "message" => $message, "status" => $status];
        return response()->json($array, $status);
    }
}
