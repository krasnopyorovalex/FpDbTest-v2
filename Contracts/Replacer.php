<?php

declare(strict_types=1);

namespace FpDbTest\Contracts;

use FpDbTest\DataTransferObjects\ReplaceData;

interface Replacer
{
    public function replace(ReplaceData $data): string;
}