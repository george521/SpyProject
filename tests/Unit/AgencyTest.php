<?php

namespace Tests\Unit\ValueObjects;

use App\Domain\ValueObjects\Agency;
use PHPUnit\Framework\TestCase;

class AgencyTest extends TestCase
{
    /** @test */
    public function it_should_return_agency()
    {
        $agency = new Agency('CIA');

        $this->assertIsObject($agency);
    }
}
