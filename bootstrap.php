<?php

use Discord\Discord;
use Discord\WebSockets\Intents;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

// Set up the Dependency Injection container
$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yaml');

// Register the Discord instance in the container
$containerBuilder->register(Discord::class, Discord::class)
    ->addArgument([
        'token' => getenv('DISCORD_TOKEN'),
        'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
    ])
    ->setPublic(true);

// Compile the container
$containerBuilder->compile();

return $containerBuilder;
