<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\NewGameCommand;

$game = new Application();
$game->add(new NewGameCommand());
$game->run();
