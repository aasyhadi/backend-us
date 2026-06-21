<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function successResponse(
        string $message,
        mixed $data = null,
        int $status = 200,
        array $meta = []
    ) {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status);
    }

    protected function errorResponse(
        string $message,
        int $status = 400,
        mixed $errors = null
    ) {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }
}
