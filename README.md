# thinker
一个关于 ThinkPHP3.2 命令行的小工具。

### 安装指南

进入`thinkphp` 项目的根目录运行以下命令（前提是已经安装了 composer 命令）也可以在`thinkphp`的其他目录,只要引用路径对就行。

通过`composer`命令安装:

```shell
composer require "kingzcheung/thinker:dev-master"
```

或者通过`composer.json`安装:

```json
{
    "require": {
       "kingzcheung/thinker":"dev-master"
    }
}

```

把`/vendor/kingzcheung/thinker/thinker`文件复制到`thinkphp`项目的根目录,编辑好引用路径,比如:

```php
#!/usr/bin/env php
<?php

/**
 * 使用指南:
 * 1.最最重要的,使用 Composer 安装以后,把此文件复制到 ThinkPHP 项目的根目录
 * 2.给予 thinker 文件执行权限（比如0777）
 * 3.根据 Composer 安装的库目录引入 autoload.php
 *
 * 假如在 Public 目录下初始化第三方库（这里只是一个假设,事实上可以放在其他目录,只要下面的引入正确）
 * 引入 autoload 文件
 */
require_once __DIR__ . '/Public/vendor/autoload.php';

/**
 * 初始化应用目录,需要把当前目录作为参数
 */
$app = new Thinker\Application\App(__DIR__);

/**
 * 实例
 */
$app->run();

```

### 使用
进入项目,运行以下命令可以得到命令集合

```
php thinker list
```