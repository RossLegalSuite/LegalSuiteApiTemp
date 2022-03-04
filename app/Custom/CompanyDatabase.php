<?php

namespace App\Custom;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


use Illuminate\Database\QueryException;

class CompanyDatabase
{
    
    public static function setConfig($company)
    {
        
        //if ( \Config::get('app.env') !== 'local' ) {
        //if ( !App::environment('local') ) {           
        
            
            // $SqlSrvOptions = array(
            //     \PDO::SQLSRV_ATTR_FORMAT_DECIMALS => true,
            //     \PDO::ATTR_TIMEOUT => 1,
            //     \PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1,
            //     \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            // );
        
        //} else {
        //    $SqlSrvOptions = [];
        //}
        
        
        config(['database.connections.sqlsrv' =>
            [
                'driver' => 'sqlsrv',
                "host" => $company[0]["dbHost"],
                "database" => $company[0]["dbDatabase"],
                "port" => $company[0]["dbPort"],
                "username" => $company[0]["dbUser"],
                "password" => $company[0]["dbPassword"],
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
                'options' => array(
                    \PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 0,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::SQLSRV_ATTR_CLIENT_BUFFER_MAX_KB_SIZE => 102400,
                )
            ]
        ]);
                
        //\PDO::ATTR_PERSISTENT => true,
        //logger('database.connections.sqlsrv',config(['database.connections.sqlsrv']));

            
    }
        
    public static function setConnection($companyId) {

        $company = DB::table('companies')->find($companyId);
        
        config(['database.connections.company' =>
            [
                'driver' => 'sqlsrv',
                "host" => $company->dbHost,
                "database" => $company->dbDatabase,
                "port" => $company->dbPort,
                "username" => $company->dbUser,
                "password" => $company->dbPassword,
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
            ]
        ]);


                
        //\PDO::ATTR_TIMEOUT => 5,
        return DB::connection('company');
    }
}
        
        
        
        