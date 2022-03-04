<?php

namespace App\Custom;

use App\GenericTableModels\lolcomponent;


class LolComponentRulesController {

    public function storeRecord($request) {

        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = lolcomponent::create( (array) $record);

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

            $returnData = lolcomponent::findOrFail($record->recordid);

            unset($record->recordid); 

            $returnData->update( (array) $record);

            return $returnData;

        } catch(\Exception $e)  {

            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }

    private function validateData($record) {

        
        if ( !isset($record->title) ) {
            throw new \Exception("Please give the Component a Title.");
        }
        
        if ( preg_match('/\s/',$record->title)) {
            throw new \Exception("The Title of a Component cannot contain spaces.");
        }

        if ( !isset($record->description) || empty($record->description) ) {
            throw new \Exception("Please give the Component a Description.");
        }

        if ( !isset($record->source) ) {
            throw new \Exception("Please specify the Source of Component");
        }

        if ( !isset($record->contents) ) {
            throw new \Exception("Please specify the Contents of the Component");
        }
        

    }


}
