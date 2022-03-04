<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use DB;
use Illuminate\Http\Request;

class deprecatedMatterController extends Controller
{
    public function viewMatter(Request $request)
    {
    
        $query = DB::connection('sqlsrv')
        ->table('Matter');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        ReportBuilder::DefaultColumnReportMatterBuilder($query);
        ReportBuilder::DefaultJoinReportMatterBuilder($query, $request);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);
        
        $query->addselect(DB::raw("CASE WHEN ISNULL(StageGroup.RecordID,0) = 0 THEN 'Not Set' ELSE StageGroup.Description END AS StageGroup"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Docscrn.RecordID,0) = 0 THEN 'Not Set' ELSE Docscrn.Description END AS ExtraScreen"))
        ->addselect(DB::raw("CASE WHEN ISNULL(FeeSheet.RecordID,0) = 0 THEN 'Not Set' ELSE FeeSheet.Description END AS FeeSheet"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Language.RecordID,0) = 0 THEN 'Not Set' ELSE Language.Description END AS Language"))
        ->addselect(DB::raw("CASE WHEN ISNULL(BondCause.RecordID,0) = 0 THEN 'Not Set' ELSE BondCause.Description END AS BondCause"));
        
        
        
        $query->leftJoin('StageGroup', 'Matter.StageGroupID', '=', 'StageGroup.RecordID')
        ->leftJoin('Docscrn', 'Matter.ExtraScreenID', '=', 'Docscrn.RecordID')
        ->leftJoin('Language', 'Matter.DocumentLanguageID', '=', 'Language.RecordID')
        ->leftJoin('ConveyData', 'Matter.RecordID', '=', 'ConveyData.MatterID')
        ->leftJoin('BondCause', 'ConveyData.BondCauseID', '=', 'BondCause.RecordID')
        ->leftJoin('FeeSheet', 'Matter.ClientFeeSheetID', '=', 'FeeSheet.RecordID');
        
        
        
        
        
        $query->where('Matter.RecordID', $request->recordid);
        
        
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
    public function getMatterParties(Request $request)
    {
        
        $query = DB::connection('sqlsrv')
        ->table('MatParty');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query
        ->addselect("MatParty.RecordID")
        ->addselect("MatParty.MatterID")
        ->addselect("MatParty.Reference")
        ->addselect(DB::raw("CASE WHEN MatParty.Sorter <> 1 THEN Role.Description + ' (' + CAST(MatParty.Sorter AS VarChar(10)) + ')' ELSE Role.Description END AS Role"))
        ->addselect("Party.Name AS Name")
        ->addselect("PartyContact.Name AS Contact")
        ->addselect("MatParty.PartyID");
        
        
        
        $query 
        ->leftJoin('Party', 'MatParty.PartyID', '=', 'Party.RecordID')
        ->leftJoin('Role', 'MatParty.RoleID', '=', 'Role.RecordID')
        ->leftJoin('Party AS PartyContact', 'PartyContact.RecordID', '=', 'MatParty.ContactID')
        ->where('MatParty.MatterID', $request->matterId);
        
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
    public function getMatterFileNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('FileNote');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query
        ->addselect(DB::raw("CASE WHEN ISNULL(FileNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),106) END AS Date"))
        ->addselect("FileNote.RecordID")
        ->addselect("FileNote.MatterID")
        ->addselect("FileNote.Description")
        ->addselect("Employee.Name AS Employee")
        ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Code,'') = '' THEN '' ELSE Stage.Code END AS StageCode"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Description,'') = '' THEN '' ELSE Stage.Description END AS StageDescription"));
        
        
        $query 
        ->leftJoin('Stage', 'FileNote.StageID', '=', 'Stage.RecordID')
        ->leftJoin('Employee', 'FileNote.EmployeeID', '=', 'Employee.RecordID')
        ->where('FileNote.MatterID', $request->matterId);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
    public function getMatterFeeNotes(Request $request)
    {
        
        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();
        
        $query = DB::connection('sqlsrv')
        ->table('FeeNote');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query
        ->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),106) END AS Date"))
        ->addselect("FeeNote.RecordID")
        ->addselect("FeeNote.MatterID")
        ->addselect("FeeNote.Description")
        ->addselect(DB::raw("FeeNote.AmountIncl - FeeNote.VatAmount AS AmountExcl"))
        ->addselect("FeeNote.AmountIncl")
        ->addselect("FeeNote.VatAmount")
        ->addselect("FeeNote.CombinedQuantity")
        ->addselect("Employee.Name AS Employee")
        ->addselect(DB::raw("CASE WHEN FeeNote.VatRate = '1' THEN '" . $control->VatPercent1 . "%'
        WHEN FeeNote.VatRate = '2' THEN '" . $control->VatPercent2 . "%'
        WHEN FeeNote.VatRate = '3' THEN '" . $control->VatPercent3 . "%'
        WHEN FeeNote.VatRate = 'N' THEN 'No Vat'
        WHEN FeeNote.VatRate = 'E' THEN 'Exempt'
        WHEN FeeNote.VatRate = 'Z' THEN 'Zero Rated'
        ELSE 'Unknown' END AS VatRate"));
        
        
        $query->leftJoin('Employee', 'FeeNote.EmployeeID', '=', 'Employee.RecordID')
        ->where('FeeNote.MatterID', $request->matterId);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
    public function getMatterToDoNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
        ->table('ToDoNote');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12), CAST(ToDoNote.Date-36163 as DateTime),106) END AS Date"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 THEN '' ELSE CONVERT(VarChar(12), CAST(ToDoNote.DateDone-36163 as DateTime),106) END AS DateDone"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 THEN '' ELSE CONVERT(VarChar(12), DATEDIFF(day, CAST(ToDoNote.Date-36163 as DateTime), CAST(ToDoNote.DateDone-36163 as DateTime) ) ) END AS DaysDiff"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 THEN '' ELSE CONVERT(VarChar(12), DATEDIFF(day, CAST(Matter.DateInstructed-36163 as DateTime), CAST(ToDoNote.DateDone-36163 as DateTime) ) ) END AS DaysTaken"))
        ->addselect("ToDoNote.RecordID")
        ->addselect("ToDoNote.MatterID")
        ->addselect("ToDoNote.Description")
        ->addselect("Employee.Name AS Employee");
        
        
        $query 
        ->leftJoin('Employee', 'ToDoNote.EmployeeID', '=', 'Employee.RecordID')
        ->leftJoin('Matter', 'ToDoNote.MatterID', '=', 'Matter.RecordID')
        ->where('ToDoNote.MatterID', $request->matterId);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
    public function getMatterDocLog(Request $request)
    {
        
        
        $query = DB::connection('sqlsrv')
        ->table('DocLog');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        $query
        ->addselect(DB::raw("CASE WHEN ISNULL(DocLog.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) END AS Date"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFolder ELSE DocLog.SavedName END AS SavedName"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFrom ELSE Employee.Name END AS Sender"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailRecipients ELSE '' END AS SentTo"))
        ->addselect(DB::raw("CASE WHEN DocLog.Direction = 1 THEN 'Outgoing' WHEN DocLog.Direction = 2 THEN 'Incoming' ELSE 'Not Applicable' END AS Direction"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 3 THEN '(PDF) ' + DocLog.Description ELSE DocLog.Description END AS Description"))
        ->addselect("DocLog.RecordID")
        ->addselect("DocLog.MatterID")
        ->addselect("DocLogCategory.Description AS Category");
        
        $query 
        ->leftJoin('Employee', 'DocLog.EmployeeID', '=', 'Employee.RecordID')
        ->leftJoin('DocLogCategory', 'DocLog.DocLogCategoryID', '=', 'DocLogCategory.RecordID')
        ->where('DocLog.MatterID', $request->matterId);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
}
