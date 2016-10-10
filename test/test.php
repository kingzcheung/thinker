<?php

$mod    = 'Admin';
$dir    = '/private/var/www/freeproj/thinkphp/Application/' . $mod;
$dirarr = [
    $mod => [
        'Common'     => ['index.html'],
        'Conf'       => ['config.php', 'index.html'],
        'Controller' => ['index.html'],
        'Model'      => ['index.html'],
        'View'       => ['index.html'],
        'index.html'
    ]
];

//分析如何维护以上数组
//第一维 admin 代表模块,如果 array_keys($dirarr) !== 所生成的模块名,直接生成以上的所有目录与文件
//第二维,关联 key 为目录,关联 value 为文件或者目录,把 key 取出来,与现有目录对比,如果某个目录不存在,生成目录及以下文件

//Leak filling
function filling() {
    global $dirarr, $dir, $mod;
    //查看模块是否存在
    if (is_dir($dir)) {
        //如果存在
        $keys = array_keys($dirarr[$mod]);
        //print_r($keys);
        foreach ($keys as $value) {
            //如果目录不存在,就创建
            if (!$subdir = is_dir($dir . '/' . $value)) {
                mkdir($subdir, 0777, true);
                foreach (array_values($value) as $item) {
                    file_put_contents($subdir . '/' . $item, '');
                }
            }
        }
    }
}

//filling();

$load = require '../vendor/autoload.php';
$load->add('Thinker\\',__DIR__);
$dirs = \Thinker\Tools\Config::get('moduleDir');

print_r($dirs);