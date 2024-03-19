<?php

declare(strict_types=1);

namespace FpDbTest\Services;

use FpDbTest\Contracts\Handler;
use FpDbTest\Contracts\Replacer;
use FpDbTest\DataTransferObjects\ReplaceData;
use FpDbTest\ValueObjects\Args;
use FpDbTest\ValueObjects\Pattern;
use FpDbTest\ValueObjects\Query;

final readonly class ParserService
{
    public function __construct(
        private Handler $handler,
        private Replacer $placeholderReplacer,
        private Replacer $blockReplacer
    ) {
    }

    public function parse(Query $query, Args $args, Pattern $pattern): string
    {
        if (!($matchCount = preg_match_all($pattern->getValue(), $query->getValue(), $matches))) {
            return $query->getValue();
        }

        if ($matchCount !== $args->count()) {
            throw new \InvalidArgumentException('Количество спецификаторов и переданных параметров разное');
        }

        foreach ($matches[0] as $idx => $placeholder) {
            $value = $this->handler->handle($placeholder, $args->getByIndex($idx));

            $query->setValue(
                $this->blockReplacer->replace(
                    new ReplaceData($query->getValue(), $placeholder, $value, $args->isSkip($idx), $args->isLast($idx))
                )
            );

            $query->setValue(
                $this->placeholderReplacer->replace(
                    new ReplaceData($query->getValue(), $placeholder, $value)
                )
            );
        }

        return $query->getValue();
    }
}