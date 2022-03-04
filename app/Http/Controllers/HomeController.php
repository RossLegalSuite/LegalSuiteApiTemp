<?php

namespace App\Http\Controllers;

use App\ApiAccess;
use App\Client;
use App\Developer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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

        $apiAccessTable = DB::table('developers')
        ->selectRaw('*,developers.id as devId')
        ->leftJoin('api_access', function ($join) {
            $join->on('developers.id', '=', 'api_access.developerId')
            ->where('clientId', '=', Auth::id());
        })
        ->orderBy('devId', 'asc');
        // ->leftJoin('api_access', 'developers.id', '=', 'api_access.developerId')
        // ->where('clientId', Auth::id())
        // ->orWhereNull('clientId')
        // logger('apiAccessTable',[$apiAccessTable->toSql()]);

        session(['apiAccessTable' => $apiAccessTable->get()]);
        // session(['developer' => $developers]);
        // session(['user_type' => 'client']);
        return view('home');
    }

    public function setApiAccess(Request $request)
    {
        // logger('devs',[$request->all()]);
        $apiAccess = DB::table('api_access')->where('clientId', $request->clientId)->where('developerId', $request->developerId);
        $flagName = $request->flagType;
        $developer = DB::table('developers')->where('Id', $request->developerId)->first();
        if ($apiAccess->get()->isEmpty()) {
            $newApiAccess = new ApiAccess;

            $newApiAccess->clientId = $request->clientId;
            $newApiAccess->developerId = $request->developerId;
            $newApiAccess->$flagName = +$request->flagCheck;

            $newApiAccess->api_token = base64_encode(random_bytes(64));

            // $x = $developer->pluck('getAccessFlag');

            // logger($x);
            $newApiAccess->getAccessFlag = $developer->getAccessFlag;
            $newApiAccess->postAccessFlag = $developer->postAccessFlag;
            $newApiAccess->putAccessFlag = $developer->putAccessFlag;
            $newApiAccess->deleteAccessFlag = $developer->deleteAccessFlag;

            $newApiAccess->save();
        } else {
            $apiAccess->update([$flagName => +$request->flagCheck]);

            // $apiAccess->save();
        }
        // $apiAccess = new ApiAccess;

        // $apiAccess->userId = $request->userId;
        // $apiAccess->developerId = $request->developerId;
        // $apiAccess->deleteAccessFlag = $request->deleteAccessFlag;
        // $apiAccess->putAccessFlag = $request->putAccessFlag;
        // $apiAccess->postAccessFlag = $request->postAccessFlag;
        // $apiAccess->getAccessFlag = $request->getAccessFlag;
        // $apiAccess->api_token = base64_encode(random_bytes(64));

        // $apiAccess->save();

        // $apiAccess = DB::table('api_access')
        // ->leftJoin('developers', 'api_access.developerId', '=', 'developers.id')
        // ->get();

        // session(['apiAccess' => $apiAccess]);

        return view('home');
    }
}
