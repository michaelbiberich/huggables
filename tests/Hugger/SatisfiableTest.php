<?php

declare(strict_types=1);

namespace Psrly\Huggables\Tests\Hugger;

use PHPUnit\Framework\TestCase;
use Psrly\Huggables\Hugger;

final class SatisfiableTest extends TestCase
{
    public function testConstructWithNegativeSatisfactionThreshold(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Hugger\Satisfiable(-1);
    }

    public function testConstructWithZeroSatisfactionThreshold(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Hugger\Satisfiable(0);
    }

    public function testIsSatisfied()
    {
        $satisfiableHugger = new Hugger\Satisfiable(2, 1);
        $silentHugger = new Hugger\Silent;

        $this->assertFalse($satisfiableHugger->isSatisfied());

        $satisfiableHugger->hug($silentHugger);

        $this->assertFalse($satisfiableHugger->isSatisfied());

        $satisfiableHugger->hug($silentHugger);

        $this->assertTrue($satisfiableHugger->isSatisfied());
    }
}
