<x-app-layout>
    <div style="height: calc(100vh - 65px);" class="py-3 overflow-x-auto">
        <div class="max-w-8xl mx-auto sm:px-5 lg:px-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900 h-full">
                    {{-- Title --}}
                    <div class="px-4 grid grid-cols-2 gap-x-3 mb-5 border-b h-[49px]">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            Form Management
                        </div>
                        <div class="justify-self-end">
                        <div class="border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-2 border-b-2 rounded-t-lg" id="formprocess-tab" data-tabs-target="#formprocess" type="button" role="tab" aria-controls="formprocess" aria-selected="false">Form and Process</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="cpoint-tab" data-tabs-target="#cpoint" type="button" role="tab" aria-controls="cpoint" aria-selected="false">Checkpoint</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="question-tab" data-tabs-target="#question" type="button" role="tab" aria-controls="question" aria-selected="false">Question</button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="questionnaire-tab" data-tabs-target="#questionnaire" type="button" role="tab" aria-controls="questionnaire" aria-selected="false">Questionnaire</button>
                                </li>
                            </ul>
                        </div>
                            {{-- <button type="button" id="btnAddForm" name="btnAddForm" data-modal-target="modalForm" data-modal-toggle="modalForm" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2 ">ADD</button> --}}
                        </div>
                    </div>
                                
                    {{-- Body --}}
                    <div class="flex flex-col gap-4" style="height: calc(100vh - 178px);">
                        <div id="default-tab-content">
                            <div class="hidden p-4 rounded-lg bg-gray-50" id="formprocess" role="tabpanel" aria-labelledby="formprocess-tab">
                                <div class="flex flex-wrap gap-2 justify-center sm:flex-nowrap">
                                    {{-- Start FORM Table --}}
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(100vh - 210px);">
                                        <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                            <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                                Form/s
                                            </div>
                                            <div class="justify-self-end">
                                                <button type="button" id="btnAddForm" name="btnAddForm" data-modal-target="modalForm" data-modal-toggle="modalForm" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2">ADD</button>
                                            </div>
                                        </div>
                                        <table class="relative w-full text-sm text-left rtl:text-right text-gray-500 overflow-y-auto" style="max-height: calc(100% - 49px);">
                                            <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                                <tr>
                                                    <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                        Action
                                                    </th>
                                                    <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                        Form Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableForm" name="tableForm">
                                                @foreach ($forms as $form)
                                                    <tr class="bg-white border-b hover:bg-gray-50">
                                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                                            @if ($form->status == 0)
                                                            <button type="button" data-key="{{$form->key}}" class="btnEditForm" id="btnEditForm"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                            <button type="button" data-key="{{$form->key}}" data-name="{{$form->form_name}}" data-fstatus="{{$form->status}}" class="btnActForm" id="btnActForm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                    <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                                    <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                                </svg>
                                                            </button>
                                                            @else
                                                            <button type="button" data-key="{{$form->key}}" class="btnEditForm" id="btnEditForm"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                            <button type="button" data-key="{{$form->key}}" data-name="{{$form->form_name}}" data-fstatus="{{$form->status}}" class="btnActForm" id="btnActForm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                    <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                                    <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                                </svg>
                                                            </button>
                                                            @endif 
                                                                    
                                                        </td>
                                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                                            {{$form->form_name}}
                                                        </td>
                                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                                            @if ($form->status == 0)
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
                                    {{-- End FORM Table --}}

                                    {{-- Start PROCESS Table --}}
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(100vh - 210px);">
                                        <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                            <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                                Process
                                            </div>
                                            <div class="justify-self-end">
                                                <button type="button" id="btnAddProcess" name="btnAddProcess" data-modal-target="modalProcess" data-modal-toggle="modalProcess" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2">ADD</button>
                                            </div>
                                        </div>
                                        <table class="relative w-full text-sm text-left rtl:text-right text-gray-500 overflow-y-auto" style="max-height: calc(100% - 49px);">
                                            <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                                <tr>
                                                    <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                        Action
                                                    </th>
                                                    <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                        Process Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableProcess" name="tableProcess">
                                                @foreach ($processx as $process)
                                                    <tr class="bg-white border-b hover:bg-gray-50">
                                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                                            @if ($process->status == 0)
                                                            <button type="button" data-key="{{$process->key}}" class="btnEditProcess" id="btnEditProcess"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                            <button type="button" data-key="{{$process->key}}" data-name="{{$process->process_name}}" data-pstatus="{{$process->status}}" class="btnActProcess" id="btnActProcess">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                    <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                                    <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                                </svg>
                                                            </button>
                                                            @else
                                                            <button type="button" data-key="{{$process->key}}" class="btnEditProcess" id="btnEditProcess"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                            <button type="button" data-key="{{$process->key}}" data-name="{{$process->process_name}}" data-pstatus="{{$process->status}}" class="btnActProcess" id="btnActProcess">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                    <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                                    <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                                </svg>
                                                            </button>
                                                            @endif 
                                                                    
                                                        </td>
                                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                                            {{$process->process_name}}
                                                        </td>
                                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                                            @if ($process->status == 0)
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
                                    {{-- End PROCESS Table --}}
                                </div>
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50" id="cpoint" role="tabpanel" aria-labelledby="cpoint-tab">
                                {{-- Start CHECK POINT/S Table --}}
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(100vh - 210px);">
                                    <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                        <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                            Check Point/s
                                        </div>
                                        <div class="justify-self-end">
                                            <button type="button" id="btnAddCPoint" name="btnAddCPoint" data-modal-target="modalCPoint" data-modal-toggle="modalCPoint" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2">ADD</button>
                                        </div>
                                    </div>
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="max-height: calc(100% - 49px);">
                                        <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                            <tr>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                    Action
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 40%;">
                                                    Check Point/s
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 40%;">
                                                    Process
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableCPoint" name="tableCPoint">
                                            @foreach ($checkpoints as $cp)
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        @if ($cp->status == 0)
                                                        <button type="button" data-key="{{$cp->key}}" class="btnEditCPoint" id="btnEditCPoint"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                        <button type="button" data-key="{{$cp->key}}" data-name="{{$cp->cpoint_name}}" data-cpstatus="{{$cp->status}}" class="btnActCPoint" id="btnActCPoint">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                                <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                            </svg>
                                                        </button>
                                                        @else
                                                        <button type="button" data-key="{{$cp->key}}" class="btnEditCPoint" id="btnEditCPoint"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                        <button type="button" data-key="{{$cp->key}}" data-name="{{$cp->cpoint_name}}" data-cpstatus="{{$cp->status}}" class="btnActCPoint" id="btnActCPoint">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                                <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                            </svg>
                                                        </button>
                                                        @endif 
                                                                
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        {{$cp->cpoint_name}}
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        {{$cp->processDetails->process_name}}
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        @if ($cp->status == 0)
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
                                {{-- End CHECK POINT/S Table --}}
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50" id="question" role="tabpanel" aria-labelledby="question-tab">
                                {{-- Start QUESTION Table --}}
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(100vh - 210px);">
                                    <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                        <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                            Question
                                        </div>
                                        <div class="justify-self-end">
                                            <button type="button" id="btnAddQuestion" name="btnAddQuestion" data-modal-target="modalQuestion" data-modal-toggle="modalQuestion" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2">ADD</button>
                                        </div>
                                    </div>
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="max-height: calc(100% - 49px);">
                                        <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                            <tr>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                    Action
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                    Question/s
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                    Process
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                    Checkpoint
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                    Points
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableQuestion" name="tableQuestion">
                                            @foreach ($questionsy as $questiony)
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        @if ($questiony->status == 0)
                                                        <button type="button" data-key="{{$questiony->key}}" class="btnEditQuestion" id="btnEditQuestion"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                        <button type="button" data-key="{{$questiony->key}}" data-name="{{$questiony->question}}" data-qstatus="{{$questiony->status}}" class="btnActQuestion" id="btnActQuestion">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                                <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                            </svg>
                                                        </button>
                                                        @else
                                                        <button type="button" data-key="{{$questiony->key}}" class="btnEditQuestion" id="btnEditQuestion"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                        <button type="button" data-key="{{$questiony->key}}" data-name="{{$questiony->question}}" data-qstatus="{{$questiony->status}}" class="btnActQuestion" id="btnActQuestion">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                                <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                            </svg>
                                                        </button>
                                                        @endif      
                                                    </td>
                                                    <td class="px-6 py-2 whitespace-wrap">
                                                        {{$questiony->question}}
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        {{$questiony->processDetails->process_name}}
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        {{$questiony->cpointDetails->cpoint_name}}
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        {{$questiony->question_point}}
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        @if ($questiony->status == 0)
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
                                {{-- End QUESTION Table --}}
                            </div>
                            <div class="hidden p-4 rounded-lg bg-gray-50" id="questionnaire" role="tabpanel" aria-labelledby="questionnaire-tab">
                                {{-- Start QUESTIONNAIRE Table --}}
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(100vh - 210px);">
                                    <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                        <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                            Questionnaire
                                        </div>
                                        <div class="justify-self-end grid grid-cols-2 gap-2">
                                            <div class="">
                                                <select id="qnrprocess" name="qnrprocess" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                    <option class="text-center" selected value="0">All Questionnaire</option>
                                                    @foreach($formsx as $formx)
                                                    <option value="{{ $formx->id }}">{{ $formx->form_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="">
                                                <button type="button" id="btnAddQuestionnaire" name="btnAddQuestionnaire" data-modal-target="modalQuestionnaire" data-modal-toggle="modalQuestionnaire" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2">ADD QUESTIONNAIRE</button>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="max-height: calc(100% - 49px);">
                                        <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                            <tr>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                    Action
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 35%;">
                                                    Questionaire Name
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                    Questions
                                                </th>
                                                <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableQuestionnaire" name="tableQuestionnaire" class="tableQuestionnaire">
                                            @foreach ($questionnairex as $qnrx)
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        @if ($qnrx->status == 0)
                                                        <button type="button" data-key="{{$qnrx->key}}" class="btnEditQuestionnaire" id="btnEditQuestionnaire"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                        <button type="button" data-key="{{$qnrx->key}}" data-name="{{$qnrx->formDetails->form_name}}" data-qstatus="{{$qnrx->status}}" class="btnActQuestionnaire" id="btnActQuestionnaire">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                                <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                            </svg>
                                                        </button>
                                                        @else
                                                        <button type="button" data-key="{{$qnrx->key}}" class="btnEditQuestionnaire" id="btnEditQuestionnaire"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                        <button type="button" data-key="{{$qnrx->key}}" data-name="{{$qnrx->formDetails->form_name}}" data-qstatus="{{$qnrx->status}}" class="btnActQuestionnaire" id="btnActQuestionnaire">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                                <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                                <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                            </svg>
                                                        </button>
                                                        @endif      
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        {{$qnrx->formDetails->form_name}}
                                                    </td>
                                                    <td class="px-6 py-2 text-left whitespace-nowrap">
                                                        @foreach (explode(',', $qnrx->question_list) as $questionId)
                                                            @foreach ($questionsy as $question)
                                                                @if ($question->id == $questionId)
                                                                    <p>• {{$question->question}}</p>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-2 text-center whitespace-nowrap">
                                                        @if ($qnrx->status == 0)
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
                                {{-- End QUESTIONNAIRE Table --}}
                            </div>
                        </div>


                        {{-- <div class="flex flex-wrap gap-2 justify-center sm:flex-nowrap"> --}}
                            {{-- Start PROCESS Table --}}
                            {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(50vh - 92px);">
                                <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                    <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                        Process
                                    </div>
                                    <div class="justify-self-end">
                                        <button type="button" id="btnAddForm" name="btnAddForm" data-modal-target="modalForm" data-modal-toggle="modalForm" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2">ADD</button>
                                    </div>
                                </div>
                                <table class="relative w-full text-sm text-left rtl:text-right text-gray-500 overflow-y-auto" style="max-height: calc(100% - 49px);">
                                    <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                        <tr>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                Action
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                                Form Name
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableForm" name="tableForm">
                                        @foreach ($forms as $form)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    @if ($form->status == 0)
                                                    <button type="button" data-key="{{$form->key}}" class="btnEditForm" id="btnEditForm"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                    <button type="button" data-key="{{$form->key}}" data-name="{{$form->form_name}}" data-fstatus="{{$form->status}}" class="btnActForm" id="btnActForm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                            <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                        </svg>
                                                    </button>
                                                    @else
                                                    <button type="button" data-key="{{$form->key}}" class="btnEditForm" id="btnEditForm"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                    <button type="button" data-key="{{$form->key}}" data-name="{{$form->form_name}}" data-fstatus="{{$form->status}}" class="btnActForm" id="btnActForm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                            <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                        </svg>
                                                    </button>
                                                    @endif 
                                                            
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    {{$form->form_name}}
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    @if ($form->status == 0)
                                                        <p class="text-red-500 bg-red-200">Inactive</p>
                                                    @else
                                                        <p class="text-green-500 bg-green-200">Active</p>
                                                    @endif 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                            {{-- End PROCESS Table --}}
                            
                            {{-- Start CHECK POINT/S Table --}}
                            {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(50vh - 92px);">
                                <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                    <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                        Check Point/s
                                    </div>
                                    <div class="justify-self-end">
                                        <button type="button" id="btnAddCPoint" name="btnAddCPoint" data-modal-target="modalCPoint" data-modal-toggle="modalCPoint" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2">ADD</button>
                                    </div>
                                </div>
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="max-height: calc(100% - 49px);">
                                    <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                        <tr>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                Action
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 40%;">
                                                Check Point/s
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 40%;">
                                                Process
                                            </th>
                                            <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableCPoint" name="tableCPoint">
                                        @foreach ($checkpoints as $cp)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    @if ($cp->status == 0)
                                                    <button type="button" data-key="{{$cp->key}}" class="btnEditCPoint" id="btnEditCPoint"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                    <button type="button" data-key="{{$cp->key}}" data-name="{{$cp->cpoint_name}}" data-cpstatus="{{$cp->status}}" class="btnActCPoint" id="btnActCPoint">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                            <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                        </svg>
                                                    </button>
                                                    @else
                                                    <button type="button" data-key="{{$cp->key}}" class="btnEditCPoint" id="btnEditCPoint"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                    <button type="button" data-key="{{$cp->key}}" data-name="{{$cp->cpoint_name}}" data-cpstatus="{{$cp->status}}" class="btnActCPoint" id="btnActCPoint">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                            <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                        </svg>
                                                    </button>
                                                    @endif 
                                                            
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    {{$cp->cpoint_name}}
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    {{$cp->processDetails->form_name}}
                                                </td>
                                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                                    @if ($cp->status == 0)
                                                        <p class="text-red-500 bg-red-200">Inactive</p>
                                                    @else
                                                        <p class="text-green-500 bg-green-200">Active</p>
                                                    @endif 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> --}}
                            {{-- End CHECK POINT/S Table --}}
                        {{-- </div> --}}

                        {{-- Start QUESTION Table --}}
                        {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="flex: 1; height: calc(50vh - 92px);">
                            <div class="px-4 grid content-center grid-cols-2 gap-x-3 border-b h-[49px] sticky top-0 bg-white z-10">
                                <div class="self-center font-black text-xl text-orange-500 leading-tight">
                                    Question
                                </div>
                                <div class="justify-self-end">
                                    <button type="button" id="btnAddQuestion" name="btnAddQuestion" data-modal-target="modalQuestion" data-modal-toggle="modalQuestion" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2">ADD</button>
                                </div>
                            </div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500" style="max-height: calc(100% - 49px);">
                                <thead class="text-xs text-gray-700 uppercase bg-white sticky top-[50px] shadow-md">
                                    <tr>
                                        <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                            Action
                                        </th>
                                        <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                            Question/s
                                        </th>
                                        <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                            Process
                                        </th>
                                        <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                            Checkpoint
                                        </th>
                                        <th scope="col" class="px-6 py-2 text-center" style="width: 80%;">
                                            Points
                                        </th>
                                        <th scope="col" class="px-6 py-2 text-center" style="width: 10%;">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableQuestion" name="tableQuestion">
                                    @foreach ($questions as $question)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($question->status == 0)
                                                <button type="button" data-key="{{$question->key}}" class="btnEditQuestion" id="btnEditQuestion"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                <button type="button" data-key="{{$question->key}}" data-name="{{$question->question}}" data-qstatus="{{$question->status}}" class="btnActQuestion" id="btnActQuestion">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                        <rect x="2" y="2" width="20" height="20" fill="none" stroke="#0dbd00" stroke-width="2"/>
                                                        <path fill="#0dbd00" d="M8.864 14.627L6.694 12.483C6.315 12.107 5.683 12.105 5.294 12.489C4.903 12.876 4.903 13.492 5.288 13.873L8.114 16.666C8.547 17.097 9.178 17.096 9.571 16.708L18.704 7.682C19.095 7.296 19.1 6.674 18.709 6.287C18.321 5.903 17.69 5.904 17.297 6.292L8.864 14.627Z"/>
                                                    </svg>
                                                </button>
                                                @else
                                                <button type="button" data-key="{{$question->key}}" class="btnEditQuestion" id="btnEditQuestion"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                <button type="button" data-key="{{$question->key}}" data-name="{{$question->question}}" data-qstatus="{{$question->status}}" class="btnActQuestion" id="btnActQuestion">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                        <rect x="2" y="2" width="20" height="20" fill="none" stroke="#ff0000" stroke-width="2"/>
                                                        <path fill="#ff0000" d="M12 10.483L7.836 6.319C7.412 5.895 6.732 5.894 6.314 6.313C5.892 6.735 5.897 7.413 6.319 7.835L10.484 12L6.319 16.165C5.897 16.587 5.892 17.265 6.314 17.687C6.732 18.105 7.412 18.105 7.836 17.681L12 13.517L16.164 17.681C16.588 18.105 17.268 18.105 17.686 17.687C18.108 17.265 18.103 16.587 17.681 16.165L13.516 12L17.681 7.835C18.103 7.413 18.108 6.735 17.686 6.313C17.268 5.894 16.588 5.895 16.164 6.319L12 10.483Z"/>
                                                    </svg>
                                                </button>
                                                @endif 
                                                        
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$question->question}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$question->processDetails->form_name}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$question->cpointDetails->cpoint_name}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$question->question_point}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($question->status == 0)
                                                    <p class="text-red-500 bg-red-200">Inactive</p>
                                                @else
                                                    <p class="text-green-500 bg-green-200">Active</p>
                                                @endif 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                        {{-- End QUESTION Table --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- HIDDEN BUTTONS --}}
            {{-- Edit Form --}}
                <button type="button" id="btnEditFormH" class="btnEditFormH hidden" data-modal-target="modalForm" data-modal-toggle="modalForm"></button>
            {{-- Edit Process --}}
                <button type="button" id="btnEditProcessH" class="btnEditProcessH hidden" data-modal-target="modalProcess" data-modal-toggle="modalProcess"></button>
            {{-- Edit Checkpoint --}}
                <button type="button" id="btnEditCPointH" class="btnEditCPointH hidden" data-modal-target="modalCPoint" data-modal-toggle="modalCPoint"></button>
            {{-- Edit Question --}}
                <button type="button" id="btnEditQuestionH" class="btnEditQuestionH hidden" data-modal-target="modalQuestion" data-modal-toggle="modalQuestion"></button>
            {{-- Edit Questionnaire --}}
                <button type="button" id="btnEditQuestionnaireH" class="btnEditQuestionnaireH hidden" data-modal-target="modalQuestionnaire" data-modal-toggle="modalQuestionnaire"></button>
            {{-- Confirm Activate/Deactivate Modal - Form --}}
                <button type="button" id="btnConfirmADH" class="btnConfirmADH hidden" data-modal-target="modalConfirmF" data-modal-toggle="modalConfirmF"></button>
            {{-- Confirm Activate/Deactivate Modal - Process  --}}
                <button type="button" id="btnConfirmADPH" class="btnConfirmADPH hidden" data-modal-target="modalConfirmP" data-modal-toggle="modalConfirmP"></button>
            {{-- Confirm Activate/Deactivate Modal - Checkpoint --}}
                <button type="button" id="btnConfirmADCPH" class="btnConfirmADCPH hidden" data-modal-target="modalConfirmCP" data-modal-toggle="modalConfirmCP"></button>
            {{-- Confirm Activate/Deactivate Modal - Question --}}
                <button type="button" id="btnConfirmADQH" class="btnConfirmADQH hidden" data-modal-target="modalConfirmQ" data-modal-toggle="modalConfirmQ"></button>
            {{-- Confirm Activate/Deactivate Modal - Questionnaire --}}
                <button type="button" id="btnConfirmADQnrH" class="btnConfirmADQnrH hidden" data-modal-target="modalConfirmQnr" data-modal-toggle="modalConfirmQnr"></button>
            {{-- Success Modal --}}
                <button type="button" id="btnSuccessH" class="btnSuccessH hidden" data-modal-target="modalSuccess" data-modal-toggle="modalSuccess"></button>
            {{-- Inc Modal --}}
                <button type="button" id="btnIncH" class="btnIncUserH hidden" data-modal-target="modalInc" data-modal-toggle="modalInc"></button>

        {{-- FORM MODAL --}}
            <div id="modalForm" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label id="titleForm" class="text-3xl font-extrabold text-gray-900">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD FORM</span>
                            </label>
                            <button type="button" id="closeForm1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalForm">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 w-full">
                            <form action="" id="formForm" name="formForm" class="w-full">
                                @csrf
                                <input type="hidden" id="formKey" name="formKey">
                                <input type="hidden" id="formID" name="formID">
                                <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">Form Name</label>
                                        <input type="text" id="fname" name="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="fstatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                        <div class="grid justify-items-start">
                                            <select id="fstatus" name="fstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="button" id="btnSaveForm" name="btnSaveForm" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                            <button data-modal-hide="modalForm" type="button" id="closeForm2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}
            <div id="modalConfirmF" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                    <div class="flex justify-center">
                        <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 id="titleF" class="text-lg font-medium text-gray-900 mb-4"></h3>
                        <h3 id="nameF" class="text-sm"></h3>
                    </div>
                    <div class="flex mt-5 sm:mt-6 justify-center">
                        <button type="button" id="actConfirmP"  data-modal-hide="modalConfirmF" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure.
                        </button>
                        <button data-modal-hide="modalConfirmF" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                    </div>
                </div>
            </div>

        {{-- PROCESS MODAL --}}
            <div id="modalProcess" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label id="titleProcess" class="text-3xl font-extrabold text-gray-900">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD PROCESS</span>
                            </label>
                            <button type="button" id="closeProcess1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalProcess">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 w-full">
                            <form action="" id="formProcess" name="formProcess" class="w-full">
                                @csrf
                                <input type="hidden" id="processKey" name="processKey">
                                <input type="hidden" id="processID" name="processID">
                                <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="pname" class="block mb-2 text-sm font-medium text-gray-900">Process Name</label>
                                        <input type="text" id="pname" name="pname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="pstatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                        <div class="grid justify-items-start">
                                            <select id="pstatus" name="pstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="button" id="btnSaveProcess" name="btnSaveProcess" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                            <button data-modal-hide="modalProcess" type="button" id="closeProcess2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}
            <div id="modalConfirmP" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                    <div class="flex justify-center">
                        <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 id="titleP" class="text-lg font-medium text-gray-900 mb-4"></h3>
                        <h3 id="nameP" class="text-sm"></h3>
                    </div>
                    <div class="flex mt-5 sm:mt-6 justify-center">
                        <button type="button" id="actConfirmProc" data-modal-hide="modalConfirmP" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure.
                        </button>
                        <button data-modal-hide="modalConfirmP" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                    </div>
                </div>
            </div>

        {{-- CHECK POINT/S MODAL --}}
            <div id="modalCPoint" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label id="titleCPoint" class="text-3xl font-extrabold text-gray-900">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD CHECK POINT</span>
                            </label>
                            <button type="button" id="closeCPoint1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalCPoint">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 w-full">
                            <form action="" id="formCPoint" name="formCPoint" class="w-full">
                                @csrf
                                <input type="hidden" id="cpointKey" name="cpointKey">
                                <input type="hidden" id="cpointID" name="cpointID">
                                <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="cpprocess" class="block mb-2 text-sm font-medium text-gray-900">Process</label>
                                        <div class="grid justify-items-start">
                                            <select id="cpprocess" name="cpprocess" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Process--</option>
                                                @foreach($processy as $procs)
                                                <option value="{{ $procs->id }}">{{ $procs->process_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="cpname" class="block mb-2 text-sm font-medium text-gray-900">Checkpoint Name</label>
                                        <input type="text" id="cpname" name="cpname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="cpstatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                        <div class="grid justify-items-start">
                                            <select id="cpstatus" name="cpstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="button" id="btnSaveCPoint" name="btnSaveCPoint" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                            <button data-modal-hide="modalCPoint" type="button" id="closeCPoint2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}
            <div id="modalConfirmCP" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                    <div class="flex justify-center">
                        <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 id="titleCP" class="text-lg font-medium text-gray-900 mb-4"></h3>
                        <h3 id="nameCP" class="text-sm"></h3>
                    </div>
                    <div class="flex mt-5 sm:mt-6 justify-center">
                        <button type="button" id="actConfirmPCP"  data-modal-hide="modalConfirmCP" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure.
                        </button>
                        <button data-modal-hide="modalConfirmCP" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                    </div>
                </div>
            </div>

        {{-- QUESTION/S MODAL --}}
            <div id="modalQuestion" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label id="titleQuestion" class="text-3xl font-extrabold text-gray-900">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD QUESTION</span>
                            </label>
                            <button type="button" id="closeQuestion1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalQuestion">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 w-full">
                            <form action="" id="formQuestion" name="formQuestion" class="w-full">
                                @csrf
                                <input type="hidden" id="questionKey" name="questionKey">
                                <input type="hidden" id="questionID" name="questionID">
                                <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="qprocess" class="block mb-2 text-sm font-medium text-gray-900">Process</label>
                                        <div class="grid justify-items-start">
                                            <select id="qprocess" name="qprocess" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Process--</option>
                                                @foreach($processy as $procsy)
                                                <option value="{{ $procsy->id }}">{{ $procsy->process_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="qcpoint" class="block mb-2 text-sm font-medium text-gray-900">Checkpoint</label>
                                        <div class="grid justify-items-start">
                                            <select id="qcpoint" name="qcpoint" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Checkpoint--</option>
                                                @foreach($cpoints as $cpoint)
                                                <option value="{{ $cpoint->id }}" data-process="{{ $cpoint->process_id }}">{{ $cpoint->cpoint_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-2">
                                        <label for="qquestion" class="block mb-2 text-sm font-medium text-gray-900">Question</label>
                                        <input type="text" id="qquestion" name="qquestion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="qpoint" class="block mb-2 text-sm font-medium text-gray-900">Question Point</label>
                                        <input type="text" id="qpoint" name="qpoint" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div>
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="qstatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                        <div class="grid justify-items-start">
                                            <select id="qstatus" name="qstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center" selected disabled value="">--Select Status--</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="button" id="btnSaveQuestion" name="btnSaveQuestion" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                            <button data-modal-hide="modalQuestion" type="button" id="closeQuestion2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}
            <div id="modalConfirmQ" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                    <div class="flex justify-center">
                        <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 id="titleQ" class="text-lg font-medium text-gray-900 mb-4"></h3>
                        <h3 id="nameQ" class="text-sm"></h3>
                    </div>
                    <div class="flex mt-5 sm:mt-6 justify-center">
                        <button type="button" id="actConfirmPQ"  data-modal-hide="modalConfirmQ" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure.
                        </button>
                        <button data-modal-hide="modalConfirmQ" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                    </div>
                </div>
            </div>

        {{-- QUESTIONNAIRE MODAL --}}
            <div id="modalQuestionnaire" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <label id="titleQuestionnaire" class="text-3xl font-extrabold text-gray-900">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">EDIT QUESTIONNAIRE</span>
                            </label>
                            <button type="button" id="closeQuestionnaire1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalQuestionnaire">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-3 space-y-6 w-full">
                            <form action="" id="formQuestionnaire" name="formQuestionnaire" class="w-full">
                                @csrf
                                <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    {{-- <div class="mb-3 col-span-2 sm:col-span-1">
                                        <label for="qnrname" class="block mb-2 text-sm font-medium text-gray-900">Questionnaire Name</label>
                                        <input type="text" id="qnrname" name="qnrname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                    </div> --}}
                                    <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                        <label for="qtrform" class="block mb-2 text-sm font-medium text-gray-900">Form</label>
                                        <div class="grid justify-items-start">
                                            <select id="qtrform" name="qtrform" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                <option class="text-center pointer-events-none" selected value="0">--Select Form--</option>
                                                {{-- @foreach($formsy as $formy)
                                                <option value="{{ $formy->id }}">{{ $formy->form_name }}</option>
                                                @endforeach --}}
                                                {{-- @foreach($formsy as $formy)
                                                    <option value="{{ $formy->id }}" @if(in_array($formy->id, $existingFormIds)) class="pointer-events-none opacity-50" style="pointer-events: none;"@endif>{{ $formy->form_name }}</option>
                                                @endforeach --}}
                                                @foreach($formsy as $formy)
                                                    <option value="{{ $formy->id }}" @if(in_array($formy->id, $existingFormIds)) class="hidden" @endif>{{ $formy->form_name }}</option>
                                                @endforeach
    
                                            </select>
                                        </div>
                                    </div>
                                    <div class=""></div>
                                    <div class="col-span-2 mt-4 sm:col-span-2 w-full">
                                        <label for="" class="block text-sm font-medium text-gray-900">Select questions to be displayed on selected form:</label>
                                    </div>
                                </div>
                                <hr class="h-px my-2.5 bg-gray-200 border-0">
                                <div class="divquestionnaire grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                    <div class="mb-3 col-span-2 sm:col-span-2 w-full">

                                        <div class="grid justify-items-start">
                                            <div class="mb-4 border-b border-gray-200">
                                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="process-tabs" data-tabs-toggle="#process-tab-content" role="tablist">
                                                    @php $processCounter = 0; $previousProcess = null; @endphp
                                                    @foreach($questionsx as $questionx)
                                                        @if ($questionx->processDetails->process_name != $previousProcess)
                                                            @php $processCounter++; @endphp
                                                            <li class="me-2" role="presentation">
                                                                <button class="inline-block p-2 border-b-2 rounded-t-lg" id="process{{$processCounter}}-tab" data-tabs-target="#process{{$processCounter}}" type="button" role="tab" aria-controls="process{{$processCounter}}" aria-selected="false">{{$questionx->processDetails->process_name}}</button>
                                                            </li>
                                                        @endif
                                                        @php $previousProcess = $questionx->processDetails->process_name; @endphp
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="process-tab-content" class="overflow-y-auto" style="max-height: 350px;">
                                            @php
                                                $processCounter = 0;
                                                $previousProcess = null;
                                                $previousCheckpoint = null;
                                            @endphp
                                            @foreach($questionsx as $questionx)
                                                @if ($questionx->processDetails->process_name != $previousProcess)
                                                    @php $processCounter++; $previousCheckpoint = null; @endphp
                                                    <div class="hidden p-2 rounded-lg bg-gray-50" id="process{{$processCounter}}" role="tabpanel" aria-labelledby="process{{$processCounter}}-tab">
                                                @endif
                                                @if ($questionx->cpointDetails->cpoint_name != $previousCheckpoint)
                                                    <div class="mt-2" style="margin-left: 20px;">
                                                        <p>• {{$questionx->cpointDetails->cpoint_name}}</p>
                                                        @php $previousCheckpoint = $questionx->cpointDetails->cpoint_name; @endphp
                                                    </div>
                                                @endif
                                                <div style="margin-left: 40px;">
                                                    <input type="checkbox" name="question[]" value="{{ $questionx->id }}">
                                                    <label>{{ $questionx->question }}</label><br>
                                                </div>
                                                @if ($loop->last || ($loop->index + 1 < count($questionsx) && $questionsx[$loop->index + 1]->processDetails->process_name != $questionx->processDetails->process_name))
                                                    </div>
                                                @endif
                                                @if ($loop->last)
                                                    </div>
                                                @endif
                                                @php $previousProcess = $questionx->processDetails->process_name; @endphp
                                            @endforeach
                                    </div>
                                </div>                                                             
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-3 space-x-2 border-t border-gray-200 rounded-b">
                            <button type="button" id="btnSaveQuestionnaire" name="btnSaveQuestionnaire" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                            <button data-modal-hide="modalQuestionnaire" type="button" id="closeQuestionnaire2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- CONFIRM ACTIVATE/DEACTIVATE MODAL --}}
            <div id="modalConfirmQnr" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                    <div class="flex justify-center">
                        <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 id="titleQnr" class="text-lg font-medium text-gray-900 mb-4"></h3>
                        <h3 id="nameQnr" class="text-sm"></h3>
                    </div>
                    <div class="flex mt-5 sm:mt-6 justify-center">
                        <button type="button" id="actConfirmPQnr"  data-modal-hide="modalConfirmQnr" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure.
                        </button>
                        <button data-modal-hide="modalConfirmQnr" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                    </div>
                </div>
            </div>

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
    </div>
    <script>
        $(document).ready(function () {
        // FORM
            // Add Form
                jQuery(document).on( "click", "#btnAddForm", function(){
                    $('#formForm').trigger('reset');

                    var newHeading = "ADD FORM";
                    document.getElementById("titleForm").querySelector("span").textContent = newHeading;

                    $('#btnSaveForm').text('ADD');

                    $('#formKey').val('');
                    $('#formID').val('');
                });

            // View/Edit Form
                jQuery(document).on( "click", "#btnEditForm", function(){
                    var keyForm = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.getFormData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyForm: keyForm, _token: _token,},
                        success:function(result){
                            $("#btnEditFormH").click();
                            var newHeading = "EDIT FORM";
                            document.getElementById("titleForm").querySelector("span").textContent = newHeading;

                            $('#formKey').val(result.fKey);
                            $('#formID').val(result.fID);
                            $('#fname').val(result.fname);
                            $('#fstatus').val(result.fstatus);
                        }
                    });
                });

            // Save Add/Edit Form
                jQuery(document).on( "click", "#btnSaveForm", function(){
                    if($('#fname').val() == "" || $('#fstatus').val() == null){
                        $("#btnIncH").click();
                    }else{
                        $.ajax({
                            url:"{{ route('bpa-systemconfig.sc-forms.saveFormData') }}",
                            method:"POST",
                            dataType: 'json',
                            data: $("#formForm").serialize(),
                            success:function(result){
                                $('#tableForm').load(location.href + ' #tableForm>*','')
                                $("#btnSuccessH").click();
                                $("#closeForm1").click();
                            },
                            error: function(error){
                                $("#btnIncH").click();
                            }

                        });
                    }
                });

            // Activate/Deactivate Form
                jQuery(document).on( "click", "#btnActForm", function(){
                    var keyForm = $(this).data('key');
                    var nameForm = $(this).data('name');
                    var statusForm = $(this).data('fstatus');
                    
                    $("#btnConfirmADH").click();
                    $('#actConfirmP').data('key', keyForm);
                    $('#actConfirmP').data('fstatus', statusForm);

                    if(statusForm == 0){
                        var stat1 = "Activation";
                        var stat2 = "activate";
                    }else{
                        var stat1 = "Deactivation";
                        var stat2 = "deactivate";
                    }
                    $('#titleF').html('Confirm ' + stat1);
                    $('#nameF').html('Are you sure you want to <span class="text-red-700">'+ stat2 +'</span> FORM <span class="text-blue-700">'+ nameForm +'</span>?');
                });

                jQuery(document).on( "click", "#actConfirmP", function(){
                    var keyForm = $(this).data('key');
                    var statusForm = $(this).data('fstatus');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.statusForm') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyForm: keyForm, statusForm: statusForm, _token: _token,},
                        success:function(result){
                            $('#tableForm').load(location.href + ' #tableForm>*','')
                            $("#btnSuccessH").click();
                            $("#closeForm1").click();
                        },
                        error: function(error){
                            $("#btnIncH").click();
                        }

                    });
                });


        // PROCESS
            // Add Process
                jQuery(document).on( "click", "#btnAddProcess", function(){
                    $('#formProcess').trigger('reset');

                    var newHeading = "ADD PROCESS";
                    document.getElementById("titleProcess").querySelector("span").textContent = newHeading;

                    $('#btnSaveProcess').text('ADD');

                    $('#processKey').val('');
                    $('#processID').val('');
                });

            // View/Edit Process
                jQuery(document).on( "click", "#btnEditProcess", function(){
                    var keyProcess = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.getProcessData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyProcess: keyProcess, _token: _token,},
                        success:function(result){
                            $("#btnEditProcessH").click();
                            var newHeading = "EDIT PROCESS";
                            document.getElementById("titleProcess").querySelector("span").textContent = newHeading;

                            $('#processKey').val(result.pKey);
                            $('#processID').val(result.pID);
                            $('#pname').val(result.pname);
                            $('#pstatus').val(result.pstatus);
                        }
                    });
                });

            // Save Add/Edit Process
                jQuery(document).on( "click", "#btnSaveProcess", function(){
                    if($('#pname').val() == "" || $('#pstatus').val() == null){
                        $("#btnIncH").click();
                    }else{
                        $.ajax({
                            url:"{{ route('bpa-systemconfig.sc-forms.saveProcessData') }}",
                            method:"POST",
                            dataType: 'json',
                            data: $("#formProcess").serialize(),
                            success:function(result){
                                $('#tableProcess').load(location.href + ' #tableProcess>*','')
                                $("#btnSuccessH").click();
                                $("#closeProcess1").click();
                            },
                            error: function(error){
                                $("#btnIncH").click();
                            }

                        });
                    }
                });

            // Activate/Deactivate Process
                jQuery(document).on( "click", "#btnActProcess", function(){
                    var keyProcess = $(this).data('key');
                    var nameProcess = $(this).data('name');
                    var statusProcess = $(this).data('pstatus');
                    
                    $("#btnConfirmADPH").click();
                    $('#actConfirmProc').data('key', keyProcess);
                    $('#actConfirmProc').data('pstatus', statusProcess);

                    if(statusProcess == 0){
                        var stat1 = "Activation";
                        var stat2 = "activate";
                    }else{
                        var stat1 = "Deactivation";
                        var stat2 = "deactivate";
                    }
                    $('#titleP').html('Confirm ' + stat1);
                    $('#nameP').html('Are you sure you want to <span class="text-red-700">'+ stat2 +'</span> PROCESS <span class="text-blue-700">'+ nameProcess +'</span>?');
                });

                jQuery(document).on( "click", "#actConfirmProc", function(){
                    var keyProcess = $(this).data('key');
                    var statusProcess = $(this).data('pstatus');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.statusProcess') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyProcess: keyProcess, statusProcess: statusProcess, _token: _token,},
                        success:function(result){
                            $('#tableProcess').load(location.href + ' #tableProcess>*','')
                            $("#btnSuccessH").click();
                            $("#closeProcess1").click();
                        },
                        error: function(error){
                            $("#btnIncH").click();
                        }

                    });
                });

                
                
        // CHECKPOINT
            // Add Check Point
                jQuery(document).on( "click", "#btnAddCPoint", function(){
                    $('#formCPoint').trigger('reset');

                    var newHeading = "ADD CHECK POINT";
                    document.getElementById("titleCPoint").querySelector("span").textContent = newHeading;

                    $('#btnSaveCPoint').text('ADD');

                    $('#cpointKey').val('');
                    $('#cpointID').val('');
                });

            // View/Edit Check Point
                jQuery(document).on( "click", "#btnEditCPoint", function(){
                    var keyCPoint = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.getCPointData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyCPoint: keyCPoint, _token: _token,},
                        success:function(result){
                            $("#btnEditCPointH").click();
                            var newHeading = "EDIT CHECKPOINT";
                            document.getElementById("titleCPoint").querySelector("span").textContent = newHeading;

                            $('#cpointKey').val(result.cpKey);
                            $('#cpointID').val(result.cpID);
                            $('#cpname').val(result.cpname);
                            $('#cpprocess').val(result.cpprocess);
                            $('#cpstatus').val(result.cpstatus);
                        }
                    });
                });

            // Save Add/Edit Check Point
                jQuery(document).on( "click", "#btnSaveCPoint", function(){
                    if($('#cpname').val() == "" || $('#cpprocess').val() == null || $('#cpstatus').val() == null){
                        $("#btnIncH").click();
                    }else{
                        $.ajax({
                            url:"{{ route('bpa-systemconfig.sc-forms.saveCPointData') }}",
                            method:"POST",
                            dataType: 'json',
                            data: $("#formCPoint").serialize(),
                            success:function(result){
                                $('#tableCPoint').load(location.href + ' #tableCPoint>*','')
                                $("#btnSuccessH").click();
                                $("#closeCPoint1").click();
                            },
                            error: function(error){
                                $("#btnIncH").click();
                            }

                        });
                    }
                });

            // Activate/Deactivate Check Point
                jQuery(document).on( "click", "#btnActCPoint", function(){
                    var keyCPoint = $(this).data('key');
                    var nameCPoint = $(this).data('name');
                    var statusCPoint = $(this).data('cpstatus');
                    
                    $("#btnConfirmADCPH").click();
                    $('#actConfirmPCP').data('key', keyCPoint);
                    $('#actConfirmPCP').data('cpstatus', statusCPoint);

                    if(statusCPoint == 0){
                        var stat1 = "Activation";
                        var stat2 = "activate";
                    }else{
                        var stat1 = "Deactivation";
                        var stat2 = "deactivate";
                    }
                    $('#titleCP').html('Confirm ' + stat1);
                    $('#nameCP').html('Are you sure you want to <span class="text-red-700">'+ stat2 +'</span> CHECKPOINT <span class="text-blue-700">'+ nameCPoint +'</span>?');
                });

                jQuery(document).on( "click", "#actConfirmPCP", function(){
                    var keyCPoint = $(this).data('key');
                    var statusCPoint = $(this).data('cpstatus');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.statusCPoint') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyCPoint: keyCPoint, statusCPoint: statusCPoint, _token: _token,},
                        success:function(result){
                            $('#tableCPoint').load(location.href + ' #tableCPoint>*','')
                            $("#btnSuccessH").click();
                            // $("#closeCPoint1").click();
                        },
                        error: function(error){
                            $("#btnIncH").click();
                        }

                    });
                });

                
                
        // QUESTION
            // Numeric Input
                $('#qpoint').on('input', function () {
                    $(this).val($(this).val().replace(/\D/g, ''));
                });

            // On Change of Process
                $('#qprocess').change(function () {
                    var selectedProcessId = $(this).val();
                    $('#qcpoint option').each(function () {
                        if ($(this).data('process') == selectedProcessId || $(this).val() === '') {
                            $(this).prop('disabled', false);
                        } else {
                            $(this).prop('disabled', true);
                        }
                    });
                    $('#qcpoint').val('');
                });

            // Add Question
                jQuery(document).on( "click", "#btnAddQuestion", function(){
                    $('#formQuestion').trigger('reset');

                    var newHeading = "ADD QUESTION";
                    document.getElementById("titleQuestion").querySelector("span").textContent = newHeading;

                    $('#btnSaveQuestion').text('ADD');

                    $('#questionKey').val('');
                    $('#questionID').val('');
                });

            // View/Edit Question
                jQuery(document).on( "click", "#btnEditQuestion", function(){
                    var keyQuestion = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.getQuestionData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyQuestion: keyQuestion, _token: _token,},
                        success:function(result){
                            $("#btnEditQuestionH").click();
                            var newHeading = "EDIT CHECKPOINT";
                            document.getElementById("titleQuestion").querySelector("span").textContent = newHeading;

                            $('#questionKey').val(result.qKey);
                            $('#questionID').val(result.qID);
                            $('#qquestion').val(result.question);
                            $('#qprocess').val(result.qprocess);
                            $('#qcpoint').val(result.qcpoint);
                            $('#qpoint').val(result.qpoint);
                            $('#qstatus').val(result.qstatus);
                        }
                    });
                });

            // Save Add/Edit Question
                jQuery(document).on( "click", "#btnSaveQuestion", function(){
                    if($('#qpoint').val() == "" || $('#qprocess').val() == "" || $('#qquestion').val() == "" || $('#qcpoint').val() == null || $('#qstatus').val() == null){
                        $("#btnIncH").click();
                    }else{
                        $.ajax({
                            url:"{{ route('bpa-systemconfig.sc-forms.saveQuestionData') }}",
                            method:"POST",
                            dataType: 'json',
                            data: $("#formQuestion").serialize(),
                            success:function(result){
                                $('#tableQuestion').load(location.href + ' #tableQuestion>*','')
                                $("#btnSuccessH").click();
                                $("#closeQuestion1").click();
                            },
                            error: function(error){
                                $("#btnIncH").click();
                            }

                        });
                    }
                });

            // Activate/Deactivate Question
                jQuery(document).on( "click", "#btnActQuestion", function(){
                    var keyQuestion = $(this).data('key');
                    var nameQuestion = $(this).data('name');
                    var statusQuestion = $(this).data('qstatus');
                    
                    $("#btnConfirmADQH").click();
                    $('#actConfirmPQ').data('key', keyQuestion);
                    $('#actConfirmPQ').data('qstatus', statusQuestion);

                    if(statusQuestion == 0){
                        var stat1 = "Activation";
                        var stat2 = "activate";
                    }else{
                        var stat1 = "Deactivation";
                        var stat2 = "deactivate";
                    }
                    $('#titleQ').html('Confirm ' + stat1);
                    $('#nameQ').html('Are you sure you want to <span class="text-red-700">'+ stat2 +'</span> QUESTION <span class="text-blue-700">'+ nameQuestion +'</span>?');
                });

                jQuery(document).on( "click", "#actConfirmPQ", function(){
                    var keyQuestion = $(this).data('key');
                    var statusQuestion = $(this).data('qstatus');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.statusQuestion') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyQuestion: keyQuestion, statusQuestion: statusQuestion, _token: _token,},
                        success:function(result){
                            $('#tableQuestion').load(location.href + ' #tableQuestion>*','')
                            $("#btnSuccessH").click();
                            // $("#closeQuestion1").click();
                        },
                        error: function(error){
                            $("#btnIncH").click();
                        }

                    });
                });



        // QUESTIONNAIRE
            // Add Questionnaire
                jQuery(document).on( "click", "#btnAddQuestionnaire", function(){
                    if (event.target.id === "btnAddQuestionnaire") {
                        var qtrformValue = document.getElementById("qtrform").value;
                        if (qtrformValue === "0") {
                            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                            checkboxes.forEach(function(checkbox) {
                                checkbox.disabled = true;
                            });
                            var processTabsButtons = document.querySelectorAll('#process-tabs button');
                            processTabsButtons.forEach(function(button) {
                                button.disabled = true;
                            });
                            var divQuestionnaires = document.querySelectorAll('.divquestionnaire');
                            divQuestionnaires.forEach(function(div) {
                                div.disabled = true;
                                div.style.opacity = 0.5;
                            });
                        }
                    }
                            
                    $('#formQuestionnaire').trigger('reset');

                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.disabled = true;
                    });
                    var processTabsButtons = document.querySelectorAll('#process-tabs button');
                    processTabsButtons.forEach(function(button) {
                        button.disabled = true;
                    });
                    var divQuestionnaires = document.querySelectorAll('.divquestionnaire');
                    divQuestionnaires.forEach(function(div) {
                        div.disabled = true;
                        div.style.opacity = 0.5;
                    });

                    var processTabs = document.getElementById("process-tabs");
                    var firstTabButton = processTabs.querySelector("button");
                    if (firstTabButton) {
                        firstTabButton.click(); // Simulate a click event on the first tab button
                    }

                    var newHeading = "ADD QUESTIONNAIRE";
                    document.getElementById("titleQuestionnaire").querySelector("span").textContent = newHeading;

                    
                    $('#qtrform').css('pointer-events', 'auto')
                    $('#btnSaveQuestionnaire').text('ADD');
                });

            // Add Questionnaire
                jQuery(document).on( "click", "#btnAddQuestion", function(){
                    $('#formQuestion').trigger('reset');

                    var newHeading = "ADD QUESTION";
                    document.getElementById("titleQuestion").querySelector("span").textContent = newHeading;

                    $('#btnSaveQuestion').text('ADD');

                    $('#questionKey').val('');
                    $('#questionID').val('');
                });
                
            // On Change of Form Dropdown
                jQuery(document).on( "change", "#qtrform", function(){
                    var qtrformValue = document.getElementById("qtrform").value;
                    if(qtrformValue != 0){
                        $('input[type="checkbox"]').prop('disabled', false);
                        $('#process-tabs button').prop('disabled', false);
                        $('.divquestionnaire').prop('disabled', false).css('opacity', 1);
                        $('input[type="checkbox"]').prop('checked', false);
                    }else{
                        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                        checkboxes.forEach(function(checkbox) {
                            checkbox.disabled = true;
                        });
                        var processTabsButtons = document.querySelectorAll('#process-tabs button');
                        processTabsButtons.forEach(function(button) {
                            button.disabled = true;
                        });
                        var divQuestionnaires = document.querySelectorAll('.divquestionnaire');
                        divQuestionnaires.forEach(function(div) {
                            div.disabled = true;
                            div.style.opacity = 0.5;
                        });
                    }
                    
                    // var formQ = $('#qtrform').val();
                        // var _token = $('input[name="_token"]').val();

                        // $.ajax({
                        //     url:"{{ route('bpa-systemconfig.sc-forms.getQuestionnaireData') }}",
                        //     method:"GET",
                        //     dataType: 'json',
                        //     data:{formQ: formQ, _token: _token,},
                        //     success:function(result){
                        //         result.question_list.forEach(function(questionId) {
                        //             $('input[type="checkbox"][value="' + questionId + '"]').prop('checked', true);
                        //         });
                        //     }
                    // });
                });

            // Upon Saving of Questionnaire
                jQuery(document).on( "click", "#btnSaveQuestionnaire", function(){
                    var qtrformValue = document.getElementById("qtrform").value;
                    if (qtrformValue === "0" || $('#qnrname').val() == "") {
                        $("#btnIncH").click();
                    }else{
                        $.ajax({
                            url:"{{ route('bpa-systemconfig.sc-forms.saveQuestionnaireData') }}",
                            method:"POST",
                            dataType: 'json',
                            data: $("#formQuestionnaire").serialize(),
                            success:function(result){
                                $('#tableQuestionnaire').load(location.href + ' #tableQuestionnaire>*','')
                                $("#btnSuccessH").click();
                                $("#closeQuestionnaire2").click();
                            },
                            error: function(error){
                                $("#btnIncH").click();
                            }

                        });
                    }
                });

            // Edit Questionnaire
                jQuery(document).on( "click", "#btnEditQuestionnaire", function(){
                    var keyQuestionnaire = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.getQuestionnaireData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyQuestionnaire: keyQuestionnaire, _token: _token,},
                        success:function(result){
                            $('#formQuestionnaire').trigger('reset');

                            $("#btnEditQuestionnaireH").click();
                            var newHeading = "EDIT FORM";
                            document.getElementById("titleForm").querySelector("span").textContent = newHeading;

                            $("#qtrform").val(result.form_id).css('pointer-events', 'none');
                            result.question_list.forEach(function(questionId) {
                                $('input[type="checkbox"][value="' + questionId + '"]').prop('checked', true);
                            });

                            var qtrformValue = document.getElementById("qtrform").value;
                            if (qtrformValue !== "0") {
                                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                checkboxes.forEach(function(checkbox) {
                                    checkbox.disabled = false;
                                });
                                var processTabsButtons = document.querySelectorAll('#process-tabs button');
                                processTabsButtons.forEach(function(button) {
                                    button.disabled = false;
                                });
                                var divQuestionnaires = document.querySelectorAll('.divquestionnaire');
                                divQuestionnaires.forEach(function(div) {
                                    div.disabled = false;
                                    div.style.opacity = 1;
                                });
                            }
                        }
                    });
                });

            // Activate/Deactivate Questionnaire
                jQuery(document).on( "click", "#btnActQuestionnaire", function(){
                    var keyQuestionnaire = $(this).data('key');
                    var nameQuestionnaire = $(this).data('name');
                    var statusQuestionnaire = $(this).data('qstatus');
                    
                    $("#btnConfirmADQnrH").click();
                    $('#actConfirmPQnr').data('key', keyQuestionnaire);
                    $('#actConfirmPQnr').data('qstatus', statusQuestionnaire);

                    if(statusQuestionnaire == 0){
                        var stat1 = "Activation";
                        var stat2 = "activate";
                    }else{
                        var stat1 = "Deactivation";
                        var stat2 = "deactivate";
                    }
                    $('#titleQnr').html('Confirm ' + stat1);
                    $('#nameQnr').html('Are you sure you want to <span class="text-red-700">'+ stat2 +'</span> QUESTIONNAIRE <span class="text-blue-700">'+ nameQuestionnaire +'</span>?');
                });

                jQuery(document).on( "click", "#actConfirmPQnr", function(){
                    var keyQuestionnaire = $(this).data('key');
                    var statusQuestionnaire = $(this).data('qstatus');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-forms.statusQuestionnaire') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyQuestionnaire: keyQuestionnaire, statusQuestionnaire: statusQuestionnaire, _token: _token,},
                        success:function(result){
                            $('#tableQuestionnaire').load(location.href + ' #tableQuestionnaire>*','')
                            $("#btnSuccessH").click();
                            $('#qnrprocess').val('0')

                        },
                        error: function(error){
                            $("#btnIncH").click();
                        }

                    });
                });
                
            // On Change of Form Dropdown
                jQuery(document).on( "change", "#qnrprocess", function(){
                    var qnrprocessValue = document.getElementById("qnrprocess").value;
                    var _token = $('input[name="_token"]').val();

                    if(qnrprocessValue >= 1){
                        $.ajax({
                            url:"{{ route('bpa-systemconfig.sc-forms.selectQuestionnaire') }}",
                            method:"POST",
                            dataType: 'html',
                            data:{qnrprocessValue: qnrprocessValue, _token: _token,},
                            success:function(result){
                                $('#tableQuestionnaire').html(result);
                            },

                        });
                    }else{
                        $('#tableQuestionnaire').load(location.href + ' #tableQuestionnaire>*','')
                    }
                });
        });
    </script>
</x-app-layout>
