<x-backend-layout title="My Blog">
    <main>
        <section>
            <div class="bg-white rounded-lg shadow-lg px-8 py-4 mx-32 my-12 w-4/5">
                <h2 class="text-xl text-gray-600 font-semibold mb-4">Create your own blog here</h2>
                <form action="{{route('blogs.store')}}" method="post">
                    @csrf

                    <div class="mb-4 ">
                        <div class="w-full">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" id="title" name="title" placeholder="Provide brief title here"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200
                                @error('title') ring-red-400 @enderror" value="{{old('title')}}">
                            @error('title')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <h2 class="label">Detailed Description</h2>
                        <textarea name="description" rows="6" class="w-full border border-gray-300 rounded px-4 py-2 resize-none @error('description') ring-red-400 @enderror">{{old('description')}}</textarea>
                        @error('description')
                            <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-orange-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition duration-150">
                        Submit
                    </button>
                </form>
            </div>
        </section>
    </main>
</x-backend-layout>
