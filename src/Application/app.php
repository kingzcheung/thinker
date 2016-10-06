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

class App {
    private $root;
    private $application;

    public function __construct($root) {
        $this->root = $root;
        $this->application = new Application();
    }

    public function runner() {
        $this->application->add(new \Thinker\Command\TestCommand($this->root));
        $this->application->add(new \Thinker\Command\ControllerCommand($this->root));

        $this->application->run();
    }
}