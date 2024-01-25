<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPAUsersController extends Controller
{
    public function changePassword($key){
        
        return view('change-password', ['key' => $key]);
    }

    public function updatePassword(Request $request){
        
    }
}
