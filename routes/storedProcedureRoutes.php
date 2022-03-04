<?php

use App\Http\Controllers\StoredProcedureControllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/storedprocedure', function (Request $request) {
    $routes = [];
    $routeList = [];
    $routeList1 = [];
    $routeList2 = [];
    $routeCollection = Route::getRoutes();

    //   return $routeCollection;

    array_push($routeList1, 'Routes');
    array_push($routeList1, '');
    array_push($routeList1, 'GET -> Parameters');
    array_push($routeList1, 'POST -> Execute');
    array_push($routeList1, '');

    foreach ($routeCollection as $value) {
        if ($value->action['prefix'] == '/storedprocedure' && $value->methods == ['POST']) {
            //   return json_encode($value);
            array_push($routeList2, $value->uri);
        }
    }

    sort($routeList2);
    $routeList = array_merge($routeList1, $routeList2);

    return $routeList;
});

Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
    Route::get('/sp_resortdoctodoitemconditionsorter', [StoredProcedureControllers\SP_ResortDocToDoItemConditionSorterController::class, 'parameters']);
    Route::post('/sp_resortdoctodoitemconditionsorter', [StoredProcedureControllers\SP_ResortDocToDoItemConditionSorterController::class, 'execute']);
});

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortregareasorter', [StoredProcedureControllers\SP_ResortRegAreaSorterController::class, 'parameters']);
        Route::post('/sp_resortregareasorter', [StoredProcedureControllers\SP_ResortRegAreaSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resorttodoitemeventsorter', [StoredProcedureControllers\SP_ResortToDoItemEventSorterController::class, 'parameters']);
        Route::post('/sp_resorttodoitemeventsorter', [StoredProcedureControllers\SP_ResortToDoItemEventSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_upgraddiagrams', [StoredProcedureControllers\sp_upgraddiagramsController::class, 'parameters']);
        Route::post('/sp_upgraddiagrams', [StoredProcedureControllers\sp_upgraddiagramsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getdirinfo', [StoredProcedureControllers\sp_GetDirInfoController::class, 'parameters']);
        Route::post('/sp_getdirinfo', [StoredProcedureControllers\sp_GetDirInfoController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdocdebitsorter', [StoredProcedureControllers\SP_ResortDocDebitSorterController::class, 'parameters']);
        Route::post('/sp_resortdocdebitsorter', [StoredProcedureControllers\SP_ResortDocDebitSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_helpdiagrams', [StoredProcedureControllers\sp_helpdiagramsController::class, 'parameters']);
        Route::post('/sp_helpdiagrams', [StoredProcedureControllers\sp_helpdiagramsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_helpdiagramdefinition', [StoredProcedureControllers\sp_helpdiagramdefinitionController::class, 'parameters']);
        Route::post('/sp_helpdiagramdefinition', [StoredProcedureControllers\sp_helpdiagramdefinitionController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_creatediagram', [StoredProcedureControllers\sp_creatediagramController::class, 'parameters']);
        Route::post('/sp_creatediagram', [StoredProcedureControllers\sp_creatediagramController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getdoclogdeedsofficerecordid', [StoredProcedureControllers\sp_GetDocLogDeedsOfficeRecordIDController::class, 'parameters']);
        Route::post('/sp_getdoclogdeedsofficerecordid', [StoredProcedureControllers\sp_GetDocLogDeedsOfficeRecordIDController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_renamediagram', [StoredProcedureControllers\sp_renamediagramController::class, 'parameters']);
        Route::post('/sp_renamediagram', [StoredProcedureControllers\sp_renamediagramController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_alterdiagram', [StoredProcedureControllers\sp_alterdiagramController::class, 'parameters']);
        Route::post('/sp_alterdiagram', [StoredProcedureControllers\sp_alterdiagramController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_dropdiagram', [StoredProcedureControllers\sp_dropdiagramController::class, 'parameters']);
        Route::post('/sp_dropdiagram', [StoredProcedureControllers\sp_dropdiagramController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdevpropsorter', [StoredProcedureControllers\SP_ResortDevPropSorterController::class, 'parameters']);
        Route::post('/sp_resortdevpropsorter', [StoredProcedureControllers\SP_ResortDevPropSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getdoclogcategorydeedsofficerecordid', [StoredProcedureControllers\sp_GetDocLogCategoryDeedsOfficeRecordIDController::class, 'parameters']);
        Route::post('/sp_getdoclogcategorydeedsofficerecordid', [StoredProcedureControllers\sp_GetDocLogCategoryDeedsOfficeRecordIDController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addbonddebit', [StoredProcedureControllers\sp_AddBondDebitController::class, 'parameters']);
        Route::post('/sp_addbonddebit', [StoredProcedureControllers\sp_AddBondDebitController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondpropsorter', [StoredProcedureControllers\SP_ResortBondPropSorterController::class, 'parameters']);
        Route::post('/sp_resortbondpropsorter', [StoredProcedureControllers\SP_ResortBondPropSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondareasorter', [StoredProcedureControllers\SP_ResortBondAreaSorterController::class, 'parameters']);
        Route::post('/sp_resortbondareasorter', [StoredProcedureControllers\SP_ResortBondAreaSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortpartelesorter', [StoredProcedureControllers\SP_ResortParTeleSorterController::class, 'parameters']);
        Route::post('/sp_resortpartelesorter', [StoredProcedureControllers\SP_ResortParTeleSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortmatpartysorter', [StoredProcedureControllers\SP_ResortMatPartySorterController::class, 'parameters']);
        Route::post('/sp_resortmatpartysorter', [StoredProcedureControllers\SP_ResortMatPartySorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addpartybyname', [StoredProcedureControllers\sp_AddPartyByNameController::class, 'parameters']);
        Route::post('/sp_addpartybyname', [StoredProcedureControllers\sp_AddPartyByNameController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortstagesorter', [StoredProcedureControllers\SP_ResortStageSorterController::class, 'parameters']);
        Route::post('/sp_resortstagesorter', [StoredProcedureControllers\SP_ResortStageSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfilenote_forstage', [StoredProcedureControllers\AddFileNote_ForStageController::class, 'parameters']);
        Route::post('/addfilenote_forstage', [StoredProcedureControllers\AddFileNote_ForStageController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfilenote', [StoredProcedureControllers\AddFileNoteController::class, 'parameters']);
        Route::post('/addfilenote', [StoredProcedureControllers\AddFileNoteController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getindexscripts', [StoredProcedureControllers\SP_GetIndexScriptsController::class, 'parameters']);
        Route::post('/sp_getindexscripts', [StoredProcedureControllers\SP_GetIndexScriptsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_removestatistics', [StoredProcedureControllers\SP_RemoveStatisticsController::class, 'parameters']);
        Route::post('/sp_removestatistics', [StoredProcedureControllers\SP_RemoveStatisticsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondsuretysorter', [StoredProcedureControllers\SP_ResortBondSuretySorterController::class, 'parameters']);
        Route::post('/sp_resortbondsuretysorter', [StoredProcedureControllers\SP_ResortBondSuretySorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortregsectsorter', [StoredProcedureControllers\SP_ResortRegSectSorterController::class, 'parameters']);
        Route::post('/sp_resortregsectsorter', [StoredProcedureControllers\SP_ResortRegSectSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addmatparty', [StoredProcedureControllers\SP_AddMatPartyController::class, 'parameters']);
        Route::post('/sp_addmatparty', [StoredProcedureControllers\SP_AddMatPartyController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addbatchtransaction', [StoredProcedureControllers\AddBatchTransactionController::class, 'parameters']);
        Route::post('/addbatchtransaction', [StoredProcedureControllers\AddBatchTransactionController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getconstraintscripts', [StoredProcedureControllers\SP_GetConstraintScriptsController::class, 'parameters']);
        Route::post('/sp_getconstraintscripts', [StoredProcedureControllers\SP_GetConstraintScriptsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/adddistribution', [StoredProcedureControllers\AddDistributionController::class, 'parameters']);
        Route::post('/adddistribution', [StoredProcedureControllers\AddDistributionController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addchangecolumn', [StoredProcedureControllers\SP_AddChangeColumnController::class, 'parameters']);
        Route::post('/sp_addchangecolumn', [StoredProcedureControllers\SP_AddChangeColumnController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfilenotetolegalsuitecopy', [StoredProcedureControllers\AddFileNoteToLegalSuiteCopyController::class, 'parameters']);
        Route::post('/addfilenotetolegalsuitecopy', [StoredProcedureControllers\AddFileNoteToLegalSuiteCopyController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmatparty', [StoredProcedureControllers\AddMatPartyController::class, 'parameters']);
        Route::post('/addmatparty', [StoredProcedureControllers\AddMatPartyController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmessagetomessagestosend', [StoredProcedureControllers\AddMessageToMessagesToSendController::class, 'parameters']);
        Route::post('/addmessagetomessagestosend', [StoredProcedureControllers\AddMessageToMessagesToSendController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmessagetoreceivedmessages', [StoredProcedureControllers\AddMessageToReceivedMessagesController::class, 'parameters']);
        Route::post('/addmessagetoreceivedmessages', [StoredProcedureControllers\AddMessageToReceivedMessagesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addparty', [StoredProcedureControllers\AddPartyController::class, 'parameters']);
        Route::post('/addparty', [StoredProcedureControllers\AddPartyController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentbydate', [StoredProcedureControllers\AppointmentByDateController::class, 'parameters']);
        Route::post('/appointmentbydate', [StoredProcedureControllers\AppointmentByDateController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentdelete', [StoredProcedureControllers\AppointmentDeleteController::class, 'parameters']);
        Route::post('/appointmentdelete', [StoredProcedureControllers\AppointmentDeleteController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentgetbyrecordid', [StoredProcedureControllers\AppointmentGetByRecordIDController::class, 'parameters']);
        Route::post('/appointmentgetbyrecordid', [StoredProcedureControllers\AppointmentGetByRecordIDController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentinsert', [StoredProcedureControllers\AppointmentInsertController::class, 'parameters']);
        Route::post('/appointmentinsert', [StoredProcedureControllers\AppointmentInsertController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentupdate', [StoredProcedureControllers\AppointmentUpdateController::class, 'parameters']);
        Route::post('/appointmentupdate', [StoredProcedureControllers\AppointmentUpdateController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodobyemployee', [StoredProcedureControllers\AppointToDoByEmployeeController::class, 'parameters']);
        Route::post('/appointtodobyemployee', [StoredProcedureControllers\AppointToDoByEmployeeController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodochecked', [StoredProcedureControllers\AppointToDoCheckedController::class, 'parameters']);
        Route::post('/appointtodochecked', [StoredProcedureControllers\AppointToDoCheckedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbonddebitsorter', [StoredProcedureControllers\SP_ResortBondDebitSorterController::class, 'parameters']);
        Route::post('/sp_resortbonddebitsorter', [StoredProcedureControllers\SP_ResortBondDebitSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtododelete', [StoredProcedureControllers\AppointToDoDeleteController::class, 'parameters']);
        Route::post('/appointtododelete', [StoredProcedureControllers\AppointToDoDeleteController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdocgendebitsorter', [StoredProcedureControllers\SP_ResortDocgenDebitSorterController::class, 'parameters']);
        Route::post('/sp_resortdocgendebitsorter', [StoredProcedureControllers\SP_ResortDocgenDebitSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodogetbyrecordid', [StoredProcedureControllers\AppointToDoGetByRecordIDController::class, 'parameters']);
        Route::post('/appointtodogetbyrecordid', [StoredProcedureControllers\AppointToDoGetByRecordIDController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodoinsert', [StoredProcedureControllers\AppointToDoInsertController::class, 'parameters']);
        Route::post('/appointtodoinsert', [StoredProcedureControllers\AppointToDoInsertController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodoupdate', [StoredProcedureControllers\AppointToDoUpdateController::class, 'parameters']);
        Route::post('/appointtodoupdate', [StoredProcedureControllers\AppointToDoUpdateController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfeenote', [StoredProcedureControllers\AddFeenoteController::class, 'parameters']);
        Route::post('/addfeenote', [StoredProcedureControllers\AddFeenoteController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmatter', [StoredProcedureControllers\AddMatterController::class, 'parameters']);
        Route::post('/addmatter', [StoredProcedureControllers\AddMatterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/dproc_filltblindexusageinfo', [StoredProcedureControllers\dproc_FilltblIndexUsageInfoController::class, 'parameters']);
        Route::post('/dproc_filltblindexusageinfo', [StoredProcedureControllers\dproc_FilltblIndexUsageInfoController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/deadfilematter', [StoredProcedureControllers\DeadFileMatterController::class, 'parameters']);
        Route::post('/deadfilematter', [StoredProcedureControllers\DeadFileMatterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/employeebyrecordid', [StoredProcedureControllers\EmployeeByRecordIDController::class, 'parameters']);
        Route::post('/employeebyrecordid', [StoredProcedureControllers\EmployeeByRecordIDController::class, 'execute']);
        Route::post('/EmployeeByRecordID', [StoredProcedureControllers\EmployeeByRecordIDController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/employeesallowed', [StoredProcedureControllers\EmployeesAllowedController::class, 'parameters']);
        Route::post('/employeesallowed', [StoredProcedureControllers\EmployeesAllowedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resorttodoitemconditionsorter', [StoredProcedureControllers\SP_ResortToDoItemConditionSorterController::class, 'parameters']);
        Route::post('/sp_resorttodoitemconditionsorter', [StoredProcedureControllers\SP_ResortToDoItemConditionSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/fixtodonotesitemid', [StoredProcedureControllers\FixToDoNotesItemIDController::class, 'parameters']);
        Route::post('/fixtodonotesitemid', [StoredProcedureControllers\FixToDoNotesItemIDController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondcessionsorter', [StoredProcedureControllers\SP_ResortBondCessionSorterController::class, 'parameters']);
        Route::post('/sp_resortbondcessionsorter', [StoredProcedureControllers\SP_ResortBondCessionSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/foreignkeysanalyze', [StoredProcedureControllers\ForeignkeysAnalyzeController::class, 'parameters']);
        Route::post('/foreignkeysanalyze', [StoredProcedureControllers\ForeignkeysAnalyzeController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getmessagesreceived', [StoredProcedureControllers\GetMessagesReceivedController::class, 'parameters']);
        Route::post('/getmessagesreceived', [StoredProcedureControllers\GetMessagesReceivedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getmessagestosend', [StoredProcedureControllers\GetMessagesToSendController::class, 'parameters']);
        Route::post('/getmessagestosend', [StoredProcedureControllers\GetMessagesToSendController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getindexscripts', [StoredProcedureControllers\GetIndexScriptsController::class, 'parameters']);
        Route::post('/getindexscripts', [StoredProcedureControllers\GetIndexScriptsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getnullguardselect', [StoredProcedureControllers\GetNullGuardSelectController::class, 'parameters']);
        Route::post('/getnullguardselect', [StoredProcedureControllers\GetNullGuardSelectController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getsettings', [StoredProcedureControllers\GetSettingsController::class, 'parameters']);
        Route::post('/getsettings', [StoredProcedureControllers\GetSettingsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getconstraintscripts', [StoredProcedureControllers\GetConstraintScriptsController::class, 'parameters']);
        Route::post('/getconstraintscripts', [StoredProcedureControllers\GetConstraintScriptsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkblm', [StoredProcedureControllers\lsw_CheckBLMController::class, 'parameters']);
        Route::post('/lsw_checkblm', [StoredProcedureControllers\lsw_CheckBLMController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkcrm', [StoredProcedureControllers\lsw_CheckCRMController::class, 'parameters']);
        Route::post('/lsw_checkcrm', [StoredProcedureControllers\lsw_CheckCRMController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedblm', [StoredProcedureControllers\lsw_CheckedBLMController::class, 'parameters']);
        Route::post('/lsw_checkedblm', [StoredProcedureControllers\lsw_CheckedBLMController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedblmbusiness', [StoredProcedureControllers\lsw_CheckedBLMBusinessController::class, 'parameters']);
        Route::post('/lsw_checkedblmbusiness', [StoredProcedureControllers\lsw_CheckedBLMBusinessController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedblmtrust', [StoredProcedureControllers\lsw_CheckedBLMTrustController::class, 'parameters']);
        Route::post('/lsw_checkedblmtrust', [StoredProcedureControllers\lsw_CheckedBLMTrustController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/test_proc', [StoredProcedureControllers\Test_ProcController::class, 'parameters']);
        Route::post('/test_proc', [StoredProcedureControllers\Test_ProcController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_displaytablecolumns', [StoredProcedureControllers\sp_DisplayTableColumnsController::class, 'parameters']);
        Route::post('/sp_displaytablecolumns', [StoredProcedureControllers\sp_DisplayTableColumnsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedcrm', [StoredProcedureControllers\lsw_CheckedCRMController::class, 'parameters']);
        Route::post('/lsw_checkedcrm', [StoredProcedureControllers\lsw_CheckedCRMController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdebitordersorter', [StoredProcedureControllers\SP_ResortDebitOrderSorterController::class, 'parameters']);
        Route::post('/sp_resortdebitordersorter', [StoredProcedureControllers\SP_ResortDebitOrderSorterController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedcrtbustrust', [StoredProcedureControllers\lsw_CheckedCRTBustrustController::class, 'parameters']);
        Route::post('/lsw_checkedcrtbustrust', [StoredProcedureControllers\lsw_CheckedCRTBustrustController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmatactual', [StoredProcedureControllers\lsw_CheckedMATActualController::class, 'parameters']);
        Route::post('/lsw_checkedmatactual', [StoredProcedureControllers\lsw_CheckedMATActualController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmatinvested', [StoredProcedureControllers\lsw_CheckedMATInvestedController::class, 'parameters']);
        Route::post('/lsw_checkedmatinvested', [StoredProcedureControllers\lsw_CheckedMATInvestedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmatreserved', [StoredProcedureControllers\lsw_CheckedMATReservedController::class, 'parameters']);
        Route::post('/lsw_checkedmatreserved', [StoredProcedureControllers\lsw_CheckedMATReservedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmattransfer', [StoredProcedureControllers\lsw_CheckedMATTransferController::class, 'parameters']);
        Route::post('/lsw_checkedmattransfer', [StoredProcedureControllers\lsw_CheckedMATTransferController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmttbustrust', [StoredProcedureControllers\lsw_CheckedMTTBustrustController::class, 'parameters']);
        Route::post('/lsw_checkedmttbustrust', [StoredProcedureControllers\lsw_CheckedMTTBustrustController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedtransfer', [StoredProcedureControllers\lsw_CheckedTransferController::class, 'parameters']);
        Route::post('/lsw_checkedtransfer', [StoredProcedureControllers\lsw_CheckedTransferController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmatactual', [StoredProcedureControllers\lsw_CheckMATActualController::class, 'parameters']);
        Route::post('/lsw_checkmatactual', [StoredProcedureControllers\lsw_CheckMATActualController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmatinvested', [StoredProcedureControllers\lsw_CheckMATInvestedController::class, 'parameters']);
        Route::post('/lsw_checkmatinvested', [StoredProcedureControllers\lsw_CheckMATInvestedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmatreserved', [StoredProcedureControllers\lsw_CheckMATReservedController::class, 'parameters']);
        Route::post('/lsw_checkmatreserved', [StoredProcedureControllers\lsw_CheckMATReservedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmattransfer', [StoredProcedureControllers\lsw_CheckMATTransferController::class, 'parameters']);
        Route::post('/lsw_checkmattransfer', [StoredProcedureControllers\lsw_CheckMATTransferController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_verifydata', [StoredProcedureControllers\lsw_VerifydataController::class, 'parameters']);
        Route::post('/lsw_verifydata', [StoredProcedureControllers\lsw_VerifydataController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_createmissingindex', [StoredProcedureControllers\proc_CreateMissingIndexController::class, 'parameters']);
        Route::post('/proc_createmissingindex', [StoredProcedureControllers\proc_CreateMissingIndexController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_createmissingindexes', [StoredProcedureControllers\proc_CreateMissingIndexesController::class, 'parameters']);
        Route::post('/proc_createmissingindexes', [StoredProcedureControllers\proc_CreateMissingIndexesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_dropunusedindex', [StoredProcedureControllers\proc_DropUnusedIndexController::class, 'parameters']);
        Route::post('/proc_dropunusedindex', [StoredProcedureControllers\proc_DropUnusedIndexController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_filltblunusedindexes', [StoredProcedureControllers\proc_FilltblUnusedIndexesController::class, 'parameters']);
        Route::post('/proc_filltblunusedindexes', [StoredProcedureControllers\proc_FilltblUnusedIndexesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_findmisisngindexes', [StoredProcedureControllers\proc_FindMisisngIndexesController::class, 'parameters']);
        Route::post('/proc_findmisisngindexes', [StoredProcedureControllers\proc_FindMisisngIndexesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_createfileref', [StoredProcedureControllers\sp_CreateFileRefController::class, 'parameters']);
        Route::post('/sp_createfileref', [StoredProcedureControllers\sp_CreateFileRefController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_findmissingindexes', [StoredProcedureControllers\proc_FindMissingIndexesController::class, 'parameters']);
        Route::post('/proc_findmissingindexes', [StoredProcedureControllers\proc_FindMissingIndexesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_insertmostusedindexes', [StoredProcedureControllers\proc_InsertMostUsedIndexesController::class, 'parameters']);
        Route::post('/proc_insertmostusedindexes', [StoredProcedureControllers\proc_InsertMostUsedIndexesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_rebuildselectedindexes', [StoredProcedureControllers\proc_RebuildSelectedIndexesController::class, 'parameters']);
        Route::post('/proc_rebuildselectedindexes', [StoredProcedureControllers\proc_RebuildSelectedIndexesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/removefrommessagestosend', [StoredProcedureControllers\RemoveFromMessagesToSendController::class, 'parameters']);
        Route::post('/removefrommessagestosend', [StoredProcedureControllers\RemoveFromMessagesToSendController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/send_cdosysmail', [StoredProcedureControllers\Send_CDOSysMailController::class, 'parameters']);
        Route::post('/send_cdosysmail', [StoredProcedureControllers\Send_CDOSysMailController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/setmatterbatched', [StoredProcedureControllers\SetMatterBatchedController::class, 'parameters']);
        Route::post('/setmatterbatched', [StoredProcedureControllers\SetMatterBatchedController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/shrinkalltables', [StoredProcedureControllers\ShrinkAllTablesController::class, 'parameters']);
        Route::post('/shrinkalltables', [StoredProcedureControllers\ShrinkAllTablesController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/shrinktable', [StoredProcedureControllers\ShrinkTableController::class, 'parameters']);
        Route::post('/shrinktable', [StoredProcedureControllers\ShrinkTableController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addchangelocauth', [StoredProcedureControllers\SP_AddChangeLocAuthController::class, 'parameters']);
        Route::post('/sp_addchangelocauth', [StoredProcedureControllers\SP_AddChangeLocAuthController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/updateactivationdetails', [StoredProcedureControllers\UpdateActivationDetailsController::class, 'parameters']);
        Route::post('/updateactivationdetails', [StoredProcedureControllers\UpdateActivationDetailsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/usp_all_stats_date', [StoredProcedureControllers\usp_all_stats_dateController::class, 'parameters']);
        Route::post('/usp_all_stats_date', [StoredProcedureControllers\usp_all_stats_dateController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_send_cdontsmail', [StoredProcedureControllers\sp_send_cdontsmailController::class, 'parameters']);
        Route::post('/sp_send_cdontsmail', [StoredProcedureControllers\sp_send_cdontsmailController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_columns', [StoredProcedureControllers\sp_ColumnsController::class, 'parameters']);
        Route::post('/sp_columns', [StoredProcedureControllers\sp_ColumnsController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/usp_geterrorinfo', [StoredProcedureControllers\usp_GetErrorInfoController::class, 'parameters']);
        Route::post('/usp_geterrorinfo', [StoredProcedureControllers\usp_GetErrorInfoController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/uspprinterror', [StoredProcedureControllers\uspPrintErrorController::class, 'parameters']);
        Route::post('/uspprinterror', [StoredProcedureControllers\uspPrintErrorController::class, 'execute']);
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resorteventtasksorter', [StoredProcedureControllers\SP_ResortEventTaskSorterController::class, 'parameters']);
        Route::post('/sp_resorteventtasksorter', [StoredProcedureControllers\SP_ResortEventTaskSorterController::class, 'execute']);
    });
