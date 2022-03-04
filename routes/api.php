<?php

//use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateModelAndControllersController;
use App\Http\Controllers\CreateStoredProceduresController;
use App\Http\Controllers\CustomControllers;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UtilsController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::middleware('auth:api')->post('/getUserData', [AdminController::class, 'getUserData']);

    Route::post('/getapikey', [AuthController::class, 'getApiKey']);
    Route::get('/auth', [AuthController::class, 'auth']);
    Route::post('/auth', [AuthController::class, 'auth']);
    Route::get('/ping', [AuthController::class, 'ping']);
    Route::get('/check', [AuthController::class, 'check']);

    Route::middleware('authenticate')->get('/view/{tableName}', [ViewController::class, 'viewCaller']);
    Route::middleware('authenticate')->post('/createview', [ViewController::class, 'viewCreator']);

    //***************************************************************/
    // GenericController
    //***************************************************************/

    Route::middleware('authenticate')->post('{tablename}/get/{recordid?}', [GenericController::class, 'get']);
    Route::middleware('authenticate')->post('{tablename}/store', [GenericController::class, 'store']);
    Route::middleware('authenticate')->post('{tablename}/update', [GenericController::class, 'update']);
    Route::middleware('authenticate')->post('{tablename}/delete/{recordid?}', [GenericController::class, 'delete']);
    Route::middleware('authenticate')->post('{tablename}/view', [GenericController::class, 'view']);
    Route::middleware('authenticate')->post('{tablename}/first', [GenericController::class, 'first']);
    Route::middleware('authenticate')->post('{tablename}/copy', [GenericController::class, 'copy']);

    // Need these in LegalSuiteOnline to generate documents and save them afterwards
    Route::middleware('authenticate')->post('{tablename}/gettemplatedata/{recordid?}', [GenericController::class, 'getTemplateData']);
    Route::middleware('authenticate')->post('{tablename}/storerecords', [GenericController::class, 'storeRecords']);

    //***************************************************************/
    // Client
    //***************************************************************/

    Route::middleware('authenticate')->post('client/login', [AuthController::class, 'clientLogin']);

    //***************************************************************/
    // DocLog
    //***************************************************************/

    Route::middleware('authenticate')->post('doclog/upload/{recordid}', [UtilsController::class, 'uploadDocument']);

    //***************************************************************/
    // Debtors Account
    //***************************************************************/
    Route::middleware('authenticate')->get('/matter/getdebtorsaccount', [UtilsController::class, 'getDebtorsAccount']);

    //***************************************************************/
    // Utils
    //***************************************************************/

    Route::prefix('utils')->group(function () {
        Route::middleware('authenticate')->post('checksecurity', [UtilsController::class, 'checkSecurity']);

        Route::middleware('authenticate')->post('gettagged', [UtilsController::class, 'getTagged']);
        Route::middleware('authenticate')->post('addtagged', [UtilsController::class, 'addTagged']);
        Route::middleware('authenticate')->post('deletetagged', [UtilsController::class, 'deleteTagged']);
        Route::middleware('authenticate')->post('cleartagged', [UtilsController::class, 'clearTagged']);
        Route::middleware('authenticate')->post('deleteemployeetags', [UtilsController::class, 'deleteEmployeeTags']);
        Route::middleware('authenticate')->post('tagall', [UtilsController::class, 'tagAll']);

        Route::middleware('authenticate')->post('uploaddocumenttodoclog', [UtilsController::class, 'uploadDocumentToDoclog']);
        Route::middleware('authenticate')->post('addfeenotes', [UtilsController::class, 'addFeeNotes']);
        Route::middleware('authenticate')->post('getfeeitems', [UtilsController::class, 'getFeeItems']);
        Route::middleware('authenticate')->post('getincomeaccount', [UtilsController::class, 'getIncomeAccount']);
        Route::middleware('authenticate')->post('getbasicdata', [UtilsController::class, 'getBasicData']);
        Route::middleware('authenticate')->post('getbasicpartydata', [UtilsController::class, 'getBasicPartyData']);
        Route::middleware('authenticate')->post('getbasicdatamobileapp', [UtilsController::class, 'getBasicDataMobileApp']);
        Route::middleware('authenticate')->get('getcollcommpercentandlimit', [UtilsController::class, 'getCollCommPercentAndLimit']);

        Route::post('getmimetype', [UtilsController::class, 'getMimeType']);
        Route::post('getfiletype', [UtilsController::class, 'getFileType']);

        Route::get('log', [UtilsController::class, 'logs']);
        Route::get('clearlog', [UtilsController::class, 'clearlogs']);
        Route::get('getphpinfo', [UtilsController::class, 'getPhpInfo']);

        //Route::middleware('authenticate')->get('testget', [TestController::class, 'testGet']);
        //Route::middleware('authenticate')->post('testpost', [TestController::class, 'testPost']);
    });
    //##Depricated
    // Route::middleware('authenticate')->post('/login', [LoginController::class, 'login']);
    Route::post('/auth/register', [RegisterController::class, 'Register']);
    Route::post('/auth/checkregister', [RegisterController::class, 'checkRegister']);
    Route::post('/auth/testconnection', [RegisterController::class, 'testDatabaseConnection']);

    Route::get('trafficlog', [AdminController::class, 'getTrafficLog']);
    Route::get('errorlog', [AdminController::class, 'getErrorLog']);
    Route::post('errorlog', [AdminController::class, 'storeErrorLog']);

    // Route::middleware('auth:api')->get('/errorlog', [AdminController::class, 'getErrorLog']);
    // Route::middleware('auth:api')->post('/geterrorlog', [AdminController::class, 'getErrorLog']);
    Route::middleware('auth:api')->get('/getapitrafficlog', [AdminController::class, 'getApiTrafficLog']);
    Route::middleware('auth:api')->get('/getcompanies', [AdminController::class, 'getCompanies']);
    Route::middleware('auth:api')->get('/getcompany/{id}', [AdminController::class, 'getCompany']);
    Route::middleware('auth:api')->post('/updatecompany/{id}', [AdminController::class, 'updateCompany']);

    Route::middleware('authenticate')->get('/storedprocedure/createstoredprocedureroutes', [CreateStoredProceduresController::class, 'CreateStoredProcedureRoutes']);
    Route::middleware('authenticate')->get('/storedprocedure/createstoredprocedurecontrollers', [CreateStoredProceduresController::class, 'CreateStoredProcedureControllers']);
    Route::middleware('authenticate')->get('/createdateformats', [CreateModelAndControllersController::class, 'CreateDateFormats']);
    Route::middleware('authenticate')->get('/createmodelandcontrollers', [CreateModelAndControllersController::class, 'CreateModelAndControllers']);
    Route::middleware('authenticate')->get('/createapiroutes', [CreateModelAndControllersController::class, 'CreateApiRoutes']);

    Route::middleware('authenticate')->prefix('custom')->group(function () {
        Route::get('/disbursement/{id}', [CustomControllers\DisbursementController::class, 'getDisbursements']);
        Route::get('/linked-disbursement/{id}', [CustomControllers\DisbursementController::class, 'getLinkedDisbursements']);
        Route::get('/getfeeitems/{id}', [CustomControllers\DisbursementController::class, 'getfeeitems']);
    });
