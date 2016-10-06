<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 00:56
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Template;


class ClassTemp {

    /**
     * 生成控制器
     * 
     * @param $controllerName
     * @return string
     * @author  Kingz Cheung <kingzcheung@gmail.com>
     */

    public static function createController($controllerName) {
        $controller = <<<CON
<?php

namespace Admin\Controller;

class {$controllerName} extends Controller {
    //...
}
CON;
        return $controller;

    }
    
}