<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 12:48
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Create;


class CreateController extends Create {

    /**
     * 创建类型为控制器
     *
     * @var string
     */
    private $type = 'controller';

    /**
     * 命令文件（thinker）所在的目录
     *
     * @var string
     */
    private $rootPath;

    /**
     * 创建文件的目标目录
     *
     * @var string
     */
    private $filedir;

    /**
     * 模块名
     * @var string
     */
    private $module;

    /**
     * CreateController constructor.
     * @param string $rootPath
     */
    public function __construct($rootPath = '', $module = 'Home') {
        $this->rootPath = $rootPath;
        $this->filedir = $this->rootPath . '/Application/' . $module . '/Controller/';
        $this->module = $module;
    }

    /**
     * 生成控制器
     * @param $name
     */
    public function create($name) {
        $temp = $this->getTmpl($this->type);
        $temp = str_replace('{$controller$}', $name, $temp);
        $temp = str_replace('{$module$}', $this->module, $temp);

        $path = $this->filename($name);

        $this->saveAsFile($path, $temp);
    }

    /**
     * 保存内容到文件
     *
     * @param $path
     * @param string $content
     * @return bool|int
     */
    private function saveAsFile($path, $content = '') {
        //内容是否为空
        if (empty($content)) return false;
        //目录是否存在
        $dir = dirname($path);
        if (is_dir($dir) === false) {
            //创建目录
            mkdir($dir, 0777, true);
        }
        //写入文件
        return file_put_contents($path, $content);

    }

    /**
     * 返回文件路径
     *
     * @param $name
     * @return string
     */
    private function filename($name) {
        return $this->filedir . $name . '.class.php';
    }


}