<?php

declare(strict_types=1);

namespace FpDbTest\ValueObjects;

final class Query
{
    public function __construct(private string $query)
    {
    }

    public function getValue(): string
    {
        return $this->query;
    }

    public function setValue(string $query): void
    {
        $this->query = $query;
    }
}