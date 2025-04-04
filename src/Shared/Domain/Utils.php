<?php

declare(strict_types=1);

namespace Zeroline\Shared\Domain;

use DateTimeImmutable;
use DateTimeInterface;

use function Lambdish\Phunctional\filter;

final class Utils
{
    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    public static function stringToDate(string $date): DateTimeImmutable
    {
        return new DateTimeImmutable($date);
    }

    public static function jsonEncode(array $values): string
    {
        return json_encode($values, JSON_THROW_ON_ERROR);
    }

    public static function jsonDecode(string $json): array
    {
        return json_decode($json, true, flags: JSON_THROW_ON_ERROR);
    }

    public static function toSnakeCase(string $text): string
    {
        return ctype_lower($text) ? $text : strtolower((string) preg_replace('/([^A-Z\s])([A-Z])/', '$1_$2', $text));
    }

    public static function toCamelCase(string $text): string
    {
        return lcfirst(str_replace('_', '', ucwords($text, '_')));
    }

    public static function dot(array $array, string $prepend = ''): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, self::dot($value, $prepend . $key . '.'));
            } else {
                $results[$prepend . $key] = $value;
            }
        }

        return $results;
    }

    public static function filesIn(string $path, string $fileType): array
    {
        /* return filter(
            scandir($path),
            static fn(string $possibleModule): bool => strstr($possibleModule, $fileType) !== false
        ); */
        $scanned = scandir($path);
        return array_values(array_filter(
            $scanned,
            static fn(string $possibleModule): bool => strstr($possibleModule, $fileType) !== false
        ));
    }

    public static function iterableToArray(iterable $iterable): array
    {
        if (is_array($iterable)) {
            return $iterable;
        }

        return iterator_to_array($iterable);
    }
}
