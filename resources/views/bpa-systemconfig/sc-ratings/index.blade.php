<x-app-layout>
    <div style="height: calc(100vh - 65px);" class="py-3">
        <div class="max-w-8xl mx-auto sm:px-5 lg:px-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{-- Title --}}
                    <div class="px-4 grid grid-cols-2 gap-x-3 mb-5 border-b h-[49px]">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            Ratings Management
                        </div>
                        <div class="justify-self-end">
                            <button type="button" id="btnAddRate" name="btnAddRate" data-modal-target="modalRate" data-modal-toggle="modalRate" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2">ADD</button>
                        </div>
                    </div>
                    
                    {{-- Body --}}
                        {{-- Start Table --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="height: calc(100vh - 178px);">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="position: sticky; top: 0;">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Rating
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Grading Scale
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Remarks
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableRate" name="tableRate">
                                    @foreach ($ratings as $rate)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($rate->rating_status == 0)
                                                <button type="button" data-key="{{$rate->key}}" class="btnEditRate" id="btnEditRate"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                <button type="button" data-key="{{$rate->key}}" data-name="{{$rate->rating_name}}" data-rstatus="{{$rate->rating_status}}" class="btnActRate" id="btnActRate">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                        <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                        <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" data-key="{{$rate->key}}" data-name="{{$rate->rating_name}}" class="btnDeleteRate" id="btnDeleteRate"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z" fill="#ff3838"/><path d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z" fill="#5F6379"/></svg></button>
                                                @else
                                                <button type="button" data-key="{{$rate->key}}" class="btnEditRate" id="btnEditRate"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                <button type="button" data-key="{{$rate->key}}" data-name="{{$rate->rating_name}}" data-rstatus="{{$rate->rating_status}}" class="btnActRate" id="btnActRate">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                        <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                        <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                    </svg>
                                                </button>
                                                <button type="button" data-key="{{$rate->key}}" data-name="{{$rate->rating_name}}" class="btnDeleteRate" id="btnDeleteRate"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z" fill="#ff3838"/><path d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z" fill="#5F6379"/></svg></button>
                                                @endif
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$rate->rating_name}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$rate->rating_description}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$rate->rating_gradefrom}}% - {{$rate->rating_gradeto}}%
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($rate->rating_remarks == 0)
                                                    <p class="text-red-500">Failed</p>
                                                @else
                                                    <p class="text-green-500">Passed</p>
                                                @endif 
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($rate->rating_status == 0)
                                                    <p class="text-red-500 bg-red-200">Inactive</p>
                                                @else
                                                    <p class="text-green-500 bg-green-200">Active</p>
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                        {{-- End Table --}}
                </div>
            </div>
        </div>
        
        {{-- MODALS --}}
            {{-- RATINGS MODAL --}}
                <div id="modalRate" data-modal-backdrop="static" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                <label id="titleRate" class="text-3xl font-extrabold text-gray-900">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD RATE</span>
                                </label>
                                <button type="button" id="closeRate1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalRate">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6 w-full">
                                <form action="" id="formRate" name="formRate" class="w-full">
                                    @csrf
                                    <input type="hidden" id="rateKey" name="rateKey">
                                    <input type="hidden" id="rateID" name="rateID">
                                    <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="rname" class="block mb-2 text-sm font-medium text-gray-900">Rating Name</label>
                                            <input type="text" id="rname" name="rname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="rdescription" class="block mb-2 text-sm font-medium text-gray-900">Rating Description</label>
                                            <input type="text" id="rdescription" name="rdescription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="rgradefrom" class="block mb-2 text-sm font-medium text-gray-900">Grade From</label>
                                            <input type="text" id="rgradefrom" name="rgradefrom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="rgradeto" class="block mb-2 text-sm font-medium text-gray-900">Grade To</label>
                                            <input type="text" id="rgradeto" name="rgradeto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                            <label for="rremarks" class="block mb-2 text-sm font-medium text-gray-900">Remark</label>
                                            <div class="grid justify-items-start">
                                                <select id="rremarks" name="rremarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                    <option class="text-center" selected disabled value="">--Select Remark--</option>
                                                    <option value="1">Passed</option>
                                                    <option value="0">Failed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                            <label for="rcolor" class="block mb-2 text-sm font-medium text-gray-900">Remark Color</label>
                                            <div class="grid justify-items-start">
                                                <select id="rcolor" name="rcolor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5 pointer-events-none">
                                                    <option class="text-center" selected disabled value="">--Select Color--</option>
                                                    <option value="#008000">Green</option>
                                                    <option value="#FF0000">Red</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="button" id="btnSaveRate" name="btnSaveRate" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                                <button data-modal-hide="modalRate" type="button" id="closeRate2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- END RATINGS MODAL --}}

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

            {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL/DELETE --}}
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
                            <button type="button" id="actConfirmR" data-action="" data-modal-hide="modalConfirmR" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure.
                            </button>
                            <button data-modal-hide="modalConfirmR" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                        </div>
                    </div>
                </div>

    {{-- HIDDEN BUTTONS --}}
        {{-- Edit Rate --}}
            <button type="button" id="btnEditRateH" class="btnEditRateH hidden" data-modal-target="modalRate" data-modal-toggle="modalRate"></button>
        {{-- Confirm Activate/Deactivate Modal - Rate --}}
            <button type="button" id="btnConfirmADH" class="btnConfirmADH hidden" data-modal-target="modalConfirmR" data-modal-toggle="modalConfirmR"></button>
        {{-- Confirm Delete Rate --}}
            <button type="button" id="btnConfirmADRH" class="btnConfirmADRH hidden" data-modal-target="modalConfirmR" data-modal-toggle="modalConfirmR"></button>
        {{-- Success Modal --}}
            <button type="button" id="btnSuccessH" class="btnSuccessH hidden" data-modal-target="modalSuccess" data-modal-toggle="modalSuccess"></button>
        {{-- Inc Modal --}}
            <button type="button" id="btnIncH" class="btnIncUserH hidden" data-modal-target="modalInc" data-modal-toggle="modalInc"></button>
    </div>
    <script>
        $(document).ready(function () {
            // Close Success
                jQuery(document).on( "click", "#SCloseButton", function(){
                    $("#success-modal").removeClass("flex");
                    $("#success-modal").addClass("hidden");
                    // location.reload();
                });
            // Close Success

            const remarkSelect = document.getElementById('rremarks');
            const colorSelect = document.getElementById('rcolor');

            // Set initial color based on the default selected option
                remarkSelect.addEventListener('change', function () {
                    if (this.value === '1') {
                        colorSelect.value = '#008000'; // Green for Passed
                    } else if (this.value === '0') {
                        colorSelect.value = '#FF0000'; // Red for Failed
                    }

                    // Update the background color of the color select
                    colorSelect.style.backgroundColor = colorSelect.value;
                    colorSelect.style.color = '#ffffff'; // Ensure white text for visibility
                });
            
            
            // Add Rating
                jQuery(document).on( "click", "#btnAddRate", function(){
                    $('#formRate').trigger('reset');

                    var newHeading = "ADD RATE";
                    document.getElementById("titleRate").querySelector("span").textContent = newHeading;

                    $('#btnSaveRate').text('ADD');

                    $('#rateKey').val('');
                    $('#rateID').val('');
                });

            // Save Add/Edit Rate
                jQuery(document).on("click", "#btnSaveRate", function () {
                    if (
                        $('#rname').val() == null ||
                        $('#rdescription').val() == null ||
                        $('#rgradefrom').val() == null ||
                        $('#rgradeto').val() == null ||
                        $('#rremarks').val() == null ||
                        $('#rcolor').val() == null
                    ) {
                        $("#btnIncH").click();
                    } else {
                        $.ajax({
                            url: "{{ route('bpa-systemconfig.sc-ratings.saveRateData') }}",
                            method: "POST",
                            dataType: 'json',
                            data: $("#formRate").serialize(),
                            success: function (result) {
                                $('#tableRate').load(location.href + ' #tableRate>*', '');
                                $("#btnSuccessH").click();
                                $("#closeRate1").click();
                            },
                            error: function (error) {
                                $("#btnIncH").click();
                            }
                        });
                    }
                });
                
            // View/Edit Rate
                jQuery(document).on( "click", "#btnEditRate", function(){
                    var keyRate = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-ratings.getRateData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyRate: keyRate, _token: _token,},
                        success:function(result){
                            $("#btnEditRateH").click();
                            var newHeading = "EDIT RATE";
                            document.getElementById("titleRate").querySelector("span").textContent = newHeading;

                            $('#rateKey').val(result.rKey);
                            $('#rateID').val(result.rID);
                            $('#rname').val(result.rname);
                            $('#rdescription').val(result.rdescription);
                            $('#rgradefrom').val(result.rgradefrom);
                            $('#rgradeto').val(result.rgradeto);
                            $('#rremarks').val(result.rremarks);
                                if (parseInt(result.rremarks) === 1) {
                                    $('#rcolor').val('#008000');
                                } else if (parseInt(result.rremarks) === 0) {
                                    $('#rcolor').val('#FF0000');
                                }
                                $('#rcolor')[0].style.backgroundColor = result.rcolor;
                            if ($('#rstatus').length === 0) {
                                $('#rcolor').closest('.mb-3').after(`
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="rstatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                        <div class="grid justify-items-start">
                                            <select id="rstatus" name="rstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                `);
                            }
                            $('#rstatus').val(result.rstatus);
                        }
                    });
                });

            // Activate/Deactivate Rate
                jQuery(document).on( "click", "#btnActRate", function(){
                    var keyRate = $(this).data('key');
                    var nameRate = $(this).data('name');
                    var rstatus = $(this).data('rstatus');
                    
                    $("#btnConfirmADH").click();
                    $('#actConfirmR').data('action', 'status')
                                    .data('key', keyRate)
                                    .data('rstatus', rstatus);

                    if(rstatus == 0){
                        var stat1 = "Activation";
                        var stat2 = "activate";
                    }else{
                        var stat1 = "Deactivation";
                        var stat2 = "deactivate";
                    }
                    $('#titleR').html('Confirm ' + stat1);
                    $('#nameR').html('Are you sure you want to <span class="text-red-700">'+ stat2 +'</span> RATING <span class="text-blue-700">'+ nameRate +'</span>?');
                });
            
            // Delete Rate
                jQuery(document).on( "click", "#btnDeleteRate", function(){
                    var action = $(this).data('action');
                    var keyRate = $(this).data('key');
                    var nameRate = $(this).data('name');

                    $("#btnConfirmADRH").click();
                    $('#actConfirmR').data('action', 'delete')
                                    .data('key', keyRate);

                    $('#titleR').html('Confirm Deletion');
                    $('#nameR').html('Are you sure you want to <span class="text-red-700">delete</span> RATING <span class="text-blue-700">'+ nameRate +'</span>?');
                });

                $(document).on("click", "#actConfirmR", function() {
                    var action = $(this).data('action');
                    var keyRate = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    if(action === 'status') {
                        var statusRate = $(this).data('rstatus');
                        $.ajax({
                            url: "{{ route('bpa-systemconfig.sc-ratings.statusRate') }}",
                            method: "POST",
                            dataType: 'json',
                            data: { keyRate: keyRate, statusRate: statusRate, _token: _token },
                            success: function() {
                                $('#tableRate').load(location.href + ' #tableRate>*', '');
                                $("#btnSuccessH").click();
                            },
                            error: function() {
                                $("#btnIncH").click();
                            }
                        });
                    } 
                    else if(action === 'delete') {
                        $.ajax({
                            url: "{{ route('bpa-systemconfig.sc-ratings.deleteRate') }}",
                            method: "POST",
                            dataType: 'json',
                            data: { keyRate: keyRate, _token: _token },
                            success: function() {
                                $('#tableRate').load(location.href + ' #tableRate>*', '');
                                $("#btnSuccessH").click();
                            },
                            error: function() {
                                $("#btnIncH").click();
                            }
                        });
                    }
                });
        });
    </script>
</x-app-layout>
