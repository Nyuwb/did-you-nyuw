<?php

include __DIR__ . '/vendor/autoload.php';

use App\Command\BotStartCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

// Create a new console application
$application = new Application();

// Load environment variables
$dotenv = new Dotenv();
$dotenv
    ->usePutenv()
    ->load(__DIR__ . '/.env');

// Include the container setup
$containerBuilder = include __DIR__ . '/bootstrap.php';

// Add the commands
$application->add($containerBuilder->get(BotStartCommand::class));

// $application->add(new GenerateAdminCommand());

// $discord = $containerBuilder->get(Discord::class);

// // Initialize the bot
// $discord->on('init', function (Poster $poster) {
//     $poster->post();
// });

// $discord->run();

$application->run();
