<?php

namespace Thinker\Command;

use Symfony\Component\Console\Input\ArrayInput;
use Thinker\Create\Controller;
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
            ->addArgument('controller', InputArgument::REQUIRED, '控制器名称.');
    }

    //实现 php thinker make:controller Home/TestController 命令

    protected function execute(InputInterface $input, OutputInterface $output) {

        //获取参数与选项
        $arg = $input->getArgument(('controller'));

        //生成控制器文件
        $contrl = new Controller($this->dir, $arg);
        list($result, $msg) = $contrl->create();
        if (!$result) {
            $output->writeln('<error>' . $msg . '</error>');
            return;
        }
        //生成视图目录
        $contrl->createView();

        //打印成功信息
        $output->writeln('<info>>>>' . $input->getArgument('controller') . ' - 控制器创建成功。</info>');
    }


}