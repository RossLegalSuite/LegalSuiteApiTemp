<?php

namespace App\Custom;

use App\GenericTableModels\doclog;

class DocLogRulesController
{
    public function storeRecord($request)
    {
        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = doclog::create((array) $record);

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

            $returnData = doclog::findOrFail($record->recordid);

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
        if (! isset($record->date)) {
            throw new \Exception('Please specify the Date the item was created.');
        }

        if (! isset($record->time)) {
            throw new \Exception('Please specify the Time the item was created.');
        }

        $matterId = isset($record->matterid) ? (int) $record->matterid : 0;
        $partyId = isset($record->partyid) ? (int) $record->partyid : 0;
        $parentRecord = $matterId + $partyId;

        if ($parentRecord == 0) {
            throw new \Exception('Please specify the Matter or Party this item belongs to.');
        }

        if (! isset($record->doclogcategoryid)) {
            throw new \Exception('Please specify the Category the item belongs to.');
        }

        if (! isset($record->direction)) {
            throw new \Exception('Please specify whether the item is incoming, outgoing or not applicable.');
        }

        if (! isset($record->description) || empty($record->description)) {
            throw new \Exception('Please give the item a description.');
        }
    }
}
