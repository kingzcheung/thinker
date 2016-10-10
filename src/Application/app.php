<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 21:03
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Application;

use Symfony\Component\Console\Application;
use Thinker\Tools\Config;

class App {
    private $root;
    private $application;

    public function __construct($root) {
        $this->root        = $root;
        $this->application = new Application();
    }

    public function run() {
        $cmd = Config::get('command', 'command');
        foreach ($cmd as $value) {
            $class = new \ReflectionClass($value);
            $this->application->add($class->newInstance($this->root));
        }
        $this->application->run();
    }
}