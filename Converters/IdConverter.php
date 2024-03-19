<?php

declare(strict_types=1);

namespace FpDbTest\Converters;

use FpDbTest\Contracts\Converter;

final class IdConverter extends Converter
{
    public function convert(mixed $value): string
    {
        if (is_array($value)) {
            return implode(', ', array_map(fn($item) => sprintf('`%s`', $item), $value));
        }

        return sprintf('`%s`', $value);
    }
}