<?php

declare(strict_types=1);

namespace Tests\Unit\Shared\Bus\Command\Domain;

use RuntimeException;

class FakeCommandHandler
{
    public function __invoke(FakeCommand $command): never
    {
        throw new RuntimeException('This works fine!');
    }
}
