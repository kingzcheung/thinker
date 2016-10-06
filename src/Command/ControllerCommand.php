<?php

// src/AppBundle/Command/CreateUserCommand.php
namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Template\ClassTemp;
use Template\CreateFile;

class ControllerCommand extends Command {
    /**
     * 配置
     * @author  Kingz Cheung <kingzcheung@gmail.com>
     */
    protected function configure() {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('make:controller')
            // the short description shown while running "php bin/console list"
            ->setDescription('创建一个控制器.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("创建一个控制器...")
            ->addArgument('controller', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        // ...
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            '+-----------------------+',
            ' 创建控制器 ',
            '+-----------------------+',
            '',
        ]);

        // outputs a message without adding a "\n" at the end of the line
        $output->write('<info>你已经成功创建了一个控制器: ');
        $output->writeln($input->getArgument('controller').'</info>');

        $controllername = $input->getArgument(('controller'));

        $output->writeln(CreateFile::create($controllername));
    }
}