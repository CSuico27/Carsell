<x-backend-layout title="My Blog">
    <main>
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
        <section class="flex justify-center">
            <div class="bg-white rounded-lg shadow-lg px-8 py-4 mx-24 my-12 w-5/6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl text-gray-600 font-semibold mb-4">My Blog</h2>
                    <a href="{{route('blogs.create')}}" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition duration-150 cursor-pointer">Create New Blog</a>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($blogs as $blog)
                        @php
                            $truncated = Str::limit($blog->description, 100);
                        @endphp

                        <x-blog-component :blog="$blog">
                            <x-slot:title>{{$blog->title}}</x-slot:title>
                            {{$truncated}}
                            <x-slot:user_name>{{$blog->user->name}}</x-slot:user_name>
                            <x-slot:time>{{$blog->updated_at->diffForHumans()}}</x-slot:time>
                        </x-blog-component>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</x-backend-layout>
