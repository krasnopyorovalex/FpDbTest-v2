<?php

declare(strict_types=1);

namespace FpDbTest;

use FpDbTest\Contracts\Handler;
use FpDbTest\Contracts\Converter;

final class ConverterHandler implements Handler
{
    /**
     * @var array<Converter>
     */
    private array $converters = [];

    public function add(Converter $converter): void
    {
        $this->converters[] = $converter;
    }

    public function handle(string $key, mixed $value): string
    {
        foreach ($this->converters as $converter) {
            if ($converter->equal($key)) {
                return $converter->convert($value);
            }
        }

        throw new \InvalidArgumentException(
            sprintf('Переданный тип %s не поддерживается конвертером', gettype($value))
        );
    }
}