<?php

namespace Database\Factories;

use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {

        $client_first_name = $this->faker->firstName();
        $client_last_name = $this->faker->lastName();

        $free_delivery = rand(0, 1);

        if ($free_delivery) {
            $delivery_price = 0;
            $partner_delivery_price = 0;
        } else {
            $delivery_price = rand(100, 1000);
            $partner_delivery_price = rand(100, 500);
        }

        $price = rand(100, 10_000);
        $total_price = $price + $delivery_price + $partner_delivery_price;

        return [
            'uuid' => (string) Str::uuid(),
            'tracking_code' => $this->faker->unique()->lexify('??????????'),
            'commune_id' => '1', // TODO: update that with related model
            'delivery_type_id' => fn() => DeliveryType::factory(),
            'status_id' => fn() => PackageStatus::factory(),
            'store_id' => fn() => Store::factory(),
            'address' => $this->faker->streetAddress(),
            'name' => $client_first_name.' '.$client_last_name,
            'client_first_name' => $client_first_name,
            'client_last_name' => $client_last_name,
            'client_phone' => 0 .rand(550, 780).rand(1000000, 9999999),
            'free_delivery' => (bool) $free_delivery,
            'delivery_price' => $delivery_price,
            'partner_delivery_price' => $partner_delivery_price,
            'price' => $price,
            'price_to_pay' => $total_price,
            'total_price' => $total_price,
        ];
    }
}
