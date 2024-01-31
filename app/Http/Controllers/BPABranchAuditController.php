<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPABranchAuditController extends Controller
{
    public function index(Request $request){
        return view('bpa-branchaudit.index');
    }
}
