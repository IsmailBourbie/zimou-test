<?php

namespace Database\Seeders;

use App\Models\PackageStatus;
use Illuminate\Database\Seeder;

class PackageStatusSeeder extends Seeder
{
    public function run(): void
    {
        PackageStatus::factory()->count(3)->createQuietly();
    }
}
