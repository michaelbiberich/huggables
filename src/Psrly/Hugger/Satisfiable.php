<?php

declare(strict_types=1);

namespace Psrly\Huggables\Hugger;

use Psr\Hug\Huggable;
use Psrly\Huggables\Hugger;

final class Satisfiable extends Hugger
{
    private $satisfaction;
    private $satisfactionThreshold;

    public function __construct(
        int $satisfactionThreshold,
        int $hugLimit = 1,
        string $name = ''
    ) {
        self::assertIsValidSatisfactionThreshold($satisfactionThreshold);

        $this->satisfaction = 0;
        $this->satisfactionThreshold = $satisfactionThreshold;

        parent::__construct($hugLimit, $name);
    }

    private static function assertIsValidSatisfactionThreshold(
        int $satisfactionThreshold
    ): void {
        if ($satisfactionThreshold <= 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Satisfaction threshold must be positive integer; %d given',
                    $satisfactionThreshold
                )
            );
        }
    }

    protected function onHuggingBack(Huggable $h): void
    {
        $this->satisfaction ++;
    }

    public function isSatisfied(): bool
    {
        return $this->satisfaction >= $this->satisfactionThreshold;
    }
}
