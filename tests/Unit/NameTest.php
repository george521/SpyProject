<?php
namespace Tests\Unit\ValueObjects;

use App\Domain\ValueObjects\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    /** @test */
    public function it_should_return_obj()
    {
        $name = new Name('Joe', 'Bond');

        $this->assertIsObject($name);
    }
}
