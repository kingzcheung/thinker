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
        $this->root      = $root;
        $this->moduleDir = $this->root . '/Application/' . $module;
    }

    /**
     * 获取模块目录路径
     * @return mixed
     */
    public function getModuleDir() {
        return $this->moduleDir;
    }


    /**
     * 目录是否存在
     * @return bool
     */
    public function existModule() {
        return is_dir($this->moduleDir);
    }

    /**
     * 创建模块目录
     */
    public function createModule() {
        //如果不存在模块,直接创建所有所需要的文件与目录
        if (!$this->existModule()) {
            $this->mkModule();
        }
    }

    private function mkModule($permission = 0777) {

        $configContent = <<<CFG
<?php
return array(
	//'配置项'=>'配置值'
);
CFG;

        //创建 Common
        mkdir($this->moduleDir . '/Common', $permission, true);
        file_put_contents($this->moduleDir . '/Common/index.html', '');
        file_put_contents($this->moduleDir . '/Conf/function.php', '');

        //添加 conf 并添加 config.php和 index.html
        mkdir($this->moduleDir . '/Conf', $permission, true);
        file_put_contents($this->moduleDir . '/Conf/config.php', $configContent);
        file_put_contents($this->moduleDir . '/Conf/index.html', '');
        //添加 Controller 和 index.html
        mkdir($this->moduleDir . '/Controller', $permission, true);
        file_put_contents($this->moduleDir . '/Controller/index.html', '');
        //添加 Model 和 index.html
        mkdir($this->moduleDir . '/Model', $permission, true);
        file_put_contents($this->moduleDir . '/Model/index.html', '');
        //添加 View 和 index.html
        mkdir($this->moduleDir . '/View', $permission, true);
        file_put_contents($this->moduleDir . '/View/index.html', '');
        //添加模块下的 index
        file_put_contents($this->moduleDir . '/index.html', '');
    }

}