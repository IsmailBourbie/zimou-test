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

        $deliveryTypesIds = DB::table('delivery_types')->pluck('id')->all();
        $statusesIds = DB::table('package_statuses')->pluck('id')->all();
        $communesIds = DB::table('communes')->pluck('id')->all();

        $packages = [];
        $total = 0;
        foreach (DB::table('stores')->pluck('id') as $storeId) {
            array_push($packages, ...Package::factory()->count(100)->raw([
                'store_id' => $storeId,
                'commune_id' => $communesIds[array_rand($communesIds)],
                'status_id' => $statusesIds[array_rand($statusesIds)],
                'delivery_type_id' => $deliveryTypesIds[array_rand($deliveryTypesIds)],
            ]));
            if (count($packages) >= 2000) {
                $total += count($packages);
                dump($total.'/500000');
                DB::table('packages')->insert($packages);
                $packages = [];
            }
        }

    }
}
