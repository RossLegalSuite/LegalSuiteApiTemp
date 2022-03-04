<?php

namespace App\Http\Controllers;

use App\Client;
use App\Developer;
use App\ApiAccess;
use DB;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function updateClient(Request $request)
    {
        // return '"success":"Successful connection to the Company ('.$request['companyName'].')"'.'-----'.$this->testDatabaseConnection($request);
        if ($this->testDatabaseConnection($request) != '{"success":"Successful connection to the Company ('.$request['companyName'].')"}')
        return $this->testDatabaseConnection($request);
        
        
        $client = Client::find($request->user()->id);
        
        
        $client->dbHost = $request['dbHost'];
        $client->dbPort = $request['dbPort'];
        $client->dbDatabase = $request['dbDatabase'];
        $client->dbUser = $request['dbUser'];
        $client->dbPassword = $request['dbPassword'];
        
        $client->save();
        
        
        return view('home');
        
    }
    
    public function testDatabaseConnection(Request $request)
    {
        // logger("test Request",[$request->all()]);
        $returnData = (object) [];
        
        config([
            'database.connections.companyDatabase' =>
            [
                "driver" => 'sqlsrv',
                "host" => $request->dbhost,
                "database" => $request->dbdatabase,
                "port" => $request->dbport,
                "username" => $request->dbuser,
                "password" => $request->dbpassword,
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => true,
            ],
            ]);
            
            // Check if we can connect to the remote server
            try 
            {
                
                DB::connection('companyDatabase')->getPdo();
            } catch (\Exception $e) {
                
                $returnData->errors= "Unable to connect to the Company (" . $request->company_name . ").<br><br>" . $e->getMessage();
                
                return json_encode($returnData);
            }
            $returnData->success = "true";
            $returnData->response = "Successful connection to the Company (" . $request->company_name . ")";
            // return json_encode($request->user()->appId);
            return json_encode($returnData);
            
            
    }

    public function register(Request $request)
    {
        
        $returnData = (object) [];
        if (!$request->header('Authorization')) {
            return json_encode(array('error' => 'No Developer Token Supplied'));
            
        }
        // return Developer::where('developer_token', '=',  $request->header('Authorization'))->firstOrFail();
        if (!Developer::where('developer_token', '=',  $request->header('Authorization'))->first()) {
            return json_encode(array('error' => 'Developer Token incorrect'));
            
        }
        
        // $response = array('response' => '', 'success'=>false);
        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'dbhost' => ['required', 'string', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            $response['success'] = false;
            return $response;
        } else {
            
            $testConnection = $this->testDatabaseConnection($request);

            if (isset($testConnection->success)) {

                return $testConnection;
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
                
                
                $client->dbHost = $request['dbhost'];
                $client->dbPort = $request['dbport'];
                $client->dbDatabase = $request['dbdatabase'];
                $client->dbUser = $request['dbuser'];
                $client->dbPassword = $request['dbpassword'];
                
                $client->save();
            }
                
        $developer = Developer::where('developer_token', '=',  $request->header('Authorization'))->first();
        
        $apiAccess = DB::table('api_access')->where('clientId', $client->id)->where('developerId',  $developer->id);
        
        
        if ($apiAccess->get()->isEmpty())
        {
            $newApiAccess = new ApiAccess;
            
            $newApiAccess->clientId = $client->id;
            $newApiAccess->developerId = $developer->id;
            $newApiAccess->grantAccess = 1;
            
            $newApiAccess->api_token = base64_encode(random_bytes(64)); 
            
            $newApiAccess->getAccessFlag = $developer->getAccessFlag;
            $newApiAccess->postAccessFlag = $developer->postAccessFlag;
            $newApiAccess->putAccessFlag = $developer->putAccessFlag;
            $newApiAccess->deleteAccessFlag = $developer->deleteAccessFlag;
            
            $newApiAccess->save();      
        }
        
        $returnData->success = "Successfully Registered ' .$client->company_name.' please use the Firmcode : '.$client->firmcode.' to log in.";
        $returnData->company_name = $client->company_name;
        $returnData->firmcode = $client->firmcode;
        logger('$returnData',[$returnData]);
        // return json_encode($request->user()->appId);
        return json_encode($returnData);
        
            // // return $response;
            // return 'Successfully Registered ' .$client->company_name.' please use the Firmcode : '.$client->firmcode.' to log in.';
    }

    public function checkRegister(Request $request)
    {
        $returnData = (object) [];

        $validator =  Validator::make($request->all(), [
            'firmcode' => ['required', 'string', 'max:255']
            ]);
            
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
                return $response;
            
        }

        if (!$request->header('Authorization')) {
            throw new \Exception("No Developer Token Supplied.");
            
        }

        $developer = Developer::where('developer_token', '=',  $request->header('Authorization'))->first();
        if (!$developer) {
            throw new \Exception("Developer Token Incorrect.");
            
        }

        $client = Client::where('firmcode', '=',  $request->firmcode)->first();
        if (!$client) {
            $response['response'] = "Client not Registered";

            return $response;
            
        }

        $apiAccess = ApiAccess::where('developerID', '=',  $developer->id)->where('clientID', '=',  $client->id)->first();
        if (!$apiAccess) {
            $newApiAccess = new ApiAccess;
                    
            $newApiAccess->clientId = $client->id;
            $newApiAccess->developerId = $developer->id;
            $newApiAccess->grantAccess = 1;
            
            $newApiAccess->api_token = base64_encode(random_bytes(64)); 
            
            $newApiAccess->getAccessFlag = $developer->getAccessFlag;
            $newApiAccess->postAccessFlag = $developer->postAccessFlag;
            $newApiAccess->putAccessFlag = $developer->putAccessFlag;
            $newApiAccess->deleteAccessFlag = $developer->deleteAccessFlag;
            
            $newApiAccess->save();    
            
            $returnData->success = "Registration Successful";
        
            return json_encode($returnData);
            
        }

        $returnData->success = "Registered";
        
        return json_encode($returnData);

    }
            
}
        
        
        