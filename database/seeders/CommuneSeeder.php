<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    public function run(): void
    {
        Wilaya::factory()->count(10)
            ->has(Commune::factory()->count(2))
            ->createQuietly();
    }
}
