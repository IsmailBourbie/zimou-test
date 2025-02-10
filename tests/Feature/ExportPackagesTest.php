<?php

namespace Tests\Feature;

use App\Jobs\PackagesExport;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExportPackagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

    #[Test]
    public function it_export_packages_to_csv(): void
    {
        $packages = Package::factory()->count(3)->createQuietly();
        $response = $this->get(route('packages.export'));
        $response->assertOk();
        Queue::assertPushed(PackagesExport::class);
    }
}
