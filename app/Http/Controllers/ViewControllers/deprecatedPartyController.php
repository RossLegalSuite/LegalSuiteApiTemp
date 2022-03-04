<?php

namespace App\Http\Controllers\ViewControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use App\Custom\ReportBuilder;
use DB;
use Illuminate\Http\Request;

class deprecatedPartyController extends Controller
{
    
    public function viewParty(Request $request)
    {
        
        $query = DB::connection('sqlsrv')
        ->table('Party');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        
        // ->addselect(DB::raw("CASE WHEN ToDoNote.CreatedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ToDoNote.CreatedTime * 10) ,0),108) ELSE '' END AS CreatedTime"))
        
        
        $query->addselect("Party.MatterPrefix")
        ->addselect("Party.Name")
        ->addselect("Party.RecordID")
        ->addselect("Party.IdentityNumber")
        ->addselect("Role.Description as Role")
        ->addselect("Entity.Description as Entity")
        ->addselect("ParType.Description as Type")
        ->addselect("Email.Number as EmailAddress")
        ->addselect("Work.Number as WorkNumber")
        ->addselect("Home.Number as HomeNumber")
        ->addselect("Cell.Number as CellNumber")
        ->addselect(DB::raw("ParLang.PhysicalLine1 + ' ' + ParLang.PhysicalLine2  + ' ' + ParLang.PhysicalLine3 + ' ' + ParLang.PhysicalCode as PhysicalAddress"))
        ->addselect(DB::raw("ParLang.PostalLine1 + ' ' + ParLang.PostalLine2  + ' ' + ParLang.PostalLine3 + ' ' + ParLang.PostalCode as PostalAddress"));
        
        
        
        $query
        ->leftJoin('ParLang', function ($join) {
            $join->on('ParLang.PartyID', '=', 'Party.RecordID')
            ->on('ParLang.LanguageID', '=', 'Party.DefaultLanguageID');
        })
        
        ->leftJoin('Role', 'Party.DefaultRoleID', '=', 'Role.RecordID')
        ->leftJoin('Entity', 'Party.EntityID', '=', 'Entity.RecordID')
        ->leftJoin('ParType', 'Party.PartyTypeID', '=', 'ParType.RecordID')
        
        ->join('Control', function ($join) {
            $join->where('Control.RecordID', '=', 1);
        })
        
        
        ->leftJoin('ParTele as Email', function ($join) {
            $join->on('Email.PartyID', '=', 'Party.RecordID')
            ->on('Email.TelephoneTypeID', '=', 'Control.EMailPhoneID')
            ->where('Email.DefaultEmailFlag', '=', 1);
        })
        
        ->leftJoin('ParTele as Work', function ($join) {
            $join->on('Work.PartyID', '=', 'Party.RecordID')
            ->on('Work.TelephoneTypeID', '=', 'Control.WorkPhoneID')
            ->where('Work.DefaultEmailFlag', '=', 1);
        })
        
        ->leftJoin('ParTele as Home', function ($join) {
            $join->on('Home.PartyID', '=', 'Party.RecordID')
            ->on('Home.TelephoneTypeID', '=', 'Control.HomePhoneID')
            ->where('Home.DefaultEmailFlag', '=', 1);
        })
        
        ->leftJoin('ParTele as Cell', function ($join) {
            $join->on('Cell.PartyID', '=', 'Party.RecordID')
            ->on('Cell.TelephoneTypeID', '=', 'Control.CellPhoneID')
            ->where('Cell.DefaultEmailFlag', '=', 1);
        });
        
        $query->where('Party.RecordID', $request->id);
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
        
    }
    
    public function getPartyTelephones(Request $request)
    {
        
        $query = DB::connection('sqlsrv')
        ->table('ParTele');
        
        QueryBuilder::QueryBuilder($query, $request);
        
        
        $query->addselect("ParTele.Number")
        ->addselect("TeleType.Description as Type");
        
        
        $query->leftJoin('TeleType', 'ParTele.TelephoneTypeID', '=', 'TeleType.RecordID');
        
        $query ->where('ParTele.PartyID', $request->id);
        
        
        
        if ($request->input('method')) {
            
            return ControllerHelper::MethodHelper($query, $request);
            
        }
        
        return ControllerHelper::DataFormatHelper($query, $request);
    }
    
    
}