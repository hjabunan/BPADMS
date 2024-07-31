<x-app-layout>
    <div style="height: calc(100vh - 65px);" class="py-3 overflow-x-auto">
        <div class="max-w-8xl mx-auto sm:px-5 lg:px-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{-- Title --}}
                    <div class="px-4 grid grid-cols-2 gap-x-3 mb-5 border-b h-[49px]">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            Activity Logs
                        </div>
                    </div>
                    
                    {{-- Body --}}
                        {{-- Start Table --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="height: calc(100vh - 178px);">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="position: sticky; top: 0;">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Table
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            User
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$log->table}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$log->action}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$log->description}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$log->user_id}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
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
    </div>
    <script>
        $(document).ready(function () {
            
        });
    </script>
</x-app-layout>
