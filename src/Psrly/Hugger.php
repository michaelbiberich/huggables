<?php

declare(strict_types=1);

namespace Psrly\Huggables;

use Psr\Hug\{
    GroupHuggable,
    Huggable
};

abstract class Hugger implements GroupHuggable
{
    private $hugLimit;
    private $hugTracker;
    private $name;

    public function __construct(int $hugLimit = 1, string $name = '')
    {
        self::assertIsValidHugLimit($hugLimit);

        $this->hugLimit = $hugLimit;
        $this->hugTracker = new \SplObjectStorage;
        $this->name = $name;
    }

    private static function assertIsValidHugLimit(int $hugLimit): void
    {
        if ($hugLimit <= 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Hug limit must be positive integer; %d given',
                    $hugLimit
                )
            );
        }
    }

    public function groupHug($huggables)
    {
        /** @var \Psr\Hug\Huggable $h*/
        foreach ($huggables as $h) {
            $h->hug($this);
        }
    }

    public function hug(Huggable $h)
    {
        $this->onBeingHuggedBy($h);

        $this->trackHug($h);

        if ($this->hasReachedHugLimit($h)) {
            $this->resetTrackedHugs($h);

            return;
        }

        $this->onHuggingBack($h);

        $this->trackHug($h);

        $h->hug($this);
    }

    protected function onBeingHuggedBy(Huggable $h): void
    {
        // See: https://github.com/php-fig/fig-standards/blob/master/proposed/psr-8-hug/psr-8-hug.md#huggable-objects

        // "An object MAY take additional actions, including modifying state,
        // when hugged.
        // A common example is to increment an internal happiness or
        // satisfaction counter."

        // This method may be overridden by an extending class to implement
        // such behaviour on being hugged by another Huggable.
    }

    protected function onHuggingBack(Huggable $h): void
    {
        // See: https://github.com/php-fig/fig-standards/blob/master/proposed/psr-8-hug/psr-8-hug.md#huggable-objects

        // "An object MAY take additional actions, including modifying state,
        // when hugged.
        // A common example is to increment an internal happiness or
        // satisfaction counter."

        // This method may be overridden by an extending class to implement
        // such behaviour on hugging back another Huggable.
    }

    private function trackHug(Huggable $h): void
    {
        if ( ! isset($this->hugTracker[$h])) {
            $this->hugTracker[$h] = 0;
        }

        $this->hugTracker[$h] += 1;
    }

    private function hasReachedHugLimit(Huggable $h): bool
    {
        return intval(floor($this->hugTracker[$h] / 2)) >= $this->hugLimit;
    }

    private function resetTrackedHugs(Huggable $h): void
    {
        $this->hugTracker[$h] = 0;
    }

    public function __toString(): string
    {
        return $this->name ?: sprintf(
            '%d (%s)',
            spl_object_id($this),
            spl_object_hash($this)
        );
    }
}
