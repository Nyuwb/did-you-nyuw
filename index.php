<?php

include __DIR__ . '/vendor/autoload.php';

use Discord\Discord;
use Service\Poster;
use Symfony\Component\Dotenv\Dotenv;

// Load environment variables
$dotenv = new Dotenv();
$dotenv
    ->usePutenv()
    ->load(__DIR__ . '/.env');

// Include the container setup
$containerBuilder = include __DIR__ . '/bootstrap.php';

// Get the Poster service from the container
$discord = $containerBuilder->get(Discord::class);
$poster = $containerBuilder->get(Poster::class);

// Initialize the bot
$discord->on('init', [$poster, 'post']);

$discord->run();
