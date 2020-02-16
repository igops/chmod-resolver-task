<?php
declare(strict_types=1);


use Kugaudo\Chmod\ChmodResolver;

require_once 'vendor/autoload.php';

$MODE   = $argv[1] ?? '000';
$WHO    = $argv[2] ?? ChmodResolver::WHO_OWNER;
$OP     = $argv[3] ?? ChmodResolver::OP_READ;

$resolution = (new ChmodResolver())->of((int)$MODE, $WHO, $OP);

if ($resolution->getErrorMessage() !== null) {
    echo $resolution->getErrorMessage() . PHP_EOL;
    exit(1);
}

echo sprintf("[%s] mode matches [%s+%s]: %s", $MODE, $WHO, $OP,
        $resolution->matches() ? 'YES' : 'NO') . PHP_EOL;
exit(0);
