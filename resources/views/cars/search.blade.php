<x-backend-layout title="Search Car">
    <h1 class="text-xl md:text-2xl font-semibold text-gray-500 mb-4 ms-4 lg:ms-24">Define your Search Criteria</h1>
    <section class="flex flex-col md:flex-row items-start gap-2 lg:gap-4 mx-2 lg:mx-24 pb-16">
        <section class="bg-white shadow-lg rounded-b-lg w-full md:w-1/3">
            <div class="pt-4 px-4">
                <h1 class="text-xl font-medium text-gray-500 mb-2">Found Cars: <strong>{{$cars->total()}}</strong></h1>
                <hr class="border border-gray-100">
            </div>

            <div class="py-4 px-4">
                <form action="{{route('car.search')}}" method="GET">
                    @csrf

                    {{-- Maker --}}
                    <div class="w-full max-w-sm mb-4">
                        <label for="makerDropdown" class="dropdown-label">Maker</label>
                        <select id="makerDropdown" name="maker_id"
                            class="dropdown-select">
                            <option value="">Select Maker</option>
                            @foreach ($makers as $maker)
                                <option value="{{ $maker->id }}" {{old('maker_id', request()->input('maker_id') == $maker->id ? 'selected' : '')}}>{{ $maker->name }}</option>
                            @endforeach
                        </select>
                    </div>         
                    {{-- Model --}}
                    <div class="w-full max-w-sm mb-4">
                        <label for="modelDropdown" class="dropdown-label">Model</label>
                        <select id="modelDropdown" name="model_id" class="dropdown-select">
                            <option value="">Select Model</option>
                            @if(isset($models))
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}" {{ old('model_id', request()->input('model_id')) == $model->id ? 'selected' : '' }}>
                                        {{ $model->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{-- Car Type --}}
                    <div class="w-full max-w-sm mb-4">
                        <label for="car_type" class="dropdown-label">Car Type</label>
                        <select name="car_type" id="car_type" class="dropdown-select">
                            <option value="">Select Car Type</option>
                            @foreach ($car_types as $car_type)
                                <option value="{{$car_type->id}}" {{old('car_type', request()->input('car_type') == $car_type->id ? 'selected' : '')}}>{{$car_type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Inventory Type --}}
                    <div class="w-full max-w-sm mb-4">
                        <label for="inventory_type" class="dropdown-label">Inventory Type</label>
                        <select name="inventory_type" id="inventory_type" class="dropdown-select">
                            <option value="">Any</option>
                            <option value="used" {{ old('inventory_type', request()->input('inventory_type')) == 'used' ? 'selected' : '' }}>Used</option>
                            <option value="new" {{ old('inventory_type', request()->input('inventory_type')) == 'new' ? 'selected' : '' }}>New</option>
                        </select>
                    </div>

                    {{-- Year --}}
                    <div class="mb-4">
                        <h2 class="label">Year</h2>
                        <div class="flex flex-row gap-2">
                            <input type="number" name="yearFrom" placeholder="Year From"
                                class="w-full border border-gray-300 rounded px-4 py-2" value="{{old('yearFrom', request()->input('yearFrom'))}}">
                            <input type="number" name="yearTo" placeholder="Year To"
                                class="w-full border border-gray-300 rounded px-4 py-2" value="{{old('yearTo', request()->input('yearTo'))}}">
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <h2 class="label">Price</h2>
                        <div class="flex flex-row gap-2">
                            <input type="number" name="priceFrom" placeholder="Price From"
                                class="w-full border border-gray-300 rounded px-4 py-2" value="{{old('priceFrom', request()->input('priceFrom'))}}">
                            <input type="number" name="priceTo" placeholder="Price To"
                                class="w-full border border-gray-300 rounded px-4 py-2" value="{{old('priceFrom', request()->input('priceFrom'))}}">
                        </div>
                    </div>

                    {{-- Mileage --}}
                    <div class="w-full max-w-sm mb-4">
                        <label for="mileage" class="dropdown-label">Mileage</label>
                        <select name="mileage" id="mileage" class="dropdown-select">
                            <option value="any">Any</option>
                            <option value="10000" {{ old('mileage', request()->input('mileage')) == '10000' ? 'selected' : '' }}>10,000 or less</option>
                            <option value="20000" {{ old('mileage', request()->input('mileage')) == '20000' ? 'selected' : '' }}>10,001 to 20,000</option>
                            <option value="30000" {{ old('mileage', request()->input('mileage')) == '30000' ? 'selected' : '' }}>20,001 to 30,000</option>
                            <option value="40000" {{ old('mileage', request()->input('mileage')) == '40000' ? 'selected' : '' }}>30,001 to 40,000</option>
                            <option value="50000" {{ old('mileage', request()->input('mileage')) == '50000' ? 'selected' : '' }}>40,001 to 50,000</option>
                            <option value="60000" {{ old('mileage', request()->input('mileage')) == '60000' ? 'selected' : '' }}>50,001 to 60,000</option>
                            <option value="70000" {{ old('mileage', request()->input('mileage')) == '70000' ? 'selected' : '' }}>60,001 to 70,000</option>
                            <option value="80000" {{ old('mileage', request()->input('mileage')) == '80000' ? 'selected' : '' }}>70,001 to 80,000</option>
                            <option value="90000" {{ old('mileage', request()->input('mileage')) == '90000' ? 'selected' : '' }}>80,001 to 90,000</option>
                            <option value="100000" {{ old('mileage', request()->input('mileage')) == '100000' ? 'selected' : '' }}>90,001 to 100,000</option>
                            <option value="100001" {{ old('mileage', request()->input('mileage')) == '100001' ? 'selected' : '' }}>100,001 and above</option>
                        </select>
                    </div>

                    {{-- Region --}}
                    <div class="w-full max-w-sm mb-4">
                        <label for="region" class="dropdown-label">Region</label>
                        <select name="region_id" id="regionDropdown" class="dropdown-select">
                            <option value="">Select City</option>
                            @foreach ($regions as $region)
                                <option value="{{$region->id}}" {{old('region_id', request()->input('region_id') == $region->id ? 'selected' : '')}}>{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="w-full max-w-sm mb-4">
                        <label for="cityDropdown" class="dropdown-label">Cities</label>
                        <select name="city_id" id="cityDropdown" class="dropdown-select">
                            <option value="">Select City</option>
                            @if(isset($cities))
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', request()->input('city_id')) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>


                    {{-- Fuel Type --}}
                    <div class="mb-4">
                        <label for="fuel_type" class="dropdown-label">Fuel Type</label>
                        <select name="fuel_type" id="fuel_type" class="dropdown-select">
                            <option value="">Select Fuel Type</option>
                            @foreach ($fuel_types as $fuel_type)
                                <option value="{{$fuel_type->id}}" {{old('fuel_type', request()->input('fuel_type') == $fuel_type->id ? 'selected' : '')}}>{{$fuel_type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-start gap-4 mt-4">
                        <button type="reset"
                            class="text-sm bg-gray-200 border border-gray-300 hover:bg-gray-400 rounded-sm py-2 px-6 w-full transition duration-150">Reset</button>
                        <button type="submit"
                            class="text-sm text-white bg-orange-600 hover:bg-orange-500 rounded-sm py-2 px-6 w-full transition duration-150">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <section class="bg-white shadow-lg rounded-b-lg w-full md:w-3/4 px-6 py-8">
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
            {{ $cars->onEachSide(1)->appends(request()->query())->links() }}
        </section>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const makerDropdown = document.getElementById('makerDropdown');
            const modelDropdown = document.getElementById('modelDropdown');
            const selectedMaker = "{{ old('maker_id', request()->input('maker_id')) }}";
            const selectedModel = "{{ old('model_id', request()->input('model_id')) }}";

            function loadModels(makerId, selectedModelId = null) {
                modelDropdown.innerHTML = '<option value="">Loading...</option>';

                fetch(`/get-models/${makerId}`)
                    .then(res => res.json())
                    .then(models => {
                        modelDropdown.innerHTML = '<option value="">Select Model</option>';
                        models.forEach(model => {
                            const selected = model.id == selectedModelId ? 'selected' : '';
                            modelDropdown.innerHTML += `<option value="${model.id}" ${selected}>${model.name}</option>`;
                        });
                    });
            }

            if (selectedMaker) {
                loadModels(selectedMaker, selectedModel);
            }

            // When maker dropdown changes
            makerDropdown.addEventListener('change', function () {
                const makerId = this.value;
                if (makerId) {
                    loadModels(makerId);
                } else {
                    modelDropdown.innerHTML = '<option value="">Select Model</option>';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const regionDropdown = document.getElementById('regionDropdown');
            const cityDropdown = document.getElementById('cityDropdown');
            const selectedRegion = "{{ old('region_id', request()->input('region_id')) }}";
            const selectedCity = "{{ old('city_id', request()->input('city_id')) }}";

            function loadCities(regionID, selectedCityId = null) {
                cityDropdown.innerHTML = '<option value="">Loading...</option>';
                fetch(`/get-cities/${regionID}`)
                    .then(res => res.json())
                    .then(cities => {
                        cityDropdown.innerHTML = '<option value="">Select City</option>';
                        cities.forEach(city => {
                            const isSelected = city.id == selectedCityId ? 'selected' : '';
                            cityDropdown.innerHTML += `<option value="${city.id}" ${isSelected}>${city.name}</option>`;
                        });
                    });
            }

            if (selectedRegion) {
                loadCities(selectedRegion, selectedCity);
            }

            regionDropdown.addEventListener('change', function () {
                const regionID = this.value;
                if (regionID) {
                    loadCities(regionID);
                } else {
                    cityDropdown.innerHTML = '<option value="">Select City</option>';
                }
            });
        });
    </script>
</x-backend-layout>
