<x-backend-layout title="Home">
    <main class="">
        {{-- Hero Section --}}
        <section class="h-screen relative bg-white text-gray-900 py-12 px-12 md:px-24 md:pt-20 md:pb-40 overflow-hidden">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center relative z-10">
                <div class="lg:w-1/2 text-center lg:text-left pr-0 lg:pr-10">
                    <h1 class="text-2xl md:text-3xl lg:text-5xl font-bold leading-tight w-[100%]">Discover unbeatable prices on new and pre-owned vehicles!</h1>
                    <p class="mt-4 text-base md:text-lg text-gray-700">Select from a range of car options and local specials.</p>

                   @php
                        $limitCarTypes = $carTypes->take(3);
                    @endphp
                    <ul class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3 flex-wrap">
                        @foreach ($limitCarTypes as $carType)
                            <a href="{{route('car.search', ['carType' => $carType->name])}}" class="car-type"><img src="{{ asset('assets/icons/' . $carType->name . '.png') }}" alt="Icons">{{$carType->name}}</a>
                        @endforeach
                            <a href="{{route('car.search')}}" class="car-type">View All <i class="fa-solid fa-arrow-up rotate-45"></i></a>
                    </ul>
                </div>
                <div class="lg:w-1/2 lg:flex justify-end hidden items-center mt-25 lg:mt-0 relative">
                    <div class="absolute -right-40 -left-35 top-7 w-[600px] h-[400px] bg-gradient-to-r from-[#e1402e] to-orange-500 rounded-full z-0 transform translate-x-1/4 -translate-y-1/4"></div>
                    <img src="{{ asset('assets/cars/home-car.png') }}" alt="Orange Jeep" class="w-full h-auto object-contain relative z-10 scale-125 -mt-10">
                </div>
            </div>
        </section>

        {{-- Explore Our Premium Brands Section --}}
        <section class="py-12 px-12 md:p-x24 md:py-6 pt-100">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row lg:flex-row items-center justify-between">
                <h1 class="text-xl lg:text-4xl font-semibold">Explore Our Premium Brands</h1>
                <a href="{{route('brands')}}" class="flex justify-center items-center font-light gap-2 hover:text-blue-500 duration-150 transition-all">Show all Brands <i class="fa-solid fa-arrow-up group-hover:text-blue-500 rotate-45"></i></a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 py-8">
                @php
                    $firstSixMaker = $makers->take(6);
                @endphp
                @foreach ($firstSixMaker as $maker)
                    <a href="{{route('brands', ['maker'=> $maker->name])}}" class="brand-card w-35 md:w-50 mb-4">
                        <img class="brand-card-image" src="{{ asset('assets/car_brand/'. $maker->name .'.png') }}" alt="Audi Logo">
                        <h3 class="brand-card-name">{{$maker->name}}</h3>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Featured Cars Section --}}
        <section class="py-12 px-12 md:px-24 md:py-16">
            <div>
                <div class="max-w-7xl mx-auto flex flex-row items-center justify-between">
                    <h1 class="text-xl lg:text-4xl font-semibold">Featured Listings</h1>
                    <a href="{{route('listings')}}" class="flex justify-center items-center font-light gap-2 hover:text-blue-500 duration-150 transition-all cursor-pointer">Show all Listings <i class="fa-solid fa-arrow-up group-hover:text-blue-500 rotate-45"></i></a>
                </div>
                <hr class="w-full mt-2 border border-gray-300 lg:ml-3">

                <section class="mt-8">
                    <div class="overflow-x-auto pb-4 md:hidden">
                        <div class="flex gap-4 min-w-max">
                            @foreach ($cars as $car)
                                <x-mobile-featured-cars-card :$car/>
                            @endforeach
                        </div>
                    </div>

                    <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($cars as $car)
                            <x-featured-cars-card :$car/>
                        @endforeach
                    </div>
                </section>
            </div>
        </section>


        <section class="py-12 px-12 md:px-24 bg-gray-100">
            <div class="flex flex-col lg:flex-row">
                <div class="flex justify-center items-center">
                    <div class="w-full md:w-3/4 lg:w-3/4 flex items-center justify-center py-10 lg:py-20">
                        <img class="w-5/6 h-auto object-contain" src="{{ asset('assets/cars/Bmw.png') }}"
                            alt="Image ">
                    </div>
                </div>
                <div class="w-full lg:w-1/2 flex flex-col justify-start py-4 lg:py-12 px-2 md:px-12 lg:px-12">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold mb-4 text-center md:text-left">Get a Fair Price For
                            Your <br class="hidden md:block"> Car Sell To Us Today</h2>
                        <p class="text-sm md:text-base font-light mb-4 text-center md:text-left">We are commited to
                            providing
                            our costumers with exceptional service, <br class="hidden md:block">
                            competitive pricing, and a wide range of.</p>
                    </div>
                    <ul class="mb-4 space-y-2">
                        <li class="text-sm font-semibold flex items-center"><i
                                class="fa-solid fa-circle-check text-gray-400 mr-2"></i>We are the Philippines largest
                            provider, with more patrols in more places</li>
                        <li class="text-sm font-semibold flex items-center"><i
                                class="fa-solid fa-circle-check text-gray-400 mr-2"></i>You get 24/7 roadside assistance
                        </li>
                        <li class="text-sm font-semibold flex items-center"><i
                                class="fa-solid fa-circle-check text-gray-400 mr-2"></i>We fix 4 out of four cars at the
                            roadside</li>
                    </ul>
                    <div class="flex justify-center md:justify-start mt-4">
                        <a href="{{route('login')}}"
                            class="text-white bg-blue-500 rounded-lg hover:bg-blue-600 py-3 px-4 w-40 cursor-pointer">Get
                            started <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </div>
                </div>
            </div>
            <div class="w-full grid grid-cols-2 md:grid-cols-4 mt-8 text-center">
                <h3><span class="text-[30px] md:text-[45px] text-center font-semibold">836M</span><br>CARS FOR SALE</h3>
                <h3><span class="text-[30px] md:text-[45px] font-semibold">500M</span><br>DEALER REVIEWS</h3>
                <h3><span class="text-[30px] md:text-[45px] font-semibold">50K</span><br>VISITORS PER WEEK</h3>
                <h3><span class="text-[30px] md:text-[45px] font-semibold">20K</span><br>VERIFIED DEALERS</h3>
            </div>
        </section>

        <section class="bg-[#050B20] mx-8 lg:mx-24 rounded-2xl drop-shadow-md">
            <div class="flex flex-col md:flex-row items-center justify-center gap-12 lg:gap-24 py-12 px-12 lg:px-24">
                <div class="flex flex-row items-center gap-8">
                    <img class="size-12 lg:size-20" src="{{ asset('assets/icons/searchIcon.svg') }}"
                        alt="Search Icon">
                    <div>
                        <h1 class="text-xl lg:text-3xl font-semibold text-white mb-2">Search over 150,000 vehicles</h1>
                        <p class="text-white text-xs font-light">Choose from thousands of trusted used cars and vans
                            across the
                            Philippines,<br class="hidden md:block">
                            from our national network of vetted dealers.</p>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-4">
                    <a href="{{route('car.search')}}" class="btn-search">Search Cars <img class="mt-1"
                            src="{{ asset('assets/icons/arrowWhite.svg') }}" alt="Arrow"></a>
                    <a href="{{route('car.search')}}" class="btn-search">Search Vans <img class="mt-1"
                            src="{{ asset('assets/icons/arrowWhite.svg') }}" alt="Arrow"></a>
                </div>
            </div>

            <div class="mx-6 md:mx-32 lg:mx-48 pb-12">
                <h3 class="text-white font-meduim">Or browse by fuel type:</h3>
                <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 items-center gap-4 mt-4 flex-wrap">
                    @foreach ($fuelTypes as $fuelType)
                        <a href="{{route('car.search', ['fuelType' => $fuelType->name])}}" class="carType">{{$fuelType->name}} Cars</a>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="py-16 px-12 md:px-24">
            <h1 class="flex justify-center text-4xl font-semibold">Why Choose Us?</h1>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-12 ">
                <div>
                    <img src="{{ asset('assets/icons/priceTag.svg') }}" alt="Icon">
                    <h3 class="md:text-sm lg:text-lg font-semibold my-3">Special Financing Offers</h3>
                    <p class="text-sm leading-6 text-justify">Our stress-free finance department that can
                        find financial solutions to save you money.</p>
                </div>
                <div>
                    <img src="{{ asset('assets/icons/diamond.svg') }}" alt="Icon">
                    <h3 class="md:text-sm lg:text-lg font-semibold my-3">Trusted Car Dealership</h3>
                    <p class="text-sm leading-6 text-justify">Our stress-free finance department that can
                        find financial solutions to save you money.</p>
                </div>
                <div>
                    <img src="{{ asset('assets/icons/tag.svg') }}" alt="Icon">
                    <h3 class="md:text-sm lg:text-lg font-semibold my-3">Transparent Pricing</h3>
                    <p class="text-sm leading-6 text-justify">Our stress-free finance department that can
                        find financial solutions to save you money.</p>
                </div>
                <div>
                    <img src="{{ asset('assets/icons/car.svg') }}" alt="Icon">
                    <h3 class="md:text-sm lg:text-lg font-semibold my-3">Expert Car Service</h3>
                    <p class="text-sm leading-6 text-justify">Our stress-free finance department that can
                        find financial solutions to save you money.</p>
                </div>
            </div>
        </section>

        <section class="bg-gray-100 py-12 px-4 mx-8 md:px-8 lg:mx-24 rounded-xl drop-shadow-md mb-8">
            <div class="flex flex-row items-center justify-between">
                <h2 class="text-xl lg:text-3xl font-bold">What our costumers say</h2>
                <a href="{{route('blog')}}" class="text-base font-medium hover:text-blue-500 duration-150 transition">View All</a>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-between mt-8 gap-4 lg:gap-8">
                @php
                    $limitBlogs = $blogs->take(3);
                @endphp
                @foreach ($limitBlogs as $blog)
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
        </section>

        <x-layout.footer/>
    </main>
</x-backend-layout>