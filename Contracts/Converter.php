<?php

declare(strict_types=1);

namespace FpDbTest\Contracts;

abstract class Converter
{
    protected const string SQL_NULL = 'NULL';

    public function __construct(protected string $key = '?')
    {
    }

    final public function equal(string $key): bool
    {
        return $this->getKey() === $key;
    }

    final public function getKey(): string
    {
        return $this->key;
    }

    abstract public function convert(mixed $value): string;
}