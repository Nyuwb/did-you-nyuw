<?php

namespace App\Command;

use App\Service\Post;
use App\Service\Poster;
use Discord\Discord;
use Discord\WebSockets\Event;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'bot:start')]
class BotStartCommand extends Command
{
    public function __construct(
        #[Autowire(service: Discord::class, lazy: true)]
        private Discord $discord
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->discord->on('init', function () {
            # Update the guilds
            # TODO : Store in a controller ?
            # TODO : Add Symfony bro
            foreach ($this->discord->guilds as $guild) {
                $this->discord->logger->info("Connected to guild: {$guild->name} (ID: {$guild->id})");
            }
        });

        $this->discord->on(Event::MESSAGE_CREATE, function (Poster $poster) {
            $poster->post();
        });

        $this->discord->run();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Start the bot.')
            ->setHelp('This command allows you to start the bot.')
        ;
    }
}
