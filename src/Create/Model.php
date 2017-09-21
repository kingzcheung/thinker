<?php
/**
 * Created by 张富琼 <zfuqiong@ifreegroup.com>.
 * User: kingzcheung
 * Date: 17-9-21
 * Time: 下午4:30
 */


namespace Thinker\Create;


class Model extends Template {

    private $model;

    public function __construct($dir, $inputName = '') {
        parent::__construct($dir, $inputName);
        $this->tmpl = __DIR__ . '/Template/model.tmpl';
        list($this->module, $this->model) = $this->getModuleAndName($inputName);
    }

    private function getModelDir() {
        return $this->getModuleDir() . '/Model/';
    }

    public function create() {
        if (!is_dir($this->getModelDir())) {
            mkdir($this->getModelDir(), 0777, true);
        }
        $modelFile = $this->getModelDir() . $this->model.'.class.php';
        if (is_file($modelFile)) {
            return [false, '模型已存在'];
        }
        $content = str_replace([
            '{$model$}', '{$module$}',
        ], [
            $this->model, $this->module,
        ], file_get_contents($this->tmpl));

        return [file_put_contents($modelFile, $content) !== false, '创建成功!'];
    }
}