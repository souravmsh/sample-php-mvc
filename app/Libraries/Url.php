<?php

namespace App\Libraries;

class Url
{

    public static function appRoot(): string
    {
        $script = $_SERVER['SCRIPT_NAME'];
        $root = $script;

        if (basename($script) === 'index.php') {
            $root = dirname($script);
        }

        $root = str_replace("index.php", "", $root);
        return $root;
    }

    public static function baseUrl($route = "/"): string
    { 
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $root = self::appRoot();
    
        $baseUrl = preg_replace('#/{2,}#', '/', "$host/$root/$route");
        $baseUrl = rtrim("$protocol://$baseUrl", '/');
        return $baseUrl;
    }

    public static function requestUri(): string
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $uri = str_replace(self::appRoot(), "", $uri);
        $uri = self::prettyUri($uri);
        return $uri;
    }

    public static function prettyUri($uri): string
    {
        if ($uri !== '/') {
            $uri = ltrim($uri, '/');
            $uri = rtrim($uri, '/');
        }
        return $uri;
    }

}
