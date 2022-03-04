<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    //## DEPRECATED - Old Login Controller

    // use AuthenticatesUsers;
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     logger(' $credentials' ,[ $credentials ]);

    //     $this->validate($request, [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         ]);
    //         if (auth()->guard('developer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
    //             session(['user_type' => 'developer']);
    //             return redirect('developerHome');
    //         } else if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
    //             session(['user_type' => 'client']);
    //             return redirect('home');
    //         }
    //         else{
    //             return  redirect('home')->withErrors(['login', 'Login attempt failed']);
    //         }
    //     }

    //     public function login(Request $request)
    //     {

    //         //return json_encode(array('error' => $request->all()));

    //         try {

    //             if ($request->user()) {
    //                 $company = $request->user();
    //             }

    //         } catch (\Exception $e) {

    //             return json_encode(array('error' => '1005'));
    //         }

    //         if (is_null($company)) {

    //             return json_encode(array('error' => '1006'));
    //         }

    //         config([
    //             'database.connections.companyDatabase' =>
    //             [
    //                 "driver" => 'sqlsrv',
    //                 "host" => $company->dbHost,
    //                 "database" => $company->dbDatabase,
    //                 "port" => $company->dbPort,
    //                 "username" => $company->dbUser,
    //                 "password" => $company->dbPassword,
    //                 'charset' => 'utf8',
    //                 'prefix' => '',
    //                 'prefix_indexes' => true,
    //             ],

    //         ]);

    //         try {

    //             DB::connection('companyDatabase')->getPdo();
    //         } catch (\Exception $e) {

    //             return json_encode(array('error' => '1001'));
    //         }

    //         $login = $request->input('login');
    //         $password = $request->input('format') ? $request->input('format') : '';
    //         //return "request-" . $request->input('login');
    //         $thisEmployee = DB::connection('companyDatabase')
    //         ->table('employee')
    //         ->select('recordID', 'name', 'loginID', 'password', 'email', 'suspendedFlag', 'supervisorFlag', 'secGroupId')
    //         ->where('loginID', $login)
    //         ->first();

    //         //return json_encode(array('error' => 'Issues'));

    //         if (is_null($thisEmployee)) {

    //             return json_encode(array('error' => '1002'));
    //         }

    //         if ($thisEmployee->password !== $password) {

    //             return json_encode(array('error' => '1003'));
    //         }

    //         if ($thisEmployee->suspendedFlag !== '0') {

    //             return json_encode(array('error' => '1004'));
    //         }

    //         return json_encode(array('error' => '0'));

    //         // unset($thisEmployee->Password);
    //         // return json_encode($thisEmployee);
    //     }
}
