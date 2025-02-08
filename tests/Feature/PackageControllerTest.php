<?php

namespace Tests\Feature;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PackageControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_render_package_page_with_data(): void
    {
        $packages = Package::factory()->count(3)->create();

        $response = $this->get(route('packages.index'));

        $response->assertSuccessful()
            ->assertViewIs('packages.index')
            ->assertViewHas('packages')
            ->assertSeeText($packages->pluck('name')->all());


   }
}
