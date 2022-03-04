<?php

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
    Route::get('/sp_resortdoctodoitemconditionsorter', 'StoredProcedureControllers\SP_ResortDocToDoItemConditionSorterController@parameters');
    Route::post('/sp_resortdoctodoitemconditionsorter', 'StoredProcedureControllers\SP_ResortDocToDoItemConditionSorterController@execute');
});

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortregareasorter', 'StoredProcedureControllers\SP_ResortRegAreaSorterController@parameters');
        Route::post('/sp_resortregareasorter', 'StoredProcedureControllers\SP_ResortRegAreaSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resorttodoitemeventsorter', 'StoredProcedureControllers\SP_ResortToDoItemEventSorterController@parameters');
        Route::post('/sp_resorttodoitemeventsorter', 'StoredProcedureControllers\SP_ResortToDoItemEventSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_upgraddiagrams', 'StoredProcedureControllers\sp_upgraddiagramsController@parameters');
        Route::post('/sp_upgraddiagrams', 'StoredProcedureControllers\sp_upgraddiagramsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getdirinfo', 'StoredProcedureControllers\sp_GetDirInfoController@parameters');
        Route::post('/sp_getdirinfo', 'StoredProcedureControllers\sp_GetDirInfoController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdocdebitsorter', 'StoredProcedureControllers\SP_ResortDocDebitSorterController@parameters');
        Route::post('/sp_resortdocdebitsorter', 'StoredProcedureControllers\SP_ResortDocDebitSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_helpdiagrams', 'StoredProcedureControllers\sp_helpdiagramsController@parameters');
        Route::post('/sp_helpdiagrams', 'StoredProcedureControllers\sp_helpdiagramsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_helpdiagramdefinition', 'StoredProcedureControllers\sp_helpdiagramdefinitionController@parameters');
        Route::post('/sp_helpdiagramdefinition', 'StoredProcedureControllers\sp_helpdiagramdefinitionController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_creatediagram', 'StoredProcedureControllers\sp_creatediagramController@parameters');
        Route::post('/sp_creatediagram', 'StoredProcedureControllers\sp_creatediagramController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getdoclogdeedsofficerecordid', 'StoredProcedureControllers\sp_GetDocLogDeedsOfficeRecordIDController@parameters');
        Route::post('/sp_getdoclogdeedsofficerecordid', 'StoredProcedureControllers\sp_GetDocLogDeedsOfficeRecordIDController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_renamediagram', 'StoredProcedureControllers\sp_renamediagramController@parameters');
        Route::post('/sp_renamediagram', 'StoredProcedureControllers\sp_renamediagramController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_alterdiagram', 'StoredProcedureControllers\sp_alterdiagramController@parameters');
        Route::post('/sp_alterdiagram', 'StoredProcedureControllers\sp_alterdiagramController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_dropdiagram', 'StoredProcedureControllers\sp_dropdiagramController@parameters');
        Route::post('/sp_dropdiagram', 'StoredProcedureControllers\sp_dropdiagramController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdevpropsorter', 'StoredProcedureControllers\SP_ResortDevPropSorterController@parameters');
        Route::post('/sp_resortdevpropsorter', 'StoredProcedureControllers\SP_ResortDevPropSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getdoclogcategorydeedsofficerecordid', 'StoredProcedureControllers\sp_GetDocLogCategoryDeedsOfficeRecordIDController@parameters');
        Route::post('/sp_getdoclogcategorydeedsofficerecordid', 'StoredProcedureControllers\sp_GetDocLogCategoryDeedsOfficeRecordIDController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addbonddebit', 'StoredProcedureControllers\sp_AddBondDebitController@parameters');
        Route::post('/sp_addbonddebit', 'StoredProcedureControllers\sp_AddBondDebitController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondpropsorter', 'StoredProcedureControllers\SP_ResortBondPropSorterController@parameters');
        Route::post('/sp_resortbondpropsorter', 'StoredProcedureControllers\SP_ResortBondPropSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondareasorter', 'StoredProcedureControllers\SP_ResortBondAreaSorterController@parameters');
        Route::post('/sp_resortbondareasorter', 'StoredProcedureControllers\SP_ResortBondAreaSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortpartelesorter', 'StoredProcedureControllers\SP_ResortParTeleSorterController@parameters');
        Route::post('/sp_resortpartelesorter', 'StoredProcedureControllers\SP_ResortParTeleSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortmatpartysorter', 'StoredProcedureControllers\SP_ResortMatPartySorterController@parameters');
        Route::post('/sp_resortmatpartysorter', 'StoredProcedureControllers\SP_ResortMatPartySorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addpartybyname', 'StoredProcedureControllers\sp_AddPartyByNameController@parameters');
        Route::post('/sp_addpartybyname', 'StoredProcedureControllers\sp_AddPartyByNameController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortstagesorter', 'StoredProcedureControllers\SP_ResortStageSorterController@parameters');
        Route::post('/sp_resortstagesorter', 'StoredProcedureControllers\SP_ResortStageSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfilenote_forstage', 'StoredProcedureControllers\AddFileNote_ForStageController@parameters');
        Route::post('/addfilenote_forstage', 'StoredProcedureControllers\AddFileNote_ForStageController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfilenote', 'StoredProcedureControllers\AddFileNoteController@parameters');
        Route::post('/addfilenote', 'StoredProcedureControllers\AddFileNoteController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getindexscripts', 'StoredProcedureControllers\SP_GetIndexScriptsController@parameters');
        Route::post('/sp_getindexscripts', 'StoredProcedureControllers\SP_GetIndexScriptsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_removestatistics', 'StoredProcedureControllers\SP_RemoveStatisticsController@parameters');
        Route::post('/sp_removestatistics', 'StoredProcedureControllers\SP_RemoveStatisticsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondsuretysorter', 'StoredProcedureControllers\SP_ResortBondSuretySorterController@parameters');
        Route::post('/sp_resortbondsuretysorter', 'StoredProcedureControllers\SP_ResortBondSuretySorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortregsectsorter', 'StoredProcedureControllers\SP_ResortRegSectSorterController@parameters');
        Route::post('/sp_resortregsectsorter', 'StoredProcedureControllers\SP_ResortRegSectSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addmatparty', 'StoredProcedureControllers\SP_AddMatPartyController@parameters');
        Route::post('/sp_addmatparty', 'StoredProcedureControllers\SP_AddMatPartyController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addbatchtransaction', 'StoredProcedureControllers\AddBatchTransactionController@parameters');
        Route::post('/addbatchtransaction', 'StoredProcedureControllers\AddBatchTransactionController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_getconstraintscripts', 'StoredProcedureControllers\SP_GetConstraintScriptsController@parameters');
        Route::post('/sp_getconstraintscripts', 'StoredProcedureControllers\SP_GetConstraintScriptsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/adddistribution', 'StoredProcedureControllers\AddDistributionController@parameters');
        Route::post('/adddistribution', 'StoredProcedureControllers\AddDistributionController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addchangecolumn', 'StoredProcedureControllers\SP_AddChangeColumnController@parameters');
        Route::post('/sp_addchangecolumn', 'StoredProcedureControllers\SP_AddChangeColumnController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfilenotetolegalsuitecopy', 'StoredProcedureControllers\AddFileNoteToLegalSuiteCopyController@parameters');
        Route::post('/addfilenotetolegalsuitecopy', 'StoredProcedureControllers\AddFileNoteToLegalSuiteCopyController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmatparty', 'StoredProcedureControllers\AddMatPartyController@parameters');
        Route::post('/addmatparty', 'StoredProcedureControllers\AddMatPartyController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmessagetomessagestosend', 'StoredProcedureControllers\AddMessageToMessagesToSendController@parameters');
        Route::post('/addmessagetomessagestosend', 'StoredProcedureControllers\AddMessageToMessagesToSendController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmessagetoreceivedmessages', 'StoredProcedureControllers\AddMessageToReceivedMessagesController@parameters');
        Route::post('/addmessagetoreceivedmessages', 'StoredProcedureControllers\AddMessageToReceivedMessagesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addparty', 'StoredProcedureControllers\AddPartyController@parameters');
        Route::post('/addparty', 'StoredProcedureControllers\AddPartyController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentbydate', 'StoredProcedureControllers\AppointmentByDateController@parameters');
        Route::post('/appointmentbydate', 'StoredProcedureControllers\AppointmentByDateController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentdelete', 'StoredProcedureControllers\AppointmentDeleteController@parameters');
        Route::post('/appointmentdelete', 'StoredProcedureControllers\AppointmentDeleteController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentgetbyrecordid', 'StoredProcedureControllers\AppointmentGetByRecordIDController@parameters');
        Route::post('/appointmentgetbyrecordid', 'StoredProcedureControllers\AppointmentGetByRecordIDController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentinsert', 'StoredProcedureControllers\AppointmentInsertController@parameters');
        Route::post('/appointmentinsert', 'StoredProcedureControllers\AppointmentInsertController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointmentupdate', 'StoredProcedureControllers\AppointmentUpdateController@parameters');
        Route::post('/appointmentupdate', 'StoredProcedureControllers\AppointmentUpdateController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodobyemployee', 'StoredProcedureControllers\AppointToDoByEmployeeController@parameters');
        Route::post('/appointtodobyemployee', 'StoredProcedureControllers\AppointToDoByEmployeeController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodochecked', 'StoredProcedureControllers\AppointToDoCheckedController@parameters');
        Route::post('/appointtodochecked', 'StoredProcedureControllers\AppointToDoCheckedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbonddebitsorter', 'StoredProcedureControllers\SP_ResortBondDebitSorterController@parameters');
        Route::post('/sp_resortbonddebitsorter', 'StoredProcedureControllers\SP_ResortBondDebitSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtododelete', 'StoredProcedureControllers\AppointToDoDeleteController@parameters');
        Route::post('/appointtododelete', 'StoredProcedureControllers\AppointToDoDeleteController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdocgendebitsorter', 'StoredProcedureControllers\SP_ResortDocgenDebitSorterController@parameters');
        Route::post('/sp_resortdocgendebitsorter', 'StoredProcedureControllers\SP_ResortDocgenDebitSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodogetbyrecordid', 'StoredProcedureControllers\AppointToDoGetByRecordIDController@parameters');
        Route::post('/appointtodogetbyrecordid', 'StoredProcedureControllers\AppointToDoGetByRecordIDController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodoinsert', 'StoredProcedureControllers\AppointToDoInsertController@parameters');
        Route::post('/appointtodoinsert', 'StoredProcedureControllers\AppointToDoInsertController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/appointtodoupdate', 'StoredProcedureControllers\AppointToDoUpdateController@parameters');
        Route::post('/appointtodoupdate', 'StoredProcedureControllers\AppointToDoUpdateController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addfeenote', 'StoredProcedureControllers\AddFeenoteController@parameters');
        Route::post('/addfeenote', 'StoredProcedureControllers\AddFeenoteController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/addmatter', 'StoredProcedureControllers\AddMatterController@parameters');
        Route::post('/addmatter', 'StoredProcedureControllers\AddMatterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/dproc_filltblindexusageinfo', 'StoredProcedureControllers\dproc_FilltblIndexUsageInfoController@parameters');
        Route::post('/dproc_filltblindexusageinfo', 'StoredProcedureControllers\dproc_FilltblIndexUsageInfoController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/deadfilematter', 'StoredProcedureControllers\DeadFileMatterController@parameters');
        Route::post('/deadfilematter', 'StoredProcedureControllers\DeadFileMatterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/employeebyrecordid', 'StoredProcedureControllers\EmployeeByRecordIDController@parameters');
        Route::post('/employeebyrecordid', 'StoredProcedureControllers\EmployeeByRecordIDController@execute');
        Route::post('/EmployeeByRecordID', 'StoredProcedureControllers\EmployeeByRecordIDController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/employeesallowed', 'StoredProcedureControllers\EmployeesAllowedController@parameters');
        Route::post('/employeesallowed', 'StoredProcedureControllers\EmployeesAllowedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resorttodoitemconditionsorter', 'StoredProcedureControllers\SP_ResortToDoItemConditionSorterController@parameters');
        Route::post('/sp_resorttodoitemconditionsorter', 'StoredProcedureControllers\SP_ResortToDoItemConditionSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/fixtodonotesitemid', 'StoredProcedureControllers\FixToDoNotesItemIDController@parameters');
        Route::post('/fixtodonotesitemid', 'StoredProcedureControllers\FixToDoNotesItemIDController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortbondcessionsorter', 'StoredProcedureControllers\SP_ResortBondCessionSorterController@parameters');
        Route::post('/sp_resortbondcessionsorter', 'StoredProcedureControllers\SP_ResortBondCessionSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/foreignkeysanalyze', 'StoredProcedureControllers\ForeignkeysAnalyzeController@parameters');
        Route::post('/foreignkeysanalyze', 'StoredProcedureControllers\ForeignkeysAnalyzeController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getmessagesreceived', 'StoredProcedureControllers\GetMessagesReceivedController@parameters');
        Route::post('/getmessagesreceived', 'StoredProcedureControllers\GetMessagesReceivedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getmessagestosend', 'StoredProcedureControllers\GetMessagesToSendController@parameters');
        Route::post('/getmessagestosend', 'StoredProcedureControllers\GetMessagesToSendController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getindexscripts', 'StoredProcedureControllers\GetIndexScriptsController@parameters');
        Route::post('/getindexscripts', 'StoredProcedureControllers\GetIndexScriptsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getnullguardselect', 'StoredProcedureControllers\GetNullGuardSelectController@parameters');
        Route::post('/getnullguardselect', 'StoredProcedureControllers\GetNullGuardSelectController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getsettings', 'StoredProcedureControllers\GetSettingsController@parameters');
        Route::post('/getsettings', 'StoredProcedureControllers\GetSettingsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/getconstraintscripts', 'StoredProcedureControllers\GetConstraintScriptsController@parameters');
        Route::post('/getconstraintscripts', 'StoredProcedureControllers\GetConstraintScriptsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkblm', 'StoredProcedureControllers\lsw_CheckBLMController@parameters');
        Route::post('/lsw_checkblm', 'StoredProcedureControllers\lsw_CheckBLMController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkcrm', 'StoredProcedureControllers\lsw_CheckCRMController@parameters');
        Route::post('/lsw_checkcrm', 'StoredProcedureControllers\lsw_CheckCRMController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedblm', 'StoredProcedureControllers\lsw_CheckedBLMController@parameters');
        Route::post('/lsw_checkedblm', 'StoredProcedureControllers\lsw_CheckedBLMController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedblmbusiness', 'StoredProcedureControllers\lsw_CheckedBLMBusinessController@parameters');
        Route::post('/lsw_checkedblmbusiness', 'StoredProcedureControllers\lsw_CheckedBLMBusinessController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedblmtrust', 'StoredProcedureControllers\lsw_CheckedBLMTrustController@parameters');
        Route::post('/lsw_checkedblmtrust', 'StoredProcedureControllers\lsw_CheckedBLMTrustController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/test_proc', 'StoredProcedureControllers\Test_ProcController@parameters');
        Route::post('/test_proc', 'StoredProcedureControllers\Test_ProcController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_displaytablecolumns', 'StoredProcedureControllers\sp_DisplayTableColumnsController@parameters');
        Route::post('/sp_displaytablecolumns', 'StoredProcedureControllers\sp_DisplayTableColumnsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedcrm', 'StoredProcedureControllers\lsw_CheckedCRMController@parameters');
        Route::post('/lsw_checkedcrm', 'StoredProcedureControllers\lsw_CheckedCRMController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resortdebitordersorter', 'StoredProcedureControllers\SP_ResortDebitOrderSorterController@parameters');
        Route::post('/sp_resortdebitordersorter', 'StoredProcedureControllers\SP_ResortDebitOrderSorterController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedcrtbustrust', 'StoredProcedureControllers\lsw_CheckedCRTBustrustController@parameters');
        Route::post('/lsw_checkedcrtbustrust', 'StoredProcedureControllers\lsw_CheckedCRTBustrustController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmatactual', 'StoredProcedureControllers\lsw_CheckedMATActualController@parameters');
        Route::post('/lsw_checkedmatactual', 'StoredProcedureControllers\lsw_CheckedMATActualController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmatinvested', 'StoredProcedureControllers\lsw_CheckedMATInvestedController@parameters');
        Route::post('/lsw_checkedmatinvested', 'StoredProcedureControllers\lsw_CheckedMATInvestedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmatreserved', 'StoredProcedureControllers\lsw_CheckedMATReservedController@parameters');
        Route::post('/lsw_checkedmatreserved', 'StoredProcedureControllers\lsw_CheckedMATReservedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmattransfer', 'StoredProcedureControllers\lsw_CheckedMATTransferController@parameters');
        Route::post('/lsw_checkedmattransfer', 'StoredProcedureControllers\lsw_CheckedMATTransferController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedmttbustrust', 'StoredProcedureControllers\lsw_CheckedMTTBustrustController@parameters');
        Route::post('/lsw_checkedmttbustrust', 'StoredProcedureControllers\lsw_CheckedMTTBustrustController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkedtransfer', 'StoredProcedureControllers\lsw_CheckedTransferController@parameters');
        Route::post('/lsw_checkedtransfer', 'StoredProcedureControllers\lsw_CheckedTransferController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmatactual', 'StoredProcedureControllers\lsw_CheckMATActualController@parameters');
        Route::post('/lsw_checkmatactual', 'StoredProcedureControllers\lsw_CheckMATActualController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmatinvested', 'StoredProcedureControllers\lsw_CheckMATInvestedController@parameters');
        Route::post('/lsw_checkmatinvested', 'StoredProcedureControllers\lsw_CheckMATInvestedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmatreserved', 'StoredProcedureControllers\lsw_CheckMATReservedController@parameters');
        Route::post('/lsw_checkmatreserved', 'StoredProcedureControllers\lsw_CheckMATReservedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_checkmattransfer', 'StoredProcedureControllers\lsw_CheckMATTransferController@parameters');
        Route::post('/lsw_checkmattransfer', 'StoredProcedureControllers\lsw_CheckMATTransferController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/lsw_verifydata', 'StoredProcedureControllers\lsw_VerifydataController@parameters');
        Route::post('/lsw_verifydata', 'StoredProcedureControllers\lsw_VerifydataController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_createmissingindex', 'StoredProcedureControllers\proc_CreateMissingIndexController@parameters');
        Route::post('/proc_createmissingindex', 'StoredProcedureControllers\proc_CreateMissingIndexController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_createmissingindexes', 'StoredProcedureControllers\proc_CreateMissingIndexesController@parameters');
        Route::post('/proc_createmissingindexes', 'StoredProcedureControllers\proc_CreateMissingIndexesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_dropunusedindex', 'StoredProcedureControllers\proc_DropUnusedIndexController@parameters');
        Route::post('/proc_dropunusedindex', 'StoredProcedureControllers\proc_DropUnusedIndexController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_filltblunusedindexes', 'StoredProcedureControllers\proc_FilltblUnusedIndexesController@parameters');
        Route::post('/proc_filltblunusedindexes', 'StoredProcedureControllers\proc_FilltblUnusedIndexesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_findmisisngindexes', 'StoredProcedureControllers\proc_FindMisisngIndexesController@parameters');
        Route::post('/proc_findmisisngindexes', 'StoredProcedureControllers\proc_FindMisisngIndexesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_createfileref', 'StoredProcedureControllers\sp_CreateFileRefController@parameters');
        Route::post('/sp_createfileref', 'StoredProcedureControllers\sp_CreateFileRefController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_findmissingindexes', 'StoredProcedureControllers\proc_FindMissingIndexesController@parameters');
        Route::post('/proc_findmissingindexes', 'StoredProcedureControllers\proc_FindMissingIndexesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_insertmostusedindexes', 'StoredProcedureControllers\proc_InsertMostUsedIndexesController@parameters');
        Route::post('/proc_insertmostusedindexes', 'StoredProcedureControllers\proc_InsertMostUsedIndexesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/proc_rebuildselectedindexes', 'StoredProcedureControllers\proc_RebuildSelectedIndexesController@parameters');
        Route::post('/proc_rebuildselectedindexes', 'StoredProcedureControllers\proc_RebuildSelectedIndexesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/removefrommessagestosend', 'StoredProcedureControllers\RemoveFromMessagesToSendController@parameters');
        Route::post('/removefrommessagestosend', 'StoredProcedureControllers\RemoveFromMessagesToSendController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/send_cdosysmail', 'StoredProcedureControllers\Send_CDOSysMailController@parameters');
        Route::post('/send_cdosysmail', 'StoredProcedureControllers\Send_CDOSysMailController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/setmatterbatched', 'StoredProcedureControllers\SetMatterBatchedController@parameters');
        Route::post('/setmatterbatched', 'StoredProcedureControllers\SetMatterBatchedController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/shrinkalltables', 'StoredProcedureControllers\ShrinkAllTablesController@parameters');
        Route::post('/shrinkalltables', 'StoredProcedureControllers\ShrinkAllTablesController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/shrinktable', 'StoredProcedureControllers\ShrinkTableController@parameters');
        Route::post('/shrinktable', 'StoredProcedureControllers\ShrinkTableController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_addchangelocauth', 'StoredProcedureControllers\SP_AddChangeLocAuthController@parameters');
        Route::post('/sp_addchangelocauth', 'StoredProcedureControllers\SP_AddChangeLocAuthController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/updateactivationdetails', 'StoredProcedureControllers\UpdateActivationDetailsController@parameters');
        Route::post('/updateactivationdetails', 'StoredProcedureControllers\UpdateActivationDetailsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/usp_all_stats_date', 'StoredProcedureControllers\usp_all_stats_dateController@parameters');
        Route::post('/usp_all_stats_date', 'StoredProcedureControllers\usp_all_stats_dateController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_send_cdontsmail', 'StoredProcedureControllers\sp_send_cdontsmailController@parameters');
        Route::post('/sp_send_cdontsmail', 'StoredProcedureControllers\sp_send_cdontsmailController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_columns', 'StoredProcedureControllers\sp_ColumnsController@parameters');
        Route::post('/sp_columns', 'StoredProcedureControllers\sp_ColumnsController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/usp_geterrorinfo', 'StoredProcedureControllers\usp_GetErrorInfoController@parameters');
        Route::post('/usp_geterrorinfo', 'StoredProcedureControllers\usp_GetErrorInfoController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/uspprinterror', 'StoredProcedureControllers\uspPrintErrorController@parameters');
        Route::post('/uspprinterror', 'StoredProcedureControllers\uspPrintErrorController@execute');
    });

    Route::middleware('authenticate')->prefix('storedprocedure')->group(function () {
        Route::get('/sp_resorteventtasksorter', 'StoredProcedureControllers\SP_ResortEventTaskSorterController@parameters');
        Route::post('/sp_resorteventtasksorter', 'StoredProcedureControllers\SP_ResortEventTaskSorterController@execute');
    });
