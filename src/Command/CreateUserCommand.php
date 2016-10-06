<?php

// src/AppBundle/Command/CreateUserCommand.php
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command {
    /**
     * 配置
     * @author  Kingz Cheung <kingzcheung@gmail.com>
     */
    protected function configure() {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:create-users')
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates new users.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("This command allows you to create users...")
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        // ...
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->writeln('create a user.' . $input->getArgument('username'));
    }
}