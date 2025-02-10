<?php

namespace Tests\Feature;

use App\Jobs\PackagesExport;
use App\Models\Package;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use function Symfony\Component\String\s;

class ExportPackagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Queue::fake();
        Storage::fake('local');
    }

    #[Test]
    public function it_export_packages_to_csv(): void
    {
        $this->withoutExceptionHandling();
        config(['queue.default' => 'sync']);
        $packages = Package::factory()->count(3)->createQuietly();
        $user = User::factory()->createOneQuietly();
        $response = $this->actingAs($user)->get(route('packages.export'));
        $response->assertOk();

        Queue::assertPushed(PackagesExport::class, function ($job) use ($user) {
            $this->assertMatchesRegularExpression('/^packages_\d{4}-\d{2}-\d{2}-\d{6}_[a-zA-Z0-9]{8}\.csv$/', $job->filename);
            return true;
        });

    }
}
