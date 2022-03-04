<?php

namespace App\Http\Middleware;

use Closure;

class KeysToLower
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
        
   
        
        $requestAll = $request->all();
        
        foreach ($requestAll as $key => $value) {
            unset($request[$key]);
            $data[strtolower($key)] = $value;
            $request->merge($data);
            
        }

        
        
        return $next($request);
    }
}
