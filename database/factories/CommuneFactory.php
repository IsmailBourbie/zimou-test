<?php

namespace Database\Factories;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommuneFactory extends Factory
{
    protected $model = Commune::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName(),
            'wilaya_id' => '1', // TODO: update with related model
        ];
    }
}
