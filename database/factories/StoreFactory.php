<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StoreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->lexify('??????????'),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phones' => 0 .mt_rand(550, 780).mt_rand(1000000, 9999999),
            'company_name' => $this->faker->company(),
            'capital' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'register_commerce_number' => $this->faker->numerify('########'),
            'nif' => $this->faker->numerify('################'),
        ];
    }
}
