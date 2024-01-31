<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BPAUsersController extends Controller
{
    public function changePassword($key){
        
        return view('change-password', ['key' => $key]);
    }

    public function updatePassword(Request $request){
        User::where('key',$request->userKey)->update([
            'first_time' => 0,
            'password' => Hash::make($request->newPassword),
        ]);

        $result = "";

        // $user = User::find($request->userKey);
        // $user->first_time = 0;
        // $user->password = Hash::make($request->newPassword);
        // $user->update();

        
        return response()->json($result);
    }
    
    public function index(Request $request){
        return view('bpa-systemconfig.sc-users.index');
    }
}
