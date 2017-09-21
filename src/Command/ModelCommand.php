<?php

namespace Thinker\Command;

use Symfony\Component\Console\Input\InputOption;
use Thinker\Create\CreateController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thinker\Create\CreateModel;
use Thinker\Create\Model;


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
            ->addArgument('model', InputArgument::REQUIRED, '模型类名称.');
    }


    protected function execute(InputInterface $input, OutputInterface $output) {

        //获取参数与选项
        $model = $input->getArgument(('model'));

        //生成控制器文件
        $m = new Model($this->dir,$model);
        list($result,$msg) = $m->create();

        if (!$result) {
            $output->writeln('<error>' . $msg . '</error>');
            return;
        }

        //打印成功信息
        $output->writeln('<info>>>>' . $msg . '</info>');
        //$output->writeln($input->getOption('module'));
    }
}