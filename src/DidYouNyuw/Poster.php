<?php

namespace DidYouNyuw;

use Discord\Builders\MessageBuilder;
use Discord\Discord;
use Psr\Log\LoggerInterface;

class Poster
{
    private LoggerInterface $logger;

    public function __construct(
        private Discord $discord
    ) {
        $this->logger = $discord->getLogger();
    }

    public function post()
    {
        $this->logger->info("Bot is ready!");

        // Get the guilds the bot is connected to
        foreach ($this->discord->guilds as $guild) {
            $this->logger->info("Connected to guild: {$guild->name} (ID: {$guild->id})");

            // Find the bot channel in the guild
            $channel = $guild
                ->channels
                ->get('name', 'did-you-nyuw');

            if ($channel) {
                $channel->sendMessage(
                    MessageBuilder::new()
                        ->setContent('Hello world')
                );
            } else {
                $this->logger->warning("Channel not found in guild: {$guild->name}");
            }
        }
    }
}
