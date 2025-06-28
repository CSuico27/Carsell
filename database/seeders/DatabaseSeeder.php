<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Models;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        CarType::factory()->sequence(
                ['name' => 'Sedan'],
                ['name' => 'SUV'],
                ['name' => 'Crossover'],
                ['name' => 'Coupe'],
                ['name' => 'Pickup'],
                ['name' => 'Van'],
                ['name' => 'Minivan'],
                ['name' => 'Jeep'],
        )
        ->count(8)
        ->create();

        FuelType::factory()->sequence(
            ['name'=> 'Gasoline'],
            ['name'=> 'Diesel'],
            ['name'=> 'Electric'],
            ['name'=> 'Hybrid']
        )
        ->count(4)
        ->create();

        $regions = [
            'NCR' => [
                'Manila',
                'Quezon City',
                'Makati',
                'Pasig',
                'Taguig',
                'Caloocan',
            ],
            'Region I' => [
                'San Fernando City (La Union)',
                'Dagupan City',
                'Laoag City',
                'Alaminos City',
                'Vigan City',
                'Urdaneta City',
            ],
            'Region II' => [
                'Tuguegarao City',
                'Ilagan City',
                'Cauayan City',
                'Bayombong',
                'Santiago City',
                'Solano',
            ],
            'Region III' => [
                'San Fernando City (Pampanga)',
                'Angeles City',
                'Balanga City',
                'Malolos City',
                'Olongapo City',
                'Cabanatuan City',
            ],
            'CALABARZON' => [
                'Antipolo City',
                'Batangas City',
                'Lucena City',
                'Lipa City',
                'Cavite City',
                'San Pablo City',
            ],
            'MIMAROPA' => [
                'Calapan City',
                'Puerto Princesa City',
                'San Jose (Occ. Mindoro)',
                'Roxas (Palawan)',
                'Boac',
                'Odiongan',
            ],
            'Region V' => [
                'Legazpi City',
                'Naga City',
                'Iriga City',
                'Sorsogon City',
                'Ligao City',
                'Tabaco City',
            ],
            'Region VI' => [
                'Iloilo City',
                'Bacolod City',
                'Roxas City',
                'San Carlos City (Negros Occ.)',
                'Kabankalan City',
                'Passi City',
            ],
            'Region VII' => [
                'Cebu City',
                'Lapu-Lapu City',
                'Mandaue City',
                'Tagbilaran City',
                'Toledo City',
                'Danao City',
            ],
            'Region VIII' => [
                'Tacloban City',
                'Ormoc City',
                'Baybay City',
                'Catbalogan City',
                'Calbayog City',
                'Maasin City',
            ],
        ];

        foreach ($regions as $region => $cities) {
            Region::factory()
            ->state(['name' => $region])
            ->has(
                City::factory()
                ->count(count($cities))
                ->sequence(...array_map(fn($city)=>['name' => $city], $cities))
            )
            ->create();
        }

        $carBrands = [
            'Toyota' => ['Vios', 'Fortuner', 'Hilux', 'Innova', 'Corolla Altis', 'Wigo'],
            'Honda' => ['Civic', 'City', 'CR-V', 'Jazz', 'Brio', 'Accord'],
            'Mitsubishi' => ['Mirage', 'Montero Sport', 'Xpander', 'L300', 'Strada', 'Adventure'],
            'Nissan' => ['Almera', 'Navara', 'Terra', 'Juke', 'X-Trail', 'Patrol'],
            'Ford' => ['Ranger', 'Everest', 'EcoSport', 'Explorer', 'Mustang', 'Escape'],
            'Mazda' => ['Mazda2', 'Mazda3', 'CX-5', 'CX-9', 'BT-50', 'MX-5'],
            'Hyundai' => ['Accent', 'Tucson', 'Starex', 'Kona', 'Santa Fe', 'Elantra'],
            'Kia' => ['Rio', 'Picanto', 'Sportage', 'Sorento', 'Seltos', 'Stonic'],
            'Chevrolet' => ['Trailblazer', 'Spark', 'Sail', 'Suburban', 'Colorado', 'Malibu'],
            'Suzuki' => ['Swift', 'Celerio', 'Dzire', 'Vitara', 'Jimny', 'Ertiga'],
            'Isuzu' => ['D-Max', 'MU-X', 'Crosswind', 'Fuego', 'N-Series', 'Trooper'],
            'BMW' => ['3 Series', '5 Series', '7 Series', 'X1', 'X3', 'X5'],
            'Mercedes-Benz' => ['A-Class', 'C-Class', 'E-Class', 'S-Class', 'GLA', 'GLC'],
            'Volkswagen' => ['Jetta', 'Beetle', 'Tiguan', 'Touareg', 'Golf', 'Polo'],
            'Audi' => ['A3', 'A4', 'A6', 'Q3', 'Q5', 'Q7'],
            'Subaru' => ['Forester', 'Impreza', 'XV', 'Outback', 'Legacy', 'BRZ'],
            'Tesla' => ['Model S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck', 'Roadster'],
        ];

        foreach ($carBrands as $carBrand => $models){
            Maker::factory()
            ->state(['name' => $carBrand])
            ->has(
                Models::factory()
                ->count(count($models))
                ->sequence(...array_map(fn($model) => ['name' => $model], $models))
            )
            ->create();
        }

        User::factory()
        ->count(3)
        ->create();

        User::factory()
        ->count(2)
        ->has(
            Car::factory()
            ->count(50)
            ->has(
                CarImage::factory()
                ->count(5)
                ->sequence(fn (Sequence $sequence) => ['position'=> $sequence->index % 5 + 1]),
                'images'
            )
            ->hasFeatures(),
            'favoriteCars'
        )
        ->create();

    }
}
