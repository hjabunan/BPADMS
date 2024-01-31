<?php

namespace App\Listeners;

use App\Models\LoginLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Session;

class LogFailedLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event){
        
        $failedLogin = Session::get('failed_login');

        $reason = $failedLogin['reason'];

        if ($failedLogin) {
            $reason = $failedLogin['reason'];
    
            LoginLog::create([
                'login_username' => $failedLogin['login'],
                'login_time' => now(),
                'login_ipaddress' => request()->ip(),
                'login_eventtype' => 'login',
                'login_status' => 'failed',
                'failure_reason' => $reason,
            ]);
        }
    
        Session::forget('failed_login');
    }
}
