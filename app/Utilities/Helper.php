<?php
use App\Libraries\Config;
use App\Libraries\Url;

if (!function_exists("dd")) {
    function dd(string|object|array $data = []) : void {
        try { 
            echo "<pre style='background-color:#f4f4f4;padding:1.5rem'>";
            array_map(function($data) {
                highlight_string("<?php\n\n" . var_export($data, true) . ";\n\n?>\n");
                echo "<hr style='border-bottom:1px solid khaki'/>";
            }, func_get_args());
            echo "</pre>";
            die();
        } catch (Exception $e) { 
            echo "<pre style='background-color:#f4f4f4;padding:1.5rem'>";
            echo "<code style='color: #333333;'>";
            echo "Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine();
            echo "</code>";
            echo "</pre>";
            die(); 
        }
    }
}


if (!function_exists("view_path"))  {
    function view_path($path) : mixed {
        $realpath = Config::get("VIEW.PATH"). "/" . $path;
        if (!file_exists($realpath)) {
            die("Unable to include file <b>{$realpath}</b>!");
        }
        return $realpath;
    }
}

if (!function_exists("url"))  {
    function url($route = "/") : void {
        echo Url::baseUrl($route);
    }
}




