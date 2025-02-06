<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $countPackages = 0;
        $deliveryTypes = DeliveryType::factory()->count(3)->createQuietly()->pluck('id')->all();
        $statuses = PackageStatus::factory()->count(3)->createQuietly()->pluck('id')->all();

        $stores = Store::factory()->count(5000)->raw();
        $storesChunks = array_chunk($stores, 1000);
        foreach ($storesChunks as $chunk) {
            DB::table('stores')->insert($chunk);
        }

        $storesIds = DB::table('stores')->pluck('id');
        $packages = [];
        foreach ($storesIds as $storeId) {
            $packages = array_merge(Package::factory()->count(100)->raw([
                'store_id' => $storeId,
                'status_id' => $statuses[array_rand($statuses)],
                'delivery_type_id' => $deliveryTypes[array_rand($deliveryTypes)],
            ]), $packages);
            if (count($packages) >= 2000) {
                $countPackages += 2000;
                dump('Packages: '.$countPackages.' /500,000');
                DB::table('packages')->insert($packages);
                $packages = [];
            }
        }

    }
}
