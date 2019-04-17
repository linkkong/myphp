<?php

namespace Core;

// 框架根目录
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

class MyPHP
{
    /**
     * 配置
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
        $this->route();
    }

    public function route()
    {
        $controllerName = $this->config['defaultController'];
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
        }

        //判断控制器和操作是否存在
        $controller = 'app\\controllers\\' . $controllerName . 'Controller';
        if (!class_exists($controller)) {
            exit($controller . '控制器不存在');
        }

    }

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

    // 内核文件命名空间映射关系
    protected function classMap()
    {
        return [
            'fastphp\base\Controller' => CORE_PATH . '/base/Controller.php',
            'fastphp\base\Model' => CORE_PATH . '/base/Model.php',
            'fastphp\base\View' => CORE_PATH . '/base/View.php',
            'fastphp\db\Db' => CORE_PATH . '/db/Db.php',
            'fastphp\db\Sql' => CORE_PATH . '/db/Sql.php',
        ];
    }

}
