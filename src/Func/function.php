<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 18:16
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

/**
 * 加载配置文件
 * @param string $configName 配置文件名（不包含后缀）
 * @return mixed 返回配置文件数据
 */
function loadConfig($configName = 'config') {
    $path = pathinfo(__DIR__);
    return include $path['dirname'] . '/Config/' . $configName . '.php';
}


/**
 * 获取所有配置或者单个配置信息
 * @param string $name       配置名
 * @param string $configName 配置文件名(不包含后缀)
 * @return bool|mixed        返回配置信息
 */
function cfg($name = '', $configName = 'config') {
    $config = loadConfig($configName);
    if (!$config) return false;
    //没有参数时,获取所有参数
    if (empty($name)) return $config;

    //获取单个参数
    if (is_string($name)) {
        $name = strtolower($name);
        return $config[$name];
    } else {
        return false;
    }

}

