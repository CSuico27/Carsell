<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Models;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $cars = Car::where('user_id', $userId)
        ->with(['primaryImage', 'makers', 'models'])
        ->orderBy("created_at","desc")
        ->paginate(15);
    
        return view("cars.index", compact("cars"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = Maker::all();
        $regions = Region::all();
        $car_types = CarType::all();
        $fuel_types = FuelType::all();
        return view("cars.create", compact("makers","regions", 'car_types', 'fuel_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'maker_id' => ['required','exists:makers,id'],
            'model_id' => ['required','exists:models,id'],
            'year' => ['required','integer'],
            'car_type' => ['required','exists:car_types,id'],
            'fuel_type_id' => ['required','exists:fuel_types,id'],
            'region_id' => ['required','exists:regions,id'],
            'city_id' => ['required','exists:cities,id'],
            'price' => ['required','integer'],
            'vin' => ['required','integer'],
            'mileage' => ['required','integer'],
            'address' => ['required','string', 'max:255'],
            'phone' => ['required', 'regex:/^09\d{9}$/'],
            'description' => ['nullable', 'string'],
            'publishDate' => ['date'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,PNG', 'max:2048'],
            'inventory_type' => ['required', 'in:Used,New']
        ]);

        
        $car = Car::create([
            'maker_id' => $request->input('maker_id'),
            'model_id' => $request->input('model_id'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'vin' => $request->input('vin'),
            'mileage' => $request->input('mileage'),
            'inventory_type' => $request->input('inventory_type'),
            'car_type_id' => $request->input('car_type'),
            'fuel_type_id' => $request->input('fuel_type_id'),
            'user_id' => auth()->id(),
            'region_id' => $request->input('region_id'),
            'city_id' => $request->input('city_id'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description') ?? null,
            'published_at' => $request->input('publishDate'),
        ]);

        $car->features()->create([
            'air_conditioning' => $request->has('air_conditioning'),
            'power_windows' => $request->has('power_windows'),
            'gps_navigation' => $request->has('gps'),
            'power_door_locks' => $request->has('power_door_locks'),
            'heater_seats' => $request->has('heater_seats'),
            'abs' => $request->has('abs'),
            'climate_control' => $request->has('climate_control'),
            'cruise_control' => $request->has('cruise_control'),
            'bluetooth_connectivity' => $request->has('bluetooth'),
            'leather_seats' => $request->has('leather_seats'),
            'remote_start' => $request->has('remote_start'),
            'rear_parking_sensors' => $request->has('rear_parking_sensors')
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('car_images', 'public'); // Still stores in car_images/
                $filename = basename($path); // This gives just the filename part
        
                $car->images()->create([
                    'image_path' => $filename, // Now stores only the filename
                    'position' => $index + 1,
                ]);
            }
        }
        

        return redirect()->route('car.index')->with('success', 'Car added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::with(['primaryImage', 'makers', 'models', 'region', 'city', 'fuelType', 'carType'])->findOrFail($id);
        
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $makers = Maker::all();
        $regions = Region::all();
        $car_types = CarType::all();
        $fuel_types = FuelType::all();
        return view("cars.edit", compact('car','makers','regions', 'car_types', 'fuel_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'maker_id' => ['required','exists:makers,id'],
            'model_id' => ['required','exists:models,id'],
            'year' => ['required','integer'],
            'car_type' => ['required','exists:car_types,id'],
            'fuel_type_id' => ['required','exists:fuel_types,id'],
            'region_id' => ['required','exists:regions,id'],
            'city_id' => ['required','exists:cities,id'],
            'price' => ['required','integer'],
            'vin' => ['required','integer'],
            'mileage' => ['required','integer'],
            'address' => ['required','string', 'max:255'],
            'phone' => ['required', 'regex:/^09\d{9}$/'],
            'description' => ['nullable', 'string'],
            'publishDate' => ['date'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,PNG', 'max:2048'],
        ]);

        
        $car->update([
            'maker_id' => $request->input('maker_id'),
            'model_id' => $request->input('model_id'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'vin' => $request->input('vin'),
            'mileage' => $request->input('mileage'),
            'car_type_id' => $request->input('car_type'),
            'fuel_type_id' => $request->input('fuel_type_id'),
            'user_id' => auth()->id(),
            'region_id' => $request->input('region_id'),
            'city_id' => $request->input('city_id'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description') ?? null,
            'published_at' => $request->input('publishDate'),
        ]);

        $car->features()->update([
            'air_conditioning' => $request->has('air_conditioning'),
            'power_windows' => $request->has('power_windows'),
            'gps_navigation' => $request->has('gps'),
            'power_door_locks' => $request->has('power_door_locks'),
            'heater_seats' => $request->has('heater_seats'),
            'abs' => $request->has('abs'),
            'climate_control' => $request->has('climate_control'),
            'cruise_control' => $request->has('cruise_control'),
            'bluetooth_connectivity' => $request->has('bluetooth'),
            'leather_seats' => $request->has('leather_seats'),
            'remote_start' => $request->has('remote_start'),
            'rear_parking_sensors' => $request->has('rear_parking_sensors')
        ]);

        if ($request->hasFile('images')) {
            foreach ($car->images as $image) {
                $oldPath = storage_path('app/public/car_images/' . $image->image_path);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
                $image->delete(); // remove from DB
            }

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('car_images', 'public');
                $filename = basename($path);
        
                $car->images()->create([
                    'image_path' => $filename, // Now stores only the filename
                    'position' => $index + 1,
                ]);
            }
        }
        

        return redirect()->route('car.index')->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('car.index')->with('success', 'Car deleted successfully');
    }

    public function search(Request $request)
    {
        $cars = Car::all();
        $makers = Maker::all();
        $car_types = CarType::all();
        $regions = Region::all();
        $fuel_types = FuelType::all();
        $makerID = $request->input('maker_id');
        $modelID = $request->input('model_id');
        $car_type = $request->input('car_type');
        $fuel_type = $request->input('fuel_type');
        $yearFrom = $request->input('yearFrom');
        $yearTo = $request->input('yearTo');
        $priceFrom = $request->input('priceFrom');
        $priceTo = $request->input('priceTo');
        $mileage = $request->input('mileage');
        $regionID = $request->input('region_id');
        $cityID = $request->input('city_id');
        $inventory_type = $request->input('inventory_type');

        $query = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'region','makers', 'models', 'fuelType', 'carType'])
            ->when($makerID, function ($query) use ($makerID) {
                return $query->where('maker_id', $makerID);
            })
            ->when($modelID, function($query) use ($modelID) {
                return $query->where('model_id', $modelID);
            })
            ->when($car_type, function($query) use ($car_type) {
                return $query->where('car_type_id', $car_type);
            })
            ->when($fuel_type, function($query) use ($fuel_type) {
                return $query->where('fuel_type_id', $fuel_type);
            })
            ->when($yearFrom, function($query) use ($yearFrom){
                return $query->where('year', '>=', $yearFrom);
            })
            ->when($yearTo, function($query) use ($yearTo){
                return $query->where('year', '<=', $yearTo);
            })
            ->when($priceFrom, function($query) use ($priceFrom){
                return $query->where('price', '>=', $priceFrom);
            })
            ->when($priceTo, function($query) use ($priceTo){
                return $query->where('price', '<=', $priceTo);
            })            
            ->when($regionID, function($query) use ($regionID) {
                return $query->where('region_id', $regionID);
            })
            ->when($cityID, function($query) use ($cityID) {
                return $query->where('city_id', $cityID);
            })
            ->when($mileage, function ($query) use ($mileage) {
                if ($mileage === 'any') {
                    return $query;
                } elseif ($mileage == 10000) {
                    return $query->where('mileage', '<=', 10000);
                } elseif ($mileage == 20000) {
                    return $query->whereBetween('mileage', [10001, 20000]);
                } elseif ($mileage == 30000) {
                    return $query->whereBetween('mileage', [20001, 30000]);
                } elseif ($mileage == 40000) {
                    return $query->whereBetween('mileage', [30001, 40000]);
                } elseif ($mileage == 50000) {
                    return $query->whereBetween('mileage', [40001, 50000]);
                } elseif ($mileage == 60000) {
                    return $query->whereBetween('mileage', [50001, 60000]);
                } elseif ($mileage == 70000) {
                    return $query->whereBetween('mileage', [60001, 70000]);
                } elseif ($mileage == 80000) {
                    return $query->whereBetween('mileage', [70001, 80000]);
                } elseif ($mileage == 90000) {
                    return $query->whereBetween('mileage', [80001, 90000]);
                } elseif ($mileage == 100000) {
                    return $query->whereBetween('mileage', [90001, 100000]);
                } elseif ($mileage == 100001) {
                    return $query->where('mileage', '>=', 100001);
                }
            })
            ->when($inventory_type, function($query) use ($inventory_type){
                if ($inventory_type === 'any') {
                    return $query;
                }elseif($inventory_type === 'used'){
                    return $query->where('inventory_type', 'used');
                }elseif($inventory_type === 'new'){
                    return $query->where('inventory_type', 'new');
                }
            });
            
            if($request->has('carType')){
                $carType = CarType::where('name', $request->carType)->first();

                if($carType){
                    $query->where('car_type_id', $carType->id);
                }
            }

            if($request->has('fuelType')){
                $fuelType = FuelType::where('name', $request->fuelType)->first();

                if($fuelType){
                    $query->where('fuel_type_id', $fuelType->id);
                }
            }
            
            $cars = $query->orderBy('published_at','desc')
                ->paginate(12)
                ->appends($request->query());

        return view("cars.search", compact('cars', 'makers', 'car_types', 'regions', 'fuel_types'));
    }

    public function watchlist()
    {
        $user = auth()->user();

        $cars = $user->favoriteCars()
            ->with(['primaryImage', 'city', 'models', 'makers', 'carType', 'fuelType'])
            ->paginate(12);
        return view('cars.watchlist', compact('cars'));
    }

    public function getModels($makerId)
    {
        $models = Models::where('maker_id', $makerId)->get();
        return response()->json($models);
    }

    public function getCities($regionId)
    {
        $cities = City::where('region_id', $regionId)->get();
        return response()->json($cities);
    }
}
