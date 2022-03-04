<?php

namespace App\Http\Controllers\ViewControllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class deprecatedPracticeManagementController extends Controller
{
    public function getMattersNoActivity(Request $request)
    {
        $NoFileNotes = strpos(' '.$request->filter['flags'], 'File Notes') > 0 ? 1 : 0;
        $NoFeeNotes = strpos(' '.$request->filter['flags'], 'Fee Notes') > 0 ? 1 : 0;
        $NoReminders = strpos(' '.$request->filter['flags'], 'Reminders') > 0 ? 1 : 0;
        $NoDocuments = strpos(' '.$request->filter['flags'], 'Documents') > 0 ? 1 : 0;

        // if ($request->method === "preview" || $request->method === "chart") {

        //     $sqlScript = 'Select ';
        //     $sqlScript .= ' SUM(NoDocuments) AS NoDocuments,';
        //     $sqlScript .= ' SUM(NoFileNotes) as NoFileNotes,';
        //     $sqlScript .= ' SUM(NoFeeNotes) as NoFeeNotes,';
        //     $sqlScript .= ' SUM(NoReminders) as NoReminders,';

        //     if ($NoDocuments || $NoFileNotes || $NoFeeNotes || $NoReminders) {
        //         $sqlScript .= ' SUM(CASE WHEN';

        //         $subScript = '';
        //         $andWord = '';

        //         if ($NoDocuments) {
        //             if ($subScript !== '') {
        //                 $andWord = ' AND ';
        //             }

        //             $subScript .= $andWord . ' NoDocuments = 1';
        //         }
        //         if ($NoFileNotes) {
        //             if ($subScript !== '') {
        //                 $andWord = ' AND ';
        //             }

        //             $subScript .= $andWord . ' NoFileNotes = 1';
        //         }
        //         if ($NoFeeNotes) {
        //             if ($subScript !== '') {
        //                 $andWord = ' AND ';
        //             }

        //             $subScript .= $andWord . ' NoFeeNotes = 1';
        //         }
        //         if ($NoReminders) {
        //             if ($subScript !== '') {
        //                 $andWord = ' AND ';
        //             }

        //             $subScript .= $andWord . ' NoReminders = 1';
        //         }

        //         $sqlScript .= $subScript;
        //         $sqlScript .= ' THEN 1 ELSE 0 END) AS NoActivity,';
        //     } else {

        //         $sqlScript .= '0 as NoActivity,';
        //     }

        //     $sqlScript .= ' COUNT(DISTINCT RecordID) AS Count';
        //     $sqlScript .= ' FROM (';

        //     $sqlScript .= ' Select DataSet.RecordID,';
        //     $sqlScript .= ' MAX(ISNULL(NoDocuments,0)) AS NoDocuments,MAX(ISNULL(NoFileNotes,0)) AS NoFileNotes,MAX(ISNULL(NoFeeNotes,0))as NoFeeNotes,MAX(ISNULL(NoReminders,0)) as NoReminders';
        //     $sqlScript .= ' FROM (';

        //     $sqlScript .= ' Select Matter.RecordID, 1 as NoDocuments, 0 as NoFileNotes , 0 as NoFeeNotes, 0 AS NoReminders';
        //     $sqlScript .= ' FROM Matter';

        //     $sqlScript .= ' LEFT JOIN DocLog DL ON DL.MatterID = Matter.RecordID';
        //     $sqlScript .= ' WHERE DL.RecordID IS NULL';
        //     $sqlScript .= ' AND 1 = ' . $NoDocuments;

        //     $sqlScript .= ' UNION ALL';
        //     $sqlScript .= ' Select Matter.RecordID,0,1,0,0 FROM Matter';
        //     $sqlScript .= ' LEFT JOIN FileNote FN ON FN.MatterID = Matter.RecordID';
        //     $sqlScript .= ' WHERE FN.RecordID IS NULL';
        //     $sqlScript .= ' AND 1 = ' . $NoFileNotes;

        //     $sqlScript .= ' UNION ALL';
        //     $sqlScript .= ' Select Matter.RecordID,0,0,1,0 FROM Matter';
        //     $sqlScript .= ' LEFT JOIN FeeNote FEEN ON FEEN.MatterID = Matter.RecordID';
        //     $sqlScript .= ' WHERE FEEN.RecordID IS NULL';
        //     $sqlScript .= ' AND 1 = ' . $NoFeeNotes;

        //     $sqlScript .= ' UNION ALL';
        //     $sqlScript .= ' Select Matter.RecordID,0,0,0,1 FROM Matter';
        //     $sqlScript .= ' LEFT JOIN ToDoNote TDN ON TDN.MatterID = Matter.RecordID';
        //     $sqlScript .= ' WHERE TDN.RecordID IS NULL';
        //     $sqlScript .= ' AND 1 = ' . $NoReminders;

        //     $sqlScript .= ' ) AS DATASET';
        //     $sqlScript .= ' INNER JOIN Matter ON Matter.RecordID = DATASET.RecordID';

        //     MatterHelper::DefaultMatterWhereString($sqlScript, $request);

        //     $sqlScript .= ' GROUP BY DataSet.RecordID';
        //     $sqlScript .= ' ) AS SUBDS';

        //     $query = DB::connection('sqlsrv')
        //         ->select(DB::raw($sqlScript));

        //     return $query;
        // } else {

        $query = DB::connection('sqlsrv')
            ->table('Matter')
            ->distinct();

        ReportBuilder::DefaultColumnReportMatterBuilder($query);

        if ($NoDocuments) {
            $query->addselect('Documents');
        }

        if ($NoFileNotes) {
            $query->addselect('FileNotes');
        }

        if ($NoFeeNotes) {
            $query->addselect('FeeNotes');
        }

        if ($NoReminders) {
            $query->addselect('Reminders');
        }

        // }

        ReportBuilder::DefaultJoinReportMatterBuilder($query);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        // These are for the pop-up modals when clicking on the Pie Chart
        if ($request->customMethod === 'File Notes') {
            $query->leftjoin('FileNote', 'FileNote.MatterID', '=', 'Matter.RecordID')->whereNull('FileNote.RecordID');
        } elseif ($request->customMethod === 'Fee Notes') {
            $query->leftjoin('FeeNote', 'FeeNote.MatterID', '=', 'Matter.RecordID')->whereNull('FeeNote.RecordID');
        } elseif ($request->customMethod === 'Reminders') {
            $query->leftjoin('ToDoNote', 'ToDoNote.MatterID', '=', 'Matter.RecordID')->whereNull('ToDoNote.RecordID');
        } elseif ($request->customMethod === 'Documents') {
            $query->leftjoin('DocLog', 'DocLog.MatterID', '=', 'Matter.RecordID')->whereNull('DocLog.RecordID');
        } else {
            if ($request->method !== 'totalCount') {
                if ($request->filter['periodType'] === 'Day' || $request->filter['periodType'] === 'Week' || $request->filter['periodType'] === 'Month' || $request->filter['periodType'] === 'Year') {

                    //https://www.w3schools.com/php/func_date_strtotime.asp

                    $calculatedPeriodDate = date('Y-m-d', strtotime(-$request->filter['periodAmount'].$request->filter['periodType']));
                } else {
                    $calculatedPeriodDate = null;
                }

                if ($NoFileNotes) {
                    $joinNoFileNotesSubQuery = DB::connection('sqlsrv')
                        ->table('FileNote')
                        ->selectraw('[FileNote].[MatterID], Count(recordid) as [FileNotes]');

                    if ($calculatedPeriodDate) {
                        $joinNoFileNotesSubQuery->whereraw("[filenote].[date] >= Datediff(day, '28 Dec 1800', ' $calculatedPeriodDate ') ");
                    }

                    $joinNoFileNotesSubQuery->groupBy('FileNote.MatterID');

                    $query->leftJoinSub($joinNoFileNotesSubQuery, 'FileNotesJoin', function ($join) {
                        $join->on('Matter.RecordID', '=', 'FileNotesJoin.MatterID');
                    });
                }
                if ($NoFeeNotes) {
                    $joinNoFeeNotesSubQuery = DB::connection('sqlsrv')
                        ->table('FeeNote')
                        ->selectraw('[FeeNote].[MatterID], Count(recordid) as [FeeNotes]');

                    if ($calculatedPeriodDate) {
                        $joinNoFeeNotesSubQuery->whereraw("[FeeNote].[date] >= Datediff(day, '28 Dec 1800', ' $calculatedPeriodDate ') ");
                    }

                    $joinNoFeeNotesSubQuery->groupBy('FeeNote.MatterID');

                    $query->leftJoinSub($joinNoFeeNotesSubQuery, 'FeeNotesJoin', function ($join) {
                        $join->on('Matter.RecordID', '=', 'FeeNotesJoin.MatterID');
                    });
                }
                if ($NoReminders) {
                    $joinNoRemindersSubQuery = DB::connection('sqlsrv')
                        ->table('ToDoNote')
                        ->selectraw('[ToDoNote].[MatterID], Count(recordid) as [Reminders]');

                    if ($calculatedPeriodDate) {
                        $joinNoRemindersSubQuery->whereraw("[ToDoNote].[CreatedDate] >= Datediff(day, '28 Dec 1800', ' $calculatedPeriodDate ') ");
                    }

                    $joinNoRemindersSubQuery->groupBy('ToDoNote.MatterID');

                    $query->leftJoinSub($joinNoRemindersSubQuery, 'ToDoNotesJoin', function ($join) {
                        $join->on('Matter.RecordID', '=', 'ToDoNotesJoin.MatterID');
                    });
                }
                if ($NoDocuments) {
                    $joinNoDocumentsSubQuery = DB::connection('sqlsrv')
                        ->table('DocLog')
                        ->selectraw('[DocLog].[MatterID], Count(recordid) as [Documents]');

                    if ($calculatedPeriodDate) {
                        $joinNoDocumentsSubQuery->whereraw("[DocLog].[date] >= Datediff(day, '28 Dec 1800', ' $calculatedPeriodDate ') ");
                    }

                    $joinNoDocumentsSubQuery->groupBy('DocLog.MatterID');

                    $query->leftJoinSub($joinNoDocumentsSubQuery, 'DocumentsJoin', function ($join) {
                        $join->on('Matter.RecordID', '=', 'DocumentsJoin.MatterID');
                    });
                }
                $query->where(function ($query) use ($NoFileNotes, $NoFeeNotes, $NoReminders, $NoDocuments) {
                    if ($NoFileNotes) {
                        $query->orWhereRaw('Isnull(FileNotes, 0) = 0');
                    }
                    if ($NoFeeNotes) {
                        $query->orWhereRaw('Isnull(FeeNotes, 0) = 0');
                    }
                    if ($NoReminders) {
                        $query->orWhereRaw('Isnull(Reminders, 0) = 0');
                    }
                    if ($NoDocuments) {
                        $query->orWhereRaw('Isnull(Documents, 0) = 0');
                    }
                });

                if (! $NoDocuments && ! $NoFileNotes && ! $NoFeeNotes && ! $NoReminders) {
                    $query->whereRaw('1=0');
                }
            }
        }
        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getMattersPrescribing(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('Matter');

        QueryBuilder::QueryBuilder($query, $request);

        ReportBuilder::DefaultColumnReportMatterBuilder($query);
        ReportBuilder::DefaultJoinReportMatterBuilder($query);
        ReportBuilder::DefaultWhereReportMatterBuilder($query, $request);

        if (isset($request->filter['periodType'])) {
            if ($request->filter['periodType'] === 'day' || 'week' || 'month' || 'year') {

                //https://www.w3schools.com/php/func_date_strtotime.asp

                $calculatedPeriodDate = date('Y-m-d', strtotime($request->filter['periodAmount'].$request->filter['periodType']));

                if ($request->filter['periodAmount'] >= 0) {
                    $query->whereRaw("Matter.PrescriptionDate >= DateDiff(day,'28 Dec 1800','".date('Y-m-d')."')");

                    $query->whereRaw("Matter.PrescriptionDate <= DateDiff(day,'28 Dec 1800','".$calculatedPeriodDate."')");
                } elseif ($request->filter['periodAmount'] < 0) {
                    $query->whereRaw("Matter.PrescriptionDate >= DateDiff(day,'28 Dec 1800','".$calculatedPeriodDate."')");

                    $query->whereRaw("Matter.PrescriptionDate <= DateDiff(day,'28 Dec 1800','".date('Y-m-d')."')");
                }
            }
        }

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
