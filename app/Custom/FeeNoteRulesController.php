<?php

namespace App\Custom;

use App\GenericTableModels\feenote;
use App\GenericTableModels\coldebit;
use App\GenericTableModels\matter;
//use Illuminate\Support\Facades\DB;

class FeeNoteRulesController {

    public function storeRecord($request) {

        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            // Stored Procedure changes this to the RecordId if it is set to 0
            $record->sorter = 0;

            //$this->setSorter($record);
            
            $returnData = feenote::create( (array) $record);

            // Doing this after insert because the VatAmount and AmountIncl are created by a SQL stored procedure

            $this->addColDebit($returnData);

            $record->recordid = $returnData->recordid;

            return $returnData;

        } catch(\Exception $e)  {

            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }

    public function updateRecord($request) {

        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $this->addColDebit($record);

            $returnData = feenote::findOrFail($record->recordid);

            unset($record->recordid); 

            $returnData->update( (array) $record);

            return $returnData;

        } catch(\Exception $e)  {

            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }

    private function validateData($record) {

        if ( !isset($record->date) ) {
            throw new \Exception("Please specify the Date the Fee Note was created.");
        }

        if ( !isset($record->source) ) {
            throw new \Exception("Please specify the Source of the Fee Note.");
        }

        if ( !isset($record->employeeid) ) {
            throw new \Exception("Please specify the Employee this Fee Note is allocated to.");
        } 

        if ( !isset($record->matterid) ) {
            throw new \Exception("Please specify the Matter this Fee Note belongs to.");
        } 

        $matter = matter::select(['archiveflag'])->where('RecordID',$record->matterid)->first();
        if ( !$matter ) throw new \Exception("An error was encountered getting the Matter.");

        if ( $matter->archiveflag == '1' ) {
            throw new \Exception('This Matter is Archived. You cannot modify an Archived Matter');
        }


        if ( !isset($record->type1) ) {
            throw new \Exception("Please specify the Type of Fee Note.");
        } 

        if ( !isset($record->code2) ) {
            throw new \Exception("Please specify the Account this Fee Note belongs to.");
        } 

        if ( !isset($record->costcentreid) ) {
            throw new \Exception("Please specify the Cost Centre this Fee Note is allocated to.");
        } 

        if ( !isset($record->description) || empty($record->description) ) {
            throw new \Exception("Please give the Fee Note a description.");
        }

        if ( !isset($record->vatrate) ) {
            throw new \Exception("Please specify the Vat Rate of the Fee Note.");
        }

        if ( !isset($record->vatie) ) {
            throw new \Exception("Please specify whether the Vat is Inclusive or Exclusive.");
        }

        if ( !isset($record->amount) ) {
            throw new \Exception("Please specify the amount of the Fee Note.");
        }

    }

    private function addColDebit(&$record) {

        try {

            if ( isset($record->addtocolldebitflag) && $record->addtocolldebitflag == '1' && !isset($record->coldebitid) ) {

                $colDebit = new \stdClass();
                $colDebit->date = $record->date;
                $colDebit->description = $record->description;
                $colDebit->matterid = $record->matterid;
                $colDebit->employeeid = $record->employeeid;
                $colDebit->amount = $record->amount;
                $colDebit->type = 'D';
                $colDebit->category = 'C';
                $colDebit->origin = '6';
                
                $colDebit->amount = $record->amountincl - $record->vatamount;

                if ($record->vatrate == '1' || $record->vatrate == '2'  || $record->vatrate == '3') {
                    $colDebit->vatflag = 1;
                    $colDebit->vatamount = $record->vatamount;

                    /********************************************************
                     * 11 Jan 2022
                     * These vat mathods in Utils are a Work in Progress
                     * Find them very confusing
                     * Develop them further if needed
                    ********************************************************/

                    //$utils = new \App\Custom\Utils;
                    //$record->vatamount = $utils->getVatAmount($record->amount, null, $record->vatrate, $record->vatie);


                } else {

                    $colDebit->vatflag = 0;
                    $colDebit->vatamount = 0;

                }

                if ( isset($record->documentcode) ) {
                    $colDebit->documentflag = 1;
                    $colDebit->documentcode = $record->documentcode;
                } else {
                    $colDebit->documentflag = 0;
                }

                $colDebit->timerstamp = mt_rand(1000,10000);

                $response = coldebit::create( (array) $colDebit);

                //logger('$response',[$response]);

                $record->coldebitid = $response->RecordId;
            }

        } catch(\Exception $e)  {
            throw new \Exception('Error Adding ColDebit on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }



    }

    // private function setSorter(&$record) {

    //     $response = DB::connection('sqlsrv')->select(DB::raw('select Isnull(Max(Sorter),0)+1 as sorter from FeeNote where MatterId = ' . $record->matterid . ' and date = ' . \App\Custom\ModelHelper::convertClarionDate($record->date)));

    //     $record->sorter = $response[0]->sorter;

    // }
}
