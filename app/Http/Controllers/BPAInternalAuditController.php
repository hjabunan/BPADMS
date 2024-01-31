<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPAInternalAuditController extends Controller
{
    public function index(Request $request){
        return view('bpa-internalaudit.index');
    }
}
