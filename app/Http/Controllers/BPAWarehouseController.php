<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPAWarehouseController extends Controller
{
    public function index(Request $request){
        return view('bpa-warehouse.index');
    }
}
