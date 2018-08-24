<?php

declare(strict_types=1);

namespace Psrly\Huggables\Hugger;

use Psr\Hug\Huggable;
use Psrly\Huggables\Hugger;

final class Verbose extends Hugger
{
    protected function onBeingHuggedBy(Huggable $h): void
    {
        printf('%s is being hugged by %s', $this, $h);
    }

    protected function onHuggingBack(Huggable $h): void
    {
        printf('%s is hugging back %s', $this, $h);
    }
}
