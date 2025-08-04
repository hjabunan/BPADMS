<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')
        <title>Evaluation Sheet</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
        <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <style type="text/css">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

        .print-page-break {
            page-break-before: always;
            break-before: page;
        }

        /* Hide print-only elements when not printing */
        @media screen {
            .print-only {
                display: none !important;
            }
        }

        /* Show print-only elements only when printing */
        @media print {
            .print-only {
                display: block;
            }
        }
    </style>

    <body class="font-sans antialiased w-screen">
        <div class="border-neutral-900 p-1 mr-10 ml-10 mx-auto mt-5">
            <div id='audit-heading' class="border-neutral-900 p-1">
                <div class="grid grid-cols-[60%_40%] items-center">
                    <div class="text-lg font-bold">
                        INTERNAL AUDIT - Checklist
                    </div>
                    <div class="flex justify-end">
                        <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="border-neutral-900 p-2 mt-1">
                <div class="grid grid-cols-12 items-center gap-x-2">
                    <!-- Site/Branch Location -->
                    <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Location:</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_location}}</div>

                    <!-- Audit Date -->
                    <div class="col-span-2 text-right font-semibold text-xs">Audit Date:</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center text-xs">{{$questionnaire->act_startdate}} - {{$questionnaire->act_enddate}}</div>
                    <div class="col-span-1"></div>
                </div>
                <div class="grid grid-cols-12 items-center gap-x-2">
                    <!-- Site/Branch Location -->
                    <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Supervisor/TL:</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_supervisor}}</div>

                    <!-- Audit Date -->
                    @php
                        use Carbon\Carbon;

                        $start = Carbon::parse($questionnaire->act_startdate);
                        $end = Carbon::parse($questionnaire->act_enddate);
                        $days = $start->diffInDays($end) + 1; // +1 to include both start and end date
                    @endphp
                    <div class="col-span-2 text-right font-semibold text-xs">Audit Day(s):</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{ $days }} day(s)</div>
                    <div class="col-span-1"></div>
                </div>
            </div>

            <div class="mr-10 ml-10 mx-auto">
                @php
                    $procid = 0;
                    $cpointid = 0;
                    $processCounts = [];
                    $processScores = [];

                    foreach ($survey as $s) {
                        $pid = $questions[$s->qtn_id]->process_id;

                        // Count questions
                        if (!isset($processCounts[$pid])) {
                            $processCounts[$pid] = 0;
                        }
                        $processCounts[$pid]++;

                        // Sum scores
                        if (!isset($processScores[$pid])) {
                            $processScores[$pid] = 0;
                        }
                        $processScores[$pid] += $s->survey_score ?? 0;
                    }

                    $processCounter = 1;
                    $checkpointCounter = 1;
                    $questionCounter = 1;
                @endphp

                @foreach($survey as $index => $surveylist)
                    @php
                        $currentProcId = $questions[$surveylist->qtn_id]->process_id;
                        $procsurv = $processes[$currentProcId];

                        $currentCpointId = $questions[$surveylist->qtn_id]->cpoint_id;
                        $cpointsurv = $checkpoints[$currentCpointId];

                        $procId = $procsurv->id;
                        $totalPoints = $processScores[$procId];
                        $totalQuestions = $processCounts[$procId];
                        $average = $totalQuestions > 0 ? $totalPoints / $totalQuestions : 0;
                    @endphp

                    {{-- PROCESS HEADER --}}
                    @if($procid != $currentProcId)
                        <div class="font-bold text-lg mt-4">
                            {{ $processCounter }}. {{ $procsurv->process_name }}
                            <span class="text-gray-500 text-sm">(Avg: {{ number_format($average, 2) }})</span>
                        </div>
                        @php
                            $procid = $currentProcId;
                            $checkpointCounter = 1;
                            $processCounter++;
                        @endphp
                    @endif

                    {{-- CHECKPOINT HEADER --}}
                    @if($cpointid != $currentCpointId)
                        <div class="ml-4 font-semibold text-md mt-2">
                            {{ $processCounter - 1 }}.{{ $checkpointCounter }}. {{ $cpointsurv->cpoint_name }}
                        </div>
                        @php
                            $cpointid = $currentCpointId;
                            $questionCounter = 1;
                            $checkpointCounter++;
                        @endphp
                    @endif

                    {{-- QUESTION --}}
                    <div class="ml-8 flex justify-between text-xs mt-1">
                        <span>
                            {{ $processCounter - 1 }}.{{ $checkpointCounter - 1 }}.{{ $questionCounter }}.
                            {{ $questions[$surveylist->qtn_id]->question }}
                        </span>
                        <span class="font-bold">{{ $surveylist->survey_score ?? '-' }}</span>
                    </div>

                    {{-- REMARKS --}}
                    <div class="ml-12 text-xs text-gray-600">
                        > Remarks: {{ $surveylist->survey_remarks ?? 'None' }}
                    </div>

                    {{-- ATTACHMENTS --}}
                    <div class="ml-12 text-xs text-gray-600 mb-2">
                        > Attachment:
                        @php
                            $qtnId = $surveylist->qtn_id;
                            $qAttachments = $attachments->where('qtn_id', $qtnId);
                        @endphp
                        @if($qAttachments->count() > 0)
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach($qAttachments as $attach)
                                    @php
                                        $filePaths = explode(';', $attach->path);
                                    @endphp
                                    @foreach($filePaths as $file)
                                        @php
                                            $filePath = asset('storage/'.$file);
                                            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                        @endphp

                                        @if(in_array($extension, ['jpg','jpeg','png','gif','webp']))
                                            <a href="{{ $filePath }}" target="_blank">
                                                <img src="{{ $filePath }}" alt="Attachment" class="w-30 h-24 object-cover border rounded shadow hover:scale-105 transition-transform">
                                            </a>
                                        @elseif($extension === 'pdf')
                                            <iframe src="{{ $filePath }}" class="w-32 h-32 border rounded" frameborder="0"></iframe>
                                        @else
                                            <div class="p-2 border rounded bg-gray-100 text-gray-700 text-xs">
                                                <i class="fas fa-file-alt"></i> {{ basename($file) }}
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @else
                            None
                        @endif
                    </div>

                    @php $questionCounter++; @endphp

                    {{-- PAGE BREAK AFTER EVERY 4 QUESTIONS --}}
                    @if(($index + 1) % 4 === 0 && $index + 1 < count($survey))
                        <div style="page-break-after: always;"></div>

                        {{-- HEADER FOR NEXT PAGE --}}
                        <div id="audit-heading" class="print-only p-1 mb-4 mt-6">
                            <div class="grid grid-cols-[60%_40%] items-center">
                                <div class="text-lg font-bold">INTERNAL AUDIT - Checklist</div>
                                <div class="flex justify-end">
                                    <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                                </div>
                            </div>
                            <div class="p-2 mt-1">
                                <div class="grid grid-cols-12 items-center gap-x-2">
                                    <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Location:</div>
                                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_location}}</div>
                                    <div class="col-span-2 text-right font-semibold text-xs">Audit Date:</div>
                                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center text-xs">{{$questionnaire->act_startdate}} - {{$questionnaire->act_enddate}}</div>
                                </div>
                                <div class="grid grid-cols-12 items-center gap-x-2 mt-1">
                                    <div class="col-span-3 text-right font-semibold text-xs">Supervisor/TL:</div>
                                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_supervisor}}</div>
                                    <div class="col-span-2 text-right font-semibold text-xs">Audit Day(s):</div>
                                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{ $days }} day(s)</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="print-page-break"></div>
                <div id='audit-heading' class="print-only p-1">
                    <div class="grid grid-cols-[60%_40%] items-center">
                        <div class="text-lg font-bold">
                            INTERNAL AUDIT - Checklist
                        </div>
                        <div class="flex justify-end">
                            <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                        </div>
                    </div>
                    
                    <div class="border-neutral-900 p-2 mt-1">
                        <div class="grid grid-cols-12 items-center gap-x-2">
                            <!-- Site/Branch Location -->
                            <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Location:</div>
                            <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_location}}</div>

                            <!-- Audit Date -->
                            <div class="col-span-2 text-right font-semibold text-xs">Audit Date:</div>
                            <div class="col-span-3 border-b border-neutral-900 h-5 text-center text-xs">{{$questionnaire->act_startdate}} - {{$questionnaire->act_enddate}}</div>
                            <div class="col-span-1"></div>
                        </div>
                        <div class="grid grid-cols-12 items-center gap-x-2">
                            <!-- Site/Branch Location -->
                            <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Supervisor/TL:</div>
                            <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_supervisor}}</div>

                            <div class="col-span-2 text-right font-semibold text-xs">Audit Day(s):</div>
                            <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{ $days }} day(s)</div>
                            <div class="col-span-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-10">
            <div class="font-bold text-sm mb-1 mt-2">Note/Remarks/Observation/Commitment:</div>
            <div class="ml-2 mr-2 border border-neutral-900 text-xs min-h-[10rem] relative leading-6 p-4 overflow-hidden">
                {{-- Display the actual remark text --}}
                <div class="relative z-10 text-justify">
                    {{-- Use null coalescing operator to handle potential null values --}}
                    {{ $questionnaire->surv_Remarks ?? '' }}
                </div>
            </div>
        </div>
        <div class="print-page-break"></div>
        {{-- SUMMARY LAST PAGE --}}
        <div class="border-neutral-900 p-1 mr-10 ml-10 mx-auto mt-5 print-only">
            <div id='audit-heading' class="border-neutral-900 p-1">
                <div class="grid grid-cols-[60%_40%] items-center">
                    <div class="text-lg font-bold">
                        INTERNAL AUDIT - Checklist
                    </div>
                    <div class="flex justify-end">
                        <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="border-neutral-900 p-2 mt-1">
                <div class="grid grid-cols-12 items-center gap-x-2">
                    <!-- Site/Branch Location -->
                    <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Location:</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_location}}</div>

                    <!-- Audit Date -->
                    <div class="col-span-2 text-right font-semibold text-xs">Audit Date:</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center text-xs">{{$questionnaire->act_startdate}} - {{$questionnaire->act_enddate}}</div>
                    <div class="col-span-1"></div>
                </div>
                <div class="grid grid-cols-12 items-center gap-x-2">
                    <!-- Site/Branch Location -->
                    <div class="col-span-3 text-right font-semibold text-xs">Site/Branch Supervisor/TL:</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_supervisor}}</div>

                    <!-- Audit Date -->
                    <div class="col-span-2 text-right font-semibold text-xs">Audit Day(s):</div>
                    <div class="col-span-3 border-b border-neutral-900 h-5 text-center">{{ $days }} day(s)</div>
                    <div class="col-span-1"></div>
                </div>
            </div>
        </div>
        <div class="mx-10 mt-2">
            <div class="font-bold text-sm mb-1">Summary of Evaluation Rating:</div>
            <div class="ml-2 mr-2 border border-neutral-900 text-xs min-h-[6rem] relative leading-6 p-2 overflow-hidden">
                {{-- Display the actual remark text --}}
                <div class="mx-10 text-xs">
                    <div class="grid grid-cols-12 gap-y-1">
                        <div class="col-span-5 p-2 items-center">
                            <div class="space-y-1 text-xs mx-5">
                                @php
                                    $fields = [
                                        'General Operation' => $questionnaire->surv_GenOp,
                                        'Documentation' => $questionnaire->surv_Doc,
                                        'Parts Management' => $questionnaire->surv_PartMgnt,
                                        'Personnel' => $questionnaire->surv_Prsnl,
                                        '5S Practice' => $questionnaire->surv_5SPrac,
                                    ];
                                @endphp

                                @foreach ($fields as $label => $score)
                                    <div class="flex justify-between items-center">
                                        <div class="font-semibold">
                                            {{ $label }}
                                        </div>
                                        <div class="border-b border-neutral-900 w-24 text-center font-semibold">
                                            {{ $score ?? 'N/A' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class=""></div>
                        <div class="col-span-3 gap-y-4 text-xs flex flex-col">
                            <!-- TOTAL RATE Column -->
                            <div class="text-center">
                                <span class="font-semibold block mb-1">TOTAL RATE</span>
                                <div class="border border-neutral-900 w-full items-center text-xl">{{$questionnaire->surv_TotRate}}</div>
                            </div>
                            <div class="text-center">
                                <span class="font-semibold block mb-1">PERCENTAGE</span>
                                <div class="border border-neutral-900 w-full items-center text-xl">{{$questionnaire->surv_TotPercent}}</div>
                            </div>
                        </div>
                        @php
                            $percent = $questionnaire->surv_TotPercent;

                            if ($percent >= 95) {
                                $remark = 'Passed';
                            } elseif ($percent >= 89) {
                                $remark = 'Passed';
                            } elseif ($percent >= 82) {
                                $remark = 'Passed';
                            } elseif ($percent >= 75) {
                                $remark = 'Passed';
                            } else {
                                $remark = 'Failed';
                            }
                        @endphp

                        <div class="col-span-3 gap-y-4 flex flex-col">
                            <!-- SCORE REMARKS Column -->
                            <div class="col-span-1 flex flex-col h-full justify-center items-center text-center">
                                <span class="font-semibold block mb-1">REMARKS</span>
                                <div class="p-2 text-[2.5rem] font-bold {{ $remark === 'Failed' ? 'text-red-500' : 'text-green-500' }}">
                                    {{ $remark }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border border-neutral-900 p-2 mx-10 mt-2 text-xs">
            <div class="font-semibold mb-1 ml-4">Legend:</div>

            <!-- Legend Row -->
            <div class="flex">
                <div class="w-6 border border-neutral-900 flex items-start justify-center p-0.5">0</div>
                <div class="flex-grow border-t border-r border-b border-neutral-900 p-0.5">
                    <span class="font-semibold">No:</span>
                    <span class="text-[11px]"> Items at the workplace are unsorted, do not have a set location. It's dirty and it is hard to judge normal or not normal situations.</span>
                </div>
            </div>

            <!-- Legend Row -->
            <div class="flex">
                <div class="w-6 border-l border-b border-r border-neutral-900 flex items-start justify-center p-0.5">1</div>
                <div class="flex-grow border-b border-r border-neutral-900 p-0.5">
                    <span class="font-semibold">Partially:</span>
                    <span class="text-[11px]"> There's some areas which are maintained according to the 5S method and management requirements.</span>
                </div>
            </div>

            <!-- Legend Row -->
            <div class="flex">
                <div class="w-6 border-l border-b border-r border-neutral-900 flex items-start justify-center p-0.5">2</div>
                <div class="flex-grow border-b border-r border-neutral-900 p-0.5">
                    <span class="font-semibold">Yes:</span>
                    <span class="text-[11px]"> Most of the areas are maintained according to the principles of 5S and management requirements.</span>
                </div>
            </div>

            <!-- Legend Row -->
            <div class="flex">
                <div class="w-6 border-l border-b border-r border-neutral-900 flex items-start justify-center p-0.5">3</div>
                <div class="flex-grow border-b border-r border-neutral-900 p-0.5">
                    <span class="font-semibold">Benchmark:</span>
                    <span class="text-[11px]"> All areas are maintained according to the principles of 5S. It's easy to judge normal or not normal condition.</span>
                </div>
            </div>

            <!-- Descriptor Row -->
                {{-- Header --}}
                    <div class="flex mt-2 w-full">
                        <div class="border-t border-b border-l border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-bold">RATING</span></div>
                        <div class="border-t border-b border-l border-neutral-900 flex items-center justify-center p-0.5 basis-3/6"><span class="font-bold">DESCRIPTION</span></div>
                        <div class="border-t border-b border-l border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-bold">GRADING SCALE</span></div>
                        <div class="border border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-bold">REMARKS</span></div>
                    </div>
                {{-- Body --}}
                    <div class="flex w-full">
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">Excellent/Compliant</div>
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-3/6 text-[11px]">Fully Compliant; exceed expectations; no finding.</div>
                        <div class="border-l  border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">95% - 100%</div>
                        <div class="border-l border-r border-b  border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-semibold text-green-900">Passed</span></div>
                    </div>
                    <div class="flex w-full">
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">Very Satisfactory</div>
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-3/6 text-[10px]">Generally compliant; minor findings; continuous improvement observed.</div>
                        <div class="border-l  border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">89% - 94%</div>
                        <div class="border-l border-r border-b  border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-semibold text-green-900">Passed</span></div>
                    </div>
                    <div class="flex w-full">
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">Satisfactory</div>
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-3/6 text-[11px]">Compliant with few issues that need correction.</div>
                        <div class="border-l  border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">82% - 88%</div>
                        <div class="border-l border-r border-b  border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-semibold text-green-900">Passed</span></div>
                    </div>
                    <div class="flex w-full">
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">Needs Improvement</div>
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-3/6 text-[11px]">Several issues and requires corrective actions</div>
                        <div class="border-l  border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">75% - 81%</div>
                        <div class="border-l border-r border-b  border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-semibold text-green-900">Passed</span></div>
                    </div>
                    <div class="flex w-full">
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">Unsatisfactory</div>
                        <div class="border-l border-b border-neutral-900 flex items-center justify-center p-0.5 basis-3/6 text-[11px]">Non-compliant; major gaps; urgent action needed.</div>
                        <div class="border-l  border-b border-neutral-900 flex items-center justify-center p-0.5 basis-1/6">Below 75%</div>
                        <div class="border-l border-r border-b  border-neutral-900 flex items-center justify-center p-0.5 basis-1/6"><span class="font-semibold text-red-900">Failed</span></div>
                    </div>
                {{-- Body --}}
        </div>

            <div class="border border-neutral-900 p-1 mr-10 ml-10 mx-auto mt-2">
                <div class="border border-neutral-900 p-1">
                    <div class="grid grid-cols-3 mt-2">
                        <div class="text-xs">
                            Prepared & Conducted by:
                        </div>
                        <div></div>
                        <div class="text-xs">
                            Noted By:
                        </div>

                        <div class="border-b border-neutral-900 h-5 text-center">{{$personnel->name}}</div>
                        <div></div>
                        <div class="border-b border-neutral-900 h-5 text-center">{{$bpahead->name}}</div>

                        <div class="text-[10px] text-center">
                            BPAD Personnel
                        </div>
                        <div></div>
                        <div class="text-[10px] text-center">
                            BPAD Head
                        </div>
                    </div>
                    <div class="grid grid-cols-3 mt-3">
                        <div class="text-xs">
                            Checked & Confirmed by:
                        </div>
                        <div></div>
                        <div class="text-xs">
                            Reviewed and Verified By:
                        </div>

                        <div class="border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_sbadmin}}</div>
                        <div></div>
                        <div class="border-b border-neutral-900 h-5 text-center">{{$questionnaire->act_supervisor}}</div>

                        <div class="text-[10px] text-center">
                            Site/Branch Admin Assistant/SPI IDC
                        </div>
                        <div></div>
                        <div class="text-[10px] text-center">
                            Site/Branch Supervisor/TL
                        </div>
                    </div>
                </div>
            </div>
        <script>
            // $(document).ready(function(){
            //     var sh = $('#userAgreement').prop('scrollHeight');
            //     $('#userAgreement').height((sh) + 'px');
            //     window.onafterprint = window.close;
                 window.print();
            // });
        </script>
    </body>
</html>