<?php

namespace Tests\Unit\ValueObjects;

use App\Domain\ValueObjects\DateChecker;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /** @test */
    public function it_should_return_date()
    {
        $date = new DateChecker('2024-31-01');

        $this->assertIsObject($date);
    }
}
