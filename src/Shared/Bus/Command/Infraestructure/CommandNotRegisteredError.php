<?php

declare(strict_types=1);

namespace Zeroline\Shared\Bus\Command\Infraestructure;

use Zeroline\Shared\Bus\Command\Domain\Command;
use RuntimeException;

final class CommandNotRegisteredError extends RuntimeException
{
    public function __construct(Command $command)
    {
        $commandClass = $command::class;

        parent::__construct("The command <$commandClass> hasn't a command handler associated");
    }
}
