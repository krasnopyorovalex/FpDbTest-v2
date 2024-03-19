<?php

declare(strict_types=1);

namespace FpDbTest\Replacers;

use DomainException;
use FpDbTest\Contracts\Replacer;
use FpDbTest\DataTransferObjects\ReplaceData;

final class BlockReplacer implements Replacer
{
    private const string PATTERN = '/%s([^%s]*)%s/';

    private const array TAGS = [
        'start' => '{',
        'end' => '}'
    ];

    public function replace(ReplaceData $data): string
    {
        if (!str_contains($data->sql, self::TAGS['start'])) {
            return $data->sql;
        }

        $pattern = sprintf(self::PATTERN, self::TAGS['start'], self::TAGS['end'], self::TAGS['end']);

        $sql = $data->sql;
        if ($data->isSkip) {
            $sql = preg_replace($pattern, '', $sql);
        }

        if ($data->isLastArg) {
            $sql = preg_replace($pattern, '$1', $sql);

            if (str_contains($sql, self::TAGS['start'])) {
                throw new DomainException('Условные блоки не могут быть вложенными');
            }
        }

        return $sql;
    }
}