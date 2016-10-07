<?php

namespace Thinker\Command;

use Symfony\Component\Console\Input\InputOption;
use Thinker\Create\CreateController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thinker\Create\CreateModel;


class ModelCommand extends Command {

    /**
     * 命令文件目录
     * @var null|string
     */
    private $dir;

    public function __construct($dir) {
        parent::__construct();
        $this->dir = $dir;
    }

    protected function configure() {
        $this
            //设置命令名称
            ->setName('make:model')
            //描述
            ->setDescription('创建一个模型类')
            //帮助 --help 中的描述
            ->setHelp("创建一个模型类,比如创建 ArticleModel.class.php,参数为 Article")
            //添加参数
            ->addArgument('model', InputArgument::REQUIRED, '模型类名称.')
            //添加选项
            ->addOption('module', 'm', InputOption::VALUE_OPTIONAL, '模块名称,TP框架采用模块化的设计,可能需要确认控制器生成的模块.', 'Home');
    }


    protected function execute(InputInterface $input, OutputInterface $output) {

        //获取参数与选项
        $controllername = $input->getArgument(('model'));
        $module = $input->getOption('module');

        //生成控制器文件
        $tpl = new CreateModel($this->dir, $module);
        $tpl->create($controllername);

        //打印成功信息
        $output->writeln('<info>>>>' . $input->getArgument('model') . 'Model - 模型类创建成功</info>');
        //$output->writeln($input->getOption('module'));
    }
}