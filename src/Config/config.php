<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 17:59
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

return [
    //定义模块生成目录
    'moduleDir' => [
        'Common'     => ['index.html'],
        'Conf'       => ['config.php', 'index.html'],
        'Controller' => ['index.html'],
        'Model'      => ['index.html'],
        'View'       => ['index.html'],
        'index.html'
    ],
    //加载命令定义文件
    'command'   => 'command.php'
];
