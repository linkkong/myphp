<?php


namespace core;


class View
{
    protected $variables = [];
    protected $_controller, $_action;

    function __construct($controller, $action)
    {
        $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }

    /**
     * 仿tp3 赋值
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function render()
    {
        extract($this->variables);

        $defaultHeader = APP_PATH . 'app/views/header.php';
        $defaultFooter = APP_PATH . 'app/views/footer.php';

        $controllerHeader = APP_PATH . 'app/views/' . $this->_controller . '/header.php';
        $controllerFooter = APP_PATH . 'app/views/' . $this->_controller . '/footer.php';
        $controllerLayout = APP_PATH . 'app/views/' . $this->_controller . '/' . $this->_action . '.php';

        if (is_file($controllerHeader)) {
            include $controllerHeader;
        } else {
            include $defaultHeader;
        }

        //判断视图文件是否存在
        if (is_file($controllerLayout)) {
            include($controllerLayout);
        } else {
            echo "<h1>无法找到视图文件</h1>";
        }

        // 页脚文件
        if (is_file($controllerFooter)) {
            include($controllerFooter);
        } else {
            include($defaultFooter);
        }

    }
}