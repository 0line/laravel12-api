<?php

declare(strict_types=1);

namespace Zeroline\Shared\Bus\Command\Domain;

interface CommandBus
{
    public function dispatch(Command $command): mixed;

    public function register(array $map): void;
}
