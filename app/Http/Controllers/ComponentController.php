<?php

namespace App\Http\Controllers;

use App\Custom\ControllerHelper;
use App\LegalSuiteOnline\Models\LolComponent;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;

class ComponentController extends Controller
{
    /*public function get(Request $request) {

        try {

            $returnData = new \stdClass();

            $returnData->data = LolComponent::findOrFail($request->id);

            return json_encode($returnData);

        } catch(\Exception $e)  {
            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }

    public function index(Request $request) {

        try {

            $returnData = new \stdClass();

            $returnData->data = LolComponent::orderBy('title')->get();

            // $query = DB::connection('sqlsrv')->table('LolComponent');

            // if (isset($request->orderby)) {

            //     foreach ( (array) $request->orderby as $parameter) {

            //         $orderByArray = explode(',', $parameter);
            //         if (isset(array_values($orderByArray)[1])){
            //             $query->orderBy(trim(array_values($orderByArray)[0]), trim(array_values($orderByArray)[1]));
            //         } else {
            //             $query->orderBy(trim(array_values($orderByArray)[0]), 'ASC');
            //         }

            //     }

            // }

            // $returnData->data = $query->get();

            return json_encode($returnData);

        } catch(\Exception $e)  {
            $returnData['errors'] = $e->getMessage();
            return $returnData;
        }

    }*/

    public function store(Request $request)
    {
        try {
            $requestData = $request->all();

            $this->validateData($requestData);

            return json_encode(LolComponent::create($requestData));
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    public function update(Request $request)
    {
        try {
            $requestData = $request->all();

            $this->validateData($requestData);

            $recordData = LolComponent::findOrFail($requestData['recordid']);

            unset($requestData['recordid']);

            $recordData->update($requestData);

            return json_encode($recordData);
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    public function delete(Request $request)
    {
        try {
            $requestData = $request->all();

            $recordData = LolComponent::findOrFail($requestData['recordid'])->delete();

            return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    public function getTablePosition(Request $request)
    {
        try {
            $returnData = new \stdClass();

            $returnData->data = LolComponent::whereRaw('title < \''.$request['title'].'\'')->count();

            return json_encode($returnData);

            /* Testing
                use App\LegalSuiteOnline\Models\LolComponent;
                $returnData = new \stdClass();
                $request['title'] = 'Letter Example';
                $returnData->data = LolComponent::whereRaw('title < \'' . $request['title'] . '\'')->count();
            */
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    private function validateData($record)
    {
        if (! isset($record['title'])) {
            throw new \Exception('Please provide a title');
        }

        if (! isset($record['description'])) {
            throw new \Exception('Please provide a description');
        }

        if (! isset($record['source'])) {
            throw new \Exception('The source is required.');
        }
    }
}
