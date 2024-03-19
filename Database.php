<?php

namespace FpDbTest;

use FpDbTest\Enums\Placeholders;
use FpDbTest\Replacers\BlockReplacer;
use FpDbTest\Services\ParserService;
use FpDbTest\ValueObjects\Args;
use FpDbTest\ValueObjects\Pattern;
use FpDbTest\ValueObjects\Query;
use mysqli;

class Database implements DatabaseInterface
{
    private mysqli $mysqli;
    private ParserService $parserService;

    public function __construct(mysqli $mysqli, ParserService $parserService)
    {
        $this->mysqli = $mysqli;
        $this->parserService = $parserService;
    }

    public function buildQuery(string $query, array $args = []): string
    {
        return $this->parserService->parse(
            new Query($query),
            new Args($args),
            new Pattern(Placeholders::cases())
        );
    }

    public function skip(): string
    {
        return Args::SKIP;
    }
}
