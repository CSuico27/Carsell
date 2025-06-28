<x-backend-layout title="Car Details">
    <main class="p-4 space-y-8">
        <!-- Title -->
        <div class="px-4 md:px-8 lg:px-24 pt-8 space-y-1">
            <h1 class="text-lg md:text-2xl font-semibold text-gray-700">
                {{ $car->makers->name }} {{ $car->models->name }}
            </h1>
            <h2 class="text-sm text-gray-500">
                {{ $car->city->name }} • {{ $car->published_at }} • {{ $car->year }}
            </h2>
        </div>
    
        <!-- Main Image + Thumbnails -->
        <section class="flex flex-col lg:flex-row gap-6 px-4 md:px-8 lg:px-24">
            <!-- Image + Thumbnails -->
            <div class="flex flex-col md:flex-row gap-4 w-full lg:w-2/3">
                <!-- Main Image -->
                <div class="w-full">
                    <img id="mainImage" class="w-full h-64 sm:h-96 object-contain bg-gray-50 rounded-lg shadow"
                        src="{{ asset('storage/car_images/' . $car->primaryImage->image_path) }}" alt="Main Car Image">
                </div>
    
                <!-- Thumbnails -->
                <div class="flex flex-row md:flex-col overflow-x-auto md:overflow-y-auto gap-3 md:max-h-96">
                    @foreach ($car->images as $image)
                        <img class="w-24 h-24 object-contain border rounded cursor-pointer show-scroll-image"
                            src="{{ asset('storage/car_images/' . $image->image_path) }}" data-image="{{ asset('storage/car_images/' . $image->image_path) }}" alt="Thumbnail">
                    @endforeach
                </div>
            </div>
    
            <!-- Car Info Card -->
            <div class="bg-white rounded-lg shadow p-6 w-full lg:w-1/3">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-600">{{ $car->price }}</h2>
                </div>
                <hr class="mb-4">
    
                <div class="grid grid-cols-2 gap-3 text-sm text-gray-700 leading-6 mb-4">
                    <div><strong>Maker:</strong> {{ $car->makers->name }}</div>
                    <div><strong>Model:</strong> {{ $car->models->name }}</div>
                    <div><strong>Year:</strong> {{ $car->year }}</div>
                    <div><strong>VIN:</strong> {{ $car->vin }}</div>
                    <div><strong>Mileage:</strong> {{ $car->mileage }}</div>
                    <div><strong>Car Type:</strong> {{ $car->carType->name }}</div>
                    <div><strong>Fuel Type:</strong> {{ $car->fuelType->name }}</div>
                    <div><strong>Inventory Type:</strong> {{ $car->inventory_type }}</div>
                    <div class="col-span-2"><strong>Address:</strong> {{ $car->address }}</div>
                </div>
                <hr class="mb-4">
    
                <div class="flex items-center gap-3 mb-4">
                    <i class="fa-solid fa-user text-gray-400 text-lg"></i>
                    <div>
                        <h3 class="text-base font-medium">{{ $car->user->name }}</h3>
                        <h4 class="text-sm text-gray-500">{{ $car->user->cars()->count() }} cars</h4>
                    </div>
                </div>
    
                <div 
                    x-data="{ show: false }" 
                    @click="show = !show"
                    class="flex items-center gap-3 border-2 border-orange-500 py-2 px-4 rounded-lg cursor-pointer group hover:bg-orange-500 hover:text-white transition"
                >
                    <i class="fa-solid fa-phone text-orange-500 group-hover:text-white"></i>
                    <h2 x-text="show ? '{{ $car->phone }}' : '{{ Str::mask($car->phone, '*', -4) }}'"></h2>
                    <h2 class="ml-auto text-sm font-medium" x-text="show ? 'Hide Number' : 'View Full Number'"></h2>
                </div>

            </div>
        </section>
    
        <!-- Description -->
        <section class="bg-white shadow rounded-lg px-4 md:px-8 lg:px-16 py-6 mx-4 md:mx-8 lg:mx-24">
            <h3 class="font-bold text-lg mb-3">Detailed Description</h3>
            <p class="text-sm leading-6 text-justify text-gray-700">{{ $car->description }}</p>
        </section>
    
        <!-- Features -->
        <section class="bg-white shadow rounded-lg px-4 md:px-8 lg:px-16 py-6 mx-4 md:mx-8 lg:mx-24">
            <h3 class="font-bold text-lg mb-4">Other Details</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 text-sm text-gray-600">
                <x-car-specification :value="$car->features->abs">ABS</x-car-specification>
                <x-car-specification :value="$car->features->air_conditioning">Air Conditioning</x-car-specification>
                <x-car-specification :value="$car->features->power_windows">Power Windows</x-car-specification>
                <x-car-specification :value="$car->features->power_door_locks">Power Door Locks</x-car-specification>
                <x-car-specification :value="$car->features->cruise_control">Cruise Control</x-car-specification>
                <x-car-specification :value="$car->features->bluetooth_connectivity">Bluetooth Connectivity</x-car-specification>
                <x-car-specification :value="$car->features->remote_start">Remote Start</x-car-specification>
                <x-car-specification :value="$car->features->gps_navigation">GPS Navigation</x-car-specification>
                <x-car-specification :value="$car->features->heated_seats">Heated Seats</x-car-specification>
                <x-car-specification :value="$car->features->climate_control">Climate Control</x-car-specification>
                <x-car-specification :value="$car->features->rear_parking_sensors">Rear Parking Sensors</x-car-specification>
                <x-car-specification :value="$car->features->leather_seats">Leather Seats</x-car-specification>
            </div>
        </section>
    </main>
</x-backend-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        const childImages = document.querySelectorAll('.show-scroll-image');

        childImages.forEach(childImage => {
            childImage.addEventListener('click', function() {
                const newSrc = this.getAttribute("data-image");
                mainImage.setAttribute("src", newSrc)
            });
        });
    });
</script>
