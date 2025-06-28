<x-backend-layout title="Blog Details">
    <main>
        <section class="flex justify-center">
            <div class="bg-white rounded-lg shadow-lg px-8 py-4 sm:mx-24 my-12 w-5/6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl text-gray-600 font-semibold mb-4">Full Blog Details</h2>
                    <div class="flex gap-2">
                        <form action="{{route('blogs.destroy', $blog->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition duration-150 cursor-pointer">Delete Blog</button>
                        </form>
                        <a href="{{route('blogs.edit', $blog->id)}}" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-orange-600 transition duration-150 cursor-pointer">Edit Blog</a>
                    </div>
                </div>
                
                <div class="flex">
                    <x-show-blog-component>
                        <x-slot:title>{{$blog->title}}</x-slot:title>
                        {{$blog->description}}
                        <x-slot:user_name>{{$blog->user->name}}</x-slot:user_name>
                        <x-slot:time>{{$blog->updated_at->diffForHumans()}}</x-slot:time>
                    </x-show-blog-component>
                </div>
            </div>
        </section>
    </main>
</x-backend-layout>
