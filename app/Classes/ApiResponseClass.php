<?php

namespace App\Classes;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function rollback($e, $message = "Something went wrong! Process not completed"): void
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message){
        Log::info($e);
        throw new HttpResponseException(response()->json([
            "success"=> false,
            "message"=> $message
        ], $e->getCode() ? $e->getCode() : 500));
    }

    public static function sendResponse($data, $message = '', $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => !empty($message) ? $message : null,
            'data' => !empty($data['data']) ? $data['data'] : null,
            'meta' => !empty($data['meta']) ? $data['meta'] : null,
        ];

        $response = array_filter($response, function($value) {
            return !is_null($value);
        });

        return response()->json($response, $code);
    }
}
