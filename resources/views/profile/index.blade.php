<x-backend-layout title="Profile">
    @if ($message = Session::get('success') ?? Session::get('error'))
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
                            <svg 
                                class="h-6 w-6 {{ Session::get('success') ? 'text-green-500' : 'text-red-500' }}" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor">
                                @if(Session::get('success'))
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                @endif
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">
                                {{ Session::get('success') ? 'Success' : 'Error' }}
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
    <section class="py-12 px-6 md:px-24">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Your Profile</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and view your account details</p>
                </div>
                <a href="{{route('profile.edit', $userInfo->id)}}" class="mt-4 md:mt-0 inline-flex items-center gap-2 bg-orange-500 text-white px-5 py-2.5 rounded-xl hover:bg-orange-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Edit Profile
                </a>
            </div>

            <!-- Profile Card -->
            <div class="bg-white shadow-lg rounded-2xl p-8 border-t-4 border-orange-500">
                <div class="flex flex-col md:flex-row gap-6 items-center md:items-start">
                    <!-- Avatar -->
                    <div class="w-32 h-32 shrink-0 rounded-full border-4 border-orange-400 shadow-md overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('storage/profile_images/' . $userInfo->profile_pic) }}" 
                             alt="User Avatar" 
                             class="w-full h-full object-cover">
                    </div>                    

                    <!-- Details -->
                    <div class="flex-1 w-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500">Full Name</p>
                                <h2 class="text-lg font-semibold text-gray-800">{{$userInfo->name}}</h2>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <h2 class="text-lg font-semibold text-gray-800">{{$userInfo->email}}</h2>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Phone</p>
                                <h2 class="text-lg font-semibold text-gray-800">{{$userInfo->phone}}</h2>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Number of Cars</p>
                                <a href="{{route('car.index')}}" class="text-lg font-semibold text-gray-800 hover:text-orange-500 duration-150 transition">{{$userInfo->cars->count()}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-backend-layout>
