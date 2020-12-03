<?php

declare(strict_types=1);

use App\Console\HelloCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$cli = new Application('Console');

$cli->add(new HelloCommand());

$cli->run();
