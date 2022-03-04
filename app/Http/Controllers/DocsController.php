<?php

namespace App\Http\Controllers;

use App\ApiAccess;
use App\Client;
use App\Developer;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocsController extends Controller
{
    public function index()
    {
        return view('docs');
    }

    public function databaseDocument()
    {
        return view('databaseDocument');
    }
}
