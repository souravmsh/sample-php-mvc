<?php

namespace App\Libraries;

use Exception;

class Config  
{
    private static $separator = ".";

    public static function _config()
    {
        $path = "./app/Utilities/Config.php";
        if (!file_exists($path)) {
            throw new Exception("{$path} file missing!");
        }
    
        $config = require $path;
    
        if (!is_array($config)) {
            throw new Exception("Config.php does not contain any array!");
        }
    
        return $config;
    }

    public static function get(string $keys = "") : array|string|null
    {
        try {
            return self::getValue(self::sanitizeKey($keys), self::_config());
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    private static function getValue(string $keys, array $config = []) : string|array
    {
        $result = $config;

        foreach (explode(self::$separator, $keys) as $item) {
            if (isset($result[$item])) {
                $result = $result[$item];
            } else {
                return "Invalid config key!";
            }
        }

        return $result;
    }

    private static function sanitizeKey(string $key) : string 
    {
        return preg_replace("/[^a-zA-Z0-9._]/", "_", $key);
    }
}
