<?php

namespace Database\Factories;

use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
        'tracking_code' => $this->faker->unique()->bothify('##??##?#?##?#??'),
        'commune_id' => '1', // TODO: update that with related model
        'delivery_type_id' => DeliveryType::factory()->create(), // TODO: Update that with related model
        'status_id' => PackageStatus::factory()->create(), // TODO: Update that with related model
        'store_id' => Store::factory()->create(),
        'address' => $this->faker->address,
        'name' => $this->faker->name,
        'client_first_name' => $this->faker->firstName,
        'client_last_name' => $this->faker->lastName,
        'client_phone' => $this->faker->phoneNumber,
        'delivery_price' => $this->faker->randomFloat(2, 100, 1000),
        'free_delivery' => $this->faker->boolean,
        'partner_delivery_price' => $this->faker->randomNumber(2),
        'price' => $this->faker->randomFloat(2, 500, 10_000),
        'price_to_pay' => $this->faker->randomFloat(2, 500, 10_000),
        'total_price' => $this->faker->randomFloat(2, 500, 10_000),
        ];
    }
}
