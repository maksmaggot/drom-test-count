#! /usr/local/bin/php -q
<?php

use App\Commands\Command;
use App\Commands\SumCountCommand;

require __DIR__ . '/../vendor/autoload.php';
$commands = ['sum' => SumCountCommand::class];

$options = getopt("c:p:", []);
if (array_key_exists($options['c'], $commands)) {
    /** @var $command Command */
    $command = new $commands[$options['c']];
    $command->execute([$options['p']]);
}