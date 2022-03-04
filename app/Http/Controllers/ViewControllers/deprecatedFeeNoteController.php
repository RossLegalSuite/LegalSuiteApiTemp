<?php

namespace App\Http\Controllers\ViewControllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class deprecatedFeeNoteController extends Controller
{
    // Added by Rick 5 Aug 2019
    // For the View button in a table Row (to show the Fee Note Transaction)
    public function viewFeeNote(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('FeeNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('FeeNote.RecordID')
        ->addselect('Matter.FileRef')
        ->addselect('Matter.Description AS MatterDescription')
        ->addselect('FeeNote.Description')
        ->addselect('CostCentre.Description AS CostCentre')
        ->addselect('Employee.Name AS Employee')
        ->addselect('FeeNote.VatAmount')
        ->addselect('FeeNote.AmountIncl')
        ->addselect(DB::raw('FeeNote.AmountIncl - FeeNote.VatAmount AS AmountExcl'))
        ->addselect(DB::raw("CASE WHEN FeeNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),103) ELSE '' END AS Date"));

        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'FeeNote.MatterID');
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'FeeNote.EmployeeID');
        $query->leftJoin('CostCentre', 'FeeNote.CostCentreID', '=', 'CostCentre.RecordID');
        $query->where('FeeNote.RecordID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getFeeNotesByEmployee(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('FeeNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('Employee.RecordID')
        ->addselect('Employee.Name AS Employee')
        ->addselect(DB::raw("SUM(ISNULL(FeeNote.AmountIncl,0)) as 'AmountInclTotal'"))
        ->addselect(DB::raw("SUM(ISNULL(FeeNote.VatAmount,0)) as 'VatAmountTotal'"))
        ->addselect(DB::raw("SUM(ISNULL(FeeNote.AmountIncl,0)) - SUM(ISNULL(FeeNote.VatAmount,0)) AS 'AmountExclTotal'"))
        ->addselect(DB::raw("Count(DISTINCT FeeNote.RecordID) as 'FeeNoteCount'"))
        ->addselect(DB::raw("Count(DISTINCT Matter.RecordID) as 'MatterCount'"));

        ReportBuilder::DefaultJoinReportFeeNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFeeNoteBuilder($query, $request);

        $query->groupBy('Employee.RecordID', 'Employee.Name');

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getFeeNotesByMatter(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('FeeNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('Matter.RecordID')
        ->addselect('Matter.FileRef')
        ->addselect(DB::raw("SUM(ISNULL(FeeNote.AmountIncl,0)) as 'AmountInclTotal'"))
        ->addselect(DB::raw("SUM(ISNULL(FeeNote.VatAmount,0)) as 'VatAmountTotal'"))
        ->addselect(DB::raw("SUM(ISNULL(FeeNote.AmountIncl,0)) - SUM(ISNULL(FeeNote.VatAmount,0)) AS 'AmountExclTotal'"))
        ->addselect(DB::raw("Count(DISTINCT FeeNote.RecordID) as 'FeeNoteCount'"));

        ReportBuilder::DefaultJoinReportFeeNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFeeNoteBuilder($query, $request);

        $query->groupBy('Matter.RecordID', 'Matter.FileRef');

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getFeeNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('FeeNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('FeeNote.RecordID')
        ->addselect("Matter.FileRef AS 'Matter File Ref'")
        ->addselect("Matter.Description AS 'Matter Description'")
        ->addselect("FeeNote.Description AS 'Description'")
        ->addselect("CostCentre.Description AS 'Cost Centre (Record)'")
        ->addselect("Employee.Name AS 'Employee (Record)'")
        ->addselect("FeeNote.VatAmount AS 'VAT Amount'")
        ->addselect("FeeNote.AmountIncl AS 'Amount (Incl VAT)'")
        ->addselect(DB::raw("FeeNote.AmountIncl - FeeNote.VatAmount AS 'Amount (Ex VAT)'"))
        ->addselect(DB::raw("CASE WHEN FeeNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"));

        ReportBuilder::DefaultJoinReportFeeNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFeeNoteBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewEmployeeFeeNotes(Request $request)
    {
        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();

        $query = DB::connection('sqlsrv')
        ->table('FeeNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),106) END AS Date"))
        ->addselect('FeeNote.RecordID')
        ->addselect('FeeNote.MatterID')
        ->addselect('FeeNote.Description')
        ->addselect(DB::raw('FeeNote.AmountIncl - FeeNote.VatAmount AS AmountExcl'))
        ->addselect('FeeNote.AmountIncl')
        ->addselect('FeeNote.VatAmount')
        ->addselect('FeeNote.CombinedQuantity')
        ->addselect('Employee.Name AS Employee');

        $caseSelect .= 'CASE';
        $caseSelect .= " WHEN FeeNote.VatRate = '1' THEN '".$control->VatPercent1."%'";
        $caseSelect .= " WHEN FeeNote.VatRate = '2' THEN '".$control->VatPercent2."%'";
        $caseSelect .= " WHEN FeeNote.VatRate = '3' THEN '".$control->VatPercent3."%'";
        $caseSelect .= " WHEN FeeNote.VatRate = 'N' THEN 'No Vat'";
        $caseSelect .= " WHEN FeeNote.VatRate = 'E' THEN 'Exempt'";
        $caseSelect .= " WHEN FeeNote.VatRate = 'Z' THEN 'Zero Rated'";
        $caseSelect .= " ELSE 'Unknown' END AS VatRate";

        $query->addselect(DB::raw($caseSelect));

        $query->leftJoin('Employee', 'FeeNote.EmployeeID', '=', 'Employee.RecordID');
        $query->where('FeeNote.EmployeeID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewMatterFeeNotes(Request $request)
    {
        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();

        $query = DB::connection('sqlsrv')
        ->table('FeeNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),106) END AS Date"))
        ->addselect('FeeNote.RecordID')
        ->addselect('FeeNote.MatterID')
        ->addselect('FeeNote.Description')
        ->addselect(DB::raw('FeeNote.AmountIncl - FeeNote.VatAmount AS AmountExcl'))
        ->addselect('FeeNote.AmountIncl')
        ->addselect('FeeNote.VatAmount')
        ->addselect('FeeNote.CombinedQuantity')
        ->addselect('Employee.Name AS Employee');

        $caseSelect .= 'CASE';
        $caseSelect .= " WHEN FeeNote.VatRate = '1' THEN '".$control->VatPercent1."%'";
        $caseSelect .= " WHEN FeeNote.VatRate = '2' THEN '".$control->VatPercent2."%'";
        $caseSelect .= " WHEN FeeNote.VatRate = '3' THEN '".$control->VatPercent3."%'";
        $caseSelect .= " WHEN FeeNote.VatRate = 'N' THEN 'No Vat'";
        $caseSelect .= " WHEN FeeNote.VatRate = 'E' THEN 'Exempt'";
        $caseSelect .= " WHEN FeeNote.VatRate = 'Z' THEN 'Zero Rated'";
        $caseSelect .= " ELSE 'Unknown' END AS VatRate";

        $query->addselect(DB::raw($caseSelect));

        $query->leftJoin('Employee', 'FeeNote.EmployeeID', '=', 'Employee.RecordID');
        $query->where('FeeNote.matterID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
