<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RequestResponseLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       
        $this->logRequest($request);
        
  
        $response = $next($request);
        
    
        $this->logResponse($request, $response);
        
        return $response;
    }

    /**
     * Log request details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function logRequest(Request $request)
    {
        $data = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'payload' => $this->filterSensitiveData($request->all()),
        ];
        
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
            $data['user_email'] = auth()->user()->email;
        }
        
        Log::info('API REQUEST', $data);
    }

    /**
     * Log response details
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    private function logResponse(Request $request, $response)
    {
        $responseData = null;
        
        // If it's a JSON response, get the data
        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $responseData = json_decode($response->content(), true);
        }
        
        $data = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'status' => $response->getStatusCode(),
            'response' => $responseData,
        ];
        
        $logMethod = $response->isSuccessful() ? 'info' : 'error';
        Log::$logMethod('API RESPONSE', $data);
    }

    /**
     * Filter sensitive data
     *
     * @param  array  $data
     * @return array
     */
    private function filterSensitiveData($data)
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
