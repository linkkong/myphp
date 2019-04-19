<?php

namespace Core;

// 框架根目录
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

class MyPHP
{
    /**
     * 配置
     *
     * @var array
     */
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));

        $this->setDbConfig();
        $this->setErrorReporting();
        $this->unregisterGlobals();
        $this->removeMagicQuotes();

        $this->route();
    }

    /**
     * 设置路由
     */
    public function route()
    {
        $controllerName = ucfirst($this->config['defaultController']);
        $actionName = $this->config['defaultAction'];
        $params = [];

        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        $url = trim($url, '/');

        if ($url) {
            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);

            // 获取控制器名
            $controllerName = ucfirst($urlArray[0]);
            array_shift($urlArray);

            // 获取动作名
            $actionName = $urlArray ? $urlArray[0] : $actionName;
            array_shift($urlArray);
            $params = $urlArray;
        }

        //判断控制器和操作是否存在
        $controller = 'app\\controllers\\' . $controllerName . 'Controller';
        if (!class_exists($controller)) {
            exit($controller . '控制器不存在');
        }
        if (!method_exists($controller, $actionName)) {
            exit($actionName . "方法不存在");
        }
        $dispatch = new $controller($controllerName, $actionName);
//        $dispatch->$actionName($params);
        
        call_user_func_array(array($dispatch, $actionName), $params); //控制器内用func_get_args可以接收传的参数
    }

    /**
     * 自动加载类
     *
     * @param $className
     */
    public function loadClass($className)
    {
        $classMap = $this->classMap();
        if (isset($classMap[$className])) {
            // 包含内核文件
            $file = $classMap[$className];
        } elseif (strpos($className, '\\') !== false) {
            // 包含应用（application目录）文件
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if (!is_file($file)) {
                return;
            }
        } else {
            return;
        }

        include $file;
    }

    /**
     * 内核文件命名空间映射关系
     *
     * @return array
     */
    protected function classMap()
    {
        return [

        ];
    }

    /**
     * 设置报错级别
     */
    public function setErrorReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set("display_errors", "On");
        } else {
            error_reporting(E_ALL);
            ini_set("display_errors", 'Off');
            ini_set('log_errors', "On");
        }
    }

    /**
     * 检测并移除非法字符串
     */
    public function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET) : "";
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    /**
     * 过滤敏感字符串
     *
     * @param $value
     *
     * @return array|string
     */
    public function stripSlashesDeep($value)
    {
        return is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
    }

    /**
     * 检测自定义全局变量并移除
     */
    public function unregisterGlobals()
    {
        if (ini_get("register_globals")) {
            $arrays = ['_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            $allArrays = array_keys($GLOBALS);
            $diff = array_diff($allArrays, $arrays);
            array_map(function ($value) {
                unset($GLOBALS[$value]);
            }, $diff);
        }
    }

    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_CONNECTION', $this->config['db']['connection']);

            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['dbname']);
            define('DB_USER', $this->config['db']['username']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }

}
