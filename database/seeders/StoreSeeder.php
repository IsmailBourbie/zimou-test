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
        foreach (array_chunk(Store::factory()->count(5000)->raw(), 1000) as $chunk) {
            DB::table('stores')->insert($chunk);
            unset($chunk);
            gc_collect_cycles();
        }

        $deliveryTypes = DB::table('delivery_types')->pluck('id')->all();
        $statuses = DB::table('package_statuses')->pluck('id')->all();

        $packages = [];
        foreach (DB::table('stores')->pluck('id') as $storeId) {
            array_push($packages, ...Package::factory()->count(100)->raw([
                'store_id' => $storeId,
                'status_id' => $statuses[array_rand($statuses)],
                'delivery_type_id' => $deliveryTypes[array_rand($deliveryTypes)],
            ]));
            if (count($packages) >= 2000) {
                DB::table('packages')->insert($packages);
                $packages = [];
            }
        }

    }
}
