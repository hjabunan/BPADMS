<x-app-layout>
    <div style="height: calc(100vh - 65px);" class="py-3 overflow-x-auto">
        <div class="max-w-8xl mx-auto sm:px-5 lg:px-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 h-full">
                    {{-- Title --}}
                    <div class="px-4 grid grid-cols-2 gap-x-3 mb-5 border-b h-[49px]">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            Improvement Evaluation Audit
                        </div>
                        <div class="justify-self-end">
                            <button type="button" id="btnSummary" name="btnSummary" data-drawer-target="drawer-form" data-drawer-show="drawer-form" aria-controls="drawer-form" class="text-white bg-gradient-to-r from-gray-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2 ">SUMMARY</button>
                            <button type="button" id="btnHome" name="btnHome" class="text-white bg-gradient-to-r from-gray-600 via-gray-700 to-gray-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2 ">BACK</button>
                        </div>
                    </div>
                                
                    {{-- Body --}}
                    <div class="flex flex-col gap-4" style="height: calc(100vh - 178px);">
                        @csrf
                        <div id="default-tab-content">
                            <div class="mb-3 col-span-2 sm:col-span-2 w-full">
                                <div class="grid justify-items-start">
                                    <div class="mb-4 border-b border-gray-200">
                                        <input type="text" id="act_id" class="hidden" value="{{$questionnairex->id}}">
                                        <input type="text" id="qnr_id" class="hidden" value="{{$questionnaire->act_questionnaire}}">
                                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="process-tabs" data-tabs-toggle="#process-tab-content" role="tablist">
                                            @php
                                                $processCounter = 0;
                                                $previousProcess = null;
                                            @endphp
                                            @foreach($questions as $question)
                                                <input type="text" id="question-category-{{ $question->id }}" class="hidden" value="{{ $question->processDetails->process_name }}" /> 
                                                @if ($question->processDetails->process_name != $previousProcess)
                                                    @php
                                                        $processCounter++;
                                                        $previousProcess = $question->processDetails->process_name;
                                                    @endphp
                                                    <li class="me-2" role="presentation">
                                                        <button class="inline-block p-2 border-b-2 rounded-t-lg" id="process{{$processCounter}}-tab" data-tabs-target="#process{{$processCounter}}" type="button" role="tab" aria-controls="process{{$processCounter}}" aria-selected="false">
                                                            {{ $question->processDetails->process_name }}
                                                        </button>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div id="process-tab-content" class="overflow-y-auto bg-gray-50" style="max-height: 679px;">
                                    @php 
                                        $processCounter = 0; 
                                        $previousProcess = null; 
                                        $previousCheckpoint = null; 
                                        $questionCounter = 0; // Initialize question counter
                                    @endphp
                                    @foreach($questions as $index => $question)
                                        @php
                                            $surveyEntry = $surveyMap->get($question->id);
                                            $surveyScore = $surveyEntry ? $surveyEntry->survey_score : 0;
                                            $surveyRemarks = $surveyEntry ? $surveyEntry->survey_remarks : 0;
                                        @endphp
                                        @if ($question->processDetails->process_name != $previousProcess)
                                            @php 
                                                $processCounter++; 
                                                $previousCheckpoint = null; 
                                            @endphp
                                            <div class="hidden px-5 rounded-lg" id="process{{$processCounter}}" role="tabpanel" aria-labelledby="process{{$processCounter}}-tab">
                                        @endif
                                        @if ($question->cpointDetails->cpoint_name != $previousCheckpoint)
                                            @php 
                                                $previousCheckpoint = $question->cpointDetails->cpoint_name; 
                                                $questionCounter = 0;
                                            @endphp
                                            <div class="mt-5 bg-white text-xl font-bold pt-3 px-6 rounded-t-lg">
                                                <p>• {{ $question->cpointDetails->cpoint_name }}</p>
                                            </div>
                                        @endif
                                        @php $questionCounter++; @endphp
                                        <div class="px-6 pb-6 bg-white">
                                            <label>{{ $questionCounter }}. {{ $question->question }}</label><br>
                                            <div class="flex w-full items-center gap-x-5 pl-[34px]">
                                                <input id="point-range-{{ $question->id }}" 
                                                       type="range" 
                                                       min="0" 
                                                       max="3" 
                                                       value="{{ $surveyScore }}"
                                                       step="0.01" 
                                                       class="w-full h-2 bg-gray-200 rounded-lg range-lg appearance-none cursor-pointer">
                                                <input type="text" id="point-value-{{ $question->id }}" 
                                                       class="bg-gray-50 text-center font-medium border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24" 
                                                       value="{{ $surveyScore }}"
                                                       placeholder="0" />
                                            </div>
                                            <div class="flex w-[calc(100%-81px)] items-center text-xs text-center">
                                                @for ($i = 0; $i <= 3.1; $i += 0.25)
                                                    <span class="w-full">{{ number_format($i, 2) }}</span>
                                                @endfor
                                            </div>
                                                
                                            {{-- <div class="mb-2">
                                                <label for="qtnRemarks" class="block mb-2 text-sm font-medium text-gray-900">Remarks</label>
                                                <textarea id="qtnRemarks-{{ $question->id }}" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write remarks...">{{ !empty($surveyRemarks) ? $surveyRemarks : '' }}</textarea>
                                            </div> --}}
                                            <div class="mb-2 flex items-start space-x-4">
                                                <!-- Upload Button -->       
                                                <div class="self-stretch flex items-center">
                                                    <label for="multiple_files-{{ $question->id }}" 
                                                        class="px-4 py-7 text-sm font-medium text-gray-900 bg-gray-200 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 ">
                                                        ATTACH
                                                    </label>
                                                    <input id="multiple_files-{{ $question->id }}" data-qidxxx="{{ $index+1}}" type="file" multiple class="hidden" />
                                                </div>
                                            
                                                <!-- Remarks Textarea -->
                                                <div class="flex-1">
                                                    <label for="qtnRemarks" class="block mb-2 text-sm font-medium text-gray-900">Remarks</label>
                                                    <textarea id="qtnRemarks-{{ $question->id }}" rows="2" 
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                                        placeholder="Write remarks...">{{ !empty($surveyRemarks) ? $surveyRemarks : '' }}</textarea>
                                                </div>
                                            </div>
                                            
                                            <!-- Display Uploaded File -->
                                            <div id="uploaded-files-{{ $question->id }}" class="mb-2 flex flex-wrap gap-2 border-2 rounded-md p-2">
                                                @if(isset($attachments[$question->id]))
                                                    @foreach($attachments[$question->id] as $attachment)
                                                        @php
                                                            $files = explode(';', trim($attachment->path));
                                                            $iconMap = [
                                                                'jpg' => 'fas fa-file-image',
                                                                'jpeg' => 'fas fa-file-image',
                                                                'png' => 'fas fa-file-image',
                                                                'gif' => 'fas fa-file-image',
                                                                'mp4' => 'fas fa-file-video',
                                                                'mov' => 'fas fa-file-video',
                                                                'avi' => 'fas fa-file-video',
                                                                'mkv' => 'fas fa-file-video',
                                                                'webm' => 'fas fa-file-video',
                                                                'default' => 'fas fa-file', 'pdf' => 'fas fa-file-pdf',

                                                                'doc' => 'fas fa-file-word',
                                                                'docx' => 'fas fa-file-word',
                                                                'odt' => 'fas fa-file-word',
                                                                'rtf' => 'fas fa-file-word',
                                                                'txt' => 'fas fa-file-alt',

                                                                // Spreadsheet files
                                                                'xls' => 'fas fa-file-excel',
                                                                'xlsx' => 'fas fa-file-excel',
                                                                'csv' => 'fas fa-file-csv',

                                                                // Presentation files
                                                                'ppt' => 'fas fa-file-powerpoint',
                                                                'pptx' => 'fas fa-file-powerpoint',
                                                                'odp' => 'fas fa-file-powerpoint',

                                                                // Compressed files
                                                                'zip' => 'fas fa-file-archive',
                                                                'rar' => 'fas fa-file-archive',
                                                                '7z' => 'fas fa-file-archive',
                                                                'tar' => 'fas fa-file-archive',
                                                                'gz' => 'fas fa-file-archive',

                                                            ];
                                                        @endphp
                                                        @foreach($files as $file)
                                                            @if(!empty($file))
                                                                @php
                                                                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                                    $iconClass = $iconMap[$extension] ?? $iconMap['default'];
                                                                @endphp

                                                                <div class="flex items-center space-x-2 bg-gray-100 p-2 rounded w-auto">
                                                                    <a href="{{ asset('storage/' . trim($file)) }}" target="_blank" class="text-blue-600 hover:underline flex items-center space-x-1">
                                                                        <i class="{{ $iconClass }} text-xl"></i>
                                                                        <span class="text-xs">{{ basename($file) }}</span>
                                                                    </a>
                                                                    <button id="xButton" data-path="{{ $file }}" data-qid="{{$index}}" data-qidx="{{ $question->id }}" class="text-red-600 hover:text-red-800 font-bold">X</button>
                                                                </div>
                                                            @else
                                                                <p class="text-gray-500 no-attachments-message" style="display: block;">No attachments available.</p>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    <p class="text-gray-500 no-attachments-message" style="display: block;">No attachments available.</p>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($loop->last || ($loop->index + 1 < count($questions) && $questions[$loop->index + 1]->processDetails->process_name != $question->processDetails->process_name))
                                            </div>
                                        @endif
                                        @if ($loop->last)
                                            </div>
                                        @endif
                                        @php $previousProcess = $question->processDetails->process_name; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
    </div>
        {{-- HIDDEN BUTTONS --}}
            {{-- Success Modal --}}
                <button type="button" id="btnSuccessH" class="btnSuccessH hidden" data-modal-target="modalSuccess" data-modal-toggle="modalSuccess"></button>
            {{-- Confirm Removal of Attachment  --}}
                <button type="button" id="btnConfirmRH" class="btnConfirmRH hidden" data-modal-target="modalConfirmR" data-modal-toggle="modalConfirmR"></button>
        

        {{-- FORM MODAL --}}
            {{-- SUCCESS MODAL --}}
                <div id="modalSuccess" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-12 w-12">
                                <circle cx="12" cy="12" r="11" fill="#4CAF50"/>
                                <path fill="#FFFFFF" d="M9.25 15.25L5.75 11.75L4.75 12.75L9.25 17.25L19.25 7.25L18.25 6.25L9.25 15.25Z"/>
                                </svg>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Success!</h3>
                            <p class="text-sm text-gray-500">Your data have been saved.</p>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button id="SCloseButton" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm" data-modal-hide="modalSuccess">Close</button>
                        </div>
                    </div>
                </div>
            {{-- SUCCESS MODAL --}}
            

            {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}
                <div id="modalConfirmR" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                        <div class="flex justify-center">
                            <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 id="titleR" class="text-lg font-medium text-gray-900 mb-4"></h3>
                            <h3 id="nameR" class="text-sm"></h3>
                        </div>
                        <div class="flex mt-5 sm:mt-6 justify-center">
                            <button type="button" id="actConfirmR"  data-modal-hide="modalConfirmR" class="remove-file-btn text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure.
                            </button>
                            <button data-modal-hide="modalConfirmR" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                        </div>
                    </div>
                </div>
            {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}

        {{-- FORM DRAWER --}}
            {{-- COMMENT DRAWER --}}
                <div id="drawer-form" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-96" tabindex="-1" aria-labelledby="drawer-form-label">
                    <h5 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="mr-2"><path d="M295-119q-36-1-68.5-18.5T165-189q-40-48-62.5-114.5T80-440q0-83 31.5-156T197-723q54-54 127-85.5T480-840q83 0 156 32t127 87q54 55 85.5 129T880-433q0 77-25 144t-71 113q-28 28-59 42.5T662-119q-18 0-36-4.5T590-137l-56-28q-12-6-25.5-9t-28.5-3q-15 0-28.5 3t-25.5 9l-56 28q-19 10-37.5 14.5T295-119Zm2-80q9 0 18.5-2t18.5-7l56-28q21-11 43.5-16t45.5-5q23 0 46 5t44 16l57 28q9 5 18 7t18 2q19 0 36-10t34-30q32-38 50-91t18-109q0-134-93-227.5T480-760q-134 0-227 94t-93 228q0 57 18.5 111t51.5 91q17 20 33 28.5t34 8.5Zm183-281Zm0 120q33 0 56.5-23.5T560-440q0-8-1.5-16t-4.5-16l50-67q10 13 17.5 27.5T634-480h82q-15-88-81.5-144T480-680q-88 0-155 56.5T244-480h82q14-54 57-87t97-33q17 0 32 3t29 9l-51 69q-2 0-5-.5t-5-.5q-33 0-56.5 23.5T400-440q0 33 23.5 56.5T480-360Z"/></svg>
                        EVALUATION RATING
                    </h5>
                    <button type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>
                    <div class="" style="max-height: 910px;">
                        <div class="row-span-4" style="max-height: 455px;">
                            <form class="mb-6">
                                <div class="w-full text-gray-900 bg-white border border-gray-200 rounded-lg">
                                    <div class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25"/>
                                        </svg>
                                        <span class="flex-grow">GEN. OPERATIONS</span>
                                        <input type="text" id="SUMGenOp" data-pweight="{{ $processWeights[0]->process_weight }}" data-qcount="{{ $questionCounts[$processWeights[0]->process_id] ?? 0 }}" class="bg-gray-50 text-center font-medium border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 disabled:pointer-events-none" placeholder="0"  value="{{ $surveyScores[1] ?? 0 }}" readonly />
                                        <p id="PGenOp" class="text-xs w-12 text-gray-500 pl-4">{{ $surveyPercentages->percent_GenOp }}</p>
                                    </div>
                                    <div class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.5 0h-13A1.5 1.5 0 0 0 2 1.5v17A1.5 1.5 0 0 0 3.5 20h13a1.5 1.5 0 0 0 1.5-1.5v-17A1.5 1.5 0 0 0 16.5 0Zm-4 2v4h-5V2Zm4 16h-13V2h3v5h7V2h3Z" />
                                        </svg>
                                        <span class="flex-grow">DOCUMENTATION</span>
                                        <input type="text" id="SUMDoc" data-pweight="{{ $processWeights[1]->process_weight }}" data-qcount="{{ $questionCounts[$processWeights[1]->process_id] ?? 0 }}" class="bg-gray-50 text-center font-medium border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 disabled:pointer-events-none" placeholder="0"  value="{{ $surveyScores[2] ?? 0 }}" readonly />
                                        <p id="PDoc" class="text-xs w-12 text-gray-500 pl-4">{{ $surveyPercentages->percent_Doc }}</p>
                                    </div>
                                    <div class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M11.3 1.046a1 1 0 0 0-2.6 0l-.195.78a7.972 7.972 0 0 0-1.515.875l-.739-.43a1 1 0 0 0-1.366.366L3.457 4.211a1 1 0 0 0 .366 1.366l.738.429a7.977 7.977 0 0 0-.003 1.752l-.739.43a1 1 0 0 0-.366 1.366l1.428 2.474a1 1 0 0 0 1.366.366l.739-.43a7.972 7.972 0 0 0 1.515.875l.195.779a1 1 0 0 0 2.6 0l.195-.78a7.972 7.972 0 0 0 1.515-.875l.739.43a1 1 0 0 0 1.366-.366l1.428-2.474a1 1 0 0 0-.366-1.366l-.739-.43a7.977 7.977 0 0 0 .003-1.752l.739-.429a1 1 0 0 0 .366-1.366l-1.428-2.474a1 1 0 0 0-1.366-.366l-.739.43a7.972 7.972 0 0 0-1.515-.875l-.195-.78ZM10 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                        </svg>
                                        <span class="flex-grow">PARTS MGMT.</span>
                                        <input type="text" id="SUMPartM" data-pweight="{{ $processWeights[2]->process_weight }}" data-qcount="{{ $questionCounts[$processWeights[2]->process_id] ?? 0 }}" class="bg-gray-50 text-center font-medium border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 disabled:pointer-events-none" placeholder="0"  value="{{ $surveyScores[3] ?? 0 }}" readonly />
                                        <p id="PPartM" class="text-xs w-12 text-gray-500 pl-4">{{ $surveyPercentages->percent_PartMgnt }}</p>
                                    </div>
                                    <div class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>
                                        <span class="flex-grow">PERSONNEL</span>
                                        <input type="text" id="SUMPer" data-pweight="{{ $processWeights[3]->process_weight }}" data-qcount="{{ $questionCounts[$processWeights[3]->process_id] ?? 0 }}" class="bg-gray-50 text-center font-medium border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 disabled:pointer-events-none" placeholder="0"  value="{{ $surveyScores[4] ?? 0 }}" readonly />
                                        <p id="PPer" class="text-xs w-12 text-gray-500 pl-4">{{ $surveyPercentages->percent_Prsnl }}</p>
                                    </div>
                                    <div class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                            <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                        </svg>
                                        <span class="flex-grow">5S PRACTICE</span>
                                        <input type="text" id="SUM5S" data-pweight="{{ $processWeights[4]->process_weight }}" data-qcount="{{ $questionCounts[$processWeights[4]->process_id] ?? 0 }}" class="bg-gray-50 text-center font-medium border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 disabled:pointer-events-none" placeholder="0" value="{{ $surveyScores[5] ?? 0 }}" readonly />
                                        <p id="P5S" class="text-xs w-12 text-gray-500 pl-4">{{ $surveyPercentages->percent_5SPrac }}</p>
                                    </div>
                                    <div class="relative inline-flex flex-col items-center w-full px-4 py-2 text-sm font-medium rounded-b-lg">
                                        <div class="flex gap-4">
                                            <div class="flex flex-col items-center">
                                                <input type="text" id="SUMTotal" class="bg-gray-50 text-center font-semibold border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 mb-2 readonly:pointer-events-none" placeholder="0" value="{{ $surveyScoreSum ?? 0 }}" readonly />
                                                <span class="text-center flex-grow">Total Rating</span>
                                            </div>
                                            <div class="flex flex-col items-center">
                                                <input type="text" id="PTotal" class="bg-gray-50 text-center font-semibold border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-1 w-24 mb-2 readonly:pointer-events-none" placeholder="0" value="{{ $surveyPercentages->surv_TotPercent ?? 0 }}" readonly />
                                                <span class="text-center flex-grow">Total Percentage</span>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </form>
                        </div>
    
                        <div class="row-span-2"style="max-height: 455px;">
                            <h5 id="drawer-label" class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="mr-2"><path d="M240-400h480v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM880-80 720-240H160q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720ZM160-320h594l46 45v-525H160v480Zm0 0v-480 480Z"/></svg>
                                COMMENTS/REMARKS
                            </h5>
                            <form class="mb-6">
                                <div class="mb-6">
                                    <textarea id="surveyRmarks" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write comments, remarks, recommendation...">{{ !empty($survRemarks) ? $survRemarks : '' }}</textarea>
                                </div>
                                <div class="mb-6">
                                    <button type="button" id="btnRSubmit" name="btnRSubmit" class="text-white bg-gradient-to-r from-gray-600 via-green-700 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 shadow-lg shadow-green-500/50 font-medium rounded-lg text-sm px-24 py-2.5 text-center mr-2 mb-2 w-full">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        
    <script>
        $(document).ready(function () {
            var counter;

            // HOME
                jQuery(document).on( "click", "#btnHome", function(){
                    window.location.href = '{{ url("/dashboard") }}';
                });
            // HOME
            
            // SUMMARY
                jQuery(document).on( "click", "#btnSummary", function(){
                    
                });
            // SUMMARY

            // Close Success
                jQuery(document).on( "click", "#SCloseButton", function(){
                    $("#success-modal").removeClass("flex");
                    $("#success-modal").addClass("hidden");
                    // location.reload();
                });
            // Close Success

            // GET VALUE OF RANGE AND REMARKS
                jQuery(document).on("input change", "input[type=range][id^=point-range-], input[id^=point-value-], textarea[id^=qtnRemarks-]", function() {
                    var inputId = $(this).attr('id'); // Get the ID of the input

                    if (inputId.startsWith('point-range-')) {
                        // If it's a range input, extract the counter from the range input ID
                        counter = inputId.split('-')[2];
                        var rangeValue = $(this).val(); // Get the value of the range slider

                        // Update the corresponding text input
                        $("#point-value-" + counter).val(rangeValue);
                    } else if (inputId.startsWith('point-value-')) {
                        // If it's a text input, extract the counter from the text input ID
                        counter = inputId.split('-')[2];
                        var rangeValue = $(this).val(); // Get the value of the text input

                        // Update the corresponding range input
                        $("#point-range-" + counter).val(rangeValue);
                    } else if (inputId.startsWith('qtnRemarks-')) {
                        // If it's a textarea, extract the counter from the textarea ID
                        counter = inputId.split('-')[1];
                    }

                    clearTimeout(window.delayTimer);
                    window.delayTimer = setTimeout(function() {
                        // Update SUMs dynamically
                        updateSums();

                        // Get the value of the textarea (remarks) using the counter
                        var rangeValue = $("#point-range-" + counter).val();
                        var remarks = $("#qtnRemarks-" + counter).val();

                        var GenOp = $("#SUMGenOp").val();
                        var Doc = $("#SUMDoc").val();
                        var PartM = $("#SUMPartM").val();
                        var Per = $("#SUMPer").val();
                        var x5S = $("#SUM5S").val();

                        var PGenOp = $("#PGenOp").text();
                        var PDoc = $("#PDoc").text();
                        var PPartM = $("#PPartM").text();
                        var PPer = $("#PPer").text();
                        var Px5S = $("#P5S").text();

                        var Total = $("#SUMTotal").val();
                        var PTotal = $("#PTotal").val();
                        var sRemarks = $("#surveyRmarks").val();

                        var category = $("#question-category-" + counter).val(); // Retrieve the process_name/category
                        var actID = document.getElementById('act_id').value;
                        var qnrID = document.getElementById('qnr_id').value;
                        var _token = $('input[name="_token"]').val();

                        // Send the data via AJAX
                        $.ajax({
                            url: "{{ route('bpa-improvement.saveSurvey') }}",
                            method: "POST",
                            dataType: 'json',
                            data: {
                                actID: actID,
                                qnrID: qnrID,
                                counter: counter,
                                rangeValue: rangeValue,
                                remarks: remarks,
                                GenOp: GenOp,
                                Doc: Doc,
                                PartM: PartM,
                                Per: Per,
                                x5S: x5S,
                                PGenOp: PGenOp,
                                PDoc: PDoc,
                                PPartM: PPartM,
                                PPer: PPer,
                                Px5S: Px5S,
                                Total: Total,
                                PTotal: PTotal,
                                sRemarks: sRemarks,
                                isSubmit: 0,
                                _token: _token,
                            },
                            success: function(result) {
                                console.log('Survey data saved successfully.');
                            }
                        });

                    }, 1000); // 1-second delay

                });

                // Function to update the SUM fields dynamically
                function updateSums() {
                    var sumGenOp = 0, countGenOp = 0;
                    var sumDoc = 0, countDoc = 0;
                    var sumPartM = 0, countPartM = 0;
                    var sumPer = 0, countPer = 0;
                    var sum5S = 0, count5S = 0;
                    var sumTotal = 0, countTotal = 0;

                    // Iterate through the sliders to calculate category-wise totals
                    $("input[type=range][id^=point-range-]").each(function() {
                        var questionId = $(this).attr('id').split('-')[2];
                        var value = parseFloat($(this).val()) || 0;

                        // Determine category for the question (e.g., Gen. Operations, Documentation, etc.)
                        // Adjust this logic as per your question-to-category mapping
                        var category = $("#question-category-" + questionId).val(); // Example hidden input for category
                        

                        switch (category) {
                            case "General Operations":
                                sumGenOp += value;
                                countGenOp++;
                                break;
                            case "Documentation":
                                sumDoc += value;
                                countDoc++;
                                break;
                            case "Parts Management":
                                sumPartM += value;
                                countPartM++;
                                break;
                            case "Personnel":
                                sumPer += value;
                                countPer++;
                                break;
                            case "5S":
                                sum5S += value;
                                count5S++;
                                break;
                            default:
                                console.warn(`Unexpected category: ${category} for Question ID: ${questionId}`);
                                break;
                        }

                        sumTotal += value; // Aggregate total score
                        countTotal++;
                        
                    });

                    // Count Questions
                    document.querySelector('#SUMGenOp').setAttribute('data-qcount', countGenOp);
                    document.querySelector('#SUMDoc').setAttribute('data-qcount', countDoc);
                    document.querySelector('#SUMPartM').setAttribute('data-qcount', countPartM);
                    document.querySelector('#SUMPer').setAttribute('data-qcount', countPer);
                    document.querySelector('#SUM5S').setAttribute('data-qcount', count5S);

                    // Earned Points
                    $("#SUMGenOp").val(sumGenOp.toFixed(2));
                    $("#SUMDoc").val(sumDoc.toFixed(2));
                    $("#SUMPartM").val(sumPartM.toFixed(2));
                    $("#SUMPer").val(sumPer.toFixed(2));
                    $("#SUM5S").val(sum5S.toFixed(2));

                    // Total Points
                    var TGenOp = (countGenOp * 3);
                    var TDoc = (countDoc * 3);
                    var TPartM = (countPartM * 3);
                    var TPer = (countPer * 3);
                    var T5S = (count5S * 3);

                    // Ratings
                    var ratingGenOp = (sumGenOp / TGenOp) * 100;
                    var ratingDoc = (sumDoc / TDoc) * 100;
                    var ratingPartM = (sumPartM / TPartM) * 100;
                    var ratingPer = (sumPer / TPer) * 100;
                    var rating5S = (sum5S / T5S) * 100;

                        // Get Weight Percentage
                        const iGenOp = document.getElementById("SUMGenOp");
                            const pweightGenOp = parseFloat(iGenOp.dataset.pweight);
                        const iDoc = document.getElementById("SUMDoc");
                            const pweightDoc = parseFloat(iDoc.dataset.pweight);
                        const iPartM = document.getElementById("SUMPartM");
                            const pweightPartM = parseFloat(iPartM.dataset.pweight);
                        const iPer = document.getElementById("SUMPer");
                            const pweightPer = parseFloat(iPer.dataset.pweight);
                        const i5S = document.getElementById("SUM5S");
                            const pweight5S = parseFloat(i5S.dataset.pweight);

                    // Percentage
                    $("#PGenOp").text(((ratingGenOp * pweightGenOp) / 100 ).toFixed(2) + "%");
                    $("#PDoc").text(((ratingDoc * pweightDoc) / 100 ).toFixed(2) + "%");
                    $("#PPartM").text(((ratingPartM * pweightPartM) / 100 ).toFixed(2) + "%");
                    $("#PPer").text(((ratingPer * pweightPer) / 100 ).toFixed(2) + "%");
                    $("#P5S").text(((rating5S * pweight5S) / 100 ).toFixed(2) + "%");
                    
                    // $("#PGenOp").text(((sumGenOp / TGenOp) * 100).toFixed(2) + "%");
                    // $("#PDoc").text(((sumDoc / TDoc) * 100).toFixed(2) + "%");
                    // $("#PPartM").text(((sumPartM / TPartM) * 100).toFixed(2) + "%");
                    // $("#PPer").text(((sumPer / TPer) * 100).toFixed(2) + "%");
                    // $("#P5S").text(((sum5S / T5S) * 100).toFixed(2) + "%");

                    // Sum Percentage
                    var totalPercentage = (
                        ((ratingGenOp * pweightGenOp) / 100) +
                        ((ratingDoc * pweightDoc) / 100) +
                        ((ratingPartM * pweightPartM) / 100) +
                        ((ratingPer * pweightPer) / 100) +
                        ((rating5S * pweight5S) / 100)
                    );

                    // Update total SUM field
                    $("#SUMTotal").val(sumTotal.toFixed(2));
                    $("#PTotal").val(totalPercentage.toFixed(2) + "%");
                }

                // Submit Remarks
                jQuery(document).on( "click", "#btnRSubmit", function(){
                    var sRemarks = $("#surveyRmarks").val();
                    var actID = document.getElementById('act_id').value;
                    var qnrID = document.getElementById('qnr_id').value;
                    var _token = $('input[name="_token"]').val();

                    
                    // Send the data via AJAX
                    $.ajax({
                        url: "{{ route('bpa-improvement.saveSurvey') }}",
                        method: "POST",
                        dataType: 'json',
                        data: {
                            actID: actID,
                            qnrID: qnrID,
                            sRemarks: sRemarks,
                            isSubmit: 1,
                            _token: _token,
                        },
                        success: function(result) {
                            console.log(result);
                            $("#btnSuccessH").click();
                             
                        }
                    });
                });
            // GET VALUE OF RANGE AND REMARKS

            // UPLOAD
            jQuery(document).on("change", "input[type=file][id^=multiple_files-]", function () {
                const files = this.files;
                const questionId = $(this).attr("id").split('-')[1];
                const actID = document.getElementById('act_id').value;
                const qnrID = document.getElementById('qnr_id').value;
                var qid = $(this).data('qidxxx');

                // Allowed file extensions
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'mkv', 'webm', 'pdf', 'doc', 'docx', 'odt', 'rtf', 'txt', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'odp',];

                // Create FormData instance
                const formData = new FormData();
                formData.append('question_id', questionId);
                formData.append('act_id', actID);
                formData.append('qnr_id', qnrID);

                // Append files to FormData
                Array.from(files).forEach((file, index) => {
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    if (allowedExtensions.includes(fileExtension)) {
                        formData.append(`files[${index}]`, file);
                    } else {
                        alert(`The file "${file.name}" is not a supported type. Allowed types are: ${allowedExtensions.join(', ')}.`);
                    }
                });

                // AJAX request
                $.ajax({
                    url: "{{ route('bpa-improvement.saveAttach') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (response) => {
                        if (response.success) {
                            $(`#uploaded-files-${questionId} .no-attachments-message`).hide(); // To show
                            const uploadedFiles = response.files;
                            const uploadedPath = response.path;
                            const fileListContainer = $(`#uploaded-files-${questionId}`);

                            uploadedFiles.forEach(file => {
                                const fileExtension = file.name.split('.').pop().toLowerCase();
                                const iconClass = getFileIconClass(fileExtension);
                                const filePath = file.path;

                                const fileElement = $(`
                                    <div class="flex items-center space-x-2 bg-gray-100 p-2 rounded">
                                        <a href="{{ asset('storage') }}/${filePath}" target="_blank" class="text-blue-600 hover:underline flex items-center space-x-1">
                                            <i class="file-icon ${iconClass} text-xl"></i>
                                            <span class="text-xs">${file.pathx}</span>
                                        </a>
                                        <button id="xButton" data-path="${filePath}" data-qid="${qid}" data-qidx="${questionId}" class="text-red-600 hover:text-red-800 font-bold">X</button>
                                    </div>
                                `);

                                fileListContainer.append(fileElement); // Correctly appending to the container
                            });
                            
                        } else {
                            alert("File upload failed. Please try again.");
                        }
                    },
                    error: (error) => {
                        console.error("Error uploading files:", error);
                    }
                });
            });

            function getFileIconClass(extension) {
                const icons = {
                    'jpg': 'fas fa-file-image',
                    'jpeg': 'fas fa-file-image',
                    'png': 'fas fa-file-image',
                    'gif': 'fas fa-file-image',
                    'mp4': 'fas fa-file-video',
                    'mov': 'fas fa-file-video',
                    'avi': 'fas fa-file-video',
                    'mkv': 'fas fa-file-video',
                    'webm': 'fas fa-file-video',

                    // Document files
                    'pdf': 'fas fa-file-pdf',
                    'doc': 'fas fa-file-word',
                    'docx': 'fas fa-file-word',
                    'odt': 'fas fa-file-word',
                    'rtf': 'fas fa-file-word',
                    'txt': 'fas fa-file-alt',

                    // Spreadsheet files
                    'xls': 'fas fa-file-excel',
                    'xlsx': 'fas fa-file-excel',
                    'csv': 'fas fa-file-csv',

                    // Presentation files
                    'ppt': 'fas fa-file-powerpoint',
                    'pptx': 'fas fa-file-powerpoint',
                    'odp': 'fas fa-file-powerpoint',

                    'default': 'fas fa-file',
                };

                return icons[extension] || icons['default'];
            }

            jQuery(document).on("click", "#xButton", function () {
                var button = $(this); // Capture reference to 'this'
                var path = button.data('path');
                    var pathx = button.data('path').replace('attachments/', '');
                var qid = button.data('qid') + 1;
                var qidx = button.data('qidx');
                
                $("#btnConfirmRH").click();
                $('#actConfirmR').data('pathx', path);
                $('#actConfirmR').data('qid', qid);
                $('#actConfirmR').data('qidx', qidx);

                $('#titleR').html('Confirm Removal of Attachment?');
                $('#nameR').html('Are you sure you want to <span class="text-red-700">delete</span> ATTACHMENT <span class="text-blue-700">' + pathx + '</span>?');
            });

            jQuery(document).on("click", "#actConfirmR", function () {
                var button = $(this); // Capture reference to 'this'
                var path = button.data('pathx');
                var qid = button.data('qid');
                var qidx = button.data('qidx');
                var _token = $('input[name="_token"]').val();

                // Send the data via AJAX
                $.ajax({
                    url: "{{ route('bpa-improvement.removeAttach') }}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        path: path,
                        _token: _token,
                    },
                    success: function(result) {
                        $(`#uploaded-files-${qidx} .flex button[data-path="${path}"]`)
                            .closest('.flex')
                            .remove();

                        // Check if there are any .flex elements left
                        if ($(`#uploaded-files-${qidx} .flex`).length === 0) {
                            // Show the 'no attachments' message
                            $(`#uploaded-files-${qidx}`).append('<p class="text-gray-500 no-attachments-message" style="display: block;">No attachments available.</p>');
                        }
                        
                    },
                });
            });
            // UPLOAD
        });
    </script>
</x-app-layout>
