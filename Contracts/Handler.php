<?php

declare(strict_types=1);

namespace FpDbTest\Contracts;

interface Handler
{
    public function add(Converter $converter): void;

    public function handle(string $key, mixed $value): string;
}