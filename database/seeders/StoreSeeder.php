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

        $deliveryTypes = DeliveryType::factory()->count(3)->createQuietly();
        $statuses = PackageStatus::factory()->count(3)->createQuietly();

        $stores = Store::factory()->count(500)->raw();

        $storesChunks = array_chunk($stores, 100);
        foreach ($storesChunks as $chunk) {
            DB::table('stores')->insert($chunk);
        }

        $storesIds = DB::table('stores')->pluck('id');
        $packages = [];
        foreach ($storesIds as $index => $storeId) {
            for ($j = 1; $j <= 100; $j++) {
                $package = Package::factory()->raw([
                    'store_id' => $storeId,
                    'status_id' => $statuses->random()->id,
                    'delivery_type_id' => $deliveryTypes->random()->id,
                ]);
                $packages[] = $package;
                if ($j * ($index + 1) % 2000 == 0) { // 1000 => 114,465 ms
                    DB::enableQueryLog();
                    DB::table('packages')->insert($packages);
                    dump(count(DB::getQueryLog()));

                    $packages = [];
                }
            }

        }

    }
}
