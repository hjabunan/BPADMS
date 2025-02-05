<x-app-layout>
    <div style="height: calc(100vh - 65px);" class="py-3 overflow-x-auto">
        <div class="max-w-8xl mx-auto sm:px-5 lg:px-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 h-full">
                    {{-- Title --}}
                    <div class="px-4 grid grid-cols-2 gap-x-3 mb-5 border-b h-[49px]">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            Activity Calendar
                        </div>
                        <div class="justify-self-end">
                            <button type="button" id="btnAddEvent" name="btnAddEvent" data-modal-target="modalEvent" data-modal-toggle="modalEvent" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2">ADD</button>
                        </div>
                    </div>
                    
                    {{-- Body --}}
                    <div class="">
                        <form action="" method="POST" class="px-5 sm:px-20">
                            <div class="" id="calendar-container">
                                <div class="" id="calendar"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    {{-- HIDDEN BUTTONS --}}
        {{-- View Event Modal --}}
            <button type="button" id="btnMViewEventH" class="btnMViewEventH hidden" data-modal-target="modalViewEvent" data-modal-toggle="modalViewEvent"></button>
        {{-- Event Modal --}}
            {{-- <button type="button" id="btnMEventH" class="btnMEventH hidden" data-modal-target="modalEvent" data-modal-toggle="modalEvent"></button> --}}
        {{-- Success Modal --}}
            <button type="button" id="btnSuccessH" class="btnSuccessH hidden" data-modal-target="modalSuccess" data-modal-toggle="modalSuccess"></button>
        {{-- Inc Modal --}}
            <button type="button" id="btnIncH" class="btnIncUserH hidden" data-modal-target="modalInc" data-modal-toggle="modalInc"></button>

    {{-- MODAL --}}

        {{-- VIEW EVENT MODAL --}}
            <div id="modalViewEvent" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label class="text-3xl font-extrabold text-gray-900">
                                <span id="titleViewEvent" class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"></span>
                            </label>
                            <button type="button" id="closeEvent1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalViewEvent">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 space-y-4 w-full">
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Status</label>
                                <h1 id="viewStatus" class=" font-semibold text-lg leading-3"></h1>
                            </div>
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Assigned To</label>
                                <h1 id="viewAssignedTo" class=" font-medium text-lg leading-3"></h1>
                            </div>
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Date</label>
                                <h1 id="viewDate" class=" font-medium text-lg leading-3"></h1>
                            </div>
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Site/Branch Location</label>
                                <h1 id="viewLocation" class=" font-medium text-lg leading-3"></h1>
                            </div>
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Site/Branch Supervisor/TL</label>
                                <h1 id="viewSupervisor" class=" font-medium text-lg leading-3"></h1>
                            </div>
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Questionnaire</label>
                                <h1 id="viewQuestionnaire" class=" font-medium text-lg leading-3"></h1>
                            </div>
                            <div class="leading-3">
                                <label for="" class="text-sm leading-3">Created By</label>
                                <h1 id="viewCreatedBy" class=" font-medium text-lg leading-3"></h1>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                            @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                                <a href="" id="btnAnswerEvent" data-modal-hide="modalViewEvent" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">ANSWER NOW</a>
                                <button type="button" id="btnEditEvent" data-modal-target="modalEvent" data-modal-show="modalEvent" data-modal-hide="modalViewEvent" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">EDIT</button>
                                <button type="button" id="btnDeleteEvent" data-modal-target="modalDeleteEvent" data-modal-show="modalDeleteEvent" data-modal-hide="modalViewEvent" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">DELETE</button>
                            @endif
                            <button data-modal-hide="modalViewEvent" type="button" id="closeEvent2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- VIEW EVENT MODAL --}}


        {{-- ADD/EDIT EVENT MODAL --}}
            <div id="modalEvent" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label class="text-3xl font-extrabold text-gray-900">
                                <span id="titleEvent" class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD EVENT</span>
                            </label>
                            <button type="button" id="closeEvent1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalEvent">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 w-full">
                            <form action="" id="formEvent" name="formEvent" class="w-full">
                                @csrf
                                <input type="hidden" id="eventKey" name="eventKey">
                                <input type="hidden" id="eventID" name="eventID">
                                <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="ename" class="block mb-2 text-sm font-medium text-gray-900">Event Name</label>
                                        <input type="text" id="ename" name="ename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="eassignedto" class="block mb-2 text-sm font-medium text-gray-900">Assigned To</label>
                                        <div class="grid justify-items-start">
                                            <select id="eassignedto" name="eassignedto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected hidden value="">Please choose one option</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="elocation" class="block mb-2 text-sm font-medium text-gray-900">Site/Branch Location</label>
                                        <input type="text" id="elocation" name="elocation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="esvstl" class="block mb-2 text-sm font-medium text-gray-900">Site/Branch Supervisor/TL</label>
                                        <input type="text" id="esvstl" name="esvstl" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="adStart" class="block mb-2 text-sm font-medium text-gray-900">Audit Date Start</label>
                                        <div class="">
                                            <div class="relative max-w-sm">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                </div>
                                                <input datepicker="" type="text" id="adStart" name="adStart" datepicker-format="mm/dd/yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:w-1/2 p-2.5" value="{{ date('m/d/Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="adEnd" class="block mb-2 text-sm font-medium text-gray-900">Audit Date End</label>
                                        <div class="">
                                            <div class="relative max-w-sm">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                </div>
                                                <input datepicker="" type="text" id="adEnd" name="adEnd" datepicker-format="mm/dd/yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:w-1/2 p-2.5" value="{{ date('m/d/Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="equestionnaire" class="block mb-2 text-sm font-medium text-gray-900">Questionnaire</label>
                                        <div class="grid justify-items-start">
                                            <select id="equestionnaire" name="equestionnaire" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected hidden value="">Please choose one option</option>
                                                @foreach($qnrs as $qnr)
                                                <option value="{{ $qnr->id }}">{{ $qnr->questionnaire_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="button" id="btnSaveEvent" name="btnSaveEvent" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">SUBMIT</button>
                            <button data-modal-hide="modalEvent" type="button" id="closeEvent2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- ADD/EDIT EVENT MODAL --}}

        {{-- VIEW EVENT MODAL --}}
            <div id="modalDeleteEvent" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <form id="deleteForm" method="POST" class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        @csrf
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label class="text-3xl font-extrabold text-gray-900">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">DELETE</span>
                            </label>
                            <button type="button" id="closeEvent1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalDeleteEvent">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 space-y-4 w-full">
                            <p>Are you sure you want to delete this event?</p>
                            <input type="hidden" id="deleteKey" name="key">
                            <p>Event name: <span id="titleDeleteEvent" class="text-lg font-medium"></span></p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="submit" data-modal-hide="modalDeleteEvent" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">DELETE</button>
                            <button data-modal-hide="modalDeleteEvent" type="button" id="closeEvent2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        {{-- VIEW EVENT MODAL --}}


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


        {{-- ERROR - INC MODAL --}}
            <div id="modalInc" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="bg-red-200 rounded-lg shadow-lg w-80 mx-auto p-4">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-12 w-12">
                        <circle cx="12" cy="12" r="10" fill="#f44336"/>
                        <path d="M8.46 8.46L15.54 15.54M8.46 15.54L15.54 8.46" stroke="#fff" stroke-width="2"/>
                    </svg>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Failed!</h3>
                    <p class="text-xs text-gray-900">Your data could not be saved. <br> Please validate and try again.</p>
                </div>
                <div class="mt-5 sm:mt-6">
                    <button id="FCloseButton" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm" data-modal-hide="modalInc">Close</button>
                </div>
                </div>
            </div>
        {{-- ERROR - INC MODAL --}}
    <script>
        var eventId;
        var eventKey;
        var statusArray = ['PENDING', 'ONGOING', 'COMPLETED'];
        var statusColor = ['text-red-500', 'text-amber-500', 'text-emerald-500'];

        document.addEventListener('DOMContentLoaded', function() {
            var _token = $('input[name="_token"]').val();
            var calendarEl = document.getElementById('calendar');
            var initialView = window.innerWidth < 600 ? 'dayGridWeek' : 'dayGridMonth';
            var windowHeight = window.innerHeight; // Get the height of the browser window
            var calendarHeight = windowHeight - 178;
            
            var formattedEvents = @json($events);

            console.log(formattedEvents);
            

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: calendarHeight,
                initialView: initialView,
                events: formattedEvents,
                eventClick:function(info) {
                    eventId = info.event.id;
                    eventKey = info.event.extendedProps.key;
                    var act_status = info.event.extendedProps.status;
                    var act_location = info.event.extendedProps.location;
                    var act_supervisor = info.event.extendedProps.supervisor;
                    var act_assignedto = info.event.extendedProps.assigned_to;
                    var act_assignedtoid = info.event.extendedProps.assigned_to_id;
                    var act_createdby = info.event.extendedProps.created_by;
                    var act_name = info.event.title;
                    var act_start = info.event.extendedProps.sDate;
                    var act_end = info.event.extendedProps.eDate;
                    var act_questionnaire = info.event.extendedProps.questionnaire;
                    var act_questionnaireid = info.event.extendedProps.questionnaire_id;
                    var today = new Date();

                    // EDIT MODAL
                        $('#eventKey').val(eventKey);
                        $('#eventID').val(eventId);
                        $('#elocation').val(act_location);
                        $('#esvstl').val(act_supervisor);
                        $('#eassignedto').val(act_assignedtoid);
                        $('#ename').val(act_name);
                        $('#adStart').val(act_start);
                        $('#adEnd').val(act_end);
                        $('#equestionnaire').val(act_questionnaireid);
                    // EDIT MODAL

                    // VIEW MODAL
                        $('#titleViewEvent').html(act_name);
                        $('#viewStatus').html(statusArray[act_status]);
                        $('#viewStatus').removeClass('text-red-500 text-amber-500 text-emerald-500');
                        $('#viewStatus').addClass(statusColor[act_status]);
                        $('#viewAssignedTo').html(act_assignedto);
                        $('#viewLocation').html(act_location);
                        $('#viewSupervisor').html(act_supervisor);
                        if(act_start == act_end){
                            $('#viewDate').html(act_start);
                        }else{
                            $('#viewDate').html(act_start + ' - ' + act_end);
                        }
                        $('#viewQuestionnaire').html(act_questionnaire);
                        $('#viewCreatedBy').html(act_createdby);

                        var formattedStartDate = new Date(act_start)
                        formattedStartDate.setHours(0, 0, 0, 0);
                        today.setHours(0, 0, 0, 0);

                        if (formattedStartDate <= today) {
                            $('#btnAnswerEvent').removeClass('hidden');
                        } else {
                            $('#btnAnswerEvent').addClass('hidden');
                        }
                    // VIEW MODAL

                    // DELETE MODAL 
                        $('#titleDeleteEvent').html(act_name);
                        $('#deleteKey').val(eventKey);
                    // DELETE MODAL

                    $('#btnMViewEventH').click();
                }
          });
          calendar.render();
        });
        
        $(document).ready(function () {

            // Add Event
                jQuery(document).on( "click", "#btnAddEvent", function(){
                    $('#formEvent').trigger('reset');
                    $('#titleEvent').html('ADD EVENT');
                    $('#eventKey').val('');
                    $('#eventID').val('');
                });
            // Add Event

            // Edit Event
                jQuery(document).on( "click", "#btnEditEvent", function(){
                    $('#titleEvent').html('EDIT EVENT');
                });
            // Edit Event

            // Delete Event
                jQuery(document).on( "click", "#btnDeleteEvent", function(){
                    $('#deleteForm').attr('action', '/delete-event/' + eventKey);
                });
            // Delete Event



            // Save Add/Edit Event
                jQuery(document).on( "click", "#btnSaveEvent", function(){
                    if($('#ename').val() == ""){
                        $("#btnIncH").click();
                    }else{
                        $.ajax({
                            url:"{{ route('dashboard.saveEventData') }}",
                            method:"POST",
                            dataType: 'json',
                            data: $("#formEvent").serialize(),
                            success:function(result){
                                $("#btnSuccessH").click();
                                $("#closeEvent1").click();
                                location.reload();
                            },
                            error: function(error){
                                $("#btnIncH").click();

                            }
                        });
                    }
                });
            // Save Add/Edit Event
        });
    </script>
</x-app-layout>
