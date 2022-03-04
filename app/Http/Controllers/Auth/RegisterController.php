<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Developer;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'company_name' => ['required', 'string', 'max:255','unique:clients'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerDeveloper()
    {
        return view('registerDeveloper');
    }

    public function createDeveloper(Request $request)
    {
        $newDeveloper = new Developer;
        $newDeveloper->company_name = $request->company_name;
        $newDeveloper->name = $request->name;
        $newDeveloper->email = $request->email;
        $newDeveloper->password = Hash::make($request->password);
        $newDeveloper->developer_token = base64_encode(random_bytes(64));
        if (isset($request->getAccessFlag)) {
            $newDeveloper->getAccessFlag = 1;
        }
        if (isset($request->postAccessFlag)) {
            $newDeveloper->postAccessFlag = 1;
        }
        if (isset($request->putAccessFlag)) {
            $newDeveloper->putAccessFlag = 1;
        }
        if (isset($request->deleteAccessFlag)) {
            $newDeveloper->deleteAccessFlag = 1;
        }

        $newDeveloper->save();

        return view('registerDeveloper');
    }

    protected function create(array $data)
    {
        return Client::create([
            'name' => $data['name'],
            'company_name' => $data['company_name'],
            // 'user_type' => $data['user_type'],
            'email' => $data['email'],
            'website' => $data['website'],
            'password' => Hash::make($data['password']),
            // 'dbHost' => $data['dbHost'],
            // 'dbPort' => $data['dbPort'],
            // 'dbDatabase' => $data['dbDatabase'],
            // 'dbUser' => $data['dbUser'],
            // 'dbPassword' => $data['dbPassword']

        ]);
    }

    public function testDatabaseConnection(Request $request)
    {
        $returnData = (object) [];

        config([
            'database.connections.companyDatabase' => [
                'driver' => 'sqlsrv',
                'host' => $request->dbHost,
                'database' => $request->dbDatabase,
                'port' => $request->dbPort,
                'username' => $request->dbUser,
                'password' => $request->dbPassword,
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
            ],
        ]);

        // Check if we can connect to the remote server
        try {
            DB::connection('companyDatabase')->getPdo();
        } catch (\Exception $e) {
            $returnData->error = 'Unable to connect to the Company ('.$request->companyName.').<br><br>'.$e->getMessage();

            return json_encode($returnData);
        }
        $returnData->success = 'Successful connection to the Company ('.$request->companyName.')';
        // return json_encode($request->user()->appId);
        return json_encode($returnData);
    }

    public function registerClient(Request $request)
    {

        // return Redirect::to('/login',301,compact('message'));

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dbHost' => ['required', 'string', 'max:255', 'unique:clients'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            if ($this->testDatabaseConnection($request) != '{"success":"Successful connection to the Company ('.$request->companyName.')"}') {
                return Redirect::back()->withErrors($this->testDatabaseConnection($request));
            }

            $companyControl = DB::connection('companyDatabase')->table('control')->first();

            $thisClient = Client::create([
                'name' => $request->name,
                'company_name' => $companyControl->Name,
                'firmcode' => $companyControl->FirmCode,
                'email' => $request->email,
                'website' => $request->website,
                'password' => Hash::make($request->password),
                // 'api_token' =>  $token = base64_encode(random_bytes(64)),

            ]);

            $client = $thisClient;

            // $client->company_name = $companyControl->Name;
            // $client->firmcode = $companyControl->FirmCode;

            $client->dbHost = $request['dbHost'];
            $client->dbPort = $request['dbPort'];
            $client->dbDatabase = $request['dbDatabase'];
            $client->dbUser = $request['dbUser'];
            $client->dbPassword = $request['dbPassword'];

            $client->save();
        }

        return Redirect::to('/login')->with('success', true)->with('message', 'Successfully Registered, Please log in.');

        // $returnData->success = "Successfully Registered ' .$client->company_name.' please use the Firmcode : '.$client->firmcode.' to log in.";
        // $returnData->company_name = $client->company_name;
        // $returnData->firmcode = $client->firmcode;
        // // return json_encode($request->user()->appId);
        // return json_encode($returnData);

        // // return $response;
        // return 'Successfully Registered ' .$client->company_name.' please use the Firmcode : '.$client->firmcode.' to log in.';
    }
}
