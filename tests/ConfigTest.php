<?php

/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/23
 * Time: 14:10
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

require_once __DIR__ . '/../vendor/autoload.php';

class ConfigTest extends \PHPUnit_Framework_TestCase {

    public function testGet() {
        $res = \Thinker\Tools\Config::get('command');

        $this->assertEquals('\Thinker\Command\TestCommand',$res['command']['test']);
    }

}