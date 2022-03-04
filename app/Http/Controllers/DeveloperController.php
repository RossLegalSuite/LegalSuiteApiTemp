<?php

namespace App\Http\Controllers;

use App\ApiAccess;
use App\Client;
use App\Developer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['developer']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // SELECT * FROM admin_api_staging_3.developers
        // WHERE   developers.id NOT IN (SELECT api_access.developerId FROM admin_api_staging_3.api_access)

        // $query->whereRaw('Party.RecordID in (' . DB::raw($subQuery->toSql()) . ')');

        // $subQuery = DB::table('api_access')->select('developerId')->distinct();
        // $developers = DB::table('developers')
        // ->whereRaw('developers.id not in (' . DB::raw($subQuery->toSql())  . ')')
        // // ->whereNotIn('developers.id', [explode(",", $developerIdInApiAccess)])
        // ->get();

        // $developers = Developer::all();
        // $apiAccess = ApiAccess::all();

        // session(['developer' => $developers]);

        // session(['user_type' => 'client']);
        // logger('devs',[$developers]);
        // return Auth::id();
        $myClients = DB::table('api_access')
        ->leftJoin('clients', 'api_access.clientId', '=', 'clients.id')
        ->where('developerId', Auth::id())
        ->get();

        $allClients = DB::table('clients')
        // ->leftJoin('api_access', 'api_access.clientId', '=', 'clients.id')
        // ->where('developerId', Auth::id())
        ->get();

        // logger('myClients',[$myClients]);
        // logger('allClients',[$allClients]);
        session(['myClients' => $myClients]);
        session(['allClients' => $allClients]);

        return view('home');
    }

    // public function setApiAccess(Request $request)
    // {
        //     $apiAccess = DB::table('api_access')->where('clientId', $request->clientId)->where('developerId', $request->developerId);
        //     $flagName = $request->flagType;

        //     if ($apiAccess->get()->isEmpty())
        //     {
            //         $newApiAccess = new ApiAccess;
            //         $newApiAccess->clientId = $request->clientId;
            //         $newApiAccess->developerId = $request->developerId;
            //         $newApiAccess->$flagName = +$request->flagCheck;

            //         $newApiAccess->api_token = base64_encode(random_bytes(64));

            //         $newApiAccess->save();
            //     }else{
                //         $apiAccess->update([$flagName => +$request->flagCheck]);

                //         // $apiAccess->save();
                //     }
                //     // $apiAccess = new ApiAccess;

                //     // $apiAccess->userId = $request->userId;
                //     // $apiAccess->developerId = $request->developerId;
                //     // $apiAccess->deleteAccessFlag = $request->deleteAccessFlag;
                //     // $apiAccess->putAccessFlag = $request->putAccessFlag;
                //     // $apiAccess->postAccessFlag = $request->postAccessFlag;
                //     // $apiAccess->getAccessFlag = $request->getAccessFlag;
                //     // $apiAccess->api_token = base64_encode(random_bytes(64));

                //     // $apiAccess->save();

                //     // $apiAccess = DB::table('api_access')
                //     // ->leftJoin('developers', 'api_access.developerId', '=', 'developers.id')
                //     // ->get();

                //     // session(['apiAccess' => $apiAccess]);

                //     // return view('home');
                // }
}
