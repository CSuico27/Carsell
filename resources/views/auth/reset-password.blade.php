<x-guest-layout title="Reset Password" PageName="Reset your password">
    <form action="{{route('password.update')}}" method="POST">
        @csrf
        
        {{-- hidden token --}}
        <input type="hidden" name="token" value="{{$token}}">
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
            <input type="text" id="email" name="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 @error('email') ring-red-400 @enderror" value="{{old('email')}}">
            @error('email')
                <span class="text-xs text-red-400">{{$message}}</span>
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
                <span class="text-xs text-red-400">{{$message}}</span>
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

        @error('error')
            <span class="text-xs text-red-400">{{$message}}</span>
        @enderror
        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-orange-500 text-white font-semibold py-2 px-4 mt-3 rounded-md hover:bg-orange-600 transition duration-150">
            Reset Password
        </button>
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