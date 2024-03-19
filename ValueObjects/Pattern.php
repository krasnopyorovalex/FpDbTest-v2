<?php

declare(strict_types=1);

namespace FpDbTest\ValueObjects;

final readonly class Pattern
{
    private string $value;

    public function __construct(array $placeholders)
    {
        $this->value = sprintf('/\?[%s]?/', implode('|', array_map(
                fn($item) => ltrim($item->value, '?'), $placeholders)
            )
        );
    }

    public function getValue(): string
    {
        return $this->value;
    }
}