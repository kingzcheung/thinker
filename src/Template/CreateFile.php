<?php
/**
 * Created by PhpStorm.
 * User: kingzcheung
 * Date: 2016/10/6
 * Time: 01:05
 * @author  Kingz Cheung <kingzcheung@gmail.com>
 */

namespace Template;


class CreateFile {
    /**
     * @param ClassTemp $temp
     * @author  Kingz Cheung <kingzcheung@gmail.com>
     */
    public static function create($controllername) {
        $temp = file_get_contents(__DIR__ . '/index.tmp');
        $temp = str_replace('{$controller$}', $controllername, $temp);
        $filename = $controllername . '.class.php';
        file_put_contents($filename, $temp);
    }
}