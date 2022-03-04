<?php

namespace App\Custom;

use Illuminate\Support\Facades\DB;

class SelectAndJoinBuilder
{

    public static function matterSelectBuilder(&$query)
    {

            $query->addselect([
                "Matter.recordid",
                "Matter.fileref",
                "Matter.description",
                "Matter.clientid",
                "Matter.docgenid",
                "Matter.mattertypeid",
                "Matter.documentlanguageid",
                "Matter.employeeid",
                "Matter.bankid",
                "Matter.extrascreenid",
                "Matter.billtypeid",
                "Matter.counselusedflag",
                "Matter.filecabinet",
                "Matter.archiveflag",
                "Matter.discount",
                "Matter.prescriptiondate",
                "Matter.casenumber",
                "Matter.access",
                "Matter.theirref",
                "Matter.contact",
                "Matter.salutation",
                "Matter.oldcode",
                "Matter.dateinstructed",
                "Matter.internalcomment",
                "Matter.accountcomment",
                "Matter.clientfeesheetid",
                "Matter.accountslanguageid",
                "Matter.status",
                "Matter.feeestimate",
                "Matter.feenotesonhold",
                "Matter.claimamount",
                "Matter.interestrate",
                "Matter.interestfrom",
                "Matter.agentflag",
                "Matter.adminfeeflag",
                "Matter.interestflag",
                "Matter.vatexemptflag",
                "Matter.discountsurcharge",
                "Matter.receiptoption",
                "Matter.invoiceflag",
                "Matter.invoiceoption",
                "Matter.invoiceoutput",
                "Matter.lastinvoiceno",
                "Matter.lastinvoicedate",
                "Matter.lastinvoiceactual",
                "Matter.lastinvoicereserved",
                "Matter.lastinvoiceinvested",
                "Matter.actual",
                "Matter.reserved",
                "Matter.invested",
                "Matter.agecurrent",
                "Matter.age30day",
                "Matter.age60day",
                "Matter.age90day",
                "Matter.age120day",
                "Matter.age150day",
                "Matter.age180day",
                "Matter.transfer",
                "Matter.totalfeesoutstanding",
                "Matter.periodfeesreceipted",
                "Matter.totalfees",
                "Matter.totaldisbursements",
                "Matter.totalreceipts",
                "Matter.totalpayments",
                "Matter.totaltransfered",
                "Matter.feesthisyear",
                "Matter.feeslastyear",
                "Matter.interestdue",
                "Matter.vatprovision",
                "Matter.batchednormal",
                "Matter.batchedreserved",
                "Matter.batchedinvested",
                "Matter.consolidateid",
                "Matter.consolidatedflag",
                "Matter.costcentreid",
                "Matter.overrideincomeaccflag",
                "Matter.incomeaccid",
                "Matter.trustbankid",
                "Matter.archiveno",
                "Matter.deleteflag",
                "Matter.movementflag",
                "Matter.collcommflag",
                "Matter.collcommoption",
                "Matter.collcommpercent",
                "Matter.collcommlimit",
                "Matter.movementperiod",
                "Matter.adminfeeperiod",
                "Matter.postingid",
                "Matter.batchid",
                "Matter.transid",
                "Matter.lineid",
                "Matter.debtorsbalance",
                "Matter.receiptamount",
                "Matter.debtorstotalreceipts",
                "Matter.debtorstotalcosts",
                "Matter.debtorstotalinterest",
                "Matter.interestcompoundedflag",
                "Matter.interestoncostsflag",
                "Matter.debtorpaymentamount",
                "Matter.debtorpaymentday",
                "Matter.unconsolidatedactual",
                "Matter.unconsolidatedreserved",
                "Matter.matterinvestmentid",
                "Matter.transferdisb",
                "Matter.loddate",
                "Matter.summonsdate",
                "Matter.returnofservicedate",
                "Matter.rdjdate",
                "Matter.judgmentdate",
                "Matter.writdate",
                "Matter.s65date",
                "Matter.debtorsopeningbalance",
                "Matter.totalconsolidatedmatters",
                "Matter.todogroupid",
                "Matter.interestenddate",
                "Matter.emodate",
                "Matter.dateofdebt",
                "Matter.totaljournal",
                "Matter.compoundinterestoption",
                "Matter.totaldrtrust",
                "Matter.totalcrtrust",
                "Matter.totaldrbusiness",
                "Matter.totalcrbusiness",
                "Matter.sheriffareaid",
                "Matter.interestperiod",
                "Matter.storagelocation",
                "Matter.storagenumber",
                "Matter.storagedate",
                "Matter.storagetakenoutby",
                "Matter.storagetakenoutdate",
                "Matter.storagereturndate",
                "Matter.debtorfeesheetid",
                "Matter.businessbankid",
                "Matter.archivestatus",
                "Matter.intratescheduleid",
                "Matter.commentoption",
                "Matter.stagesreached",
                "Matter.branchflag",
                "Matter.branchid",
                "Matter.consolidatedisbursementsflag",
                "Matter.adminfeeyear",
                "Matter.interestyear",
                "Matter.investmentfeeflag",
                "Matter.totalfeesthisperiod",
                "Matter.totaldisbursementsthisperiod",
                "Matter.totalreceiptsthisperiod",
                "Matter.alternateref",
                "Matter.debtorcollcommpercent",
                "Matter.debtorcollcommlimit",
                "Matter.debtorcollcommoption",
                "Matter.exportflag",
                "Matter.createinvoiceflag",
                "Matter.totalreceiptsdebtor",
                "Matter.totalreceiptsdebtorthisperiod",
                "Matter.lastdebtorreceiptamount",
                "Matter.lastdebtorreceiptdate",
                "Matter.lastclientreceiptamount",
                "Matter.lastclientreceiptdate",
                "Matter.laststatementdate",
                "Matter.lastinvoicebatchid",
                "Matter.exportedflag",
                "Matter.debtorstotalcommission",
                "Matter.debtorstotaldebits",
                "Matter.debtorstotalcredits",
                "Matter.excludedocumentcostsflag",
                "Matter.archivedate",
                "Matter.groupid",
                "Matter.invoicepartyid",
                "Matter.interestonamount",
                "Matter.s57date",
                "Matter.totalfeescurrent",
                "Matter.totalfeespaidcurrent",
                "Matter.totalfeespaid",
                "Matter.totaldisbursementspaid",
                "Matter.totaldisbursementspaidcurrent",
                "Matter.totaldisbursementscurrent",
                "Matter.totaldisbursementsoutstandingbfwd",
                "Matter.totalfeesoutstandingbfwd",
                "Matter.datewithdrawn",
                "Matter.invoiceemail",
                "Matter.stagegroupid",
                "Matter.receiptpercenttocosts",
                "Matter.agreedfeepercent",
                "Matter.debtorscapitalbalance",
                "Matter.debtorscostsbalance",
                "Matter.debtorsinterestbalance",
                "Matter.weblinkbankref",
                "Matter.payattorneyfirstamount",
                "Matter.defaultbillingrateid",
                "Matter.lastdistributionno",
                "Matter.distributedamount",
                "Matter.coldebitfeecodeid",
                "Matter.receiptpercenttodate",
                "Matter.totalfeesbfwd",
                "Matter.totaldisbursementsbfwd",
                "Matter.totalpaymentsbfwd",
                "Matter.totalreceiptsbfwd",
                "Matter.totaljournalbfwd",
                "Matter.totaldisbursementsoutstanding",
                "Matter.lawref",
                "Matter.lawsuite",
                "Matter.ignoreinduplumflag",
                "Matter.distributiongroup",
                "Matter.importantdate",
                "Matter.invoicebfwdoption",
                "Matter.invoicefeeoption",
                "Matter.invoicedisbursementoption",
                "Matter.remarks",
                "Matter.totalfeesoutstandingly",
                "Matter.totalfeespaidthisyear",
                "Matter.totaldisbursementsoutstandingly",
                "Matter.totaldisbursementspaidthisyear",
                "Matter.invoiceformat",
                "Matter.feeestimatewarningflag",
                "Matter.updatedbyid",
                "Matter.conveyancingstatusflag",
                "Matter.messagewaitingflag",
                "Matter.fnbmatterstate",
                "Matter.updatedbydate",
                "Matter.updatedbytime",
                "Matter.ag_matterkref",
                "Matter.laststageid",
                "Matter.lawdeedid",
                "Matter.excludeunitsonaccountflag",
                "Matter.tbdate",
                "Matter.tbntudate",
                "Matter.absalinkflag",
                "Matter.absamatterstate",
                "Matter.collcommsplitflag",
                "Matter.nturequestdate",
                "Matter.ntureceivedate",
                "Matter.canceltoreassigndate",
                "Matter.ratesinstructionsource",
                "Matter.internalcommentoption",
                "Matter.cancmatterstate",
                "Matter.ag_cancmatterkref",
                "Matter.agreedfeelimit",
                "Matter.addeddefaultpartiesflag",
                "Matter.datalinksuite",
                "Matter.debtorpaymentfrequency",
                "Matter.ncaflag",
                "Matter.tdreferencenum",
                "Matter.agentpercent",
                "Matter.linkedmatterid",
                "Matter.receiptpercent",
                "Matter.lawindex",
                "Matter.noficaflag",
                "Matter.totalfeespaidlastperiod",
                "Matter.showprescriptionwarningflag",
                "Matter.consolidationoption",
                "Matter.thisinvoiceactual",
                "Matter.thisinvoicereserved",
                "Matter.thisinvoiceinvested",
                "Matter.laststagedate",
                "Matter.lifeassurance",
                "Matter.currentinstalment",

                "Party.Name as partyname",
                "Party.MatterPrefix as partymatterprefix",
                "Employee.Name as employeename",
                "MatType.Description as mattypedescription",
                "Docgen.Description as docgendescription",
                "Branch.Description as branchdescription",
                "Docgen.Code as docgencode",
                "Docgen.Type as docgentype",
                "CostCentre.Description as costcentredescription",
                "PlanOfAction.Description as planofactiondescription",
                "StageGroup.Description as stagegroupdescription",
                "ClientFeeSheet.Description as clientfeesheetdescription",
                "DebtorFeeSheet.Description as debtorfeesheetdescription",
                "DocumentLanguage.Description as documentlanguagedescription",
                "AccountsLanguage.Description as accountslanguagedescription",
                "TrustBank.Description as trustbankdescription",
                "BusinessBank.Description as businessbankdescription",
                "IncomeAccount.Description as incomeaccountdescription",
                "BillingRate.Description as billingratedescription",
                "InvoiceParty.Name as invoicepartyname",
                "DocScrn.Description as extrascreendescription",
                DB::raw("CASE WHEN ISNULL(Matter.DateInstructed,0) = 0 OR Matter.DateInstructed = 0 OR Matter.DateInstructed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.DateInstructed-36163 as DateTime),106) END as formatteddateinstructed"),
                DB::raw("CASE WHEN ISNULL(Matter.PrescriptionDate,0) = 0 OR Matter.PrescriptionDate = 0 OR Matter.PrescriptionDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.PrescriptionDate-36163 as DateTime),106) END as formattedprescriptiondate"),
                DB::raw("CASE WHEN ISNULL(Matter.ArchiveDate,0) = 0 OR Matter.ArchiveDate = 0 OR Matter.ArchiveDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.ArchiveDate-36163 as DateTime),106) END as formattedarchivedate"),
                DB::raw("CASE WHEN ISNULL(Matter.ImportantDate,0) = 0 OR Matter.ImportantDate = 0 OR Matter.ImportantDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.ImportantDate-36163 as DateTime),106) END as formattedimportantdate"),
                DB::raw("CASE WHEN ISNULL(Matter.InterestFrom,0) = 0 OR Matter.InterestFrom = 0 OR Matter.InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.InterestFrom-36163 as DateTime),106) END as formattedinterestfrom"),
                DB::raw("CASE WHEN ISNULL(Matter.UpdatedByDate,0) = 0 OR Matter.UpdatedByDate = 0 OR Matter.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.UpdatedByDate-36163 as DateTime),106) END as formattedupdatedbydate"),
                DB::raw("CASE WHEN ISNULL(ConveyData.Step4Completed,0) = 0 OR ConveyData.Step4Completed = 0 OR ConveyData.Step4Completed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyData.Step4Completed-36163 as DateTime),106) END as formattedstep4completed"),
                DB::raw("CASE WHEN ISNULL(ConveyData.Step6Completed,0) = 0 OR ConveyData.Step6Completed = 0 OR ConveyData.Step6Completed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ConveyData.Step6Completed-36163 as DateTime),106) END as formattedstep6completed"),
                DB::raw("CASE WHEN ISNULL(Matter.UpdatedByTime,0) = 0 OR Matter.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(Matter.UpdatedByTime * 10) ,0),108) END as formattedupdatedbytime"),
                DB::raw("CASE WHEN Matter.Access = 'O' THEN 'Open to All' WHEN Matter.Access = 'V' THEN 'View Only' WHEN Matter.Access = 'R' THEN 'Restricted' ELSE 'Unspecified' END as formattedaccess"),
            ]);

        
    }
    
    public static function matterJoinBuilder(&$query)
    {
        
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
        ->leftJoin('BondData', 'Matter.RecordID', '=', 'BondData.MatterID')
        ->leftJoin('ColData', 'Matter.RecordID', '=', 'ColData.MatterID')
        ->leftJoin('BondCause', 'ConveyData.BondCauseID', '=', 'BondCause.RecordID')
        ->leftJoin('FeeSheet as ClientFeeSheet', 'Matter.ClientFeeSheetID', '=', 'ClientFeeSheet.RecordID')
        ->leftJoin('FeeSheet as DebtorFeeSheet', 'Matter.DebtorFeeSheetID', '=', 'DebtorFeeSheet.RecordID')
        ->leftJoin('Docscrn', 'Matter.ExtraScreenID', '=', 'Docscrn.RecordID')
        ->leftJoin('BillingRate', 'Matter.DefaultBillingRateID', '=', 'BillingRate.RecordID')
        ->leftJoin('Business as TrustBank', 'Matter.TrustBankID', '=', 'TrustBank.RecordID')
        ->leftJoin('Business as IncomeAccount', 'Matter.IncomeAccID', '=', 'IncomeAccount.RecordID')
        ->leftJoin('Business as BusinessBank', 'Matter.BusinessBankID', '=', 'BusinessBank.RecordID');

    }

    public static function partySelectBuilder(&$query)
    {

        $query->addselect([

            "Party.recordid",
            "Party.partytypeid",
            "Party.name",
            "Party.defaultlanguageid",
            "Party.maritalstatus",
            "Party.clientflag",
            "Party.matterprefix",
            "Party.incomeytd",
            "Party.income1",
            "Party.income2",
            "Party.income3",
            "Party.income4",
            "Party.income5",
            "Party.income6",
            "Party.income7",
            "Party.income8",
            "Party.income9",
            "Party.income10",
            "Party.income11",
            "Party.income12",
            "Party.lincome1",
            "Party.lincome2",
            "Party.lincome3",
            "Party.lincome4",
            "Party.lincome5",
            "Party.lincome6",
            "Party.lincome7",
            "Party.lincome8",
            "Party.lincome9",
            "Party.lincome10",
            "Party.lincome11",
            "Party.lincome12",
            "Party.postingid",
            "Party.batchid",
            "Party.lineid",
            "Party.transid",
            "Party.oldcode",
            "Party.useoldcodeflag",
            "Party.consolidateflag",
            "Party.consolidateid",
            "Party.notes",
            "Party.identitynumber",
            "Party.notusedflag",
            "Party.expenseytd",
            "Party.expense1",
            "Party.expense2",
            "Party.expense3",
            "Party.expense4",
            "Party.expense5",
            "Party.expense6",
            "Party.expense7",
            "Party.expense8",
            "Party.expense9",
            "Party.expense10",
            "Party.expense11",
            "Party.expense12",
            "Party.lexpense1",
            "Party.lexpense2",
            "Party.lexpense3",
            "Party.lexpense4",
            "Party.lexpense5",
            "Party.lexpense6",
            "Party.lexpense7",
            "Party.lexpense8",
            "Party.lexpense9",
            "Party.lexpense10",
            "Party.lexpense11",
            "Party.lexpense12",
            "Party.extrascreenid",
            "Party.physicalcountryid",
            "Party.postalcountryid",
            "Party.vatnumber",
            "Party.parbankid",
            "Party.billingmatterid",
            "Party.weblinkbankref",
            "Party.ficacompliantflag",
            "Party.domiciliumflag",
            "Party.taxnumber",
            "Party.poanumber",
            "Party.parregionid",
            "Party.parcategoryid",
            "Party.lawref",
            "Party.spousetaxnumber",
            "Party.laststageid",
            "Party.lastcontactdate",
            "Party.lastcontactdescription",
            "Party.firstcontactdate",
            "Party.mattertakeonreminder",
            "Party.defaultroleid",
            "Party.electronicpaymentflag",
            "Party.entityid",
            "Party.remoteaccesspassword",
            "Party.remoteaccessexpiry",
            "Party.birthday",
            "Party.birthmonth",
            "Party.birthdaysmsflag",
            "Party.birthdaysmsmessage",
            "Party.internalflag",
            "Party.neverlolnotifyflag",
            "Party.legalsuitefirmcode",
            "Party.inactiveflag",
            "Party.updatedbyid",
            "Party.alternateref",
            "Party.updatedbydate",
            "Party.updatedbytime",
            "Party.lawdeedid",
            "Party.lawdeedbranchid",
            "Party.donotnotifyflag",
            "Party.lastinstructeddate",
            "Party.deedsofficedoclogid",
            "Party.taxpayer",
            "Party.saresident",
            "Party.annualincome",
            "Party.passportnumber",
            "Party.countryofresidence",
            "Party.lastbirthdayeventdate",
            "Party.auditorname",
            "Party.auditorpostal",
            "Party.auditorphysical",
            "Party.auditorphone",
            "Party.spousetaxpayer",
            "Party.spousesaresident",
            "Party.spouseannualincome",
            "Party.spousepassportnumber",
            "Party.spousecountryofresidence",
            "Party.unmarriedstatus",
            "Party.auditorfax",
            "Party.ficarequestdate",
            "Party.createdid",
            "Party.createddate",
            "Party.createdtime",
            "Party.dateresolutionsigned",
            "Party.auditorcontact",
            "Party.auditoremail",
            "Party.employername",
            "Party.employerpostal",
            "Party.employerphysical",
            "Party.employerphone",
            "Party.employerfax",
            "Party.employercontact",
            "Party.employeremail",
            "Party.noficaflag",
            "Party.identitydocumenttype",
            "Party.lockparty",
            "Party.signatoryid",
            "Party.checksum",
            "Party.docfoxid",
    

            "Role.Description as roledescription",
            "Entity.Description as entitydescription",
            "Entity.JuristicFlag as entityjuristicflag",
            "Entity.Category as entitycategory",
            "ParType.Description as partypedescription",
            "ParType.Category as partypecategory",
            "Email.Number as emailaddress",
            "Work.Number as worknumber",
            "Home.Number as homenumber",
            "Cell.Number as cellnumber",
            "Role.RoleScrnFlag as rolescrnflag",
            "Role.RoleScrnId as rolescrnid",
            "physicalCountry.Description as physicalcountrydescription",
            "postalCountry.Description as postalcountrydescription",
            "Language.Description as defaultlanguagedescription",
            "BillingMatter.FileRef as billingmatterfileref",
            "BillingMatter.Description as billingmatterdescription",

            "ParLang.PhysicalLine1 as physicalline1",
            "ParLang.PhysicalLine2 as physicalline2",
            "ParLang.PhysicalLine3 as physicalline3",
            "ParLang.PhysicalCode as physicalcode",
            "ParLang.PostalLine1 as postalline1",
            "ParLang.PostalLine2 as postalline2",
            "ParLang.PostalLine3 as postalline3",
            "ParLang.PostalCode as postalcode",

            DB::raw("CASE WHEN ISNULL(Party.LastContactDate,0) = 0 OR Party.LastContactDate = 0 OR Party.LastContactDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastContactDate-36163 as DateTime),106) END as formattedlastcontactdate"),
            DB::raw("CASE WHEN ISNULL(Party.UpdatedByDate,0) = 0 OR Party.UpdatedByDate = 0 OR Party.UpdatedByDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.UpdatedByDate-36163 as DateTime),106) END as formattedupdatedbydate"),
            DB::raw("CASE WHEN ISNULL(Party.LastInstructedDate,0) = 0 OR Party.LastInstructedDate = 0 OR Party.LastInstructedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastInstructedDate-36163 as DateTime),106) END as formattedlastinstructeddate"),
            DB::raw("CASE WHEN ISNULL(Party.LastBirthdayEventDate,0) = 0 OR Party.LastBirthdayEventDate = 0 OR Party.LastBirthdayEventDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.LastBirthdayEventDate-36163 as DateTime),106) END as formattedlastbirthdayeventdate"),
            DB::raw("CASE WHEN ISNULL(Party.FicaRequestDate,0) = 0 OR Party.FicaRequestDate = 0 OR Party.FicaRequestDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.FicaRequestDate-36163 as DateTime),106) END as formattedficarequestdate"),
            DB::raw("CASE WHEN ISNULL(Party.CreatedDate,0) = 0 OR Party.CreatedDate = 0 OR Party.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.CreatedDate-36163 as DateTime),106) END as formattedcreateddate"),
            DB::raw("CASE WHEN ISNULL(Party.DateResolutionSigned,0) = 0 OR Party.DateResolutionSigned = 0 OR Party.DateResolutionSigned > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Party.DateResolutionSigned-36163 as DateTime),106) END as formatteddateresolutionsigned"),
            DB::raw("ParLang.PhysicalLine1 + ' ' + ParLang.PhysicalLine2  + ' ' + ParLang.PhysicalLine3 + ' ' + ParLang.PhysicalCode as physicaladdress"),
            DB::raw("ParLang.PostalLine1 + ' ' + ParLang.PostalLine2  + ' ' + ParLang.PostalLine3 + ' ' + ParLang.PostalCode as postaladdress"),
            DB::raw("CASE WHEN ISNULL(party.UpdatedByTime,0) = 0 OR party.UpdatedByTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(party.UpdatedByTime * 10) ,0),108) END as formattedupdatedbytime"),
            DB::raw("CASE WHEN ISNULL(party.CreatedTime,0) = 0 OR party.CreatedTime = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(party.CreatedTime * 10) ,0),108) END as formattedcreatedtime"),
            DB::raw("CASE WHEN Party.RecordId IN (SELECT PartyID FROM MatParty WHERE RoleID = 1) THEN 1 ELSE 0 END as isclient"),
        ]);

    }

    public static function partyJoinBuilder(&$query)
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
            $join->where('Control.RecordID', 1);
        })
        
        ->leftJoin('ParTele as Email', function ($join) {
            $join->on('Email.PartyID', '=', 'Party.RecordID')
            ->on('Email.TelephoneTypeID', '=', 'Control.EMailPhoneID')
            ->where('Email.DefaultEmailFlag', '=', 1)
            ->where('Email.Sorter', '=', 1);
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

    public static function matpartySelectBuilder(&$query)
    {
        
        $query->addselect('MatParty.matterid')
        ->addselect('MatParty.partyid')
        ->addselect('MatParty.reference')
        ->addselect('MatParty.roleid')
        ->addselect('MatParty.sorter')
        ->addselect('MatParty.ratesurityindicator')
        ->addselect('MatParty.rateprimaryapplicant')
        ->addselect('MatParty.rateperminantresident')
        ->addselect('MatParty.ratecustomerrole')
        ->addselect('MatParty.notification_method_x')
        ->addselect('MatParty.rateportion_share_p')
        ->addselect('MatParty.claimamount')
        ->addselect('MatParty.distributionpercent')
        ->addselect('MatParty.distributedamount')
        ->addselect('MatParty.claimdescription')
        ->addselect('MatParty.payablefrom')
        ->addselect('MatParty.instalmentamount')
        ->addselect('MatParty.instalmentfrequency')
        ->addselect('MatParty.district')
        ->addselect('MatParty.caseno')
        ->addselect('MatParty.courtorderdetails')
        ->addselect('MatParty.payableto')
        ->addselect('MatParty.balance')
        ->addselect('MatParty.attorneyid')
        ->addselect('MatParty.claimoption')
        ->addselect('MatParty.contactid')
        ->addselect('MatParty.noflag')
        ->addselect('MatParty.nocapacity')
        ->addselect('MatParty.noprincipal')
        ->addselect('MatParty.recordid')
        ->addselect('MatParty.languageid')
        ->addselect('MatParty.paidoutbfwd')
        ->addselect('MatParty.suretyamount')
        ->addselect('MatParty.suretyunlimitedflag')
        ->addselect('MatParty.suretysecurity')
        ->addselect('MatParty.rateestatetype')
        ->addselect('MatParty.employmentstatus')
        ->addselect('MatParty.employername')
        ->addselect('MatParty.employeraddress')
        ->addselect('MatParty.employertele')
        ->addselect('MatParty.relativefullname')
        ->addselect('MatParty.relativeaddress')
        ->addselect('MatParty.relativetele')
        ->addselect('MatParty.contactrelationshipid')
        ->addselect('MatParty.partyrelationshipid')
        ->addselect('MatParty.compliancestatus')
        ->addselect('MatParty.maxclaimamount')
        ->addselect('MatParty.includeinlifeassurance')
        ->addselect('MatParty.effectivedate')
        ->addselect('MatParty.connectedparty')
        ->addselect('MatParty.sars_sharepercentage')
        ->addselect('MatParty.commissionpercent')
        ->addselect('MatParty.commissionamount')
        ->addselect('MatParty.commissionexcludesvatflag')
        ->addselect('MatParty.spouse_sars_sharepercentage')
        ->addselect('MatParty.customernumber')
        ->addselect('MatParty.bankparticipantid')
        ->addselect('MatParty.signatoryid')
        ->addselect('MatParty.requirementcodes')
        ->addselect('MatParty.participantnr')


        ->addselect("Party.Name as partyname")
        ->addselect("Party.MatterPrefix as partymatterprefix")
        ->addselect("Contact.Name as contactname")
        ->addselect("Contact.RecordID as contactrecordid")
        ->addselect("Role.Description as roledescription")
        ->addSelect("Language.Description as languagedescription")
        ->addselect("Email.Number as emailaddress")
        ->addselect("Work.Number as worknumber")
        ->addselect("Home.Number as homenumber")
        ->addselect("Cell.Number as cellnumber")

        ->addselect(["Matter.FileRef as matterfileref",
        "Matter.conveyancingstatusflag",
        "Matter.Description as matterdescription",
        "MatType.Description as mattypedescription",
        "Docgen.Description as docgendescription",
        "Branch.Description as branchdescription",
        DB::raw("CASE WHEN ISNULL(Matter.DateInstructed,0) = 0 OR Matter.DateInstructed = 0 OR Matter.DateInstructed > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(Matter.DateInstructed-36163 as DateTime),106) END as formatteddateinstructed"),
        ])

        ->addselect(DB::raw("CASE 
        WHEN MatParty.MatterId > 0 THEN CONCAT('<span onclick=\"editRecord(''globalMatterForm'',', MatParty.MatterId,')\" title=\"View the Matter\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Matter.FileRef,' - ',Matter.Description),'</span>') 
        ELSE '' END as matterlink"))

        ->addselect(DB::raw("CASE 
        WHEN MatParty.PartyId > 0 THEN  CONCAT('<span onclick=\"editRecord(''globalPartyForm'',', MatParty.PartyId,')\" title=\"View the Party\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Party.MatterPrefix,' - ',Party.Name),'</span>') 
        ELSE '' END as partylink"));

    }
    
    public static function matpartyJoinBuilder(&$query)
    {
        
        $query->leftJoin('Matter', 'MatParty.MatterID', '=', 'Matter.RecordID')
        ->leftJoin('Party', 'MatParty.PartyID', '=', 'Party.RecordID')

        ->leftJoin('Party AS Contact', 'Contact.RecordID', '=', 'MatParty.ContactID')
        ->leftJoin('Role', 'MatParty.RoleID', '=', 'Role.RecordID')
        ->leftJoin('Language ', 'MatParty.LanguageID', '=', 'Language.RecordID')
        
        ->leftJoin('MatType', 'Matter.MatterTypeID', '=', 'MatType.RecordID')
        ->leftJoin('Docgen', 'Matter.DocgenID', '=', 'Docgen.RecordID')
        ->leftJoin('Branch', 'Matter.BranchID', '=', 'Branch.RecordID')


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
    
    public static function doclogSelectBuilder(&$query)
    {
        // Doing it like this because can't repeat 'savedname'
        // Otherwise you get a SQL error "The column 'SavedName' was specified multiple times"
        $query->addselect([
            'doclog.matterid',
            'doclog.employeeid',
            'doclog.description',
            'doclog.date',
            'doclog.time',
            'doclog.noofpages',
            'doclog.noofwords',
            'doclog.documentid',
            'doclog.partyid',
            'doclog.printonlyflag',
            'doclog.emailflag',
            'doclog.emailfolder',
            'doclog.emailreceivedtime',
            'doclog.emailfrom',
            'doclog.emailbody',
            'doclog.emailcc',
            'doclog.emailrecipients',
            'doclog.emailsentdate',
            'doclog.emailimportedflag',
            'doclog.direction',
            'doclog.recordid',
            'doclog.doclogcategoryid',
            'doclog.creditorid',
            'doclog.businessid',
            'doclog.url',
            'doclog.conversationid',
            'doclog.conversationindex',
            'doclog.signable',
            'doclog.doclogsubcategoryid'
        ])

        //This was inconsistent so added both for now
        ->addselect("Matter.FileRef as fileref")
        ->addselect("Matter.FileRef as matterfileref")
        ->addselect("Matter.Description as matterdescription")
        ->addselect("Party.Name as partyname")
        ->addselect("Party.MatterPrefix as partymatterprefix")
        ->addselect("Email.Number as partyemailaddress")
        ->addselect("Employee.Name as employeename")
        ->addselect("DocLogCategory.Description as category")
        ->addselect("DocLogSubCategory.Description as subcategory")

        ->addselect(DB::raw("CASE 
            WHEN DocLog.MatterId > 0 THEN CONCAT('<span onclick=\"editRecord(''globalMatterForm'',', DocLog.MatterId,')\" title=\"View the Matter\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Matter.FileRef,' - ',Matter.Description),'</span>') 
            WHEN DocLog.PartyId > 0 THEN  CONCAT('<span onclick=\"editRecord(''globalPartyForm'',', DocLog.PartyId,')\" title=\"View the Party\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Party.MatterPrefix,' - ',Party.Name),'</span>') 
            ELSE '' END
            as parentlink"))
        
        ->addselect(DB::raw("CASE WHEN DocLog.MatterId > 0 THEN CONCAT(Matter.FileRef,' - ', Matter.Description) WHEN DocLog.PartyId > 0 THEN CONCAT(Party.MatterPrefix,' - ', Party.Name) ELSE '' END as parent"))
        ->addselect(DB::raw("CASE WHEN DocLog.MatterId > 0 THEN 'Matter' WHEN DocLog.PartyId > 0 THEN 'Party' ELSE '' END as parenttype"))

        ->addselect(DB::raw("CASE WHEN DocLog.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(Doclog.Time * 10) ,0),108) ELSE '' END as formattedtime"))
        ->addselect(DB::raw("CASE WHEN DocLog.Date > 0 THEN CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) ELSE '' END as formatteddate"))
        ->addselect(DB::raw("CONCAT(CASE WHEN DocLog.Date > 0 THEN CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) ELSE '' END,' ',CASE WHEN DocLog.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(Doclog.Time * 10) ,0),108) ELSE '' END) as formatteddatetime"))

        // Need this unambiguous date time for moment()
        ->addselect(DB::raw("CONCAT(CASE WHEN DocLog.Date > 0 THEN CONVERT(VarChar(12),CAST(DocLog.Date-36163 as DateTime),106) ELSE '' END,' ',CASE WHEN DocLog.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(Doclog.Time * 10) ,0),108) ELSE '' END) as datetime"))

        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFolder ELSE DocLog.SavedName END as savedname"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailFrom ELSE Employee.Name END as sender"))
        ->addselect(DB::raw("CASE WHEN DocLog.EmailFlag = 1 OR DocLog.EmailFlag = 2 THEN DocLog.EmailRecipients ELSE '' END as sentto"))
        ->addselect(DB::raw("CASE WHEN DocLog.Direction = 1 THEN 'Outgoing' WHEN DocLog.Direction = 2 THEN 'Incoming' ELSE 'Not Applicable' END as directiondescription"));
        
    }
    
    public static function doclogJoinBuilder(&$query)
    {
        $query->leftJoin('Matter', 'DocLog.MatterID', '=', 'Matter.RecordID')
        ->leftJoin('Party', 'DocLog.PartyID', '=', 'Party.RecordID')
        ->leftJoin('DocLogCategory', 'DocLog.DocLogCategoryID', '=', 'DocLogCategory.RecordID')
        ->leftJoin('DocLogSubCategory', 'DocLog.DocLogSubCategoryID', '=', 'DocLogSubCategory.RecordID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'DocLog.EmployeeID')
        
        ->join('Control', function ($join) {
            $join->where('Control.RecordID', 1);
        })

        ->leftJoin('ParTele as Email', function ($join) {
            $join->on('Email.PartyID', '=', 'Party.RecordID')
            ->on('Email.TelephoneTypeID', '=', 'Control.EMailPhoneID')
            ->where('Email.DefaultEmailFlag', 1)
            ->where('Email.Sorter', 1);
        });
        
    }

    public static function filenoteSelectBuilder(&$query)
    {

        $query->addselect('FileNote.recordid')
        ->addselect('FileNote.matterid')
        ->addselect('FileNote.docfilenoteid')
        ->addselect('FileNote.date')
        ->addselect('FileNote.description')
        ->addselect('FileNote.employeeid')
        ->addselect('FileNote.stageid')
        ->addselect('FileNote.internalflag')
        ->addselect('FileNote.origin')
        ->addselect('FileNote.autonotifydate')
        ->addselect('FileNote.exportedflag')
        ->addselect('FileNote.doclogid')
        ->addselect('FileNote.time')
        ->addselect('FileNote.feenoteid')
        ->addselect('FileNote.createddate')
        ->addselect('FileNote.createdtime')
        ->addselect('FileNote.createdby')
        ->addselect('FileNote.todonoteid')
        ->addselect('FileNote.color')


        //This was inconsistent so added both for now
        ->addselect("Matter.FileRef as fileref")
        ->addselect("Matter.FileRef as matterfileref")

        ->addselect("Matter.Description as matterdescription")
        ->addselect("Employee.Name as employeename")
        ->addselect("CreatedByEmployee.Name as createdbyemployee")
        
        ->addselect(DB::raw("CASE WHEN FileNote.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.Time * 10) ,0),108) ELSE '' END as formattedtime"))
        ->addselect(DB::raw("CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),106) ELSE '' END as formatteddate"))
        ->addselect(DB::raw("CONCAT(CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),106) ELSE '' END,' ',CASE WHEN FileNote.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.Time * 10) ,0),108) ELSE '' END) as formatteddatetime"))
        
        // Need this unambiguous date time for moment()
        ->addselect(DB::raw("CONCAT(CASE WHEN FileNote.Date > 0 THEN CONVERT(VarChar(12),CAST(FileNote.Date-36163 as DateTime),106) ELSE '' END,' ',CASE WHEN FileNote.Time > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.Time * 10) ,0),108) ELSE '' END) as datetime"))
        
        ->addselect(DB::raw("CASE WHEN FileNote.CreatedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.CreatedTime * 10) ,0),108) ELSE '' END as formattedcreatedtime"))
        ->addselect(DB::raw("CASE WHEN FileNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),106) ELSE '' END as formattedcreateddate"))
        ->addselect(DB::raw("CONCAT(CASE WHEN FileNote.CreatedDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.CreatedDate-36163 as DateTime),106) ELSE '' END,' ',CASE WHEN FileNote.CreatedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(FileNote.CreatedTime * 10) ,0),108) ELSE '' END) as formattedcreateddatetime"))

        ->addselect(DB::raw("CASE WHEN FileNote.AutoNotifyDate > 0 THEN CONVERT(VarChar(12),CAST(FileNote.AutoNotifyDate-36163 as DateTime),106) ELSE '' END as formattedautonotifydate"))

        ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Code,'') = '' THEN '' ELSE Stage.Code END as stagecode"))
        ->addselect(DB::raw("CASE WHEN ISNULL(Stage.Description,'') = '' THEN '' ELSE Stage.Description END as stagedescription"))

        ->addselect(DB::raw("CASE 
        WHEN FileNote.MatterId > 0 THEN CONCAT('<span onclick=\"editRecord(''globalMatterForm'',', FileNote.MatterId,')\" title=\"View the Matter\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Matter.FileRef,' - ',Matter.Description),'</span>') 
        ELSE '' END as parentlink"))

        ->addselect("ToDoNote.Description as todonotedescription")
        ->addselect(DB::raw("CASE WHEN ToDoNote.Date > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) ELSE '' END as todonotedate"));

    }
    
    public static function filenoteJoinBuilder(&$query)
    {
        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'FileNote.MatterID')
        ->leftJoin('Stage', 'Stage.RecordID', '=', 'FileNote.StageID')
        ->leftJoin('ToDoNote', 'ToDoNote.RecordID', '=', 'FileNote.ToDoNoteID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'FileNote.EmployeeID')
        ->leftjoin('Employee as CreatedByEmployee', 'FileNote.CreatedBy', '=', 'CreatedByEmployee.RecordID');
        
    }


    public static function todonoteSelectBuilder(&$query)
    {
        $query->addselect("ToDoNote.*")
        
        //This was inconsistent so added both for now
        ->addselect("Matter.FileRef as fileref")
        ->addselect("Matter.FileRef as matterfileref")

        ->addselect("Matter.Description as matterdescription")

        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.CreatedDate,0) = 0 OR ToDoNote.CreatedDate = 0 OR ToDoNote.CreatedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.CreatedDate-36163 as DateTime),106) END as formattedcreateddate"))
        ->addselect(DB::raw("CASE WHEN ToDoNote.CreatedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ToDoNote.CreatedTime * 10) ,0),108) ELSE '' END as formattedcreatedtime"))
        ->addselect(DB::raw("CASE WHEN ToDoNote.CompletedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ToDoNote.CompletedTime * 10) ,0),108) ELSE '' END as formattedcompletedtime"))

        ->addselect(DB::raw("CONCAT(CASE WHEN ToDoNote.DateDone > 0 THEN CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),106) ELSE '' END,' ',CASE WHEN ToDoNote.CompletedTime > 0 THEN CONVERT(VARCHAR,DateAdd(millisecond,(ToDoNote.CompletedTime * 10) ,0),108) ELSE '' END) as formatteddatetimedone"))

        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.Date,0) = 0 OR ToDoNote.Date = 0 OR ToDoNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.Date-36163 as DateTime),106) END as formatteddate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 OR ToDoNote.DateDone = 0 OR ToDoNote.DateDone > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.DateDone-36163 as DateTime),106) END as formatteddatedone"))

        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.AutoNotifyDate,0) = 0 OR ToDoNote.AutoNotifyDate = 0 OR ToDoNote.AutoNotifyDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.AutoNotifyDate-36163 as DateTime),106) END as formattedautonotifydate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ToDoNote.DateAdjustment,0) = 0 OR ToDoNote.DateAdjustment = 0 OR ToDoNote.DateAdjustment > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ToDoNote.DateAdjustment-36163 as DateTime),106) END as formatteddateadjustment"))

        ->addselect("Employee.Name as employeename")
        ->addselect("CreatedBy.Name as createdbyemployee")
        ->addselect("CompletedBy.Name as completedbyemployee")

        ->addselect(DB::raw("CASE 
        WHEN ISNULL(Matter.DateInstructed,0) = 0 OR Matter.DateInstructed = 0 OR Matter.DateInstructed > 100000 THEN 0 
        ELSE 
            CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 OR ToDoNote.DateDone = 0 THEN 0 
            ELSE
                ToDoNote.DateDone - Matter.DateInstructed
            END
        END as daystaken"))

        ->addselect(DB::raw("
            CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 OR ToDoNote.DateDone = 0 THEN 0 
            ELSE
                ToDoNote.DateDone - ToDoNote.Date
            END as daysdiff"))

        ->addselect(DB::raw("
            CASE WHEN ISNULL(ToDoNote.DateDone,0) = 0 OR ToDoNote.DateDone = 0 THEN 0 
            ELSE
                CASE WHEN DATEDIFF(day, CAST(ToDoNote.Date-36163 as DateTime),GETDATE()) > 0 
                    THEN 1 
                ELSE
                    0
                END
            END
        as overdueflag"))


        ->addselect(DB::raw("CASE 
        WHEN ToDoNote.MatterId > 0 THEN CONCAT('<span onclick=\"editRecord(''globalMatterForm'',', ToDoNote.MatterId,')\" title=\"View the Matter\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Matter.FileRef,' - ',Matter.Description),'</span>') 
        ELSE '' END as parentlink"));

    }
    
    public static function todonoteJoinBuilder(&$query)
    {
        $query->leftJoin('Matter', 'Matter.RecordID', '=', 'ToDoNote.MatterID')
        ->leftJoin('Employee', 'Employee.RecordID', '=', 'ToDoNote.EmployeeID')
        ->leftJoin('Employee as CreatedBy', 'CreatedBy.RecordID', '=', 'ToDoNote.CreatedByID')
        ->leftJoin('Employee as CompletedBy', 'CompletedBy.RecordID', '=', 'ToDoNote.CompletedByID');
        
    }


    public static function docgenSelectBuilder(&$query)
    {
        $query->addselect("DocGen.*")
        ->addselect("ToDoGroup.Description as todogroupdescription");
        
    }
    
    public static function docgenJoinBuilder(&$query)
    {
        $query->leftJoin('ToDoGroup', 'ToDoGroup.RecordID', '=', 'DocGen.ToDoGroupID');
        
    }

    public static function mattypeSelectBuilder(&$query)
    {
        $query->addselect("MatType.*")
        ->addselect("FeeSheet.Description as feesheetdescription");
        
    }
    
    public static function mattypeJoinBuilder(&$query)
    {
        $query->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'MatType.FeeSheetID');
        
    }

    public static function branchSelectBuilder(&$query)
    {
        $query->addselect("Branch.*")
        ->addselect("Business.RecordID as businessbankid")
        ->addselect("Business.Description as businessbankdescription")
        ->addselect("Trust.RecordID as trustbankid")
        ->addselect("Trust.Description as trustbankdescription");

    }

    public static function branchJoinBuilder(&$query)
    {
        $query->leftJoin('Business', 'Business.RecordID', '=', 'Branch.BusinessBankID')
        ->leftJoin('Business as Trust', 'Trust.RecordID', '=', 'Branch.TrustBankID');

    }

    public static function feenoteSelectBuilder(&$query)
    {
        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();
        
        $query->addselect("FeeNote.*")
        
        //This was inconsistent so added both for now
        ->addselect("Matter.FileRef as fileref")
        ->addselect("Matter.FileRef as matterfileref")

        ->addselect("Matter.Description as matterdescription")
        ->addselect("CostCentre.Description as costcentre")
        ->addselect("Employee.Name as employeename")
        ->addselect("PostedEmployee.Name as postedemployee")
        ->addselect(DB::raw("FeeNote.AmountIncl - FeeNote.VatAmount as amountexcl"))

        ->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.Date,0) = 0 OR FeeNote.Date = 0 OR FeeNote.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.Date-36163 as DateTime),106) END as formatteddate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(FeeNote.PostedDate,0) = 0 OR FeeNote.PostedDate = 0 OR FeeNote.PostedDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeNote.PostedDate-36163 as DateTime),106) END as formattedposteddate"))

        ->addselect(DB::raw("CASE WHEN FeeNote.VatRate = '1' THEN '" . $control->VatPercent1 . "%'
        WHEN FeeNote.VatRate = '2' THEN '" . $control->VatPercent2 . "%'
        WHEN FeeNote.VatRate = '3' THEN '" . $control->VatPercent3 . "%'
        WHEN FeeNote.VatRate = 'N' THEN 'No Vat'
        WHEN FeeNote.VatRate = 'E' THEN 'Exempt'
        WHEN FeeNote.VatRate = 'Z' THEN 'Zero Rated'
        ELSE 'Unknown' END as vatratedescription"))

        ->addselect(DB::raw("CASE WHEN FeeNote.Source = 'D' THEN 'Desktop'
        WHEN FeeNote.Source = 'X' THEN 'Imported'
        WHEN FeeNote.Source = 'L' THEN 'LegalTrax'
        WHEN FeeNote.Source = 'A' THEN 'AddressBook'
        WHEN FeeNote.Source = 'I' THEN 'Inserted'
        WHEN FeeNote.Source = 'H' THEN 'LSW Monitor'
        WHEN FeeNote.Source = 'C' THEN 'Matter Transaction'
        WHEN FeeNote.Source = 'T' THEN 'Time Recording'
        WHEN FeeNote.Source = 'S' THEN 'Excalibur'
        WHEN FeeNote.Source = 'W' THEN 'LegalSuite Online'
        WHEN FeeNote.Source = 'M' THEN 'Mobile App'
        ELSE 'Unknown' END as sourcedescription"))

        //'D','X','L','A','I','H','C','T','S'),'Desktop','Imported','LegalTrax','AddressBook','Inserted','LSW Monitor','Matter Transaction','Time Recording','Excalibur','UnKnown'

        ->addselect(DB::raw("CASE 
        WHEN FeeNote.DocumentCode = 'CCJ' THEN 'Certified Extract of Civil Judgment'
        WHEN FeeNote.DocumentCode = 'EMO' THEN 'Emoluments Attachment Order'
        WHEN FeeNote.DocumentCode = 'IMM' THEN 'Sale of Immovable property'
        WHEN FeeNote.DocumentCode = 'JUD' THEN 'Judgement'
        WHEN FeeNote.DocumentCode = 'LOD' THEN 'Letter Of Demand'
        WHEN FeeNote.DocumentCode = 'MOV' THEN 'Sale of movable property'
        WHEN FeeNote.DocumentCode = 'R41' THEN 'Postponed proceedings'
        WHEN FeeNote.DocumentCode = 'RDJ' THEN 'Request for Default Judgment'
        WHEN FeeNote.DocumentCode = 'REEMO' THEN 'Reissue Emoluments Attachment Order'
        WHEN FeeNote.DocumentCode = 'RES65' THEN 'Reissue Section 65 Notice to Appear in Court'
        WHEN FeeNote.DocumentCode = 'RESUM' THEN 'Reissue Summons'
        WHEN FeeNote.DocumentCode = 'REWRI' THEN 'Reissue Warrant of Execution'
        WHEN FeeNote.DocumentCode = 'S57' THEN 'Section 57 Consent'
        WHEN FeeNote.DocumentCode = 'S65' THEN 'Section 65 Notice to Appear in Court'
        WHEN FeeNote.DocumentCode = 'SUM' THEN 'Summons'
        WHEN FeeNote.DocumentCode = 'WOA' THEN 'Warrant of Arrest'
        WHEN FeeNote.DocumentCode = 'WRI' THEN 'Warrant of Execution'
        ELSE 'None' END as documentcodedescription"))

        ->addselect(DB::raw("CASE 
            WHEN FeeNote.MatterId > 0 THEN CONCAT('<span onclick=\"editRecord(''globalMatterForm'',', MatterId,')\" title=\"View the Matter\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Matter.FileRef,' - ',Matter.Description),'</span>') 
            ELSE '' END as parentlink"));
        
    }
    
    public static function feenoteJoinBuilder(&$query)
    {
        $query->leftJoin('Employee', 'Employee.RecordID', '=', 'FeeNote.EmployeeID')
        ->leftjoin('Employee as PostedEmployee', 'FeeNote.PostedBy', '=', 'PostedEmployee.RecordID')
        ->leftJoin('CostCentre', 'FeeNote.CostCentreID', '=', 'CostCentre.RecordID')
        ->leftJoin('Matter', 'Matter.recordID', '=', 'FeeNote.MatterID');
        
    }
    
    public static function feeitemSelectBuilder(&$query)
    {


        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();


        $query->addselect("FeeItem.*")

        ->addselect(DB::raw("CASE WHEN FeeItem.VatRate = '1' THEN " . $control->VatPercent1
        . " WHEN FeeItem.VatRate = '2' THEN ". $control->VatPercent2 
        . " WHEN FeeItem.VatRate = '3' THEN ". $control->VatPercent3
        . " ELSE 0 END as vatpercentage"))



        ->addselect(DB::raw("CASE WHEN ISNULL(FeeItem.FromDate,0) = 0 OR FeeItem.FromDate = 0 OR FeeItem.FromDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeItem.FromDate-36163 as DateTime),106) END as formattedfromdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(FeeItem.ToDate,0) = 0 OR FeeItem.ToDate = 0 OR FeeItem.ToDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(FeeItem.ToDate-36163 as DateTime),106) END as formattedfromdate"))

        ->addselect("FeeCode.FeeSheetId")
        ->addselect("FeeCode.Description as feecodedescription")
        ->addselect("FeeCode.BusinessLedgerID as feecodebusinessledgerid")

        ->addselect("FeeSheet.Type as feesheettype")
        ->addselect("FeeSheet.BusinessLedgerID as feesheetbusinessledgerid")

        ->addselect("Unit.Description as unitdescription")
        ->addselect("Unit.TimeBasedFlag as unittimebasedflag")
        ->addselect("Unit.Code as unitcode")
        ->addselect("Unit.MinutesPerUnit as unitminutesperunit")

        ->addselect("FeeScale.Amount as feescaleamount")

        ->addselect("Activity.Description as activitydescription")
        ->addselect("Activity.BillableFlag as activitybillableflag")
        ->addselect("Activity.Rate as activityrate")

        ->addselect("UnitText.Singular as unitsingular")
        ->addselect("UnitText.Plural as unitplural");


    }
    
    public static function feeitemJoinBuilder(&$query, $request)
    {
        $query->leftJoin('FeeCode', 'FeeCode.RecordID', '=', 'FeeItem.FeeCodeID')

        ->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'FeeCode.FeeSheetID')
        ->leftJoin('Unit', 'Unit.RecordID', '=', 'FeeItem.UnitsID')
        ->leftJoin('Activity', 'Activity.RecordID', '=', 'FeeItem.ActivityID')

        ->leftJoin('UnitText', function ($join) use($request) {
            $join->on('UnitText.UnitID', '=', 'Unit.RecordID')
            ->where('UnitText.LanguageID', '=', $request->languageid);
        })

        ->leftJoin('FeeScale', function ($join) use($request) {
            $join->on('FeeScale.FeeItemID', '=', 'FeeItem.RecordID')
            ->where('FeeScale.EmployeeTypeID', '=', $request->employeeid);
        });

    }

    public static function stageSelectBuilder(&$query)
    {
        $query->addselect("Stage.*")
        ->addselect("StageGroup.Description as stagegroupdescription");
        
    }
    
    public static function stageJoinBuilder(&$query)
    {
        $query->leftJoin('StageGroup', 'Stage.StageGroupID', '=', 'StageGroup.RecordID');
        
    }
    
    public static function employeeSelectBuilder(&$query)
    {
        $query->addselect([
            "Employee.recordid",
            "Employee.loginid",
            "Employee.name",
            "Employee.startupscreen",
            "Employee.defaultfeesheetid",
            "Employee.consultationfeecodeid",
            "Employee.restricttoclientflag",
            "Employee.timerecordingflag",
            "Employee.discountsurcharge",
            "Employee.employeetypeid",
            "Employee.costperhour",
            "Employee.mergeddocumentlocation",
            "Employee.defaultlanguageid",
            "Employee.defaulttrustbankid",
            "Employee.defaultcostcentreid",
            "Employee.clausepath",
            "Employee.particularspath",
            "Employee.filtermattertypeflag",
            "Employee.takeondebitflag",
            "Employee.takeondebitid",
            "Employee.filtermattertypeid",
            "Employee.filtercostcentreflag",
            "Employee.filtergroupflag",
            "Employee.filtercostcentreid",
            "Employee.filtergroupid",
            "Employee.filteremployeeflag",
            "Employee.colortemplate",
            "Employee.incomeaccoption",
            "Employee.incomeaccid",
            "Employee.incomeytd",
            "Employee.income1",
            "Employee.income2",
            "Employee.income3",
            "Employee.income4",
            "Employee.income5",
            "Employee.income6",
            "Employee.income7",
            "Employee.income8",
            "Employee.income9",
            "Employee.income10",
            "Employee.income11",
            "Employee.income12",
            "Employee.lincome1",
            "Employee.lincome2",
            "Employee.lincome3",
            "Employee.lincome4",
            "Employee.lincome5",
            "Employee.lincome6",
            "Employee.lincome7",
            "Employee.lincome8",
            "Employee.lincome9",
            "Employee.lincome10",
            "Employee.lincome11",
            "Employee.lincome12",
            "Employee.budget1",
            "Employee.budget2",
            "Employee.budget3",
            "Employee.budget4",
            "Employee.budget5",
            "Employee.budget6",
            "Employee.budget7",
            "Employee.budget8",
            "Employee.budget9",
            "Employee.budget10",
            "Employee.budget11",
            "Employee.budget12",
            "Employee.showdoubleentryflag",
            "Employee.postingid",
            "Employee.batchid",
            "Employee.transid",
            "Employee.lineid",
            "Employee.templateid",
            "Employee.oldcode",
            "Employee.useoldcodeflag",
            "Employee.filterarchiveflag",
            "Employee.receiptprintingoption",
            "Employee.loggedinflag",
            "Employee.filterdateflag",
            "Employee.filterfromdate",
            "Employee.filtertodate",
            "Employee.filterdocgenflag",
            "Employee.filterdocgenid",
            "Employee.receiptprinterflag",
            "Employee.receiptprinter",
            "Employee.depositslipprinterflag",
            "Employee.depositslipprinter",
            "Employee.notusedflag",
            "Employee.wordprocessoroption",
            "Employee.hideinactivebusinessflag",
            "Employee.hideinactivecreditorflag",
            "Employee.hideinactivematterflag",
            "Employee.hideinactivecostcentreflag",
            "Employee.hideinactiveemployeeflag",
            "Employee.rateperhour",
            "Employee.defaultclientid",
            "Employee.defaultclientflag",
            "Employee.filtersheriffareaflag",
            "Employee.filtersheriffareaid",
            "Employee.emailaddress",
            "Employee.billablebudget",
            "Employee.nonbillablebudget",
            "Employee.filteremployeeid",
            "Employee.filtermattersby",
            "Employee.remoteuserflag",
            "Employee.expenseytd",
            "Employee.expense1",
            "Employee.expense2",
            "Employee.expense3",
            "Employee.expense4",
            "Employee.expense5",
            "Employee.expense6",
            "Employee.expense7",
            "Employee.expense8",
            "Employee.expense9",
            "Employee.expense10",
            "Employee.expense11",
            "Employee.expense12",
            "Employee.lexpense1",
            "Employee.lexpense2",
            "Employee.lexpense3",
            "Employee.lexpense4",
            "Employee.lexpense5",
            "Employee.lexpense6",
            "Employee.lexpense7",
            "Employee.lexpense8",
            "Employee.lexpense9",
            "Employee.lexpense10",
            "Employee.lexpense11",
            "Employee.lexpense12",
            "Employee.email",
            "Employee.captureoption",
            "Employee.spreadsheetoption",
            "Employee.autopostwipflag",
            "Employee.matteroption",
            "Employee.creditoroption",
            "Employee.businessoption",
            "Employee.receiptoption",
            "Employee.lastreceipt",
            "Employee.passwordexpirydate",
            "Employee.suspendedflag",
            "Employee.tooltipsoption",
            "Employee.supervisorflag",
            "Employee.secgroupid",
            "Employee.reference",
            "Employee.showmatteridflag",
            "Employee.backupflag",
            "Employee.filterbalances",
            "Employee.filteraging",
            "Employee.autodescriptionflag",
            "Employee.autodescriptionseparator",
            "Employee.defaultbillingrateid",
            "Employee.roundingflag",
            "Employee.billperhourflag",
            "Employee.billperminutes",
            "Employee.roundingminutesflag",
            "Employee.printerflag",
            "Employee.invoicetype",
            "Employee.nothoughtsflag",
            "Employee.reportdestination",
            "Employee.restricttopartyroleid",
            "Employee.interfaceoption",
            "Employee.smsprovidernotused",
            "Employee.smssecuritycode",
            "Employee.donotshowchangesflag",
            "Employee.changeno",
            "Employee.lastchangeno",
            "Employee.groupid",
            "Employee.regibondpath",
            "Employee.donotsavedocumentsflag",
            "Employee.filterfavouritesflag",
            "Employee.progresstrackingmethod",
            "Employee.buildno",
            "Employee.defaultpartyextrascreenid",
            "Employee.voucherflag",
            "Employee.smsfeecodeflag",
            "Employee.smsfeecodeid",
            "Employee.smsending",
            "Employee.filterdebtlinkflag",
            "Employee.filterdebtlinkcategory",
            "Employee.fn_matter",
            "Employee.fil_matter",
            "Employee.tod_matter",
            "Employee.ma_matter",
            "Employee.fn_employeeid",
            "Employee.fil_employeeid",
            "Employee.tod_employeeid",
            "Employee.ma_employeeid",
            "Employee.fn_costcentreid",
            "Employee.ma_activityid",
            "Employee.fn_period",
            "Employee.fil_period",
            "Employee.tod_period",
            "Employee.ma_period",
            "Employee.tod_status",
            "Employee.ma_billable",
            "Employee.postedoption",
            "Employee.reportcategory",
            "Employee.showficacomplianceflag",
            "Employee.insertfeenotesflag",
            "Employee.insertfilenotesflag",
            "Employee.inserttodonotesflag",
            "Employee.filterstatusliveflag",
            "Employee.filterstatuspendingflag",
            "Employee.filterstatusarchiveflag",
            "Employee.matterhistorysetting",
            "Employee.emailending",
            "Employee.filterlaststageflag",
            "Employee.filterstageid",
            "Employee.useredemptionflag",
            "Employee.smsfilerefflag",
            "Employee.overideoctagonpath",
            "Employee.assemblebillhourlyflag",
            "Employee.assemblebillhourlyid",
            "Employee.desktopbackground",
            "Employee.searchwhat",
            "Employee.searchby",
            "Employee.searchhow",
            "Employee.mattrantab",
            "Employee.outputdevice",
            "Employee.filterpargroupflag",
            "Employee.filterpargroupid",
            "Employee.todonotetofilenote",
            "Employee.addressbookview",
            "Employee.fn_fromdate",
            "Employee.fn_todate",
            "Employee.fil_fromdate",
            "Employee.fil_todate",
            "Employee.tod_fromdate",
            "Employee.tod_todate",
            "Employee.ma_fromdate",
            "Employee.ma_todate",
            "Employee.filterparregionflag",
            "Employee.filterparcategoryflag",
            "Employee.filterparanystageflag",
            "Employee.filterparlaststageflag",
            "Employee.filterparregionid",
            "Employee.filterparcategoryid",
            "Employee.filterparanystageid",
            "Employee.filterparlaststageid",
            "Employee.restricttoclientlist",
            "Employee.emailfeecodeflag",
            "Employee.emailfeecodeid",
            "Employee.telephone",
            "Employee.fax",
            "Employee.assembleletterflag",
            "Employee.debuggingflag",
            "Employee.sortaddressbookoption",
            "Employee.donotcreatefilenotefromemailflag",
            "Employee.scanningfeecodeflag",
            "Employee.scanningfeecodeid",
            "Employee.scanneddocumentslocation",
            "Employee.databasename",
            "Employee.databasebackupname",
            "Employee.color1",
            "Employee.color2",
            "Employee.showjustmycoloursflag",
            "Employee.colorizeflag",
            "Employee.fil_status",
            "Employee.filterstageflag",
            "Employee.colourmymattersflag",
            "Employee.filterbranchflag",
            "Employee.filterbranchid",
            "Employee.dat_matter",
            "Employee.dat_period",
            "Employee.dat_fromdate",
            "Employee.dat_todate",
            "Employee.defaultactivityid",
            "Employee.datalinkbranchid",
            "Employee.smsoption",
            "Employee.batchallemployeeflag",
            "Employee.printxmlflag",
            "Employee.smsinternalflag",
            "Employee.emailinternalflag",
            "Employee.feeestimatewarningflag",
            "Employee.filterdateoption",
            "Employee.otherscanneddocumentlocation",
            "Employee.smssender",
            "Employee.noticeflag",
            "Employee.windowwidth",
            "Employee.windowheight",
            "Employee.cellphone",
            "Employee.debuggingmergeflag",
            "Employee.defaultemailinbox",
            "Employee.regibondbranchid",
            "Employee.regibondbranchoption",
            "Employee.lolenabledflag",
            "Employee.emailheader",
            "Employee.emailfooter",
            "Employee.emailfontfamily",
            "Employee.emailfontsize",
            "Employee.emailfontcolor",
            "Employee.emailfontstyle",
            "Employee.defaultprovinceid",
            "Employee.ma_costcentreid",
            "Employee.converttopdfoption",
            "Employee.emailsubject",
            "Employee.displayautomaticnotificationsflag",
            "Employee.filenotesinternalflag",
            "Employee.law_matter",
            "Employee.law_period",
            "Employee.law_fromdate",
            "Employee.law_todate",
            "Employee.branchid",
            "Employee.commissionpercent",
            "Employee.law_displayoption",
            "Employee.law_type",
            "Employee.filterconveyancingstatus",
            "Employee.filterconveyancingstatusflag",
            "Employee.emailattachmentspath",
            "Employee.fnb_matter",
            "Employee.fnb_period",
            "Employee.fnb_fromdate",
            "Employee.fnb_todate",
            "Employee.lawdeed_username",
            "Employee.lawdeedid",
            "Employee.searchworksusername",
            "Employee.restricttobranchlist",
            "Employee.dotnetdonotaskflag",
            "Employee.absa_matter",
            "Employee.absa_period",
            "Employee.absa_fromdate",
            "Employee.absa_todate",
            "Employee.donoloadlwsflag",
            "Employee.dotnetinstalledflag",
            "Employee.disableeventsflag",
            "Employee.filterdatetype",
            "Employee.bankdetailsonfinalaccountflag",
            "Employee.sortdesktopoption",
            "Employee.restricttoemployeelist",
            "Employee.restricttodocgenlist",
            "Employee.restricttomattertypelist",
            "Employee.restricttocostcentrelist",
            "Employee.defaultmatterdescription",
            "Employee.tod_criticalstep",
            "Employee.partymatterstatus",
            "Employee.usemattercostcentreflag",
            "Employee.showalternaterefflag",
            "Employee.filterstagesinlistflag",
            "Employee.filterstagesnotinlistflag",
            "Employee.progressindicatorflag",
            "Employee.desktoplineheight",
            "Employee.restricttocriticalsteplist",
            "Employee.filtercriticalstepsnotinlistflag",
            "Employee.filtercriticalstepsnotinlist",
            "Employee.displaylargeiconsflag",
            "Employee.filtercriticalstepsinlistflag",
            "Employee.reportlogofilename",
            "Employee.reportlogoheight",
            "Employee.remotematterid",
            "Employee.useoldiconsflag",
            "Employee.filterinactivemattersflag",
            "Employee.filterinactivedays",
            "Employee.filterinactivefilenotesflag",
            "Employee.filterfilenotesoption",
            "Employee.filterinactivefeenotesflag",
            "Employee.filterinactivetodonotesflag",
            "Employee.filterinactivecoldebitflag",
            "Employee.filterinactivemattranflag",
            "Employee.empdefaultfilterid",
            "Employee.showmattericonsflag",
            "Employee.showfilenoteiconsflag",
            "Employee.showtodonoteiconsflag",
            "Employee.digitalsignature",
            "Employee.synchronisetaskswithremindersflag",
            "Employee.synchroniseappointmentswithremindersflag",
            "Employee.finalaccountformat",
            "Employee.finalaccountrandsignsflag",
            "Employee.alertsfilteredflag",
            "Employee.deedssearchmethod",
            "Employee.internetquotationsflag",
            "Employee.displaythoughtsperiod",
            "Employee.enablespellcheckflag",
            "Employee.sars_matter",
            "Employee.sars_period",
            "Employee.sars_fromdate",
            "Employee.sars_todate",
            "Employee.rates_matter",
            "Employee.rates_period",
            "Employee.rates_fromdate",
            "Employee.rates_todate",
            "Employee.databasebuildno",
            "Employee.filter_ag_suite",
            "Employee.canc_matter",
            "Employee.canc_period",
            "Employee.canc_fromdate",
            "Employee.canc_todate",
            "Employee.canc_matterid",
            "Employee.absa_dg_code",
            "Employee.canc_bondholder",
            "Employee.agdefaultimportselection",
            "Employee.defaultscanningfiletype",
            "Employee.forcepasswordchangedays",
            "Employee.nextpasswordchangedate",
            "Employee.smsoverrideflag",
            "Employee.smsprovider",
            "Employee.smsclientref",
            "Employee.smsusername",
            "Employee.smsserver",
            "Employee.smspage",
            "Employee.autosizedesktopwindow",
            "Employee.defaultvouchertype",
            "Employee.laststagedays",
            "Employee.enabledatalinktrayappflag",
            "Employee.showlinkedrefflag",
            "Employee.saveddocumentcategoriesflag",
            "Employee.excelformat",
            "Employee.defaultbank",
            "Employee.enablebankselection",
            "Employee.outlookaddinupdatedate",
            "Employee.filterlastinvoicedate",
            "Employee.filenotesdescendingflag",
            "Employee.filterpartyroleflag",
            "Employee.filterparty1id",
            "Employee.filterrole1id",
            "Employee.filterparty2id",
            "Employee.filterrole2id",
            "Employee.filterparty3id",
            "Employee.filterrole3id",
            "Employee.timerecordfilenoteflag",
            "Employee.firstname",
            "Employee.surname",
            "Employee.identitynumber",
            "Employee.identitytype",
            "Employee.signatoryid",
            "Employee.checksum",
            "Employee.timerecordingduration",
            "Employee.useforlexisflag",
            "Employee.assignremindertocurrentuserflag",
            "Employee.applicationpath",
            "Employee.newsendemailflag",
            "Employee.docfoxkey",
            "Employee.filterstagesinlist",
            "Employee.filterstagesnotinlist",
            "Employee.emailnotificationflag",
            "Employee.additemtosafekeepingflag",
            "Employee.smtpusername",

            "CostCentre.Description as costcentredescription",
            "EmpType.Description as emptypedescription",
            "Branch.Description as branchdescription"
        ]);
        
    }
    
    public static function employeeJoinBuilder(&$query)
    {
        $query->leftJoin('EmpType', 'Employee.EmployeeTypeID', '=', 'EmpType.RecordID')
        ->leftJoin('CostCentre', 'Employee.DefaultCostCentreId', '=', 'CostCentre.RecordID')
        ->leftJoin('Branch', 'Employee.BranchId', '=', 'Branch.RecordID');
        
    }
    
    public static function businessSelectBuilder(&$query)
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
        ELSE '***UnKnown***' END as typedescription"));
        
    }

    public static function parteleSelectBuilder(&$query)
    {
        $query->addselect("ParTele.*")
        ->addselect("Party.Name as partyname")
        ->addselect("Party.MatterPrefix as partymatterprefix")
        ->addSelect("teletype.description as teletypedescription")
        ->addSelect("teletype.internalflag as teletypeinternalflag")

        ->addselect(DB::raw("CASE 
        WHEN ParTele.PartyId > 0 THEN  CONCAT('<span onclick=\"editRecord(''globalPartyForm'',', ParTele.PartyId,')\" title=\"View the Party\" class=\"cp mr-1 lookup-wrapper\">',CONCAT(Party.MatterPrefix,' - ',Party.Name),'</span>') 
        ELSE '' END as partylink"));

    }

    public static function parteleJoinBuilder(&$query)
    {
        $query->leftJoin('party', 'partele.partyId', '=', 'party.recordid');
        $query->leftJoin('teletype', 'partele.telephonetypeId', '=', 'teletype.recordid');
        
    }

    public static function coldataSelectBuilder(&$query)
    {

        $query->addselect("ColData.*")
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.AODDate,0) = 0 OR ColData.AODDate = 0 OR ColData.AODDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.AODDate-36163 as DateTime),106) END as formattedaoddate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOInterestTo,0) = 0 OR ColData.EMOInterestTo = 0 OR ColData.EMOInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOInterestTo-36163 as DateTime),106) END as formattedemointerestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CCJInterestTo,0) = 0 OR ColData.CCJInterestTo = 0 OR ColData.CCJInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CCJInterestTo-36163 as DateTime),106) END as formattedccjinterestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CCJInterestFrom,0) = 0 OR ColData.CCJInterestFrom = 0 OR ColData.CCJInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CCJInterestFrom-36163 as DateTime),106) END as formattedccjinterestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOInterestFrom,0) = 0 OR ColData.EMOInterestFrom = 0 OR ColData.EMOInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOInterestFrom-36163 as DateTime),106) END as formattedemointerestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.ChequeDate,0) = 0 OR ColData.ChequeDate = 0 OR ColData.ChequeDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.ChequeDate-36163 as DateTime),106) END as formattedchequedate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMODate,0) = 0 OR ColData.EMODate = 0 OR ColData.EMODate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMODate-36163 as DateTime),106) END as formattedemodate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOFirstDate,0) = 0 OR ColData.EMOFirstDate = 0 OR ColData.EMOFirstDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOFirstDate-36163 as DateTime),106) END as formattedemofirstdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.JudgmentDate,0) = 0 OR ColData.JudgmentDate = 0 OR ColData.JudgmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.JudgmentDate-36163 as DateTime),106) END as formattedjudgmentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.LODDateToRespond,0) = 0 OR ColData.LODDateToRespond = 0 OR ColData.LODDateToRespond > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LODDateToRespond-36163 as DateTime),106) END as formattedloddatetorespond"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.R41LastDate,0) = 0 OR ColData.R41LastDate = 0 OR ColData.R41LastDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.R41LastDate-36163 as DateTime),106) END as formattedr41lastdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.R41NewDate,0) = 0 OR ColData.R41NewDate = 0 OR ColData.R41NewDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.R41NewDate-36163 as DateTime),106) END as formattedr41newdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.RDJInterestFromDate,0) = 0 OR ColData.RDJInterestFromDate = 0 OR ColData.RDJInterestFromDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RDJInterestFromDate-36163 as DateTime),106) END as formattedrdjinterestfromdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.MOVSaleDate,0) = 0 OR ColData.MOVSaleDate = 0 OR ColData.MOVSaleDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.MOVSaleDate-36163 as DateTime),106) END as formattedmovsaledate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.IMMSaleDate,0) = 0 OR ColData.IMMSaleDate = 0 OR ColData.IMMSaleDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.IMMSaleDate-36163 as DateTime),106) END as formattedimmsaledate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57InterestFrom,0) = 0 OR ColData.S57InterestFrom = 0 OR ColData.S57InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57InterestFrom-36163 as DateTime),106) END as formatteds57interestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57InterestTo,0) = 0 OR ColData.S57InterestTo = 0 OR ColData.S57InterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57InterestTo-36163 as DateTime),106) END as formatteds57interestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S57FirstPaymentDate,0) = 0 OR ColData.S57FirstPaymentDate = 0 OR ColData.S57FirstPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S57FirstPaymentDate-36163 as DateTime),106) END as formatteds57firstpaymentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65Date,0) = 0 OR ColData.S65Date = 0 OR ColData.S65Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65Date-36163 as DateTime),106) END as formatteds65date"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65FirstPaymentDate,0) = 0 OR ColData.S65FirstPaymentDate = 0 OR ColData.S65FirstPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65FirstPaymentDate-36163 as DateTime),106) END as formatteds65firstpaymentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65InterestFrom,0) = 0 OR ColData.S65InterestFrom = 0 OR ColData.S65InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65InterestFrom-36163 as DateTime),106) END as formatteds65interestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.S65InterestTo,0) = 0 OR ColData.S65InterestTo = 0 OR ColData.S65InterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.S65InterestTo-36163 as DateTime),106) END as formatteds65interestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.WRIInterestTo,0) = 0 OR ColData.WRIInterestTo = 0 OR ColData.WRIInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.WRIInterestTo-36163 as DateTime),106) END as formattedwriinterestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REWRIInterestTo,0) = 0 OR ColData.REWRIInterestTo = 0 OR ColData.REWRIInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REWRIInterestTo-36163 as DateTime),106) END as formattedrewriinterestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.RES65InterestTo,0) = 0 OR ColData.RES65InterestTo = 0 OR ColData.RES65InterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RES65InterestTo-36163 as DateTime),106) END as formattedres65interestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOInterestTo,0) = 0 OR ColData.REEMOInterestTo = 0 OR ColData.REEMOInterestTo > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOInterestTo-36163 as DateTime),106) END as formattedreemointerestto"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.WRIInterestFrom,0) = 0 OR ColData.WRIInterestFrom = 0 OR ColData.WRIInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.WRIInterestFrom-36163 as DateTime),106) END as formattedwriinterestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REWRIInterestFrom,0) = 0 OR ColData.REWRIInterestFrom = 0 OR ColData.REWRIInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REWRIInterestFrom-36163 as DateTime),106) END as formattedrewriinterestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.RES65InterestFrom,0) = 0 OR ColData.RES65InterestFrom = 0 OR ColData.RES65InterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.RES65InterestFrom-36163 as DateTime),106) END as formattedres65interestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOInterestFrom,0) = 0 OR ColData.REEMOInterestFrom = 0 OR ColData.REEMOInterestFrom > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOInterestFrom-36163 as DateTime),106) END as formattedreemointerestfrom"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CourtDate,0) = 0 OR ColData.CourtDate = 0 OR ColData.CourtDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CourtDate-36163 as DateTime),106) END as formattedcourtdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.ApplicationDate,0) = 0 OR ColData.ApplicationDate = 0 OR ColData.ApplicationDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.ApplicationDate-36163 as DateTime),106) END as formattedapplicationdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.PaymentDate,0) = 0 OR ColData.PaymentDate = 0 OR ColData.PaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PaymentDate-36163 as DateTime),106) END as formattedpaymentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.LastInstallmentDate,0) = 0 OR ColData.LastInstallmentDate = 0 OR ColData.LastInstallmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LastInstallmentDate-36163 as DateTime),106) END as formattedlastinstallmentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.NextInstallmentDate,0) = 0 OR ColData.NextInstallmentDate = 0 OR ColData.NextInstallmentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NextInstallmentDate-36163 as DateTime),106) END as formattednextinstallmentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.PTPStartDate,0) = 0 OR ColData.PTPStartDate = 0 OR ColData.PTPStartDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.PTPStartDate-36163 as DateTime),106) END as formattedptpstartdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.NewInDuplumRuleFromDate,0) = 0 OR ColData.NewInDuplumRuleFromDate = 0 OR ColData.NewInDuplumRuleFromDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NewInDuplumRuleFromDate-36163 as DateTime),106) END as formattednewinduplumrulefromdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOReturnOfServiceDate,0) = 0 OR ColData.EMOReturnOfServiceDate = 0 OR ColData.EMOReturnOfServiceDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOReturnOfServiceDate-36163 as DateTime),106) END as formattedemoreturnofservicedate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.REEMOReturnOfServiceDate,0) = 0 OR ColData.REEMOReturnOfServiceDate = 0 OR ColData.REEMOReturnOfServiceDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.REEMOReturnOfServiceDate-36163 as DateTime),106) END as formattedreemoreturnofservicedate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.EMOEndDate,0) = 0 OR ColData.EMOEndDate = 0 OR ColData.EMOEndDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.EMOEndDate-36163 as DateTime),106) END as formattedemoenddate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.FeesUntilDate,0) = 0 OR ColData.FeesUntilDate = 0 OR ColData.FeesUntilDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.FeesUntilDate-36163 as DateTime),106) END as formattedfeesuntildate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.CommissionUntilDate,0) = 0 OR ColData.CommissionUntilDate = 0 OR ColData.CommissionUntilDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.CommissionUntilDate-36163 as DateTime),106) END as formattedcommissionuntildate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.LastPaymentDate,0) = 0 OR ColData.LastPaymentDate = 0 OR ColData.LastPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.LastPaymentDate-36163 as DateTime),106) END as formattedlastpaymentdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ColData.NextPaymentDate,0) = 0 OR ColData.NextPaymentDate = 0 OR ColData.NextPaymentDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ColData.NextPaymentDate-36163 as DateTime),106) END as formattednextpaymentdate"));

    }

    public static function parficaSelectBuilder(&$query)
    {
        $query->addselect("ParFica.*")
        ->addselect(DB::raw("CASE WHEN ISNULL(ParFica.Date,0) = 0 OR ParFica.Date = 0 OR ParFica.Date > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParFica.Date-36163 as DateTime),106) END as formatteddate"))
        
        ->addSelect("ficaitem.RecordID")
        ->addSelect("ficaitem.Description")
        ->addSelect("ficaitem.Comments as ficaitemcomments")
        ->addSelect("ficaitem.Expiry")
        ->addselect("EntityFica.EntityID")
        ->addselect("EntityFica.FicaItemID");

    }

    public static function parficaJoinBuilder(&$query)
    {
        $query->leftJoin('FicaItem', 'ParFica.FicaItemID', '=', 'FicaItem.RecordId')
        ->leftJoin('EntityFica', 'EntityFica.FicaItemID', '=', 'FicaItem.RecordId');
        
    }

    public static function parlangSelectBuilder(&$query)
    {
        $query->addSelect("ParLang.*")
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.GPASignedOn,0) = 0 OR ParLang.GPASignedOn = 0 OR ParLang.GPASignedOn > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.GPASignedOn-36163 as DateTime),106) END as formattedgpasignedon"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.BirthDate,0) = 0 OR ParLang.BirthDate = 0 OR ParLang.BirthDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.BirthDate-36163 as DateTime),106) END as formattedbirthdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.SpouseBirthDate,0) = 0 OR ParLang.SpouseBirthDate = 0 OR ParLang.SpouseBirthDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.SpouseBirthDate-36163 as DateTime),106) END as formattedspousebirthdate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.MarriageDate,0) = 0 OR ParLang.MarriageDate = 0 OR ParLang.MarriageDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.MarriageDate-36163 as DateTime),106) END as formattedmarriagedate"))
        ->addselect(DB::raw("CASE WHEN ISNULL(ParLang.TrustDate,0) = 0 OR ParLang.TrustDate = 0 OR ParLang.TrustDate > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(ParLang.TrustDate-36163 as DateTime),106) END as formattedtrustdate"));


    }

    public static function parrelSelectBuilder(&$query)
    {
        $query->addselect("ParRel.*")
        ->addSelect("DocFoxRelationship.DocFoxId")
        ->addSelect("Relationship.Description as relationship")
        ->addSelect("Party.Name as partyname")
        ->addSelect("Party.MatterPrefix as partymatterprefix");

    }

    public static function parrelJoinBuilder(&$query)
    {
        $query->leftJoin('Relationship', 'Relationship.RecordID ', '=', 'ParRel.RelationshipID')
        ->leftJoin('Party ', 'Party.RecordID ', '=', 'ParRel.OtherPartyID')
        ->leftJoin('DocFoxRelationship', function ($join) {
            $join->on('DocFoxRelationship.ParentPartyID', '=', 'ParRel.PartyId')
            ->on('DocFoxRelationship.RelatedPartyID', '=', 'ParRel.OtherPartyID');
        });
        
    }
    
    public static function matgroupSelectBuilder(&$query)
    {
        $query->addselect("MatGroup.*")
        // ->addselect("Grouping.recordid as groupingrecordid")
        ->addselect("Grouping.description as groupingdescription");
        
    }
    
    public static function matgroupJoinBuilder(&$query)
    {
        $query->leftJoin('Grouping', 'MatGroup.GroupID ', '=', 'Grouping.RecordID');
    }

    public static function conveydataSelectBuilder(&$query)
    {
        $query->addselect("ConveyData.*")
        // ->addselect("Grouping.recordid as groupingrecordid")
        ->addselect("bondcause.description as bondcausedescription");
        
    }
    
    public static function conveydataJoinBuilder(&$query)
    {
        $query->leftJoin('bondcause', 'ConveyData.bondcauseid ', '=', 'bondcause.RecordID');
    }

    public static function parfieldSelectBuilder(&$query)
    {
        $query->addselect("ParField.*")
        ->addselect("DocScrn.*");    
        
    }
    
    public static function parfieldJoinBuilder(&$query)
    {
        $query->join('DocScrn', 'ParField.DocScreenID ', '=', 'DocScrn.RecordID');
    }

    public static function parrolscSelectBuilder(&$query)
    {
        $query->addselect("ParRolSc.*")
        ->addselect("DocScrn.*");    
        
    }
    
    public static function parrolscJoinBuilder(&$query)
    {
        $query->join('DocScrn', 'ParRolSc.RoleScreenID ', '=', 'DocScrn.RecordID');
    }

    public static function matdocscSelectBuilder(&$query)
    {
        $query->addselect("MatDocSc.*")
        ->addselect("DocScrn.*");
        
    }

    public static function matdocscJoinBuilder(&$query)
    {
        $query->join('DocScrn', 'Docscrn.recordid', '=', 'MatDocSc.DocScreenID');
    }


    public static function lolsystemtemplateSelectBuilder(&$query)
    {
        $query->addselect("lolSystemTemplate.*")
        ->addselect("Role.Description as roledescription");
        
    }
    
    public static function lolsystemtemplateJoinBuilder(&$query)
    {
        $query->leftJoin('Role', 'Role.RecordID', '=', 'lolSystemTemplate.RoleID');
        
    }


}
