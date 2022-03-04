<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuspended
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
        // $x = $request->user();
        // if (isset($x)) {
            
            //     return abort(401);
            
            // } else
            
            if ($request->user()->isNotActive > 0) {
                
                return abort(403);
                
            }
            
            return $next($request);
        }
    }
    