<?php

namespace App\Custom;

use App\Custom\ControllerHelper;
use DB;

class ReportBuilder
{
    //Matter
    public static function DefaultColumnReportMatterBuilder(&$query)
    {
        
        $query->addselect("Matter.FileRef")
        ->addselect("Matter.TheirRef")
        ->addselect("Matter.AlternateRef")
        ->addselect("Matter.RecordID")
        ->addselect("Matter.Description")
        ->addselect("Matter.FileCabinet")
        
        ->addselect("Matter.EmployeeID")
        ->addselect("Employee.Name as EmployeeName")
        
        ->addselect("Party.Name as PartyName")
        ->addselect("Matter.ClientID as PartyID")
        ->addselect("Party.MatterPrefix as PartyMatterPrefix")
        
        ->addselect("MatType.Description  AS MatTypeDescription")
        ->addselect("Matter.MatterTypeID  AS MatTypeID")
        ->addselect("Docgen.Description  AS DocGenDescription")
        ->addselect("Matter.DocgenID  AS DocGenID")
        ->addselect("CostCentre.Description  AS CostCentreDescription")
        ->addselect("Matter.CostCentreID  AS CostCentreID")
        ->addselect("PlanOfAction.Description  AS PlanOfActionDescription")
        ->addselect("Matter.ToDoGroupID  AS PlanOfActionID")
        ->addselect("Branch.Description AS BranchDescription")
        ->addselect("Matter.BranchID AS BranchID")
        ->addselect("StageGroup.Description AS StageGroupDescription")
        ->addselect("Matter.StageGroupID AS StageGroupID")
        ->addselect("FeeSheet.Description AS FeeSheetDescription")
        ->addselect("Matter.ClientFeeSheetID AS FeeSheetID")
        
        ->addselect(DB::raw("CASE WHEN ISNULL(Matter.DateInstructed,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.DateInstructed-36163 as DateTime),106) END AS Instructed"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Matter.PrescriptionDate,0) = 0 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.PrescriptionDate-36163 as DateTime),106) END AS PrescriptionDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Matter.FeeEstimate,0) = 0 THEN 0 ELSE Matter.FeeEstimate END AS FeeEstimate"))
        ->addselect(DB::raw("CASE WHEN Matter.Access = 'O' THEN 'Open to All' WHEN Matter.Access = 'V' THEN 'View Only' WHEN Matter.Access = 'R' THEN 'Restricted' ELSE 'Unspecified' END AS MatterAccess"));
        // ->addselect(DB::raw("CASE WHEN ISNULL(Employee.RecordID,0) = 0 THEN 'Not Set' ELSE Employee.Name END AS Employee"))
        // ->addselect(DB::raw("CASE WHEN ISNULL(MatType.RecordID,0) = 0 THEN 'Not Set' ELSE MatType.Description END AS MatterType"))
        // ->addselect(DB::raw("CASE WHEN ISNULL(Docgen.RecordID,0) = 0 THEN 'Not Set' ELSE Docgen.Description END AS DocumentSet"))
        // ->addselect(DB::raw("CASE WHEN ISNULL(CostCentre.RecordID,0) = 0 THEN 'Not Set' ELSE CostCentre.Description END AS CostCentre"))
        // ->addselect(DB::raw("CASE WHEN ISNULL(PlanOfAction.RecordID,0) = 0 THEN 'Not Set' ELSE PlanOfAction.Description END AS PlanOfAction"))
        // ->addselect(DB::raw("CASE WHEN ISNULL(Branch.RecordID,0) = 0 THEN 'Not Set' ELSE Branch.Description END AS Branch"))
        return $query;
    }
    
    public static function DefaultJoinReportMatterBuilder(&$query)
    {
        $query->leftJoin('Employee', 'Matter.EmployeeID', '=', 'Employee.RecordID')
        ->leftJoin('MatType', 'Matter.MatterTypeID', '=', 'MatType.RecordID')
        ->leftJoin('Docgen', 'Matter.DocgenID', '=', 'Docgen.RecordID')
        ->leftJoin('CostCentre', 'Matter.CostCentreID', '=', 'CostCentre.RecordID')
        ->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID')
        ->leftJoin('PlanOfAction', 'Matter.ToDoGroupID', '=', 'PlanOfAction.RecordID')
        ->leftJoin('Branch', 'Matter.BranchID', '=', 'Branch.RecordID');
        // ->leftJoin('StageGroup', 'Matter.StageGroupID', '=', 'StageGroup.RecordID')
        // ->leftJoin('FeeSheet', 'Matter.ClientFeeSheetID', '=', 'FeeSheet.RecordID');
        // ->leftJoin('Language', 'Matter.DocumentLanguageID', '=', 'Language.RecordID')
        // ->leftJoin('ConveyData', 'Matter.RecordID', '=', 'ConveyData.MatterID')
        // ->leftJoin('BondCause', 'ConveyData.BondCauseID', '=', 'BondCause.RecordID')
        return $query;
    }
    
    public static function DefaultWhereReportMatterBuilder(&$query, $request)
    {
        if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
            
            if ($request->filter['instructedPeriod'] === 'Custom') {
                
                if (isset($request->filter['instructedStartDate'])) {
                    
                    $query->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedStartDate'] . "')");
                }
                
                if (isset($request->filter['instructedEndDate'])) {
                    
                    $query->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedEndDate'] . "')");
                }
            } else {
                
                $dateObject = ControllerHelper::CalculateDate($request->filter['instructedPeriod']);
                
                $query->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                
                $query->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
            }
        }
        
        if (isset($request->filter['client'])) {
            
            if ($request->filter['client'] !== 'all') {
                $query->whereIn('Matter.ClientID', explode(",", $request->filter['client']));
            }
        }
        
        if (isset($request->filter['employee'])) {
            
            if ($request->filter['employee'] !== 'all') {
                $query->whereIn('Matter.EmployeeID', explode(",", $request->filter['employee']));
            }
        }
        
        if (isset($request->filter['docgen'])) {
            
            if ($request->filter['docgen'] !== 'all') {
                $query->whereIn('Matter.DocgenID', explode(",", $request->filter['docgen']));
            }
        }
        
        if (isset($request->filter['mattype'])) {
            
            if ($request->filter['mattype'] !== 'all') {
                $query->whereIn('Matter.MatterTypeID', explode(",", $request->filter['mattype']));
            }
        }
        
        if (isset($request->filter['branch'])) {
            
            if ($request->filter['branch'] !== 'all') {
                $query->whereIn('Matter.BranchID', explode(",", $request->filter['branch']));
            }
        }
        
        if (isset($request->filter['costcentre'])) {
            
            if ($request->filter['costcentre'] !== 'all') {
                $query->whereIn('Matter.CostCentreID', explode(",", $request->filter['costcentre']));
            }
        }
        
        if (isset($request->filter['planOfAction'])) {
            
            if ($request->filter['planOfAction'] !== 'all') {
                $query->whereIn('Matter.ToDoGroupID', explode(",", $request->filter['planOfAction']));
            }
        }
        
        $query->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        
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
        if (isset($request->filter['status'])) {
            
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
        }
        return $query;
    }
    
    //DocLog
    
    public static function DefaultJoinReportDocLogBuilder(&$query, $request)
    {
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'DocLog.EmployeeID');
        
        $query->join('Matter', function ($join) use ($request) {
            $join->on('Matter.recordID', '=', 'DocLog.MatterID');
            
            if ($request->filter['instructedPeriod'] === 'Today') {
                
                $calculateStartDate = date("Y-m-d");
                $calculateEndDate = date("Y-m-d");
            } else if ($request->filter['instructedPeriod'] === 'Yesterday') {
                
                $calculateStartDate = date("Y-m-d", strtotime("Yesterday"));
                $calculateEndDate = date("Y-m-d", strtotime("Yesterday"));
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday this week');
                $sunday = strtotime('sunday this week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday last week');
                $sunday = strtotime('sunday last week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("This Month"));
                $calculateEndDate = date("Y-m-t", strtotime("This Month"));
            } else if ($request->filter['instructedPeriod'] === 'Last Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("Last Month"));
                $calculateEndDate = date("Y-m-t", strtotime("Last Month"));
            } else if ($request->filter['instructedPeriod'] === 'This Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("This Year"));
                $calculateEndDate = date("Y-12-31", strtotime("This Year"));
            } else if ($request->filter['instructedPeriod'] === 'Last Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("Last Year"));
                $calculateEndDate = date("Y-12-31", strtotime("Last Year"));
            }
            
            if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
                
                if ($request->filter['instructedPeriod'] === 'Custom') {
                    
                    if (isset($request->filter['instructedStartDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedStartDate'] . "')");
                    }
                    
                    if (isset($request->filter['instructedEndDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedEndDate'] . "')");
                    }
                } else {
                    
                    $dateObject = ControllerHelper::CalculateDate($request->filter['instructedPeriod']);
                    
                    $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                    
                    $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
                }
            }
            
            if (isset($request->filter['client'])) {
                
                if ($request->filter['client'] !== 'all') {
                    $join->whereIn('Matter.ClientID', explode(",", $request->filter['client']));
                }
            }
            
            if (isset($request->filter['docgen'])) {
                
                if ($request->filter['docgen'] !== 'all') {
                    $join->whereIn('Matter.DocgenID', explode(",", $request->filter['docgen']));
                }
            }
            
            if (isset($request->filter['mattype'])) {
                
                if ($request->filter['mattype'] !== 'all') {
                    $join->whereIn('Matter.MatterTypeID', explode(",", $request->filter['mattype']));
                }
            }
            
            if (isset($request->filter['costcentre'])) {
                
                if ($request->filter['costcentre'] !== 'all') {
                    $join->whereIn('Matter.CostCentreID', explode(",", $request->filter['costcentre']));
                }
            }
            
            $join->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        });
    }
    
    public static function DefaultWhereReportDocLogBuilder(&$query, $request)
    {
        if ($request->filter['status'] == '1' || $request->filter['status'] == '0') {
            
            $query->where('DocLog.InternalFlag', '=', $request->filter['status']);
        }
        
        if (isset($request->filter['childEmployee'])) {
            
            $query->whereIn('DocLog.EmployeeID', explode(",", $request->filter['childEmployee']));
        }
        
        if (isset($request->filter['period']) && strtolower($request->filter['period']) != 'all') {
            
            if ($request->filter['period'] === 'Custom') {
                
                if (isset($request->filter['startDate'])) {
                    
                    $query->whereRaw("DocLog.Date >= DateDiff(day,'28 Dec 1800','" . $request->filter['startDate'] . "')");
                }
                
                if (isset($request->filter['endDate'])) {
                    
                    $query->whereRaw("DocLog.Date <= DateDiff(day,'28 Dec 1800','" . $request->filter['endDate'] . "')");
                }
            } else {
                
                $dateObject = ControllerHelper::CalculateDate($request->filter['period']);
                
                $query->whereRaw("DocLog.Date >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                
                $query->whereRaw("DocLog.Date <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
            }
        }
    }
    
    //FeeNote
    
    public static function DefaultJoinReportFeeNoteBuilder(&$query, $request)
    {
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'FeeNote.EmployeeID');
        $query->leftJoin('CostCentre', 'FeeNote.CostCentreID', '=', 'CostCentre.RecordID');
        
        $query->join('Matter', function ($join) use ($request) {
            $join->on('Matter.recordID', '=', 'FeeNote.MatterID');
            
            if ($request->filter['instructedPeriod'] === 'Today') {
                
                $calculateStartDate = date("Y-m-d");
                $calculateEndDate = date("Y-m-d");
            } else if ($request->filter['instructedPeriod'] === 'Yesterday') {
                
                $calculateStartDate = date("Y-m-d", strtotime("Yesterday"));
                $calculateEndDate = date("Y-m-d", strtotime("Yesterday"));
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday this week');
                $sunday = strtotime('sunday this week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday last week');
                $sunday = strtotime('sunday last week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("This Month"));
                $calculateEndDate = date("Y-m-t", strtotime("This Month"));
            } else if ($request->filter['instructedPeriod'] === 'Last Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("Last Month"));
                $calculateEndDate = date("Y-m-t", strtotime("Last Month"));
            } else if ($request->filter['instructedPeriod'] === 'This Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("This Year"));
                $calculateEndDate = date("Y-12-31", strtotime("This Year"));
            } else if ($request->filter['instructedPeriod'] === 'Last Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("Last Year"));
                $calculateEndDate = date("Y-12-31", strtotime("Last Year"));
            }
            
            if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
                
                if ($request->filter['instructedPeriod'] === 'Custom') {
                    
                    if (isset($request->filter['instructedStartDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedStartDate'] . "')");
                    }
                    
                    if (isset($request->filter['instructedEndDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedEndDate'] . "')");
                    }
                } else {
                    
                    $dateObject = ControllerHelper::CalculateDate($request->filter['instructedPeriod']);
                    
                    $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                    
                    $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
                }
            }
            
            if (isset($request->filter['client'])) {
                
                if ($request->filter['client'] !== 'all') {
                    $join->whereIn('Matter.ClientID', explode(",", $request->filter['client']));
                }
            }
            
            if (isset($request->filter['docgen'])) {
                
                if ($request->filter['docgen'] !== 'all') {
                    $join->whereIn('Matter.DocgenID', explode(",", $request->filter['docgen']));
                }
            }
            
            if (isset($request->filter['mattype'])) {
                
                if ($request->filter['mattype'] !== 'all') {
                    $join->whereIn('Matter.MatterTypeID', explode(",", $request->filter['mattype']));
                }
            }
            
            if (isset($request->filter['costcentre'])) {
                
                if ($request->filter['costcentre'] !== 'all') {
                    $join->whereIn('Matter.CostCentreID', explode(",", $request->filter['costcentre']));
                }
            }
            
            $join->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        });
    }
    
    public static function DefaultWhereReportFeeNoteBuilder(&$query, $request)
    {
        if ($request->filter['status'] == '1' || $request->filter['status'] == '0') {
            
            $query->where('FeeNote.PostedFlag', '=', $request->filter['status']);
        }
        
        if (isset($request->filter['flags'])) {
            if ($request->filter['flags'] == 'F' || $request->filter['flags'] == 'C' || $request->filter['flags'] == 'D') {
                
                $query->where('FeeNote.Type1', '=', $request->filter['flags']);
            }
        }
        if (isset($request->filter['childCostCentre'])) {
            
            $query->whereIn('FeeNote.CostCentreID', explode(",", $request->filter['childCostCentre']));
        }
        
        if (isset($request->filter['childEmployee'])) {
            
            $query->whereIn('FeeNote.EmployeeID', explode(",", $request->filter['childEmployee']));
        }
        
        if (isset($request->filter['period']) && strtolower($request->filter['period']) != 'all') {
            
            if ($request->filter['period'] === 'Custom') {
                
                if (isset($request->filter['startDate'])) {
                    
                    $query->whereRaw("FeeNote.Date >= DateDiff(day,'28 Dec 1800','" . $request->filter['startDate'] . "')");
                }
                
                if (isset($request->filter['endDate'])) {
                    
                    $query->whereRaw("FeeNote.Date <= DateDiff(day,'28 Dec 1800','" . $request->filter['endDate'] . "')");
                }
            } else {
                
                $dateObject = ControllerHelper::CalculateDate($request->filter['period']);
                
                $query->whereRaw("FeeNote.Date >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                
                $query->whereRaw("FeeNote.Date <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
            }
        }
    }
    
    //FileNote
    
    public static function DefaultJoinReportFileNoteBuilder(&$query, $request)
    {
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'FileNote.EmployeeID');
        
        $query->join('Matter', function ($join) use ($request) {
            $join->on('Matter.recordID', '=', 'FileNote.MatterID');
            
            if ($request->filter['instructedPeriod'] === 'Today') {
                
                $calculateStartDate = date("Y-m-d");
                $calculateEndDate = date("Y-m-d");
            } else if ($request->filter['instructedPeriod'] === 'Yesterday') {
                
                $calculateStartDate = date("Y-m-d", strtotime("Yesterday"));
                $calculateEndDate = date("Y-m-d", strtotime("Yesterday"));
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday this week');
                $sunday = strtotime('sunday this week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday last week');
                $sunday = strtotime('sunday last week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("This Month"));
                $calculateEndDate = date("Y-m-t", strtotime("This Month"));
            } else if ($request->filter['instructedPeriod'] === 'Last Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("Last Month"));
                $calculateEndDate = date("Y-m-t", strtotime("Last Month"));
            } else if ($request->filter['instructedPeriod'] === 'This Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("This Year"));
                $calculateEndDate = date("Y-12-31", strtotime("This Year"));
            } else if ($request->filter['instructedPeriod'] === 'Last Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("Last Year"));
                $calculateEndDate = date("Y-12-31", strtotime("Last Year"));
            }
            
            if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
                
                if ($request->filter['instructedPeriod'] === 'Custom') {
                    
                    if (isset($request->filter['instructedStartDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedStartDate'] . "')");
                    }
                    
                    if (isset($request->filter['instructedEndDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedEndDate'] . "')");
                    }
                } else {
                    
                    $dateObject = ControllerHelper::CalculateDate($request->filter['instructedPeriod']);
                    
                    $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                    
                    $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
                }
            }
            
            if (isset($request->filter['client'])) {
                
                if ($request->filter['client'] !== 'all') {
                    $join->whereIn('Matter.ClientID', explode(",", $request->filter['client']));
                }
            }
            
            if (isset($request->filter['docgen'])) {
                
                if ($request->filter['docgen'] !== 'all') {
                    $join->whereIn('Matter.DocgenID', explode(",", $request->filter['docgen']));
                }
            }
            
            if (isset($request->filter['mattype'])) {
                
                if ($request->filter['mattype'] !== 'all') {
                    $join->whereIn('Matter.MatterTypeID', explode(",", $request->filter['mattype']));
                }
            }
            
            if (isset($request->filter['costcentre'])) {
                
                if ($request->filter['costcentre'] !== 'all') {
                    $join->whereIn('Matter.CostCentreID', explode(",", $request->filter['costcentre']));
                }
            }
            
            $join->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        });
    }
    
    public static function DefaultWhereReportFileNoteBuilder(&$query, $request)
    {
        if ($request->filter['status'] == '1' || $request->filter['status'] == '0') {
            
            $query->where('FileNote.InternalFlag', '=', $request->filter['status']);
        }
        
        if (isset($request->filter['childEmployee'])) {
            
            $query->whereIn('FileNote.EmployeeID', explode(",", $request->filter['childEmployee']));
        }
        
        if (isset($request->filter['period']) && strtolower($request->filter['period']) != 'all') {
            
            if ($request->filter['period'] === 'Custom') {
                
                if (isset($request->filter['startDate'])) {
                    
                    $query->whereRaw("FileNote.Date >= DateDiff(day,'28 Dec 1800','" . $request->filter['startDate'] . "')");
                }
                
                if (isset($request->filter['endDate'])) {
                    
                    $query->whereRaw("FileNote.Date <= DateDiff(day,'28 Dec 1800','" . $request->filter['endDate'] . "')");
                }
            } else {
                
                $dateObject = ControllerHelper::CalculateDate($request->filter['period']);
                
                $query->whereRaw("FileNote.Date >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                
                $query->whereRaw("FileNote.Date <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
            }
        }
    }
    //FeeNotes
    public static function DefaultJoinReportToDoNoteBuilder(&$query, $request)
    {
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'ToDoNote.EmployeeID');
        
        $query->join('Matter', function ($join) use ($request) {
            $join->on('Matter.recordID', '=', 'ToDoNote.MatterID');
            
            if ($request->filter['instructedPeriod'] === 'Today') {
                
                $calculateStartDate = date("Y-m-d");
                $calculateEndDate = date("Y-m-d");
            } else if ($request->filter['instructedPeriod'] === 'Yesterday') {
                
                $calculateStartDate = date("Y-m-d", strtotime("Yesterday"));
                $calculateEndDate = date("Y-m-d", strtotime("Yesterday"));
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday this week');
                $sunday = strtotime('sunday this week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday last week');
                $sunday = strtotime('sunday last week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("This Month"));
                $calculateEndDate = date("Y-m-t", strtotime("This Month"));
            } else if ($request->filter['instructedPeriod'] === 'Last Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("Last Month"));
                $calculateEndDate = date("Y-m-t", strtotime("Last Month"));
            } else if ($request->filter['instructedPeriod'] === 'This Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("This Year"));
                $calculateEndDate = date("Y-12-31", strtotime("This Year"));
            } else if ($request->filter['instructedPeriod'] === 'Last Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("Last Year"));
                $calculateEndDate = date("Y-12-31", strtotime("Last Year"));
            }
            
            if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
                
                if ($request->filter['instructedPeriod'] === 'Custom') {
                    
                    if (isset($request->filter['instructedStartDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedStartDate'] . "')");
                    }
                    
                    if (isset($request->filter['instructedEndDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedEndDate'] . "')");
                    }
                } else {
                    
                    $dateObject = ControllerHelper::CalculateDate($request->filter['instructedPeriod']);
                    
                    $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                    
                    $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
                }
            }
            
            if (isset($request->filter['client'])) {
                
                if ($request->filter['client'] !== 'all') {
                    $join->whereIn('Matter.ClientID', explode(",", $request->filter['client']));
                }
            }
            
            if (isset($request->filter['docgen'])) {
                
                if ($request->filter['docgen'] !== 'all') {
                    $join->whereIn('Matter.DocgenID', explode(",", $request->filter['docgen']));
                }
            }
            
            if (isset($request->filter['mattype'])) {
                
                if ($request->filter['mattype'] !== 'all') {
                    $join->whereIn('Matter.MatterTypeID', explode(",", $request->filter['mattype']));
                }
            }
            
            if (isset($request->filter['costcentre'])) {
                
                if ($request->filter['costcentre'] !== 'all') {
                    $join->whereIn('Matter.CostCentreID', explode(",", $request->filter['costcentre']));
                }
            }
            
            $join->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        });
    }
    
    public static function DefaultWhereReportToDoNoteBuilder(&$query, $request)
    {
        if ($request->filter['status'] == '1' || $request->filter['status'] == '0') {
            
            $query->where('ToDoNote.InternalFlag', '=', $request->filter['status']);
        }
        
        if (isset($request->filter['childEmployee'])) {
            
            $query->whereIn('ToDoNote.EmployeeID', explode(",", $request->filter['childEmployee']));
        }
        
        if (isset($request->filter['period']) && strtolower($request->filter['period']) != 'all') {
            
            if ($request->filter['period'] === 'Custom') {
                
                if (isset($request->filter['startDate'])) {
                    
                    $query->whereRaw("ToDoNote.Date >= DateDiff(day,'28 Dec 1800','" . $request->filter['startDate'] . "')");
                }
                
                if (isset($request->filter['endDate'])) {
                    
                    $query->whereRaw("ToDoNote.Date <= DateDiff(day,'28 Dec 1800','" . $request->filter['endDate'] . "')");
                }
            } else {
                
                $dateObject = ControllerHelper::CalculateDate($request->filter['period']);
                
                $query->whereRaw("ToDoNote.Date >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                
                $query->whereRaw("ToDoNote.Date <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
            }
        }
    }
    //Employees
    
    public static function DefaultJoinReportEmployeeBuilder(&$query, $request)
    {
        
        $query->leftjoin('Matter', function ($join) use ($request) {
            $join->on('Matter.EmployeeID', '=', 'Employee.RecordID');
            
            if ($request->filter['instructedPeriod'] === 'Today') {
                
                $calculateStartDate = date("Y-m-d");
                $calculateEndDate = date("Y-m-d");
            } else if ($request->filter['instructedPeriod'] === 'Yesterday') {
                
                $calculateStartDate = date("Y-m-d", strtotime("Yesterday"));
                $calculateEndDate = date("Y-m-d", strtotime("Yesterday"));
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday this week');
                $sunday = strtotime('sunday this week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Week') {
                
                $monday = strtotime('monday last week');
                $sunday = strtotime('sunday last week');
                
                $calculateStartDate = date('Y-m-d', $monday);
                $calculateEndDate = date('Y-m-d', $sunday);
            } else if ($request->filter['instructedPeriod'] === 'This Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("This Month"));
                $calculateEndDate = date("Y-m-t", strtotime("This Month"));
            } else if ($request->filter['instructedPeriod'] === 'Last Month') {
                
                $calculateStartDate = date("Y-m-01", strtotime("Last Month"));
                $calculateEndDate = date("Y-m-t", strtotime("Last Month"));
            } else if ($request->filter['instructedPeriod'] === 'This Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("This Year"));
                $calculateEndDate = date("Y-12-31", strtotime("This Year"));
            } else if ($request->filter['instructedPeriod'] === 'Last Year') {
                
                $calculateStartDate = date("Y-01-01", strtotime("Last Year"));
                $calculateEndDate = date("Y-12-31", strtotime("Last Year"));
            }
            
            if (isset($request->filter['instructedPeriod']) && strtolower($request->filter['instructedPeriod']) != 'all') {
                
                if ($request->filter['instructedPeriod'] === 'Custom') {
                    
                    if (isset($request->filter['instructedStartDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedStartDate'] . "')");
                    }
                    
                    if (isset($request->filter['instructedEndDate'])) {
                        
                        $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $request->filter['instructedEndDate'] . "')");
                    }
                } else {
                    
                    $dateObject = ControllerHelper::CalculateDate($request->filter['instructedPeriod']);
                    
                    $join->whereRaw("Matter.DateInstructed >= DateDiff(day,'28 Dec 1800','" . $dateObject->startDate . "')");
                    
                    $join->whereRaw("Matter.DateInstructed <= DateDiff(day,'28 Dec 1800','" . $dateObject->endDate . "')");
                }
            }
            
            if (isset($request->filter['client'])) {
                
                if ($request->filter['client'] !== 'all') {
                    $join->whereIn('Matter.ClientID', explode(",", $request->filter['client']));
                }
            }
            
            if (isset($request->filter['docgen'])) {
                
                if ($request->filter['docgen'] !== 'all') {
                    $join->whereIn('Matter.DocgenID', explode(",", $request->filter['docgen']));
                }
            }
            
            if (isset($request->filter['mattype'])) {
                
                if ($request->filter['mattype'] !== 'all') {
                    $join->whereIn('Matter.MatterTypeID', explode(",", $request->filter['mattype']));
                }
            }
            
            if (isset($request->filter['costcentre'])) {
                
                if ($request->filter['costcentre'] !== 'all') {
                    $join->whereIn('Matter.CostCentreID', explode(",", $request->filter['costcentre']));
                }
            }
            
            $join->whereRaw('ISNULL(Matter.Archivestatus , 0 ) = 0');
        });
        
        $query->leftJoin('MatType', 'Matter.MatterTypeID', '=', 'MatType.RecordID')
        ->leftJoin('Docgen', 'Matter.DocgenID', '=', 'Docgen.RecordID')
        ->leftJoin('CostCentre', 'Matter.CostCentreID', '=', 'CostCentre.RecordID')
        ->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID');
    }
    
    public static function DefaultWhereReportEmployeeBuilder(&$query, $request)
    {
        
        if (isset($request->filter['employee'])) {
            
            if ($request->filter['employee'] !== 'all') {
                $query->whereIn('Employee.RecordID', explode(",", $request->filter['employee']));
            }
        }
    }
    
}
