<x-backend-layout title="Edit Car Details">
    <main>
        <section class="relative bg-white shadow-lg rounded-b-lg mx-4 md:mx-16 lg:mx-60 px-4 md:px-6 py-6">
            <h1 class="text-2xl font-medium text-gray-500 mb-4">Add new Car</h1>
            <form action="{{route('car.update', $car->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                {{-- Dropdown Section --}}
                <section class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-8">
                    {{-- Maker --}}
                    <div class="w-full max-w-sm">
                        <label for="makerDropdown" class="dropdown-label">Maker</label>
                        <select id="makerDropdown" name="maker_id"
                            class="dropdown-select @error('maker_id') ring-red-400 @enderror"
                            value="{{old('maker_id')}}">
                            <option value="">Select Maker</option>
                            @foreach ($makers as $maker)
                                <option value="{{ $maker->id }}" {{old('maker_id', $car->maker_id) == $maker->id ? 'selected' : ''}}>{{ $maker->name }}</option>
                            @endforeach
                        </select>
                        @error('maker_id')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>                   

                    {{-- Model --}}
                    <div class="w-full max-w-sm">
                        <label for="modelDropdown" class="dropdown-label">Model</label>
                        <select id="modelDropdown" name="model_id" class="dropdown-select @error('model_id') ring-red-400 @enderror"
                            value="{{old('model_id')}}">
                            <option value="" {{old('model_id', $car->model_id)}}>Select Model</option>
                        </select>
                        @error('model_id')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>

                    @php
                        $current_year = now()->year;
                        $past_year = $current_year - 20;
                    @endphp
                    {{-- Year --}}
                    <div class="w-full max-w-sm">
                        <label for="yearDropdown" class="dropdown-label">Year</label>
                        <select id="yearDropdown" name="year" class="dropdown-select"
                            value="{{old('year')}}">
                              @for ($year = $current_year; $year >= $past_year; $year--)
                                <option class="max-h-10" value="{{$year}}" {{old('year', $car->year) == $year ? 'selected' : ''}}>{{$year}}</option>
                              @endfor  
                        </select>
                    </div>

                    {{-- Inventory Type --}}
                    <div class="w-full max-w-sm">
                        <label for="inventory_type" class="dropdown-label">Inventory Type</label>
                        <select id="inventory_type" name="inventory_type" class="dropdown-select @error('inventory_type') ring-red-400 @enderror"
                            value="{{old('inventory_type')}}">
                            <option value="">Select Inventory Type</option>
                            <option value="Used" {{old('inventory_type', $car->inventory_type) == 'used' ? 'selected' : ''}}>Used</option>
                            <option value="New" {{old('inventory_type', $car->inventory_type) == 'new' ? 'selected' : ''}}>New</option>
                        </select>
                        @error('inventory_type')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                </section>


                <section class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="w-full max-w-sm">
                        <label for="car_type" class="dropdown-label">Car Type</label>
                        <select name="car_type" id="car_type" class="dropdown-select @error('car_type') ring-red-400 @enderror"
                            value="{{old('car_type')}}">
                            <option value="">Select Car Type</option>
                            @foreach ($car_types as $car_type)
                                <option value="{{$car_type->id}}" {{old('car_type_id', $car->car_type_id) == $car_type->id ? 'selected' : ''}}>{{$car_type->name}}</option>
                            @endforeach
                        </select>
                        @error('car_type')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="w-full max-w-sm">
                        <label for="fuel_type" class="dropdown-label">Fuel Type</label>
                        <select name="fuel_type_id" id="fuel_type" class="dropdown-select @error('fuel_type_id') ring-red-400 @enderror"
                            value="{{old('fuel_type_id')}}">
                            <option value="">Select Fuel Type</option>
                            @foreach ($fuel_types as $fuel_type)
                                <option value="{{$fuel_type->id}}" {{old('fuel_type_id', $car->fuel_type_id) == $fuel_type->id ? 'selected' : ''}}>{{$fuel_type->name}}</option>
                            @endforeach
                        </select>
                        @error('fuel_type_id')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="w-full max-w-sm">
                        <label for="regionDropdown" class="dropdown-label">State/Region</label>
                        <select name="region_id" id="regionDropdown" class="dropdown-select @error('region_id') ring-red-400 @enderror"
                            value="{{old('region_id')}}">
                            <option value="">Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{$region->id}}" {{old('region_id', $car->region_id) == $region->id ? 'selected' : ''}}>{{$region->name}}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="w-full max-w-sm">
                        <label for="cityDropdown" class="dropdown-label">Cities</label>
                        <select name="city_id" id="cityDropdown" class="dropdown-select @error('city_id') ring-red-400 @enderror"
                            value="{{old('city_id')}}">
                            <option value="">Select City</option>
                        </select>
                        @error('city_id')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                </section>

                <section class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h2 class="label">Car Price</h2>
                        <input type="text" name="price" placeholder="Price"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('price') ring-red-400 @enderror"
                            value="{{old('price', $car->price)}}">
                            @error('price')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                    <div>
                        <h2 class="label">Vin</h2>
                        <input type="text" name="vin" placeholder="Vin Number"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('vin') ring-red-400 @enderror"
                            value="{{old('vin', $car->vin)}}">
                        @error('vin')
                            <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                    <div>
                        <h2 class="label">Mileage</h2>
                        <input type="text" name="mileage" placeholder="Mileage"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('mileage') ring-red-400 @enderror"
                            value="{{old('mileage', $car->mileage)}}">
                            @error('mileage')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                </section>

                {{-- Address & Phone --}}
                <section class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="label">Address</h2>
                        <input type="text" name="address" placeholder="Address"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('address') ring-red-400 @enderror"
                            value="{{old('address', $car->address)}}">
                            @error('address')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                    <div>
                        <h2 class="label">Phone</h2>
                        <input type="tel" name="phone" placeholder="Phone"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('phone') ring-red-400 @enderror"
                            value="{{old('phone', $car->phone)}}">
                            @error('phone')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                </section>

                {{-- Accessories --}}
                <section class="mt-6">
                    <h2 class="label">Accessories</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <label><input type="checkbox" name="air_conditioning" value="1" {{old('air_conditioning', $car->features->air_conditioning) ? 'checked' : ''}}> Air
                            Conditioning</label>
                        <label><input type="checkbox" name="power_windows" value="1" {{old('power_windows', $car->features->power_windows) ? 'checked' : ''}}> Power Windows</label>
                        <label><input type="checkbox" name="gps" value="1" {{old('gps_navigation', $car->features->gps_navigation) ? 'checked' : ''}}> GPS Navigation</label>
                        <label><input type="checkbox" name="power_door_locks" value="1" {{old('power_door_locks', $car->features->power_door_locks) ? 'checked' : ''}}> Power Door
                            Locks</label>
                        <label><input type="checkbox" name="heater_seats" value="1" {{old('heater_seats', $car->features->heater_seats) ? 'checked' : ''}}> Heated
                            Seats</label>
                        <label><input type="checkbox" name="abs" value="1" {{old('abs', $car->features->abs) ? 'checked' : ''}}> ABS</label>
                        <label><input type="checkbox" name="climate_control" value="1" {{old('climate_control', $car->features->climate_control) ? 'checked' : ''}}> Climate
                            Control</label>
                        <label><input type="checkbox" name="cruise_control" value="1" {{old('cruise_control', $car->features->cruise_control) ? 'checked' : ''}}> Cruise
                            Control</label>
                        <label><input type="checkbox" name="bluetooth" value="1" {{old('bluetooth_connectivity', $car->features->bluetooth_connectivity) ? 'checked' : ''}}> Bluetooth</label>
                        <label><input type="checkbox" name="leather_seats" value="1" {{old('leather_seats', $car->features->leather_seats) ? 'checked' : ''}}> Leather
                            Seats</label>
                        <label><input type="checkbox" name="remote_start" value="1" {{old('remote_start', $car->features->remote_start) ? 'checked' : ''}}> Remote Stare </label>
                        <label><input type="checkbox" name="rear_parking_sensors" value="1" {{old('rear_parking_sensors', $car->features->rear_parking_sensors) ? 'checked' : ''}}> Rear Parking Sensors</label>
                    </div>
                </section>

                {{-- Description --}}
                <div class="mt-6">
                    <h2 class="label">Detailed Description</h2>
                    <textarea name="description" rows="6" class="w-full border border-gray-300 rounded px-4 py-2 resize-none @error('description') ring-red-400 @enderror">{{old('description', $car->description)}}</textarea>
                    @error('description')
                                <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                </div>

                {{-- Publish Date --}}
                <div class="mt-6">
                    <h2 class="label">Publish Date</h2>
                    <input type="date" name="publishDate"
                        class="w-full border border-gray-300 rounded px-4 py-2 text-gray-600">
                </div>

                
                {{-- Car Image Upload Component --}}
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900">Car Images</h3>
                    <p class="mt-1 text-sm text-gray-500">Upload one or more images of your vehicle (PNG, JPG, JPEG up to 5MB each)</p>
                    
                    <div class="mt-3">
                        <label for="carFormImageUpload" class="block w-full cursor-pointer">
                            <div class="mt-2 flex flex-col justify-center items-center px-6 py-4 border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition duration-150 group">
                                <div class="flex flex-col items-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                                        stroke="currentColor" class="w-10 h-10 text-gray-400 group-hover:text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    <div class="text-center">
                                        <span class="font-medium text-blue-600 hover:text-blue-700">Click to upload</span>
                                        <span class="text-gray-500"> or drag and drop</span>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        Select multiple images if needed
                                    </p>
                                </div>
                            </div>
                        </label>
                        <input 
                            id="carFormImageUpload" 
                            type="file" 
                            name="images[]" 
                            multiple 
                            accept="image/png,image/jpeg,image/jpg"
                            class="hidden" 
                            @error('images.*') aria-invalid="true" @enderror
                        />
                    </div>

                    {{-- Preview Area (initially hidden, shown with JS) --}}
                    <div id="imagePreviewArea" class="mt-4 hidden">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Images</h4>
                        <div id="imagePreviewGrid" class="grid grid-cols-3 gap-3"></div>
                    </div>

                    {{-- Error Messages --}}
                    @error('images.*')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Buttons --}}
                <div class="flex justify-end gap-4 mt-8">
                    <button type="reset"
                        class="text-sm bg-gray-200 border border-gray-300 hover:bg-gray-400 rounded-sm py-2 px-6 cursor-pointer transition duration-150">Reset</button>
                    <button type="submit"
                        class="text-sm text-white bg-orange-500 hover:bg-orange-600  rounded-sm py-2 px-6 cursor-pointer transition duration-150">Submit</button>
                </div>
            </form>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const makerDropdown = document.getElementById('makerDropdown');
            const modelDropdown = document.getElementById('modelDropdown');
            const selectedMaker = "{{ old('maker_id', $car->maker_id) }}";
            const selectedModel = "{{ old('model_id', $car->model_id) }}";

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
                loadModels(makerId);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const regionDropdown = document.getElementById('regionDropdown');
            const cityDropdown = document.getElementById('cityDropdown');
            const selectedRegion = "{{ old('region_id', $car->region_id) }}";
            const selectedCity = "{{ old('city_id', $car->city_id) }}";

            function loadCities(regionID, selectedCityId = null) {
                cityDropdown.innerHTML = '<option value="">Loading...</option>';
                fetch(`/get-cities/${regionID}`)
                    .then(res => res.json())
                    .then(cities => {
                        cityDropdown.innerHTML = '<option value="">Select City</option>';
                        cities.forEach(city => {
                            const isSelected = selectedCityId == city.id ? 'selected' : '';
                            cityDropdown.innerHTML += `<option value="${city.id}" ${isSelected}>${city.name}</option>`;
                        });
                    });
            }

            regionDropdown.addEventListener('change', function () {
                const regionID = this.value;
                if (regionID) {
                    loadCities(regionID);
                } else {
                    cityDropdown.innerHTML = '<option value="">Select City</option>';
                }
            });

            if (selectedRegion) {
                loadCities(selectedRegion, selectedCity);
            }
        })
    </script>
</x-backend-layout>
