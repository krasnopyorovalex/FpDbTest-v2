<?php

declare(strict_types=1);

namespace FpDbTest\Converters;

use FpDbTest\Contracts\Converter;
use FpDbTest\Enums\AllowedTypes;

final class DefaultConverter extends Converter
{
    public function convert(mixed $value): string
    {
        if (!in_array(gettype($value), array_map(fn($item) => $item->value, AllowedTypes::cases()))) {
            throw new \InvalidArgumentException(sprintf('Тип %s не поддерживается', gettype($value)));
        }

        return sprintf('%s', is_null($value) ? self::SQL_NULL : '\''.$value.'\'');
    }
}