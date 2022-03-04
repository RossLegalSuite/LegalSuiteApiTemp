<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use DB;
use Illuminate\Http\Request;

class deprecatedEmployeeController extends Controller
{

    public function getEmployeeEmails(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('Employee');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Employee.RecordID")
            ->addselect("Employee.LoginID")
            ->addselect("Employee.Name")
            ->addselect("Employee.Email");

        $query->where('Employee.Email', '<>', '')
            ->where('Employee.Email', '<>', null);

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function getUnreadSmsMessages(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('EmployeeSMS');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Matter.FileRef")
            ->addselect("Employee.Name")
            ->addselect(DB::raw("CONVERT(VarChar(12),CAST(EmployeeSMS.Date-36163 as DateTime),106) AS 'SmsDate'"))
            ->addselect("EmployeeSMS.FromNumber")
            ->addselect("EmployeeSMS.Message");

        $query->where('EmployeeSMS.BoxOption', '0')
            ->where('EmployeeSMS.Status', 'Unread');

        if (isset($request->filter['employee'])) {

            if ($request->filter['employee'] !== 'all') {
                $query->whereIn('EmployeeSMS.EmployeeID', explode(",", $request->filter['employee']));
            }
        }

        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'EmployeeSMS.MatterID');
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'EmployeeSMS.EmployeeID');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function getEmployeeFeeEstimates(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('Employee');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Employee.RecordID")
            ->addselect("Employee.Name AS Employee")
            ->addselect(DB::raw("SUM(ISNULL(Matter.FeeEstimate,0)) as 'FeeTotal'"))
            ->addselect(DB::raw("Count(DISTINCT Matter.RecordID) as 'MatterCount'"));

        $query->where("SuspendedFlag", "<>", 1);

        ReportBuilder::DefaultJoinReportEmployeeBuilder($query, $request);
        ReportBuilder::DefaultWhereReportEmployeeBuilder($query, $request);

        // Filter Employee Where Clauses

        $query->groupBy('Employee.RecordID', 'Employee.Name');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function viewEmployeeFeeEstimates(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Matter.RecordID")
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.DateInstructed,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.DateInstructed-36163 as DateTime),106) END AS Instructed"))
            ->addselect("Matter.FileRef")
            ->addselect("Matter.Description")
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.FeeEstimate,0) = 0 THEN 0 ELSE Matter.FeeEstimate END AS FeeEstimate"));

        $query->where('Matter.EmployeeID', $request->id);

        //MatterHelper::DefaultMatterJoins($query);

        //MatterHelper::DefaultMatterWhereClauses($query, $request);

        //DataTablesHelper::LogSqlQuery($query, $request->method);

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function getEmployeePerformance(Request $request)
    {

        if ($request->filter["periodType"] === "day" || "week" || "month" || "year") {

            //https://www.w3schools.com/php/func_date_strtotime.asp

            $calculatedPeriodDate = date("Y-m-d", strtotime('-' . $request->filter["periodAmount"] . $request->filter["periodType"]));
            $ToDate = date("Y-m-d");

            $FromDate = $calculatedPeriodDate;
        }

        $sqlScript = " Declare @From DATETIME Declare @To DATETIME set @From = (Select DateDiff(day,'28 Dec 1800','" . $FromDate . "')) set @To = (Select DateDiff(day,'28 Dec 1800','" . $ToDate . "'))";
        // $sqlScript = " Declare @From int Declare @To int set @From = (Select DateDiff(day,'28 Dec 1800','1 Apr 2019')) set @To = (Select DateDiff(day,'28 Dec 1800','1 Oct 2019'))";

        $sqlScript .= ' Select Name , RecordID';
        $sqlScript .= ' , MAX(Matters) AS Matters';
        $sqlScript .= ' , MAX(Documents) AS Documents';
        $sqlScript .= ' , MAX(FeeNotes) AS FeeNotes';
        $sqlScript .= ' , MAX(ToDoNotes) AS ToDoNotes';
        $sqlScript .= ' , MAX(FileNotes) AS FileNotes';
        $sqlScript .= ' FROM (';
        $sqlScript .= ' Select Employee.RecordID,Employee.Name';
        $sqlScript .= ' , Count(DISTINCT Matter.RecordID) AS Matters';
        $sqlScript .= ' , 0 As Documents';
        $sqlScript .= ' , 0 AS FeeNotes';
        $sqlScript .= ' , 0 as ToDoNotes';
        $sqlScript .= ' , 0 AS FileNotes';
        $sqlScript .= ' FROM Employee';
        $sqlScript .= ' LEFT JOIN Matter ON EmployeeID = Employee.RecordID AND Matter.DateInstructed >= @From AND Matter.DateInstructed < @To';
        $sqlScript .= ' GROUP BY Employee.RecordID, Employee.Name';
        $sqlScript .= ' UNION ALL';
        $sqlScript .= ' Select Employee.RecordID, Employee.Name';
        $sqlScript .= ' , 0 AS Matters';
        $sqlScript .= ' , Count(DISTINCT DocLog.RecordID) As Documents';
        $sqlScript .= ' , 0 AS FeeNotes';
        $sqlScript .= ' , 0 as ToDoNotes';
        $sqlScript .= ' , 0 AS FileNotes';
        $sqlScript .= ' FROM Employee';
        $sqlScript .= ' LEFT JOIN DocLog ON DocLog.EmployeeID = Employee.RecordID AND  DocLog.Date >= @From AND DocLog.Date < @To';
        $sqlScript .= ' GROUP BY Employee.RecordID, Employee.Name';
        $sqlScript .= ' UNION ALL';
        $sqlScript .= ' Select Employee.RecordID, Employee.Name';
        $sqlScript .= ' , 0 AS Matters';
        $sqlScript .= ' , 0 As Documents';
        $sqlScript .= ' , Count(DISTINCT FeeNote.RecordID) AS FeeNotes ';
        $sqlScript .= ' , 0 as ToDoNotes';
        $sqlScript .= ' , 0 AS FileNotes';
        $sqlScript .= ' FROM Employee';
        $sqlScript .= ' LEFT JOIN FeeNote ON FeeNote.EmployeeID = Employee.RecordID AND  FeeNote.Date >= @From AND FeeNote.Date < @To';
        $sqlScript .= ' GROUP BY Employee.RecordID, Employee.Name';
        $sqlScript .= ' UNION ALL';
        $sqlScript .= ' Select Employee.RecordID, Employee.Name';
        $sqlScript .= ' , 0 AS Matters';
        $sqlScript .= ' , 0 As Documents';
        $sqlScript .= ' , 0 AS FeeNotes';
        $sqlScript .= ' , Count(DISTINCT ToDoNote.RecordID) as ToDoNotes';
        $sqlScript .= ' , 0 AS FileNotes';
        $sqlScript .= ' FROM Employee';
        $sqlScript .= ' LEFT JOIN ToDoNote ON ToDoNote.CreatedByID = Employee.RecordID AND  ToDoNote.CreatedDate >= @From AND ToDoNote.CreatedDate < @To';
        $sqlScript .= ' GROUP BY Employee.RecordID, Employee.Name';
        $sqlScript .= ' UNION ALL';
        $sqlScript .= ' Select Employee.RecordID, Employee.Name';
        $sqlScript .= ' , 0 AS Matters';
        $sqlScript .= ' , 0 As Documents';
        $sqlScript .= ' , 0 AS FeeNotes';
        $sqlScript .= ' , 0 as ToDoNotes';
        $sqlScript .= ' , Count(DISTINCT FileNote.RecordID) AS FileNotes';
        $sqlScript .= ' FROM Employee';
        $sqlScript .= ' LEFT JOIN FileNote ON FileNote.EmployeeID = Employee.RecordID AND  FileNote.Date >= @From AND FileNote.Date < @To';
        $sqlScript .= ' GROUP BY Employee.RecordID, Employee.Name';
        $sqlScript .= ' ) AS SUB';

        if (isset($request->filter['employee'])) {
            if ($request->filter['employee'] !== 'all') {

                $sqlScript .= ' WHERE RecordID IN (' . $request->filter['employee'] . ')';
            }
        }

        $sqlScript .= ' GROUP BY RecordID, Name';

        // dump($sqlScript);
        $query = DB::connection('sqlsrv')
            ->select(DB::raw($sqlScript));
        // dump('$query', $query);
        // return $query;

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

        // return DataTablesHelper::ReturnData($query, $request);
    }

}
