<?php

namespace App\Http\Controllers;

use App\Client;
use App\ApiAccess;
use App\Developer;
use App\Custom\CompanyDatabase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\GenericTableModels\docgen;
use App\GenericTableModels\licensed;
use Illuminate\Support\Facades\Schema;
use App\Custom\Utils;
use Carbon\Carbon;

class AuthController extends Controller
{
    
    public function auth(Request $request) {

        try {

            if (!$request->header('Authorization')) {
                return json_encode(array('error' => 'No Developer Token specified'));
            }

            if (!Developer::where('developer_token',  $request->header('Authorization'))->first()) {
                return json_encode(array('error' => 'Developer Token incorrect'));
            }
            
            if (!$request->company) {
                return json_encode(array('error' => 'No Company Code specified'));
                
            }
            if (!$request->login) {
                return json_encode(array('error' => 'No Login specified')); 
            }

            $company = Client::where('firmcode', $request->company)->first();

            if (!$company) {
                return json_encode(array('error' => 'Company (' . $request->company) . ') not found');
            }

            $developer = Developer::where('developer_token',  $request->header('Authorization'))->first();

            $apiAccessDetails = ApiAccess::where('clientid',  $company->id)->where('developerid' , $developer->id)->firstOrFail();

            if (!$apiAccessDetails) {

                $this->grantApiAccess($company->id, $developer);

            } else {

                if ($apiAccessDetails->grantedAccess = 0) {
                    return json_encode(array('error' => 'API Access to the Company has not been granted'));
                }

            }
            
            $login = $request->login;
            $password = $request->password ? $request->password : '';
            
            CompanyDatabase::setConfig($company->all());
            
            $control = DB::connection('sqlsrv')->table('control')->first();

            $employeeQuery = DB::connection('sqlsrv')
            ->table('employee')
            ->select('recordid', 'name', 'loginid', 'password', 'email', 'suspendedflag', 'supervisorflag', 'secgroupid','usemattercostcentreflag')
            ->where('loginID', $login);

            if ($control->EncryptPasswords) {
                $employeeQuery->whereRaw('password = CONVERT(VARCHAR(32), HashBytes(?, CONVERT(VARCHAR,?)), 2)', ['MD5',$password]);
            } else {
                $employeeQuery->where('password',$password);
            }

            $thisEmployee = $employeeQuery->first();

            unset($thisEmployee->password);

            if (is_null($thisEmployee)) {
                return json_encode(array('error' => 'Invalid Username or Incorrect Password'));
            }

            if ($thisEmployee->suspendedflag !== '0') {
                return json_encode(array('error' => 'This User is Suspended'));
            }

            // *****************************************************************
            // Check if the User is licensed for this Document Set in LegalSuite
            // *****************************************************************
            if ( isset($request->docgencode) && ( $request->docgencode === 'LOLNEW' || $request->docgencode === 'MOBILE')) {

                $docgenRecord = DB::connection('sqlsrv')
                ->table('docgen')
                ->where('code', $request->docgencode)
                ->first();

                if (!$docgenRecord) {

                    // ***********************************************
                    // Create the Document Set & licence it for 1 user
                    // ***********************************************
                    $docgen = new docgen;
                    $docgen->recordid = $docgen::max($docgen->getKeyName()) + 1;
                    $docgen->code = $request->docgencode;
                    $docgen->type = 'DES';
                    $docgen->primarydirectory = '';
                    $docgen->noofusers = 1;

                    $docgen->licencenumber = \App\Custom\Utils::generateLicenceNumber($control->Name,$request->docgencode,1);

                    if ($request->docgencode === 'LOLNEW') {
                        $docgen->description = 'LegalSuite Online (New)';
                    } else if ($request->docgencode === 'MOBILE') {
                        $docgen->description = 'LegalSuite Mobile App';
                    }

                    $docgen->save();
                    
                    // Give them one free user as a 'Trial'
                    $licenced = new licensed;
                    $licenced->docgenid = $docgen->recordid;
                    $licenced->employeeid = $thisEmployee->recordid;
                    $licenced->save();

                    // ********************************************
                    // Update the Client database 
                    // https://roytuts.com/consume-soap-web-service-in-php/
                    // ********************************************

                    try {

                        $client = new \SoapClient('http://services.legalsuite.co.za/LicenseService.svc?wsdl');
                        
                        $params = array(
                            'pFirmCode' => $company->firmcode,
                            'pLicenceValidUntil' => $control->LicenceValidUntil,
                            'DocGen' => $request->docgencode,
                            'Required' => 35,
                            'User' => $request->docgencode . ' Trial'            
                        );

                        /* Test in Tinker        
                        try {            
                            $client = new \SoapClient('http://services.legalsuite.co.za/xLicenseService.svc?wsdl');  // The trace param will show you errors
                            $params = array(
                                'pFirmCode' => 'ACME01',
                                'pLicenceValidUntil' => 80812,
                                'DocGen' => 'LOLNEW',
                                'Required' => 35,
                                'User' => 'LOLNEW Trial'            
                            );
                            $licenceResponse = $client->ApplyForLegalSuiteLicences($params);

                            echo $licenceResponse->ApplyForLegalSuiteLicencesResult;

                        } catch(\Exception $e)  {
                            echo 'xxxxxxxxxxxxxxx' . $e->getMessage();
                        }


                        */

                        $licenceResponse = $client->ApplyForLegalSuiteLicences($params);

                        if ( $licenceResponse->ApplyForLegalSuiteLicencesResult == '-1') {
                            return json_encode(array('error' => 'An Error was encountered adding the Licence details to the LegalSuite Client Database'));
                        }

                    } catch(\Exception $e)  {
                        return json_encode(array('error' => 'An Error was encountered accessing the WSDL Licensing system: ' . $e->getMessage()));
                    }

                } else {

                    $licensedRecord = DB::connection('sqlsrv')
                    ->table('licensed')
                    ->where('docgenid', $docgenRecord->RecordID)
                    ->where('employeeid', $thisEmployee->recordid)
                    ->first();

                    if (!$licensedRecord) {

                        if ($request->docgencode === 'LOLNEW') {
                            return json_encode(array('error' => '<p>This User is not licensed to use LegalSuite Online.</p><p>Please add this Employee to the list of licensed Users for the Document Set (LOLNEW).</p>'  ));
                        } else if ($request->docgencode === 'MOBILE') {
                            return json_encode(array('error' => 'This User is not licensed to use the LegalSuite Mobile App. Please add this Employee to the list of licensed Users for the Document Set (MOBILE).' ));
                        }

                    }

                }

            }

            // *****************************************************************
            // Get the Security Group
            // *****************************************************************

            $thisSecGroup = new \stdClass();

            if ( isset($thisEmployee->secgroupid) ) {

                $thisSecGroup = DB::connection('sqlsrv')
                ->table('SecGroup')
                ->select(['businessoption','matteroption','creditoroption','costcentreoption','employeeoption','clientoption','reportoption','spreadsheetoption','matterfilerefflag','matterarchivedflag','financialalertsflag'])
                ->where('RecordID', $thisEmployee->secgroupid)
                ->first();
            }

            $company['companyname'] = $company->company_name;
            $company['firmcode'] = $company->firmcode;


            // *************************************************************************
            // Check if the the LOLSettings etc tables exist (and/or run any migrations)
            // *************************************************************************
            if ( isset($request->source) ) {
                
                if ( $request->source == 'lol' ) {

                    try {
                        
                        $controller = new \App\LegalSuiteOnline\LegalSuiteOnlineMigration;
                        
                        // *****************************************************************
                        // Check if the LOL tables exist in the MS Sql database and create them if necessary
                        // *****************************************************************
                        $controller->createTables();

                        // *****************************************************************
                        // Run any new migrations
                        // *****************************************************************
                        $controller->migrateTables();

                        // *****************************************************************
                        // Delete any tagged entries from a previous session
                        // *****************************************************************
                        DB::connection('sqlsrv')->table('loltagged')->where('employeeid', $thisEmployee->recordid)->delete();


                    } catch(\Exception $e)  {
                        return json_encode(array('error' => $e->getMessage()));
                    }

                }

            }

            // Remove 'success' => $apiAccessDetails->api_token later when PK and Rick have changed their code

            return (array(
                'success' => $apiAccessDetails->api_token, 
                'apikey' => $apiAccessDetails->api_token, 
                'employee'=> $thisEmployee, 
                'secgroup'=> $thisSecGroup, 
                'company'=> $company
            ));   

        } catch(\Exception $e)  {
            return json_encode(array('error' => 'Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage()));
        }

    }

    public function clientLogin(Request $request) {
        /* Test in Tinker
        $controller = new \App\Http\Controllers\AuthController;
        $request = new \Illuminate\Http\Request;
        $request['login'] = "0001";
        $request['password'] = "28787";
        $result = $controller->clientLogin($request);

        */  

        $returnData = new \stdClass();

        $returnData->data = '';
        $returnData->errors = '';

        try {


            if ( !isset($request->login) ) {
                $returnData->errors = 'Access denied - Login Code not specified.';
                return json_encode($returnData);
            }

            if ( !isset($request->password) ) {
                $returnData->errors = 'Access denied - password not specified.';
                return json_encode($returnData);
            }

            // $control = \App\GenericTableModels\control::select('name')->first();

            // if ( !$control ) {
            //     $returnData->errors = 'An error was encountered getting the Name from the Control table.';
            //     return json_encode($returnData);
            // }

            $party = \App\GenericTableModels\party::where('matterprefix',$request->login)
            ->select(['recordid','name','matterprefix','remoteaccesspassword','remoteaccessexpiry'])
            ->first();

            if ( !$party ) {
                $returnData->errors = 'Access denied - Invalid Code.';
                return json_encode($returnData);
            }

            if ( $request->password != $party->remoteaccesspassword ) {
                $returnData->errors = 'Access denied - Incorrect password.';
                return json_encode($returnData);
            }

            if ( isset($party->remoteaccessexpiry) ) {

                date_default_timezone_set('Africa/Johannesburg');

                $today = Carbon::today();

                $expiryDate = Carbon::parse( Utils::stringFromClarionDate($party->remoteaccessexpiry) );                

                if ( $today->gt($expiryDate) ) {
                    $returnData->errors = 'Access denied - Your password has expired.';
                    return json_encode($returnData);
                }

            }

            $returnData->partyid = $party->recordid;
            $returnData->partyname = $party->name;
            //$returnData->companyname = $control->name;

            return json_encode($returnData);

        } catch(\Exception $e)  {

            $returnData->errors = $e->getMessage();
            return json_encode($returnData);

        }
    }

    public function getApiKey(Request $request) {

        try {

            if (!$request->header('Authorization')) {
                return json_encode(array('error' => 'Developer Key in Authorization header not specified'));
            }

            if (!Developer::where('developer_token',  $request->header('Authorization'))->first()) {
                return json_encode(array('error' => 'Developer not found'));
            }

            if (!$request->company) {
                return json_encode(array('error' => 'Company Code not specified'));
            }

            $company = Client::where('firmcode', $request->company)->first();

            if (!$company) {
                return json_encode(array('error' => 'Company (' . $request->company . ') not found'));
            }

            $databaseConnectionDetails = array();

            $details = array(
                'dbHost' => $company->dbHost,
                'dbDatabase' => $company->dbDatabase,
                'dbPort' => $company->dbPort,
                'dbUser' => $company->dbUser,
                'dbPassword' => $company->dbPassword,
            );

            array_push($databaseConnectionDetails,$details);

            \App\Custom\CompanyDatabase::setConfig($databaseConnectionDetails);

            if ( Schema::connection('sqlsrv')->hasTable('lolsettings') ) {

                $lolSettings = \App\GenericTableModels\lolsettings::first();

            } else {

                $lolSettings = null;
            }

            $developer = Developer::where('developer_token', $request->header('Authorization'))->first();

            if (!$developer) {
                return json_encode(array('error' => 'Developer not found'));
            }

            $apiAccessDetails = ApiAccess::where('clientid', $company->id)->where('developerid' , $developer->id)->firstOrFail();

            if (!$apiAccessDetails) {

                $this->grantApiAccess($company->id, $developer);

            } else {

                if ($apiAccessDetails->grantedAccess = 0) {
                    return json_encode(array('error' => 'API Access to the Company has not been granted'));
                }

            }

            $company['companyname'] = $company->company_name;
            $company['firmcode'] = $company->firmcode;

            $returnData = array(
                'apikey' => $apiAccessDetails->api_token, 
                'name'=> $company->company_name, 
                'email'=> $company->email, 
                'website'=> $company->website, 
                'company'=> $company, 
            );

            if ( isset( $lolSettings ) ) {
                $returnData['lolsettings'] = $lolSettings;
            }
            
            return $returnData;   

        } catch(\Exception $e)  {
            return json_encode(array('error' => 'Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage()));
        }

    }

    private function grantApiAccess($companyId, $developer) {

        $newApiAccess = new ApiAccess;
                    
        $newApiAccess->clientId = $companyId;
        $newApiAccess->developerId = $developer->id;
        $newApiAccess->grantAccess = 1;
        $newApiAccess->api_token = base64_encode(random_bytes(64)); 
        $newApiAccess->getAccessFlag = $developer->getAccessFlag;
        $newApiAccess->postAccessFlag = $developer->postAccessFlag;
        $newApiAccess->putAccessFlag = $developer->putAccessFlag;
        $newApiAccess->deleteAccessFlag = $developer->deleteAccessFlag;
        
        $newApiAccess->save();    

    }


    public function ping(Request $request)
    {
        $returnData = (object) [];
        if (!$request->header('Authorization')) {
            return json_encode(array('error' => 'No Developer Token specified'));
            
        }
        
        $returnData->success = "Ping Successful";
        
        return json_encode($returnData);
    }

    public function check(Request $request)
    {
    
        // $returnData->success = "Ping Successful";
        // logger('$request->all()',$request->all());
        return json_encode($request->all());
    }
    
}
