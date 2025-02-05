<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BPALoginLogs extends Controller
{
    public function index(Request $request){
        $logs = DB::TABLE('bpa_login_logs')
                ->orderBy('id','desc')->get();

        return view('bpa-systemconfig.sc-loginlogs.index', compact('logs'));
    }
}
