<?php
/**
 * Created by 张富琼 <zfuqiong@ifreegroup.com>.
 * User: kingzcheung
 * Date: 17-9-21
 * Time: 下午3:19
 */


namespace Thinker\Create;


abstract class Template {

    protected $dir;
    protected $module;
    protected $application = 'Application/';
    protected $tmpl;

    public function __construct($dir, $inputName = '') {
        $this->dir  = $dir;
    }


    protected function getModuleDir() {
        return $this->dir . '/' .$this->application. $this->module;
    }

    protected function getModuleAndName($name) {
        if (strpos($name, '/') !== false) {
            list($module, $controller) = explode('/', $name);
        } else {
            $module     = 'Home';
            $controller = $name;
        }

        return [$module, $controller];
    }

    public abstract function create();
}