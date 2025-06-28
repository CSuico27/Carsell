<x-backend-layout title="Brands">
    <main>
        <section class="flex flex-col md:flex-row gap-8 py-12 px-4 md:px-16 md:py-6">
            <div class="flex flex-row md:flex-col overflow-x-auto md:overflow-x-visible bg-gray-50 shadow-lg rounded-b-lg w-full md:w-1/5 py-4 px-8 gap-4">
                @foreach ($makers as $maker)
                    <a href="{{ route('brands', ['maker'=> $maker->name]) }}" class="flex-shrink-0 brand-card w-32 md:w-full text-center">
                        <img class="brand-card-image mx-auto" src="{{ asset('assets/car_brand/'. $maker->name .'.png') }}" alt="{{ $maker->name }} Logo">
                        <h3 class="brand-card-name mt-2">{{ $maker->name }}</h3>
                    </a>
                @endforeach
            </div>
            

            <div class="bg-gray-50 shadow-lg rounded-b-lg w-full md:w-4/5 space-y-4 py-4 px-8">
                <div class="overflow-x-auto pb-4 md:hidden">
                    <div class="flex gap-4 min-w-max">
                        @foreach ($cars as $car)
                            <x-mobile-featured-cars-card :$car/>
                        @endforeach
                    </div>
                </div>
                <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($cars as $car)
                        <x-featured-cars-card :$car/>
                    @endforeach
                </div>
                {{$cars->onEachSide(1)->appends(request()->query())->links()}}
            </div>
        </section>
    </main>
</x-backend-layout>