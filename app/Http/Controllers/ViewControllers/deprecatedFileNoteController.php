<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use DB;
use Illuminate\Http\Request;

class deprecatedFileNoteController extends Controller
{

    public function viewFileNote(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('FileNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("FileNote.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect("Matter.Description AS MatterDescription")
            ->addselect("FileNote.Description")
            ->addselect("Employee.Name AS Employee")
            ->addselect("CreatedByEmployee.Name AS CreatedByEmployee")
            ->addselect(DB::raw("CASE WHEN FileNote.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.Time * 10) ,0),108) ELSE '' END AS Time"))
            ->addselect(DB::raw("CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),103) ELSE '' END AS Date"))
            ->addselect(DB::raw("CASE WHEN FileNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),103) ELSE '' END AS CreatedDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Code,'') = '' THEN '' ELSE Stage.Code END AS StageCode"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Description,'') = '' THEN '' ELSE Stage.Description END AS StageDescription"));

        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'FileNote.MatterID')
            ->leftJoin('Stage', 'Stage.RecordID', '=', 'FileNote.StageID')
            ->leftJoin('Employee', 'Employee.RecordID', '=', 'FileNote.EmployeeID')
            ->leftjoin('Employee as CreatedByEmployee', 'FileNote.CreatedBy', '=', 'CreatedByEmployee.RecordID');

        $query->where('FileNote.RecordID', $request->id);

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getFileNotesByEmployee(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('FileNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Employee.RecordID")
            ->addselect("Employee.Name AS Employee")
            ->addselect(DB::raw("Count(DISTINCT FileNote.RecordID) as 'FileNoteCount'"))
            ->addselect(DB::raw("Count(DISTINCT Matter.RecordID) as 'MatterCount'"));

        ReportBuilder::DefaultJoinReportFileNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFileNoteBuilder($query, $request);

        $query->groupBy('Employee.RecordID', 'Employee.Name');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getFileNotesByMatter(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('FileNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("Matter.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect(DB::raw("Count(DISTINCT FileNote.RecordID) as 'FileNoteCount'"));

        ReportBuilder::DefaultJoinReportFileNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFileNoteBuilder($query, $request);

        $query->groupBy('Matter.RecordID', 'Matter.Fileref');

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getFileNotes(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('FileNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("FileNote.RecordID")
            ->addselect("Matter.FileRef AS 'Matter File Ref'")
            ->addselect("Matter.Description AS 'Matter Description'")
            ->addselect("FileNote.Description AS 'Description'")
            ->addselect("Employee.Name AS 'Employee'")
            ->addselect("CreatedByEmployee.Name AS CreatedByEmployee")
            ->addselect(DB::raw("CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"))
            ->addselect(DB::raw("CASE WHEN FileNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),103) ELSE '' END AS CreatedDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Code,'') = '' THEN '' ELSE Stage.Code END AS StageCode"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Description,'') = '' THEN '' ELSE Stage.Description END AS StageDescription"));

        $query->leftJoin('Stage', 'FileNote.StageID', '=', 'Stage.RecordID');
        $query->leftjoin('Employee as CreatedByEmployee', 'FileNote.CreatedBy', '=', 'CreatedByEmployee.RecordID');

        ReportBuilder::DefaultJoinReportFileNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFileNoteBuilder($query, $request);

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function viewEmployeeFileNotes(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('FileNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("FileNote.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect("FileNote.Description AS 'Description'")
            ->addselect("CreatedByEmployee.Name AS 'Employee'")
            ->addselect(DB::raw("CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"))
            ->addselect(DB::raw("CASE WHEN FileNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),103) ELSE '' END AS 'CreatedDate'"));

        $query->leftjoin('Employee as CreatedByEmployee', 'FileNote.CreatedBy', '=', 'CreatedByEmployee.RecordID');

        $query->where('FileNote.EmployeeID', $request->id);

        ReportBuilder::DefaultJoinReportFileNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFileNoteBuilder($query, $request);

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
    public function viewMatterFileNotes(Request $request)
    {

        $query = DB::connection('sqlsrv')
            ->table('FileNote');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect("FileNote.RecordID")
            ->addselect("Matter.FileRef")
            ->addselect("FileNote.Description AS 'Description'")
            ->addselect("CreatedByEmployee.Name AS 'Employee'")
            ->addselect(DB::raw("CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"))
            ->addselect(DB::raw("CASE WHEN FileNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),103) ELSE '' END AS 'CreatedDate'"));

        $query->where('FileNote.matterID', $request->id);
        // ->where('FileNote.EmployeeID', $request->recordId);

        $query->leftjoin('Employee as CreatedByEmployee', 'FileNote.CreatedBy', '=', 'CreatedByEmployee.RecordID');

        ReportBuilder::DefaultJoinReportFileNoteBuilder($query, $request);

        ReportBuilder::DefaultWhereReportFileNoteBuilder($query, $request);

        if ($request->input('method')) {

            return ControllerHelper::MethodHelper($query, $request);

        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
