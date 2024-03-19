<?php

declare(strict_types=1);

namespace FpDbTest\Replacers;

use FpDbTest\Contracts\Replacer;
use FpDbTest\DataTransferObjects\ReplaceData;

final class PlaceholderReplacer implements Replacer
{
    private const string PATTERN = '/(\%s)/';

    public function replace(ReplaceData $data): string
    {
        $pattern = sprintf(self::PATTERN, $data->placeholder);

        return preg_replace($pattern, $data->value, $data->sql, 1);
    }
}