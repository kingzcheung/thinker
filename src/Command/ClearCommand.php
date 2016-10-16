<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/16
 * Time: 12:07
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Thinker\Tools\Config;

class ClearCommand extends Command {
    /**
     * @var string TP 的根目录
     */
    private $root;
    /**
     * @var string 缓存目录
     */
    private $runtime;

    public function __construct($root = '') {
        parent::__construct();
        $this->root    = $root;
        $this->runtime = $this->root . '/Application/Runtime';
    }

    private function cmdName($c = __CLASS__) {
        $class = '\\' . $c;
        $cmds  = Config::get('command', 'command');
        return array_search($class, $cmds);
    }

    /**
     * 命令配置
     */
    protected function configure() {
        $this
            ->setName($this->cmdName(__CLASS__))
            ->setDescription("清除缓存文件")
            ->setHelp("清除runtime目录（包括模板缓存、日志文件及其子目录）下面的所有的文件，但会保留目录。");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        if($this->rmRuntime()){
            $output->writeln("<info>缓存清除成功</info>");
        }else {
            $output->writeln("<error>缓存清除失败</error>");
        }

    }


    /**
     * 删除 Runtime 目录
     * @return bool
     */
    private function rmRuntime() {
        if (is_dir($this->runtime)) {
            $dirarr = scandir($this->runtime);
            foreach ($dirarr as $item) {
                if ($item == '.' || $item == '..') continue;
                if(is_dir($this->runtime . '/' .$item)){
                    $this->delDirAndFile($this->runtime . '/' .$item);
                }
                if(is_file($file = $this->runtime . '/' .$item)){
                    unlink($file);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 删除目录及目录下所有文件或删除指定文件
     * @param str $path   待删除目录路径
     * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
     * @return bool 返回删除状态
     */
    private function delDirAndFile($path, $delDir = FALSE) {
        $handle = opendir($path);
        if ($handle) {
            while (false !== ( $item = readdir($handle) )) {
                if ($item != "." && $item != "..")
                    is_dir("$path/$item") ? $this->delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
            }
            closedir($handle);
            if ($delDir)
                return rmdir($path);
        }else {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                return FALSE;
            }
        }
    }

}