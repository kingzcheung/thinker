<?php
/**
 * 一键生成整个模块目录
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/8
 * Time: 09:17
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thinker\Create\CreateModule;
use Thinker\Tools\Config;

class ModuleCommand extends Command {

    private $dir;

    public function __construct($dir) {
        parent::__construct();
        $this->dir = $dir;
    }

    private $module
        = [
            '__dir__'    => ['Common', 'Conf', 'Controller', 'Model', 'View'],
            'Common'     => ['function.php'],
            'Conf'       => ['config.php'],
            'Controller' => [],
            'Model'      => [],
            'View'       => [],
        ];

    protected function configure() {
        $this
            //设置命令名称
            ->setName('make:module')
            //描述
            ->setDescription('生成模块内容')
            //帮助 --help 中的描述
            ->setHelp("生成模块所需的内容（目录,配置等）")
            //添加参数
            ->addArgument('moduleName', InputArgument::OPTIONAL, '模块的名称', "Admin");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $moduleName = $input->getArgument('moduleName');

        list($result,$msg) = $this->create($moduleName);

        if (!$result)
        {
            $output->writeln('<error>'.$msg.'</error>');
        }

        $output->writeln($msg);
    }

    private function getModuleDir($moduleName) {
        return $this->dir . '/Application/' . $moduleName;
    }

    private function create($moduleName) {

        if (is_dir($this->getModuleDir($moduleName)))
        {
            return [false,'模块已存在！'];
        }

        foreach ($this->module as $key => $value) {
            if ($key === '__dir__') {
                //生成目录
                foreach ($value as $item) {
                    mkdir($this->getModuleDir($moduleName) .'/'.$item,0777,true);
                }
            }else{
                if (!empty($value)){
                    foreach ($value as $item2) {
                        $file = $this->getModuleDir($moduleName).'/'.$key.'/'.$item2;
                        file_put_contents($file,'<?php'.PHP_EOL);
                    }
                }

            }

        }
        return [true,'添加成功'];
    }


}