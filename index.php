<?php

include __DIR__ . '/vendor/autoload.php';

use DidYouNyuw\Poster;
use Discord\Discord;
use Discord\WebSockets\Intents;
use Symfony\Component\Dotenv\Dotenv;

// Load environment variables
$dotenv = new Dotenv();
$dotenv
    ->usePutenv()
    ->load(__DIR__ . '/.env');

// Create a new Discord instance
$discord = new Discord([
    'token' => getenv('DISCORD_TOKEN'),
    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
]);

// Create an instance of the Poster service
$poster = new Poster($discord);

// Initialize the bot
$discord->on('init', [$poster, 'post']);

$discord->run();
