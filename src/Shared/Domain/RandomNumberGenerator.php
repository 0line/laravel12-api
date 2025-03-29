<?php

declare(strict_types=1);

namespace Zeroline\Shared\Domain;

interface RandomNumberGenerator
{
    public function generate(): int;
}
