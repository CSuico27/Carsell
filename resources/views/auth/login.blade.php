<x-guest-layout title="Login" PageName="Login Page">

    @if ($message = Session::get('status'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show"
            x-transition.opacity
            class="fixed top-4 right-12 z-50"
        >
            <div class="max-w-sm w-[280px] bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Success icon only -->
                            <svg 
                                class="h-6 w-6 text-green-500" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">
                                Success
                            </p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $message }}
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 8.586L4.707 3.293A1 1 0 103.293 4.707L8.586 10l-5.293 5.293a1 1 0 101.414 1.414L10 11.414l5.293 5.293a1 1 0 001.414-1.414L11.414 10l5.293-5.293a1 1 0 00-1.414-1.414L10 8.586z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{route('login')}}" method="POST">
        @csrf
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input type="text" id="email" name="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('email') ring-red-400 @enderror" value="{{old('email')}}">
            @error('email')
                <span class="text-xs text-[#e1402e]">{{$message}}</span>
            @enderror
        </div>
        <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('password') ring-red-400 @enderror">
            <span id="togglePassword" class="absolute" style="right: 10px; top: 32px; cursor: pointer;">
                <i class="fas fa-eye" id="toggleIcon"></i>
            </span>
            @error('password')
                <span class="text-xs text-[#e1402e]">{{$message}}</span>
            @enderror
        </div>

        <div class="flex justify-between">
            <div>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>
            <div class="">
                <a class="text-[#e1402e] text-right" href="{{route('password.request')}}">Reset Password</a>
            </div>
        </div>
        @error('error')
            <span class="text-xs text-[#e1402e]">{{$message}}</span>
        @enderror
        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-[#e1402e] text-white font-semibold py-2 px-4 mt-3 rounded-md hover:bg-orange-600 transition duration-150">
            Login
        </button>

        <div class="flex items-center my-6">
            <hr class="flex-grow border-gray-300">
            <p class="text-sm text-center text-gray-500 mx-4 whitespace-nowrap">Social Signup</p>
            <hr class="flex-grow border-gray-300">
        </div>

        <div class="flex justify-center gap-4 mb-4">
            <x-google/>
            <x-facebook/>
        </div>
    </form>

    <x-slot:footerLink>
        <div class="mt-4 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#e1402e] hover:underline">Sign up here</a>
        </div>
    </x-slot:footerLink>


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
    </script>
</x-guest-layout>