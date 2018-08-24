# PSR-8 Huggables _(psrly/huggables)_

> PSR-8 compliant implementation of Huggable Interfaces

## Install

```sh
composer require psrly/huggables ^1
```

## Usage

### Using existing Hugger implementations

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Psrly\Hugger;

// all hugger implementations can be given an optional hug limit and name

// simple silent hugger (no side effects, no state change)
$silent = new Hugger\Silent;

// simple verbose hugger (writes to output on hugging)
$verbose = new Hugger\Verbose;

$verbose->hug($silent);
// -> "X is being hugged by Y"
// -> "X is hugging back Y"

// simple satisfiable hugger (increments satisfaction on hugging)
$satisfactionThreshold = 3; // satisfied after hugging three times
$satisfiable = Satisfiable($satisfactionThreshold);

// hugged 0 times = not satisfied 
$satisfiable->isSatisfied(); // false

$satisfiable->hug($silent);

// hugged 1 time = not satisfied
$satisfiable->isSatisfied(); // false

$satisfiable->hug($silent);
$satisfiable->hug($silent);

// hugged 3 times = satisfied
$satisfiable->isSatisfied(); // false
```

### Creating your own Hugger implementation

```php
<?php

use Psrly\Hugger;

final class MyHugger extends Hugger
{
    protected function onBeingHuggedBy(Huggable $h): void
    {
        // change state / cause side effects on being hugged
    }

    protected function onHuggingBack(Huggable $h): void
    {
        // change state / cause side effects on hugging back
    }
}
```
