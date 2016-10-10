<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/5
 * Time: 22:44
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class DebugCommand extends Command {
    private $root;

    public function __construct($root = '') {
        $this->root = $root;
        parent::__construct();
    }

    protected function configure() {
        $this
            ->setName('debug')
            ->setDescription("开启/关闭框架 DEBUG 模式")
            ->setHelp("开启/关闭框架 DEBUG 模式,如果为 true,则开启 debug,反之为关闭")
            ->addArgument('debug', InputArgument::OPTIONAL, '开启为 true,关闭为 false');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        if ($this->debugSwitch($input->getArgument('debug'))) {
            if ($input->getArgument('debug') == 'false') {
                $output->writeln("<info>DEBUG 关闭!</info>");
            } elseif ($input->getArgument('debug') == 'true') {
                $output->writeln("<info>DEBUG 开启!</info>");
            }
        } else {
            $output->writeln("<error>DEBUG 开启/关闭失败!</error>");
        }

    }


    /**
     * 开启/关闭 DEBUG
     *
     * @param $switch
     * @return int
     */
    private function debugSwitch($switch) {
        $debug = 'false';
        if ($switch == 'false') $debug = 'true';

        //入口文件路径
        $indexDir = $this->root . '/index.php';
        $content  = file($indexDir);
        foreach ($content as &$item) {
            if (strpos($item, 'APP_DEBUG') !== false) {
                $item = str_replace($debug, $switch, $item);
            }
        }
        return file_put_contents($indexDir, $content);
    }
}

