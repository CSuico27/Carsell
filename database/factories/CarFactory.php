<?php

namespace Database\Factories;

use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Models;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maker_id' => Maker::inRandomOrder()->first()->id,
            'model_id' => function (array $attributes) {
                return Models::where('id', $attributes['maker_id'])
                ->inRandomOrder()->first()->id;
            },
            'year' => fake()->year(),
            'price' => ((int)fake()->randomFloat(2, 5, 100)) * 10000,
            'vin' => strtoupper(Str::random(17)),
            'mileage' => ((int)fake()->randomFloat(2, 5, 500)) * 1000,
            'inventory_type' => fake()->randomElement(['Used', 'New']),
            'car_type_id' => CarType::inRandomOrder()->first()->id,
            'fuel_type_id' => FuelType::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'region_id' => Region::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'address' => fake()->address(),
            'phone' => function(array $attributes) {
                return User::find($attributes['user_id'])->phone;
            },
            'description' => fake()->text(500),
            'published_at' => fake()->optional(0.9)->dateTimeBetween('-1 month', '+1 day')
        ];
    }
}
