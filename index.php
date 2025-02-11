<?php

include __DIR__ . '/vendor/autoload.php';

use Discord\Builders\MessageBuilder;
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

// Initialize the bot
$discord->on('init', function (Discord $discord) {
    echo "Bot is ready!", PHP_EOL;

    // Get the guilds the bot is connected to
    foreach ($discord->guilds as $guild) {
        echo "Connected to guild: {$guild->name} (ID: {$guild->id})", PHP_EOL;

        // Find the bot channel in the guild
        $channel = $guild->channels->get('name', 'did-you-nyuw');

        if ($channel) {
            $channel->sendMessage(
                MessageBuilder::new()
                    ->setContent('Hello world')
            );
        } else {
            echo "Channel not found in guild: {$guild->name}", PHP_EOL;
        }
    }
});

$discord->run();
