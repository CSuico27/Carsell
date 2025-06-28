@props(['PageName' => '', 'title' => ''])
<x-base-layout :$title :$PageName>
    <main>
        <div class="bg-gray-100 min-h-screen flex items-center py-8 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 md:px-8 w-full flex flex-col lg:flex-row items-center gap-8 lg:gap-10">
                <!-- Left: Form -->
                <div class="w-full sm:w-4/5 md:w-3/4 lg:w-2/5 bg-white px-4 sm:px-6 md:px-8 py-6 rounded-lg shadow-md mx-auto lg:mx-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">{{$PageName}}</h2>

                    {{ $slot }}

                    <!-- Signup Link -->
                    {{ $footerLink ?? '' }}
                </div>
                <div class="w-full lg:w-3/5 lg:flex hidden justify-end items-center min-h-[400px]">
                    <img src="{{ asset('assets/cars/home-car.png') }}" alt="Hero Image" width="600" height="400" class="w-full h-auto object-contain" loading="lazy">
                </div>
            </div>
        </div>
    </main>
</x-base-layout>