<?php

namespace core\db;

use PDO;
use PDOException;

class Db
{

    private static $pdo = null;

    public static function pdo()
    {
        if (self::$pdo !== null) { //单例模式
            return self::$pdo;
        }

        try {
            $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8mb4', DB_CONNECTION, DB_HOST, DB_NAME);
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            return self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $option);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}