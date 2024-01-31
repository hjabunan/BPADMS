<x-app-layout>

    <div style="height: calc(100vh - 70px);" class="py-5 overflow-x-auto">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    {{-- Title --}}
                    <div class="px-4 grid gap-x-3 mb-5 border-b">
                        <div class="self-center font-black text-2xl text-red-500 leading-tight">
                            Change Password
                        </div>
                    </div>
                    {{-- Body --}}
                    <div class="">
                        <form action="" method="POST" class="px-10 sm:px-20"> 
                            <input type="hidden" name="UserUUID" id="UserUUID" value="{{ $key }}">
                            <div class="grid gap-2 sm:gap-6 mb-2 md:grid-cols-1">
                                <div class="mb-4 sm:mb-2">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.992 12.361a16.892 16.892 0 01-2.767 3.713C16.814 17.984 14.486 20 12 20c-2.486 0-4.814-2.016-6.225-3.926a16.893 16.893 0 01-2.767-3.713C7.185 6.016 9.514 4 12 4c2.486 0 4.814 2.016 6.225 3.926z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                                <div class="mb-4 sm:mb-2">
                                    <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                                    <div class="relative">
                                        <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" id="toggleCPassword" class="text-gray-400 hover:text-gray-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.992 12.361a16.892 16.892 0 01-2.767 3.713C16.814 17.984 14.486 20 12 20c-2.486 0-4.814-2.016-6.225-3.926a16.893 16.893 0 01-2.767-3.713C7.185 6.016 9.514 4 12 4c2.486 0 4.814 2.016 6.225 3.926z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="mb-2 sm:mb-2">
                                <button type="button" name="updatePassword" id="updatePassword" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 w-50">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="btnSuccessH" class="btnSuccessH hidden" data-modal-target="success-modal" data-modal-toggle="success-modal"></button>
    </div>
    <div id="success-modal" class="fixed items-center top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="bg-green-200 rounded-lg shadow-xl border border-gray-200 w-80 mx-auto p-4">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-12 w-12">
                    <circle cx="12" cy="12" r="11" fill="#4CAF50"/>
                    <path fill="#FFFFFF" d="M9.25 15.25L5.75 11.75L4.75 12.75L9.25 17.25L19.25 7.25L18.25 6.25L9.25 15.25Z"/>
                    </svg>
            </div>
            <div class="mt-4 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Success!</h3>
                <p class="text-sm text-gray-500">Your changes have been saved.</p>
            </div>
            <div class="mt-5 sm:mt-6">
                <button id="SCloseButton" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm" data-modal-hide="success-modal">Close</button>
            </div>
        </div>
    </div>

    <script>
        // View Password
            document.getElementById("togglePassword").addEventListener("click", function () {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });

        // View Confirm Password
            document.getElementById("toggleCPassword").addEventListener("click", function () {
                var passwordcInput = document.getElementById("confirm_password");
                if (passwordcInput.type === "password") {
                    passwordcInput.type = "text";
                } else {
                    passwordcInput.type = "password";
                }
            });

        $(document).ready(function () {
            // UPDATE PASSWORD
            $('#updatePassword').click(function(){
                // Get the value of the new password input
                var userKey = $('#UserUUID').val();
                var newPassword = $('#password').val();
                var newCPassword = $('#confirm_password').val();
                var _token = $('input[name="_token"]').val();

                // Perform a simple password validation
                if (newPassword.length >= 8 && newCPassword.length >= 8) {
                    if (newPassword === newCPassword) {
                        
                        // alert(userKey);
                            $.ajax({
                                url: "{{ route('change-password.updatePassword') }}",
                                type: "POST",
                                data: {userKey: userKey, newPassword: newPassword ,_token: _token},
                                success: function (response) {
                                    $('#btnSuccessH').click();
                                    setTimeout(function () {
                                        window.location.href = "{{ route('dashboard') }}";
                                    }, 5000);
                                }
                            });
                    } else {
                        alert('Passwords do not match. Please make sure they match.');
                    }
                } else {
                    alert('Password must be at least 8 characters long.');
                }
            });
            
        });
    </script>
</x-app-layout>
