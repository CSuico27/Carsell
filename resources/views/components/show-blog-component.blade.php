@props(['title', 'user_name', 'time'])

<div class="show-review-card p-4 sm:p-6 md:p-8 bg-white rounded-lg shadow-md space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h3 class="text-lg sm:text-xl text-gray-700 font-semibold antialiased">{{ $title }}</h3>
        <img class="w-6 h-6 sm:w-8 sm:h-8" src="{{ asset('assets/icons/double.svg') }}" alt="Icon">
    </div>

    <!-- Quote/Excerpt -->
    <p class="py-4 sm:py-6 text-sm sm:text-base font-mono text-justify break-words whitespace-pre-line line-clamp-3 mb-4">
        “{{ $slot }}”
    </p>

    <!-- Author Info -->
    <div class="flex items-center gap-3">
        <span class="flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 bg-gray-600 rounded-full text-white text-sm sm:text-base">
            <i class="fa-solid fa-user"></i>
        </span>
        <div>
            <h3 class="font-semibold text-sm sm:text-base antialiased">{{ $user_name }}</h3>
            <span class="text-xs sm:text-sm text-gray-500">{{ $time }}</span>
        </div>
    </div>
</div>
