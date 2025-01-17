<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
trait ApiResponse
{
    /**
     * Success response method.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function successResponse($data, $message = 'Success', $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ], $status);
    }

    /**
     * Error response method.
     *
     * @param string $message
     * @param int $status
     * @param mixed $data
     * @return JsonResponse
     */
    protected function errorResponse($message = 'Error', $status = 400, $data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ], $status);
    }

    /**
     * Custom response method.
     *
     * @param string $status
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function customResponse($status, $message, $data = null, $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ], $statusCode);
    }

    /**
     *
     * Custom Validation error Laravel
     *
     */
//    protected function failedValidation(Validator $validator)
//    {
//        $errors = $validator->errors();
//
//        $response = response()->json([
//            'status' => 422,
//            'message' => 'Validation failed',
//            'errors' => $errors,
//        ], 422);
//
//        throw new HttpResponseException($response);
//    }
}
