<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 01:05
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Create;


abstract class Create {

    /**
     * 模板的所在目录
     * @var string
     */
    protected $tmplpath = __DIR__ . '/Template/';

    /**
     * 模板的后缀名
     * @var string
     */
    protected $suffix = '.tmpl';

    /**
     * 获取模板的路径
     *
     * @param $tmpl     模板名称
     * @return string   返回基于当前目录的模板路径
     */
    private function tmplPath($tmpl) {
        return $this->tmplpath . strtolower($tmpl) . $this->suffix;
    }

    /**
     * 获取模板内容
     * @param $tempName     模板名称
     * @return bool|string  返回模板中的数据
     */
    protected function getTmpl($tempName) {

        //print_r($this->tmplPath($tempName));exit;

        $temp = file_get_contents($this->tmplPath($tempName));
        if ($temp) {
            return $temp;
        } else {
            return false;
        }

    }

    /**
     * 生成模板
     * @param $content  模板内容
     * @return mixed
     */
    abstract protected function create($name);
}
