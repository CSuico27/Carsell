<x-backend-layout title="Edit Profile">
    <section class="py-12 px-6 md:px-24">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Your Profile</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and view your account details</p>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="bg-white shadow-lg rounded-2xl p-8 border-t-4 border-orange-500">
                <div class="flex flex-col md:flex-row gap-6 items-center md:items-start">
                    <form action="{{ route('profile.update', $userInfo->id) }}" method="post" class="space-y-6 w-full" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col gap-4">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $userInfo->name) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('email') ring-red-400 @enderror">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" name="email" id="email"
                                    value="{{ old('email', $userInfo->email) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('email') ring-red-400 @enderror">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ old('phone', $userInfo->phone) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('phone') ring-red-400 @enderror">
                            </div>

                            <!-- Password -->
                            <div class="relative">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" id="password" name="password" value="{{old('password', $userInfo->password)}}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('password') ring-red-400 @enderror">
                                <span id="togglePassword" class="absolute" style="right: 10px; top: 32px; cursor: pointer;">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </span>
                                @error('password')
                                    <span class="text-xs text-red-400">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="relative">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('password_confirmation') ring-red-400 @enderror">

                                <span id="toggleConfirmPassword" class="absolute" style="right: 10px; top: 32px; cursor: pointer;">
                                    <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                                </span>
                            </div>
                        </div>
                </div>

                <div class="my-4">
                    <h3 class="text-lg font-medium text-gray-900">Car Images</h3>
                    <p class="mt-1 text-sm text-gray-500">Upload one or more images of your vehicle (PNG, JPG, JPEG)</p>
                    
                    <div class="mt-3">
                        <label for="carFormImageUpload" class="block w-full cursor-pointer">
                            <div class="mt-2 flex flex-col justify-center items-center px-6 py-4 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition duration-150 group">
                                <div class="flex flex-col items-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                        stroke="currentColor" class="w-10 h-10 text-gray-400 group-hover:text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    <div class="text-center">
                                        <span class="font-medium text-blue-600 hover:text-blue-700">Click to upload</span>
                                        <span class="text-gray-500"> or drag and drop</span>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        Select multiple images if needed
                                    </p>
                                </div>
                            </div>
                        </label>
                        <input 
                            id="carFormImageUpload" 
                            type="file" 
                            name="image" 
                            multiple 
                            accept="image/png,image/jpeg,image/jpg"
                            class="hidden" 
                            @error('image') aria-invalid="true" @enderror
                        />
                    </div>

                    {{-- Preview Area (initially hidden, shown with JS) --}}
                    <div id="imagePreviewArea" class="mt-4 hidden">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Images</h4>
                        <div id="imagePreviewGrid" class="grid grid-cols-3 gap-3"></div>
                    </div>

                    {{-- Error Messages --}}
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold shadow">
                        Save Changes
                    </button>
                </div>
                </form>

            </div>
        </div>

        </div>
    </section>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye / eye slash icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password_confirmation');
            const toggleIcon = document.getElementById('toggleConfirmIcon');

            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye / eye slash icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</x-backend-layout>
