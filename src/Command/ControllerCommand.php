<?php

namespace Thinker\Command;

use Symfony\Component\Console\Input\ArrayInput;
use Thinker\Create\CreateController;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ControllerCommand extends Command {

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
            ->setName('make:controller')
            //描述
            ->setDescription('创建一个控制器')
            //帮助 --help 中的描述
            ->setHelp("创建一个控制器,比如创建 IndexController.class.php ,参数只需要写 Index;也可以通过[module/controller]的形式")
            //添加参数
            ->addArgument('controller', InputArgument::REQUIRED, '控制器名称.')
            //添加选项
            ->addOption('module', 'm', InputOption::VALUE_OPTIONAL, '模块名称,TP框架采用模块化的设计,可能需要确认控制器生成的模块.', 'Home')
            ->addOption('view', '', InputOption::VALUE_OPTIONAL, '视图目录,启动此选项则在生成控制器的同时添加对应的视图目录.', true);
    }

    //实现 php thinker make:controller Home/TestController 命令

    protected function execute(InputInterface $input, OutputInterface $output) {

        //获取参数与选项
        $arg = $input->getArgument(('controller'));

        if (strpos($arg,'/') !== false){
            list($module,$controller) = explode('/',$arg);
        }else {
            $module = 'Home';
            $controller = $arg;
        }

        //生成控制器文件
        $tpl = new CreateController($this->dir, $module);

        $self = $this;
        $tpl->create($controller, function ($module) use ($self, $output) {
            $cmd  = $self->getApplication()->find('make:module');
            $args = [
                'command'    => 'make:module',
                'moduleName' => $module,
            ];
            $inp  = new ArrayInput($args);
            $cmd->run($inp, $output);
        });
        //生成视图目录
        if ($input->getOption('view')) {
            $tpl->createViewDir($controller);
        }

        //打印成功信息
        $output->writeln('<info>>>>' . $input->getArgument('controller') . 'Controller - 控制器创建成功。</info>');
    }
}