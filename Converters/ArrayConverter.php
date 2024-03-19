<?php

declare(strict_types=1);

namespace FpDbTest\Converters;

use FpDbTest\Contracts\Converter;

final class ArrayConverter extends Converter
{
    public function __construct(private readonly Converter $converter, string $key = '?')
    {
        parent::__construct($key);
    }

    public function convert(mixed $value): string
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('Ожидаемый тип параметра array');
        }

        $values = array_is_list($value)
            ? $value
            : array_map(
                fn($item, $key) => "`$key` = ".($this->converter->convert($item)),
                $value, array_keys($value)
            );

        return implode(', ', $values);
    }
}