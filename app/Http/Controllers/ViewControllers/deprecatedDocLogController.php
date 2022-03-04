<?php

namespace App\Http\Controllers\ViewControllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class deprecatedDocLogController extends Controller
{
    public function viewDocLog(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('DocLog');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('DocLog.RecordID')
            ->addselect('Matter.FileRef')
            ->addselect('Matter.Description AS MatterDescription')
            ->addselect('DocLog.Description')
            ->addselect('Employee.Name AS Employee')
            ->addselect('DocLogCategory.Description AS Category')
            ->addselect('DocLog.NoOfPages')
            ->addselect('DocLog.NoOfWords')
            ->addselect(DB::raw("CASE WHEN DocLog.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(Doclog.Time * 10) ,0),108) ELSE '' END AS Time"))
            ->addselect(DB::raw('CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFolder ELSE DocLog.SavedName END AS SavedName'))
            ->addselect(DB::raw('CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFrom ELSE Employee.Name END AS Sender'))
            ->addselect(DB::raw("CASE WHEN DocLog.Date > 0 THEN CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),103) ELSE '' END AS Date"))
            ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailRecipients ELSE '' END AS SentTo"))
            ->addselect(DB::raw("CASE WHEN DocLog.Direction = 1 THEN 'Outgoing' WHEN DocLog.Direction = 2 THEN 'Incoming' ELSE 'Not Applicable' END AS Direction"))

            ->leftJoin('DocLogCategory', 'DocLog.DocLogCategoryID', '=', 'DocLogCategory.RecordID')
            ->leftJoin('Matter', 'Matter.RecordID', '=', 'DocLog.MatterID')
            ->leftJoin('Employee', 'Employee.RecordID', '=', 'DocLog.EmployeeID')

            ->where('DocLog.RecordID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getDocLogsByEmployee(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('DocLog');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('Employee.RecordID')
            ->addselect('Employee.Name AS Employee')
            ->addselect(DB::raw("Count(DISTINCT DocLog.RecordID) as 'DocLogCount'"))
            ->addselect(DB::raw("Count(DISTINCT Matter.RecordID) as 'MatterCount'"));

        $query->groupBy('Employee.RecordID', 'Employee.Name');

        // ReportBuilder::DefaultColumnReportMatterBuilder($query, $request);
        ReportBuilder::DefaultJoinReportDocLogBuilder($query, $request);

        ReportBuilder::DefaultWhereReportDocLogBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getDocLogsByMatter(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('DocLog');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('Matter.RecordID')
            ->addselect('Matter.FileRef')
            ->addselect(DB::raw("Count(DISTINCT DocLog.RecordID) as 'DocLogCount'"));
        $query->groupBy('Matter.RecordID', 'Matter.Fileref');
        // ReportBuilder::DefaultColumnReportMatterBuilder($query, $request);
        ReportBuilder::DefaultJoinReportDocLogBuilder($query, $request);
        ReportBuilder::DefaultWhereReportDocLogBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getDocLogs(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('DocLog');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('DocLog.RecordID')
            ->addselect("Matter.FileRef AS 'Matter File Ref'")
            ->addselect("Matter.Description AS 'Matter Description'")
            ->addselect("DocLog.Description AS 'Description'")
            ->addselect("Employee.Name AS 'Employee (Record)'")
            ->addselect(DB::raw("CASE WHEN DocLog.Date > 0 THEN CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"))
            ->addselect(DB::raw('CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFolder ELSE DocLog.SavedName END AS SavedName'))
            ->addselect(DB::raw('CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFrom ELSE Employee.Name END AS Sender'))
            ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailRecipients ELSE '' END AS SentTo"))
            ->addselect(DB::raw("CASE WHEN DocLog.Direction = 1 THEN 'Outgoing' WHEN DocLog.Direction = 2 THEN 'Incoming' ELSE 'Not Applicable' END AS Direction"))
            ->addselect('DocLogCategory.Description AS Category');

        $query->leftJoin('DocLogCategory', 'DocLog.DocLogCategoryID', '=', 'DocLogCategory.RecordID');

        ReportBuilder::DefaultJoinReportDocLogBuilder($query, $request);
        ReportBuilder::DefaultWhereReportDocLogBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewEmployeeDocLogs(Request $request)
    {
        $query->addselect(DB::raw("CASE WHEN ISNULL(DocLog.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) END AS Date"))
            ->addselect('DocLog.RecordID')
            ->addselect('DocLog.MatterID')
            ->addselect('DocLog.Description')
            ->addselect('Employee.Name AS Employee');

        $query = DB::connection('sqlsrv')
            ->table('DocLog');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect(DB::raw("CASE WHEN ISNULL(DocLog.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) END AS Date"))
            ->addselect('DocLog.RecordID')
            ->addselect('DocLog.MatterID')
            ->addselect('DocLog.Description')
            ->addselect('Employee.Name AS Employee');

        $query->leftJoin('Employee', 'DocLog.EmployeeID', '=', 'Employee.RecordID');
        $query->where('DocLog.EmployeeID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewMatterDocLogs(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('DocLog');

        QueryBuilder::QueryBuilder($query, $request);
        $query->addselect(DB::raw("CASE WHEN ISNULL(DocLog.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) END AS Date"))
            ->addselect('DocLog.RecordID')
            ->addselect('DocLog.MatterID')
            ->addselect('DocLog.Description')
            ->addselect('Employee.Name AS Employee');

        $query->leftJoin('Employee', 'DocLog.EmployeeID', '=', 'Employee.RecordID');
        $query->where('DocLog.matterID', $request->recordid);
        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
