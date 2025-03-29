<?php

declare(strict_types=1);

namespace Zeroline\Shared\Infrastructure\Bus\Query;

use Zeroline\Shared\Domain\Bus\Query\Query;
use RuntimeException;

final class QueryNotRegisteredError extends RuntimeException
{
	public function __construct(Query $query)
	{
		$queryClass = $query::class;

		parent::__construct("The query <$queryClass> has no associated query handler");
	}
}
