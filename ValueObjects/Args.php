<?php

declare(strict_types=1);

namespace FpDbTest\ValueObjects;

final readonly class Args
{
    public const string SKIP = '__SKIP__';

    public function __construct(private array $values)
    {
    }

    public function getByIndex(int $idx): mixed
    {
        if (!isset($this->values[$idx])) {
            throw new \InvalidArgumentException(sprintf('Не существует элемента по индексу %s', $idx));
        }

        return $this->values[$idx];
    }

    public function count(): int
    {
        return count($this->values);
    }

    public function isSkip(int $idx): bool
    {
        return is_array($this->getByIndex($idx))
            ? in_array(self::SKIP, $this->getByIndex($idx))
            : $this->getByIndex($idx) === self::SKIP;
    }

    public function isLast(int $idx): bool
    {
        return $this->count() === $idx + 1;
    }
}