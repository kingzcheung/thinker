<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/10
 * Time: 10:57
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Thinker\Tools;


class Config {

    /**
     * 加载配置文件
     * @param string $configName 配置文件名（不包含后缀）
     * @return mixed 返回配置文件数据
     */
    private static function loadConfig($configName = 'config') {
        $path = pathinfo(__DIR__);
        $file = $path['dirname'] . '/Config/' . $configName . '.php';

        if (is_file($file)) {
            return include $file;
        } else {
            return false;
        }

    }


    /**
     * 获取所有配置或者单个配置信息
     * @param string $name 配置名
     * @param string $configName 配置文件名(不包含后缀)
     * @return bool|mixed        返回配置信息
     */
    public static function get($name = '') {
        $config = self::loadConfig('config');

        //小写
        //$name = strtolower($name);

        if (!$config) return false;
        //没有参数时,获取所有参数
        if (empty($name)) return $config;

        //获取单个参数
        if (is_string($name)) {

            if (is_string($config[$name]) && strpos($config[$name], '.php') > 0) {
                $cfgs          = self::extraFile($config[$name]);
                $config[$name] = $cfgs;
            }
            return $config[$name];
        } else {
            return false;
        }
    }

    /**
     * 配置中加载额外的配置文件
     *
     * @param $load         加载的文件名
     * @return bool|mixed   返回文件内容
     */
    public static function extraFile($load) {
        //查找 value 中带有.php 的
        $extraFile = dirname(__DIR__) . '/Config/' . $load;
        if (is_file($extraFile)) {
            return include $extraFile;
        } else return false;
    }
}