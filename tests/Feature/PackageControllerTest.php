<?php

namespace Tests\Feature;

use App\Models\Commune;
use App\Models\DeliveryType;
use App\Models\Package;
use App\Models\PackageStatus;
use App\Models\Store;
use App\Models\User;
use App\Models\Wilaya;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
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
    public function it_render_create_page_with_needed_data(): void
    {
        $statuses = PackageStatus::factory()->count(2)->createQuietly();
        $deliveryTypes = DeliveryType::factory()->count(2)->createQuietly();
        $wilayat = Wilaya::factory()->count(2)->createQuietly();

        $response = $this->actingAs(User::factory()->createOneQuietly())->get(route('packages.create'));

        $response->assertSeeText([...$deliveryTypes->pluck('name'), ...$wilayat->pluck('name')]);
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
            'weight' => '10',
            'extra_weight_price' => 200,
            'packaging_price' => 1000,
            'free_delivery' => false,
            'delivery_price' => 500,
            'price_to_pay' => 2000,
            'total_price' => 4000,
            'partner_return' => 100,
            'return_price' => 100,
            'cod_to_pay' => 100,
            'partner_cod_price' => 100,
            'commission' => 100,
            'can_be_opened' => false,
        ]);

        $response = $this->actingAs(User::factory()->createOneQuietly())->post(route('packages.store'), $package);

        $response->assertRedirect(route('packages.index'));
        $this->assertDatabaseHas('packages', [
            'name' => $package['name'],
            'client_first_name' => $package['client_first_name'],
        ]);

    }

    #[Test]
    #[DataProvider('validInputDataProvider')]
    public function it_require_valid_data_to_store_a_package($input, $inputVal): void
    {
        $package = Package::factory()->raw([$input => $inputVal]);

        $response = $this->actingAs(User::factory()->createOneQuietly())->post(route('packages.store'), $package);

        $response->assertSessionHasErrors($input);
    }

    public static function validInputDataProvider(): array
    {
        return [
            'store id is required' => ['store_id', ''],
            'store id must exists' => ['store_id', 321],

            'delivery type id is required' => ['delivery_type_id', ''],
            'delivery type id must exists' => ['delivery_type_id', 321],

            'commune id is required' => ['commune_id', ''],
            'commune id must exists' => ['commune_id', 321],

            'name must be string' => ['name', 1234],
            'name cant be more than 255' => ['name', Str::random(256)],

            'client_first_name is required' => ['client_first_name', null],
            'client_first_name must be string' => ['client_first_name', 1234],
            'client_first_name must be less than 255' => ['client_first_name', Str::random(256)],

            'client_last_name is required' => ['client_last_name', null],
            'client_last_name must be string' => ['client_last_name', 1234],
            'client_last_name must be less than 255' => ['client_last_name', Str::random(256)],

            'client_phone is required' => ['client_phone', null],
            'client_phone must be string' => ['client_phone', 1234],
            'client_phone2 must be string' => ['client_phone', 1234],


            'address is required' => ['address', null],
            'address must be string' => ['address', 1234],
            'address must be less than 255' => ['address', Str::random(256)],

            'price is required' => ['price', null],
            'price must be number' => ['price', 'hello'],
            'price cant be negative' => ['price', -1],


            'weight is required' => ['weight', null],
            'weight must be number' => ['weight', 'hello'],
            'weight cant be negative' => ['weight', -1],

            'can_be_opened must be boolean' => ['can_be_opened', 'test'],


        ];
    }
}
