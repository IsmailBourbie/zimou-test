<?php

namespace Tests\Unit;

use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PackageTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_one_delivery_type(): void
    {
        $delivery_type = DeliveryType::factory()->create();
        $package = Package::factory()->create(['delivery_type_id' => $delivery_type]);

        $this->assertInstanceOf(DeliveryType::class, $package->deliveryType);
        $this->assertTrue($package->deliveryType->is($delivery_type));

    }

    #[Test]
    public function it_has_one_package_status(): void
    {
        $package_status = PackageStatus::factory()->create();
        $package = Package::factory()->create(['status_id' => $package_status]);

        $this->assertInstanceOf(PackageStatus::class, $package->status);
        $this->assertTrue($package->status->is($package_status));

    }

    #[Test]
    public function it_belongs_to_store(): void
    {
        $store = Store::factory()->create();
        $package = Package::factory()->for($store)->create();

        $this->assertInstanceOf(Store::class, $package->store);
        $this->assertTrue($store->is($package->store));

    }
}
