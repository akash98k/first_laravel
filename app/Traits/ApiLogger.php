<?php

namespace App\Traits;

use App\Models\ApiLog;
use Illuminate\Http\Request;

trait ApiLogger
{
    /**
     * Log API request and response to database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $response
     * @param  float  $executionTime
     * @return void
     */
    public function logToDatabase(Request $request, $response, $executionTime = null)
    {
        $statusCode = method_exists($response, 'getStatusCode') ? $response->getStatusCode() : 200;
        
        $responseData = null;
        if (method_exists($response, 'getData')) {
            $responseData = $response->getData(true);
        } elseif (method_exists($response, 'getContent')) {
            try {
                $responseData = json_decode($response->getContent(), true);
            } catch (\Exception $e) {
                $responseData = ['data' => 'Non-JSON response'];
            }
        }

        ApiLog::create([
            'user_id' => auth()->id(),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'payload' => $this->filterSensitiveData($request->all()),
            'response' => $responseData,
            'status_code' => $statusCode,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'execution_time' => $executionTime,
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
}
