<?php
/**
 * 命令配置文件
 *
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/9
 * Time: 11:22
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

return [
    'command' => [
        'test'            => '\Thinker\Command\TestCommand',
        'debug'           => '\Thinker\Command\DebugCommand',
        'make.controller' => '\Thinker\Command\ControllerCommand',
        'make.model'      => '\Thinker\Command\ModelCommand',
        'make.module'     => '\Thinker\Command\ModuleCommand',
    ]
];