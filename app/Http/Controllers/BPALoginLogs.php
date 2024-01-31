<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPALoginLogs extends Controller
{
    public function index(Request $request){
        return view('bpa-systemconfig.sc-loginlogs.index');
    }
}
