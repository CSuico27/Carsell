<x-guest-layout title="Register" PageName="Register Page">
    <form action="{{route('register')}}" method="POST">
        @csrf
        <!-- Name fields -->
        <div class="mb-4 ">
            <div class="w-full">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" id="name" name="name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200
                    @error('name') ring-red-400 @enderror" value="{{old('name')}}">
                @error('name')
                    <span class="text-xs text-[#e1402e]">{{$message}}</span>
                @enderror
            </div>
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input type="text" id="email" name="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('email') ring-red-400 @enderror" value="{{old('email')}}">
            @error('email')
                <span class="text-xs text-[#e1402e]">{{$message}}</span>
            @enderror
        </div>
        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" id="phone" name="phone"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('phone') ring-red-400 @enderror" value="{{ old('phone')}}">
            @error('phone')
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
        <!-- Confirm Password -->
        <div class="mb-6 relative">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('password_confirmation') ring-red-400 --@enderror">

            <span id="toggleConfirmPassword" class="absolute" style="right: 10px; top: 32px; cursor: pointer;">
                <i class="fas fa-eye" id="toggleConfirmIcon"></i>
            </span>
        </div>
        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-[#e1402e] text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition duration-150">
            Register
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

        <!-- Login Link -->
        <x-slot:footerLink>
            <div class="mt-4 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#e1402e] hover:underline">Login here</a>
            </div>
        </x-slot:footerLink>
    </form>

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
</x-guest-layout>