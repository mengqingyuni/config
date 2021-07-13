<?php
/**
 * Created by PhpStorm.
 * User: Print2
 * Date: 2021/7/13
 * Time: 11:00
 */
namespace config;
/**
 * 配置
 * Class Config
 */
class Config
{
    /**
     * 配置参数
     * @var array
     */
    protected  static $config = [];

    /**
     * 配置路径
     * @var string
     */
    protected $path;

    /**
     * 扩展名
     * @var string
     */
    protected $ext;
    /**
     * 构造方法
     * @access public
     * @param string|null $path
     * @param string $ext
     */
    public function __construct(string $path = null, string $ext = '.php')
    {
        $this->path = $path ?: '';
        $this->ext  = $ext;

    }


    /**
     * 手动加载
     * @param $file  // 路径
     * @param $name //文件名
     * @return void
     */
    public function load($file = null,$name = null)
    {
        if (empty($file)) {
            $file = CONFIG_PATH;
        }

        if (is_file($file)) {
            $fileName = $file;
        } elseif (is_file($file.$name.$this->ext)) {
            $fileName = $file.$name.$this->ext;
        }

        //获取参数

        if (isset($fileName))  static::$config = $this->parse($fileName,$name);

    }

    /**
     * 配置参数
     * @param $fileName
     * @param $name
     * @return mixed
     */
    protected function parse($fileName,$name)
    {
        $config = include $fileName;

        return is_array($config) ? $this->set($config,strtolower($name)) : [];

    }


    /**
     * 获取配置参数
     * @param $name
     * @param null $default
     * @return array
     */
    public  function get($name = null,$default = null)
    {
        if (empty($name)) {
            return  static::$config;
        }

        //分级
        $name = explode('.',$name);
        $name[0] = strtolower($name[0]);
        $config  = static::$config;
        foreach ($name as $val) {

            if (isset($config[$val])) {
                $config = $config[$val];
            } else {
                return $default;
            }

        }
        return  $config;

    }

    /**
     * 设置配置参数
     * Config::set(['name1' => 'value1', 'name2' => 'value2'], 'config');
     * @param array $config 配置参数
     * @param string $name 配置名称
     * @return array
     */
    public function set(array $config, string $name = null)
    {

        if (!is_array($config)) return [];
        //配置名称不为空
        if (!empty($name)) {
            //检测是否有此配置
            if (isset(static::$config[$name])) {
                //合并数组
                $result =  array_merge(static::$config[$name],$config);
            } else {
                $result = $config;
            }

            static::$config[$name] = $result;

        } else {
            $result =  static::$config = array_merge(static::$config,array_change_key_case($config));
        }

        return $result;
    }

    /**
     * 检测配置参数
     */
    public static function has()
    {

    }



}