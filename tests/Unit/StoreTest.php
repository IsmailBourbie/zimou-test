<?php

namespace Tests\Unit;

use App\Models\Package;
use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_many_packages(): void
    {
        $store = Store::factory()->create();
        $package = Package::factory()->for($store)->create();
        $otherPackage = Package::factory()->create();

        $this->assertInstanceOf(Collection::class, $store->packages);
        $this->assertTrue($package->is($store->packages->first()));
        $this->assertFalse($otherPackage->is($store->packages->first()));

    }
}
