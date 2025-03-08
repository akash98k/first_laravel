<?php

namespace App\Traits;

trait HttpResponse
{
    /**
     * Return success response
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = [], $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return error response
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message = 'Error', $code = 400, $errors= [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    /**
     * Return validation error response
     *
     * @param  array  $errors
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationError($errors = [], $message = 'Validation failed')
    {
        return $this->errorResponse($message, 422, $errors);
    }
    
    /**
     * Return not found response
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFoundResponse($message = 'Resource not found')
    {
        return $this->errorResponse($message, 404);
    }
}
