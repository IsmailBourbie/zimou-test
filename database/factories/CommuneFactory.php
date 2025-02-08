<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommuneFactory extends Factory
{
    protected $model = Commune::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName(),
            'wilaya_id' => fn() => Wilaya::factory(), // TODO: update with related model
        ];
    }
}
