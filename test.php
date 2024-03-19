<?php

use FpDbTest\Replacers\BlockReplacer;
use FpDbTest\ConverterHandler;
use FpDbTest\Converters\ArrayConverter;
use FpDbTest\Converters\DefaultConverter;
use FpDbTest\Converters\FloatConverter;
use FpDbTest\Converters\IdConverter;
use FpDbTest\Converters\IntConverter;
use FpDbTest\Database;
use FpDbTest\DatabaseTest;
use FpDbTest\Enums\Placeholders;
use FpDbTest\Services\ParserService;
use FpDbTest\Replacers\PlaceholderReplacer;

spl_autoload_register(function ($class) {
    $a = array_slice(explode('\\', $class), 1);
    if (!$a) {
        throw new Exception();
    }
    $filename = implode('/', [__DIR__, ...$a]) . '.php';
    require_once $filename;
});

$mysqli = @new mysqli('mysql', 'root', 'password', 'fpdb-test', 3306);
if ($mysqli->connect_errno) {
    throw new Exception($mysqli->connect_error);
}

$converterHandler = new ConverterHandler();
$defaultConverter = new DefaultConverter();
$converterHandler->add(new IntConverter(Placeholders::Int->value));
$converterHandler->add(new IdConverter(Placeholders::Id->value));
$converterHandler->add(new FloatConverter(Placeholders::Float->value));
$converterHandler->add(new ArrayConverter($defaultConverter, Placeholders::Array->value));
$converterHandler->add($defaultConverter);

$parserService = new ParserService(
    $converterHandler,
    new PlaceholderReplacer(),
    new BlockReplacer()
);

$db = new Database($mysqli, $parserService);
$test = new DatabaseTest($db);

$test->testBuildQuery();

exit('OK');
