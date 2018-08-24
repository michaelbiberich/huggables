<?php

declare(strict_types=1);

namespace Psrly\Huggables\Tests\Hugger;

use PHPUnit\Framework\TestCase;
use Psrly\Huggables\Hugger;

final class VerboseTest extends TestCase
{
    public function testOutputOnBeingHugged(): void
    {
        $firstHugger = new Hugger\Verbose;
        $secondHugger = new Hugger\Silent;

        $firstHugger->hug($secondHugger);

        $this->expectOutputString(
            $firstHugger . ' is being hugged by ' . $secondHugger
            . $firstHugger . ' is hugging back ' . $secondHugger
            . $firstHugger . ' is being hugged by ' . $secondHugger
        );
    }

    public function testOutputOnHuggingBack(): void
    {
        $firstHugger = new Hugger\Silent;
        $secondHugger = new Hugger\Verbose;

        $firstHugger->hug($secondHugger);

        $this->expectOutputString(
            $secondHugger . ' is being hugged by ' . $firstHugger
            . $secondHugger . ' is hugging back ' . $firstHugger
        );
    }

    public function testOutputOnHugging(): void
    {
        $firstHugger = new Hugger\Verbose;
        $secondHugger = new Hugger\Verbose;

        $firstHugger->hug($secondHugger);

        $this->expectOutputString(
            $firstHugger . ' is being hugged by ' . $secondHugger
            . $firstHugger . ' is hugging back ' . $secondHugger
            . $secondHugger . ' is being hugged by ' . $firstHugger
            . $secondHugger . ' is hugging back ' . $firstHugger
            . $firstHugger . ' is being hugged by ' . $secondHugger
        );
    }

    public function testOutputOnContinuedHugging(): void
    {
        $firstHugger = new Hugger\Verbose(3);
        $secondHugger = new Hugger\Verbose(3);

        $firstHugger->hug($secondHugger);

        $this->expectOutputString(
            $firstHugger . ' is being hugged by ' . $secondHugger
            . $firstHugger . ' is hugging back ' . $secondHugger
            . $secondHugger . ' is being hugged by ' . $firstHugger
            . $secondHugger . ' is hugging back ' . $firstHugger
            . $firstHugger . ' is being hugged by ' . $secondHugger
            . $firstHugger . ' is hugging back ' . $secondHugger
            . $secondHugger . ' is being hugged by ' . $firstHugger
            . $secondHugger . ' is hugging back ' . $firstHugger
            . $firstHugger . ' is being hugged by ' . $secondHugger
            . $firstHugger . ' is hugging back ' . $secondHugger
            . $secondHugger . ' is being hugged by ' . $firstHugger
            . $secondHugger . ' is hugging back ' . $firstHugger
            . $firstHugger . ' is being hugged by ' . $secondHugger
        );
    }

    public function testOutputOnBeingGroupHugged(): void
    {
        $firstHugger = new Hugger\Verbose;
        $secondHugger = new Hugger\Silent;
        $thirdHugger = new Hugger\Silent;

        $firstHugger->groupHug([$secondHugger, $thirdHugger]);

        $this->expectOutputString(
            $firstHugger . ' is being hugged by ' . $secondHugger
            . $firstHugger . ' is hugging back ' . $secondHugger
            . $firstHugger . ' is being hugged by ' . $thirdHugger
            . $firstHugger . ' is hugging back ' . $thirdHugger
        );
    }
}
