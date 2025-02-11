<?php

namespace Tests\Feature;

use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PackageControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_only_authenticated_can_list_packages(): void
    {
        $this->get(route('packages.index'))->assertRedirectToRoute('login');
    }

    #[Test]
    public function it_render_package_page_with_data(): void
    {
        $packages = Package::factory()->count(3)->create();

        $response = $this->actingAs(User::factory()->createOneQuietly())->get(route('packages.index'));

        $response->assertSuccessful()
            ->assertViewIs('packages.index')
            ->assertViewHas('packages')
            ->assertSeeText($packages->pluck('name')->all());


    }

    #[Test]
    public function it_render_packages_with_paginate(): void
    {
        $packages = Package::factory()->count(11)->create();

        $response = $this->actingAs(User::factory()->createOneQuietly())->get(route('packages.index'));

        $response->assertSeeText([$packages->get(0)->name, $packages->get(9)->name]);
        $response->assertDontSeeText($packages->get(10)->name);

    }

    #[Test]
    public function it_render_create_page(): void
    {
        $response = $this->actingAs(User::factory()->createOneQuietly())->get(route('packages.create'));

        $response->assertSuccessful();
    }

    #[Test]
    public function it_store_new_package(): void
    {
        $this->withoutExceptionHandling();
        $store = Store::factory()->createOneQuietly();
        $status = PackageStatus::factory()->createOneQuietly();
        $deliveryType = DeliveryType::factory()->createOneQuietly();
        $commune = Commune::factory()->createOneQuietly();

        $package = Package::factory()->raw([
            'store_id' => $store->id,
            'status_id' => $status->id,
            'delivery_type_id' => $deliveryType->id,
            'commune_id' => $commune->id,
        ]);

        $response = $this->actingAs(User::factory()->createOneQuietly())->post(route('packages.store'), $package);

        $response->assertRedirect(route('packages.index'));
        $this->assertDatabaseHas('packages', $package);

    }
}
