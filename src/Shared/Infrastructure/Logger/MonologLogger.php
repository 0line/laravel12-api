<?php

declare(strict_types=1);

namespace Zeroline\Shared\Infrastructure\Logger;

use Illuminate\Support\Facades\Log;
use Zeroline\Shared\Domain\Logger;

final readonly class MonologLogger implements Logger
{
    public function __construct(private Log $logger) {}

    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }

    public function critical(string $message, array $context = []): void
    {
        $this->logger->critical($message, $context);
    }
}
