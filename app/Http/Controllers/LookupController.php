<?php

namespace App\Http\Controllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use DB;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function lookupClient(Request $request)
    {
        $columns = 'Party.MatterPrefix';
        $columns .= ',Party.Name as Description';
        $columns .= ',Party.RecordID';
        $columns .= ',Party.IdentityNumber';
        $columns .= ',Role.Description as Role';
        $columns .= ',Entity.Description as Entity';
        $columns .= ',ParType.Description as Type';
        $columns .= ",ParLang.PhysicalLine1 + ' ' + ParLang.PhysicalLine2  + ' ' + ParLang.PhysicalLine3 + ' ' + ParLang.PhysicalCode as PhysicalAddress";
        $columns .= ",ParLang.PostalLine1 + ' ' + ParLang.PostalLine2  + ' ' + ParLang.PostalLine3 + ' ' + ParLang.PostalCode as PostalAddress";

        $query = DB::connection('sqlsrv')
        ->table('Party')
        ->selectRaw($columns);

        QueryBuilder::QueryBuilder($query, $request);

        $subQuery = DB::connection('sqlsrv')
        ->table('Matter')
        ->select('ClientId')
        ->distinct();

        $query->whereRaw('Party.RecordID in ('.DB::raw($subQuery->toSql()).')');

        $query
        ->leftJoin('ParLang', function ($join) {
            $join->on('ParLang.PartyID', '=', 'Party.RecordID')
            ->on('ParLang.LanguageID', '=', 'Party.DefaultLanguageID');
        })

        ->leftJoin('Role', 'Party.DefaultRoleID', '=', 'Role.RecordID')
        ->leftJoin('Entity', 'Party.EntityID', '=', 'Entity.RecordID')
        ->leftJoin('ParType', 'Party.PartyTypeID', '=', 'ParType.RecordID')

        ->join('Control', function ($join) {
            $join->where('Control.RecordID', '=', 1);
        })

        ->leftJoin('ParTele as Email', function ($join) {
            $join->on('Email.PartyID', '=', 'Party.RecordID')
            ->on('Email.TelephoneTypeID', '=', 'Control.EMailPhoneID')
            ->where('Email.DefaultEmailFlag', '=', 1);
        })

        ->leftJoin('ParTele as Work', function ($join) {
            $join->on('Work.PartyID', '=', 'Party.RecordID')
            ->on('Work.TelephoneTypeID', '=', 'Control.WorkPhoneID')
            ->where('Work.DefaultEmailFlag', '=', 1);
        })

        ->leftJoin('ParTele as Home', function ($join) {
            $join->on('Home.PartyID', '=', 'Party.RecordID')
            ->on('Home.TelephoneTypeID', '=', 'Control.HomePhoneID')
            ->where('Home.DefaultEmailFlag', '=', 1);
        })

        ->leftJoin('ParTele as Cell', function ($join) {
            $join->on('Cell.PartyID', '=', 'Party.RecordID')
            ->on('Cell.TelephoneTypeID', '=', 'Control.CellPhoneID')
            ->where('Cell.DefaultEmailFlag', '=', 1);
        });

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupEmployee(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Employee')
        ->select('RecordID', 'Name as Description', 'LoginID')
        ->where('SuspendedFlag', '<>', 1);

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupDocgen(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Docgen')
        ->select('RecordID', 'Description', 'Type')
        ->selectRaw("CASE WHEN Type = 'GEN' THEN 'General' WHEN Type = 'BON' THEN 'Bonds' WHEN Type = 'TRN' THEN 'Transfers' WHEN Type = 'CAN' THEN 'Cancellations' WHEN Type = 'LIT' THEN 'Litigation' WHEN Type = 'RAF' THEN 'Road Accident Fund' WHEN Type = 'STR' THEN 'Sectional Title Register' WHEN Type = 'COM' THEN 'Commercial' WHEN Type = 'DEV' THEN 'Conventional Developments' ELSE 'Unknown' END AS DocgenType")
        ->whereRaw("Type NOT IN ('DES','ACC')");

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupMatterType(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Mattype')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupCostCentre(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('CostCentre')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupBranch(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Branch')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupPlanOfAction(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('PlanOfAction')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupRole(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Role')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupEntity(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Entity')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupParType(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('ParType')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupAgency(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Party')
        ->select('Party.RecordID', 'Party.Name as Description')
        ->distinct()
        ->join('MatParty', 'Party.RecordID', '=', 'MatParty.PartyID')
        ->join('Control', 'Control.SellingAgencyRoleID', '=', 'MatParty.RoleID');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupAgent(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Party')
        ->select('Party.RecordID', 'Party.Name as Description')
        ->distinct()
        ->join('MatParty', 'Party.RecordID', '=', 'MatParty.PartyID')
        ->join('Control', 'Control.EstateAgentRoleID', '=', 'MatParty.RoleID');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupMortgageOriginator(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Party')
        ->select('Party.RecordID', 'Party.Name as Description')
        ->distinct()
        ->join('MatParty', 'Party.RecordID', '=', 'MatParty.PartyID')
        ->join('Control', 'Control.MortgageOriginatorRoleID', '=', 'MatParty.RoleID');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function lookupGrouping(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('Branch')
        ->select('RecordID', 'Description');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
