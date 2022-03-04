<?php

namespace App\Http\Controllers;

use App\Custom\ControllerHelper;
use App\Custom\QueryBuilder;
use DB;
use Illuminate\Http\Request;

class LexaController extends Controller
{
    public function LegalSuiteLexaBillingQuery(Request $request)
    {
        // SELECT dbo.mattran.recordid,
        //        Dateadd(dd, dbo.mattran.date, '28 December 1800')        AS        TransactionDate,
        //        dbo.mattran.description                                  AS        BillingDescription,
        //        dbo.mattran.matterid                                     AS        MatterRecordId,
        //        dbo.mattran.invoiceno,
        //        Dateadd(dd, dbo.mattran.invoicedate, '28 December 1800') AS InvoicedDate,
        //        dbo.mattran.amount,
        //        dbo.mattran.reftype,
        //        dbo.mattran.reversedflag,
        //        dbo.matter.fileref                                       AS MatterCode,
        //        matter.mattertypeid                                      AS MatterTypeId,
        //        dbo.mattran.employeeid                                   AS MatterEmployeeIntegrationId

        // FROM   dbo.mattran
        //        LEFT OUTER JOIN dbo.matter ON dbo.matter.recordid = dbo.mattran.matterid

        // WHERE  ( dbo.mattran.reftype = 'B'
        //           OR dbo.mattran.reftype = 'C' )

        //        AND ( dbo.mattran.invoicedate > 0 )

        $query = DB::connection('sqlsrv')
        ->table('mattran');

        QueryBuilder::QueryBuilder($query, $request);

        $query->addselect('mattran.recordid')
        ->addselect(DB::raw("Dateadd(dd, mattran.date, '28 December 1800') AS TransactionDate"))
        ->addselect('mattran.description AS BillingDescription')
        ->addselect('mattran.matterid AS MatterRecordId')
        ->addselect('mattran.invoiceno')
        ->addselect(DB::raw("Dateadd(dd, mattran.invoicedate, '28 December 1800') AS InvoicedDate"))
        ->addselect('mattran.amount')
        ->addselect('mattran.reftype')
        ->addselect('mattran.reversedflag')
        ->addselect('matter.fileref AS MatterCode')
        ->addselect('matter.mattertypeid AS MatterTypeId')
        ->addselect('mattran.employeeid AS MatterEmployeeIntegrationId');

        $query->leftJoin('matter', 'matter.recordid', '=', 'mattran.matterid');

        $query->where('mattran.invoicedate', '>', 0)
        ->where(function ($query) {
            $query->where('mattran.reftype', '=', "'B'")
            ->orWhere('mattran.reftype', '=', "'C'");
        });

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function LegalSuiteLexaBillingView(Request $request)
    {
        $query = DB::connection('sqlsrv')->table('LegalSuiteLexaBillingView');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function LegalSuiteLexaFeeNoteView(Request $request)
    {
        $query = DB::connection('sqlsrv')->table('LegalSuiteLexaFeeNoteView');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function LegalSuiteLexaMattersView(Request $request)
    {
        $query = DB::connection('sqlsrv')->table('LegalSuiteLexaMattersView');

        QueryBuilder::QueryBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }
}
