<?php

namespace App\Custom;


use App\Custom\PartyRulesController;
use App\Custom\MatterRulesController;
use App\Custom\ColDebitRulesController;
use App\Custom\DocLogRulesController;
use App\Custom\FeeNoteRulesController;
use App\Custom\LolComponentRulesController;
use App\Custom\LolSystemTemplateRulesController;

class BusinessRulesController
{

    public function StoreFileNote($request) {

        $rulesController = new FileNoteRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateFileNote($request) {

        $rulesController = new FileNoteRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreTodoNote($request) {

        $rulesController = new ToDoNoteRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateToDoNote($request) {

        $rulesController = new ToDoNoteRulesController;
        return $rulesController->updateRecord($request);
    
    }



    public function StoreFeeNote($request) {

        $rulesController = new FeeNoteRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateFeeNote($request) {

        $rulesController = new FeeNoteRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreDocLog($request) {

        $rulesController = new DocLogRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateDocLog($request) {

        $rulesController = new DocLogRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreLolComponent($request) {

        $rulesController = new LolComponentRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateLolComponent($request) {

        $rulesController = new LolComponentRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreLolSystemTemplate($request) {

        $rulesController = new LolSystemTemplateRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateLolSystemTemplate($request) {

        $rulesController = new LolSystemTemplateRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreColDebit($request) {

        $rulesController = new ColDebitRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateColDebit($request) {

        $rulesController = new ColDebitRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreMatter($request) {

        $rulesController = new MatterRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateMatter($request) {

        $rulesController = new MatterRulesController;
        return $rulesController->updateRecord($request);
    
    }

    public function StoreParty($request) {

        $rulesController = new PartyRulesController;
        return $rulesController->storeRecord($request);

    }

    public function UpdateParty($request) {

        $rulesController = new PartyRulesController;
        return $rulesController->updateRecord($request);

    }

    // public static function DefaultFileNoteStoreBusinessRules($createData)
    // {
    //     $recordData = FileNote::create($createData);
    //     return $recordData;
    
    // }

    // public static function DefaultFileNoteUpdateBusinessRules($updateData)
    // {

    //     $recordData = FileNote::findOrFail($updateData['recordid']);
    //     unset($updateData['recordid']);
    //     $recordData->update($updateData);
    //     return $recordData;
    // }

    // public static function DefaultFileNoteDeleteBusinessRules($deleteData)
    // {

    //     $recordData = FileNote::findOrFail($deleteData['recordid'])->delete();
    //     return $returnData['data'] = [];
    // }

    // public static function DefaultFileNoteStoreBusinessRules($createData)
    // {
    //     $query = DB::connection('sqlsrv')
    //     ->table('Employee')
    //     ->select('Employee.Name')
    //     ->where('Employee.RecordID', '=', $createData['employeeid'])
    //     ->get();

    //     // logger('Employee',[$query[0]->Name]);

    //     $createData['description'] = $createData['description'] . ' EmployeeName : ' . $query[0]->Name;
    //     // $recordData = FileNote::create($createData);
    //     // return $recordData;
    //     // $flag ='error';
    //     $recordData['errors'] = "Error not allowed....";
    //     // $recordData = FileNote::create($createData);

    //     // throw errors ( cannot do );
    //     return $recordData;
    // }
    


}
                