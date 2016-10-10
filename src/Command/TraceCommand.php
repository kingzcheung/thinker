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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class TraceCommand extends Command {
    public function __construct($msg = 'test') {
        $this->msg = $msg;
        parent::__construct();
    }

    protected function configure() {
        $this
            ->setName('trace')
            ->setDescription("仅仅只是测试")
            ->setHelp("这个命令真的只是一个测试");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("<info>" . $this->msg . "</info>");
    }
}

