<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Developer;
use App\ApiAccess;
use DB;
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
