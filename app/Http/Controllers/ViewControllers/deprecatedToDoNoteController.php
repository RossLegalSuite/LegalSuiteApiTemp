<?php

namespace App\Http\Controllers\ViewControllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class deprecatedToDoNoteController extends Controller
{
    public function viewToDoNote(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('ToDoNote.RecordID')
            ->addselect('Matter.FileRef')
            ->addselect('Matter.Description AS MatterDescription')
            ->addselect(DB::raw("CASE WHEN ToDoNote.Date > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),103) ELSE '' END AS TargetDate"))
            ->addselect(DB::raw("CASE WHEN ToDoNote.DateDone > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),103) ELSE '' END AS DateDone"))
            ->addselect(DB::raw("CASE WHEN ToDoNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.CreatedDate-36163 as DateTime),103) ELSE '' END AS CreatedDate"))
            ->addselect(DB::raw("CASE WHEN ToDoNote.CreatedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ToDoNote.CreatedTime * 10) ,0),108) ELSE '' END AS CreatedTime"))
            ->addselect('ToDoNote.Description')
            ->addselect('Employee.Name AS Employee')
            ->addselect('CreatedBy.Name AS CreatedByEmployee')
            ->addselect('CompletedBy.Name AS CompletedByEmployee');

        $query->where('ToDoNote.RecordID', $request->id);

        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'ToDoNote.MatterID');
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'ToDoNote.EmployeeID');
        $query->leftJoin('Employee as CreatedBy', 'CreatedBy.RecordID', '=', 'ToDoNote.CreatedByID');
        $query->leftJoin('Employee as CompletedBy', 'CompletedBy.RecordID', '=', 'ToDoNote.CompletedByID');

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getToDoNotesByEmployee(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('Employee.RecordID')
            ->addselect('Employee.Name AS Employee')
            ->addselect(DB::raw("Count(DISTINCT ToDoNote.RecordID) as 'ToDoNoteCount'"))
            ->addselect(DB::raw("Count(DISTINCT Matter.RecordID) as 'MatterCount'"));

        ReportBuilder::DefaultJoinReportToDoNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportToDoNoteBuilder($query, $request);

        $query->groupBy('Employee.RecordID', 'Employee.Name');

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getToDoNotesByMatter(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('Matter.RecordID')
            ->addselect('Matter.FileRef')
            ->addselect(DB::raw("Count(DISTINCT ToDoNote.RecordID) as 'ToDoNoteCount'"));

        ReportBuilder::DefaultJoinReportToDoNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportToDoNoteBuilder($query, $request);

        $query->groupBy('Matter.RecordID', 'Matter.Fileref');

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getToDoNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('ToDoNote.RecordID')
            ->addselect("Matter.FileRef AS 'Matter File Ref'")
            ->addselect("Matter.Description AS 'Matter Description'")
            ->addselect(DB::raw("CASE WHEN ToDoNote.Date > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"))
            ->addselect("ToDoNote.Description AS 'Description'")
            ->addselect("Employee.Name AS 'Employee (Record)'")
            ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) < 1 THEN '' ELSE CONVERT(VarChar(12), CAST(ToDoNote.DateDone-36163 as DateTime),106) END AS DateDone"))
            ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) < 1 THEN '' ELSE CONVERT(VarChar(12), DATEDIFF(day, CAST(ToDoNote.Date-36163 as DateTime), CAST(ToDoNote.DateDone-36163 as DateTime) ) ) END AS DaysDiff"))
            ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) < 1 THEN '' ELSE CONVERT(VarChar(12), DATEDIFF(day, CAST(Matter.DateInstructed-36163 as DateTime), CAST(ToDoNote.DateDone-36163 as DateTime) ) ) END AS DaysTaken"));

        ReportBuilder::DefaultJoinReportToDoNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportToDoNoteBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewEmployeeToDoNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) END AS Date"))
            ->addselect('ToDoNote.RecordID')
            ->addselect('ToDoNote.MatterID')
            ->addselect('ToDoNote.Description')
            ->addselect('Employee.Name AS Employee');

        $query->leftJoin('Employee', 'ToDoNote.EmployeeID', '=', 'Employee.RecordID');
        $query->where('ToDoNote.EmployeeID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewMatterToDoNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) END AS Date"))
            ->addselect('ToDoNote.RecordID')
            ->addselect('ToDoNote.MatterID')
            ->addselect('ToDoNote.Description')
            ->addselect('Employee.Name AS Employee');

        $query->leftJoin('Employee', 'ToDoNote.EmployeeID', '=', 'Employee.RecordID');
        $query->where('ToDoNote.matterID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getOverdueReminders(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('ToDoNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) AS 'TargetDate'")
            ->addselect('Matter.FileRef')
            ->addselect('Matter.Description')
            ->addselect('Employee.Name')
            ->addselect("ToDoNote.Description as 'Reminder'")
            ->addselect('ToDoNote.RecordID')
            ->addselect(DB::raw("CASE WHEN todonote.date > 0 THEN Datediff(day, GETDATE(),  Cast(todonote.date - 36163 AS DATETIME)) ELSE NULL END AS 'DaysDiff'"));

        $query
        //->leftJoin('Matter', 'Matter.RecordID', '=', 'toDoNote.MatterID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'toDoNote.EmployeeID');

        //  EmployeeHelper::DefaultEmployeeJoins($query, $request);
        $query->join('Matter', function ($join) use ($request) {
            $join->on('Matter.recordID', '=', 'toDoNote.MatterID');

            if ($request->filter['instructedPeriod'] === 'Today') {
                $calculateStartDate = date('Y-m-d');
                $calculateEndDate = date('Y-m-d');
            } elseif ($request->filter['instructedPeriod'] === 'Yesterday') {
                $calculateStartDate = date('Y-m-d', strtotime('Yesterday'));
                $calculateEndDate = date('Y-m-d', strtotime('Yesterday'));
            } elseif ($request->filter['instructedPeriod'] === 'This Week') {
                $monday = strtotime('monday this week');
                $sunday = strtotime('sunday this week');

                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } elseif ($request->filter['instructedPeriod'] === 'This Week') {
                $monday = strtotime('monday last week');
                $sunday = strtotime('sunday last week');

                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } elseif ($request->filter['instructedPeriod'] === 'This Month') {
                $calculateStartDate = date('Y-m-01', strtotime('This Month'));
                $calculateEndDate = date('Y-m-t', strtotime('This Month'));
            } elseif ($request->filter['instructedPeriod'] === 'Last Month') {
                $calculateStartDate = date('Y-m-01', strtotime('Last Month'));
                $calculateEndDate = date('Y-m-t', strtotime('Last Month'));
            } elseif ($request->filter['instructedPeriod'] === 'This Year') {
                $calculateStartDate = date('Y-01-01', strtotime('This Year'));
                $calculateEndDate = date('Y-12-31', strtotime('This Year'));
            } elseif ($request->filter['instructedPeriod'] === 'Last Year') {
                $calculateStartDate = date('Y-01-01', strtotime('Last Year'));
                $calculateEndDate = date('Y-12-31', strtotime('Last Year'));
            }

            if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
                if ($request->filter['instructedPeriod'] === 'Custom') {
                    if (isset($request->filter['instructedStartDate'])) {
                        $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','".$request->filter['instructedStartDate']."')");
                    }

                    if (isset($request->filter['instructedEndDate'])) {
                        $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','".$request->filter['instructedEndDate']."')");
                    }
                } else {
                    $dateObject = DataTablesHelper::CalculateDate($request->filter['instructedPeriod']);

                    $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','".$dateObject->startDate."')");

                    $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','".$dateObject->endDate."')");
                }
            }

            if (isset($request->filter['client'])) {
                if ($request->filter['client'] !== 'all') {
                    $join->whereIn('Matter.ClientID', explode(',', $request->filter['client']));
                }
            }

            if (isset($request->filter['docgen'])) {
                if ($request->filter['docgen'] !== 'all') {
                    $join->whereIn('Matter.DocgenID', explode(',', $request->filter['docgen']));
                }
            }

            if (isset($request->filter['mattype'])) {
                if ($request->filter['mattype'] !== 'all') {
                    $join->whereIn('Matter.MatterTypeID', explode(',', $request->filter['mattype']));
                }
            }

            if (isset($request->filter['costcentre'])) {
                if ($request->filter['costcentre'] !== 'all') {
                    $join->whereIn('Matter.CostCentreID', explode(',', $request->filter['costcentre']));
                }
            }

            $join->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        });

        $query->leftJoin('MatType', 'Matter.MatterTypeID', '=', 'MatType.RecordID')
            ->leftJoin('Docgen', 'Matter.DocgenID', '=', 'Docgen.RecordID')
            ->leftJoin('CostCentre', 'Matter.CostCentreID', '=', 'CostCentre.RecordID')
            ->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID');

        // Filter Employee Where Clauses

        if (isset($request->filter['employee'])) {
            if ($request->filter['employee'] !== 'all') {
                $query->whereIn('Employee.RecordID', explode(',', $request->filter['employee']));
            }
        }

        $query->whereRaw('Datediff(day, Cast(todonote.date - 36163 AS DATETIME), GETDATE()) > 0');
        $query->whereRaw('ISNULL(ToDoNote.DateDone , 0 ) = 0');

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
