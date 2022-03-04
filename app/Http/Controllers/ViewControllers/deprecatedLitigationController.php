<?php

namespace App\Http\Controllers\ViewControllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class deprecatedLitigationController extends Controller
{
    public function getPromisesToPay(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        // Add Default Matter Columns
        ReportBuilder::DefaultColumnReportMatterBuilder($query);

        $query->addselect(DB::raw("CASE WHEN ISNULL(ColData.PTPStartDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PTPStartDate-36163 as DateTime),106) END AS PTPStartDate"))
            ->addselect('Matter.DebtorPaymentAmount')
            ->addselect('Matter.DebtorPaymentDay')
            ->addselect(DB::raw("CASE WHEN Matter.DebtorPaymentFrequency = 1 THEN 'Monthly'WHEN Matter.DebtorPaymentFrequency = 2 THEN 'Weekly'WHEN Matter.DebtorPaymentFrequency = 3 THEN 'Every 3 Months'WHEN Matter.DebtorPaymentFrequency = 4 THEN 'Bi-Weekly'WHEN Matter.DebtorPaymentFrequency = 5 THEN 'Every 6 Months'ELSE 'Unknown' END AS DebtorPaymentFrequency"));

        if ($request->filter['overdueFlag'] == '1') {
            $ptpMattersQuery = DB::connection('sqlsrv')
                ->table('Matter')
                ->select('RecordID', 'FileRef', 'DebtorPaymentAmount')
                ->where('Matter.DebtorPaymentAmount', '>', 0);

            ReportBuilder::DefaultWhereReportMatterBuilder($ptpMattersQuery, $request);

            $ptpMatters = $ptpMattersQuery->get();

            $overdueMatters = [];

            foreach ($ptpMatters as $ptpMatter) {
                $paidAmount = (float) collect(DB::connection('sqlsrv')->select('SELECT dbo.FetchLastPeriodPTP('.$ptpMatter->RecordID.',GETDATE() ) AS paidAmount'))->first()->paidAmount;

                if ($paidAmount < (float) $ptpMatter->DebtorPaymentAmount) {
                    array_push($overdueMatters, $ptpMatter->RecordID);
                }
            }
        }

        ReportBuilder::DefaultJoinReportMatterBuilder($query);

        $query->leftJoin('ColData', 'Matter.RecordID', '=', 'ColData.MatterID');

        // Filter Matter Where Clauses
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        if ($request->filter['overdueFlag'] == '1') {
            $query->whereIn('Matter.RecordID', $overdueMatters);
        }

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getStagesReached(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        // Convert stages and non stages into arrays

        if (isset($request->filter['stages'])) {
            $stages = explode(',', $request->filter['stages']);
        }

        if (isset($request->filter['nonStages'])) {
            $nonStages = explode(',', $request->filter['nonStages']);
        }

        if (isset($request->filter['displayStages'])) {
            $displayStages = explode(',', $request->filter['displayStages']);
        }

        // Add Default Matter Columns
        ReportBuilder::DefaultColumnReportMatterBuilder($query);

        // Add columns for each Stage Reached

        if (isset($request->filter['displayStages'])) {
            foreach ($displayStages as $stage) {
                $stageColumnName = 'FileNote_'.$stage.'.Date';

                $query->addselect(DB::raw('CASE WHEN ISNULL('.$stageColumnName.",0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(".$stageColumnName.'-36163 as DateTime),106) END AS FileNoteDate'.$stage));
            }
        }

        ReportBuilder::DefaultJoinReportMatterBuilder($query);

        // Add joins for the columns for each Stage Reached
        if (isset($request->filter['displayStages'])) {
            foreach ($displayStages as $stage) {
                $query->leftJoin('FileNote as FileNote_'.$stage, function ($join) use ($stage) {
                    $join->on('FileNote_'.$stage.'.MatterID', '=', 'Matter.RecordID')
                        ->where('FileNote_'.$stage.'.StageID', $stage);
                });
            }
        }

        // Filter Matter Where Clauses
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        if (isset($request->filter['stageGroupId'])) {
            $query->where('Matter.StageGroupID', $request->filter['stageGroupId']);
        }

        if (isset($request->filter['stages'])) {
            foreach ($stages as $stage) {
                $query->whereIn('Matter.RecordID', function ($query) use ($stage, $request) {
                    $query
                        ->select('MatterID')
                        ->from('FileNote')
                        ->distinct()
                        ->join('Matter', function ($join) use ($request) {
                            $join
                                ->on('Matter.RecordID', 'FileNote.MatterID')
                                ->where('Matter.StageGroupID', $request->filter['stageGroupId']);
                        })
                        ->where('StageID', $stage);
                });
            }
        }

        if (isset($request->filter['nonStages'])) {
            foreach ($nonStages as $stage) {
                $query->whereNotIn('Matter.RecordID', function ($query) use ($stage, $request) {
                    $query
                        ->select('MatterID')
                        ->from('FileNote')
                        ->distinct()
                        ->join('Matter', function ($join) use ($request) {
                            $join
                                ->on('Matter.RecordID', 'FileNote.MatterID')
                                ->where('Matter.StageGroupID', $request->filter['stageGroupId']);
                        })
                        ->where('StageID', $stage);
                });
            }
        }

        //if ($request->method === "data") DataTablesHelper::LogSqlQuery($query, $request->method);

        // Return the data in the format based on the method
        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getStageGroups(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('StageGroup')
            ->addselect('StageGroup.RecordId')
            ->addselect('StageGroup.Description')
            ->where('Description', '<>', 'All')
            ->where('Description', '<>', 'None')
            ->orderBy('Description', 'asc');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getStages(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Stage')
            ->addselect('Stage.RecordID')
            ->addselect('Stage.Code')
            ->addselect(DB::raw("CASE WHEN ISNULL(ReportHeading,'') = '' THEN Description ELSE ReportHeading END as Description"))
            ->where('stageGroupId', $request->id)
            ->where('InactiveFlag', '<>', 1)
            ->where('InactiveFlag', '<>', null)
            ->orderBy('Code', 'asc');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
