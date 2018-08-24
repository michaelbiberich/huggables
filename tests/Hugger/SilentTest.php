<?php

declare(strict_types=1);

namespace Psrly\Huggables\Tests\Hugger;

use PHPUnit\Framework\TestCase;
use Psrly\Huggables\Hugger;

final class SilentTest extends TestCase
{
    public function testNoOutputOnHugging(): void
    {
        $firstHugger = new Hugger\Silent;
        $secondHugger = new Hugger\Silent;

        $firstHugger->hug($secondHugger);

        $this->expectOutputString('');
    }

    public function testNoOutputOnGroupHugging(): void
    {
        $firstHugger = new Hugger\Silent;
        $secondHugger = new Hugger\Silent;
        $thirdHugger = new Hugger\Silent;

        $firstHugger->groupHug([$secondHugger, $thirdHugger]);

        $this->expectOutputString('');
    }
}
