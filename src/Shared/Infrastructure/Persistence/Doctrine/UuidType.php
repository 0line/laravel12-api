<?php

declare(strict_types=1);

namespace Zeroline\Shared\Infrastructure\Persistence\Doctrine;

use Zeroline\Shared\Domain\Utils;
use Zeroline\Shared\Domain\ValueObject\Uuid;
use Zeroline\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

use function Lambdish\Phunctional\last;

abstract class UuidType extends StringType implements DoctrineCustomType
{
	abstract protected function typeClassName(): string;

	final public static function customTypeName(): string
	{
		return Utils::toSnakeCase(str_replace('Type', '', (string) last(explode('\\', static::class))));
	}

	final public function getName(): string
	{
		return self::customTypeName();
	}

	final public function convertToPHPValue($value, AbstractPlatform $platform): mixed
	{
		$className = $this->typeClassName();

		return new $className($value);
	}

	final public function convertToDatabaseValue($value, AbstractPlatform $platform): string
	{
		/** @var Uuid $value */
		return $value->value();
	}
}
