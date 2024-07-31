<x-app-layout>
    <div style="height: calc(100vh - 70px);" class="py-5 overflow-x-auto">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{-- Title --}}
                    <div class="px-4 grid gap-x-3 mb-5 border-b">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            User Management
                        </div>
                    </div>
                    
                    {{-- Body --}}
                        {{-- Start Table --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="height: calc(100vh - 178px);">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50" style="position: sticky; top: 0;">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Full Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($logs as $log) --}}
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                
                                            </td>
                                        </tr>
                                    {{-- @endforeach --}}
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
