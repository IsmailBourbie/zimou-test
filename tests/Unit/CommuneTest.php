<?php

namespace Tests\Unit;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CommuneTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_belongs_to_wilaya(): void
    {
        $wilaya = Wilaya::factory()->create();
        $commune = Commune::factory()->create(['wilaya_id' => $wilaya]);

        $this->assertInstanceOf(Wilaya::class, $commune->wilaya);
        $this->assertEquals($wilaya->id, $commune->wilaya->id);

    }
}
