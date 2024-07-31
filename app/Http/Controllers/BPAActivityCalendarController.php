<?php

namespace App\Http\Controllers;

use App\Models\BPAActivityCalendar;
use App\Models\BPAQuestionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BPAActivityCalendarController extends Controller
{
    public function index(){
        $events = DB::TABLE('bpa_activitycalendars')->get();  

        // Log::info($events);
        // return view('dashboard', ['events' => $events]);
        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event->id,
                'key' => $event->key,
                'location' => $event->act_location,
                'supervisor' => $event->act_supervisor,
                'status' => $event->act_status,
                'sDate' => $event->act_startdate,
                'eDate' => $event->act_enddate,

                'title' => $event->act_name,
                'start' => date('Y-m-d', strtotime($event->act_startdate)),
                'end' => date('Y-m-d', strtotime($event->act_enddate))
                // 'color' => $ecolor,
            ];
        }

        $qnr = BPAQuestionnaire::with('formDetails','qtnDetails')
            ->where('status',1)
            ->orderBy('id','asc')->get();

            // dd($qnr);

        return view('dashboard', ['events' => $formattedEvents], compact('qnr'));
    }

    public function saveEventData(Request $request){
        $eventID = $request->eventID;

        $existingEvent = BPAActivityCalendar::where('id', $eventID)->first();

        if($existingEvent){
            // $existingQuestionnaire->question_list = $selectedQuestions;
            // $existingQuestionnaire->update();
        }else{
            $event = new BPAActivityCalendar();
            $event->act_name = $request->ename;
            $event->act_location = $request->elocation;
            $event->act_supervisor = $request->esvstl;
            $event->act_startdate = $request->adStart;
            $event->act_enddate = $request->adEnd;
            $event->act_status = $request->estatus;
            $event->act_user = Auth::user()->id;
            $event->key = Str::uuid();
            $event->save();
        }
        
        $result = '';

        return json_encode($result);
    }
}
