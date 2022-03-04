<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use DB;
use Illuminate\Http\Request;

class deprecatedAccountingController extends Controller
{

    public function getTransfersPending(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Matter.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect("Matter.Description")
            ->addselect("Party.Name as ClientName")
            ->addselect("Matter.Transfer");

        $query->where('Matter.Transfer', '<>', '0');

        $query->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function getMattersInDebit(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Matter.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect("Matter.Description")
            ->addselect("Party.Name as ClientName")
            ->addselect("Matter.Actual");

        $query->where('Matter.Actual', '>', '0');

        $query->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function getMattersInCredit(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Matter.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect("Matter.TheirRef")
            ->addselect("Matter.Description")
            ->addselect("Party.Name as ClientName")
            ->addselect("Matter.Actual");

        $query->where('Matter.Actual', '<', '0');

        $query->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

}
