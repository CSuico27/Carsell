<x-backend-layout title="Verify Email" PageName="Login Page">
    <div class="max-w-md mx-auto mt-12 bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Verify Your Email</h2>
        <p class="text-gray-600 mb-6">
            A verification link has been sent to your email. Please check your inbox and click the link to complete your registration.
        </p>

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf

            <button type="submit"
                class="w-full bg-orange-500 text-white font-semibold py-3 rounded-lg hover:bg-orange-600 transition duration-200">
                Resend Verification Email
            </button>
        </form>
    </div>
</x-backend-layout>
