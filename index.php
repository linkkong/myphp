<?php

declare(strict_types=1);

//定义应用目录
define("APP_PATH", __DIR__ . "/");

define("APP_DEBUG", true);

$config = require(APP_PATH . "config/config.php");

require(APP_PATH . "core/myphp.php");
(new Core\MyPHP($config))->run();
