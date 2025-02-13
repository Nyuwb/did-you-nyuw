<?php

namespace App\Command;

use Discord\Discord;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'bot:start')]
class BotStartCommand extends Command
{
    public function __construct(
        private Discord $discord
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Bot started!');

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
