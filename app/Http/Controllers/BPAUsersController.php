<?php

namespace App\Http\Controllers;

use App\Models\BPAActivityLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BPAUsersController extends Controller
{
    // FIRST TIME LOGIN
    public function changePassword($key){
        return view('change-password', ['key' => $key]);
    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request){
        // $users = User::where('key', $request->userKey)->latest()->first();

            // $oldUser = User::where('key', $request->userKey)->where('is_deleted', '0')->first();
            // User::where('key',$request->userKey)->update([
            //     'first_time' => 0,
            //     'password' => Hash::make($request->newPassword),
            // ]);
            
            // $updatedUser  = DB::table('bpa_users')
            //             ->where('key', $request->userKey)
            //             ->where('is_deleted', '0')
            //             ->get();

            // if ($oldUser->toArray() !== $updatedUser->toArray()) {
            //     // Iterate through the fields and log changes
            //     foreach ($updatedUser->getAttributes() as $field => $newValue) {
            //         $oldValue = $oldUser->getOriginal($field);
            
            //         if ($oldValue !== $newValue) {
            //             $field = ucwords(str_replace('_', ' ', $field));
            
            //             $newLog = new BPAActivityLogs();
            //             $newLog->table = 'User Table'; // Update with the appropriate table name
            //             $newLog->table_key = $updatedUser->id; // Update with the appropriate primary key
            //             $newLog->action = 'UPDATE';
            //             $newLog->description = $users->POUSerialNum;
            //             $newLog->field = $field;
            //             $newLog->before = $oldValue;
            //             $newLog->after = $newValue;
            //             $newLog->user_id = Auth::user()->id;
            //             $newLog->ipaddress = request()->ip();
            //             $newLog->save();
            //         }
            //     }
        // }
        $users = User::where('key', $request->userKey)->latest()->first();

        // Retrieve the old values before updating the user record
        $oldUser = User::where('key', $request->userKey)->first();

        User::where('key', $request->userKey)->update([
            'first_time' => 0,
            'password' => Hash::make($request->newPassword),
        ]);

        // Retrieve the updated user record
        $updatedUser = User::where('key', $request->userKey)->first();

        $excludedFields = ['id', 'created_at', 'updated_at'];

        // Check if there are any changes in the user record
        if ($oldUser->toArray() !== $updatedUser->toArray()) {
            // Iterate through the fields and log changes
            foreach ($updatedUser->getAttributes() as $field => $newValue) {
                if (in_array($field, $excludedFields)) {
                    continue;
                }

                $oldValue = $oldUser->getOriginal($field);

                if ($oldValue !== $newValue) {
                    $field = ucwords(str_replace('_', ' ', $field));

                    $newLog = new BPAActivityLogs();
                    $newLog->table = 'User Table'; // Update with the appropriate table name
                    $newLog->table_key = $updatedUser->id; // Update with the appropriate primary key
                    $newLog->action = 'UPDATE';
                    $newLog->description = $users->name;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress = request()->ip();
                    $newLog->save();
                }
            }
        }

        $result = "";
        
        return response()->json($result);
    }
    
    // INDEX
    public function index(Request $request){
        $users = DB::TABLE('bpa_users')
                ->where('is_deleted',0)
                ->orderBy('id','asc')->get();

        return view('bpa-systemconfig.sc-users.index', compact('users'));
    }

    // GET DATA OF USER
    public function getUserData(Request $request) {
        $user = DB::table('bpa_users')
                    ->where('key', $request->keyUser)
                    ->first();
        $result = array(
            'uKey' => $user->key,
            'uID' => $user->id,
            'fullname' => $user->name,
            'email' => $user->email,
            'username' => $user->idnum,
            'role' => $user->role,
            'uaccess' => $user->access,
            'status' => $user->status,
            'color_code' => $user->color_code,
            'expdate' => $user->validity_date,
        );

        return json_encode($result);
    }

    // SAVE DATA OF USER
    public function saveUserData(Request $request){
        // DEFAULT PASSWORD : H@ndl!ng@2024!
        if($request->userKey == null or $request->userKey == ""){
            $user = new User();
            $user->name = $request->fname;
            $user->email = $request->email;
            $user->idnum = $request->username;
            $user->password = Hash::make('H@ndl!ng@2024!');
            $user->role = $request->role;
                if($request->role == 2){
                    $user->access = implode(',', $request->input('uaccess', []));
                }else{
                    $user->access = "";
                }

                if($request->ustatus == 1){
                    if($request->input('radioExp') === '1' && $request->has('expiration-days')) {
                        $user->validity_date = now()->addDays($request->input('expiration-days'));
                        $user->status = 1;
                    }elseif($request->input('radioExp') === '2' && $request->has('expirationdate')) {
                        $user->validity_date = $request->input('expirationdate');
                        $user->status = 1;
                    }else{
                        $user->validity_date = "";
                        $user->status = -1;
                    }
                }else{
                    $user->validity_date = "";
                    $user->status = 0;
                }
            $user->color_code = $request->input('usercolor');
            $user->key = Str::uuid();
                $dirtyAttributes = $user->getDirty();
            $user->save();
        
                foreach ($dirtyAttributes as $attribute => $newValue) {
                    $field = ucwords(str_replace('_', ' ', $attribute));
                    $newValue = $user->getAttribute($attribute);
                    
                    $newLog = new BPAActivityLogs();
                    $newLog->table = 'User Table';
                    $newLog->table_key = $user->id;
                    $newLog->action = 'ADD';
                    $newLog->description = $user->idnum;
                    $newLog->field = $field;
                    $newLog->before = null;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress =  request()->ip();
                    $newLog->save();
                }
        }else{
            $user = User::find($request->userID);
            $user->name = $request->fname;
            $user->email = $request->email;
            $user->idnum = $request->username;
            $user->role = $request->role;
                if($request->role == 2){
                    $user->access = implode(',', $request->input('uaccess', []));
                }else{
                    $user->access = "";
                }

                if($request->ustatus == 1){
                    if($request->input('radioExp') === '1' && $request->has('expiration-days')) {
                        $user->validity_date = now()->addDays($request->input('expiration-days'));
                        $user->status = 1;
                    }elseif($request->input('radioExp') === '2' && $request->has('expirationdate')) {
                        $user->validity_date = $request->input('expirationdate');
                        $user->status = 1;
                    }else{
                        $user->validity_date = "";
                        $user->status = -1;
                    }
                }else{
                    $user->validity_date = "";
                    $user->status = 0;
                }
            $user->color_code = $request->input('usercolor');
            $user->key = Str::uuid();
                $dirtyAttributes = $user->getDirty();
        
                foreach($dirtyAttributes as $attribute => $newValue){
                    $oldValue = $user->getOriginal($attribute);
        
                    $field = ucwords(str_replace('_', ' ', $attribute));

                    $newLog = new BPAActivityLogs();
                    $newLog->table = 'User Table';
                    $newLog->table_key = $user->id;
                    $newLog->action = 'UPDATE';
                    $newLog->description = $user->idnum;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress =  request()->ip();
                    $newLog->save();
                }
            $user->update();
        }

        $result = '';

        return json_encode($result);
    }

    // GET NAME OF USER
    public function getNameUser(Request $request){
        $user = DB::table('bpa_users')
                    ->where('key', $request->keyUser)
                    ->first();
        $result = array(
            'uKey' => $user->key,
            'uID' => $user->id,
            'fullname' => $user->name,
            'email' => $user->email,
            'username' => $user->idnum,
            'role' => $user->role,
            'uaccess' => $user->access,
            'status' => $user->status,
            'color_code' => $user->color_code,
            'expdate' => $user->validity_date,
        );

        return json_encode($result);
    }

    // RESET PASSWORD OF USER
    public function resetPasswordUser(Request $request){
        $users = User::where('key', $request->keyUser)->latest()->first();
        $oldUser = User::where('key', $request->keyUser)->first();

        User::where('key', $request->keyUser)->update([
            'first_time' => 1,
            'password' => Hash::make('H@ndl!ng@2024!'),
        ]);

        $updatedUser = User::where('key', $request->keyUser)->first();
        $excludedFields = ['id', 'created_at', 'updated_at'];

        if ($oldUser->toArray() !== $updatedUser->toArray()) {
            foreach ($updatedUser->getAttributes() as $field => $newValue) {
                if (in_array($field, $excludedFields)) {
                    continue;
                }

                $oldValue = $oldUser->getOriginal($field);

                if ($oldValue !== $newValue) {
                    $field = ucwords(str_replace('_', ' ', $field));

                    $newLog = new BPAActivityLogs();
                    $newLog->table = 'User Table';
                    $newLog->table_key = $updatedUser->id;
                    $newLog->action = 'UPDATE';
                    $newLog->description = $users->name;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress = request()->ip();
                    $newLog->save();
                }
            }
        }

        $result = "";

        return json_encode($result);
    }

    // DELETION OF USER
    public function deleteUser(Request $request){
        $users = User::where('key', $request->keyUser)->latest()->first();
        $oldUser = User::where('key', $request->keyUser)->first();

        User::where('key', $request->keyUser)->update([
            'is_deleted' => 1,
        ]);

        $updatedUser = User::where('key', $request->keyUser)->first();
        $excludedFields = ['id', 'created_at', 'updated_at'];

        if ($oldUser->toArray() !== $updatedUser->toArray()) {
            foreach ($updatedUser->getAttributes() as $field => $newValue) {
                if (in_array($field, $excludedFields)) {
                    continue;
                }

                $oldValue = $oldUser->getOriginal($field);

                if ($oldValue !== $newValue) {
                    $field = ucwords(str_replace('_', ' ', $field));

                    $newLog = new BPAActivityLogs();
                    $newLog->table = 'User Table';
                    $newLog->table_key = $updatedUser->id;
                    $newLog->action = 'UPDATE';
                    $newLog->description = $users->name;
                    $newLog->field = $field;
                    $newLog->before = $oldValue;
                    $newLog->after = $newValue;
                    $newLog->user_id = Auth::user()->id;
                    $newLog->ipaddress = request()->ip();
                    $newLog->save();
                }
            }
        }

        $result = "";

        return json_encode($result);
    }
}
