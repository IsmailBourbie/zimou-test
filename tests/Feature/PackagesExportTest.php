<?php

namespace Tests\Feature;

use App\Jobs\PackagesExport;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PackagesExportTest extends TestCase
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
        $user = User::factory()->createOneQuietly();
        $response = $this->actingAs($user)->get(route('packages.export'));

        $response->assertRedirectToRoute('packages.index');
        Queue::assertPushed(PackagesExport::class, function ($job) use ($user) {
            $this->assertMatchesRegularExpression('/^packages_\d{4}-\d{2}-\d{2}-\d{6}_[a-zA-Z0-9]{8}\.csv$/',
                $job->filename);

            return true;
        });

    }

    #[Test]
    public function it_download_exported_csv_file(): void
    {
        $this->withoutExceptionHandling();
        Storage::disk('local')->put('exports/packages/test.csv', 'hello world');
        $downloadUrl = URL::signedRoute(
            'exports.download',
            ['filename' => 'test.csv'],
            now()->hours(24),
        );

        $this->actingAs(User::factory()->createOneQuietly())->get($downloadUrl)
            ->assertDownload();

    }
}
