<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/8
 * Time: 09:34
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Create;


use Thinker\Tools\Config;

class CreateModule {

    private $root;

    private $module;

    private $moduleDir;


    public function __construct($root = '', $module = 'Admin') {
        $this->root      = $root;
        $this->module    = $module;
        $this->moduleDir = $this->root . '/Application/' . $module;
    }

    /**
     * 模块树
     * @return array
     */
    public function moduleTree() {
        $moduleTree = [
            $this->module => [
                'Common'     => ['index.html'],
                'Conf'       => ['config.php', 'index.html'],
                'Controller' => ['index.html'],
                'Model'      => ['index.html'],
                'View'       => ['index.html'],
                'index.html'
            ]
        ];
        return $moduleTree;
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
        } else {
            $this->fillModule();
        }
    }

    private function configContent() {
        $configContent = <<<CFG
<?php
return array(
	//'配置项'=>'配置值'
);
CFG;
        return $configContent;
    }


    /**
     * 生成模块所需要的目录
     * @param int $permission
     */
    public function mkModule($permission = 0777) {
        $moduleDirArr = Config::get('moduleDir');
        $keys         = array_keys($moduleDirArr);
        //添加目录

        foreach ($keys as $key) {
            //文件夹不能为数据
            if (is_numeric($key)) continue;

            mkdir($this->moduleDir . '/' . $key, $permission, true);
            //添加文件
            foreach (array_values($moduleDirArr[$key]) as $item) {
                if ($item === 'config.php') {
                    file_put_contents($this->moduleDir . '/' . $key . '/' . $item, $this->configContent());
                } else {
                    file_put_contents($this->moduleDir . '/' . $key . '/' . $item, '');
                }
            }
        }

    }

    /**
     * 补全生成目标模块的目录
     * @param int $permission
     */
    public function fillModule($permission = 0777) {
        $moduleDirArr = Config::get('moduleDir');

        //查看模块是否存在
        if (is_dir($this->moduleDir)) {
            //如果存在
            $keys = array_keys($moduleDirArr);

            foreach ($keys as $value) {
                //如果目录不存在,就创建
                if (is_int($value)) continue;

                if (!is_dir($this->moduleDir . '/' . $value)) {
                    mkdir($this->moduleDir . '/' . $value, $permission, true);
                    foreach (array_values($moduleDirArr[$value]) as $item) {
                        if ($item === 'config.php') {
                            file_put_contents($this->moduleDir . '/' . $value . '/' . $item, $this->configContent());
                        } else {
                            file_put_contents($this->moduleDir . '/' . $value . '/' . $item, '');
                        }
                    }
                }
            }
        }
    }

}