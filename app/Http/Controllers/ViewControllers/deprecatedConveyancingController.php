<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use DB;
use Illuminate\Http\Request;

class deprecatedConveyancingController extends Controller
{

    public function getConveyancingMatters(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        ReportBuilder::DefaultColumnReportMatterBuilder($query);
        ReportBuilder::DefaultJoinReportMatterBuilder($query, $request);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        // Add Custom Matter Columns for this filter
        if ($request->filter['status']) {
            $query->addselect(DB::raw("CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) AS 'TargetDate'"))
                ->addselect(DB::raw("CASE WHEN ToDoNote.DateDone > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),106) ELSE '' END AS DateDone"))
                ->addselect(DB::raw("CASE WHEN ToDoNote.Date > 0 AND ToDoNote.DateDone > 0 THEN Datediff(day, Cast(ToDoNote.Date - 36163 AS DATETIME),Cast(ToDoNote.DateDone - 36163 AS DATETIME)) ELSE NULL END AS 'DaysDiff'"))
                ->addselect(DB::raw("CASE WHEN Matter.DateInstructed> 0 AND ToDoNote.DateDone > 0 THEN Datediff(day, Cast(Matter.DateInstructed - 36163 AS DATETIME),Cast(ToDoNote.DateDone - 36163 AS DATETIME)) ELSE NULL END AS 'DaysTaken'"));
        } else {
            $query->addselect(DB::raw("'' AS 'TargetDate'"))
                ->addselect(DB::raw("'' AS 'DateDone'"))
                ->addselect(DB::raw("'' AS 'DaysDiff'"))
                ->addselect(DB::raw("'' AS 'DaysTaken'"));
        }

        $query->addselect(DB::raw("CASE WHEN EstateAgent.Name is NULL THEN  '' ELSE EstateAgent.Name END AS EstateAgent"))
            ->addselect(DB::raw("CASE WHEN EstateAgency.Name is NULL THEN '' ELSE EstateAgency.Name END AS SellingEstateAgency"))
            ->addselect(DB::raw("CASE WHEN MortgageOriginator.Name is NULL THEN '' ELSE MortgageOriginator.Name END AS MortgageOriginator"));

        if ($request->filter['status']) {

            $query->join('ToDoNote', 'Matter.RecordID', '=', 'ToDoNote.MatterID');
            $query->join('ToDoItem', function ($join) {
                $join->on('ToDoItem.RecordID', '=', 'ToDoNote.ToDoItemID')
                    ->where('CriticalStep', '=', 6);
            });
        }

        // Custom Matter Joins
        $query
            ->join('Control', function ($join) {
                $join->where('Control.RecordID', '=', 1);
            })
            ->leftJoin('MatParty AS EstateAgentLink', function ($join) {
                $join->on('EstateAgentLink.MatterID', '=', 'Matter.RecordID')
                    ->on('EstateAgentLink.RoleID', '=', 'Control.EstateAgentRoleID')
                    ->where('EstateAgentLink.Sorter', '=', 1);
            })
            ->leftjoin('Party AS EstateAgent', 'EstateAgent.RecordID', '=', 'EstateAgentLink.PartyID')
            ->leftJoin('MatParty AS EstateAgencyLink', function ($join) {
                $join->on('EstateAgencyLink.MatterID', '=', 'Matter.RecordID')
                    ->on('EstateAgencyLink.RoleID', '=', 'Control.SellingAgencyRoleID')
                    ->where('EstateAgencyLink.Sorter', '=', 1);
            })
            ->leftjoin('Party AS EstateAgency', 'EstateAgency.RecordID', '=', 'EstateAgencyLink.PartyID')
            ->leftJoin('MatParty AS MortgageOriginatorLink', function ($join) {
                $join->on('MortgageOriginatorLink.MatterID', '=', 'Matter.RecordID')
                    ->on('MortgageOriginatorLink.RoleID', '=', 'Control.MortgageOriginatorRoleID')
                    ->where('MortgageOriginatorLink.Sorter', '=', 1);
            })
            ->leftjoin('Party AS MortgageOriginator', 'MortgageOriginator.RecordID', '=', 'MortgageOriginatorLink.PartyID');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);

    }

    public function getMattersDueForRegistration(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        ReportBuilder::DefaultColumnReportMatterBuilder($query);
        ReportBuilder::DefaultJoinReportMatterBuilder($query, $request);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        $query->addselect(DB::raw("CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) AS 'TargetDate'"))
            ->addselect(DB::raw("CASE WHEN ToDoNote.DateDone > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),106) ELSE '' END AS DateDone"));

        $query->join('ToDoNote', 'Matter.RecordID', '=', 'ToDoNote.MatterID');

        $query->join('ToDoItem', function ($join) {
            $join->on('ToDoItem.RecordID', '=', 'ToDoNote.ToDoItemID')
                ->where('CriticalStep', '=', 6);
        });

        $query->whereRaw('ISNULL(ToDoNote.DateDone , 0 ) = 0');

        $query->whereRaw('ISNULL(ToDoNote.CompletedFlag , 0 ) = 0');

        if (isset($request->filter["periodType"])) {

            if ($request->filter["periodType"] === "day" || "week" || "month" || "year") {

                $calculatedPeriodDate = date("Y-m-d", strtotime($request->filter["periodAmount"] . $request->filter["periodType"]));

                if ($request->filter["periodAmount"] >= 0) {

                    $query->whereRaw("ToDoNote.Date >= DateDiff(day,'28 Dec 1800','" . date("Y-m-d") . "')");

                    $query->whereRaw("ToDoNote.Date <= DateDiff(day,'28 Dec 1800','" . $calculatedPeriodDate . "')");
                } else if ($request->filter["periodAmount"] < 0) {

                    $query->whereRaw("ToDoNote.Date >= DateDiff(day,'28 Dec 1800','" . $calculatedPeriodDate . "')");

                    $query->whereRaw("ToDoNote.Date-36163 <= DateDiff(day,'28 Dec 1800','" . date("Y-m-d") . "')");
                }
            }
        }
        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getIncomeEarnedByAgency(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        ReportBuilder::DefaultColumnReportMatterBuilder($query);
        ReportBuilder::DefaultJoinReportMatterBuilder($query, $request);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        $columns = MatterHelper::DefaultMatterColumns();

        $query->addselect(DB::raw("Count(DISTINCT Matter.RecordID) as 'Transactions'"))
            ->addselect(DB::raw("SUM(ISNULL(Matter.FeeEstimate,0)) as 'FeeEstimateSum'"))
            ->addselect(DB::raw("CASE WHEN EstateAgency.Name is NULL THEN '' ELSE EstateAgency.Name END AS SellingEstateAgency"));

        $query
            ->join('Control', function ($join) {

                $join->where('Control.RecordID', '=', 1);
            })

            ->leftJoin('MatParty AS EstateAgencyLink', function ($join) {
                $join->on('EstateAgencyLink.MatterID', '=', 'Matter.RecordID')
                    ->on('EstateAgencyLink.RoleID', '=', 'Control.SellingAgencyRoleID')
                    ->where('EstateAgencyLink.Sorter', '=', 1);
            })
            ->join('Party AS EstateAgency', 'EstateAgency.RecordID', '=', 'EstateAgencyLink.PartyID');

        if (isset($request->filter['planOfAction'])) {

            if ($request->filter['planOfAction'] !== 'all') {
                $query->whereIn('Matter.ToDoGroupID', explode(",", $request->filter['planOfAction']));
            }
        }

        if (isset($request->filter['agent'])) {

            if ($request->filter['agent'] !== 'all') {
                $query->whereIn('EstateAgent.RecordID', explode(",", $request->filter['agent']));
            }
        }

        if (isset($request->filter['agency'])) {

            if ($request->filter['agency'] !== 'all') {
                $query->whereIn('EstateAgency.RecordID', explode(",", $request->filter['agency']));
            }
        }

        if (isset($request->filter['mortgageOriginator'])) {

            if ($request->filter['mortgageOriginator'] !== 'all') {
                $query->whereIn('MortgageOriginator.RecordID', explode(",", $request->filter['mortgageOriginator']));
            }
        }

        if ($request->filter['status'] == 'Unregistered') {

            $query->whereRaw('ISNULL(ToDoNote.DateDone , 0 ) = 0');
        } else if ($request->filter['status'] == 'Registered') {

            $query->where('ToDoNote.DateDone', '>', 0);
        } else if ($request->filter['status'] == 'OverDue') {

            $query->whereRaw('ISNULL(ToDoNote.CompletedFlag , 0 ) = 0');
            $query->whereRaw('CAST(ToDoNote.Date-36163 as DateTime) > getdate()');
        } else if ($request->filter['status'] == 'Over Target') {

            $query->where('ToDoNote.CompletedFlag', '=', 1);
            $query->whereRaw('CAST(ToDoNote.DateDone-36163 as DateTime) > CAST(ToDoNote.Date-36163 as DateTime)');
        }

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getConveyancingDiscounts(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        // ReportBuilder::DefaultColumnReportMatterBuilder($query);
        ReportBuilder::DefaultJoinReportMatterBuilder($query, $request);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        $query->addSelect("Matter.RecordID")
            ->addSelect("Matter.Description")
            ->addSelect("Matter.FileRef")
            ->addSelect("Matter.FeeEstimate")
            ->addSelect("ConveyancingDiscountLog.EmployeeID")
            ->addSelect("DiscountEmployee.Name")
            ->addSelect("ConveyancingDiscountLog.DiscountType")
            ->addSelect("ConveyancingDiscountLog.Note")
            ->addselect(DB::raw("CASE WHEN ConveyancingDiscountLog.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ConveyancingDiscountLog.Time * 10) ,0),108) ELSE '' END AS DiscountTime"))
            ->addselect(DB::raw("CASE WHEN ISNULL(ConveyancingDiscountLog.Date,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyancingDiscountLog.Date-36163 as DateTime),106) END AS DiscountDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Employee.RecordID,0) = 0 THEN 'Not Set' ELSE Employee.Name END AS Employee"))
            ->addselect(DB::raw("CASE WHEN ISNULL(ConveyancingDiscountLog.DiscountType,0) = 0 THEN ConveyancingDiscountLog.Amount  WHEN ISNULL(ConveyancingDiscountLog.DiscountType,0) = 2 THEN ConveyancingDiscountLog.Amount ELSE ((Matter.FeeEstimate*ConveyancingDiscountLog.Amount)/100) END AS DiscountAmount "))
            ->addselect(DB::raw("CASE WHEN ISNULL(Docgen.RecordID,0) = 0 THEN 'Not Set' ELSE Docgen.Description END AS DocumentSet"));

        // $query->join('Docgen', 'Matter.DocgenID', '=', 'Docgen.RecordID');
        $query->join('ConveyancingDiscountLog', 'Matter.RecordID', '=', 'ConveyancingDiscountLog.MatterID');
        $query->leftjoin('Employee as DiscountEmployee', 'DiscountEmployee.RecordID', '=', 'ConveyancingDiscountLog.employeeid');

        $query->whereRaw("DocGen.Type in ('BON','TRN')");

        if (isset($request->filter['childEmployee'])) {

            $query->whereIn('ConveyancingDiscountLog.EmployeeID', explode(",", $request->filter['childEmployee']));
        }

        if (isset($request->filter['period']) && strtolower($request->filter['period']) != 'all') {

            if ($request->filter['period'] === 'Custom') {

                if (isset($request->filter['startDate'])) {

                    $query->whereRaw("ConveyancingDiscountLog.Date >= DateDiff(day,'28 Dec 1800','" . $request->filter['startDate'] . "')");
                }

                if (isset($request->filter['endDate'])) {

                    $query->whereRaw("ConveyancingDiscountLog.Date <= DateDiff(day,'28 Dec 1800','" . $request->filter['endDate'] . "')");
                }
            } else {

                $dateObject = ControllerHelper::CalculateDate($request->filter['period']);

                $query->whereRaw("ConveyancingDiscountLog.Date >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");

                $query->whereRaw("ConveyancingDiscountLog.Date <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
            }
        }

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

}
