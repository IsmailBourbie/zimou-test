<?php

namespace Database\Factories;

use App\Models\PackageStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PackageStatusFactory extends Factory
{
    protected $model = PackageStatus::class;

    public function definition(): array
    {
        return [
           'name' => $this->faker->name(),
        ];
    }
}
