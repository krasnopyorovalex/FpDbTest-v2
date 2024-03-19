<?php

declare(strict_types=1);

namespace FpDbTest\DataTransferObjects;

readonly class ReplaceData
{
    public function __construct(
        public string $sql,
        public string $placeholder,
        public string $value,
        public bool $isSkip = false,
        public bool $isLastArg = false
    ) {
    }
}