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
                            <button type="button" id="btnAddForm" name="btnAddForm" data-modal-target="modalForm" data-modal-toggle="modalForm" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2 ">ADD</button>
                        </div>
                    </div>
                                
                    {{-- Body --}}
                    <div class="flex flex-col gap-4" style="height: calc(100vh - 178px);">
                        <div id="default-tab-content">
                            <div class="hidden p-4 rounded-lg bg-gray-50" id="formprocess" role="tabpanel" aria-labelledby="formprocess-tab">
                                <div class="flex flex-wrap gap-2 justify-center sm:flex-nowrap">
                                </div>
                            </div>
                        </div>         
                    </div>
                </div>
            </div>
        </div>
        {{-- HIDDEN BUTTONS --}}
        

        {{-- FORM MODAL --}}
        
    </div>
    <script>
        $(document).ready(function () {
            
        });
    </script>
</x-app-layout>
