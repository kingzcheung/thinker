<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/8
 * Time: 09:34
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Create;


class CreateModule {

    private $root;

    private $moduleDir;

    public function __construct($root = '', $module = 'Admin') {
        $this->root = $root;
        $this->moduleDir = $this->root . '/Application/' . $module;
    }

    /**
     * @return mixed
     */
    public function getModuleDir() {
        return $this->moduleDir;
    }


    
}