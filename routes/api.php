<?php

//use Illuminate\Http\Request;
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

    Route::middleware('auth:api')->post('/getUserData', 'AdminController@getUserData');

    Route::post('/getapikey', 'AuthController@getApiKey');
    Route::get('/auth', 'AuthController@auth');
    Route::post('/auth', 'AuthController@auth');
    Route::get('/ping', 'AuthController@ping');
    Route::get('/check', 'AuthController@check');

    Route::middleware('authenticate')->get('/view/{tableName}', 'ViewController@viewCaller');
    Route::middleware('authenticate')->post('/createview', 'ViewController@viewCreator');

    //***************************************************************/
    // GenericController
    //***************************************************************/

    Route::middleware('authenticate')->post('{tablename}/get/{recordid?}', 'GenericController@get');
    Route::middleware('authenticate')->post('{tablename}/store', 'GenericController@store');
    Route::middleware('authenticate')->post('{tablename}/update', 'GenericController@update');
    Route::middleware('authenticate')->post('{tablename}/delete/{recordid?}', 'GenericController@delete');
    Route::middleware('authenticate')->post('{tablename}/view', 'GenericController@view');
    Route::middleware('authenticate')->post('{tablename}/first', 'GenericController@first');
    Route::middleware('authenticate')->post('{tablename}/copy', 'GenericController@copy');

    // Need these in LegalSuiteOnline to generate documents and save them afterwards
    Route::middleware('authenticate')->post('{tablename}/gettemplatedata/{recordid?}', 'GenericController@getTemplateData');
    Route::middleware('authenticate')->post('{tablename}/storerecords', 'GenericController@storeRecords');

    //***************************************************************/
    // Client
    //***************************************************************/

    Route::middleware('authenticate')->post('client/login', 'AuthController@clientLogin');

    //***************************************************************/
    // DocLog
    //***************************************************************/

    Route::middleware('authenticate')->post('doclog/upload/{recordid}', 'UtilsController@uploadDocument');

    //***************************************************************/
    // Debtors Account
    //***************************************************************/
    Route::middleware('authenticate')->get('/matter/getdebtorsaccount', 'UtilsController@getDebtorsAccount');

    //***************************************************************/
    // Utils
    //***************************************************************/

    Route::prefix('utils')->group(function () {
        Route::middleware('authenticate')->post('checksecurity', 'UtilsController@checkSecurity');

        Route::middleware('authenticate')->post('gettagged', 'UtilsController@getTagged');
        Route::middleware('authenticate')->post('addtagged', 'UtilsController@addTagged');
        Route::middleware('authenticate')->post('deletetagged', 'UtilsController@deleteTagged');
        Route::middleware('authenticate')->post('cleartagged', 'UtilsController@clearTagged');
        Route::middleware('authenticate')->post('deleteemployeetags', 'UtilsController@deleteEmployeeTags');
        Route::middleware('authenticate')->post('tagall', 'UtilsController@tagAll');

        Route::middleware('authenticate')->post('uploaddocumenttodoclog', 'UtilsController@uploadDocumentToDoclog');
        Route::middleware('authenticate')->post('addfeenotes', 'UtilsController@addFeeNotes');
        Route::middleware('authenticate')->post('getfeeitems', 'UtilsController@getFeeItems');
        Route::middleware('authenticate')->post('getincomeaccount', 'UtilsController@getIncomeAccount');
        Route::middleware('authenticate')->post('getbasicdata', 'UtilsController@getBasicData');
        Route::middleware('authenticate')->post('getbasicpartydata', 'UtilsController@getBasicPartyData');
        Route::middleware('authenticate')->post('getbasicdatamobileapp', 'UtilsController@getBasicDataMobileApp');
        Route::middleware('authenticate')->get('getcollcommpercentandlimit', 'UtilsController@getCollCommPercentAndLimit');

        Route::post('getmimetype', 'UtilsController@getMimeType');
        Route::post('getfiletype', 'UtilsController@getFileType');

        Route::get('log', 'UtilsController@logs');
        Route::get('clearlog', 'UtilsController@clearlogs');
        Route::get('getphpinfo', 'UtilsController@getPhpInfo');

        //Route::middleware('authenticate')->get('testget', 'TestController@testGet');
        //Route::middleware('authenticate')->post('testpost', 'TestController@testPost');
    });
    //##Depricated
    // Route::middleware('authenticate')->post('/login', 'LoginController@login');
    Route::post('/auth/register', 'RegisterController@Register');
    Route::post('/auth/checkregister', 'RegisterController@checkRegister');
    Route::post('/auth/testconnection', 'RegisterController@testDatabaseConnection');

    Route::get('trafficlog', 'AdminController@getTrafficLog');
    Route::get('errorlog', 'AdminController@getErrorLog');
    Route::post('errorlog', 'AdminController@storeErrorLog');

    // Route::middleware('auth:api')->get('/errorlog', 'AdminController@getErrorLog');
    // Route::middleware('auth:api')->post('/geterrorlog', 'AdminController@getErrorLog');
    Route::middleware('auth:api')->get('/getapitrafficlog', 'AdminController@getApiTrafficLog');
    Route::middleware('auth:api')->get('/getcompanies', 'AdminController@getCompanies');
    Route::middleware('auth:api')->get('/getcompany/{id}', 'AdminController@getCompany');
    Route::middleware('auth:api')->post('/updatecompany/{id}', 'AdminController@updateCompany');

    Route::middleware('authenticate')->get('/storedprocedure/createstoredprocedureroutes', 'CreateStoredProceduresController@CreateStoredProcedureRoutes');
    Route::middleware('authenticate')->get('/storedprocedure/createstoredprocedurecontrollers', 'CreateStoredProceduresController@CreateStoredProcedureControllers');
    Route::middleware('authenticate')->get('/createdateformats', 'CreateModelAndControllersController@CreateDateFormats');
    Route::middleware('authenticate')->get('/createmodelandcontrollers', 'CreateModelAndControllersController@CreateModelAndControllers');
    Route::middleware('authenticate')->get('/createapiroutes', 'CreateModelAndControllersController@CreateApiRoutes');

    Route::middleware('authenticate')->prefix('custom')->group(function () {
        Route::get('/disbursement/{id}', 'CustomControllers\DisbursementController@getDisbursements');
        Route::get('/linked-disbursement/{id}', 'CustomControllers\DisbursementController@getLinkedDisbursements');
        Route::get('/getfeeitems/{id}', 'CustomControllers\DisbursementController@getfeeitems');
    });
