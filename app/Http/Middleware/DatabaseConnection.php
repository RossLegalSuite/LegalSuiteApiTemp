<?php

namespace App\Http\Middleware;

use Closure;
use App\Custom\CompanyDatabase;
use App\Client;
use App\ApiAccess;

class DatabaseConnection
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
        $company = Client::where('id', $request->user()->clientId)
        ->get();
        // logger('handle $company',[$company]);
        CompanyDatabase::setConfig($company->all());
        return $next($request);
    }
}
