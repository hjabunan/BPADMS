<?php

namespace App\Http\Controllers;

use App\Models\BPAActivityCalendar;
use App\Models\BPAQuestion;
use App\Models\BPASurvey;
use App\Models\BPAAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BPAImprovementController extends Controller
{
    public function index(Request $request, $key){
        
        $questionnairex = BPAActivityCalendar::where('bpa_activitycalendars.key', $key)->first();
        $questionnaire = BPAActivityCalendar::where('bpa_activitycalendars.key', $key)->join('bpa_questionnaires','bpa_activitycalendars.act_questionnaire','bpa_questionnaires.id')->first();

        if ($questionnaire) {

            $questionList = explode(',', $questionnaire->question_list);
            $questions = BPAQuestion::with('processDetails','cpointDetails')->whereIn('id', $questionList)->orderBy('process_id')->get();

            $survey = BPASurvey::where('act_id', $questionnairex->id)->get();
            $surveyMap = $survey->keyBy('qtn_id');

            $surveyScores = DB::table('bpa_surveys')
            ->join('bpa_questions', 'bpa_surveys.qtn_id', '=', 'bpa_questions.id')
            ->whereIn('bpa_questions.id', $questionList)
            ->select('bpa_questions.process_id', DB::raw('SUM(bpa_surveys.survey_score) as total_score'))
            ->where('bpa_surveys.act_id', $questionnairex->id)
            ->groupBy('bpa_questions.process_id')
            ->get();

            $surveyScoresMap = $surveyScores->pluck('total_score', 'process_id')->map(function ($score) {
                return number_format($score, 2, '.', '');
            });

            $surveyRemark = BPAActivityCalendar::where('key', $key)->first()->surv_Remarks;

            $totalSum = $surveyScoresMap->sum();
            
            $attachments = BPAAttachment::where('act_id', $questionnairex->id)
            ->whereIn('qtn_id', $questionList)
            ->get()
            ->groupBy('qtn_id');

            $surveyPercentages = BPAActivityCalendar::where('key', $key)->first([
                'percent_GenOp',
                'percent_Doc',
                'percent_PartMgnt',
                'percent_Prsnl',
                'percent_5SPrac',
                'surv_TotPercent'
            ]);

            // $PWGenOp = $surveyPercentages->percent_GenOp * $questions->process_weight;

            return view('bpa-improvement.index', [  
                'questionnairex' => $questionnairex,
                'questionnaire' => $questionnaire,
                'form_id' => $questionnaire->form_id,
                'questions' => $questions,
                'survey' => $survey,
                'surveyMap' => $surveyMap,
                'surveyScores' => $surveyScoresMap,
                'survRemarks' => $surveyRemark,
                'surveyScoreSum' => $totalSum,
                'attachments' => $attachments,
                'surveyPercentages' => $surveyPercentages,
                // 'uploadedFiles' => $uploadedFiles,
            ]);
        }
    }

    public function saveSurvey(Request $request){
        $activity = BPAActivityCalendar::where('bpa_activitycalendars.id', $request->actID)->first();
        $qtnID = $request->counter;
        $isSubmit = $request->isSubmit;

        if($isSubmit == 1){
            $activity->surv_Remarks = $request->sRemarks;
            $activity->update();
        }else{
            $existingS1 = BPASurvey::where('act_id', $request->actID)->where('qnr_id', $request->qnrID)->where('qtn_id', $request->counter)->first();

            if($existingS1){
                $existingS1->survey_score = $request->rangeValue;
                $existingS1->survey_remarks = $request->remarks;
                $existingS1->update();
    
                $activity->surv_GenOp = $request->GenOp;
                $activity->surv_Doc = $request->Doc;
                $activity->surv_PartMgnt = $request->PartM;
                $activity->surv_Prsnl = $request->Per;
                $activity->surv_5SPrac = $request->x5S;
                $activity->surv_TotRate = $request->Total;
                $activity->percent_GenOp = $request->PGenOp;
                $activity->percent_Doc = $request->PDoc;
                $activity->percent_PartMgnt = $request->PPartM;
                $activity->percent_Prsnl = $request->PPer;
                $activity->percent_5SPrac = $request->Px5S;
                $activity->surv_Remarks = $request->sRemarks;
                $activity->update();
            }else{
                $survey = new BPASurvey();
                $survey->act_id = $request->actID;
                $survey->qnr_id = $request->qnrID;
                $survey->qtn_id = $request->counter;
                $survey->survey_score = $request->rangeValue;
                $survey->survey_remarks = $request->remarks;
                $survey->key = Str::uuid();
                $survey->save();
    
                $activity->surv_GenOp = $request->GenOp;
                $activity->surv_Doc = $request->Doc;
                $activity->surv_PartMgnt = $request->PartM;
                $activity->surv_Prsnl = $request->Per;
                $activity->surv_5SPrac = $request->x5S;
                $activity->surv_TotRate = $request->Total;
                $activity->percent_GenOp = $request->PGenOp;
                $activity->percent_Doc = $request->PDoc;
                $activity->percent_PartMgnt = $request->PPartM;
                $activity->percent_Prsnl = $request->PPer;
                $activity->percent_5SPrac = $request->Px5S;
                $activity->surv_Remarks = $request->sRemarks;
                $activity->update();
            }
        }
        
        return response()->json(['status' => 'success', 'message' => 'Survey saved successfully.']);
    }

    public function saveAttach(Request $request){
        $actID = $request->act_id;
        $qnrID = $request->qnr_id;
        $qtnID = $request->question_id;

        $filename = BPAActivityCalendar::where('id', $actID)->first()->act_filename;
    
        $uploadedFiles = [];
        $paths = []; // Array to collect paths for semicolon-separated storage

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $code = $actID . $qnrID . $qtnID;

                $newFilename = $filename . '/' . $code . '-' . strtotime(date('YmdHis')) . '-' . $index . '.' . $file->getClientOriginalExtension();
                $path = "attachments/";

                //New Folder every event
                $folderPath = "attachments/{$filename}/";
                $storagePath = public_path('storage/' . $folderPath);

                // Ensure directory exists
                if (!file_exists($storagePath)) {
                    mkdir($storagePath, 0777, true);
                }

                $file->move($storagePath, $newFilename);
                $filePath = $path . $newFilename;
                $cleanedPath = str_replace('attachments/', '', $filePath);
                $paths[] = $filePath;

                $uploadedFiles[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $filePath,
                    'pathx' => $cleanedPath,
                ];
            }

            $attachment = BPAAttachment::where('act_id', $actID)
            ->where('qnr_id', $qnrID)
            ->where('qtn_id', $qtnID)
            ->first();

            if ($attachment) {
                $existingPaths = explode(';', $attachment->path);
                $existingPaths = array_filter($existingPaths);

                if (count($existingPaths) > 0) {
                    $allPaths = array_merge($existingPaths, $paths);
                    $attachment->path = implode(';', $allPaths);
                } else {
                    $attachment->path = implode(';', $paths);
                }

                $attachment->save();
            } else {
                $attachment = new BPAAttachment();
                $attachment->act_id = $actID;
                $attachment->qnr_id = $qnrID;
                $attachment->qtn_id = $qtnID;
                $attachment->uploader = $request->user()->id;
                $attachment->path = implode(';', $paths);
                $attachment->key = Str::uuid();
                $attachment->save();
            }
        }
            return response()->json(['success' => true, 'files' => $uploadedFiles, 'path' => $cleanedPath, 'attachment' => $attachment]);
    }

    public function removeAttach(Request $request){
        $path = $request->path;
        $attachment = BPAAttachment::where('path', 'like', '%' . $path . '%')->first();

        $filename = BPAActivityCalendar::where('id', $attachment->act_id)->first()->act_filename;
        // $path2 = 'storage/'. $filename . '/' . $request->path;
        $path2 = 'storage/' . $request->path;


        if ($attachment) {
            
            if (File::exists($path2)) {
                File::delete($path2);
            }

            // Remove the file path from the database field
            if (strpos($attachment->path, ';') !== false) {
                $paths = explode(';', $attachment->path); // Split the paths by ';'
                $paths = array_filter($paths, function ($item) use ($path) {
                    return trim($item) !== $path; // Filter out the path to be deleted
                });
                $attachment->path = implode(';', $paths); // Reassemble the remaining paths
            } else {
                // If there is only one path, simply clear it
                $attachment->path = str_replace($path, '', $attachment->path);
            }

            // Update the attachment record
            $attachment->update();
        }

        return response()->json(['status' => 'success', 'message' => 'Attachment removed successfully.']);
    }
}
