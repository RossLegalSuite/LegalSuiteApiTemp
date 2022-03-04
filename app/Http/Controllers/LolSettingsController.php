<?php

namespace App\Http\Controllers;

use App\GenericTableModels\lolsettings;
use Illuminate\Http\Request;

class LolSettingsController extends Controller
{
    public function get(Request $request)
    {
        try {
            $returnData = new \stdClass();

            $returnData->data = lolsettings::firstOrFail();

            return json_encode($returnData);
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    public function update(Request $request)
    {
        try {
            $requestData = $request->all();

            $recordData = lolsettings::firstOrFail();

            unset($requestData['recordid']);

            $recordData->update($requestData);

            $returnData['data'] = $recordData;

            return json_encode($returnData);
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }
}
