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
            'code' => $this->faker->bothify('##########'),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phones' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'capital' => $this->faker->city,
            'address' => $this->faker->address,
            'register_commerce_number' => $this->faker->numerify('########'),
            'nif' => $this->faker->numerify('################'),
        ];
    }
}
