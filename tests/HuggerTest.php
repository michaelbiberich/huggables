<?php

declare(strict_types=1);

namespace Psrly\Huggables\Tests;

use PHPUnit\Framework\TestCase;
use Psrly\Huggables\Hugger;

final class HuggerTest extends TestCase
{
    public function testConstructWithNegativeHugLimit(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Hugger\Silent(-1);
    }

    public function testConstructWithZeroHugLimit(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Hugger\Silent(0);
    }

    public function testToStringWithDefaultName(): void
    {
        $hugger = new Hugger\Silent;

        $this->assertEquals(
            spl_object_id($hugger) . ' (' . spl_object_hash($hugger) . ')',
            (string)$hugger
        );
    }

    public function testToStringWithCustomName(): void
    {
        $this->assertEquals(
            'John Doe',
            (string)(new Hugger\Silent(1, 'John Doe'))
        );

        $this->assertEquals(
            'Jane Roe',
            (string)(new Hugger\Silent(1, 'Jane Roe'))
        );
    }
}
