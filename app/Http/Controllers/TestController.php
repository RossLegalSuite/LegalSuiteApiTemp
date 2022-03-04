<?php

namespace App\Http\Controllers;

use App\Custom\ControllerHelper;
use App\Custom\ParameterBuilder;
use App\Custom\QueryBuilder;
use App\GenericTableModels\Favourites;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function testGet(Request $request)
    {
        // $x = DB::select(DB::raw("select top 1 * from matter"));
        // $x = DB::select('select top 1 * from matter');
        // $results = DB::select('EXEC your_stored_procedure');

        // https://stackoverflow.com/questions/52070741/laravel-model-sql-server-get-output-parameters-from-stored-procedure
        // Running the Microsoft SQL Server Stored Procedure (MS SQL Server) using PHP Laravel framework.

        // If you are trying to run SP using Laravel Model then you can use following two approaches.
        // return DB::select(DB::raw('call store_procedure_function(?)', [$parameter]));

        return DB::connection('sqlsrv')->select(DB::raw('EXEC EmployeeByRecordID @EmployeeID = 1034'));

        // return DB::select(DB::raw('call GetSettings'));
        // $submit = DB::select(" EXEC ReturnIdExample ?,?", array( $paramOne ,$paramTwo ) );

        // $submit = DB::select(" EXEC ReturnIdExample $paramOne,$paramTwo ");
        // If incase you are passing the Varchar Parameter then use the following:

        // $submit = DB::select(" EXEC ReturnIdExample '$paramOne', '$paramTwo' ");
        // If you are just passing parameter which are of INT or BIGINT then this should work and you can get the return from SP:

        // $submit = DB::select(" EXEC ReturnIdExample $paramOne,$paramTwo ");

        return $submit;
    }

    private function keysToLower($arr)
    {

        // Here is the most compact way to lower case keys in a multidimensional array
        //https://www.php.net/manual/en/function.array-change-key-case.php

        return array_map(function ($item) {
            if (is_array($item)) {
                $item = $this->keysToLower($item);
            }

            return $item;
        }, array_change_key_case($arr));
    }

    public function getSupportingTables(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData = new \stdClass();

            $returnData->employees = \App\GenericTableModels\Employee::orderBy('name')
            ->select(['recordid', 'name', 'loginid'])
            ->where('suspendedflag', '<>', 1)
            ->get()->toArray();

            $returnData->partyEntities = $this->keysToLower(\App\GenericTableModels\Entity::orderBy('description')->get()->toArray());
            $returnData->partyTypes = $this->keysToLower(\App\GenericTableModels\ParType::orderBy('description')->get()->toArray());
            $returnData->partyRoles = $this->keysToLower(\App\GenericTableModels\Role::orderBy('description')->get()->toArray());
            $returnData->telephoneTypes = $this->keysToLower(\App\GenericTableModels\TeleType::orderBy('description')->get()->toArray());
            $returnData->deedsOffices = $this->keysToLower(\App\GenericTableModels\LAWDeed_DeedsOffice::orderBy('name')->get()->toArray());
            $returnData->matterExtraScreens = $this->keysToLower(\App\GenericTableModels\DocScrn::orderBy('description')->get()->toArray());
            $returnData->documentSets = $this->keysToLower(\App\GenericTableModels\DocGen::orderBy('description')->get()->toArray());
            $returnData->costCentres = $this->keysToLower(\App\GenericTableModels\CostCentre::orderBy('description')->get()->toArray());
            $returnData->feeSheets = $this->keysToLower(\App\GenericTableModels\FeeSheet::orderBy('description')->get()->toArray());
            $returnData->matterTypes = $this->keysToLower(\App\GenericTableModels\MatType::orderBy('description')->get()->toArray());
            $returnData->branches = $this->keysToLower(\App\GenericTableModels\Branch::orderBy('description')->get()->toArray());
            $returnData->planOfActions = $this->keysToLower(\App\GenericTableModels\ToDoGroup::orderBy('description')->get()->toArray());
            $returnData->causeOfActions = $this->keysToLower(\App\GenericTableModels\BondCause::orderBy('description')->get()->toArray());
            $returnData->billingRates = $this->keysToLower(\App\GenericTableModels\BillingRate::orderBy('description')->get()->toArray());
            $returnData->stageGroups = $this->keysToLower(\App\GenericTableModels\StageGroup::orderBy('description')->get()->toArray());
            $returnData->accounts = $this->keysToLower(\App\GenericTableModels\Business::orderBy('description')->get()->toArray());
            $returnData->languages = $this->keysToLower(\App\GenericTableModels\Language::orderBy('description')->get()->toArray());
            $returnData->countries = $this->keysToLower(\App\GenericTableModels\Country::orderBy('description')->get()->toArray());
            $returnData->holidays = $this->keysToLower(\App\GenericTableModels\Holiday::orderBy('description')->get()->toArray());

            return json_encode($returnData);
        });
    }

    public function testPost(Request $request)
    {
        return 'testPost';
    }
}
