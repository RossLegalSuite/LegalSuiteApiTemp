<?php

namespace App\Http\Controllers\CustomControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use DB;
use Illuminate\Http\Request;

class DisbursementController extends Controller
{
    
    public function getDisbursements(Request $request)
    {
        
        $query = DB::connection('sqlsrv')
        ->table('FeeCode');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query->addselect("FeeCode.RecordID AS FeeCodeID")
        ->addselect("FeeCode.Description AS FeeCodeDescription")
        ->addselect("FeeCode.Code")
        ->addselect(DB::raw("CAST(ISNULL(FeeCode.CombineFlag, 0) AS BIT) AS CombineFlag"))
        ->addselect("FeeSheet.RecordId AS FeeSheetID")
        ->addselect("FeeSheet.Description AS FeeSheetDescription")
        ->addselect("FeeSheet.Type AS FeeSheetType");
        
        $query->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'FeeCode.FeeSheetID');
        
        $query->where('FeeCode.RecordID', $request->id);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
        
    }
    
    public function getLinkedDisbursements(Request $request)
    {
        
        $query = DB::connection('sqlsrv')
        ->table('FeeCode');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query->addselect("FeeCode.RecordID AS FeeCodeID")
        ->addselect("FeeCode.Description AS FeeCodeDescription")
        ->addselect("FeeCode.Code")
        ->addselect(DB::raw("CAST(ISNULL(FeeCode.CombineFlag, 0) AS BIT) AS CombineFlag"))
        ->addselect("FeeSheet.RecordId AS FeeSheetID")
        ->addselect("FeeSheet.Description AS FeeSheetDescription")
        ->addselect("FeeSheet.Type AS FeeSheetType");
        
        $query->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'FeeCode.FeeSheetID');
        
        $subQuery = DB::connection('sqlsrv')
        ->table('FeeLink')
        ->select('LinkedCodeId')
        ->where('FeeLink.FeeCodeId', $request->id);
        
        $query->whereRaw('FeeCode.RecordID in (' . DB::raw($subQuery->toSql()) . ')')
        
        ->mergeBindings($subQuery);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
        
    }
    
    public function getFeeItems(Request $request)
    {
        
        $query = DB::connection('sqlsrv')
        ->table('FeeItem');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query->addselect("FeeItem.regionalcourtflag")
        ->addselect("FeeItem.recordid")
        ->addselect("FeeItem.description")
        ->addselect("FeeItem.amount")
        ->addselect("FeeItem.maximumamount")
        ->addselect("FeeItem.vattypeflag")
        ->addselect("FeeItem.vatrate")
        ->addselect(DB::raw("Isnull(FeeItem.defended, '') AS 'Defended'"))
        ->addselect(DB::raw("Cast(FeeItem.option1 AS INT) AS 'Option1' "))
        ->addselect(DB::raw("Cast(Isnull(FeeItem.regionalcourtflag, 0) AS BIT) AS 'RegionalCourtFlag'"))
        ->addselect(DB::raw("Isnull(FeeItem.limitedby, '') AS 'LimitedBy'"))
        ->addselect("FeeItem.fromamount")
        ->addselect("FeeItem.toamount")
        ->addselect("FeeItem.fromdate")
        ->addselect("FeeItem.todate")
        ->addselect(DB::raw("Cast(Isnull(FeeItem.unitsflag, 0) AS BIT) AS 'UnitsFlag'"))
        ->addselect("FeeItem.unitsid")
        ->addselect("FeeItem.factor ")
        ->addselect(DB::raw("Cast(Isnull(FeeItem.activityflag, 0) AS BIT) AS 'ActivityFlag'"))
        ->addselect("FeeItem.activityid")
        ->addselect("FeeCode.recordid AS 'FeeCodeId'")
        ->addselect("FeeCode.description AS 'FeeCodeDescription'")
        ->addselect("FeeCode.businessledgerid AS 'FeeCodeBusinessLedgerId' ")
        ->addselect("FeeSheet.recordid AS 'FeeSheetId'")
        ->addselect("FeeSheet.description AS 'FeeSheetDescription'")
        ->addselect("FeeSheet.type AS 'FeeSheetType'")
        ->addselect("FeeSheet.businessledgerid AS 'FeeSheetBusinessLedgerId");
        
        
        $query->leftJoin('FeeCode', 'FeeCode.RecordID', '=', 'FeeItem.FeeCodeID');
        $query->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'FeeCode.FeeSheetID');
        
        $query->where('FeeCode.RecordID', $request->id);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
