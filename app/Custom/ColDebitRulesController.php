<?php

namespace App\Custom;

use App\Custom\ModelHelper;
use App\Custom\Utils;
use App\GenericTableModels\coldebit;
use App\GenericTableModels\matter;
use App\GenericTableModels\control;



class ColDebitRulesController
{

    public function storeRecord($request) {

        try {

            //Convert the $request array into an object (for better syntax)
            $colDebit = (object) $request;

            $this->validateData($colDebit);

            $colDebit->timerstamp = ModelHelper::convertClarionTime( date("H:i:s") );

            $this->sanitizeData($colDebit, (object) $request);

            $returnData = coldebit::create( (array) $colDebit);

            $colDebit->recordid = $returnData->recordid;

            return $returnData;

        } catch(\Exception $e)  {

            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }

    public function updateRecord($request) {

        try {

            //Convert the $request array into an object (for better syntax)
            $colDebit = (object) $request;

            $this->validateData($colDebit);

            $this->sanitizeData($colDebit, (object) $request);

            // Save the Record
            $returnData = coldebit::findOrFail($colDebit->recordid);

            unset($colDebit->recordid); 

            unset($colDebit->balance);
            unset($colDebit->costbalance);
            unset($colDebit->interestbalance);
            unset($colDebit->capitalbalance);

            $colDebit->totalamount = $colDebit->amount + $colDebit->vatamount;

            //logger('Updating colDebit',(array) $colDebit);

            $returnData->update( (array) $colDebit);

            return $returnData;

        } catch(\Exception $e)  {

            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }

    private function validateData($colDebit) {

        if ( !isset($colDebit->date) ) {
            throw new \Exception("Please specify the Date of the transaction");
        }
        
        if ( !isset($colDebit->description) ) {
            throw new \Exception("Please give the transaction a Description.");
        }

        if ( !isset($colDebit->type) ) {
            throw new \Exception("Please specify the Type of transaction");
        }

        if ( !isset($colDebit->category) ) {
            throw new \Exception("Please specify the Category of the transaction");
        }
        
        if ( !isset($colDebit->amount) ) {
                throw new \Exception("Please specify the Amount of the transaction");
        } else {
            if ( !floatval($colDebit->amount) ) {
                throw new \Exception("Please specify the Amount of the transaction");
            }
        }


    }

    private function sanitizeData(&$colDebit,$request) {

        try {

            $matterId = isset($request->matterid) ? $request->matterid : $request->matterId;

            if (!isset($matterId)) throw new \Exception('No MatterID specified');

            $control = control::select(['VatMethod','VatPercent1','VatPercent2'])->first();

            if ( !$control ) throw new \Exception("An error was encountered getting the Control table.");

            $matter = matter::findOrFail($matterId);     
            
            $colDebit->date = ModelHelper::convertClarionDate($colDebit->date);
            
            if ($colDebit->vatflag) {

                $vatRate = Utils::getCurrentVatRate($colDebit->date, $matter->VatExemptFlag, $control->VatMethod, $control->VatPercent1, $control->VatPercent2);

                $colDebit->vatamount = round($colDebit->amount * $vatRate /100,2);

            } else {

                $colDebit->vatamount = 0;
            }

            $colDebit->totalamount = $colDebit->amount + $colDebit->vatamount;

            $colDebit->documentflag = isset($colDebit->documentcode) ? 1 : 0;

            $colDebit->origin = 106; //Arbitary number to identify the source

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

}
