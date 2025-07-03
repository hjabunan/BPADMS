<?php

namespace App\Http\Controllers;

use App\Models\BPAActivityCalendar;
use App\Models\BPAQuestionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BPAActivityCalendarController extends Controller
{
    public function index(){
        $events = BPAActivityCalendar::with('assigned_to', 'created_by', 'questionnaire')->where('is_deleted',0)->get();
        $users = User::where('is_deleted', 0)->get();

        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event->id,
                'key' => $event->key,
                'location' => $event->act_location,
                'supervisor' => $event->act_supervisor,
                'service_vehicle' => $event->act_servicevehicle,
                'toolbox' => $event->act_toolbox,
                'tech_on_site' => $event->act_techonsite,
                'revolving_fund' => $event->act_revolvingfund,
                'status' => $event->act_status,
                'questionnaire' => $event->questionnaire->questionnaire_name,
                'questionnaire_id' => $event->act_questionnaire,
                'sDate' => date('F j, Y', strtotime($event->act_startdate)),
                'eDate' => date('F j, Y', strtotime($event->act_enddate)),
                'color' => $event->assigned_to->color_code,
                'assigned_to' => $event->assigned_to->name,
                'assigned_to_id' => $event->act_assignedto,
                'created_by' => $event->created_by->name,
                'efilename' => $event->act_filename,

                'title' => $event->act_name,
                'start' => date('Y-m-d', strtotime($event->act_startdate)),
                'end' => date('Y-m-d', strtotime($event->act_enddate.'+1 day'))
            ];
        }

        // dd($formattedEvents[0]['efilename']);

        $qnrs = BPAQuestionnaire::with('formDetails','qtnDetails')
            ->where('status',1)
            ->orderBy('id','asc')
            ->get();

            // dd($qnr);

        return view('dashboard', ['events' => $formattedEvents], compact('qnrs', 'users'));
    }

    public function saveEventData(Request $request){
        $eventID = $request->eventID;

        $existingEvent = BPAActivityCalendar::where('id', $eventID)->first();

        $eStart = date('m/d/Y', strtotime($request->adStart));
        $eEnd = date('m/d/Y', strtotime($request->adEnd));
        
        if($existingEvent){
            $existingEvent->act_name = $request->ename;
            $existingEvent->act_filename = $request->efilename;
            $existingEvent->act_location = $request->elocation;
            $existingEvent->act_supervisor = $request->esvstl;
            $existingEvent->act_servicevehicle = $request->enosv;
            $existingEvent->act_toolbox = $request->enotb;
            $existingEvent->act_techonsite = $request->enotos;
            $existingEvent->act_revolvingfund = $request->erf;
            $existingEvent->act_startdate = $eStart;
            $existingEvent->act_enddate = $eEnd;
            $existingEvent->act_questionnaire = $request->equestionnaire;
            $existingEvent->act_assignedto = $request->eassignedto;
            $existingEvent->save();
        }else{
            $event = new BPAActivityCalendar();
            $event->act_name = $request->ename;
            $event->act_filename = $request->efilename;
            $event->act_location = $request->elocation;
            $event->act_supervisor = $request->esvstl;
            $event->act_servicevehicle = $request->enosv;
            $event->act_toolbox = $request->enotb;
            $event->act_techonsite = $request->enotos;
            $event->act_revolvingfund = $request->erf;
            $event->act_startdate = $request->adStart;
            $event->act_enddate = $request->adEnd;
            $event->act_status = 0;
            $event->act_questionnaire = $request->equestionnaire;
            $event->act_assignedto = $request->eassignedto;
            $event->act_createdby = Auth::user()->id;
            $event->key = Str::uuid();
            $event->save();
        }
        
        $result = '';

        return json_encode($result);
    }

    public function deleteEvent(Request $request){
        BPAActivityCalendar::where('key', $request->key)
            ->update(['is_deleted' => 1]);

        return redirect()->route('dashboard');
    }
}
