<x-backend-layout title="Add New Car">
    <main>
        <section class="relative bg-white shadow-lg rounded-b-lg mx-4 md:mx-16 lg:mx-60 px-4 md:px-6 py-6">
            <h1 class="text-2xl font-medium text-gray-500 mb-4">Add new Car</h1>
            <form action="{{route('car.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
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
                                <option value="{{ $maker->id }}">{{ $maker->name }}</option>
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
                            <option value="">Select Model</option>
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
                                <option class="max-h-10" value="{{$year}}">{{$year}}</option>
                              @endfor  
                        </select>
                    </div>

                    {{-- Inventory Type --}}
                    <div class="w-full max-w-sm">
                        <label for="inventory_type" class="dropdown-label">Inventory Type</label>
                        <select id="inventory_type" name="inventory_type" class="dropdown-select @error('inventory_type') ring-red-400 @enderror"
                            value="{{old('inventory_type')}}">
                            <option value="">Select Inventory Type</option>
                            <option value="Used">Used</option>
                            <option value="New">New</option>
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
                                <option value="{{$car_type->id}}">{{$car_type->name}}</option>
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
                                <option value="{{$fuel_type->id}}">{{$fuel_type->name}}</option>
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
                                <option value="{{$region->id}}">{{$region->name}}</option>
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
                            value="{{old('price')}}">
                            @error('price')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                    <div>
                        <h2 class="label">Vin</h2>
                        <input type="text" name="vin" placeholder="Vin Number"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('vin') ring-red-400 @enderror"
                            value="{{old('vin')}}">
                        @error('vin')
                            <span class="text-xs text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                    <div>
                        <h2 class="label">Mileage</h2>
                        <input type="text" name="mileage" placeholder="Mileage"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('mileage') ring-red-400 @enderror"
                            value="{{old('mileage')}}">
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
                            value="{{old('address')}}">
                            @error('address')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                    <div>
                        <h2 class="label">Phone</h2>
                        <input type="tel" name="phone" placeholder="Phone"
                            class="w-full border border-gray-300 rounded px-4 py-2 @error('phone') ring-red-400 @enderror"
                            value="{{old('phone')}}">
                            @error('phone')
                                <span class="text-xs text-red-400">{{$message}}</span>
                            @enderror
                    </div>
                </section>

                {{-- Accessories --}}
                <section class="mt-6">
                    <h2 class="label">Accessories</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <label><input type="checkbox" name="air_conditioning" value="1"> Air
                            Conditioning</label>
                        <label><input type="checkbox" name="power_windows" value="1"> Power Windows</label>
                        <label><input type="checkbox" name="gps" value="1"> GPS Navigation</label>
                        <label><input type="checkbox" name="power_door_locks" value="1"> Power Door
                            Locks</label>
                        <label><input type="checkbox" name="heater_seats" value="1"> Heated
                            Seats</label>
                        <label><input type="checkbox" name="abs" value="1"> ABS</label>
                        <label><input type="checkbox" name="climate_control" value="1"> Climate
                            Control</label>
                        <label><input type="checkbox" name="cruise_control" value="1"> Cruise
                            Control</label>
                        <label><input type="checkbox" name="bluetooth" value="1"> Bluetooth</label>
                        <label><input type="checkbox" name="leather_seats" value="1"> Leather
                            Seats</label>
                        <label><input type="checkbox" name="remote_start" value="1"> Remote Start</label>
                        <label><input type="checkbox" name="rear_parking_sensors" value="1"> Rear Parking Sensors</label>
                    </div>
                </section>

                {{-- Description --}}
                <div class="mt-6">
                    <h2 class="label">Detailed Description</h2>
                    <textarea name="description" rows="6" class="w-full border border-gray-300 rounded px-4 py-2 resize-none @error('description') ring-red-400 @enderror">{{old('description')}}</textarea>
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
                    <p class="mt-1 text-sm text-gray-500">Upload one or more images of your vehicle (PNG, JPG, JPEG)</p>
                    
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

            makerDropdown.addEventListener('change', function () {
                const makerId = this.value;
                modelDropdown.innerHTML = '<option value="">Loading...</option>';

                fetch(`/get-models/${makerId}`)
                    .then(res => res.json())
                    .then(models => {
                        modelDropdown.innerHTML = '<option value="">Select Model</option>';
                        models.forEach(model => {
                            modelDropdown.innerHTML += `<option value="${model.id}">${model.name}</option>`;
                        });
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const regionDropdown = document.getElementById('regionDropdown');
            const cityDropdown = document.getElementById('cityDropdown');

            regionDropdown.addEventListener('change', function(){
                const regionID = this.value;            
                cityDropdown.innerHTML = '<option value="">Loading...</option>';

                fetch(`/get-cities/${regionID}`)
                    .then(res => res.json())
                    .then(cities => {
                        cityDropdown.innerHTML = '<option value="">Select Model</option>';
                        cities.forEach(city => {
                            cityDropdown.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                        })
                    })
            })
        })
    </script>
</x-backend-layout>
