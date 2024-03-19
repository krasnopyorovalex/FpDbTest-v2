<?php

declare(strict_types=1);

namespace FpDbTest\Enums;

enum AllowedTypes: string
{
    case String = 'string';
    case Int = 'integer';
    case Float = 'double';
    case Bool = 'boolean';
    case Null = 'NULL';
}
