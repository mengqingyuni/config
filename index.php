<?php
require __DIR__ . '/vendor/autoload.php';

//目录配置文件路径
define('CONFIG_PATH',__DIR__ . '/config/');

$conf = (new config\Config())->load(CONFIG_PATH,'cache');

 (new config\Config())->set(['name1' => 'value1', 'name2' => 'value2'], 'default');
 $confs = (new config\Config())->get('stores.file');
 print_r($confs);
if((new config\Config())->has('default')) {
    echo "true";
}