<?php

include __DIR__ . '/vendor/autoload.php';

use App\Service\Poster;
use Discord\Discord;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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

// Get the Poster service from the container
$application->register('run')
    ->setCode(function (InputInterface $input, OutputInterface $output): int {

        return Command::SUCCESS;
    });

// $application->add(new GenerateAdminCommand());

// $discord = $containerBuilder->get(Discord::class);

// // Initialize the bot
// $discord->on('init', function (Poster $poster) {
//     $poster->post();
// });

// $discord->run();

$application->run();
