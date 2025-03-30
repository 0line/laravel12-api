<?php

declare(strict_types=1);

namespace Zeroline\Shared\Bus\Command\Infraestructure;

use Illuminate\Bus\Dispatcher;
use Zeroline\Shared\Bus\Command\Domain\Command;
use Zeroline\Shared\Bus\Command\Domain\CommandBus;

final class InMemoryLaravelCommandBus implements CommandBus
{
    public function __construct(protected Dispatcher $bus)
    {
    }

    public function dispatch(Command $command): mixed
    {
        return $this->bus->dispatch($command);
    }

    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
