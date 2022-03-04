<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;

class DeveloperAuth extends Middleware
{
    
    /**
    * Get the path the user should be redirected to when they are not authenticated.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return string
    */
    public function __construct(Auth $auth)
    {
        // logger('construct : auth',[$auth]);
        $this->auth = $auth;
    }
    
    protected function redirectTo($request)
    {
        // logger('redirectTo',[]);
        if (!$request->expectsJson()) {
            
            return abort(401);
            
        }
    }
    public function handle($request, Closure $next, ...$guards)
    {
        // logger('handle : guards',[$guards]);
        $this->authenticate($request, $guards);
        return $next($request);
    }
    protected function authenticate($request, array $guards)
    {
        
        
        
        // logger('authenciate :guards',[$guards]);
        if ($this->auth->guard('developer')->check()) {
            return $this->auth->shouldUse('developer');
        }
        
        
        $this->unauthenticated($request, $guards);
    }
    
    
    protected function unauthenticated($request, array $guards)
    {
        // logger('unauthenticated : guards',[$guards]);
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }
}
