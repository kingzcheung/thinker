<?php
/**
 * Created by 张富琼 <zfuqiong@ifreegroup.com>.
 * User: kingzcheung
 * Date: 17-9-21
 * Time: 下午3:45
 */


namespace Thinker\Create;


class Controller extends Template {
    private $controller;
    private $view;

    public function __construct($dir, $inputName = '') {
        parent::__construct($dir, $inputName);
        $this->controller = $inputName;
        $this->view       = strstr($inputName, 'Controller',true);
        list($this->module, $this->controller) = $this->getModuleAndName($inputName);
        $this->tmpl = __DIR__ . '/Template/controller.tmpl';
    }



    protected function getControllerDir() {
        return $this->getModuleDir() . '/Controller/';
    }

    protected function getViewDir() {
        return $this->getModuleDir() . '/View/';
    }

    public function create() {

        if (!is_dir($this->getControllerDir())) {
            mkdir($this->getControllerDir(), 0777, true);
        }
        $contrlFile    = $this->getControllerDir() . $this->controller . '.class.php';
        if (is_file($contrlFile)){
            return [false,'控制器已存在！'];
        }
        $contrlContent = str_replace([
            '{$controller$}','{$module$}'
        ], [
            $this->controller,$this->module
        ], file_get_contents($this->tmpl));

        return [file_put_contents($contrlFile, $contrlContent) !== false,'控制器创建成功'];
    }

    public function createView() {
        $viewFile = $this->getViewDir() . $this->view;
        if (!is_dir($viewFile)){
            mkdir($viewFile,0777,true);
        }
    }
}