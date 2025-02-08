<?php

namespace Tests\Unit;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WilayaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_communes(): void
    {
        $wialaya = Wilaya::factory()->create();
        $relatedCommune = Commune::factory()->for($wialaya)->create();
        $unrelatedCommune = Commune::factory()->create();

        $this->assertInstanceOf(Collection::class, $wialaya->communes);
        $this->assertTrue($wialaya->communes->contains($relatedCommune));
        $this->assertFalse($wialaya->communes->contains($unrelatedCommune));

    }
}
