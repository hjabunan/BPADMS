<?php

namespace App\Http\Controllers;

use App\Models\BPACpoint;
use App\Models\BPAForms;
use App\Models\BPAProcess;
use App\Models\BPAQuestion;
use App\Models\BPAQuestionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class BPAFormsController extends Controller
{
    public function index(Request $request){
        $forms = DB::TABLE('bpa_forms')
                ->orderBy('id','asc')->get();

        $processx = DB::TABLE('bpa_process')
                ->orderBy('id','asc')->get();

        $checkpoints = BPACpoint::with('processDetails')
                ->orderBy('process_id','asc')->get();

        $questionsy = BPAQuestion::with('processDetails','cpointDetails')
                ->orderBy('process_id','asc')->get();
        
        $formsx = DB::TABLE('bpa_forms')
                ->where('status',1)
                ->orderBy('id','asc')->get();

        $existingFormIds = BPAQuestionnaire::pluck('form_id')->toArray();
        $formsy = BPAForms::with('qnrDetails')
                ->where('status',1)
                //->whereNotIn('id', $existingFormIds)
                ->orderBy('id','asc')->get();

        $processy = DB::TABLE('bpa_process')
                ->where('status',1)
                ->orderBy('id','asc')->get();

        $cpoints = DB::TABLE('bpa_cpoints')
                ->where('status',1)
                ->orderBy('process_id','asc')->get();

        $questionsx = BPAQuestion::with('processDetails','cpointDetails')
                ->where('status',1)
                ->orderBy('process_id','asc')->get();

        $questionnairex = BPAQuestionnaire::with('formDetails','qtnDetails')
                // ->where('status',1)
                ->orderBy('id','asc')->get();

        return view('bpa-systemconfig.sc-forms.index', compact('forms','processx','checkpoints','questionsy','formsx','existingFormIds','formsy','processy','cpoints','questionsx','questionnairex'));
    }
    
// FORM
    // GET DATA OF FORM
    public function getFormData(Request $request) {
        $form = DB::table('bpa_forms')
                    ->where('key', $request->keyForm)
                    ->first();
        $result = array(
            'fKey' => $form->key,
            'fID' => $form->id,
            'fname' => $form->form_name,
            'fstatus' => $form->status,
        );

        return json_encode($result);
    }

    // SAVE DATA OF FORM
    public function saveFormData(Request $request){
        if($request->formKey == null or $request->formKey == ""){
            $form = new BPAForms();
            $form->form_name = $request->fname;
            $form->status = $request->fstatus;
            $form->key = Str::uuid();
                $dirtyAttributes = $form->getDirty();
            $form->save();
        }else{
            $form = BPAForms::find($request->formID);
            $form->form_name = $request->fname;
            $form->status = $request->fstatus;
                $dirtyAttributes = $form->getDirty();
            $form->update();
        }
        
        $result = '';

        return json_encode($result);
    }

    // UPDATE STATUS OF FORM
    public function statusForm(Request $request){
        if($request->statusForm == 0){
            $stat = 1;
        }else{
            $stat = 0;
        }

        BPAForms::where('key', $request->keyForm)->update([
            'status' => $stat,
        ]);
        
        $result = '';

        return json_encode($result);
    }
    
// PROCESS
    // GET DATA OF PROCESS
    public function getProcessData(Request $request) {
        $process = DB::table('bpa_process')
                    ->where('key', $request->keyProcess)
                    ->first();
        $result = array(
            'pKey' => $process->key,
            'pID' => $process->id,
            'pname' => $process->process_name,
            'pstatus' => $process->status,
        );

        return json_encode($result);
    }

    // SAVE DATA OF PROCESS
    public function saveProcessData(Request $request){
        if($request->processKey == null or $request->processKey == ""){
            $process = new BPAProcess();
            $process->process_name = $request->pname;
            $process->status = $request->pstatus;
            $process->key = Str::uuid();
                $dirtyAttributes = $process->getDirty();
            $process->save();
        }else{
            $process = BPAProcess::find($request->processID);
            $process->process_name = $request->pname;
            $process->status = $request->pstatus;
                $dirtyAttributes = $process->getDirty();
            $process->update();
        }
        
        $result = '';

        return json_encode($result);
    }

    // UPDATE STATUS OF PROCESS
    public function statusProcess(Request $request){
        if($request->statusProcess == 0){
            $stat = 1;
        }else{
            $stat = 0;
        }

        BPAProcess::where('key', $request->keyProcess)->update([
            'status' => $stat,
        ]);
        
        $result = '';

        return json_encode($result);
    }
    
// CHECKPOINT
    // GET DATA OF CHECKPOINT
    public function getCPointData(Request $request) {
        $cpoint = DB::table('bpa_cpoints')
                    ->where('key', $request->keyCPoint)
                    ->first();
        $result = array(
            'cpKey' => $cpoint->key,
            'cpID' => $cpoint->id,
            'cpname' => $cpoint->cpoint_name,
            'cpprocess' => $cpoint->process_id,
            'cpstatus' => $cpoint->status,
        );

        return json_encode($result);
    }

    // SAVE DATA OF CHECKPOINT
    public function saveCPointData(Request $request){
        if($request->cpointKey == null or $request->cpointKey == ""){
            $check = new BPACpoint();
            $check->cpoint_name = $request->cpname;
            $check->process_id = $request->cpprocess;
            $check->status = $request->cpstatus;
            $check->key = Str::uuid();
                $dirtyAttributes = $check->getDirty();
            $check->save();
        }else{
            $check = BPACpoint::find($request->cpointID);
            $check->cpoint_name = $request->cpname;
            $check->process_id = $request->cpprocess;
            $check->status = $request->cpstatus;
                $dirtyAttributes = $check->getDirty();
            $check->update();
        }
        
        $result = '';

        return json_encode($result);
    }

    // UPDATE STATUS OF CHECKPOINT
    public function statusCPoint(Request $request){
        if($request->statusCPoint == 0){
            $stat = 1;
        }else{
            $stat = 0;
        }

        BPACpoint::where('key', $request->keyCPoint)->update([
            'status' => $stat,
        ]);
        
        $result = '';

        return json_encode($result);
    }

// QUESTION
    // GET DATA OF QUESTION
    public function getQuestionData(Request $request) {
        $question = DB::table('bpa_questions')
                    ->where('key', $request->keyQuestion)
                    ->first();
        $result = array(
            'qKey' => $question->key,
            'qID' => $question->id,
            'question' => $question->question,
            'qprocess' => $question->process_id,
            'qcpoint' => $question->cpoint_id,
            'qpoint' => $question->question_point,
            'qstatus' => $question->status,
        );

        return json_encode($result);
    }

    // SAVE DATA OF QUESTION
    public function saveQuestionData(Request $request){
        if($request->questionKey == null or $request->questionKey == ""){
            $question = new BPAQuestion();
            $question->question = $request->qquestion;
            $question->process_id = $request->qprocess;
            $question->cpoint_id = $request->qcpoint;
            $question->question_point = $request->qpoint;
            $question->status = $request->qstatus;
            $question->key = Str::uuid();
                $dirtyAttributes = $question->getDirty();
            $question->save();
        }else{
            $question = BPAQuestion::find($request->questionID);
            $question->question = $request->qquestion;
            $question->process_id = $request->qprocess;
            $question->cpoint_id = $request->qcpoint;
            $question->question_point = $request->qpoint;
            $question->status = $request->qstatus;
                $dirtyAttributes = $question->getDirty();
            $question->update();
        }
        
        $result = '';

        return json_encode($result);
    }

    // UPDATE STATUS OF QUESTION
    public function statusQuestion(Request $request){
        if($request->statusQuestion == 0){
            $stat = 1;
        }else{
            $stat = 0;
        }

        BPAQuestion::where('key', $request->keyQuestion)->update([
            'status' => $stat,
        ]);
        
        $result = '';

        return json_encode($result);
    }

// QUESTIONNAIRE
    // SAVE DATA OF QUESTIONNAIRE
    public function saveQuestionnaireData(Request $request){
        $formId = $request->qtrform;

        // dd($formId);
        $selectedQuestions = implode(',', $request->input('question'));

        $existingQuestionnaire = BPAQuestionnaire::where('form_id', $formId)->first();

        if($existingQuestionnaire){
            $existingQuestionnaire->question_list = $selectedQuestions;
            $existingQuestionnaire->update();
        }else{
            $qnr = new BPAQuestionnaire();
            $qnr->questionnaire_name = $request->qtrform;
            $qnr->form_id = $request->qtrform;
            $qnr->question_list = $selectedQuestions;
            $qnr->key = Str::uuid();
            $qnr->save();
        }
        
        $result = '';

        return json_encode($result);
    }

    // GET DATA OF QUESTIONNAIRE
    public function getQuestionnaireData(Request $request){
        // $formId = $request->formQ;
        $questionnaire = BPAQuestionnaire::where('key', $request->keyQuestionnaire)->first();

        if ($questionnaire) {
            return response()->json(['form_id' => $questionnaire->form_id,'question_list' => explode(',', $questionnaire->question_list)], 200);
        }
    }

    // UPDATE STATUS OF QUESTION
    public function statusQuestionnaire(Request $request){
        if($request->statusQuestionnaire == 0){
            $stat = 1;
        }else{
            $stat = 0;
        }

        BPAQuestionnaire::where('key', $request->keyQuestionnaire)->update([
            'status' => $stat,
        ]);
        
        $result = '';

        return json_encode($result);
    }

    // SEARCH OF QUESTIONNAIRE
    public function selectQuestionnaire(Request $request){
        $questionsy = BPAQuestion::with('processDetails','cpointDetails')
                ->orderBy('process_id','asc')->get();

        $questionnairex = BPAQuestionnaire::with('formDetails','qtnDetails')
                ->where('id',$request->qnrprocessValue)
                ->orderBy('id','asc')->get();

            $result = '';
        if(count($questionnairex) > 0){
            foreach($questionnairex as $qnrx){
                $result .= '
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-2 text-center whitespace-nowrap">
                            ';

                if ($qnrx->status == 0) {
                    $result .= '
                        <button type="button" data-key="'.$qnrx->key.'" class="btnEditQuestionnaire" id="btnEditQuestionnaire">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1">
                                <path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-.2.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/>
                                <path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/>
                            </svg>
                        </button>
                        <button type="button" data-key="'.$qnrx->key.'" data-name="'.$qnrx->formDetails->form_name.'" data-qstatus="'.$qnrx->status.'" class="btnActQuestionnaire" id="btnActQuestionnaire">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                            </svg>
                        </button>
                    ';
                } else {
                    $result .= '
                        <button type="button" data-key="'.$qnrx->key.'" class="btnEditQuestionnaire" id="btnEditQuestionnaire">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1">
                                <path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/>
                                <path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/>
                            </svg>
                        </button>
                        <button type="button" data-key="'.$qnrx->key.'" data-name="'.$qnrx->formDetails->form_name.'" data-qstatus="'.$qnrx->status.'" class="btnActQuestionnaire" id="btnActQuestionnaire">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                            </svg>
                        </button>
                    ';
                }

                $result .= '
                            </td>
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                '.$qnrx->formDetails->form_name.'
                            </td>
                            <td class="px-6 py-2 text-left whitespace-nowrap">
                                ';

                foreach (explode(",", $qnrx->question_list) as $questionId) {
                    foreach ($questionsy as $question) {
                        if ($question->id == $questionId) {
                            $result .= '<p>• ' . $question->question . '</p>';
                        }
                    }
                }

                $result .= '
                            </td>
                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                ';

                if ($qnrx->status == 0) {
                    $result .= '<p class="text-red-500 bg-red-200">Inactive</p>';
                } else {
                    $result .= '<p class="text-green-500 bg-green-200">Active</p>';
                }

                $result .= '
                            </td>
                        </tr>
                    ';
                }
        }else{
            $result .='
                        <tr class="bg-white border-b hover:bg-gray-200">
                            <td class="px-1 py-0.5 col-span-7 text-center items-center">
                                No data.
                            </td>
                        </tr>
                ';
        }
        echo $result;
    }
}
