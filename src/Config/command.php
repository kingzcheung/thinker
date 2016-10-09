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
        'test'            => ['name'=>'','description'=>'','help'=>'','cmd'=>'\Thinker\Command\TestCommand'],
        'make.controller' => ['name'=>'','description'=>'','help'=>'','cmd'=>'\Thinker\Command\ControllerCommand'],
        'make.model'      => ['name'=>'','description'=>'','help'=>'','cmd'=>'\Thinker\Command\ModelCommand'],
        'make.module'     => ['name'=>'','description'=>'','help'=>'','cmd'=>'\Thinker\Command\ModuleCommand'],
    ]
];