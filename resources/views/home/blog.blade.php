<x-backend-layout title="All Blog">
    <section class="flex justify-center">
        <div class="bg-white rounded-lg shadow-lg px-8 py-4 sm:mx-24 my-12 w-5/6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl text-gray-600 font-semibold mb-4">All Blogs</h2>
                <a href="{{route('blogs.create')}}" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition duration-150 cursor-pointer">Create New Blog</a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
            {{$blogs->onEachSide(1)->links()}}
        </div>
    </section>
</x-backend-layout>