<?php

declare(strict_types=1);

namespace Tests\Unit\Shared\Bus\Command\Infraestructure;

use Illuminate\Bus\Dispatcher;
use Mockery;
use Mockery\MockInterface;
use RuntimeException;
use Tests\TestCase as BaseTestCase;
use Zeroline\Shared\Bus\Command\Domain\Command;
use Zeroline\Shared\Bus\Command\Infraestructure\InMemoryLaravelCommandBus;
use Zeroline\Shared\Bus\Command\Infraestructure\CommandNotRegisteredError;
use Tests\Unit\Shared\Bus\Command\Domain\FakeCommand;

class InMemoryLaravelCommandBusTest extends BaseTestCase
{
    private InMemoryLaravelCommandBus | null $commandBus;
    private Dispatcher | MockInterface $dispatcherMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un mock de Dispatcher
        $this->dispatcherMock = Mockery::mock(Dispatcher::class);

        // Pasar el mock al constructor
        $this->commandBus = new InMemoryLaravelCommandBus($this->dispatcherMock);
    }

    /** @test */
    public function itShouldBeAbleToHandleACommand(): void
    {
        $this->dispatcherMock
            ->shouldReceive('dispatch')
            ->once()
            ->with(Mockery::type(FakeCommand::class))
            ->andThrow(new RuntimeException('This works fine!'));

        $this->expectException(RuntimeException::class);

        $this->commandBus->dispatch(new FakeCommand());
    }

    /** @test */
    public function itShouldRaiseAnExceptionDispatchingANonRegisteredCommand(): void
    {
        $this->dispatcherMock
            ->shouldReceive('dispatch')
            ->once()
            ->with(Mockery::type(Command::class))
            ->andThrow(new CommandNotRegisteredError($this->command()));

        $this->expectException(CommandNotRegisteredError::class);

        $this->commandBus->dispatch($this->command());
    }

    private function command(): Command | MockInterface
    {
        return Mockery::mock(Command::class);
    }
}
