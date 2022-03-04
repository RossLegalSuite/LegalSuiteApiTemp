<?php

namespace App\Custom;

use Illuminate\Support\Facades\DB;

class QueryBuilder
{

    public static function MatterSelectBuilder(&$query)
    {
        try {
            /*
            $query->addselect("Matter.*")
            ->addselect("Employee.Name as EmployeeName")
            ->addselect("Party.Name as PartyName")
            ->addselect("Party.MatterPrefix as PartyMatterPrefix")
            ->addselect("MatType.Description AS MatTypeDescription")
            ->addselect("Docgen.Description AS DocGenDescription")
            ->addselect("CostCentre.Description AS CostCentreDescription")
            ->addselect("PlanOfAction.Description AS PlanOfActionDescription")
            ->addselect("Branch.Description AS BranchDescription")
            ->addselect("StageGroup.Description AS StageGroupDescription")
            ->addselect("ClientFeeSheet.Description AS ClientFeeSheetDescription")
            ->addselect("DebtorFeeSheet.Description AS DebtorFeeSheetDescription")
            ->addselect("DocumentLanguage.Description AS DocumentLanguageDescription")
            ->addselect("AccountsLanguage.Description AS AccountsLanguageDescription")
            ->addselect("TrustBank.Description AS TrustBankDescription")
            ->addselect("BusinessBank.Description AS BusinessBankDescription")
            ->addselect("IncomeAccount.Description AS IncomeAccountDescription")
            ->addselect("BillingRate.Description AS BillingRateDescription")
            ->addselect("InvoiceParty.Name AS InvoicePartyName")
            ->addSelect("DocScrn.Description as ExtraScreenDescription")
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.DateInstructed,0) = 0 OR Matter.DateInstructed = 0 OR Matter.DateInstructed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.DateInstructed-36163 as DateTime),106) END AS FormattedDateInstructed"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.PrescriptionDate,0) = 0 OR Matter.PrescriptionDate = 0 OR Matter.PrescriptionDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.PrescriptionDate-36163 as DateTime),106) END AS FormattedPrescriptionDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.ArchiveDate,0) = 0 OR Matter.ArchiveDate = 0 OR Matter.ArchiveDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.ArchiveDate-36163 as DateTime),106) END AS FormattedArchiveDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.ImportantDate,0) = 0 OR Matter.ImportantDate = 0 OR Matter.ImportantDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.ImportantDate-36163 as DateTime),106) END AS FormattedImportantDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.InterestFrom,0) = 0 OR Matter.InterestFrom = 0 OR Matter.InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.InterestFrom-36163 as DateTime),106) END AS FormattedInterestFrom"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.UpdatedByDate,0) = 0 OR Matter.UpdatedByDate = 0 OR Matter.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.UpdatedByDate-36163 as DateTime),106) END AS FormattedUpdatedByDate"))
            ->addselect(DB::raw("CASE WHEN ISNULL(ConveyData.Step4Completed,0) = 0 OR ConveyData.Step4Completed = 0 OR ConveyData.Step4Completed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyData.Step4Completed-36163 as DateTime),106) END AS FormattedStep4Completed"))
            ->addselect(DB::raw("CASE WHEN ISNULL(ConveyData.Step6Completed,0) = 0 OR ConveyData.Step6Completed = 0 OR ConveyData.Step6Completed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyData.Step6Completed-36163 as DateTime),106) END AS FormattedStep6Completed"))
            ->addselect(DB::raw("CASE WHEN ISNULL(Matter.UpdatedByTime,0) = 0 OR Matter.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(Matter.UpdatedByTime * 10) ,0),108) END AS FormattedUpdatedByTime"))
            ->addselect(DB::raw("CASE WHEN Matter.Access = 'O' THEN 'Open to All' WHEN Matter.Access = 'V' THEN 'View Only' WHEN Matter.Access = 'R' THEN 'Restricted' ELSE 'Unspecified' END AS FormattedAccess"));
    
            */
            $query->addselect([
                "Matter.*",
                "Employee.Name as EmployeeName",
                "Party.Name as PartyName",
                "Party.MatterPrefix as PartyMatterPrefix",
                "MatType.Description AS MatTypeDescription",
                "Docgen.Description AS DocGenDescription",
                "CostCentre.Description AS CostCentreDescription",
                "PlanOfAction.Description AS PlanOfActionDescription",
                "Branch.Description AS BranchDescription",
                "StageGroup.Description AS StageGroupDescription",
                "ClientFeeSheet.Description AS ClientFeeSheetDescription",
                "DebtorFeeSheet.Description AS DebtorFeeSheetDescription",
                "DocumentLanguage.Description AS DocumentLanguageDescription",
                "AccountsLanguage.Description AS AccountsLanguageDescription",
                "TrustBank.Description AS TrustBankDescription",
                "BusinessBank.Description AS BusinessBankDescription",
                "IncomeAccount.Description AS IncomeAccountDescription",
                "BillingRate.Description AS BillingRateDescription",
                "InvoiceParty.Name AS InvoicePartyName",
                "DocScrn.Description as ExtraScreenDescription",
                DB::raw("CASE WHEN ISNULL(Matter.DateInstructed,0) = 0 OR Matter.DateInstructed = 0 OR Matter.DateInstructed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.DateInstructed-36163 as DateTime),106) END AS FormattedDateInstructed"),
                DB::raw("CASE WHEN ISNULL(Matter.PrescriptionDate,0) = 0 OR Matter.PrescriptionDate = 0 OR Matter.PrescriptionDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.PrescriptionDate-36163 as DateTime),106) END AS FormattedPrescriptionDate"),
                DB::raw("CASE WHEN ISNULL(Matter.ArchiveDate,0) = 0 OR Matter.ArchiveDate = 0 OR Matter.ArchiveDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.ArchiveDate-36163 as DateTime),106) END AS FormattedArchiveDate"),
                DB::raw("CASE WHEN ISNULL(Matter.ImportantDate,0) = 0 OR Matter.ImportantDate = 0 OR Matter.ImportantDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.ImportantDate-36163 as DateTime),106) END AS FormattedImportantDate"),
                DB::raw("CASE WHEN ISNULL(Matter.InterestFrom,0) = 0 OR Matter.InterestFrom = 0 OR Matter.InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.InterestFrom-36163 as DateTime),106) END AS FormattedInterestFrom"),
                DB::raw("CASE WHEN ISNULL(Matter.UpdatedByDate,0) = 0 OR Matter.UpdatedByDate = 0 OR Matter.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.UpdatedByDate-36163 as DateTime),106) END AS FormattedUpdatedByDate"),
                DB::raw("CASE WHEN ISNULL(ConveyData.Step4Completed,0) = 0 OR ConveyData.Step4Completed = 0 OR ConveyData.Step4Completed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyData.Step4Completed-36163 as DateTime),106) END AS FormattedStep4Completed"),
                DB::raw("CASE WHEN ISNULL(ConveyData.Step6Completed,0) = 0 OR ConveyData.Step6Completed = 0 OR ConveyData.Step6Completed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyData.Step6Completed-36163 as DateTime),106) END AS FormattedStep6Completed"),
                DB::raw("CASE WHEN ISNULL(Matter.UpdatedByTime,0) = 0 OR Matter.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(Matter.UpdatedByTime * 10) ,0),108) END AS FormattedUpdatedByTime"),
                DB::raw("CASE WHEN Matter.Access = 'O' THEN 'Open to All' WHEN Matter.Access = 'V' THEN 'View Only' WHEN Matter.Access = 'R' THEN 'Restricted' ELSE 'Unspecified' END AS FormattedAccess"),
            ]);

            


        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }

    }
    
    public static function MatterJoinBuilder(&$query)
    {

        try {

            $query
            ->leftJoin('Employee', 'Matter.EmployeeID', '=', 'Employee.RecordID')
            ->leftJoin('MatType', 'Matter.MatterTypeID', '=', 'MatType.RecordID')
            ->leftJoin('Docgen', 'Matter.DocgenID', '=', 'Docgen.RecordID')
            ->leftJoin('CostCentre', 'Matter.CostCentreID', '=', 'CostCentre.RecordID')
            ->leftJoin('Party', 'Matter.ClientID', '=', 'Party.RecordID')
            ->leftJoin('Party as InvoiceParty', 'Matter.InvoicePartyID', '=', 'InvoiceParty.RecordID')
            ->leftJoin('PlanOfAction', 'Matter.ToDoGroupID', '=', 'PlanOfAction.RecordID')
            ->leftJoin('Branch', 'Matter.BranchID', '=', 'Branch.RecordID')
            ->leftJoin('StageGroup', 'Matter.StageGroupID', '=', 'StageGroup.RecordID')
            ->leftJoin('Language as DocumentLanguage', 'Matter.DocumentLanguageID', '=', 'DocumentLanguage.RecordID')
            ->leftJoin('Language as AccountsLanguage', 'Matter.AccountsLanguageID', '=', 'AccountsLanguage.RecordID')
            ->leftJoin('ConveyData', 'Matter.RecordID', '=', 'ConveyData.MatterID')
            ->leftJoin('BondCause', 'ConveyData.BondCauseID', '=', 'BondCause.RecordID')
            ->leftJoin('FeeSheet as ClientFeeSheet', 'Matter.ClientFeeSheetID', '=', 'ClientFeeSheet.RecordID')
            ->leftJoin('FeeSheet as DebtorFeeSheet', 'Matter.DebtorFeeSheetID', '=', 'DebtorFeeSheet.RecordID')
            ->leftJoin('Docscrn', 'Matter.ExtraScreenID', '=', 'Docscrn.RecordID')
            ->leftJoin('BillingRate', 'Matter.DefaultBillingRateID', '=', 'BillingRate.RecordID')
            ->leftJoin('Business as TrustBank', 'Matter.TrustBankID', '=', 'TrustBank.RecordID')
            ->leftJoin('Business as IncomeAccount', 'Matter.IncomeAccID', '=', 'IncomeAccount.RecordID')
            // ->leftJoin('docscrn', 'Matter.extrascreenid', '=', 'docscrn.RecordID')
            ->leftJoin('Business as BusinessBank', 'Matter.BusinessBankID', '=', 'BusinessBank.RecordID');
            

        
        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }
    
    }
    
    public static function PartySelectBuilder(&$query)
    {
        
        $query->addselect([
            "Party.*",
            "Role.Description as RoleDescription",
            "Entity.Description as EntityDescription",
            "Entity.JuristicFlag as EntityJuristicFlag",
            "Entity.Category as EntityCategory",
            "ParType.Description as ParTypeDescription",
            "ParType.Category as ParTypeCategory",
            "Email.Number as EmailAddress",
            "Work.Number as WorkNumber",
            "Home.Number as HomeNumber",
            "Cell.Number as CellNumber",
            "Role.RoleScrnFlag as RoleScrnFlag",
            "Role.RoleScrnId as RoleScrnId",
            "physicalCountry.Description as physicalCountryDescription",
            "postalCountry.Description as postalCountryDescription",
            "Language.Description as defaultLanguageDescription",
            "BillingMatter.FileRef as billingMatterFileRef",
            "BillingMatter.Description as billingmatterDescription",
            DB::raw("CASE WHEN ISNULL(Party.LastContactDate,0) = 0 OR Party.LastContactDate = 0 OR Party.LastContactDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastContactDate-36163 as DateTime),106) END AS FormattedLastContactDate"),
            DB::raw("CASE WHEN ISNULL(Party.UpdatedByDate,0) = 0 OR Party.UpdatedByDate = 0 OR Party.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.UpdatedByDate-36163 as DateTime),106) END AS FormattedUpdatedByDate"),
            DB::raw("CASE WHEN ISNULL(Party.LastInstructedDate,0) = 0 OR Party.LastInstructedDate = 0 OR Party.LastInstructedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastInstructedDate-36163 as DateTime),106) END AS FormattedLastInstructedDate"),
            DB::raw("CASE WHEN ISNULL(Party.LastBirthdayEventDate,0) = 0 OR Party.LastBirthdayEventDate = 0 OR Party.LastBirthdayEventDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastBirthdayEventDate-36163 as DateTime),106) END AS FormattedLastBirthdayEventDate"),
            DB::raw("CASE WHEN ISNULL(Party.FicaRequestDate,0) = 0 OR Party.FicaRequestDate = 0 OR Party.FicaRequestDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.FicaRequestDate-36163 as DateTime),106) END AS FormattedFicaRequestDate"),
            DB::raw("CASE WHEN ISNULL(Party.CreatedDate,0) = 0 OR Party.CreatedDate = 0 OR Party.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"),
            DB::raw("CASE WHEN ISNULL(Party.DateResolutionSigned,0) = 0 OR Party.DateResolutionSigned = 0 OR Party.DateResolutionSigned > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.DateResolutionSigned-36163 as DateTime),106) END AS FormattedDateResolutionSigned"),
            DB::raw("ParLang.PhysicalLine1 + ' ' + ParLang.PhysicalLine2  + ' ' + ParLang.PhysicalLine3 + ' ' + ParLang.PhysicalCode as PhysicalAddress"),
            DB::raw("ParLang.PostalLine1 + ' ' + ParLang.PostalLine2  + ' ' + ParLang.PostalLine3 + ' ' + ParLang.PostalCode as PostalAddress"),
            DB::raw("CASE WHEN ISNULL(party.UpdatedByTime,0) = 0 OR party.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(party.UpdatedByTime * 10) ,0),108) END AS FormattedUpdatedByTime"),
            DB::raw("CASE WHEN ISNULL(party.CreatedTime,0) = 0 OR party.CreatedTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(party.CreatedTime * 10) ,0),108) END AS FormattedCreatedTime"),
        ]);

        /*$query->addselect("Party.*")
        
        ->addselect("Role.Description as RoleDescription")
        ->addselect("Entity.Description as EntityDescription")
        ->addselect("Entity.JuristicFlag as EntityJuristicFlag")
        ->addSelect("Entity.Category as EntityCategory")
        ->addselect("ParType.Description as ParTypeDescription")
        ->addSelect("ParType.Category as ParTypeCategory")
        ->addselect("Email.Number as EmailAddress")
        ->addselect("Work.Number as WorkNumber")
        ->addselect("Home.Number as HomeNumber")
        ->addselect("Cell.Number as CellNumber")
        ->addSelect("Role.RoleScrnFlag as RoleScrnFlag")
        ->addSelect("Role.RoleScrnId as RoleScrnId")
        ->addSelect("physicalCountry.Description as physicalCountryDescription")
        ->addSelect("postalCountry.Description as postalCountryDescription")
        ->addSelect("Language.Description as defaultLanguageDescription")
        ->addSelect("BillingMatter.FileRef as billingMatterFileRef")
        ->addSelect("BillingMatter.Description as billingmatterDescription")

        ->addselect(DB::raw("CASE WHEN ISNULL(Party.LastContactDate,0) = 0 OR Party.LastContactDate = 0 OR Party.LastContactDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastContactDate-36163 as DateTime),106) END AS FormattedLastContactDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Party.UpdatedByDate,0) = 0 OR Party.UpdatedByDate = 0 OR Party.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.UpdatedByDate-36163 as DateTime),106) END AS FormattedUpdatedByDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Party.LastInstructedDate,0) = 0 OR Party.LastInstructedDate = 0 OR Party.LastInstructedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastInstructedDate-36163 as DateTime),106) END AS FormattedLastInstructedDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Party.LastBirthdayEventDate,0) = 0 OR Party.LastBirthdayEventDate = 0 OR Party.LastBirthdayEventDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastBirthdayEventDate-36163 as DateTime),106) END AS FormattedLastBirthdayEventDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Party.FicaRequestDate,0) = 0 OR Party.FicaRequestDate = 0 OR Party.FicaRequestDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.FicaRequestDate-36163 as DateTime),106) END AS FormattedFicaRequestDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Party.CreatedDate,0) = 0 OR Party.CreatedDate = 0 OR Party.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Party.DateResolutionSigned,0) = 0 OR Party.DateResolutionSigned = 0 OR Party.DateResolutionSigned > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.DateResolutionSigned-36163 as DateTime),106) END AS FormattedDateResolutionSigned"))

        ->addselect(DB::raw("ParLang.PhysicalLine1 + ' ' + ParLang.PhysicalLine2  + ' ' + ParLang.PhysicalLine3 + ' ' + ParLang.PhysicalCode as PhysicalAddress"))
        ->addselect(DB::raw("ParLang.PostalLine1 + ' ' + ParLang.PostalLine2  + ' ' + ParLang.PostalLine3 + ' ' + ParLang.PostalCode as PostalAddress"))
        
        ->addselect(DB::raw("CASE WHEN ISNULL(party.UpdatedByTime,0) = 0 OR party.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(party.UpdatedByTime * 10) ,0),108) END AS FormattedUpdatedByTime"))
        ->addselect(DB::raw("CASE WHEN ISNULL(party.CreatedTime,0) = 0 OR party.CreatedTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(party.CreatedTime * 10) ,0),108) END AS FormattedCreatedTime"));*/

    }
    
    public static function PartyJoinBuilder(&$query)
    {
        
        $query->leftJoin('ParLang', function ($join) {
            $join->on('ParLang.PartyID', '=', 'Party.RecordID')
            ->on('ParLang.LanguageID', '=', 'Party.DefaultLanguageID');
        })
        ->leftJoin('Country as physicalCountry', 'party.physicalCountryId', '=', 'physicalCountry.recordid')
        ->leftJoin('Country as postalCountry', 'party.postalCountryId', '=', 'postalCountry.recordid')
        ->leftJoin('Matter as BillingMatter', 'Party.BillingMatterID', '=', 'BillingMatter.RecordID')
        ->leftJoin('Role', 'Party.DefaultRoleID', '=', 'Role.RecordID')
        ->leftJoin('Entity', 'Party.EntityID', '=', 'Entity.RecordID')
        ->leftJoin('ParType', 'Party.PartyTypeID', '=', 'ParType.RecordID')
        ->leftJoin('Language ', 'Party.DefaultLanguageID', '=', 'Language.RecordID')
        
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
            ->where('Work.Sorter', '=', 1);
        })
        ->leftJoin('ParTele as Home', function ($join) {
            $join->on('Home.PartyID', '=', 'Party.RecordID')
            ->on('Home.TelephoneTypeID', '=', 'Control.HomePhoneID')
            ->where('Home.Sorter', '=', 1);
        })
        ->leftJoin('ParTele as Cell', function ($join) {
            $join->on('Cell.PartyID', '=', 'Party.RecordID')
            ->on('Cell.TelephoneTypeID', '=', 'Control.CellPhoneID')
            ->where('Cell.Sorter', '=', 1);
        });
    }

    public static function MatPartySelectBuilder(&$query)
    {
        
        $query->addselect("MatParty.*")
        ->addselect("Party.Name AS PartyName")
        ->addselect("Contact.Name AS ContactName")
        ->addselect("Contact.RecordID AS ContactRecordID")
        ->addselect("Role.Description as RoleDescription")
        ->addSelect("Language.Description as languageDescription")
        ->addselect("Email.Number as EmailAddress")
        ->addselect("Work.Number as WorkNumber")
        ->addselect("Home.Number as HomeNumber")
        ->addselect("Cell.Number as CellNumber");

    }
    
    public static function MatPartyJoinBuilder(&$query)
    {
        
        $query->leftJoin('Party', 'MatParty.PartyID', '=', 'Party.RecordID')

        ->leftJoin('Party AS Contact', 'Contact.RecordID', '=', 'MatParty.ContactID')
        ->leftJoin('Role', 'MatParty.RoleID', '=', 'Role.RecordID')
        ->leftJoin('Language ', 'MatParty.LanguageID', '=', 'Language.RecordID')
        
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
            ->where('Work.Sorter', '=', 1);
        })
        ->leftJoin('ParTele as Home', function ($join) {
            $join->on('Home.PartyID', '=', 'Party.RecordID')
            ->on('Home.TelephoneTypeID', '=', 'Control.HomePhoneID')
            ->where('Home.Sorter', '=', 1);
        })
        ->leftJoin('ParTele as Cell', function ($join) {
            $join->on('Cell.PartyID', '=', 'Party.RecordID')
            ->on('Cell.TelephoneTypeID', '=', 'Control.CellPhoneID')
            ->where('Cell.Sorter', '=', 1);
        });
    }
    
    public static function DocLogSelectBuilder(&$query)
    {
        $query->addselect("DocLog.*")

        ->addselect("Matter.FileRef")
        ->addselect("Matter.Description AS MatterDescription")
        ->addselect("Employee.Name AS EmployeeName")
        ->addselect("DocLogCategory.Description AS Category")
        
        ->addselect(DB::raw("CASE WHEN DocLog.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(Doclog.Time * 10) ,0),108) ELSE '' END AS FormattedTime"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFolder ELSE DocLog.SavedName END AS SavedName"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFrom ELSE Employee.Name END AS Sender"))
        ->addselect(DB::raw("CASE WHEN DocLog.Date > 0 THEN CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),103) ELSE '' END AS FormattedDate"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailRecipients ELSE '' END AS SentTo"))
        ->addselect(DB::raw("CASE WHEN DocLog.Direction = 1 THEN 'Outgoing' WHEN DocLog.Direction = 2 THEN 'Incoming' ELSE 'Not Applicable' END AS Direction"));
        
    }
    
    public static function DocLogJoinBuilder(&$query)
    {
        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'DocLog.MatterID')
        ->leftJoin('DocLogCategory', 'DocLog.DocLogCategoryID', '=', 'DocLogCategory.RecordID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'DocLog.EmployeeID');
        
    }
    
    public static function DocgenSelectBuilder(&$query)
    {
        $query->addselect("DocGen.*")
        ->addselect("ToDoGroup.Description AS ToDoGroupDescription");
        
    }
    
    public static function DocgenJoinBuilder(&$query)
    {
        $query->leftJoin('ToDoGroup', 'ToDoGroup.RecordID', '=', 'DocGen.ToDoGroupID');
        
    }
    
    public static function MatTypeSelectBuilder(&$query)
    {
        $query->addselect("MatType.*")
        ->addselect("FeeSheet.Description AS FeeSheetDescription");
        
    }
    
    public static function MatTypeJoinBuilder(&$query)
    {
        $query->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'MatType.FeeSheetID');
        
    }
    

    public static function BranchSelectBuilder(&$query)
    {
        $query->addselect("Branch.*")
        ->addselect("Business.RecordID AS BusinessBankID")
        ->addselect("Business.Description AS BusinessBankDescription")
        ->addselect("Trust.RecordID AS TrustBankID")
        ->addselect("Trust.Description AS TrustBankDescription");

    }
    
    public static function BranchJoinBuilder(&$query)
    {
        $query->leftJoin('Business', 'Business.RecordID', '=', 'Branch.BusinessBankID')
        ->leftJoin('Business as Trust', 'Trust.RecordID', '=', 'Branch.TrustBankID');

    }


    public static function ToDoNoteSelectBuilder(&$query)
    {
        $query->addselect("ToDoNote.*")
        
        
        ->addselect("Matter.FileRef")
        ->addselect("Matter.Description AS MatterDescription")

        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.Date,0) = 0 OR ToDoNote.Date = 0 OR ToDoNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) END AS FormattedDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 OR ToDoNote.DateDone = 0 OR ToDoNote.DateDone > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),106) END AS FormattedDateDone"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.AutoNotifyDate,0) = 0 OR ToDoNote.AutoNotifyDate = 0 OR ToDoNote.AutoNotifyDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.AutoNotifyDate-36163 as DateTime),106) END AS FormattedAutoNotifyDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.CreatedDate,0) = 0 OR ToDoNote.CreatedDate = 0 OR ToDoNote.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateAdjustment,0) = 0 OR ToDoNote.DateAdjustment = 0 OR ToDoNote.DateAdjustment > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.DateAdjustment-36163 as DateTime),106) END AS FormattedDateAdjustment"))

        ->addselect(DB::raw("CASE WHEN ToDoNote.CreatedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ToDoNote.CreatedTime * 10) ,0),108) ELSE '' END AS FormattedCreatedTime"))
        ->addselect("Employee.Name AS EmployeeName")
        ->addselect("CreatedBy.Name AS CreatedByEmployee")
        ->addselect("CompletedBy.Name AS CompletedByEmployee");
        
    }
    
    public static function ToDoNoteJoinBuilder(&$query)
    {
        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'ToDoNote.MatterID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'ToDoNote.EmployeeID')
        ->leftJoin('Employee as CreatedBy', 'CreatedBy.RecordID', '=', 'ToDoNote.CreatedByID')
        ->leftJoin('Employee as CompletedBy', 'CompletedBy.RecordID', '=', 'ToDoNote.CompletedByID');
        
    }
    
    public static function FeeNoteSelectBuilder(&$query)
    {
        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();
        
        $query->addselect("FeeNote.*")
        
        ->addselect("Matter.FileRef AS MatterFileRef")
        ->addselect("Matter.Description AS MatterDescription")
        ->addselect("CostCentre.Description AS CostCentre")
        ->addselect("Employee.Name AS EmployeeName")
        ->addselect(DB::raw("FeeNote.AmountIncl - FeeNote.VatAmount AS AmountExcl"))

        ->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.Date,0) = 0 OR FeeNote.Date = 0 OR FeeNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),106) END AS FormattedDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.PostedDate,0) = 0 OR FeeNote.PostedDate = 0 OR FeeNote.PostedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.PostedDate-36163 as DateTime),106) END AS FormattedPostedDate"))

        ->addselect(DB::raw("CASE WHEN FeeNote.VatRate = '1' THEN '" . $control->VatPercent1 . "%'
        WHEN FeeNote.VatRate = '2' THEN '" . $control->VatPercent2 . "%'
        WHEN FeeNote.VatRate = '3' THEN '" . $control->VatPercent3 . "%'
        WHEN FeeNote.VatRate = 'N' THEN 'No Vat'
        WHEN FeeNote.VatRate = 'E' THEN 'Exempt'
        WHEN FeeNote.VatRate = 'Z' THEN 'Zero Rated'
        ELSE 'Unknown' END AS VatRate"));
        
        // ->addselect(DB::raw("CASE WHEN FeeNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),103) ELSE '' END AS 'Date'"))
        
    }
    
    public static function FeeNoteJoinBuilder(&$query)
    {
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'FeeNote.EmployeeID')
        ->leftJoin('CostCentre', 'FeeNote.CostCentreID', '=', 'CostCentre.RecordID')
        ->leftJoin('Matter', 'Matter.recordID', '=', 'FeeNote.MatterID');
        
    }
    
    public static function FileNoteSelectBuilder(&$query)
    {
        $query->addselect("FileNote.*")
        
        ->addselect("Matter.FileRef")
        ->addselect("Matter.Description AS MatterDescription")
        ->addselect("Employee.Name AS EmployeeName")
        ->addselect("CreatedByEmployee.Name AS CreatedByEmployee")
        
        ->addselect(DB::raw("CASE WHEN ISNULL(FileNote.Date,0) = 0 OR FileNote.Date = 0 OR FileNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),106) END AS FormattedDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(FileNote.AutoNotifyDate,0) = 0 OR FileNote.AutoNotifyDate = 0 OR FileNote.AutoNotifyDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FileNote.AutoNotifyDate-36163 as DateTime),106) END AS FormattedAutoNotifyDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(FileNote.CreatedDate,0) = 0 OR FileNote.CreatedDate = 0 OR FileNote.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),106) END AS FormattedCreatedDate"))

        // ->addselect(DB::raw("CASE WHEN FileNote.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.Time * 10) ,0),108) ELSE '' END AS FormattedTime"))
        ->addselect(DB::raw("CASE WHEN ISNULL(filenote.Time,0) = 0 OR filenote.Time = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(filenote.Time * 10) ,0),108) END AS FormattedTime"))
        ->addselect(DB::raw("CASE WHEN ISNULL(filenote.CreatedTime,0) = 0 OR filenote.CreatedTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(filenote.CreatedTime * 10) ,0),108) END AS FormattedCreatedTime"))

        ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Code,'') = '' THEN '' ELSE Stage.Code END AS StageCode"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Description,'') = '' THEN '' ELSE Stage.Description END AS StageDescription"));
        

    }
    
    public static function FileNoteJoinBuilder(&$query)
    {
        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'FileNote.MatterID')
        ->leftJoin('Stage', 'Stage.RecordID', '=', 'FileNote.StageID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'FileNote.EmployeeID')
        ->leftjoin('Employee as CreatedByEmployee', 'FileNote.CreatedBy', '=', 'CreatedByEmployee.RecordID');
        
    }
    
    // public static function MatPartySelectBuilder(&$query)
    // {
    //     $query->addselect("MatParty.*")
        
        
    //     ->addselect("Party.Name as PartyName")
    //     ->addselect("Matter.FileRef as MatterFileRef")
    //     ->addselect("Role.Description as RoleDescription")
    //     ->addselect("PartyContact.Name AS PartyContactName");
    //     // ->addselect(DB::raw("CASE WHEN MatParty.Sorter <> 1 THEN Role.Description + ' (' + CAST(MatParty.Sorter AS VarChar(10)) + ')' ELSE Role.Description END AS Role"))
        
    // }
    
    // public static function MatPartyJoinBuilder(&$query)
    // {
    //     $query->leftJoin('Party AS PartyContact', 'PartyContact.RecordID', '=', 'MatParty.ContactID')
    //     ->leftJoin('Matter', 'MatParty.MatterID', '=', 'Matter.RecordID')
    //     ->leftJoin('Party', 'MatParty.PartyID', '=', 'Party.RecordID')
    //     ->leftJoin('Role', 'MatParty.RoleID', '=', 'Role.RecordID');
        
    // }
    
    public static function StageSelectBuilder(&$query)
    {
        $query->addselect("Stage.*")
        ->addselect("StageGroup.Description as StageGroupDescription");
        
    }
    
    public static function StageJoinBuilder(&$query)
    {
        $query->leftJoin('StageGroup', 'Stage.StageGroupID', '=', 'StageGroup.RecordID');
        
    }
    
    public static function EmployeeSelectBuilder(&$query)
    {
        $query->addselect("Employee.*")
        ->addselect("CostCentre.Description as CostCentreDescription")
        ->addselect("EmpType.Description as EmpTypeDescription");
        
    }
    
    public static function EmployeeJoinBuilder(&$query)
    {
        $query->leftJoin('EmpType', 'Employee.EmployeeTypeID', '=', 'EmpType.RecordID')
        ->leftJoin('CostCentre', 'Employee.DefaultCostCentreId', '=', 'CostCentre.RecordID');
        
    }
    
    public static function BusinessSelectBuilder(&$query)
    {
        $query->addselect("Business.*")
        ->addselect(DB::raw("
        CASE WHEN Business.Type = '1' THEN 'Income'
        WHEN Business.Type = '2' THEN 'Expense'
        WHEN Business.Type = '3' THEN 'Other Expense'
        WHEN Business.Type = '4' THEN 'Owners Equity'
        WHEN Business.Type = '5' THEN 'Long Term Liability'
        WHEN Business.Type = '6' THEN 'Other Liability'
        WHEN Business.Type = '7' THEN 'Current Liability'
        WHEN Business.Type = '8' THEN 'Fixed Asset'
        WHEN Business.Type = '9' THEN 'Other Asset'
        WHEN Business.Type = '10' THEN 'Current Asset'
        WHEN Business.Type = '11' THEN 'Revenue Stamps'
        WHEN Business.Type = '12' THEN 'Petty Cash'
        WHEN Business.Type = '13' AND Business.TypeExtension IS NULL THEN 'Business Bank'
        WHEN Business.Type = '13' AND Business.TypeExtension = 1 THEN 'Business Bank (Current)'
        WHEN Business.Type = '13' AND Business.TypeExtension = 2 THEN 'Business Bank (Savings)'
        WHEN Business.Type = '13' AND Business.TypeExtension = 3 THEN 'Business Bank (Other)'
        WHEN Business.Type = '14' AND Business.TypeExtension IS NULL THEN 'Trust Bank'
        WHEN Business.Type = '14' AND Business.TypeExtension = 1 THEN 'Trust Bank S86(2)'
        WHEN Business.Type = '14' AND Business.TypeExtension = 2 THEN 'Trust Bank S86(3)'
        WHEN Business.Type = '15' THEN 'Investment S86(4)'
        WHEN Business.Type = '16' THEN 'Trust Creditor'
        ELSE '***UnKnown***' END AS TypeDescription"));
        
    }

    public static function ParTeleSelectBuilder(&$query)
    {
        $query->addselect("ParTele.*")
        ->addselect("Party.Name AS PartyName")
        ->addselect("Party.MatterPrefix as PartyMatterPrefix")
        ->addSelect("teletype.description as teleTypeDescription")
        ->addSelect("teletype.internalflag as teleTypeInternalFlag");

    }

    public static function ParTeleJoinBuilder(&$query)
    {
        $query->leftJoin('party', 'partele.partyId', '=', 'party.recordid');
        $query->leftJoin('teletype', 'partele.telephonetypeId', '=', 'teletype.recordid');
        
    }

    public static function ColDataSelectBuilder(&$query)
    {

        $query->addselect("ColData.*")
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.AODDate,0) = 0 OR ColData.AODDate = 0 OR ColData.AODDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.AODDate-36163 as DateTime),106) END AS FormattedAODDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOInterestTo,0) = 0 OR ColData.EMOInterestTo = 0 OR ColData.EMOInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOInterestTo-36163 as DateTime),106) END AS FormattedEMOInterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CCJInterestTo,0) = 0 OR ColData.CCJInterestTo = 0 OR ColData.CCJInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CCJInterestTo-36163 as DateTime),106) END AS FormattedCCJInterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CCJInterestFrom,0) = 0 OR ColData.CCJInterestFrom = 0 OR ColData.CCJInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CCJInterestFrom-36163 as DateTime),106) END AS FormattedCCJInterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOInterestFrom,0) = 0 OR ColData.EMOInterestFrom = 0 OR ColData.EMOInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOInterestFrom-36163 as DateTime),106) END AS FormattedEMOInterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.ChequeDate,0) = 0 OR ColData.ChequeDate = 0 OR ColData.ChequeDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.ChequeDate-36163 as DateTime),106) END AS FormattedChequeDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMODate,0) = 0 OR ColData.EMODate = 0 OR ColData.EMODate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMODate-36163 as DateTime),106) END AS FormattedEMODate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOFirstDate,0) = 0 OR ColData.EMOFirstDate = 0 OR ColData.EMOFirstDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOFirstDate-36163 as DateTime),106) END AS FormattedEMOFirstDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.JudgmentDate,0) = 0 OR ColData.JudgmentDate = 0 OR ColData.JudgmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.JudgmentDate-36163 as DateTime),106) END AS FormattedJudgmentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.LODDateToRespond,0) = 0 OR ColData.LODDateToRespond = 0 OR ColData.LODDateToRespond > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LODDateToRespond-36163 as DateTime),106) END AS FormattedLODDateToRespond"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.R41LastDate,0) = 0 OR ColData.R41LastDate = 0 OR ColData.R41LastDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.R41LastDate-36163 as DateTime),106) END AS FormattedR41LastDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.R41NewDate,0) = 0 OR ColData.R41NewDate = 0 OR ColData.R41NewDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.R41NewDate-36163 as DateTime),106) END AS FormattedR41NewDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.RDJInterestFromDate,0) = 0 OR ColData.RDJInterestFromDate = 0 OR ColData.RDJInterestFromDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RDJInterestFromDate-36163 as DateTime),106) END AS FormattedRDJInterestFromDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.MOVSaleDate,0) = 0 OR ColData.MOVSaleDate = 0 OR ColData.MOVSaleDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.MOVSaleDate-36163 as DateTime),106) END AS FormattedMOVSaleDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.IMMSaleDate,0) = 0 OR ColData.IMMSaleDate = 0 OR ColData.IMMSaleDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.IMMSaleDate-36163 as DateTime),106) END AS FormattedIMMSaleDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57InterestFrom,0) = 0 OR ColData.S57InterestFrom = 0 OR ColData.S57InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57InterestFrom-36163 as DateTime),106) END AS FormattedS57InterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57InterestTo,0) = 0 OR ColData.S57InterestTo = 0 OR ColData.S57InterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57InterestTo-36163 as DateTime),106) END AS FormattedS57InterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57FirstPaymentDate,0) = 0 OR ColData.S57FirstPaymentDate = 0 OR ColData.S57FirstPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57FirstPaymentDate-36163 as DateTime),106) END AS FormattedS57FirstPaymentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65Date,0) = 0 OR ColData.S65Date = 0 OR ColData.S65Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65Date-36163 as DateTime),106) END AS FormattedS65Date"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65FirstPaymentDate,0) = 0 OR ColData.S65FirstPaymentDate = 0 OR ColData.S65FirstPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65FirstPaymentDate-36163 as DateTime),106) END AS FormattedS65FirstPaymentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65InterestFrom,0) = 0 OR ColData.S65InterestFrom = 0 OR ColData.S65InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65InterestFrom-36163 as DateTime),106) END AS FormattedS65InterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65InterestTo,0) = 0 OR ColData.S65InterestTo = 0 OR ColData.S65InterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65InterestTo-36163 as DateTime),106) END AS FormattedS65InterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.WRIInterestTo,0) = 0 OR ColData.WRIInterestTo = 0 OR ColData.WRIInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.WRIInterestTo-36163 as DateTime),106) END AS FormattedWRIInterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REWRIInterestTo,0) = 0 OR ColData.REWRIInterestTo = 0 OR ColData.REWRIInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REWRIInterestTo-36163 as DateTime),106) END AS FormattedREWRIInterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.RES65InterestTo,0) = 0 OR ColData.RES65InterestTo = 0 OR ColData.RES65InterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RES65InterestTo-36163 as DateTime),106) END AS FormattedRES65InterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOInterestTo,0) = 0 OR ColData.REEMOInterestTo = 0 OR ColData.REEMOInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOInterestTo-36163 as DateTime),106) END AS FormattedREEMOInterestTo"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.WRIInterestFrom,0) = 0 OR ColData.WRIInterestFrom = 0 OR ColData.WRIInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.WRIInterestFrom-36163 as DateTime),106) END AS FormattedWRIInterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REWRIInterestFrom,0) = 0 OR ColData.REWRIInterestFrom = 0 OR ColData.REWRIInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REWRIInterestFrom-36163 as DateTime),106) END AS FormattedREWRIInterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.RES65InterestFrom,0) = 0 OR ColData.RES65InterestFrom = 0 OR ColData.RES65InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RES65InterestFrom-36163 as DateTime),106) END AS FormattedRES65InterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOInterestFrom,0) = 0 OR ColData.REEMOInterestFrom = 0 OR ColData.REEMOInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOInterestFrom-36163 as DateTime),106) END AS FormattedREEMOInterestFrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CourtDate,0) = 0 OR ColData.CourtDate = 0 OR ColData.CourtDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CourtDate-36163 as DateTime),106) END AS FormattedCourtDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.ApplicationDate,0) = 0 OR ColData.ApplicationDate = 0 OR ColData.ApplicationDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.ApplicationDate-36163 as DateTime),106) END AS FormattedApplicationDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.PaymentDate,0) = 0 OR ColData.PaymentDate = 0 OR ColData.PaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PaymentDate-36163 as DateTime),106) END AS FormattedPaymentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.LastInstallmentDate,0) = 0 OR ColData.LastInstallmentDate = 0 OR ColData.LastInstallmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LastInstallmentDate-36163 as DateTime),106) END AS FormattedLastInstallmentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.NextInstallmentDate,0) = 0 OR ColData.NextInstallmentDate = 0 OR ColData.NextInstallmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NextInstallmentDate-36163 as DateTime),106) END AS FormattedNextInstallmentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.PTPStartDate,0) = 0 OR ColData.PTPStartDate = 0 OR ColData.PTPStartDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PTPStartDate-36163 as DateTime),106) END AS FormattedPTPStartDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.NewInDuplumRuleFromDate,0) = 0 OR ColData.NewInDuplumRuleFromDate = 0 OR ColData.NewInDuplumRuleFromDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NewInDuplumRuleFromDate-36163 as DateTime),106) END AS FormattedNewInDuplumRuleFromDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOReturnOfServiceDate,0) = 0 OR ColData.EMOReturnOfServiceDate = 0 OR ColData.EMOReturnOfServiceDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOReturnOfServiceDate-36163 as DateTime),106) END AS FormattedEMOReturnOfServiceDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOReturnOfServiceDate,0) = 0 OR ColData.REEMOReturnOfServiceDate = 0 OR ColData.REEMOReturnOfServiceDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOReturnOfServiceDate-36163 as DateTime),106) END AS FormattedREEMOReturnOfServiceDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOEndDate,0) = 0 OR ColData.EMOEndDate = 0 OR ColData.EMOEndDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOEndDate-36163 as DateTime),106) END AS FormattedEMOEndDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.FeesUntilDate,0) = 0 OR ColData.FeesUntilDate = 0 OR ColData.FeesUntilDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.FeesUntilDate-36163 as DateTime),106) END AS FormattedFeesUntilDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CommissionUntilDate,0) = 0 OR ColData.CommissionUntilDate = 0 OR ColData.CommissionUntilDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CommissionUntilDate-36163 as DateTime),106) END AS FormattedCommissionUntilDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.LastPaymentDate,0) = 0 OR ColData.LastPaymentDate = 0 OR ColData.LastPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LastPaymentDate-36163 as DateTime),106) END AS FormattedLastPaymentDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.NextPaymentDate,0) = 0 OR ColData.NextPaymentDate = 0 OR ColData.NextPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NextPaymentDate-36163 as DateTime),106) END AS FormattedNextPaymentDate"));

    }

    public static function ParFicaSelectBuilder(&$query)
    {
        $query->addselect("ParFica.*")
        ->addselect(DB::raw("CASE WHEN ISNULL(ParFica.Date,0) = 0 OR ParFica.Date = 0 OR ParFica.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParFica.Date-36163 as DateTime),106) END AS FormattedDate"))
        
        ->addSelect("ficaitem.RecordID")
        ->addSelect("ficaitem.Description")
        ->addSelect("ficaitem.Comments as FicaItemComments")
        ->addSelect("ficaitem.Expiry")
        ->addselect("EntityFica.EntityID")
        ->addselect("EntityFica.FicaItemID");

    }

    public static function ParFicaJoinBuilder(&$query)
    {
        $query->leftJoin('FicaItem', 'ParFica.FicaItemID', '=', 'FicaItem.RecordId')
        ->leftJoin('EntityFica', 'EntityFica.FicaItemID', '=', 'FicaItem.RecordId');
        
    }

    public static function ParLangSelectBuilder(&$query)
    {
        $query->addSelect("ParLang.*")
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.GPASignedOn,0) = 0 OR ParLang.GPASignedOn = 0 OR ParLang.GPASignedOn > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.GPASignedOn-36163 as DateTime),106) END AS FormattedGPASignedOn"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.BirthDate,0) = 0 OR ParLang.BirthDate = 0 OR ParLang.BirthDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.BirthDate-36163 as DateTime),106) END AS FormattedBirthDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.SpouseBirthDate,0) = 0 OR ParLang.SpouseBirthDate = 0 OR ParLang.SpouseBirthDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.SpouseBirthDate-36163 as DateTime),106) END AS FormattedSpouseBirthDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.MarriageDate,0) = 0 OR ParLang.MarriageDate = 0 OR ParLang.MarriageDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.MarriageDate-36163 as DateTime),106) END AS FormattedMarriageDate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.TrustDate,0) = 0 OR ParLang.TrustDate = 0 OR ParLang.TrustDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.TrustDate-36163 as DateTime),106) END AS FormattedTrustDate"));


    }

    public static function ParRelSelectBuilder(&$query)
    {
        $query->addselect("ParRel.*")
        ->addSelect("DocFoxRelationship.DocFoxId")
        ->addSelect("Relationship.Description as Relationship")
        ->addSelect("Party.Name as PartyName")
        ->addSelect("Party.MatterPrefix as PartyMatterPrefix");

    }

    public static function ParRelJoinBuilder(&$query)
    {
        $query->leftJoin('Relationship', 'Relationship.RecordID ', '=', 'ParRel.RelationshipID')
        ->leftJoin('Party ', 'Party.RecordID ', '=', 'ParRel.OtherPartyID')
        ->leftJoin('DocFoxRelationship', function ($join) {
            $join->on('DocFoxRelationship.ParentPartyID', '=', 'ParRel.PartyId')
            ->on('DocFoxRelationship.RelatedPartyID', '=', 'ParRel.OtherPartyID');
        });
        
    }
    
    public static function MatGroupSelectBuilder(&$query)
    {
        $query->addselect("MatGroup.*")
        // ->addselect("Grouping.recordid as GroupingRecordID")
        ->addselect("Grouping.description as GroupingDescription");
        
    }
    
    public static function MatGroupJoinBuilder(&$query)
    {
        $query->leftJoin('Grouping', 'MatGroup.GroupID ', '=', 'Grouping.RecordID');
    }

    public static function ConveyDataSelectBuilder(&$query)
    {
        $query->addselect("ConveyData.*")
        // ->addselect("Grouping.recordid as GroupingRecordID")
        ->addselect("bondcause.description as bondcausedescription");
        
    }
    
    public static function ConveyDataJoinBuilder(&$query)
    {
        $query->leftJoin('bondcause', 'ConveyData.bondcauseid ', '=', 'bondcause.RecordID');
    }

    public static function ParFieldSelectBuilder(&$query)
    {
        $query->addselect("ParField.*")
        ->addselect("DocScrn.*");    
        
    }
    
    public static function ParFieldJoinBuilder(&$query)
    {
        $query->join('DocScrn', 'ParField.DocScreenID ', '=', 'DocScrn.RecordID');
    }

    public static function ParRolScSelectBuilder(&$query)
    {
        $query->addselect("ParRolSc.*")
        ->addselect("DocScrn.*");    
        
    }
    
    public static function ParRolScJoinBuilder(&$query)
    {
        $query->join('DocScrn', 'ParRolSc.RoleScreenID ', '=', 'DocScrn.RecordID');
    }

    public static function MatDocScSelectBuilder(&$query)
    {
        $query->addselect("MatDocSc.*")
        ->addselect("DocScrn.*");
        
    }

    public static function MatDocScJoinBuilder(&$query)
    {
        $query->join('DocScrn', 'Docscrn.recordid', '=', 'MatDocSc.DocScreenID');
    }


}
                