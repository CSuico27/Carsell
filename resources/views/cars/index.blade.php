<x-backend-layout title="My Cars">
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
        <section class="bg-white shadow-lg rounded-b-lg mx-4 md:mx-16 lg:mx-60 px-4 md:px-6 py-6">
            <h1 class="text-2xl font-medium text-gray-500 mb-4">My Cars</h1>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cars->isEmpty())
                        <tr>
                            <td colspan="5" class="py-4">
                                You don't have any cars yet. <a class="text-orange-400 ms-2" href="{{route('car.create')}}">Add new Car</a>
                            </td>
                        </tr>
                    @else
                        @foreach ($cars as $car)
                            <tr>
                                <td class="text-center">
                                    @if($car->primaryImage)
                                        <img class="w-25 rounded inline-block" src="{{ asset('storage/car_images/' . $car->primaryImage->image_path) }}" alt="Car Image">
                                    @else
                                        Null
                                    @endif
                                </td>                                
                                <td>{{$car->year}} - {{$car->makers->name}} - {{$car->models->name}}</td>
                                <td>{{$car->created_at->format('m-d-Y')}}</td>
                                <td>{{$car->published_at ? 'Yes' : 'No'}}</td>
                                <td>
                                    <div class="flex gap-4 justify-center">
                                        <a class="text-blue-400 ms-2 text-sm font-medium" href="{{route('car.edit', $car->id)}}"><i class="fa-solid fa-pen-nib"></i> Edit</a>

                                        <button onclick="showModal({{$car->id}})" class="text-red-400 ms-2 text-sm font-medium cursor-pointer">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>

                                        {{-- Modal for Car deletion --}}
                                        <div id="modal" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            <div id="modal-backdrop" class="fixed inset-0 bg-gray-500/75 opacity-0 transition-opacity duration-300" aria-hidden="true"></div>
                                            
                                            <div id="modal-wrapper" class="fixed inset-0 z-10 w-screen overflow-y-auto opacity-0 scale-95 transition duration-300 ease-out">
                                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                                        <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Delete Car</h3>
                                                        <div class="mt-2">
                                                        <p class="text-sm text-gray-500">Are you sure you want to delete this car? All of your data will be permanently removed. This action cannot be undone.</p>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                    <form id="deleteForm" action="" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto cursor-pointer">Yes, Delete</button>
                                                    </form>
                                                    <button onclick="hideModal()" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto cursor-pointer">Cancel</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>      
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">
                                {{$cars->onEachSide(1)->links()}}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>            
        </section>
    </main>
    
    <script>
       function showModal(carID) {
            const modal = document.getElementById('modal');
            const backdrop = document.getElementById('modal-backdrop');
            const wrapper = document.getElementById('modal-wrapper');
            const form = document.getElementById('deleteForm');

            form.action = `/car/${carID}`;
            modal.classList.remove('hidden');

            // Animate in
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                wrapper.classList.remove('opacity-0', 'scale-95');
            }, 10);
        }

        function hideModal() {
            const modal = document.getElementById('modal');
            const backdrop = document.getElementById('modal-backdrop');
            const wrapper = document.getElementById('modal-wrapper');

            // Animate out
            backdrop.classList.add('opacity-0');
            wrapper.classList.add('opacity-0', 'scale-95');

            // Hide after animation
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
    
</x-backend-layout>
