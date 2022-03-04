<?php

namespace App\Http\Middleware;

use App\ApiTrafficLog;
use App\TrafficLog;
use App\ErrorLog;
use Closure;

class TrafficLogging
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    
    public function handle($request, Closure $next)
    {
        // logger('API Was Triggered');
        // logger('$request->path()',json_encode($request->path()));
        // logger('$request->fullUrl();',json_encode($request->fullUrl()));

        $start = microtime(true);
        
        $response = $next($request);
        
        $request['executionTime'] = microtime(true) - $start;
        
        return $response;
        
    }
    
    public function terminate($request, $response)
    {
        // if ($request->path() != 'trafficlog' || $request->path() != 'utils') //may need to be readded.

        try
        {
            $executionTime = $request['executionTime'];
            
            unset($request['executionTime']);
            
            $trafficLog = new TrafficLog;

            $trafficLog->ip = strval($request->ip());
            $trafficLog->url = strval($request->fullUrl());
            $trafficLog->method = strval($request->method());
            $trafficLog->executionTime =  isset($executionTime) ? $executionTime : null;
            $trafficLog->httpStatusCode = $response->getStatusCode();
            $trafficLog->clientId = isset($request->user()['clientId']) ? strval($request->user()['clientId']) : 0;
            $trafficLog->developerId = isset($request->user()['developerId']) ? strval($request->user()['developerId']) : 0;

            $trafficLog->save();

        } catch(\Exception $exception)  {
            

            $errorLog = new ErrorLog;

            $errorLog->ip = "Server Error";
            $errorLog->application = "API";
            $errorLog->message = strval($exception->getMessage());
            $errorLog->file = strval($exception->getFile());
            $errorLog->line = strval($exception->getLine());

            $errorLog->save();

        }

    }
}
