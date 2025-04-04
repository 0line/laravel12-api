<?php

declare(strict_types=1);

namespace Zeroline\Shared\Infrastructure\Bus\Event;

use Zeroline\Shared\Domain\Bus\Event\DomainEvent;

final class DomainEventJsonSerializer
{
	public static function serialize(DomainEvent $domainEvent): string
	{
		return json_encode(
			[
				'data' => [
					'id' => $domainEvent->eventId(),
					'type' => $domainEvent::eventName(),
					'occurred_on' => $domainEvent->occurredOn(),
					'attributes' => array_merge($domainEvent->toPrimitives(), ['id' => $domainEvent->aggregateId()]),
				],
				'meta' => [],
			]
		);
	}
}
