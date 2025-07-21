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
        @page {
            size: auto;
            margin: 5mm 0mm 5mm 0mm; /* top right bottom left */
        }

        body {
            margin: 0 !important; /* Avoid browser default margins */
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
        {{-- <div class="self-center justify-self-center"> --}}
            {{-- <img src="{{ asset('public/storage/evaluation/BPA-Evaluation.jpg') }}" class="block w-20 h-auto" alt=""> --}}
        {{-- </div> --}}
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

                <div id="audit-checklist">
                    <!-- Header -->
                    <div class="flex mt-1 w-full text-xs font-bold">
                        {{-- <div class="border-t border-b border-l border-neutral-900 text-center text-xs p-0.5 w-[4%]">NO.</div> --}}
                        <div class="border-t border-b border-l border-neutral-900 text-center text-xs p-0.5 w-[17%]">PROCESS</div>
                        <div class="border-t border-b border-l border-neutral-900 text-center text-xs p-0.5 w-[18%]">CHECKPOINT(S)</div>
                        <div class="border-t border-b border-l border-neutral-900 text-center text-xs p-0.5 w-[45%]">CHECKPOINT QUESTION(S)</div>
                        <div class="border-t border-b border-l border-neutral-900 text-center text-xs p-0.5 w-[8%]">POINTS</div>
                        <div class="border-t border-b border-l border-r border-neutral-900 text-center text-xs p-0.5 w-[12%]">PTS. AVE.</div>
                    </div>

                    <!-- Body -->
                            @php
                                $procid = 0;
                                $cpointid = 0;
                                $processCounts = [];

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
                            @endphp

                    @foreach ($survey as $index => $surveylist)
                            @php
                                $currentProcId = $questions[$surveylist->qtn_id]->process_id;
                                $procsurv = $processes[$currentProcId];
                                $nextProcId = isset($survey[$index + 1])
                                    ? $questions[$survey[$index + 1]->qtn_id]->process_id
                                    : null;
                                $isLastInGroup = $currentProcId !== $nextProcId;

                                $currentCpointId = $questions[$surveylist->qtn_id]->cpoint_id;
                                $cpointsurv = $checkpoints[$currentCpointId];
                                $nextCpointId = isset($survey[$index + 1])
                                    ? $questions[$survey[$index + 1]->qtn_id]->cpoint_id
                                    : null;
                                $isLastInCpointGroup = $currentCpointId !== $nextCpointId;

              
                                $procId = $procsurv->id;
                                $totalPoints = $processScores[$procId];
                                $totalQuestions = $processCounts[$procId];
                                $average = $totalQuestions > 0 ? $totalPoints / $totalQuestions : 0;
                            @endphp

                            {{-- Page break between process 2 and 3 --}}
                            @if ($index == 32 || $index == 64 || $index == 96 || $index == 128 || $index == 160 || $index == 192)
                                <div class="flex border-neutral-900 print-page-break"></div>
                                <div id='audit-heading' class="print-only border-b border-neutral-900 p-1">
                                    <div class="grid grid-cols-[60%_40%] items-center">
                                        <div class="text-lg font-bold">
                                            INTERNAL AUDIT - Checklist
                                        </div>
                                        <div class="flex justify-end">
                                            <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                                        </div>
                                    </div>
                                
                                    <div class="p-2 mt-1">
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
                            @endif

                        <div class="flex w-full text-xs">
                            {{-- NO. & PROCESS--}}
                                @if ($index == 0)
                                    <div class="{{ $isLastInGroup ? 'border-b' : '' }} border-l border-neutral-900 text-center p-0.5 w-[17%] whitespace-nowrap">{{ $procsurv->process_name ?? 'Unknown Process' }}</div>
                                @elseif ($procid != $procsurv->id)
                                    <div class="{{ $isLastInGroup ? 'border-b' : '' }} border-l border-neutral-900 text-center p-0.5 w-[17%] whitespace-nowrap">{{ $procsurv->process_name ?? 'Unknown Process' }}</div>
                                @else
                                    <div class="{{ $isLastInGroup ? 'border-b' : '' }} border-l border-neutral-900 text-center p-0.5 w-[17%]"></div>
                                @endif
                            {{-- CHECKPOINT --}}
                                @if ($index == 0 )
                                    <div class="{{ $isLastInCpointGroup ? 'border-b' : '' }} border-l border-neutral-900 text-center p-0.5 w-[18%] whitespace-nowrap">{{ $cpointsurv->cpoint_name ?? 'Unknown Checkpoint' }}</div>
                                @elseif ($cpointid != $cpointsurv->id)
                                    <div class="{{ $isLastInCpointGroup ? 'border-b' : '' }} border-l border-neutral-900 text-center p-0.5 w-[18%] whitespace-nowrap">{{ $cpointsurv->cpoint_name ?? 'Unknown Checkpoint' }}</div>
                                @else
                                    <div class="{{ $isLastInCpointGroup ? 'border-b' : '' }} border-l border-neutral-900 text-center p-0.5 w-[18%]"></div>
                                @endif
                            {{-- QUESTION --}}
                                <div class="border-b border-l border-neutral-900 p-0.5 w-[45%] text-[10px]">{{ $questions[$surveylist->qtn_id]->question ?? 'Unknown Question' }}</div>
                            {{-- POINTS --}}
                                <div class="border-b border-l border-neutral-900 text-center p-0.5 w-[8%]">{{ $surveylist->survey_score }}</div>
                            {{-- AVERAGE --}}
                                @if ($index == 0)
                                    <div class="{{ $isLastInGroup ? 'border-b' : '' }} border-l border-r border-neutral-900 text-center p-0.5 w-[12%] flex items-center justify-center">{{ number_format($average, 2) }}</div>
                                @elseif ($procid != $procsurv->id)
                                    <div class="{{ $isLastInGroup ? 'border-b' : '' }} border-l border-r border-neutral-900 text-center p-0.5 w-[12%] flex items-center justify-center">{{ number_format($average, 2) }}</div>
                                @else
                                    <div class="{{ $isLastInGroup ? 'border-b' : '' }} border-l border-r border-neutral-900 text-center p-0.5 w-[12%] flex items-center justify-center"></div>
                                @endif
                        </div>
                            @php
                                $procid = $procsurv->id;
                                $cpointid = $cpointsurv->id;
                            @endphp
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
            
            {{-- NOTE AND SCORE --}}
            <div class="mx-10">
                <div class="font-bold text-sm mb-1 ml-2">Note/Remarks/Observation/Commitment:</div>
                <div class="ml-2 mr-2 border border-neutral-900 text-xs min-h-[10rem] relative leading-6 p-4 overflow-hidden">
                    {{-- Display the actual remark text --}}
                    <div class="relative z-10 text-justify">
                        {{-- Use null coalescing operator to handle potential null values --}}
                        {{ $questionnaire->surv_Remarks ?? '' }}
                    </div>
                </div>
            </div>
            <div class="print-page-break"></div>
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
                <div class="font-bold text-sm mb-1 ml-2">Summary of Evaluation Rating:</div>
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
        </div>

        <script>
            // $(document).ready(function(){
            //     var sh = $('#userAgreement').prop('scrollHeight');
            //     $('#userAgreement').height((sh) + 'px');
            //     window.onafterprint = window.close;
            //     window.print();
            // });
        </script>
    </body>
</html>