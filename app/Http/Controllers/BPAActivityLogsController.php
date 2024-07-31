<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BPAActivityLogsController extends Controller
{
    public function index(Request $request){
        $logs = DB::TABLE('bpa_activitylogs')
                ->orderBy('id','desc')->get();

        return view('bpa-systemconfig.sc-activitylogs.index', compact('logs'));
    }
}
