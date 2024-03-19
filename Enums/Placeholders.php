<?php

declare(strict_types=1);

namespace FpDbTest\Enums;

enum Placeholders: string
{
    case Int = '?d';
    case Float = '?f';
    case Array = '?a';
    case Id = '?#';
}
