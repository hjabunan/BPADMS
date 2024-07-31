<x-app-layout>
    <div style="height: calc(100vh - 65px);" class="py-3 overflow-x-auto">
        <div class="max-w-8xl mx-auto sm:px-5 lg:px-7">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 text-gray-900">
                    {{-- Title --}}
                    <div class="px-4 grid grid-cols-2 gap-x-3 mb-5 border-b h-[49px]">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            User Management
                        </div>
                        <div class="justify-self-end">
                            <button type="button" id="btnAddUser" name="btnAddUser" data-modal-target="modalUser" data-modal-toggle="modalUser" class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg shadow-blue-500/50 font-medium rounded-lg text-sm px-16 py-2.5 text-center mr-2 mb-2">ADD</button>
                        </div>
                    </div>
                    
                    {{-- Body --}}
                        {{-- Start Table --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="height: calc(100vh - 178px);">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-400" style="position: sticky; top: 0;">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Full Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            User Color
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableUser" name="tableUser">
                                    @foreach ($users as $user)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                <button type="button" data-key="{{$user->key}}" class="btnEditUser" id="btnEditUser"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M823.3 938.8H229.4c-71.6 0-129.8-58.2-129.8-129.8V215.1c0-71.6 58.2-129.8 129.8-129.8h297c23.6 0 42.7 19.1 42.7 42.7s-19.1 42.7-42.7 42.7h-297c-24.5 0-44.4 19.9-44.4 44.4V809c0 24.5 19.9 44.4 44.4 44.4h593.9c24.5 0 44.4-19.9 44.4-44.4V512c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v297c0 71.6-58.2 129.8-129.8 129.8z" fill="#3688FF"/><path d="M483 756.5c-1.8 0-3.5-0.1-5.3-0.3l-134.5-16.8c-19.4-2.4-34.6-17.7-37-37l-16.8-134.5c-1.6-13.1 2.9-26.2 12.2-35.5l374.6-374.6c51.1-51.1 134.2-51.1 185.3 0l26.3 26.3c24.8 24.7 38.4 57.6 38.4 92.7 0 35-13.6 67.9-38.4 92.7L513.2 744c-8.1 8.1-19 12.5-30.2 12.5z m-96.3-97.7l80.8 10.1 359.8-359.8c8.6-8.6 13.4-20.1 13.4-32.3 0-12.2-4.8-23.7-13.4-32.3L801 218.2c-17.9-17.8-46.8-17.8-64.6 0L376.6 578l10.1 80.8z" fill="#5F6379"/></svg></button>
                                                <button type="button" data-key="{{$user->key}}" class="btnResetPUser" id="btnResetPUser"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.6807 14.5869C19.1708 14.5869 22 11.7692 22 8.29344C22 4.81767 19.1708 2 15.6807 2C12.1907 2 9.3615 4.81767 9.3615 8.29344C9.3615 9.90338 10.0963 11.0743 10.0963 11.0743L2.45441 18.6849C2.1115 19.0264 1.63143 19.9143 2.45441 20.7339L3.33616 21.6121C3.67905 21.9048 4.54119 22.3146 5.2466 21.6121L6.27531 20.5876C7.30403 21.6121 8.4797 21.0267 8.92058 20.4412C9.65538 19.4167 8.77362 18.3922 8.77362 18.3922L9.06754 18.0995C10.4783 19.5045 11.7128 18.6849 12.1537 18.0995C12.8885 17.075 12.1537 16.0505 12.1537 16.0505C11.8598 15.465 11.272 15.465 12.0067 14.7333L12.8885 13.8551C13.5939 14.4405 15.0439 14.5869 15.6807 14.5869Z" stroke="#1C274C" stroke-width="1.5" stroke-linejoin="round"></path> <path opacity="0.5" d="M17.8851 8.29353C17.8851 9.50601 16.8982 10.4889 15.6807 10.4889C14.4633 10.4889 13.4763 9.50601 13.4763 8.29353C13.4763 7.08105 14.4633 6.09814 15.6807 6.09814C16.8982 6.09814 17.8851 7.08105 17.8851 8.29353Z" stroke="#1C274C" stroke-width="1.5"></path> </g></svg></button>
                                                <button type="button" data-key="{{$user->key}}" class="btnDeleteUser" id="btnDeleteUser"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M779.5 1002.7h-535c-64.3 0-116.5-52.3-116.5-116.5V170.7h768v715.5c0 64.2-52.3 116.5-116.5 116.5zM213.3 256v630.1c0 17.2 14 31.2 31.2 31.2h534.9c17.2 0 31.2-14 31.2-31.2V256H213.3z" fill="#ff3838"/><path d="M917.3 256H106.7C83.1 256 64 236.9 64 213.3s19.1-42.7 42.7-42.7h810.7c23.6 0 42.7 19.1 42.7 42.7S940.9 256 917.3 256zM618.7 128H405.3c-23.6 0-42.7-19.1-42.7-42.7s19.1-42.7 42.7-42.7h213.3c23.6 0 42.7 19.1 42.7 42.7S642.2 128 618.7 128zM405.3 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7S448 403 448 426.6v256c0 23.6-19.1 42.7-42.7 42.7zM618.7 725.3c-23.6 0-42.7-19.1-42.7-42.7v-256c0-23.6 19.1-42.7 42.7-42.7s42.7 19.1 42.7 42.7v256c-0.1 23.6-19.2 42.7-42.7 42.7z" fill="#5F6379"/></svg></button>
                                                        
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$user->name}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$user->idnum}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{-- {{$user->color_code}}<div class="w-full h-10 rounded bg-gray-50 ring-1 ring-inset ring-black ring-opacity-0"></div> --}}
                                                <div class="w-full h-8 rounded ring-1 ring-inset ring-black ring-opacity-0" style="background-color: {{ $user->color_code }}"></div>
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                {{$user->email}}
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($user->role == 0)
                                                    <p class=" text-yellow-400">Super Admin</p>
                                                @elseif($user->role == 1)
                                                    <p class="text-blue-500">Admin</p>
                                                @else
                                                    <p class="text-green-500">User</p>
                                                @endif 
                                            </td>
                                            <td class="px-6 py-2 text-center whitespace-nowrap">
                                                @if ($user->status == 0)
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
        {{-- HIDDEN BUTTONS --}}
            {{-- Edit User --}}
                <button type="button" id="btnEditUserH" class="btnEditUserH hidden" data-modal-target="modalUser" data-modal-toggle="modalUser"></button>
            {{-- Confirm Reset Modal --}}
                <button type="button" id="btnConfirmRH" class="btnConfirmRH hidden" data-modal-target="modalConfirmP" data-modal-toggle="modalConfirmP"></button>
            {{-- Confirm Delete Modal --}}
                <button type="button" id="btnConfirmDH" class="btnConfirmDH hidden" data-modal-target="modalConfirmD" data-modal-toggle="modalConfirmD"></button>
            {{-- Success Modal --}}
                <button type="button" id="btnSuccessH" class="btnSuccessH hidden" data-modal-target="modalSuccess" data-modal-toggle="modalSuccess"></button>
            {{-- Inc Modal --}}
                <button type="button" id="btnIncH" class="btnIncUserH hidden" data-modal-target="modalInc" data-modal-toggle="modalInc"></button>

        {{-- MODALS --}}
            {{-- USER MODAL --}}
                <div id="modalUser" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                <label id="titleUser" class="text-3xl font-extrabold text-gray-900">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ADD USER</span>
                                </label>
                                <button type="button" id="closeUser1" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modalUser">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6 w-full">
                                <form action="" id="formUser" name="formUser" class="w-full">
                                    @csrf
                                    <input type="hidden" id="userKey" name="userKey">
                                    <input type="hidden" id="userID" name="userID">
                                    <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                            <input type="text" id="fname" name="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                            <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                            <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1">
                                            <label for="usercolor" class="block mb-2 text-sm font-medium text-gray-900">User Color</label>
                                            <input type="color" id="usercolor" name="usercolor" class="border border-gray-300 rounded-lg h-10 w-full sm:w-1/2" required>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                            <div class="grid justify-items-start">
                                                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                    <option class="text-center" selected disabled value="">--Select Role--</option>
                                                    <option value="0">Super Admin</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">User</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                            <label for="" class="block mb-2 text-sm font-medium text-gray-900">Role Access</label>
                                            <div id="divAccess" class="grid grid-cols-2 disabled:opacity-50 disabled:pointer-events-none">
                                                <div class="">
                                                    <div class="flex items-center mb-1">
                                                        <input id="cbAC" name="uaccess[]" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <label for="cbAC" class="ms-2 text-sm text-gray-900 disabled:opacity-50 disabled:pointer-events-none">Activity Calendar</label>
                                                    </div>
                                                    <div class="flex items-center mb-1">
                                                        <input id="cbEA" name="uaccess[]" type="checkbox" value="2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <label for="cbEA" class="ms-2 text-sm text-gray-900 disabled:opacity-50 disabled:pointer-events-none">Evaluation Audit</label>
                                                    </div>
                                                    <div class="flex items-center mb-1">
                                                        <input id="cbIA" name="uaccess[]" type="checkbox" value="3" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <label for="cbIA" class="ms-2 text-sm text-gray-900 disabled:opacity-50 disabled:pointer-events-none">Internal Audit</label>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="flex items-center mb-1">
                                                        <input id="cbBA" name="uaccess[]" type="checkbox" value="4" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <label for="cbBA" class="ms-2 text-sm text-gray-900 disabled:opacity-50 disabled:pointer-events-none">Branch Audit</label>
                                                    </div>
                                                    <div class="flex items-center mb-1">
                                                        <input id="cbWH" name="uaccess[]" type="checkbox" value="5" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                                        <label for="cbWH" class="ms-2 text-sm text-gray-900 disabled:opacity-50 disabled:pointer-events-none">Warehouse</label>
                                                    </div>
                                                    <div class="flex items-center mb-1">
                                                        {{-- <input id="default-checkbox" name="uaccess[]" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                        <label for="default-checkbox" class="ms-2 text-sm text-gray-900">Default checkbox</label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                            <label for="utatus" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                            <div class="grid justify-items-start">
                                                <select id="ustatus" name="ustatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                    <option class="text-center" selected disabled value="">--Select Status--</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                                <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5" required>
                                            </div>
                                            <div class="hidden sm:block mb-3 col-span-1 w-full">
                                            </div> --}}

                                            {{-- <div class="mb-3 col-span-2 sm:col-span-1 w-full">
                                                <label for="usercolor" class="block mb-2 text-sm font-medium text-gray-900">User Color</label>
                                                <input type="color" id="usercolor" name="usercolor" class="border border-gray-300 rounded-lg h-10 w-full sm:w-1/2" required>
                                            </div>
                                            <div class="hidden sm:block mb-3 col-span-1 w-full">
                                            </div> --}}
                                            
                                            {{-- <div class="mb-3 col-span-1 w-full">
                                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                                <div class="grid justify-items-start">
                                                    <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block h-10 w-full p-2.5">
                                                        <option class="text-center" selected disabled value="">--Select Role--</option>
                                                        <option value="0">Super Admin</option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">User</option>
                                                    </select>
                                                </div>
                                        </div> --}}
                                    </div>
                                    <hr class=" w-36 h-1 mx-auto my-2 bg-gray-300 border-0 rounded md:my-7 sm:w-96">
                                    <div class="grid grid-flow-row-dense grid-cols-2 gap-x-5 w-full">
                                        <div class="mb-3 col-span-2 sm:col-span-2 w-full">
                                            <label for="expiration" class="block mb-2 text-sm font-medium text-gray-900">Expiration</label>
                                            <div class="flex gap-2 items-center sm:flex-row flex-col">
                                                <div class="px-3 h-[68px] w-full border rounded-lg flex gap-x-2 items-center sm:w-1/3">
                                                    <input id="radioNoExp" type="radio" value="0" name="radioExp" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" checked>
                                                    <label class="whitespace-nowrap block text-sm font-medium text-gray-900">No Expiration</label>
                                                </div>
                                                <div class="px-3 h-[68px] w-full border rounded-lg flex gap-x-2 items-center sm:w-1/3">
                                                    <input id="radioExpDay" type="radio" value="1" name="radioExp" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                    <input type="text" id="expiration-days" name="expiration-days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5 text-center disabled:opacity-50 disabled:pointer-events-none" required>
                                                    <label class="whitespace-nowrap block text-sm font-medium text-gray-900">Day/s</label>
                                                </div>
                                                <div class="px-3 h-[68px] w-full border rounded-lg flex gap-x-2 items-center sm:w-1/3">
                                                    <input id="radioExpDate" type="radio" value="2" name="radioExp" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                    <input type="date" id="expirationdate" name="expirationdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full sm:w-1/2 p-2.5 disabled:opacity-50 disabled:pointer-events-none" placeholder="mm/dd/yyyy" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="button" id="btnSaveUser" name="btnSaveUser" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">UPDATE</button>
                                <button data-modal-hide="modalUser" type="button" id="closeUser2" class="text-white bg-gray-500 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- CONFIRM RESET PASSWORD MODAL --}}
                <div id="modalConfirmP" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                        <div class="flex justify-center">
                            <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Password Reset</h3>
                            <h3 id="nameP" class="text-sm"></h3>
                        </div>
                        <div class="flex mt-5 sm:mt-6 justify-center">
                            <button type="button" id="deleteConfirmP"  data-modal-hide="modalConfirmP" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure.
                            </button>
                            <button data-modal-hide="modalConfirmP" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
                        </div>
                    </div>
                </div>
            {{-- CONFIRMATION DELETE MODAL --}}
                <div id="modalConfirmD" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                    <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
                        <div class="flex justify-center">
                            <svg viewBox="0 0 24 24" class="h-12 w-12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>information_fill</title> <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="System" transform="translate(-672.000000, -48.000000)" fill-rule="nonzero"> <g id="information_fill" transform="translate(672.000000, 48.000000)"> <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero"> </path> <path d="M12,2 C17.5228,2 22,6.47715 22,12 C22,17.5228 17.5228,22 12,22 C6.47715,22 2,17.5228 2,12 C2,6.47715 6.47715,2 12,2 Z M11.99,10 L11,10 C10.4477,10 10,10.4477 10,11 C10,11.51285 10.386027,11.9355092 10.8833761,11.9932725 L11,12 L11,16.99 C11,17.5106133 11.3938293,17.9392373 11.8999333,17.9940734 L12.01,18 L12.5,18 C13.0523,18 13.5,17.5523 13.5,17 C13.5,16.6710222 13.3411062,16.3791012 13.0958694,16.1968582 L13,16.1338 L13,11.01 C13,10.4893867 12.6060836,10.0607627 12.1000493,10.0059266 L11.99,10 Z M12,7 C11.4477,7 11,7.44772 11,8 C11,8.55228 11.4477,9 12,9 C12.5523,9 13,8.55228 13,8 C13,7.44772 12.5523,7 12,7 Z" id="形状" fill="#1A56DB"> </path> </g> </g> </g> </g></svg>
                        </div>
                        <div class="mt-4 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Password Reset</h3>
                            <h3 id="nameD" class="text-sm"></h3>
                        </div>
                        <div class="flex mt-5 sm:mt-6 justify-center">
                            <button type="button" id="deleteConfirmD"  data-modal-hide="modalConfirmD" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure.
                            </button>
                            <button data-modal-hide="modalConfirmD" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ml-2">No, cancel.</button>
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
    </div>
    <script>
        $(document).ready(function () {
            var todayDate = new Date();
            var formattedDateNow = ((todayDate.getMonth() + 1) < 10 ? '0' : '') + (todayDate.getMonth() + 1) + '/' + (todayDate.getDate() < 10 ? '0' : '') + todayDate.getDate() + '/' + todayDate.getFullYear();
            var currentDateFormatted = new Date(todayDate.getFullYear(), todayDate.getMonth(), todayDate.getDate());
            
            var divToDisable = document.getElementById("divAccess");
            divToDisable.setAttribute("disabled", true);
            
            var inputs = divToDisable.getElementsByTagName("input");
            for (var i = 0; i < inputs.length; i++) {
                $(inputs[i]).prop('disabled', true);
            }

            var labels = divToDisable.getElementsByTagName("label");
            for (var i = 0; i < labels.length; i++) {
                labels[i].style.pointerEvents = "none";
                    if (labels[i].style.pointerEvents === "none") {
                        labels[i].style.opacity = "0.5";
                    }else{
                        labels[i].style.opacity = "1";
                    }
            }

            $('#expiration-days, #expirationdate').prop('disabled', true);

            // Radio Function - Edit User
                $('#radioNoExp').change(function () {
                    $('#expiration-days, #expirationdate').prop('disabled', true);
                    $('#expiration-days').val('');
                    $('#expirationdate').val('');
                });

                $('#radioExpDay').change(function () {
                    $('#expiration-days').prop('disabled', false);
                    $('#expirationdate').prop('disabled', true);
                });

                $('#radioExpDate').change(function () {
                    $('#expiration-days').prop('disabled', true);
                    $('#expirationdate').prop('disabled', false);
                });

            // Validate input to allow only numeric values for #expiration-days
                $('#expiration-days').on('input', function () {
                    $(this).val(function (index, value) {
                        return value.replace(/\D/g, '');
                    });
                });

            // On Change of Role
                $('#role').change(function () {
                    if($('#role').val() == 2){
                        var divToDisable = document.getElementById("divAccess");
                        divToDisable.setAttribute("disabled", false);
                        
                        var inputs = divToDisable.getElementsByTagName("input");
                        for (var i = 0; i < inputs.length; i++) {
                            $(inputs[i]).prop('disabled', false);
                        }

                        var labels = divToDisable.getElementsByTagName("label");
                        for (var i = 0; i < labels.length; i++) {
                            labels[i].style.pointerEvents = "";
                            if (labels[i].style.pointerEvents === "none") {
                                labels[i].style.opacity = "0.5";
                            }else{
                                labels[i].style.opacity = "1";
                            }
                        }
                    }else{
                        var divToDisable = document.getElementById("divAccess");
                        divToDisable.setAttribute("disabled", true);
                        
                        var inputs = divToDisable.getElementsByTagName("input");
                        for (var i = 0; i < inputs.length; i++) {
                            inputs[i].disabled = true;
                            inputs[i].checked = false;
                        }

                        var labels = divToDisable.getElementsByTagName("label");
                        for (var i = 0; i < labels.length; i++) {
                            labels[i].style.pointerEvents = "none";
                            if (labels[i].style.pointerEvents === "none") {
                                labels[i].style.opacity = "0.5";
                            }else{
                                labels[i].style.opacity = "1";
                            }
                        }
                    }
                });

            // On Change of Status
                $('#ustatus').change(function () {
                    if($('#ustatus').val() == 0){
                        $('#radioNoExp').prop('checked', false);
                        $('#radioExpDay').prop('checked', false);
                        $('#radioExpDate').prop('checked', false);
                        $('input[name="radioExp"]').prop('disabled', true);
                        $('#expiration-days').prop('disabled', true);
                        $('#expirationdate').prop('disabled', true);
                    }else{
                        $('#radioNoExp').prop('checked', true);
                        $('input[name="radioExp"]').prop('disabled', false);
                    }
                });

            // On Change of Days
                $('#expiration-days').keyup(function(){
                    if($('#expiration-days').val() == 0 || $('#expiration-days').val() == "" ){
                        $('#expirationdate').val('');
                    }else{
                        var expirationDays = parseInt($('#expiration-days').val());
                        var expirationDate = new Date(todayDate.getTime() + expirationDays * 24 * 60 * 60 * 1000); // Adding expirationDays to today's date
                        
                        // Formatting expirationDate to YYYY-MM-DD format
                        var formattedExpirationDate = expirationDate.toISOString().split('T')[0];
                        
                        $('#expirationdate').val(formattedExpirationDate);
                    }
                });

            // On Change of Date
                $('#expirationdate').change(function(){
                    var expirationDateValue = $('#expirationdate').val();

                    if($('#expirationdate').val() == "" ){
                        $('#expiration-days').val('');
                    }else{
                        var expDate = new Date(expirationDateValue);
                        var formattedExpDate = expDate.getFullYear() + '-' + ((expDate.getMonth() + 1) < 10 ? '0' : '') + (expDate.getMonth() + 1) + '-' + (expDate.getDate() < 10 ? '0' : '') + expDate.getDate();
                        var expDateFormatted = new Date(expDate.getFullYear(), expDate.getMonth(), expDate.getDate());

                        var differenceDate = expDateFormatted - currentDateFormatted;
                        var differenceDays = Math.floor(differenceDate / (1000 * 60 * 60 * 24));

                        $('#expiration-days').val(differenceDays);
                    }
                });

            // Add User
                jQuery(document).on( "click", "#btnAddUser", function(){
                    $('#formUser').trigger('reset');

                    var randomColor = '#' + Math.floor(Math.random()*16777215).toString(16);
                    $('#usercolor').val(randomColor);

                    var newHeading = "ADD USER";
                    document.getElementById("titleUser").querySelector("span").textContent = newHeading;

                    $('#btnSaveUser').text('ADD');

                    // $('input[type!="radio"], select').each(function() {
                    //     $(this).addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                    //     $(this).removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                    // });
                    $('input:not([type="radio"]), select').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500")
                        .removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");

                    $('#userKey').val('');
                    $('#userID').val('');

                    var divToDisable = document.getElementById("divAccess");
                    divToDisable.setAttribute("disabled", true);
                    
                    var inputs = divToDisable.getElementsByTagName("input");
                    for (var i = 0; i < inputs.length; i++) {
                        $(inputs[i]).prop('disabled', true);
                        inputs[i].checked = false;
                    }

                    var labels = divToDisable.getElementsByTagName("label");
                    for (var i = 0; i < labels.length; i++) {
                        labels[i].style.pointerEvents = "none";
                        if (labels[i].style.pointerEvents === "none") {
                            labels[i].style.opacity = "0.5";
                        }else{
                            labels[i].style.opacity = "1";
                        }
                    }
                });

            // View/Edit User
                jQuery(document).on( "click", "#btnEditUser", function(){
                    // $("#POUnit li:first-child button").click();
                    var keyUser = $(this).data('key');
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-users.getUserData') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyUser: keyUser, _token: _token,},
                        success:function(result){
                            $("#btnEditUserH").click();
                            var newHeading = "EDIT USER";
                            document.getElementById("titleUser").querySelector("span").textContent = newHeading;

                            $('#userKey').val(result.uKey);
                            $('#userID').val(result.uID);
                            $('#fname').val(result.fullname);
                            $('#email').val(result.email);
                            $('#username').val(result.username);
                            $('#role').val(result.role);
                                var uaccessValues = result.uaccess;
                                $('input[name="uaccess[]"]').each(function() {
                                    if (uaccessValues.includes($(this).val())) {
                                        $(this).prop('checked', true);
                                    } else {
                                        $(this).prop('checked', false);
                                    }
                                });

                                if(result.status == 1 || result.status == -1){
                                    xstatus = 1;
                                }else{
                                    xstatus = 0;
                                }
                            $('#ustatus').val(xstatus);

                            if(result.status == 0){
                                $('#radioNoExp').prop('checked', false);
                                $('#radioExpDay').prop('checked', false);
                                $('#radioExpDate').prop('checked', false);
                                $('input[name="radioExp"]').prop('disabled', true);
                                $('#expiration-days').prop('disabled', true);
                                $('#expirationdate').prop('disabled', true);
                                $('#expiration-days').val('');
                                $('#expirationdate').val('');

                                $('#expiration-days').val('');
                            }else if(result.status == 1){
                                $('#radioExpDate').prop('checked', true);
                                $('input[name="radioExp"]').prop('disabled', false);
                                $('#expirationdate').prop('disabled', false);
                                
                                var expDate = new Date(result.expdate);

                                var formattedDate = expDate.getFullYear() + '-' + ((expDate.getMonth() + 1) < 10 ? '0' : '') + (expDate.getMonth() + 1) + '-' + (expDate.getDate() < 10 ? '0' : '') + expDate.getDate();

                                var expDateFormatted = new Date(expDate.getFullYear(), expDate.getMonth(), expDate.getDate());
                                
                                var differenceMs = expDateFormatted - currentDateFormatted;

                                // Convert milliseconds to days
                                var differenceDays = Math.floor(differenceMs / (1000 * 60 * 60 * 24));

                                $('#expirationdate').val(formattedDate);
                                $('#expiration-days').val(differenceDays);
                            }else{
                                $('#radioNoExp').prop('checked', true);
                                $('input[name="radioExp"]').prop('disabled', false);
                                
                                $('#expiration-days').val('');
                                $('#expirationdate').val('');
                            }

                            $('#usercolor').val(result.color_code);

                            $('#btnSaveUser').text('UPDATE');

                            $('input[type!="radio"], select').each(function() {
                                $(this).addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $(this).removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            });
                            
                            if($('#role').val() == 2){
                                var divToDisable = document.getElementById("divAccess");
                                divToDisable.setAttribute("disabled", false);
                                
                                var inputs = divToDisable.getElementsByTagName("input");
                                for (var i = 0; i < inputs.length; i++) {
                                    inputs[i].disabled = false;
                                }

                                var labels = divToDisable.getElementsByTagName("label");
                                for (var i = 0; i < labels.length; i++) {
                                    labels[i].style.pointerEvents = "none";
                                }
                            }else{
                                var divToDisable = document.getElementById("divAccess");
                                divToDisable.setAttribute("disabled", true);
                                
                                var inputs = divToDisable.getElementsByTagName("input");
                                for (var i = 0; i < inputs.length; i++) {
                                    inputs[i].disabled = true;
                                    inputs[i].checked = false;
                                }

                                var labels = divToDisable.getElementsByTagName("label");
                                for (var i = 0; i < labels.length; i++) {
                                    labels[i].style.pointerEvents = "none";
                                }
                            }
                        }
                    });
                });

            // Save Add/Edit User
                jQuery(document).on( "click", "#btnSaveUser", function(){
                    if($('#fname').val() == "" || $('#email').val() == "" || $('#username').val() == "" || $('#role').val() == null || $('#ustatus').val() == null){
                        $("#btnIncH").click();

                        $('input[type!="radio"], select').each(function() {
                            // If the element is empty or null
                            if ($(this).val() == "" || $(this).val() == null) {
                                $(this).removeClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $(this).addClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            }else{
                                $(this).addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $(this).removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            }
                        });
                        
                        if ($('#radioExpDay').prop('checked')) {
                            // If "radioExpDay" is checked, validate "expiration-days"
                            if ($('#expiration-days').val() == "" || parseInt($('#expiration-days').val()) <= 0) {
                                $('#expiration-days').removeClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expiration-days').addClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            } else {
                                $('#expiration-days').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expiration-days').removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            }
                                $('#expirationdate').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expirationdate').removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                        } else if ($('#radioExpDate').prop('checked')) {
                            // If "radioExpDate" is checked, validate "expirationdate"
                            if ($('#expirationdate').val() == "") {
                                $('#expirationdate').removeClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expirationdate').addClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            } else {
                                $('#expirationdate').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expirationdate').removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                            }
                                $('#expiration-days').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expiration-days').removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                        } else {
                                $('#expirationdate').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expirationdate').removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");
                                $('#expiration-days').addClass("bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500");
                                $('#expiration-days').removeClass("bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500");

                        }
                    }else{
                        $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-users.saveUserData') }}",
                        method:"POST",
                        dataType: 'json',
                        data: $("#formUser").serialize(),
                        success:function(result){
                            $('#tableUser').load(location.href + ' #tableUser>*','')
                            $("#btnSuccessH").click();
                            $("#closeUser1").click();
                        },
                        error: function(error){
                            $("#btnIncH").click();
                        }

                    });
                    }
                });

            // Confirm Reset Password
                jQuery(document).on( "click", "#btnResetPUser", function(){
                    var keyUser = $(this).data('key');
                    var _token = $('input[name="_token"]').val();
                    
                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-users.getNameUser') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyUser: keyUser, _token: _token,},
                        success:function(result){
                            $("#btnConfirmRH").click();
                            $('#deleteConfirmP').data('key', keyUser);

                            $('#nameP').html('Are you sure you want to reset the password for user <span class="text-blue-700">' + result.fullname + '</span>?');
                        },
                    });
                });

                jQuery(document).on( "click", "#deleteConfirmP", function(){
                    var keyUser = $(this).data('key');
                    var _token = $('input[name="_token"]').val();
                    
                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-users.resetPasswordUser') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyUser: keyUser, _token: _token,},
                        success:function(result){
                            $('#tableUser').load(location.href + ' #tableUser>*','')
                            $("#btnSuccessH").click();
                        },
                    });
                });

            // Confirm Delete User
                jQuery(document).on( "click", "#btnDeleteUser", function(){
                    var keyUser = $(this).data('key');
                    var _token = $('input[name="_token"]').val();
                    
                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-users.getNameUser') }}",
                        method:"GET",
                        dataType: 'json',
                        data:{keyUser: keyUser, _token: _token,},
                        success:function(result){
                            $("#btnConfirmDH").click();
                            $('#deleteConfirmD').data('key', keyUser);

                            $('#nameD').html('Are you sure you want to delete user <span class="text-blue-700">' + result.fullname + '</span>?');
                        },
                    });
                });

                jQuery(document).on( "click", "#deleteConfirmD", function(){
                    var keyUser = $(this).data('key');
                    var _token = $('input[name="_token"]').val();
                    
                    $.ajax({
                        url:"{{ route('bpa-systemconfig.sc-users.deleteUser') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{keyUser: keyUser, _token: _token,},
                        success:function(result){
                            $('#tableUser').load(location.href + ' #tableUser>*','')
                            $("#btnSuccessH").click();
                        },
                    });
                });

        });
    </script>
</x-app-layout>
