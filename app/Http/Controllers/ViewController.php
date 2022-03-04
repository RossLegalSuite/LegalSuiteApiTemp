<?php

namespace App\Http\Controllers;

use App\Custom\ControllerHelper;
use App\Custom\ParameterBuilder;
use App\Custom\QueryBuilder;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    public function viewCaller(Request $request)
    {
        if ($request->tableName) {
            $query = DB::connection('sqlsrv')->table($request->tableName);

            ParameterBuilder::ParameterBuilder($query, $request);

            if ($request->input('method')) {
                return ControllerHelper::MethodHelper($query, $request);
            }

            return ControllerHelper::DataFormatHelper($query, $request);
        } else {
            return json_encode(['errors' => 'Please enter Table Name']);
        }
    }

    public function viewCreator(Request $request)
    {
        // return $request->user()->appId.$request->viewname;
        if ($request->viewname && $request->sql) {
            try {
                DB::connection('sqlsrv')->statement("if object_id('".$request->user()->appId.$request->viewname."','v') is not null drop view ".$request->viewname);
                DB::connection('sqlsrv')->statement('CREATE VIEW '.$request->user()->appId.$request->viewname.' AS '.$request->sql.' ');
            } catch (QueryException $e) {
                return json_encode($e);
            }

            return json_encode(['Success' => 'You may access the view at legalsuiteapi.co.za'.'/'.''.$request->user()->appId.$request->viewname], JSON_UNESCAPED_SLASHES).'/'.'get';
        } else {
            return json_encode(['errors' => 'View Name or Sql Not found']);
        }
    }

    // public function raw(Request $request)
    // {
    //     // $rawQuery = $request->input('raw');
    //     // $raw = DB::select($rawQuery);
    //     // // return $rawQuery;
    //     $query = DB::connection('sqlsrv')->table('LegalSuiteLexaMattersView');

    //     if ($request->input('method')) {

    //         return ControllerHelper::MethodHelper($query, $request);

    //     }

    //     return ControllerHelper::DataFormatHelper($query, $request);

    // }

    public function logs(Request $request)
    {
        $disk = Storage::disk('logs');
        $files = $disk->files();

        $fileData = collect();
        foreach ($files as $file) {
            $fileData->push([
                'file' => $file,
                'date' => $disk->lastModified($file),
            ]);
        }
        $newest = $fileData->sortByDesc('date')->first();

        // Log::info($newest['file']);

        $contents = Storage::disk('logs')->get($newest['file']);

        return $contents;
        // Storage::disk('logs')->put('file.txt', 'Contents');
        // Log::info($contents);
        // if (Storage::disk('logs')->exists('file.txt')) {
        //     return "found";
        // }

        // return "not found";
    }
}
