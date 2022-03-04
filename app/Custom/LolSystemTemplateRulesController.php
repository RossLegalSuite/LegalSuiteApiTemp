<?php

namespace App\Custom;

use App\GenericTableModels\lolsystemtemplate;

class LolSystemTemplateRulesController
{
    public function storeRecord($request)
    {
        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = lolsystemtemplate::create((array) $record);

            $record->recordid = $returnData->recordid;

            return $returnData;
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    public function updateRecord($request)
    {
        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = lolsystemtemplate::findOrFail($record->recordid);

            unset($record->recordid);

            $returnData->update((array) $record);

            return $returnData;
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    private function validateData($record)
    {
        if (! isset($record->title)) {
            throw new \Exception('Please give the Template a Title.');
        }

        if (! isset($record->description) || empty($record->description)) {
            throw new \Exception('Please give the Template a Description.');
        }

        if (! isset($record->source)) {
            throw new \Exception('Please specify the Source of Template');
        }

        if (! isset($record->type)) {
            throw new \Exception('Please specify the Type of Template');
        }

        if (! isset($record->contents)) {
            throw new \Exception('Please specify the Contents of the Template');
        }
    }
}
