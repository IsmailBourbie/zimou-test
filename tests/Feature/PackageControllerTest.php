<?php

namespace Tests\Feature;

use App\Models\Package;
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
}
