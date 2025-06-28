@props(['car', 'isfavorite' => false])
<div class="featured-card relative w-65">
    <a href="{{route('car.show', $car->id)}}"><img class="featured-card-image" src="{{ asset('storage/car_images/' . $car->primaryImage->image_path) }}" alt="Cars"></a>

    <div>
        @if ($car->inventory_type === 'New')
            <h3 class="inventory-type-new">{{$car->inventory_type}}</h3>
        @else
            <h3 class="inventory-type-used">{{$car->inventory_type}}</h3>
        @endif
    </div>
    
    <div class="mx-6 flex flex-col justify-start items-center">
        <div>
            <h3 class="font-medium text-base">{{$car->year}} - {{$car->makers->name}} - {{$car->models->name}}</h3>
        </div>
        <div class="flex justify-between items-center gap-4 pt-2">
            <p class="font-medium text-sm">{{$car->region->name}}</p>
            <p class="font-medium text-sm">{{$car->city->name}}</p>
        </div>
        <hr class="w-full mt-2 border border-gray-200">
    </div>

    <div class="flex justify-between items-center gap-4 mt-2">
        <div class="flex flex-col justify-center items-center gap-2">
            <img class="size-6" src="{{ asset('assets/icons/Distance.svg') }}" alt="Distance Icon">
            <span>{{$car->mileage}} km</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-2">
            <img class="size-6" src="{{ asset('assets/icons/Gas.svg') }}" alt="Gas Icon">
            <span>{{$car->fuelType->name}}</span>
        </div>
        <div class="flex flex-col justify-center items-center gap-2">
            <img class="size-6" src="{{ asset('assets/icons/typeOfCar.svg') }}" alt="Type of Car">
            <span>{{$car->carType->name}}</span>
        </div>
    </div>
    <hr class="w-4/5 m-0 border border-gray-200">
    <div class="flex justify-between items-center gap-16 mt-2 mb-8">
        <h3 class="text-[#050B20] font-medium text-lg">{{$car->price}}</h3>
        <div class="flex justify-center items-center gap-1">
            <h3 class="text-blue-600 font-medium"><a href="#">View Details</a></h3>
            <img class="text-blue-600" src="{{ asset('assets/icons/blueArrow.svg') }}"
                alt="Arrow Icon">
        </div>
    </div>
</div>