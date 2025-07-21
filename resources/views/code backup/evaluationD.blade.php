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

    <style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

        #quserAgreement a{
            text-decoration: underline;
        }
    </style>

    <body class="font-sans antialiased w-screen">
        <div class="self-center justify-self-end">
            {{-- <img src="{{ asset('public/storage/evaluation/BPA-Evaluation.jpg') }}" class="block w-20 h-auto" alt=""> --}}
        </div>
        {{-- <img class="w-24 h-auto overflow-hidden sm:w-64 rounded-lg" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="" > --}}
        {{-- <div class="px-20 mt-7">
            <div class="grid grid-cols-4 gap-x-4">
                <div class="self-center justify-self-end">
                    <img src="{{ asset('storage\images\logo\TMH_BT_RAYMOND.png') }}" class="block w-20 h-auto" alt="">
                </div>
                <div class="col-span-3 self-center">
                    <h1 class=" font-black text-xl tracking-wider">HANDLING INNOVATION INCORPORATED</h1>
                    <p>Dow Jones Bldg., Whse5A, KM 19, WSR, SSH, Parañaque City</p>
                </div>
            </div>
        </div>

        <hr class="mt-2">

        <h1 class="font-medium text-2xl text-center tracking-wider mt-1">ISSUANCE FORM</h1>

        <div class="px-20 mt-2">
            <div class="grid grid-cols-7 gap-x-2 text-sm">
                <div>Name: </div>
                <div class="font-semibold col-span-4 tracking-wide"></div>
                <div>Date Returned: </div>
                <div class="font-semibold tracking-wide"></div>

                <div>Department: </div>
                <div class="font-semibold col-span-4 tracking-wide"></div>
                <div>Location: </div>
                <div class="font-semibold tracking-wide"></div>
            </div>
        </div>

        <hr class="my-2">

        <div class="px-20">
            <div class="grid grid-cols-7 gap-x-2 text-xs">
                <div>Brand Name: </div>
                <div class="font-semibold col-span-4 tracking-wide"></div>
                <div>Cost: </div> --}}
                {{-- <div class="font-semibold tracking-wide">{{ (preg_match("/[a-zA-Z]/i", $item->cost)) ? $item->cost : '₱ '.number_format($item->cost, 2, '.', ',') }}</div> --}}
                {{-- <div>Serial/SIM No: </div>
                <div class="font-semibold col-span-4 tracking-wide"></div>
                <div>Color: </div>
                <div class="font-semibold tracking-wide"></div>
                <div>Remarks: </div>
                <div class="font-semibold col-span-4 tracking-wide"></div>
                <div>Status: </div>
                <div class="font-semibold tracking-wide"></div>

            </div>
        </div>

        <hr class="my-4">

        <h1 class="font-semibold text-base text-center tracking-wider">INSTRUCTION FROM HEREIN UNDER IS IMPORTANT. PLEASE READ THEM CAREFULLY</h1> --}}

        {{-- <div style="width: 856px" class="px-10 mx-auto"> --}}
            {{-- <h1 style="box-shadow: inset 0 0 0 1000px red;" class="border inline border-neutral-900 px-2 py-px text-white font-semibold tracking-wide">USER AGREEMENT</h1> --}}
            {{-- <div id="quserAgreement" style="font-size: 11px;" class="w-full px-2.5 py-1.5 leading-3 resize-none border-neutral-900 border"></div> --}}
            {{-- <p style="font-size: 10px;" class="mt-32 text-xs text-center">I hereby certify that I agreed and understand the terms and condition mention and received the listed items in good condition with proper orientation.</p> --}}
            
        {{-- </div> --}}
            {{-- <div class="border border-neutral-900 p-2 mx-10 mt-5">
                <div class="font-semibold mb-1 ml-4">INTERNAL AUDIT - Checklist</div>
                
                <img class="w-24 h-auto overflow-hidden sm:w-64 rounded-lg self-center justify-self-end" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="" >
            </div> --}}
            <div class="border border-neutral-900 p-1 mr-10 ml-10 mx-auto mt-5">
                <div class="border border-neutral-900 p-1">
                    <div class="grid grid-cols-[60%_40%] items-center">
                        <div class="text-lg font-bold">
                            INTERNAL AUDIT - Checklist
                        </div>
                        <div class="flex justify-end">
                            <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="border border-neutral-900 p-2 mt-1">
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
                    <!-- Header -->
                    <div class="table mt-1 w-full text-xs font-bold">
                        <div class="table-cell border-t border-b border-l border-neutral-900 text-center p-0.5 w-[5%]">NO.</div>
                        <div class="table-cell border-t border-b border-l border-neutral-900 text-center p-0.5 w-[20%]">PROCESS</div>
                        <div class="table-cell border-t border-b border-l border-neutral-900 text-center p-0.5 w-[20%]">CHECKPOINT(S)</div>
                        <div class="table-cell border-t border-b border-l border-neutral-900 text-center p-0.5 w-[45%]">CHECKPOINT QUESTION(S)</div>
                        <div class="table-cell border-t border-b border-l border-neutral-900 text-center p-0.5 w-[8%]">POINTS</div>
                        <div class="table-cell border-t border-b border-l border-r border-neutral-900 text-center p-0.5 w-[12%]">PTS. AVE.</div>
                    </div>

                    <!-- Body -->
                    @foreach ($survey as $index => $surveylist)
                    {{-- Insert header at the start and every 25 rows --}}
                        {{-- @if ($index % 25 == 0)
                            <div class="border border-neutral-900 p-1 print-header">
                                <div class="grid grid-cols-[60%_40%] items-center">
                                    <div class="text-lg font-bold">
                                        INTERNAL AUDIT - Checklist
                                    </div>
                                    <div class="flex justify-end">
                                        <img class="w-24 sm:w-64 h-auto" src="{{ URL::to('/') }}/storage/evaluation/BPA-Evaluation.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                        <div class="flex w-full text-xs {{ $index % 28 == 0 ? 'print-break' : '' }}">
                            <div class="border-b border-l border-neutral-900 text-center p-0.5 w-[5%]">{{ $index + 1 }}</div>
                            <div class="border-b border-l border-neutral-900 text-center p-0.5 w-[20%]">{{ $processes[$surveylist->process_id]->process_name ?? 'Unknown Process' }}</div>
                            <div class="border-b border-l border-neutral-900 text-center p-0.5 w-[20%]">{{ $checkpoints[$surveylist->checkpoint_id]->cpoint_name ?? 'Unknown Checkpoint' }}</div>
                            <div class="border-b border-l border-neutral-900 p-0.5 w-[45%]">{{ $questions[$surveylist->qtn_id]->question ?? 'Unknown Question' }}</div>
                            <div class="border-b border-l border-neutral-900 text-center p-0.5 w-[8%]">{{ $surveylist->survey_score }}</div>
                            <div class="border-b border-l border-r border-neutral-900 text-center p-0.5 w-[12%]">—</div>
                        </div>
                    @endforeach
                    {{-- <div class="w-full table text-xs">
                        @foreach ($survey as $index => $surveylist)
                            <div class="table-row break-inside-avoid">
                                <div class="table-cell border-b border-l border-neutral-900 text-center p-1 w-[5%]">{{ $index + 1 }}</div>
                                <div class="table-cell border-b border-l border-neutral-900 text-center p-1 w-[20%]">{{ $processes[$surveylist->process_id]->process_name ?? 'Unknown' }}</div>
                                <div class="table-cell border-b border-l border-neutral-900 text-center p-1 w-[20%]">{{ $checkpoints[$surveylist->checkpoint_id]->cpoint_name ?? 'Unknown' }}</div>
                                <div class="table-cell border-b border-l border-neutral-900 p-1 w-[45%]">{{ $questions[$surveylist->qtn_id]->question ?? 'Unknown' }}</div>
                                <div class="table-cell border-b border-l border-neutral-900 text-center p-1 w-[8%]">{{ $surveylist->survey_score }}</div>
                                <div class="table-cell border-b border-l border-r border-neutral-900 text-center p-1 w-[12%]">—</div>
                            </div>
                        @endforeach
                    </div> --}}
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

                        <div class="text-xs text-center">
                            BPAD Personnel
                        </div>
                        <div></div>
                        <div class="text-xs text-center">
                            BPAD Head
                        </div>
                    </div>
                    <div class="grid grid-cols-3 mt-5">
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

                        <div class="text-xs text-center">
                            Site/Branch Admin Assistant/SPI IDC
                        </div>
                        <div></div>
                        <div class="text-xs text-center">
                            Site/Branch Supervisor/TL
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="grid grid-cols-3 mt-3">
                <div class="text-xs">
                    Prepared by:
                </div>
                <div></div>
                <div class="text-xs">
                    Received By:
                </div>

                <div class="border-b border-neutral-900 h-5"></div>
                <div></div>
                <div class="border-b border-neutral-900 h-5"></div>

                <div class="text-xs text-center">
                    Signature over Printed Name and Date
                </div>
                <div></div>
                <div class="text-xs text-center">
                    Signature over Printed Name and Date
                </div>
            </div> --}}
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