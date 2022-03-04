<?php

namespace App\Http\Middleware;

use App\ApiAccess;
use App\Client;
use App\Custom\CompanyDatabase;
use Closure;

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
