    Route::middleware('authenticate')->prefix('reconerror')->group(function () {
    Route::get('/', 'TableControllers\ReconErrorController@index');
    Route::get('/parameters', 'TableControllers\ReconErrorController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReconErrorController@store');
    Route::get('/{recordid}', 'TableControllers\ReconErrorController@show');
    Route::put('/{recordid}', 'TableControllers\ReconErrorController@update');
    Route::delete('/{recordid}', 'TableControllers\ReconErrorController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docscrn')->group(function () {
    Route::get('/', 'TableControllers\DocScrnController@index');
    Route::get('/parameters', 'TableControllers\DocScrnController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocScrnController@store');
    Route::get('/{recordid}', 'TableControllers\DocScrnController@show');
    Route::put('/{recordid}', 'TableControllers\DocScrnController@update');
    Route::delete('/{recordid}', 'TableControllers\DocScrnController@delete');
  });
        
    Route::middleware('authenticate')->prefix('test_table_3')->group(function () {
    Route::get('/', 'TableControllers\Test_Table_3Controller@index');
    Route::get('/parameters', 'TableControllers\Test_Table_3Controller@parameters');
    Route::post('/{recordid?}', 'TableControllers\Test_Table_3Controller@store');
    Route::get('/{recordid}', 'TableControllers\Test_Table_3Controller@show');
    Route::put('/{recordid}', 'TableControllers\Test_Table_3Controller@update');
    Route::delete('/{recordid}', 'TableControllers\Test_Table_3Controller@delete');
  });
        
    Route::middleware('authenticate')->prefix('sysobjec')->group(function () {
    Route::get('/', 'TableControllers\SYSOBJECController@index');
    Route::get('/parameters', 'TableControllers\SYSOBJECController@parameters');
    Route::post('/{?}', 'TableControllers\SYSOBJECController@store');
    Route::get('/{}', 'TableControllers\SYSOBJECController@show');
    Route::put('/{}', 'TableControllers\SYSOBJECController@update');
    Route::delete('/{}', 'TableControllers\SYSOBJECController@delete');
  });
        
    Route::middleware('authenticate')->prefix('billnote')->group(function () {
    Route::get('/', 'TableControllers\BillNoteController@index');
    Route::get('/parameters', 'TableControllers\BillNoteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BillNoteController@store');
    Route::get('/{recordid}', 'TableControllers\BillNoteController@show');
    Route::put('/{recordid}', 'TableControllers\BillNoteController@update');
    Route::delete('/{recordid}', 'TableControllers\BillNoteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('entityfica')->group(function () {
    Route::get('/', 'TableControllers\EntityFicaController@index');
    Route::get('/parameters', 'TableControllers\EntityFicaController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EntityFicaController@store');
    Route::get('/{recordid}', 'TableControllers\EntityFicaController@show');
    Route::put('/{recordid}', 'TableControllers\EntityFicaController@update');
    Route::delete('/{recordid}', 'TableControllers\EntityFicaController@delete');
  });
        
    Route::middleware('authenticate')->prefix('repcustom')->group(function () {
    Route::get('/', 'TableControllers\RepCustomController@index');
    Route::get('/parameters', 'TableControllers\RepCustomController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RepCustomController@store');
    Route::get('/{recordid}', 'TableControllers\RepCustomController@show');
    Route::put('/{recordid}', 'TableControllers\RepCustomController@update');
    Route::delete('/{recordid}', 'TableControllers\RepCustomController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docgenlicence')->group(function () {
    Route::get('/', 'TableControllers\DOCGENLICENCEController@index');
    Route::get('/parameters', 'TableControllers\DOCGENLICENCEController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DOCGENLICENCEController@store');
    Route::get('/{recordid}', 'TableControllers\DOCGENLICENCEController@show');
    Route::put('/{recordid}', 'TableControllers\DOCGENLICENCEController@update');
    Route::delete('/{recordid}', 'TableControllers\DOCGENLICENCEController@delete');
  });
        
    Route::middleware('authenticate')->prefix('finyear')->group(function () {
    Route::get('/', 'TableControllers\FinYearController@index');
    Route::get('/parameters', 'TableControllers\FinYearController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FinYearController@store');
    Route::get('/{recordid}', 'TableControllers\FinYearController@show');
    Route::put('/{recordid}', 'TableControllers\FinYearController@update');
    Route::delete('/{recordid}', 'TableControllers\FinYearController@delete');
  });
        
    Route::middleware('authenticate')->prefix('smalliconlist')->group(function () {
    Route::get('/', 'TableControllers\SmallIconListController@index');
    Route::get('/parameters', 'TableControllers\SmallIconListController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SmallIconListController@store');
    Route::get('/{recordid}', 'TableControllers\SmallIconListController@show');
    Route::put('/{recordid}', 'TableControllers\SmallIconListController@update');
    Route::delete('/{recordid}', 'TableControllers\SmallIconListController@delete');
  });
        
    Route::middleware('authenticate')->prefix('absa_messagesreceived')->group(function () {
    Route::get('/', 'TableControllers\ABSA_MessagesReceivedController@index');
    Route::get('/parameters', 'TableControllers\ABSA_MessagesReceivedController@parameters');
    Route::post('/{id?}', 'TableControllers\ABSA_MessagesReceivedController@store');
    Route::get('/{id}', 'TableControllers\ABSA_MessagesReceivedController@show');
    Route::put('/{id}', 'TableControllers\ABSA_MessagesReceivedController@update');
    Route::delete('/{id}', 'TableControllers\ABSA_MessagesReceivedController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tblindexusageinfo')->group(function () {
    Route::get('/', 'TableControllers\tblIndexUsageInfoController@index');
    Route::get('/parameters', 'TableControllers\tblIndexUsageInfoController@parameters');
    Route::post('/{?}', 'TableControllers\tblIndexUsageInfoController@store');
    Route::get('/{}', 'TableControllers\tblIndexUsageInfoController@show');
    Route::put('/{}', 'TableControllers\tblIndexUsageInfoController@update');
    Route::delete('/{}', 'TableControllers\tblIndexUsageInfoController@delete');
  });
        
    Route::middleware('authenticate')->prefix('guaranteehubrequestssent')->group(function () {
    Route::get('/', 'TableControllers\GuaranteeHubRequestsSentController@index');
    Route::get('/parameters', 'TableControllers\GuaranteeHubRequestsSentController@parameters');
    Route::post('/{recordid?}', 'TableControllers\GuaranteeHubRequestsSentController@store');
    Route::get('/{recordid}', 'TableControllers\GuaranteeHubRequestsSentController@show');
    Route::put('/{recordid}', 'TableControllers\GuaranteeHubRequestsSentController@update');
    Route::delete('/{recordid}', 'TableControllers\GuaranteeHubRequestsSentController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ficaitem')->group(function () {
    Route::get('/', 'TableControllers\FicaItemController@index');
    Route::get('/parameters', 'TableControllers\FicaItemController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FicaItemController@store');
    Route::get('/{recordid}', 'TableControllers\FicaItemController@show');
    Route::put('/{recordid}', 'TableControllers\FicaItemController@update');
    Route::delete('/{recordid}', 'TableControllers\FicaItemController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reportgroup')->group(function () {
    Route::get('/', 'TableControllers\ReportGroupController@index');
    Route::get('/parameters', 'TableControllers\ReportGroupController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportGroupController@store');
    Route::get('/{recordid}', 'TableControllers\ReportGroupController@show');
    Route::put('/{recordid}', 'TableControllers\ReportGroupController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tblmostusedindexes')->group(function () {
    Route::get('/', 'TableControllers\tblMostUsedIndexesController@index');
    Route::get('/parameters', 'TableControllers\tblMostUsedIndexesController@parameters');
    Route::post('/{?}', 'TableControllers\tblMostUsedIndexesController@store');
    Route::get('/{}', 'TableControllers\tblMostUsedIndexesController@show');
    Route::put('/{}', 'TableControllers\tblMostUsedIndexesController@update');
    Route::delete('/{}', 'TableControllers\tblMostUsedIndexesController@delete');
  });
        
    Route::middleware('authenticate')->prefix('logfile')->group(function () {
    Route::get('/', 'TableControllers\LogFileController@index');
    Route::get('/parameters', 'TableControllers\LogFileController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LogFileController@store');
    Route::get('/{recordid}', 'TableControllers\LogFileController@show');
    Route::put('/{recordid}', 'TableControllers\LogFileController@update');
    Route::delete('/{recordid}', 'TableControllers\LogFileController@delete');
  });
        
    Route::middleware('authenticate')->prefix('trantype')->group(function () {
    Route::get('/', 'TableControllers\TranTypeController@index');
    Route::get('/parameters', 'TableControllers\TranTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TranTypeController@store');
    Route::get('/{recordid}', 'TableControllers\TranTypeController@show');
    Route::put('/{recordid}', 'TableControllers\TranTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\TranTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tblunusedindexes')->group(function () {
    Route::get('/', 'TableControllers\tblUnusedIndexesController@index');
    Route::get('/parameters', 'TableControllers\tblUnusedIndexesController@parameters');
    Route::post('/{?}', 'TableControllers\tblUnusedIndexesController@store');
    Route::get('/{}', 'TableControllers\tblUnusedIndexesController@show');
    Route::put('/{}', 'TableControllers\tblUnusedIndexesController@update');
    Route::delete('/{}', 'TableControllers\tblUnusedIndexesController@delete');
  });
        
    Route::middleware('authenticate')->prefix('mattercondition')->group(function () {
    Route::get('/', 'TableControllers\MatterConditionController@index');
    Route::get('/parameters', 'TableControllers\MatterConditionController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatterConditionController@store');
    Route::get('/{recordid}', 'TableControllers\MatterConditionController@show');
    Route::put('/{recordid}', 'TableControllers\MatterConditionController@update');
    Route::delete('/{recordid}', 'TableControllers\MatterConditionController@delete');
  });
        
    Route::middleware('authenticate')->prefix('safetype')->group(function () {
    Route::get('/', 'TableControllers\SafeTypeController@index');
    Route::get('/parameters', 'TableControllers\SafeTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SafeTypeController@store');
    Route::get('/{recordid}', 'TableControllers\SafeTypeController@show');
    Route::put('/{recordid}', 'TableControllers\SafeTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\SafeTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('unit')->group(function () {
    Route::get('/', 'TableControllers\UnitController@index');
    Route::get('/parameters', 'TableControllers\UnitController@parameters');
    Route::post('/{recordid?}', 'TableControllers\UnitController@store');
    Route::get('/{recordid}', 'TableControllers\UnitController@show');
    Route::put('/{recordid}', 'TableControllers\UnitController@update');
    Route::delete('/{recordid}', 'TableControllers\UnitController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docdebitlang')->group(function () {
    Route::get('/', 'TableControllers\DocDebitLangController@index');
    Route::get('/parameters', 'TableControllers\DocDebitLangController@parameters');
    Route::post('/{languageid?}/{docdebitid?}', 'TableControllers\DocDebitLangController@store');
    Route::get('/{languageid}/{docdebitid}', 'TableControllers\DocDebitLangController@show');
    Route::put('/{languageid}/{docdebitid}', 'TableControllers\DocDebitLangController@update');
    Route::delete('/{languageid}/{docdebitid}', 'TableControllers\DocDebitLangController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tblmissingindexes')->group(function () {
    Route::get('/', 'TableControllers\tblMissingIndexesController@index');
    Route::get('/parameters', 'TableControllers\tblMissingIndexesController@parameters');
    Route::post('/{?}', 'TableControllers\tblMissingIndexesController@store');
    Route::get('/{}', 'TableControllers\tblMissingIndexesController@show');
    Route::put('/{}', 'TableControllers\tblMissingIndexesController@update');
    Route::delete('/{}', 'TableControllers\tblMissingIndexesController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parfica')->group(function () {
    Route::get('/', 'TableControllers\ParFicaController@index');
    Route::get('/parameters', 'TableControllers\ParFicaController@parameters');
    Route::post('/{partyid?}/{ficaitemid?}/{date?}', 'TableControllers\ParFicaController@store');
    Route::get('/{partyid}/{ficaitemid}/{date}', 'TableControllers\ParFicaController@show');
    Route::put('/{partyid}/{ficaitemid}/{date}', 'TableControllers\ParFicaController@update');
    Route::delete('/{partyid}/{ficaitemid}/{date}', 'TableControllers\ParFicaController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doclogattachment')->group(function () {
    Route::get('/', 'TableControllers\DocLogAttachmentController@index');
    Route::get('/parameters', 'TableControllers\DocLogAttachmentController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocLogAttachmentController@store');
    Route::get('/{recordid}', 'TableControllers\DocLogAttachmentController@show');
    Route::put('/{recordid}', 'TableControllers\DocLogAttachmentController@update');
    Route::delete('/{recordid}', 'TableControllers\DocLogAttachmentController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bondsure')->group(function () {
    Route::get('/', 'TableControllers\BondSureController@index');
    Route::get('/parameters', 'TableControllers\BondSureController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BondSureController@store');
    Route::get('/{recordid}', 'TableControllers\BondSureController@show');
    Route::put('/{recordid}', 'TableControllers\BondSureController@update');
    Route::delete('/{recordid}', 'TableControllers\BondSureController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reportfile')->group(function () {
    Route::get('/', 'TableControllers\ReportFileController@index');
    Route::get('/parameters', 'TableControllers\ReportFileController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportFileController@store');
    Route::get('/{recordid}', 'TableControllers\ReportFileController@show');
    Route::put('/{recordid}', 'TableControllers\ReportFileController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportFileController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docfoxrelationship')->group(function () {
    Route::get('/', 'TableControllers\DocFoxRelationshipController@index');
    Route::get('/parameters', 'TableControllers\DocFoxRelationshipController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocFoxRelationshipController@store');
    Route::get('/{recordid}', 'TableControllers\DocFoxRelationshipController@show');
    Route::put('/{recordid}', 'TableControllers\DocFoxRelationshipController@update');
    Route::delete('/{recordid}', 'TableControllers\DocFoxRelationshipController@delete');
  });
        
    Route::middleware('authenticate')->prefix('secgroup')->group(function () {
    Route::get('/', 'TableControllers\SecGroupController@index');
    Route::get('/parameters', 'TableControllers\SecGroupController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SecGroupController@store');
    Route::get('/{recordid}', 'TableControllers\SecGroupController@show');
    Route::put('/{recordid}', 'TableControllers\SecGroupController@update');
    Route::delete('/{recordid}', 'TableControllers\SecGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('exportlog')->group(function () {
    Route::get('/', 'TableControllers\ExportLogController@index');
    Route::get('/parameters', 'TableControllers\ExportLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ExportLogController@store');
    Route::get('/{recordid}', 'TableControllers\ExportLogController@show');
    Route::put('/{recordid}', 'TableControllers\ExportLogController@update');
    Route::delete('/{recordid}', 'TableControllers\ExportLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bonddebit')->group(function () {
    Route::get('/', 'TableControllers\BondDebitController@index');
    Route::get('/parameters', 'TableControllers\BondDebitController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BondDebitController@store');
    Route::get('/{recordid}', 'TableControllers\BondDebitController@show');
    Route::put('/{recordid}', 'TableControllers\BondDebitController@update');
    Route::delete('/{recordid}', 'TableControllers\BondDebitController@delete');
  });
        
    Route::middleware('authenticate')->prefix('duplicate_table')->group(function () {
    Route::get('/', 'TableControllers\duplicate_tableController@index');
    Route::get('/parameters', 'TableControllers\duplicate_tableController@parameters');
    Route::post('/{recordid?}', 'TableControllers\duplicate_tableController@store');
    Route::get('/{recordid}', 'TableControllers\duplicate_tableController@show');
    Route::put('/{recordid}', 'TableControllers\duplicate_tableController@update');
    Route::delete('/{recordid}', 'TableControllers\duplicate_tableController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parproduct')->group(function () {
    Route::get('/', 'TableControllers\ParProductController@index');
    Route::get('/parameters', 'TableControllers\ParProductController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParProductController@store');
    Route::get('/{recordid}', 'TableControllers\ParProductController@show');
    Route::put('/{recordid}', 'TableControllers\ParProductController@update');
    Route::delete('/{recordid}', 'TableControllers\ParProductController@delete');
  });
        
    Route::middleware('authenticate')->prefix('secproc')->group(function () {
    Route::get('/', 'TableControllers\SecProcController@index');
    Route::get('/parameters', 'TableControllers\SecProcController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SecProcController@store');
    Route::get('/{recordid}', 'TableControllers\SecProcController@show');
    Route::put('/{recordid}', 'TableControllers\SecProcController@update');
    Route::delete('/{recordid}', 'TableControllers\SecProcController@delete');
  });
        
    Route::middleware('authenticate')->prefix('helpfile')->group(function () {
    Route::get('/', 'TableControllers\HelpFileController@index');
    Route::get('/parameters', 'TableControllers\HelpFileController@parameters');
    Route::post('/{recordid?}', 'TableControllers\HelpFileController@store');
    Route::get('/{recordid}', 'TableControllers\HelpFileController@show');
    Route::put('/{recordid}', 'TableControllers\HelpFileController@update');
    Route::delete('/{recordid}', 'TableControllers\HelpFileController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tokendata_n')->group(function () {
    Route::get('/', 'TableControllers\TokenData_nController@index');
    Route::get('/parameters', 'TableControllers\TokenData_nController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TokenData_nController@store');
    Route::get('/{recordid}', 'TableControllers\TokenData_nController@show');
    Route::put('/{recordid}', 'TableControllers\TokenData_nController@update');
    Route::delete('/{recordid}', 'TableControllers\TokenData_nController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doclogcategory')->group(function () {
    Route::get('/', 'TableControllers\DocLogCategoryController@index');
    Route::get('/parameters', 'TableControllers\DocLogCategoryController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocLogCategoryController@store');
    Route::get('/{recordid}', 'TableControllers\DocLogCategoryController@show');
    Route::put('/{recordid}', 'TableControllers\DocLogCategoryController@update');
    Route::delete('/{recordid}', 'TableControllers\DocLogCategoryController@delete');
  });
        
    Route::middleware('authenticate')->prefix('safelog')->group(function () {
    Route::get('/', 'TableControllers\SafeLogController@index');
    Route::get('/parameters', 'TableControllers\SafeLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SafeLogController@store');
    Route::get('/{recordid}', 'TableControllers\SafeLogController@show');
    Route::put('/{recordid}', 'TableControllers\SafeLogController@update');
    Route::delete('/{recordid}', 'TableControllers\SafeLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('conveyancingdiscountlog')->group(function () {
    Route::get('/', 'TableControllers\ConveyancingDiscountLogController@index');
    Route::get('/parameters', 'TableControllers\ConveyancingDiscountLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ConveyancingDiscountLogController@store');
    Route::get('/{recordid}', 'TableControllers\ConveyancingDiscountLogController@show');
    Route::put('/{recordid}', 'TableControllers\ConveyancingDiscountLogController@update');
    Route::delete('/{recordid}', 'TableControllers\ConveyancingDiscountLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doclog')->group(function () {
    Route::get('/', 'TableControllers\DocLogController@index');
    Route::get('/parameters', 'TableControllers\DocLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocLogController@store');
    Route::get('/{recordid}', 'TableControllers\DocLogController@show');
    Route::put('/{recordid}', 'TableControllers\DocLogController@update');
    Route::delete('/{recordid}', 'TableControllers\DocLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docgendebit')->group(function () {
    Route::get('/', 'TableControllers\DocgenDebitController@index');
    Route::get('/parameters', 'TableControllers\DocgenDebitController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocgenDebitController@store');
    Route::get('/{recordid}', 'TableControllers\DocgenDebitController@show');
    Route::put('/{recordid}', 'TableControllers\DocgenDebitController@update');
    Route::delete('/{recordid}', 'TableControllers\DocgenDebitController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reportscreen')->group(function () {
    Route::get('/', 'TableControllers\ReportScreenController@index');
    Route::get('/parameters', 'TableControllers\ReportScreenController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportScreenController@store');
    Route::get('/{recordid}', 'TableControllers\ReportScreenController@show');
    Route::put('/{recordid}', 'TableControllers\ReportScreenController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportScreenController@delete');
  });
        
    Route::middleware('authenticate')->prefix('product')->group(function () {
    Route::get('/', 'TableControllers\ProductController@index');
    Route::get('/parameters', 'TableControllers\ProductController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ProductController@store');
    Route::get('/{recordid}', 'TableControllers\ProductController@show');
    Route::put('/{recordid}', 'TableControllers\ProductController@update');
    Route::delete('/{recordid}', 'TableControllers\ProductController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lollogfile')->group(function () {
    Route::get('/', 'TableControllers\LOLLogFileController@index');
    Route::get('/parameters', 'TableControllers\LOLLogFileController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LOLLogFileController@store');
    Route::get('/{recordid}', 'TableControllers\LOLLogFileController@show');
    Route::put('/{recordid}', 'TableControllers\LOLLogFileController@update');
    Route::delete('/{recordid}', 'TableControllers\LOLLogFileController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docchecklist')->group(function () {
    Route::get('/', 'TableControllers\DocCheckListController@index');
    Route::get('/parameters', 'TableControllers\DocCheckListController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocCheckListController@store');
    Route::get('/{recordid}', 'TableControllers\DocCheckListController@show');
    Route::put('/{recordid}', 'TableControllers\DocCheckListController@update');
    Route::delete('/{recordid}', 'TableControllers\DocCheckListController@delete');
  });
        
    Route::middleware('authenticate')->prefix('customreportfield')->group(function () {
    Route::get('/', 'TableControllers\CustomReportFieldController@index');
    Route::get('/parameters', 'TableControllers\CustomReportFieldController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CustomReportFieldController@store');
    Route::get('/{recordid}', 'TableControllers\CustomReportFieldController@show');
    Route::put('/{recordid}', 'TableControllers\CustomReportFieldController@update');
    Route::delete('/{recordid}', 'TableControllers\CustomReportFieldController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lookupemployer')->group(function () {
    Route::get('/', 'TableControllers\LookupEmployerController@index');
    Route::get('/parameters', 'TableControllers\LookupEmployerController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LookupEmployerController@store');
    Route::get('/{recordid}', 'TableControllers\LookupEmployerController@show');
    Route::put('/{recordid}', 'TableControllers\LookupEmployerController@update');
    Route::delete('/{recordid}', 'TableControllers\LookupEmployerController@delete');
  });
        
    Route::middleware('authenticate')->prefix('absafees')->group(function () {
    Route::get('/', 'TableControllers\ABSAFeesController@index');
    Route::get('/parameters', 'TableControllers\ABSAFeesController@parameters');
    Route::post('/{sorter?}/{matterid?}', 'TableControllers\ABSAFeesController@store');
    Route::get('/{sorter}/{matterid}', 'TableControllers\ABSAFeesController@show');
    Route::put('/{sorter}/{matterid}', 'TableControllers\ABSAFeesController@update');
    Route::delete('/{sorter}/{matterid}', 'TableControllers\ABSAFeesController@delete');
  });
        
    Route::middleware('authenticate')->prefix('teletype')->group(function () {
    Route::get('/', 'TableControllers\TeleTypeController@index');
    Route::get('/parameters', 'TableControllers\TeleTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TeleTypeController@store');
    Route::get('/{recordid}', 'TableControllers\TeleTypeController@show');
    Route::put('/{recordid}', 'TableControllers\TeleTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\TeleTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reportemp')->group(function () {
    Route::get('/', 'TableControllers\ReportEmpController@index');
    Route::get('/parameters', 'TableControllers\ReportEmpController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportEmpController@store');
    Route::get('/{recordid}', 'TableControllers\ReportEmpController@show');
    Route::put('/{recordid}', 'TableControllers\ReportEmpController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportEmpController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bondshare')->group(function () {
    Route::get('/', 'TableControllers\BondShareController@index');
    Route::get('/parameters', 'TableControllers\BondShareController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BondShareController@store');
    Route::get('/{recordid}', 'TableControllers\BondShareController@show');
    Route::put('/{recordid}', 'TableControllers\BondShareController@update');
    Route::delete('/{recordid}', 'TableControllers\BondShareController@delete');
  });
        
    Route::middleware('authenticate')->prefix('guaranteehubrequestsreceived')->group(function () {
    Route::get('/', 'TableControllers\GuaranteeHubRequestsReceivedController@index');
    Route::get('/parameters', 'TableControllers\GuaranteeHubRequestsReceivedController@parameters');
    Route::post('/{recordid?}', 'TableControllers\GuaranteeHubRequestsReceivedController@store');
    Route::get('/{recordid}', 'TableControllers\GuaranteeHubRequestsReceivedController@show');
    Route::put('/{recordid}', 'TableControllers\GuaranteeHubRequestsReceivedController@update');
    Route::delete('/{recordid}', 'TableControllers\GuaranteeHubRequestsReceivedController@delete');
  });
        
    Route::middleware('authenticate')->prefix('test_table')->group(function () {
    Route::get('/', 'TableControllers\Test_TableController@index');
    Route::get('/parameters', 'TableControllers\Test_TableController@parameters');
    Route::post('/{recordid?}', 'TableControllers\Test_TableController@store');
    Route::get('/{recordid}', 'TableControllers\Test_TableController@show');
    Route::put('/{recordid}', 'TableControllers\Test_TableController@update');
    Route::delete('/{recordid}', 'TableControllers\Test_TableController@delete');
  });
        
    Route::middleware('authenticate')->prefix('claim')->group(function () {
    Route::get('/', 'TableControllers\ClaimController@index');
    Route::get('/parameters', 'TableControllers\ClaimController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ClaimController@store');
    Route::get('/{recordid}', 'TableControllers\ClaimController@show');
    Route::put('/{recordid}', 'TableControllers\ClaimController@update');
    Route::delete('/{recordid}', 'TableControllers\ClaimController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_mattertype')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_MatterTypeController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_MatterTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_MatterTypeController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_MatterTypeController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_MatterTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_MatterTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('rolescrn')->group(function () {
    Route::get('/', 'TableControllers\RoleScrnController@index');
    Route::get('/parameters', 'TableControllers\RoleScrnController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RoleScrnController@store');
    Route::get('/{recordid}', 'TableControllers\RoleScrnController@show');
    Route::put('/{recordid}', 'TableControllers\RoleScrnController@update');
    Route::delete('/{recordid}', 'TableControllers\RoleScrnController@delete');
  });
        
    Route::middleware('authenticate')->prefix('invoicematter')->group(function () {
    Route::get('/', 'TableControllers\InvoiceMatterController@index');
    Route::get('/parameters', 'TableControllers\InvoiceMatterController@parameters');
    Route::post('/{recordid?}', 'TableControllers\InvoiceMatterController@store');
    Route::get('/{recordid}', 'TableControllers\InvoiceMatterController@show');
    Route::put('/{recordid}', 'TableControllers\InvoiceMatterController@update');
    Route::delete('/{recordid}', 'TableControllers\InvoiceMatterController@delete');
  });
        
    Route::middleware('authenticate')->prefix('todonote')->group(function () {
    Route::get('/', 'TableControllers\ToDoNoteController@index');
    Route::get('/parameters', 'TableControllers\ToDoNoteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ToDoNoteController@store');
    Route::get('/{recordid}', 'TableControllers\ToDoNoteController@show');
    Route::put('/{recordid}', 'TableControllers\ToDoNoteController@update');
    Route::delete('/{recordid}', 'TableControllers\ToDoNoteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tradeclass')->group(function () {
    Route::get('/', 'TableControllers\TradeClassController@index');
    Route::get('/parameters', 'TableControllers\TradeClassController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TradeClassController@store');
    Route::get('/{recordid}', 'TableControllers\TradeClassController@show');
    Route::put('/{recordid}', 'TableControllers\TradeClassController@update');
    Route::delete('/{recordid}', 'TableControllers\TradeClassController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_bank')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_BankController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_BankController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_BankController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_BankController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_BankController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_BankController@delete');
  });
        
    Route::middleware('authenticate')->prefix('employeelogfile')->group(function () {
    Route::get('/', 'TableControllers\EmployeeLogFileController@index');
    Route::get('/parameters', 'TableControllers\EmployeeLogFileController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmployeeLogFileController@store');
    Route::get('/{recordid}', 'TableControllers\EmployeeLogFileController@show');
    Route::put('/{recordid}', 'TableControllers\EmployeeLogFileController@update');
    Route::delete('/{recordid}', 'TableControllers\EmployeeLogFileController@delete');
  });
        
    Route::middleware('authenticate')->prefix('coltext')->group(function () {
    Route::get('/', 'TableControllers\ColTextController@index');
    Route::get('/parameters', 'TableControllers\ColTextController@parameters');
    Route::post('/{languageid?}/{colcostid?}', 'TableControllers\ColTextController@store');
    Route::get('/{languageid}/{colcostid}', 'TableControllers\ColTextController@show');
    Route::put('/{languageid}/{colcostid}', 'TableControllers\ColTextController@update');
    Route::delete('/{languageid}/{colcostid}', 'TableControllers\ColTextController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reportfield')->group(function () {
    Route::get('/', 'TableControllers\ReportFieldController@index');
    Route::get('/parameters', 'TableControllers\ReportFieldController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportFieldController@store');
    Route::get('/{recordid}', 'TableControllers\ReportFieldController@show');
    Route::put('/{recordid}', 'TableControllers\ReportFieldController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportFieldController@delete');
  });
        
    Route::middleware('authenticate')->prefix('province')->group(function () {
    Route::get('/', 'TableControllers\ProvinceController@index');
    Route::get('/parameters', 'TableControllers\ProvinceController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ProvinceController@store');
    Route::get('/{recordid}', 'TableControllers\ProvinceController@show');
    Route::put('/{recordid}', 'TableControllers\ProvinceController@update');
    Route::delete('/{recordid}', 'TableControllers\ProvinceController@delete');
  });
        
    Route::middleware('authenticate')->prefix('guaranteehubrequestcomment')->group(function () {
    Route::get('/', 'TableControllers\GuaranteeHubRequestCommentController@index');
    Route::get('/parameters', 'TableControllers\GuaranteeHubRequestCommentController@parameters');
    Route::post('/{recordid?}', 'TableControllers\GuaranteeHubRequestCommentController@store');
    Route::get('/{recordid}', 'TableControllers\GuaranteeHubRequestCommentController@show');
    Route::put('/{recordid}', 'TableControllers\GuaranteeHubRequestCommentController@update');
    Route::delete('/{recordid}', 'TableControllers\GuaranteeHubRequestCommentController@delete');
  });
        
    Route::middleware('authenticate')->prefix('stagelang')->group(function () {
    Route::get('/', 'TableControllers\StageLangController@index');
    Route::get('/parameters', 'TableControllers\StageLangController@parameters');
    Route::post('/{stageid?}/{languageid?}', 'TableControllers\StageLangController@store');
    Route::get('/{stageid}/{languageid}', 'TableControllers\StageLangController@show');
    Route::put('/{stageid}/{languageid}', 'TableControllers\StageLangController@update');
    Route::delete('/{stageid}/{languageid}', 'TableControllers\StageLangController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_mortgageoriginator')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_MortgageOriginatorController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_MortgageOriginatorController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_MortgageOriginatorController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_MortgageOriginatorController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_MortgageOriginatorController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_MortgageOriginatorController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empdgloc')->group(function () {
    Route::get('/', 'TableControllers\EmpDGLocController@index');
    Route::get('/parameters', 'TableControllers\EmpDGLocController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpDGLocController@store');
    Route::get('/{recordid}', 'TableControllers\EmpDGLocController@show');
    Route::put('/{recordid}', 'TableControllers\EmpDGLocController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpDGLocController@delete');
  });
        
    Route::middleware('authenticate')->prefix('todoitemcondition')->group(function () {
    Route::get('/', 'TableControllers\ToDoItemConditionController@index');
    Route::get('/parameters', 'TableControllers\ToDoItemConditionController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ToDoItemConditionController@store');
    Route::get('/{recordid}', 'TableControllers\ToDoItemConditionController@show');
    Route::put('/{recordid}', 'TableControllers\ToDoItemConditionController@update');
    Route::delete('/{recordid}', 'TableControllers\ToDoItemConditionController@delete');
  });
        
    Route::middleware('authenticate')->prefix('qbeheader')->group(function () {
    Route::get('/', 'TableControllers\QBEHeaderController@index');
    Route::get('/parameters', 'TableControllers\QBEHeaderController@parameters');
    Route::post('/{recordid?}', 'TableControllers\QBEHeaderController@store');
    Route::get('/{recordid}', 'TableControllers\QBEHeaderController@show');
    Route::put('/{recordid}', 'TableControllers\QBEHeaderController@update');
    Route::delete('/{recordid}', 'TableControllers\QBEHeaderController@delete');
  });
        
    Route::middleware('authenticate')->prefix('mattersearch')->group(function () {
    Route::get('/', 'TableControllers\MatterSearchController@index');
    Route::get('/parameters', 'TableControllers\MatterSearchController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatterSearchController@store');
    Route::get('/{recordid}', 'TableControllers\MatterSearchController@show');
    Route::put('/{recordid}', 'TableControllers\MatterSearchController@update');
    Route::delete('/{recordid}', 'TableControllers\MatterSearchController@delete');
  });
        
    Route::middleware('authenticate')->prefix('employeebillingrate')->group(function () {
    Route::get('/', 'TableControllers\EmployeeBillingRateController@index');
    Route::get('/parameters', 'TableControllers\EmployeeBillingRateController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmployeeBillingRateController@store');
    Route::get('/{recordid}', 'TableControllers\EmployeeBillingRateController@show');
    Route::put('/{recordid}', 'TableControllers\EmployeeBillingRateController@update');
    Route::delete('/{recordid}', 'TableControllers\EmployeeBillingRateController@delete');
  });
        
    Route::middleware('authenticate')->prefix('secondaryaccounts')->group(function () {
    Route::get('/', 'TableControllers\SecondaryAccountsController@index');
    Route::get('/parameters', 'TableControllers\SecondaryAccountsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SecondaryAccountsController@store');
    Route::get('/{recordid}', 'TableControllers\SecondaryAccountsController@show');
    Route::put('/{recordid}', 'TableControllers\SecondaryAccountsController@update');
    Route::delete('/{recordid}', 'TableControllers\SecondaryAccountsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_logfile')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_LogFileController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_LogFileController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_LogFileController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_LogFileController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_LogFileController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_LogFileController@delete');
  });
        
    Route::middleware('authenticate')->prefix('guaranteehubrequestattachment')->group(function () {
    Route::get('/', 'TableControllers\GuaranteeHubRequestAttachmentController@index');
    Route::get('/parameters', 'TableControllers\GuaranteeHubRequestAttachmentController@parameters');
    Route::post('/{recordid?}', 'TableControllers\GuaranteeHubRequestAttachmentController@store');
    Route::get('/{recordid}', 'TableControllers\GuaranteeHubRequestAttachmentController@show');
    Route::put('/{recordid}', 'TableControllers\GuaranteeHubRequestAttachmentController@update');
    Route::delete('/{recordid}', 'TableControllers\GuaranteeHubRequestAttachmentController@delete');
  });
        
    Route::middleware('authenticate')->prefix('township')->group(function () {
    Route::get('/', 'TableControllers\TownshipController@index');
    Route::get('/parameters', 'TableControllers\TownshipController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TownshipController@store');
    Route::get('/{recordid}', 'TableControllers\TownshipController@show');
    Route::put('/{recordid}', 'TableControllers\TownshipController@update');
    Route::delete('/{recordid}', 'TableControllers\TownshipController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matparty')->group(function () {
    Route::get('/', 'TableControllers\MatPartyController@index');
    Route::get('/parameters', 'TableControllers\MatPartyController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatPartyController@store');
    Route::get('/{recordid}', 'TableControllers\MatPartyController@show');
    Route::put('/{recordid}', 'TableControllers\MatPartyController@update');
    Route::delete('/{recordid}', 'TableControllers\MatPartyController@delete');
  });
        
    Route::middleware('authenticate')->prefix('upgradelog')->group(function () {
    Route::get('/', 'TableControllers\UpgradeLogController@index');
    Route::get('/parameters', 'TableControllers\UpgradeLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\UpgradeLogController@store');
    Route::get('/{recordid}', 'TableControllers\UpgradeLogController@show');
    Route::put('/{recordid}', 'TableControllers\UpgradeLogController@update');
    Route::delete('/{recordid}', 'TableControllers\UpgradeLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('grouping')->group(function () {
    Route::get('/', 'TableControllers\GroupingController@index');
    Route::get('/parameters', 'TableControllers\GroupingController@parameters');
    Route::post('/{recordid?}', 'TableControllers\GroupingController@store');
    Route::get('/{recordid}', 'TableControllers\GroupingController@show');
    Route::put('/{recordid}', 'TableControllers\GroupingController@update');
    Route::delete('/{recordid}', 'TableControllers\GroupingController@delete');
  });
        
    Route::middleware('authenticate')->prefix('employeesms')->group(function () {
    Route::get('/', 'TableControllers\EmployeeSmsController@index');
    Route::get('/parameters', 'TableControllers\EmployeeSmsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmployeeSmsController@store');
    Route::get('/{recordid}', 'TableControllers\EmployeeSmsController@show');
    Route::put('/{recordid}', 'TableControllers\EmployeeSmsController@update');
    Route::delete('/{recordid}', 'TableControllers\EmployeeSmsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empalert')->group(function () {
    Route::get('/', 'TableControllers\EmpAlertController@index');
    Route::get('/parameters', 'TableControllers\EmpAlertController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpAlertController@store');
    Route::get('/{recordid}', 'TableControllers\EmpAlertController@show');
    Route::put('/{recordid}', 'TableControllers\EmpAlertController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpAlertController@delete');
  });
        
    Route::middleware('authenticate')->prefix('billingrate')->group(function () {
    Route::get('/', 'TableControllers\BillingRateController@index');
    Route::get('/parameters', 'TableControllers\BillingRateController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BillingRateController@store');
    Route::get('/{recordid}', 'TableControllers\BillingRateController@show');
    Route::put('/{recordid}', 'TableControllers\BillingRateController@update');
    Route::delete('/{recordid}', 'TableControllers\BillingRateController@delete');
  });
        
    Route::middleware('authenticate')->prefix('qbedetail')->group(function () {
    Route::get('/', 'TableControllers\QBEDetailController@index');
    Route::get('/parameters', 'TableControllers\QBEDetailController@parameters');
    Route::post('/{recordid?}', 'TableControllers\QBEDetailController@store');
    Route::get('/{recordid}', 'TableControllers\QBEDetailController@show');
    Route::put('/{recordid}', 'TableControllers\QBEDetailController@update');
    Route::delete('/{recordid}', 'TableControllers\QBEDetailController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matdefparty')->group(function () {
    Route::get('/', 'TableControllers\MatDefPartyController@index');
    Route::get('/parameters', 'TableControllers\MatDefPartyController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatDefPartyController@store');
    Route::get('/{recordid}', 'TableControllers\MatDefPartyController@show');
    Route::put('/{recordid}', 'TableControllers\MatDefPartyController@update');
    Route::delete('/{recordid}', 'TableControllers\MatDefPartyController@delete');
  });
        
    Route::middleware('authenticate')->prefix('signingsessions')->group(function () {
    Route::get('/', 'TableControllers\SigningSessionsController@index');
    Route::get('/parameters', 'TableControllers\SigningSessionsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SigningSessionsController@store');
    Route::get('/{recordid}', 'TableControllers\SigningSessionsController@show');
    Route::put('/{recordid}', 'TableControllers\SigningSessionsController@update');
    Route::delete('/{recordid}', 'TableControllers\SigningSessionsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('liquidationtype')->group(function () {
    Route::get('/', 'TableControllers\LiquidationTypeController@index');
    Route::get('/parameters', 'TableControllers\LiquidationTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LiquidationTypeController@store');
    Route::get('/{recordid}', 'TableControllers\LiquidationTypeController@show');
    Route::put('/{recordid}', 'TableControllers\LiquidationTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\LiquidationTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empallow')->group(function () {
    Route::get('/', 'TableControllers\EmpAllowController@index');
    Route::get('/parameters', 'TableControllers\EmpAllowController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpAllowController@store');
    Route::get('/{recordid}', 'TableControllers\EmpAllowController@show');
    Route::put('/{recordid}', 'TableControllers\EmpAllowController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpAllowController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empalertgroup')->group(function () {
    Route::get('/', 'TableControllers\EmpAlertGroupController@index');
    Route::get('/parameters', 'TableControllers\EmpAlertGroupController@parameters');
    Route::post('/{thisemployeeid?}/{otheremployeeid?}', 'TableControllers\EmpAlertGroupController@store');
    Route::get('/{thisemployeeid}/{otheremployeeid}', 'TableControllers\EmpAlertGroupController@show');
    Route::put('/{thisemployeeid}/{otheremployeeid}', 'TableControllers\EmpAlertGroupController@update');
    Route::delete('/{thisemployeeid}/{otheremployeeid}', 'TableControllers\EmpAlertGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matempbilling')->group(function () {
    Route::get('/', 'TableControllers\MatEmpBillingController@index');
    Route::get('/parameters', 'TableControllers\MatEmpBillingController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatEmpBillingController@store');
    Route::get('/{recordid}', 'TableControllers\MatEmpBillingController@show');
    Route::put('/{recordid}', 'TableControllers\MatEmpBillingController@update');
    Route::delete('/{recordid}', 'TableControllers\MatEmpBillingController@delete');
  });
        
    Route::middleware('authenticate')->prefix('feeitem')->group(function () {
    Route::get('/', 'TableControllers\FeeItemController@index');
    Route::get('/parameters', 'TableControllers\FeeItemController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FeeItemController@store');
    Route::get('/{recordid}', 'TableControllers\FeeItemController@show');
    Route::put('/{recordid}', 'TableControllers\FeeItemController@update');
    Route::delete('/{recordid}', 'TableControllers\FeeItemController@delete');
  });
        
    Route::middleware('authenticate')->prefix('pronoun')->group(function () {
    Route::get('/', 'TableControllers\ProNounController@index');
    Route::get('/parameters', 'TableControllers\ProNounController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ProNounController@store');
    Route::get('/{recordid}', 'TableControllers\ProNounController@show');
    Route::put('/{recordid}', 'TableControllers\ProNounController@update');
    Route::delete('/{recordid}', 'TableControllers\ProNounController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empautodebiting')->group(function () {
    Route::get('/', 'TableControllers\EmpAutoDebitingController@index');
    Route::get('/parameters', 'TableControllers\EmpAutoDebitingController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpAutoDebitingController@store');
    Route::get('/{recordid}', 'TableControllers\EmpAutoDebitingController@show');
    Route::put('/{recordid}', 'TableControllers\EmpAutoDebitingController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpAutoDebitingController@delete');
  });
        
    Route::middleware('authenticate')->prefix('commissionrate')->group(function () {
    Route::get('/', 'TableControllers\CommissionRateController@index');
    Route::get('/parameters', 'TableControllers\CommissionRateController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CommissionRateController@store');
    Route::get('/{recordid}', 'TableControllers\CommissionRateController@show');
    Route::put('/{recordid}', 'TableControllers\CommissionRateController@update');
    Route::delete('/{recordid}', 'TableControllers\CommissionRateController@delete');
  });
        
    Route::middleware('authenticate')->prefix('descript')->group(function () {
    Route::get('/', 'TableControllers\DescriptController@index');
    Route::get('/parameters', 'TableControllers\DescriptController@parameters');
    Route::post('/{languageid?}', 'TableControllers\DescriptController@store');
    Route::get('/{languageid}', 'TableControllers\DescriptController@show');
    Route::put('/{languageid}', 'TableControllers\DescriptController@update');
    Route::delete('/{languageid}', 'TableControllers\DescriptController@delete');
  });
        
    Route::middleware('authenticate')->prefix('report')->group(function () {
    Route::get('/', 'TableControllers\ReportController@index');
    Route::get('/parameters', 'TableControllers\ReportController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportController@store');
    Route::get('/{recordid}', 'TableControllers\ReportController@show');
    Route::put('/{recordid}', 'TableControllers\ReportController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docfoxsummaryrequest')->group(function () {
    Route::get('/', 'TableControllers\DocFoxSummaryRequestController@index');
    Route::get('/parameters', 'TableControllers\DocFoxSummaryRequestController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocFoxSummaryRequestController@store');
    Route::get('/{recordid}', 'TableControllers\DocFoxSummaryRequestController@show');
    Route::put('/{recordid}', 'TableControllers\DocFoxSummaryRequestController@update');
    Route::delete('/{recordid}', 'TableControllers\DocFoxSummaryRequestController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matdocsc')->group(function () {
    Route::get('/', 'TableControllers\MatDocScController@index');
    Route::get('/parameters', 'TableControllers\MatDocScController@parameters');
    Route::post('/{matterid?}/{docscreenid?}', 'TableControllers\MatDocScController@store');
    Route::get('/{matterid}/{docscreenid}', 'TableControllers\MatDocScController@show');
    Route::put('/{matterid}/{docscreenid}', 'TableControllers\MatDocScController@update');
    Route::delete('/{matterid}/{docscreenid}', 'TableControllers\MatDocScController@delete');
  });
        
    Route::middleware('authenticate')->prefix('emprole')->group(function () {
    Route::get('/', 'TableControllers\EmpRoleController@index');
    Route::get('/parameters', 'TableControllers\EmpRoleController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpRoleController@store');
    Route::get('/{recordid}', 'TableControllers\EmpRoleController@show');
    Route::put('/{recordid}', 'TableControllers\EmpRoleController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpRoleController@delete');
  });
        
    Route::middleware('authenticate')->prefix('estatedistribution')->group(function () {
    Route::get('/', 'TableControllers\EstateDistributionController@index');
    Route::get('/parameters', 'TableControllers\EstateDistributionController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EstateDistributionController@store');
    Route::get('/{recordid}', 'TableControllers\EstateDistributionController@show');
    Route::put('/{recordid}', 'TableControllers\EstateDistributionController@update');
    Route::delete('/{recordid}', 'TableControllers\EstateDistributionController@delete');
  });
        
    Route::middleware('authenticate')->prefix('absapartyindicators')->group(function () {
    Route::get('/', 'TableControllers\ABSAPartyIndicatorsController@index');
    Route::get('/parameters', 'TableControllers\ABSAPartyIndicatorsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ABSAPartyIndicatorsController@store');
    Route::get('/{recordid}', 'TableControllers\ABSAPartyIndicatorsController@show');
    Route::put('/{recordid}', 'TableControllers\ABSAPartyIndicatorsController@update');
    Route::delete('/{recordid}', 'TableControllers\ABSAPartyIndicatorsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_control')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_ControlController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_ControlController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_ControlController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_ControlController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_ControlController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_ControlController@delete');
  });
        
    Route::middleware('authenticate')->prefix('crystalreport')->group(function () {
    Route::get('/', 'TableControllers\CrystalReportController@index');
    Route::get('/parameters', 'TableControllers\CrystalReportController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CrystalReportController@store');
    Route::get('/{recordid}', 'TableControllers\CrystalReportController@show');
    Route::put('/{recordid}', 'TableControllers\CrystalReportController@update');
    Route::delete('/{recordid}', 'TableControllers\CrystalReportController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matfield')->group(function () {
    Route::get('/', 'TableControllers\MatFieldController@index');
    Route::get('/parameters', 'TableControllers\MatFieldController@parameters');
    Route::post('/{matterid?}', 'TableControllers\MatFieldController@store');
    Route::get('/{matterid}', 'TableControllers\MatFieldController@show');
    Route::put('/{matterid}', 'TableControllers\MatFieldController@update');
    Route::delete('/{matterid}', 'TableControllers\MatFieldController@delete');
  });
        
    Route::middleware('authenticate')->prefix('consenttype')->group(function () {
    Route::get('/', 'TableControllers\ConsentTypeController@index');
    Route::get('/parameters', 'TableControllers\ConsentTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ConsentTypeController@store');
    Route::get('/{recordid}', 'TableControllers\ConsentTypeController@show');
    Route::put('/{recordid}', 'TableControllers\ConsentTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\ConsentTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('mattersearchresults')->group(function () {
    Route::get('/', 'TableControllers\MatterSearchResultsController@index');
    Route::get('/parameters', 'TableControllers\MatterSearchResultsController@parameters');
    Route::post('/{mattersearchid?}', 'TableControllers\MatterSearchResultsController@store');
    Route::get('/{mattersearchid}', 'TableControllers\MatterSearchResultsController@show');
    Route::put('/{mattersearchid}', 'TableControllers\MatterSearchResultsController@update');
    Route::delete('/{mattersearchid}', 'TableControllers\MatterSearchResultsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('rolelang')->group(function () {
    Route::get('/', 'TableControllers\RoleLangController@index');
    Route::get('/parameters', 'TableControllers\RoleLangController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RoleLangController@store');
    Route::get('/{recordid}', 'TableControllers\RoleLangController@show');
    Route::put('/{recordid}', 'TableControllers\RoleLangController@update');
    Route::delete('/{recordid}', 'TableControllers\RoleLangController@delete');
  });
        
    Route::middleware('authenticate')->prefix('finalaccount')->group(function () {
    Route::get('/', 'TableControllers\FinalAccountController@index');
    Route::get('/parameters', 'TableControllers\FinalAccountController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FinalAccountController@store');
    Route::get('/{recordid}', 'TableControllers\FinalAccountController@show');
    Route::put('/{recordid}', 'TableControllers\FinalAccountController@update');
    Route::delete('/{recordid}', 'TableControllers\FinalAccountController@delete');
  });
        
    Route::middleware('authenticate')->prefix('qbereport')->group(function () {
    Route::get('/', 'TableControllers\QBEReportController@index');
    Route::get('/parameters', 'TableControllers\QBEReportController@parameters');
    Route::post('/{recordid?}', 'TableControllers\QBEReportController@store');
    Route::get('/{recordid}', 'TableControllers\QBEReportController@show');
    Route::put('/{recordid}', 'TableControllers\QBEReportController@update');
    Route::delete('/{recordid}', 'TableControllers\QBEReportController@delete');
  });
        
    Route::middleware('authenticate')->prefix('party')->group(function () {
    Route::get('/', 'TableControllers\PartyController@index');
    Route::get('/parameters', 'TableControllers\PartyController@parameters');
    Route::post('/{recordid?}', 'TableControllers\PartyController@store');
    Route::get('/{recordid}', 'TableControllers\PartyController@show');
    Route::put('/{recordid}', 'TableControllers\PartyController@update');
    Route::delete('/{recordid}', 'TableControllers\PartyController@delete');
  });
        
    Route::middleware('authenticate')->prefix('library')->group(function () {
    Route::get('/', 'TableControllers\LibraryController@index');
    Route::get('/parameters', 'TableControllers\LibraryController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LibraryController@store');
    Route::get('/{recordid}', 'TableControllers\LibraryController@show');
    Route::put('/{recordid}', 'TableControllers\LibraryController@update');
    Route::delete('/{recordid}', 'TableControllers\LibraryController@delete');
  });
        
    Route::middleware('authenticate')->prefix('taggedmatter')->group(function () {
    Route::get('/', 'TableControllers\TaggedMatterController@index');
    Route::get('/parameters', 'TableControllers\TaggedMatterController@parameters');
    Route::post('/{matterid?}/{employeeid?}', 'TableControllers\TaggedMatterController@store');
    Route::get('/{matterid}/{employeeid}', 'TableControllers\TaggedMatterController@show');
    Route::put('/{matterid}/{employeeid}', 'TableControllers\TaggedMatterController@update');
    Route::delete('/{matterid}/{employeeid}', 'TableControllers\TaggedMatterController@delete');
  });
        
    Route::middleware('authenticate')->prefix('documentcategories')->group(function () {
    Route::get('/', 'TableControllers\DocumentCategoriesController@index');
    Route::get('/parameters', 'TableControllers\DocumentCategoriesController@parameters');
    Route::post('/{documentid?}/{doccategoryid?}', 'TableControllers\DocumentCategoriesController@store');
    Route::get('/{documentid}/{doccategoryid}', 'TableControllers\DocumentCategoriesController@show');
    Route::put('/{documentid}/{doccategoryid}', 'TableControllers\DocumentCategoriesController@update');
    Route::delete('/{documentid}/{doccategoryid}', 'TableControllers\DocumentCategoriesController@delete');
  });
        
    Route::middleware('authenticate')->prefix('secfield')->group(function () {
    Route::get('/', 'TableControllers\SecFieldController@index');
    Route::get('/parameters', 'TableControllers\SecFieldController@parameters');
    Route::post('/{?}', 'TableControllers\SecFieldController@store');
    Route::get('/{}', 'TableControllers\SecFieldController@show');
    Route::put('/{}', 'TableControllers\SecFieldController@update');
    Route::delete('/{}', 'TableControllers\SecFieldController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doclang')->group(function () {
    Route::get('/', 'TableControllers\DocLangController@index');
    Route::get('/parameters', 'TableControllers\DocLangController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocLangController@store');
    Route::get('/{recordid}', 'TableControllers\DocLangController@show');
    Route::put('/{recordid}', 'TableControllers\DocLangController@update');
    Route::delete('/{recordid}', 'TableControllers\DocLangController@delete');
  });
        
    Route::middleware('authenticate')->prefix('usertype')->group(function () {
    Route::get('/', 'TableControllers\USERTYPEController@index');
    Route::get('/parameters', 'TableControllers\USERTYPEController@parameters');
    Route::post('/{recordid?}', 'TableControllers\USERTYPEController@store');
    Route::get('/{recordid}', 'TableControllers\USERTYPEController@show');
    Route::put('/{recordid}', 'TableControllers\USERTYPEController@update');
    Route::delete('/{recordid}', 'TableControllers\USERTYPEController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ned_messagesreceived')->group(function () {
    Route::get('/', 'TableControllers\NED_MessagesReceivedController@index');
    Route::get('/parameters', 'TableControllers\NED_MessagesReceivedController@parameters');
    Route::post('/{recordid?}', 'TableControllers\NED_MessagesReceivedController@store');
    Route::get('/{recordid}', 'TableControllers\NED_MessagesReceivedController@show');
    Route::put('/{recordid}', 'TableControllers\NED_MessagesReceivedController@update');
    Route::delete('/{recordid}', 'TableControllers\NED_MessagesReceivedController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matgroup')->group(function () {
    Route::get('/', 'TableControllers\MatGroupController@index');
    Route::get('/parameters', 'TableControllers\MatGroupController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatGroupController@store');
    Route::get('/{recordid}', 'TableControllers\MatGroupController@show');
    Route::put('/{recordid}', 'TableControllers\MatGroupController@update');
    Route::delete('/{recordid}', 'TableControllers\MatGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('role')->group(function () {
    Route::get('/', 'TableControllers\RoleController@index');
    Route::get('/parameters', 'TableControllers\RoleController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RoleController@store');
    Route::get('/{recordid}', 'TableControllers\RoleController@show');
    Route::put('/{recordid}', 'TableControllers\RoleController@update');
    Route::delete('/{recordid}', 'TableControllers\RoleController@delete');
  });
        
    Route::middleware('authenticate')->prefix('custominvoice')->group(function () {
    Route::get('/', 'TableControllers\CustomInvoiceController@index');
    Route::get('/parameters', 'TableControllers\CustomInvoiceController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CustomInvoiceController@store');
    Route::get('/{recordid}', 'TableControllers\CustomInvoiceController@show');
    Route::put('/{recordid}', 'TableControllers\CustomInvoiceController@update');
    Route::delete('/{recordid}', 'TableControllers\CustomInvoiceController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parfilenote')->group(function () {
    Route::get('/', 'TableControllers\ParFileNoteController@index');
    Route::get('/parameters', 'TableControllers\ParFileNoteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParFileNoteController@store');
    Route::get('/{recordid}', 'TableControllers\ParFileNoteController@show');
    Route::put('/{recordid}', 'TableControllers\ParFileNoteController@update');
    Route::delete('/{recordid}', 'TableControllers\ParFileNoteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('dgenlang')->group(function () {
    Route::get('/', 'TableControllers\DGenLangController@index');
    Route::get('/parameters', 'TableControllers\DGenLangController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DGenLangController@store');
    Route::get('/{recordid}', 'TableControllers\DGenLangController@show');
    Route::put('/{recordid}', 'TableControllers\DGenLangController@update');
    Route::delete('/{recordid}', 'TableControllers\DGenLangController@delete');
  });
        
    Route::middleware('authenticate')->prefix('mattype')->group(function () {
    Route::get('/', 'TableControllers\MatTypeController@index');
    Route::get('/parameters', 'TableControllers\MatTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatTypeController@store');
    Route::get('/{recordid}', 'TableControllers\MatTypeController@show');
    Route::put('/{recordid}', 'TableControllers\MatTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\MatTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('partele')->group(function () {
    Route::get('/', 'TableControllers\ParTeleController@index');
    Route::get('/parameters', 'TableControllers\ParTeleController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParTeleController@store');
    Route::get('/{recordid}', 'TableControllers\ParTeleController@show');
    Route::put('/{recordid}', 'TableControllers\ParTeleController@update');
    Route::delete('/{recordid}', 'TableControllers\ParTeleController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_status')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_StatusController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_StatusController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_StatusController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_StatusController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_StatusController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_StatusController@delete');
  });
        
    Route::middleware('authenticate')->prefix('vresult')->group(function () {
    Route::get('/', 'TableControllers\VResultController@index');
    Route::get('/parameters', 'TableControllers\VResultController@parameters');
    Route::post('/{recordid?}', 'TableControllers\VResultController@store');
    Route::get('/{recordid}', 'TableControllers\VResultController@show');
    Route::put('/{recordid}', 'TableControllers\VResultController@update');
    Route::delete('/{recordid}', 'TableControllers\VResultController@delete');
  });
        
    Route::middleware('authenticate')->prefix('linkeddocument')->group(function () {
    Route::get('/', 'TableControllers\LinkedDocumentController@index');
    Route::get('/parameters', 'TableControllers\LinkedDocumentController@parameters');
    Route::post('/{linkedid?}/{documentid?}', 'TableControllers\LinkedDocumentController@store');
    Route::get('/{linkedid}/{documentid}', 'TableControllers\LinkedDocumentController@show');
    Route::put('/{linkedid}/{documentid}', 'TableControllers\LinkedDocumentController@update');
    Route::delete('/{linkedid}/{documentid}', 'TableControllers\LinkedDocumentController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bankcode')->group(function () {
    Route::get('/', 'TableControllers\BankCodeController@index');
    Route::get('/parameters', 'TableControllers\BankCodeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BankCodeController@store');
    Route::get('/{recordid}', 'TableControllers\BankCodeController@show');
    Route::put('/{recordid}', 'TableControllers\BankCodeController@update');
    Route::delete('/{recordid}', 'TableControllers\BankCodeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('partodonote')->group(function () {
    Route::get('/', 'TableControllers\ParToDoNoteController@index');
    Route::get('/parameters', 'TableControllers\ParToDoNoteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParToDoNoteController@store');
    Route::get('/{recordid}', 'TableControllers\ParToDoNoteController@show');
    Route::put('/{recordid}', 'TableControllers\ParToDoNoteController@update');
    Route::delete('/{recordid}', 'TableControllers\ParToDoNoteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('sheriffarea')->group(function () {
    Route::get('/', 'TableControllers\SheriffAreaController@index');
    Route::get('/parameters', 'TableControllers\SheriffAreaController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SheriffAreaController@store');
    Route::get('/{recordid}', 'TableControllers\SheriffAreaController@show');
    Route::put('/{recordid}', 'TableControllers\SheriffAreaController@update');
    Route::delete('/{recordid}', 'TableControllers\SheriffAreaController@delete');
  });
        
    Route::middleware('authenticate')->prefix('sessiontype')->group(function () {
    Route::get('/', 'TableControllers\SessionTypeController@index');
    Route::get('/parameters', 'TableControllers\SessionTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SessionTypeController@store');
    Route::get('/{recordid}', 'TableControllers\SessionTypeController@show');
    Route::put('/{recordid}', 'TableControllers\SessionTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\SessionTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('smslog')->group(function () {
    Route::get('/', 'TableControllers\SMSLogController@index');
    Route::get('/parameters', 'TableControllers\SMSLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SMSLogController@store');
    Route::get('/{recordid}', 'TableControllers\SMSLogController@show');
    Route::put('/{recordid}', 'TableControllers\SMSLogController@update');
    Route::delete('/{recordid}', 'TableControllers\SMSLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('business')->group(function () {
    Route::get('/', 'TableControllers\BusinessController@index');
    Route::get('/parameters', 'TableControllers\BusinessController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BusinessController@store');
    Route::get('/{recordid}', 'TableControllers\BusinessController@show');
    Route::put('/{recordid}', 'TableControllers\BusinessController@update');
    Route::delete('/{recordid}', 'TableControllers\BusinessController@delete');
  });
        
    Route::middleware('authenticate')->prefix('cancdefs')->group(function () {
    Route::get('/', 'TableControllers\CancDefsController@index');
    Route::get('/parameters', 'TableControllers\CancDefsController@parameters');
    Route::post('/{languageid?}/{employeeid?}', 'TableControllers\CancDefsController@store');
    Route::get('/{languageid}/{employeeid}', 'TableControllers\CancDefsController@show');
    Route::put('/{languageid}/{employeeid}', 'TableControllers\CancDefsController@update');
    Route::delete('/{languageid}/{employeeid}', 'TableControllers\CancDefsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('propertyhub')->group(function () {
    Route::get('/', 'TableControllers\PropertyHubController@index');
    Route::get('/parameters', 'TableControllers\PropertyHubController@parameters');
    Route::post('/{recordid?}', 'TableControllers\PropertyHubController@store');
    Route::get('/{recordid}', 'TableControllers\PropertyHubController@show');
    Route::put('/{recordid}', 'TableControllers\PropertyHubController@update');
    Route::delete('/{recordid}', 'TableControllers\PropertyHubController@delete');
  });
        
    Route::middleware('authenticate')->prefix('licensed')->group(function () {
    Route::get('/', 'TableControllers\LicensedController@index');
    Route::get('/parameters', 'TableControllers\LicensedController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LicensedController@store');
    Route::get('/{recordid}', 'TableControllers\LicensedController@show');
    Route::put('/{recordid}', 'TableControllers\LicensedController@update');
    Route::delete('/{recordid}', 'TableControllers\LicensedController@delete');
  });
        
    Route::middleware('authenticate')->prefix('debitorder')->group(function () {
    Route::get('/', 'TableControllers\DebitOrderController@index');
    Route::get('/parameters', 'TableControllers\DebitOrderController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DebitOrderController@store');
    Route::get('/{recordid}', 'TableControllers\DebitOrderController@show');
    Route::put('/{recordid}', 'TableControllers\DebitOrderController@update');
    Route::delete('/{recordid}', 'TableControllers\DebitOrderController@delete');
  });
        
    Route::middleware('authenticate')->prefix('partygrouping')->group(function () {
    Route::get('/', 'TableControllers\PartyGroupingController@index');
    Route::get('/parameters', 'TableControllers\PartyGroupingController@parameters');
    Route::post('/{recordid?}', 'TableControllers\PartyGroupingController@store');
    Route::get('/{recordid}', 'TableControllers\PartyGroupingController@show');
    Route::put('/{recordid}', 'TableControllers\PartyGroupingController@update');
    Route::delete('/{recordid}', 'TableControllers\PartyGroupingController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_lodgingfirm')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_LodgingFirmController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_LodgingFirmController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_LodgingFirmController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_LodgingFirmController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_LodgingFirmController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_LodgingFirmController@delete');
  });
        
    Route::middleware('authenticate')->prefix('activity')->group(function () {
    Route::get('/', 'TableControllers\ActivityController@index');
    Route::get('/parameters', 'TableControllers\ActivityController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ActivityController@store');
    Route::get('/{recordid}', 'TableControllers\ActivityController@show');
    Route::put('/{recordid}', 'TableControllers\ActivityController@update');
    Route::delete('/{recordid}', 'TableControllers\ActivityController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ph_mattermessage')->group(function () {
    Route::get('/', 'TableControllers\PH_MatterMessageController@index');
    Route::get('/parameters', 'TableControllers\PH_MatterMessageController@parameters');
    Route::post('/{recordid?}', 'TableControllers\PH_MatterMessageController@store');
    Route::get('/{recordid}', 'TableControllers\PH_MatterMessageController@show');
    Route::put('/{recordid}', 'TableControllers\PH_MatterMessageController@update');
    Route::delete('/{recordid}', 'TableControllers\PH_MatterMessageController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empprinter')->group(function () {
    Route::get('/', 'TableControllers\EmpPrinterController@index');
    Route::get('/parameters', 'TableControllers\EmpPrinterController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpPrinterController@store');
    Route::get('/{recordid}', 'TableControllers\EmpPrinterController@show');
    Route::put('/{recordid}', 'TableControllers\EmpPrinterController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpPrinterController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docgen')->group(function () {
    Route::get('/', 'TableControllers\DocgenController@index');
    Route::get('/parameters', 'TableControllers\DocgenController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocgenController@store');
    Route::get('/{recordid}', 'TableControllers\DocgenController@show');
    Route::put('/{recordid}', 'TableControllers\DocgenController@update');
    Route::delete('/{recordid}', 'TableControllers\DocgenController@delete');
  });
        
    Route::middleware('authenticate')->prefix('messagesreceived')->group(function () {
    Route::get('/', 'TableControllers\MessagesReceivedController@index');
    Route::get('/parameters', 'TableControllers\MessagesReceivedController@parameters');
    Route::post('/{id?}', 'TableControllers\MessagesReceivedController@store');
    Route::get('/{id}', 'TableControllers\MessagesReceivedController@show');
    Route::put('/{id}', 'TableControllers\MessagesReceivedController@update');
    Route::delete('/{id}', 'TableControllers\MessagesReceivedController@delete');
  });
        
    Route::middleware('authenticate')->prefix('pargroup')->group(function () {
    Route::get('/', 'TableControllers\ParGroupController@index');
    Route::get('/parameters', 'TableControllers\ParGroupController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParGroupController@store');
    Route::get('/{recordid}', 'TableControllers\ParGroupController@show');
    Route::put('/{recordid}', 'TableControllers\ParGroupController@update');
    Route::delete('/{recordid}', 'TableControllers\ParGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_instructingfirm')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_InstructingFirmController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_InstructingFirmController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_InstructingFirmController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_InstructingFirmController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_InstructingFirmController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_InstructingFirmController@delete');
  });
        
    Route::middleware('authenticate')->prefix('sessiondata')->group(function () {
    Route::get('/', 'TableControllers\SessionDataController@index');
    Route::get('/parameters', 'TableControllers\SessionDataController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SessionDataController@store');
    Route::get('/{recordid}', 'TableControllers\SessionDataController@show');
    Route::put('/{recordid}', 'TableControllers\SessionDataController@update');
    Route::delete('/{recordid}', 'TableControllers\SessionDataController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doctodoitem')->group(function () {
    Route::get('/', 'TableControllers\DocToDoItemController@index');
    Route::get('/parameters', 'TableControllers\DocToDoItemController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocToDoItemController@store');
    Route::get('/{recordid}', 'TableControllers\DocToDoItemController@show');
    Route::put('/{recordid}', 'TableControllers\DocToDoItemController@update');
    Route::delete('/{recordid}', 'TableControllers\DocToDoItemController@delete');
  });
        
    Route::middleware('authenticate')->prefix('versionlog')->group(function () {
    Route::get('/', 'TableControllers\VersionLogController@index');
    Route::get('/parameters', 'TableControllers\VersionLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\VersionLogController@store');
    Route::get('/{recordid}', 'TableControllers\VersionLogController@show');
    Route::put('/{recordid}', 'TableControllers\VersionLogController@update');
    Route::delete('/{recordid}', 'TableControllers\VersionLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('nedctl')->group(function () {
    Route::get('/', 'TableControllers\NedCtlController@index');
    Route::get('/parameters', 'TableControllers\NedCtlController@parameters');
    Route::post('/{recordid?}', 'TableControllers\NedCtlController@store');
    Route::get('/{recordid}', 'TableControllers\NedCtlController@show');
    Route::put('/{recordid}', 'TableControllers\NedCtlController@update');
    Route::delete('/{recordid}', 'TableControllers\NedCtlController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parrolsc')->group(function () {
    Route::get('/', 'TableControllers\ParRolScController@index');
    Route::get('/parameters', 'TableControllers\ParRolScController@parameters');
    Route::post('/{rolescreenid?}/{matpartyid?}', 'TableControllers\ParRolScController@store');
    Route::get('/{rolescreenid}/{matpartyid}', 'TableControllers\ParRolScController@show');
    Route::put('/{rolescreenid}/{matpartyid}', 'TableControllers\ParRolScController@update');
    Route::delete('/{rolescreenid}/{matpartyid}', 'TableControllers\ParRolScController@delete');
  });
        
    Route::middleware('authenticate')->prefix('relationship')->group(function () {
    Route::get('/', 'TableControllers\RelationshipController@index');
    Route::get('/parameters', 'TableControllers\RelationshipController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RelationshipController@store');
    Route::get('/{recordid}', 'TableControllers\RelationshipController@show');
    Route::put('/{recordid}', 'TableControllers\RelationshipController@update');
    Route::delete('/{recordid}', 'TableControllers\RelationshipController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lexissigndocumentdownload')->group(function () {
    Route::get('/', 'TableControllers\LexisSignDocumentDownloadController@index');
    Route::get('/parameters', 'TableControllers\LexisSignDocumentDownloadController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LexisSignDocumentDownloadController@store');
    Route::get('/{recordid}', 'TableControllers\LexisSignDocumentDownloadController@show');
    Route::put('/{recordid}', 'TableControllers\LexisSignDocumentDownloadController@update');
    Route::delete('/{recordid}', 'TableControllers\LexisSignDocumentDownloadController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_lodgingparalegal')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_LodgingParaLegalController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_LodgingParaLegalController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_LodgingParaLegalController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_LodgingParaLegalController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_LodgingParaLegalController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_LodgingParaLegalController@delete');
  });
        
    Route::middleware('authenticate')->prefix('nedinst')->group(function () {
    Route::get('/', 'TableControllers\NedInstController@index');
    Route::get('/parameters', 'TableControllers\NedInstController@parameters');
    Route::post('/{recordid?}', 'TableControllers\NedInstController@store');
    Route::get('/{recordid}', 'TableControllers\NedInstController@show');
    Route::put('/{recordid}', 'TableControllers\NedInstController@update');
    Route::delete('/{recordid}', 'TableControllers\NedInstController@delete');
  });
        
    Route::middleware('authenticate')->prefix('feesheet')->group(function () {
    Route::get('/', 'TableControllers\FeeSheetController@index');
    Route::get('/parameters', 'TableControllers\FeeSheetController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FeeSheetController@store');
    Route::get('/{recordid}', 'TableControllers\FeeSheetController@show');
    Route::put('/{recordid}', 'TableControllers\FeeSheetController@update');
    Route::delete('/{recordid}', 'TableControllers\FeeSheetController@delete');
  });
        
    Route::middleware('authenticate')->prefix('mattranhis')->group(function () {
    Route::get('/', 'TableControllers\MatTranHisController@index');
    Route::get('/parameters', 'TableControllers\MatTranHisController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatTranHisController@store');
    Route::get('/{recordid}', 'TableControllers\MatTranHisController@show');
    Route::put('/{recordid}', 'TableControllers\MatTranHisController@update');
    Route::delete('/{recordid}', 'TableControllers\MatTranHisController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ph_message')->group(function () {
    Route::get('/', 'TableControllers\PH_MessageController@index');
    Route::get('/parameters', 'TableControllers\PH_MessageController@parameters');
    Route::post('/{recordid?}', 'TableControllers\PH_MessageController@store');
    Route::get('/{recordid}', 'TableControllers\PH_MessageController@show');
    Route::put('/{recordid}', 'TableControllers\PH_MessageController@update');
    Route::delete('/{recordid}', 'TableControllers\PH_MessageController@delete');
  });
        
    Route::middleware('authenticate')->prefix('customreports')->group(function () {
    Route::get('/', 'TableControllers\CustomReportsController@index');
    Route::get('/parameters', 'TableControllers\CustomReportsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CustomReportsController@store');
    Route::get('/{recordid}', 'TableControllers\CustomReportsController@show');
    Route::put('/{recordid}', 'TableControllers\CustomReportsController@update');
    Route::delete('/{recordid}', 'TableControllers\CustomReportsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('busgroup')->group(function () {
    Route::get('/', 'TableControllers\BusGroupController@index');
    Route::get('/parameters', 'TableControllers\BusGroupController@parameters');
    Route::post('/{groupid?}/{businessid?}', 'TableControllers\BusGroupController@store');
    Route::get('/{groupid}/{businessid}', 'TableControllers\BusGroupController@show');
    Route::put('/{groupid}/{businessid}', 'TableControllers\BusGroupController@update');
    Route::delete('/{groupid}/{businessid}', 'TableControllers\BusGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ehcollections')->group(function () {
    Route::get('/', 'TableControllers\EHCollectionsController@index');
    Route::get('/parameters', 'TableControllers\EHCollectionsController@parameters');
    Route::post('/{?}', 'TableControllers\EHCollectionsController@store');
    Route::get('/{}', 'TableControllers\EHCollectionsController@show');
    Route::put('/{}', 'TableControllers\EHCollectionsController@update');
    Route::delete('/{}', 'TableControllers\EHCollectionsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_instructingparalegal')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_InstructingParaLegalController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_InstructingParaLegalController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_InstructingParaLegalController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_InstructingParaLegalController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_InstructingParaLegalController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_InstructingParaLegalController@delete');
  });
        
    Route::middleware('authenticate')->prefix('prontext')->group(function () {
    Route::get('/', 'TableControllers\PronTextController@index');
    Route::get('/parameters', 'TableControllers\PronTextController@parameters');
    Route::post('/{pronounid?}/{languageid?}', 'TableControllers\PronTextController@store');
    Route::get('/{pronounid}/{languageid}', 'TableControllers\PronTextController@show');
    Route::put('/{pronounid}/{languageid}', 'TableControllers\PronTextController@update');
    Route::delete('/{pronounid}/{languageid}', 'TableControllers\PronTextController@delete');
  });
        
    Route::middleware('authenticate')->prefix('settings')->group(function () {
    Route::get('/', 'TableControllers\SettingsController@index');
    Route::get('/parameters', 'TableControllers\SettingsController@parameters');
    Route::post('/{name?}', 'TableControllers\SettingsController@store');
    Route::get('/{name}', 'TableControllers\SettingsController@show');
    Route::put('/{name}', 'TableControllers\SettingsController@update');
    Route::delete('/{name}', 'TableControllers\SettingsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parrel')->group(function () {
    Route::get('/', 'TableControllers\ParRelController@index');
    Route::get('/parameters', 'TableControllers\ParRelController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParRelController@store');
    Route::get('/{recordid}', 'TableControllers\ParRelController@show');
    Route::put('/{recordid}', 'TableControllers\ParRelController@update');
    Route::delete('/{recordid}', 'TableControllers\ParRelController@delete');
  });
        
    Route::middleware('authenticate')->prefix('resultset')->group(function () {
    Route::get('/', 'TableControllers\ResultSetController@index');
    Route::get('/parameters', 'TableControllers\ResultSetController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ResultSetController@store');
    Route::get('/{recordid}', 'TableControllers\ResultSetController@show');
    Route::put('/{recordid}', 'TableControllers\ResultSetController@update');
    Route::delete('/{recordid}', 'TableControllers\ResultSetController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docdisplaycriteria')->group(function () {
    Route::get('/', 'TableControllers\DocDisplayCriteriaController@index');
    Route::get('/parameters', 'TableControllers\DocDisplayCriteriaController@parameters');
    Route::post('/{verbid?}/{subjectid?}/{objectid?}/{documentid?}', 'TableControllers\DocDisplayCriteriaController@store');
    Route::get('/{verbid}/{subjectid}/{objectid}/{documentid}', 'TableControllers\DocDisplayCriteriaController@show');
    Route::put('/{verbid}/{subjectid}/{objectid}/{documentid}', 'TableControllers\DocDisplayCriteriaController@update');
    Route::delete('/{verbid}/{subjectid}/{objectid}/{documentid}', 'TableControllers\DocDisplayCriteriaController@delete');
  });
        
    Route::middleware('authenticate')->prefix('rc')->group(function () {
    Route::get('/', 'TableControllers\rcController@index');
    Route::get('/parameters', 'TableControllers\rcController@parameters');
    Route::post('/{recordid?}', 'TableControllers\rcController@store');
    Route::get('/{recordid}', 'TableControllers\rcController@show');
    Route::put('/{recordid}', 'TableControllers\rcController@update');
    Route::delete('/{recordid}', 'TableControllers\rcController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matemployee')->group(function () {
    Route::get('/', 'TableControllers\MatEmployeeController@index');
    Route::get('/parameters', 'TableControllers\MatEmployeeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatEmployeeController@store');
    Route::get('/{recordid}', 'TableControllers\MatEmployeeController@show');
    Route::put('/{recordid}', 'TableControllers\MatEmployeeController@update');
    Route::delete('/{recordid}', 'TableControllers\MatEmployeeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('absadocs')->group(function () {
    Route::get('/', 'TableControllers\ABSADocsController@index');
    Route::get('/parameters', 'TableControllers\ABSADocsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ABSADocsController@store');
    Route::get('/{recordid}', 'TableControllers\ABSADocsController@show');
    Route::put('/{recordid}', 'TableControllers\ABSADocsController@update');
    Route::delete('/{recordid}', 'TableControllers\ABSADocsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('stagegroup')->group(function () {
    Route::get('/', 'TableControllers\StageGroupController@index');
    Route::get('/parameters', 'TableControllers\StageGroupController@parameters');
    Route::post('/{recordid?}', 'TableControllers\StageGroupController@store');
    Route::get('/{recordid}', 'TableControllers\StageGroupController@show');
    Route::put('/{recordid}', 'TableControllers\StageGroupController@update');
    Route::delete('/{recordid}', 'TableControllers\StageGroupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ph_messagestosend')->group(function () {
    Route::get('/', 'TableControllers\PH_MessagesToSendController@index');
    Route::get('/parameters', 'TableControllers\PH_MessagesToSendController@parameters');
    Route::post('/{messageid?}', 'TableControllers\PH_MessagesToSendController@store');
    Route::get('/{messageid}', 'TableControllers\PH_MessagesToSendController@show');
    Route::put('/{messageid}', 'TableControllers\PH_MessagesToSendController@update');
    Route::delete('/{messageid}', 'TableControllers\PH_MessagesToSendController@delete');
  });
        
    Route::middleware('authenticate')->prefix('nedbrand')->group(function () {
    Route::get('/', 'TableControllers\NedBrandController@index');
    Route::get('/parameters', 'TableControllers\NedBrandController@parameters');
    Route::post('/{recordid?}', 'TableControllers\NedBrandController@store');
    Route::get('/{recordid}', 'TableControllers\NedBrandController@show');
    Route::put('/{recordid}', 'TableControllers\NedBrandController@update');
    Route::delete('/{recordid}', 'TableControllers\NedBrandController@delete');
  });
        
    Route::middleware('authenticate')->prefix('regarea')->group(function () {
    Route::get('/', 'TableControllers\RegAreaController@index');
    Route::get('/parameters', 'TableControllers\RegAreaController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RegAreaController@store');
    Route::get('/{recordid}', 'TableControllers\RegAreaController@show');
    Route::put('/{recordid}', 'TableControllers\RegAreaController@update');
    Route::delete('/{recordid}', 'TableControllers\RegAreaController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matactiv')->group(function () {
    Route::get('/', 'TableControllers\MatActivController@index');
    Route::get('/parameters', 'TableControllers\MatActivController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatActivController@store');
    Route::get('/{recordid}', 'TableControllers\MatActivController@show');
    Route::put('/{recordid}', 'TableControllers\MatActivController@update');
    Route::delete('/{recordid}', 'TableControllers\MatActivController@delete');
  });
        
    Route::middleware('authenticate')->prefix('session')->group(function () {
    Route::get('/', 'TableControllers\SessionController@index');
    Route::get('/parameters', 'TableControllers\SessionController@parameters');
    Route::post('/{recordid?}', 'TableControllers\SessionController@store');
    Route::get('/{recordid}', 'TableControllers\SessionController@show');
    Route::put('/{recordid}', 'TableControllers\SessionController@update');
    Route::delete('/{recordid}', 'TableControllers\SessionController@delete');
  });
        
    Route::middleware('authenticate')->prefix('emptype')->group(function () {
    Route::get('/', 'TableControllers\EmpTypeController@index');
    Route::get('/parameters', 'TableControllers\EmpTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpTypeController@store');
    Route::get('/{recordid}', 'TableControllers\EmpTypeController@show');
    Route::put('/{recordid}', 'TableControllers\EmpTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ph_messagesreceived')->group(function () {
    Route::get('/', 'TableControllers\PH_MessagesReceivedController@index');
    Route::get('/parameters', 'TableControllers\PH_MessagesReceivedController@parameters');
    Route::post('/{id?}', 'TableControllers\PH_MessagesReceivedController@store');
    Route::get('/{id}', 'TableControllers\PH_MessagesReceivedController@show');
    Route::put('/{id}', 'TableControllers\PH_MessagesReceivedController@update');
    Route::delete('/{id}', 'TableControllers\PH_MessagesReceivedController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matter')->group(function () {
    Route::get('/', 'TableControllers\MatterController@index');
    Route::get('/parameters', 'TableControllers\MatterController@parameters');
    Route::post('/{recordid?}', 'TableControllers\MatterController@store');
    Route::get('/{recordid}', 'TableControllers\MatterController@show');
    Route::put('/{recordid}', 'TableControllers\MatterController@update');
    Route::delete('/{recordid}', 'TableControllers\MatterController@delete');
  });
        
    Route::middleware('authenticate')->prefix('qbetagset')->group(function () {
    Route::get('/', 'TableControllers\QBETagSetController@index');
    Route::get('/parameters', 'TableControllers\QBETagSetController@parameters');
    Route::post('/{recordid?}', 'TableControllers\QBETagSetController@store');
    Route::get('/{recordid}', 'TableControllers\QBETagSetController@show');
    Route::put('/{recordid}', 'TableControllers\QBETagSetController@update');
    Route::delete('/{recordid}', 'TableControllers\QBETagSetController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docfilenote')->group(function () {
    Route::get('/', 'TableControllers\DocFileNoteController@index');
    Route::get('/parameters', 'TableControllers\DocFileNoteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocFileNoteController@store');
    Route::get('/{recordid}', 'TableControllers\DocFileNoteController@show');
    Route::put('/{recordid}', 'TableControllers\DocFileNoteController@update');
    Route::delete('/{recordid}', 'TableControllers\DocFileNoteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doccategory')->group(function () {
    Route::get('/', 'TableControllers\DocCategoryController@index');
    Route::get('/parameters', 'TableControllers\DocCategoryController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocCategoryController@store');
    Route::get('/{recordid}', 'TableControllers\DocCategoryController@show');
    Route::put('/{recordid}', 'TableControllers\DocCategoryController@update');
    Route::delete('/{recordid}', 'TableControllers\DocCategoryController@delete');
  });
        
    Route::middleware('authenticate')->prefix('notice')->group(function () {
    Route::get('/', 'TableControllers\NoticeController@index');
    Route::get('/parameters', 'TableControllers\NoticeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\NoticeController@store');
    Route::get('/{recordid}', 'TableControllers\NoticeController@show');
    Route::put('/{recordid}', 'TableControllers\NoticeController@update');
    Route::delete('/{recordid}', 'TableControllers\NoticeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docdef')->group(function () {
    Route::get('/', 'TableControllers\DocDefController@index');
    Route::get('/parameters', 'TableControllers\DocDefController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocDefController@store');
    Route::get('/{recordid}', 'TableControllers\DocDefController@show');
    Route::put('/{recordid}', 'TableControllers\DocDefController@update');
    Route::delete('/{recordid}', 'TableControllers\DocDefController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tally')->group(function () {
    Route::get('/', 'TableControllers\TallyController@index');
    Route::get('/parameters', 'TableControllers\TallyController@parameters');
    Route::post('/{n?}', 'TableControllers\TallyController@store');
    Route::get('/{n}', 'TableControllers\TallyController@show');
    Route::put('/{n}', 'TableControllers\TallyController@update');
    Route::delete('/{n}', 'TableControllers\TallyController@delete');
  });
        
    Route::middleware('authenticate')->prefix('telecall')->group(function () {
    Route::get('/', 'TableControllers\TeleCallController@index');
    Route::get('/parameters', 'TableControllers\TeleCallController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TeleCallController@store');
    Route::get('/{recordid}', 'TableControllers\TeleCallController@show');
    Route::put('/{recordid}', 'TableControllers\TeleCallController@update');
    Route::delete('/{recordid}', 'TableControllers\TeleCallController@delete');
  });
        
    Route::middleware('authenticate')->prefix('feenote')->group(function () {
    Route::get('/', 'TableControllers\FeeNoteController@index');
    Route::get('/parameters', 'TableControllers\FeeNoteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FeeNoteController@store');
    Route::get('/{recordid}', 'TableControllers\FeeNoteController@show');
    Route::put('/{recordid}', 'TableControllers\FeeNoteController@update');
    Route::delete('/{recordid}', 'TableControllers\FeeNoteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parlang')->group(function () {
    Route::get('/', 'TableControllers\ParLangController@index');
    Route::get('/parameters', 'TableControllers\ParLangController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParLangController@store');
    Route::get('/{recordid}', 'TableControllers\ParLangController@show');
    Route::put('/{recordid}', 'TableControllers\ParLangController@update');
    Route::delete('/{recordid}', 'TableControllers\ParLangController@delete');
  });
        
    Route::middleware('authenticate')->prefix('estate')->group(function () {
    Route::get('/', 'TableControllers\EstateController@index');
    Route::get('/parameters', 'TableControllers\EstateController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EstateController@store');
    Route::get('/{recordid}', 'TableControllers\EstateController@show');
    Route::put('/{recordid}', 'TableControllers\EstateController@update');
    Route::delete('/{recordid}', 'TableControllers\EstateController@delete');
  });
        
    Route::middleware('authenticate')->prefix('documentextrascreen')->group(function () {
    Route::get('/', 'TableControllers\DocumentExtraScreenController@index');
    Route::get('/parameters', 'TableControllers\DocumentExtraScreenController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocumentExtraScreenController@store');
    Route::get('/{recordid}', 'TableControllers\DocumentExtraScreenController@show');
    Route::put('/{recordid}', 'TableControllers\DocumentExtraScreenController@update');
    Route::delete('/{recordid}', 'TableControllers\DocumentExtraScreenController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reportcol')->group(function () {
    Route::get('/', 'TableControllers\ReportColController@index');
    Route::get('/parameters', 'TableControllers\ReportColController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ReportColController@store');
    Route::get('/{recordid}', 'TableControllers\ReportColController@show');
    Route::put('/{recordid}', 'TableControllers\ReportColController@update');
    Route::delete('/{recordid}', 'TableControllers\ReportColController@delete');
  });
        
    Route::middleware('authenticate')->prefix('partype')->group(function () {
    Route::get('/', 'TableControllers\ParTypeController@index');
    Route::get('/parameters', 'TableControllers\ParTypeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParTypeController@store');
    Route::get('/{recordid}', 'TableControllers\ParTypeController@show');
    Route::put('/{recordid}', 'TableControllers\ParTypeController@update');
    Route::delete('/{recordid}', 'TableControllers\ParTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ag_mattermessage')->group(function () {
    Route::get('/', 'TableControllers\AG_MatterMessageController@index');
    Route::get('/parameters', 'TableControllers\AG_MatterMessageController@parameters');
    Route::post('/{recordid?}', 'TableControllers\AG_MatterMessageController@store');
    Route::get('/{recordid}', 'TableControllers\AG_MatterMessageController@show');
    Route::put('/{recordid}', 'TableControllers\AG_MatterMessageController@update');
    Route::delete('/{recordid}', 'TableControllers\AG_MatterMessageController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ptypedef')->group(function () {
    Route::get('/', 'TableControllers\PTypeDefController@index');
    Route::get('/parameters', 'TableControllers\PTypeDefController@parameters');
    Route::post('/{partytypeid?}/{languageid?}/{entityid?}', 'TableControllers\PTypeDefController@store');
    Route::get('/{partytypeid}/{languageid}/{entityid}', 'TableControllers\PTypeDefController@show');
    Route::put('/{partytypeid}/{languageid}/{entityid}', 'TableControllers\PTypeDefController@update');
    Route::delete('/{partytypeid}/{languageid}/{entityid}', 'TableControllers\PTypeDefController@delete');
  });
        
    Route::middleware('authenticate')->prefix('empdefaultfilter')->group(function () {
    Route::get('/', 'TableControllers\EmpDefaultFilterController@index');
    Route::get('/parameters', 'TableControllers\EmpDefaultFilterController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EmpDefaultFilterController@store');
    Route::get('/{recordid}', 'TableControllers\EmpDefaultFilterController@show');
    Route::put('/{recordid}', 'TableControllers\EmpDefaultFilterController@update');
    Route::delete('/{recordid}', 'TableControllers\EmpDefaultFilterController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lawdeed_deedsoffice')->group(function () {
    Route::get('/', 'TableControllers\LAWDeed_DeedsOfficeController@index');
    Route::get('/parameters', 'TableControllers\LAWDeed_DeedsOfficeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAWDeed_DeedsOfficeController@store');
    Route::get('/{recordid}', 'TableControllers\LAWDeed_DeedsOfficeController@show');
    Route::put('/{recordid}', 'TableControllers\LAWDeed_DeedsOfficeController@update');
    Route::delete('/{recordid}', 'TableControllers\LAWDeed_DeedsOfficeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('webpage')->group(function () {
    Route::get('/', 'TableControllers\WebPageController@index');
    Route::get('/parameters', 'TableControllers\WebPageController@parameters');
    Route::post('/{recordid?}', 'TableControllers\WebPageController@store');
    Route::get('/{recordid}', 'TableControllers\WebPageController@show');
    Route::put('/{recordid}', 'TableControllers\WebPageController@update');
    Route::delete('/{recordid}', 'TableControllers\WebPageController@delete');
  });
        
    Route::middleware('authenticate')->prefix('rafclaim')->group(function () {
    Route::get('/', 'TableControllers\RafClaimController@index');
    Route::get('/parameters', 'TableControllers\RafClaimController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RafClaimController@store');
    Route::get('/{recordid}', 'TableControllers\RafClaimController@show');
    Route::put('/{recordid}', 'TableControllers\RafClaimController@update');
    Route::delete('/{recordid}', 'TableControllers\RafClaimController@delete');
  });
        
    Route::middleware('authenticate')->prefix('criticalerrors')->group(function () {
    Route::get('/', 'TableControllers\CriticalErrorsController@index');
    Route::get('/parameters', 'TableControllers\CriticalErrorsController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CriticalErrorsController@store');
    Route::get('/{recordid}', 'TableControllers\CriticalErrorsController@show');
    Route::put('/{recordid}', 'TableControllers\CriticalErrorsController@update');
    Route::delete('/{recordid}', 'TableControllers\CriticalErrorsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('temp_employee')->group(function () {
    Route::get('/', 'TableControllers\Temp_EmployeeController@index');
    Route::get('/parameters', 'TableControllers\Temp_EmployeeController@parameters');
    Route::post('/{recordid?}', 'TableControllers\Temp_EmployeeController@store');
    Route::get('/{recordid}', 'TableControllers\Temp_EmployeeController@show');
    Route::put('/{recordid}', 'TableControllers\Temp_EmployeeController@update');
    Route::delete('/{recordid}', 'TableControllers\Temp_EmployeeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docfoxrequest')->group(function () {
    Route::get('/', 'TableControllers\DocFoxRequestController@index');
    Route::get('/parameters', 'TableControllers\DocFoxRequestController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocFoxRequestController@store');
    Route::get('/{recordid}', 'TableControllers\DocFoxRequestController@show');
    Route::put('/{recordid}', 'TableControllers\DocFoxRequestController@update');
    Route::delete('/{recordid}', 'TableControllers\DocFoxRequestController@delete');
  });
        
    Route::middleware('authenticate')->prefix('cretran')->group(function () {
    Route::get('/', 'TableControllers\CreTranController@index');
    Route::get('/parameters', 'TableControllers\CreTranController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CreTranController@store');
    Route::get('/{recordid}', 'TableControllers\CreTranController@show');
    Route::put('/{recordid}', 'TableControllers\CreTranController@update');
    Route::delete('/{recordid}', 'TableControllers\CreTranController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parfield')->group(function () {
    Route::get('/', 'TableControllers\ParFieldController@index');
    Route::get('/parameters', 'TableControllers\ParFieldController@parameters');
    Route::post('/{partyid?}/{docscreenid?}', 'TableControllers\ParFieldController@store');
    Route::get('/{partyid}/{docscreenid}', 'TableControllers\ParFieldController@show');
    Route::put('/{partyid}/{docscreenid}', 'TableControllers\ParFieldController@update');
    Route::delete('/{partyid}/{docscreenid}', 'TableControllers\ParFieldController@delete');
  });
        
    Route::middleware('authenticate')->prefix('moduleinfo')->group(function () {
    Route::get('/', 'TableControllers\ModuleInfoController@index');
    Route::get('/parameters', 'TableControllers\ModuleInfoController@parameters');
    Route::post('/{id?}', 'TableControllers\ModuleInfoController@store');
    Route::get('/{id}', 'TableControllers\ModuleInfoController@show');
    Route::put('/{id}', 'TableControllers\ModuleInfoController@update');
    Route::delete('/{id}', 'TableControllers\ModuleInfoController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bonddata')->group(function () {
    Route::get('/', 'TableControllers\BondDataController@index');
    Route::get('/parameters', 'TableControllers\BondDataController@parameters');
    Route::post('/{matterid?}', 'TableControllers\BondDataController@store');
    Route::get('/{matterid}', 'TableControllers\BondDataController@show');
    Route::put('/{matterid}', 'TableControllers\BondDataController@update');
    Route::delete('/{matterid}', 'TableControllers\BondDataController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docscrnevent')->group(function () {
    Route::get('/', 'TableControllers\DocScrnEventController@index');
    Route::get('/parameters', 'TableControllers\DocScrnEventController@parameters');
    Route::post('/{eventid?}/{docscrnid?}', 'TableControllers\DocScrnEventController@store');
    Route::get('/{eventid}/{docscrnid}', 'TableControllers\DocScrnEventController@show');
    Route::put('/{eventid}/{docscrnid}', 'TableControllers\DocScrnEventController@update');
    Route::delete('/{eventid}/{docscrnid}', 'TableControllers\DocScrnEventController@delete');
  });
        
    Route::middleware('authenticate')->prefix('docfoxresponse')->group(function () {
    Route::get('/', 'TableControllers\DocFoxResponseController@index');
    Route::get('/parameters', 'TableControllers\DocFoxResponseController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocFoxResponseController@store');
    Route::get('/{recordid}', 'TableControllers\DocFoxResponseController@show');
    Route::put('/{recordid}', 'TableControllers\DocFoxResponseController@update');
    Route::delete('/{recordid}', 'TableControllers\DocFoxResponseController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matinv')->group(function () {
    Route::get('/', 'TableControllers\MatInvController@index');
    Route::get('/parameters', 'TableControllers\MatInvController@parameters');
    Route::post('/{matterid?}/{bankid?}', 'TableControllers\MatInvController@store');
    Route::get('/{matterid}/{bankid}', 'TableControllers\MatInvController@show');
    Route::put('/{matterid}/{bankid}', 'TableControllers\MatInvController@update');
    Route::delete('/{matterid}/{bankid}', 'TableControllers\MatInvController@delete');
  });
        
    Route::middleware('authenticate')->prefix('xpobjecttype')->group(function () {
    Route::get('/', 'TableControllers\XPObjectTypeController@index');
    Route::get('/parameters', 'TableControllers\XPObjectTypeController@parameters');
    Route::post('/{oid?}', 'TableControllers\XPObjectTypeController@store');
    Route::get('/{oid}', 'TableControllers\XPObjectTypeController@show');
    Route::put('/{oid}', 'TableControllers\XPObjectTypeController@update');
    Route::delete('/{oid}', 'TableControllers\XPObjectTypeController@delete');
  });
        
    Route::middleware('authenticate')->prefix('law_auto')->group(function () {
    Route::get('/', 'TableControllers\LAW_AutoController@index');
    Route::get('/parameters', 'TableControllers\LAW_AutoController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAW_AutoController@store');
    Route::get('/{recordid}', 'TableControllers\LAW_AutoController@show');
    Route::put('/{recordid}', 'TableControllers\LAW_AutoController@update');
    Route::delete('/{recordid}', 'TableControllers\LAW_AutoController@delete');
  });
        
    Route::middleware('authenticate')->prefix('replink')->group(function () {
    Route::get('/', 'TableControllers\RepLinkController@index');
    Route::get('/parameters', 'TableControllers\RepLinkController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RepLinkController@store');
    Route::get('/{recordid}', 'TableControllers\RepLinkController@show');
    Route::put('/{recordid}', 'TableControllers\RepLinkController@update');
    Route::delete('/{recordid}', 'TableControllers\RepLinkController@delete');
  });
        
    Route::middleware('authenticate')->prefix('law_suite')->group(function () {
    Route::get('/', 'TableControllers\LAW_SuiteController@index');
    Route::get('/parameters', 'TableControllers\LAW_SuiteController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAW_SuiteController@store');
    Route::get('/{recordid}', 'TableControllers\LAW_SuiteController@show');
    Route::put('/{recordid}', 'TableControllers\LAW_SuiteController@update');
    Route::delete('/{recordid}', 'TableControllers\LAW_SuiteController@delete');
  });
        
    Route::middleware('authenticate')->prefix('feelink')->group(function () {
    Route::get('/', 'TableControllers\FeeLinkController@index');
    Route::get('/parameters', 'TableControllers\FeeLinkController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FeeLinkController@store');
    Route::get('/{recordid}', 'TableControllers\FeeLinkController@show');
    Route::put('/{recordid}', 'TableControllers\FeeLinkController@update');
    Route::delete('/{recordid}', 'TableControllers\FeeLinkController@delete');
  });
        
    Route::middleware('authenticate')->prefix('event')->group(function () {
    Route::get('/', 'TableControllers\EventController@index');
    Route::get('/parameters', 'TableControllers\EventController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EventController@store');
    Route::get('/{recordid}', 'TableControllers\EventController@show');
    Route::put('/{recordid}', 'TableControllers\EventController@update');
    Route::delete('/{recordid}', 'TableControllers\EventController@delete');
  });
        
    Route::middleware('authenticate')->prefix('regextsect')->group(function () {
    Route::get('/', 'TableControllers\RegExtSectController@index');
    Route::get('/parameters', 'TableControllers\RegExtSectController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RegExtSectController@store');
    Route::get('/{recordid}', 'TableControllers\RegExtSectController@show');
    Route::put('/{recordid}', 'TableControllers\RegExtSectController@update');
    Route::delete('/{recordid}', 'TableControllers\RegExtSectController@delete');
  });
        
    Route::middleware('authenticate')->prefix('simpleuser')->group(function () {
    Route::get('/', 'TableControllers\SimpleUserController@index');
    Route::get('/parameters', 'TableControllers\SimpleUserController@parameters');
    Route::post('/{oid?}', 'TableControllers\SimpleUserController@store');
    Route::get('/{oid}', 'TableControllers\SimpleUserController@show');
    Route::put('/{oid}', 'TableControllers\SimpleUserController@update');
    Route::delete('/{oid}', 'TableControllers\SimpleUserController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bustran')->group(function () {
    Route::get('/', 'TableControllers\BusTranController@index');
    Route::get('/parameters', 'TableControllers\BusTranController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BusTranController@store');
    Route::get('/{recordid}', 'TableControllers\BusTranController@show');
    Route::put('/{recordid}', 'TableControllers\BusTranController@update');
    Route::delete('/{recordid}', 'TableControllers\BusTranController@delete');
  });
        
    Route::middleware('authenticate')->prefix('law_locauth')->group(function () {
    Route::get('/', 'TableControllers\LAW_LocAuthController@index');
    Route::get('/parameters', 'TableControllers\LAW_LocAuthController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAW_LocAuthController@store');
    Route::get('/{recordid}', 'TableControllers\LAW_LocAuthController@show');
    Route::put('/{recordid}', 'TableControllers\LAW_LocAuthController@update');
    Route::delete('/{recordid}', 'TableControllers\LAW_LocAuthController@delete');
  });
        
    Route::middleware('authenticate')->prefix('bustranrecon')->group(function () {
    Route::get('/', 'TableControllers\BusTranReconController@index');
    Route::get('/parameters', 'TableControllers\BusTranReconController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BusTranReconController@store');
    Route::get('/{recordid}', 'TableControllers\BusTranReconController@show');
    Route::put('/{recordid}', 'TableControllers\BusTranReconController@update');
    Route::delete('/{recordid}', 'TableControllers\BusTranReconController@delete');
  });
        
    Route::middleware('authenticate')->prefix('ag_message')->group(function () {
    Route::get('/', 'TableControllers\AG_MessageController@index');
    Route::get('/parameters', 'TableControllers\AG_MessageController@parameters');
    Route::post('/{recordid?}', 'TableControllers\AG_MessageController@store');
    Route::get('/{recordid}', 'TableControllers\AG_MessageController@show');
    Route::put('/{recordid}', 'TableControllers\AG_MessageController@update');
    Route::delete('/{recordid}', 'TableControllers\AG_MessageController@delete');
  });
        
    Route::middleware('authenticate')->prefix('lswmon')->group(function () {
    Route::get('/', 'TableControllers\LswMonController@index');
    Route::get('/parameters', 'TableControllers\LswMonController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LswMonController@store');
    Route::get('/{recordid}', 'TableControllers\LswMonController@show');
    Route::put('/{recordid}', 'TableControllers\LswMonController@update');
    Route::delete('/{recordid}', 'TableControllers\LswMonController@delete');
  });
        
    Route::middleware('authenticate')->prefix('eventlog')->group(function () {
    Route::get('/', 'TableControllers\EventLogController@index');
    Route::get('/parameters', 'TableControllers\EventLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\EventLogController@store');
    Route::get('/{recordid}', 'TableControllers\EventLogController@show');
    Route::put('/{recordid}', 'TableControllers\EventLogController@update');
    Route::delete('/{recordid}', 'TableControllers\EventLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parregion')->group(function () {
    Route::get('/', 'TableControllers\ParRegionController@index');
    Route::get('/parameters', 'TableControllers\ParRegionController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParRegionController@store');
    Route::get('/{recordid}', 'TableControllers\ParRegionController@show');
    Route::put('/{recordid}', 'TableControllers\ParRegionController@update');
    Route::delete('/{recordid}', 'TableControllers\ParRegionController@delete');
  });
        
    Route::middleware('authenticate')->prefix('matpartyheldback')->group(function () {
    Route::get('/', 'TableControllers\MatPartyHeldBackController@index');
    Route::get('/parameters', 'TableControllers\MatPartyHeldBackController@parameters');
    Route::post('/{matpartyid?}/{batchid?}', 'TableControllers\MatPartyHeldBackController@store');
    Route::get('/{matpartyid}/{batchid}', 'TableControllers\MatPartyHeldBackController@show');
    Route::put('/{matpartyid}/{batchid}', 'TableControllers\MatPartyHeldBackController@update');
    Route::delete('/{matpartyid}/{batchid}', 'TableControllers\MatPartyHeldBackController@delete');
  });
        
    Route::middleware('authenticate')->prefix('repcol')->group(function () {
    Route::get('/', 'TableControllers\RepColController@index');
    Route::get('/parameters', 'TableControllers\RepColController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RepColController@store');
    Route::get('/{recordid}', 'TableControllers\RepColController@show');
    Route::put('/{recordid}', 'TableControllers\RepColController@update');
    Route::delete('/{recordid}', 'TableControllers\RepColController@delete');
  });
        
    Route::middleware('authenticate')->prefix('law_messg')->group(function () {
    Route::get('/', 'TableControllers\LAW_MessgController@index');
    Route::get('/parameters', 'TableControllers\LAW_MessgController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAW_MessgController@store');
    Route::get('/{recordid}', 'TableControllers\LAW_MessgController@show');
    Route::put('/{recordid}', 'TableControllers\LAW_MessgController@update');
    Route::delete('/{recordid}', 'TableControllers\LAW_MessgController@delete');
  });
        
    Route::middleware('authenticate')->prefix('filenotearchive')->group(function () {
    Route::get('/', 'TableControllers\FileNoteArchiveController@index');
    Route::get('/parameters', 'TableControllers\FileNoteArchiveController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FileNoteArchiveController@store');
    Route::get('/{recordid}', 'TableControllers\FileNoteArchiveController@show');
    Route::put('/{recordid}', 'TableControllers\FileNoteArchiveController@update');
    Route::delete('/{recordid}', 'TableControllers\FileNoteArchiveController@delete');
  });
        
    Route::middleware('authenticate')->prefix('regextarea')->group(function () {
    Route::get('/', 'TableControllers\RegExtAreaController@index');
    Route::get('/parameters', 'TableControllers\RegExtAreaController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RegExtAreaController@store');
    Route::get('/{recordid}', 'TableControllers\RegExtAreaController@show');
    Route::put('/{recordid}', 'TableControllers\RegExtAreaController@update');
    Route::delete('/{recordid}', 'TableControllers\RegExtAreaController@delete');
  });
        
    Route::middleware('authenticate')->prefix('favouritereport')->group(function () {
    Route::get('/', 'TableControllers\FavouriteReportController@index');
    Route::get('/parameters', 'TableControllers\FavouriteReportController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FavouriteReportController@store');
    Route::get('/{recordid}', 'TableControllers\FavouriteReportController@show');
    Route::put('/{recordid}', 'TableControllers\FavouriteReportController@update');
    Route::delete('/{recordid}', 'TableControllers\FavouriteReportController@delete');
  });
        
    Route::middleware('authenticate')->prefix('doctodoitemcondition')->group(function () {
    Route::get('/', 'TableControllers\DocToDoItemConditionController@index');
    Route::get('/parameters', 'TableControllers\DocToDoItemConditionController@parameters');
    Route::post('/{recordid?}', 'TableControllers\DocToDoItemConditionController@store');
    Route::get('/{recordid}', 'TableControllers\DocToDoItemConditionController@show');
    Route::put('/{recordid}', 'TableControllers\DocToDoItemConditionController@update');
    Route::delete('/{recordid}', 'TableControllers\DocToDoItemConditionController@delete');
  });
        
    Route::middleware('authenticate')->prefix('costcentre')->group(function () {
    Route::get('/', 'TableControllers\CostCentreController@index');
    Route::get('/parameters', 'TableControllers\CostCentreController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CostCentreController@store');
    Route::get('/{recordid}', 'TableControllers\CostCentreController@show');
    Route::put('/{recordid}', 'TableControllers\CostCentreController@update');
    Route::delete('/{recordid}', 'TableControllers\CostCentreController@delete');
  });
        
    Route::middleware('authenticate')->prefix('emptaggeddocuments')->group(function () {
    Route::get('/', 'TableControllers\EmpTaggedDocumentsController@index');
    Route::get('/parameters', 'TableControllers\EmpTaggedDocumentsController@parameters');
    Route::post('/{employeeid?}/{documentid?}', 'TableControllers\EmpTaggedDocumentsController@store');
    Route::get('/{employeeid}/{documentid}', 'TableControllers\EmpTaggedDocumentsController@show');
    Route::put('/{employeeid}/{documentid}', 'TableControllers\EmpTaggedDocumentsController@update');
    Route::delete('/{employeeid}/{documentid}', 'TableControllers\EmpTaggedDocumentsController@delete');
  });
        
    Route::middleware('authenticate')->prefix('reptotal')->group(function () {
    Route::get('/', 'TableControllers\RepTotalController@index');
    Route::get('/parameters', 'TableControllers\RepTotalController@parameters');
    Route::post('/{recordid?}', 'TableControllers\RepTotalController@store');
    Route::get('/{recordid}', 'TableControllers\RepTotalController@show');
    Route::put('/{recordid}', 'TableControllers\RepTotalController@update');
    Route::delete('/{recordid}', 'TableControllers\RepTotalController@delete');
  });
        
    Route::middleware('authenticate')->prefix('birthdaymessagelog')->group(function () {
    Route::get('/', 'TableControllers\BirthdayMessageLogController@index');
    Route::get('/parameters', 'TableControllers\BirthdayMessageLogController@parameters');
    Route::post('/{recordid?}', 'TableControllers\BirthdayMessageLogController@store');
    Route::get('/{recordid}', 'TableControllers\BirthdayMessageLogController@show');
    Route::put('/{recordid}', 'TableControllers\BirthdayMessageLogController@update');
    Route::delete('/{recordid}', 'TableControllers\BirthdayMessageLogController@delete');
  });
        
    Route::middleware('authenticate')->prefix('unittext')->group(function () {
    Route::get('/', 'TableControllers\UnitTextController@index');
    Route::get('/parameters', 'TableControllers\UnitTextController@parameters');
    Route::post('/{recordid?}', 'TableControllers\UnitTextController@store');
    Route::get('/{recordid}', 'TableControllers\UnitTextController@show');
    Route::put('/{recordid}', 'TableControllers\UnitTextController@update');
    Route::delete('/{recordid}', 'TableControllers\UnitTextController@delete');
  });
        
    Route::middleware('authenticate')->prefix('parcategory')->group(function () {
    Route::get('/', 'TableControllers\ParCategoryController@index');
    Route::get('/parameters', 'TableControllers\ParCategoryController@parameters');
    Route::post('/{recordid?}', 'TableControllers\ParCategoryController@store');
    Route::get('/{recordid}', 'TableControllers\ParCategoryController@show');
    Route::put('/{recordid}', 'TableControllers\ParCategoryController@update');
    Route::delete('/{recordid}', 'TableControllers\ParCategoryController@delete');
  });
        
    Route::middleware('authenticate')->prefix('task')->group(function () {
    Route::get('/', 'TableControllers\TaskController@index');
    Route::get('/parameters', 'TableControllers\TaskController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TaskController@store');
    Route::get('/{recordid}', 'TableControllers\TaskController@show');
    Route::put('/{recordid}', 'TableControllers\TaskController@update');
    Route::delete('/{recordid}', 'TableControllers\TaskController@delete');
  });
        
    Route::middleware('authenticate')->prefix('invoice')->group(function () {
    Route::get('/', 'TableControllers\InvoiceController@index');
    Route::get('/parameters', 'TableControllers\InvoiceController@parameters');
    Route::post('/{recordid?}', 'TableControllers\InvoiceController@store');
    Route::get('/{recordid}', 'TableControllers\InvoiceController@show');
    Route::put('/{recordid}', 'TableControllers\InvoiceController@update');
    Route::delete('/{recordid}', 'TableControllers\InvoiceController@delete');
  });
        
    Route::middleware('authenticate')->prefix('invoicesetup')->group(function () {
    Route::get('/', 'TableControllers\InvoiceSetupController@index');
    Route::get('/parameters', 'TableControllers\InvoiceSetupController@parameters');
    Route::post('/{recordid?}', 'TableControllers\InvoiceSetupController@store');
    Route::get('/{recordid}', 'TableControllers\InvoiceSetupController@show');
    Route::put('/{recordid}', 'TableControllers\InvoiceSetupController@update');
    Route::delete('/{recordid}', 'TableControllers\InvoiceSetupController@delete');
  });
        
    Route::middleware('authenticate')->prefix('fieldvar')->group(function () {
    Route::get('/', 'TableControllers\FieldVarController@index');
    Route::get('/parameters', 'TableControllers\FieldVarController@parameters');
    Route::post('/{recordid?}', 'TableControllers\FieldVarController@store');
    Route::get('/{recordid}', 'TableControllers\FieldVarController@show');
    Route::put('/{recordid}', 'TableControllers\FieldVarController@update');
    Route::delete('/{recordid}', 'TableControllers\FieldVarController@delete');
  });
        
    Route::middleware('authenticate')->prefix('law_autoheader')->group(function () {
    Route::get('/', 'TableControllers\LAW_AutoHeaderController@index');
    Route::get('/parameters', 'TableControllers\LAW_AutoHeaderController@parameters');
    Route::post('/{recordid?}', 'TableControllers\LAW_AutoHeaderController@store');
    Route::get('/{recordid}', 'TableControllers\LAW_AutoHeaderController@show');
    Route::put('/{recordid}', 'TableControllers\LAW_AutoHeaderController@update');
    Route::delete('/{recordid}', 'TableControllers\LAW_AutoHeaderController@delete');
  });
        
    Route::middleware('authenticate')->prefix('tokendata')->group(function () {
    Route::get('/', 'TableControllers\TokenDataController@index');
    Route::get('/parameters', 'TableControllers\TokenDataController@parameters');
    Route::post('/{recordid?}', 'TableControllers\TokenDataController@store');
    Route::get('/{recordid}', 'TableControllers\TokenDataController@show');
    Route::put('/{recordid}', 'TableControllers\TokenDataController@update');
    Route::delete('/{recordid}', 'TableControllers\TokenDataController@delete');
  });
        
    Route::middleware('authenticate')->prefix('country')->group(function () {
    Route::get('/', 'TableControllers\CountryController@index');
    Route::get('/parameters', 'TableControllers\CountryController@parameters');
    Route::post('/{recordid?}', 'TableControllers\CountryController@store');
    Route::get('/{recordid}', 'TableControllers\CountryController@show');
    Route::put('/{recordid}', 'TableControllers\CountryController@update');
    Route::delete('/{recordid}', 'TableControllers\CountryController@delete');
  });
        
