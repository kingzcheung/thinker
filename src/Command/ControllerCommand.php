<?php

// src/AppBundle/Command/CreateUserCommand.php
namespace Thinker\Command;

use Symfony\Component\Console\Input\InputOption;
use Thinker\Create\CreateController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ControllerCommand extends Command {

    private $dir;

    public function __construct($dir) {
        parent::__construct();

        $this->dir = $dir;
    }

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
            ->setHelp("创建一个控制器.")
            ->addArgument('controller', InputArgument::REQUIRED, '控制器名称.')
            ->addOption('module', 'N', InputOption::VALUE_OPTIONAL, '模块名称,TP框架采用模块化的设计,可能需要确认控制器生成的模块.', 'Home');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $controllername = $input->getArgument(('controller'));
        $module = $input->getOption('module');

        $tpl = new CreateController($this->dir, $module);
        $tpl->create($controllername);

        $output->writeln('<info>>>>' . $input->getArgument('controller') . ' - 控制器创建成功。</info>');
        $output->writeln($input->getOption('module'));
    }
}