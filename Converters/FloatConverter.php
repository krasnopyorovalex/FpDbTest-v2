<?php

declare(strict_types=1);

namespace FpDbTest\Converters;

use FpDbTest\Contracts\Converter;

final class FloatConverter extends Converter
{
    public function convert(mixed $value): string
    {
        if (is_null($value)) {
            return self::SQL_NULL;
        }

        return sprintf('%.2f', $value);
    }
}