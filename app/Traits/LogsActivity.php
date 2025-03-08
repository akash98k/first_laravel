<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait LogsActivity
{
    /**
     * Log incoming request
     *
     * @param  Request  $request
     * @param  string  $type
     * @return void
     */
    protected function logRequest(Request $request, $type = 'info')
    {
        $message = 'REQUEST ' . $request->method() . ' ' . $request->fullUrl();
        
        $logData = [
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'parameters' => $this->filterSensitiveData($request->all()),
            'headers' => $this->filterSensitiveHeaders($request->headers->all()),
        ];
        
        if (auth()->check()) {
            $logData['user_id'] = auth()->id();
        }
        
        Log::$type($message, $logData);
    }

    /**
     * Log outgoing response
     *
     * @param  mixed  $response
     * @param  string  $type
     * @return void
     */
    protected function logResponse($response, $type = 'info')
    {
        $responseData = null;
        $statusCode = null;
        
        if (method_exists($response, 'getStatusCode')) {
            $statusCode = $response->getStatusCode();
        }
        
        if (method_exists($response, 'getData')) {
            $responseData = $response->getData();
        }
        
        $message = 'RESPONSE Status: ' . $statusCode;
        
        Log::$type($message, [
            'data' => $responseData,
            'status_code' => $statusCode
        ]);
    }

    /**
     * Filter sensitive data from request parameters
     *
     * @param  array  $data
     * @return array
     */
    protected function filterSensitiveData($data)
    {
        $sensitiveFields = ['password', 'password_confirmation', 'credit_card', 'token'];
        
        foreach ($sensitiveFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = '********';
            }
        }
        
        return $data;
    }

    /**
     * Filter sensitive headers
     *
     * @param  array  $headers
     * @return array
     */
    protected function filterSensitiveHeaders($headers)
    {
        $sensitiveHeaders = ['authorization', 'cookie'];
        
        foreach ($sensitiveHeaders as $header) {
            if (isset($headers[$header])) {
                $headers[$header] = ['********'];
            }
        }
        
        return $headers;
    }
}
