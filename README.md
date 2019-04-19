# mxc php

## 功能介绍
1. 实现了最简单的MVC模式

## 第一次写框架遇到如下问题

1. 类自动加载问题？

   使用composer之后我们不需要关注类自动发现问题，但是自己写框架时需要考虑这些问题，使用`spl_autoload_register()`函数或`__autoload()`魔术方法，可以解决类加载问题。
    
2. 实例化控制器类
    ```
    $controller = 'app\\controllers\\' . $controllerName . 'Controller';
    if (!class_exists($controller)) {
        exit($controller . '控制器不存在');
    }
    if (!method_exists($controller, $actionName)) {
        exit($actionName . "方法不存在");
    }
    $dispatch = new $controller($controllerName, $actionName);
    //$dispatch->$actionName($params);
    call_user_func_array(array($dispatch, $actionName), $params);
    
    ```
3. 数据库操作类不够优雅

## 应用的设计模式
1. 单例模式 - 数据库实例
2. 责任链模式 - 数据库操作链式调用，直到处理

## 可以优化的点

1. 增加url处理类，处理接收到的参数，和路由跳转等问题
2. 数据库链接可以继续封装，实现不同类型数据库链接
3. 增加异常类，处理所有异常相关
4. DB查询类可以再优化sql语句拼接
5. 视图类可以引入三方包实现更好的功能
6. 增加Log类，记录程序日志
7. 增加Test测试用例

## 总结
1. 向框架作者们致敬，制作一个完整的框架真的非常不容易




## 相关参考
· 参考并借鉴了`https://www.awaimai.com/128.html`
