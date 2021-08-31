**config(暂)是一个配置模块。主要的场景是帮助第三方模块或框架进行配置数据的加载。**

1. git安装

```
https://github.com/mengqingyuni/config.git
```

2.compose

```
 composer require gongzhiyang/config
```


**获取参数**
1. 一般是有set设置好参数或在配置文件配置好。然后由get获取

![](images/screenshot_1630390848996.png)
```
/**

     * 获取配置参数

     * @param $name 配置名称

     * @paramnull $default 默认参数

     * @returnarray

     */
```
```
(new config\Config())->set(['name1' => 'value1', 'name2' => 'value2'], 'default');
(new config\Config())->get('default')
```

**获取数组中某个值**
```
$confs = (new config\\Config())->get('stores.file.type');
```

**检测配置参数**
`检测配置项是否存在` 
```
/**

     * 检测配置参数

     * @paramnull $name 配置名称

     * @returnbool

     */
```

```
（new config\Config())->has('default');
```

`返回值 成功 true  失败 false`


**手动加载配置项**
`适用于加载配置指定地址的配置文件`
![](images/screenshot_1630390848996.png)

```
  //目录配置文件路径

 define('CONFIG_PATH',__DIR__.'/config/');
 $conf = (new config\Config())->load(CONFIG_PATH,'cache');

 (new config\Config())->set(['name1' => 'value1', 'name2' => 'value2'], 'default');

 $confs = (new config\\Config())->get('default');
if((new config\Config())->has('defaults')) {

echo"true";

}
```


**设置配置**
```
/**

     * 设置配置参数

     * Config::set(\['name1' => 'value1', 'name2' => 'value2'\], 'config');

     * @paramarray $config 配置参数

     * @paramstring $name 配置名称

     * @returnarray

     */
```

**示例**

```
(new config\Config())->set(['name1' => 'value1', 'name2' => 'value2'], 'default');
```


