<?php

namespace App\Libraries;

use Exception;

class View
{
    protected static $template = true;
    protected static $customTemplate = "";
    protected static $ext = ".php";

    public static function render(string $page, array $params = [])
    { 
        $resolvedPath = self::pathResolver($page);

        if (!file_exists($resolvedPath)) {
            throw new Exception("{$resolvedPath} not found!");
        }

        ob_start();
        extract($params);
        include $resolvedPath;
        $content = ob_get_clean();

        if (!empty(self::$template)) {
            
            $template = Config::get("VIEW.DEFAUL_LAYOUT");
            
            if (!empty(self::$customTemplate)) {
                $template = self::$customTemplate;
            }

            ob_start();
            $resolvedPath = self::pathResolver($template);
            if (!file_exists($resolvedPath)) {
                throw new Exception("{$resolvedPath} not found!");
            }

            include $resolvedPath;
            $content = ob_get_clean();
        }

        return $content;
    }

    public static function customTemplate(string $path) : self
    {
        self::$customTemplate = $path;
        self::$template = true;
        return new self;
    }

    public static function withoutTemplate() : self
    {
        self::$template = false;
        return new self;
    }

    protected static function pathResolver(string $path): string
    {
        $viewPath = Config::get("VIEW.PATH");
        $path = $viewPath . "/". $path . self::$ext;
        return preg_replace("#[\\\\/]+#", '/', $path);
    }
    
}
