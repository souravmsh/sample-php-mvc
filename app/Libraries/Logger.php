<?php

namespace App\Libraries;

use Exception;

class Logger
{ 
    public const LOG_INFO = 'INFO:: ';
    public const LOG_ERROR = 'ERROR:: ';

    public static function info($log)
    {
        self::log(self::LOG_INFO, $log);
    }
 
    public static function error($log)
    {
        self::log(self::LOG_ERROR, $log);
    }

    private static function log($type, $log)
    {
        try {
            if (!Config::get('LOG.ENABLE')) {
                return;
            }

            $folderPath = self::prepareLogFolder();

            $date = date('YmdH');
            $logData = self::formatLogData($type, $log);
            $filename = $folderPath . $date . ".log";

            self::writeToFile($filename, $logData);
        } catch (Exception $e) {
            // Handle exceptions here
        }
    }

    private static function prepareLogFolder()
    {
        $logPath = rtrim(Config::get('LOG.PATH'), '/') . '/' . date('Ym') . '/';
        
        if (!is_dir($logPath)) { 
            if (!mkdir($logPath, 0775, true) || !is_dir($logPath)) {
                die("Failed to create directory: {$logPath}");
            }
        }
    
        return $logPath;
    }
    

    private static function formatLogData($type, $log)
    {
        $logTime = date('H:i:s');
        return "[" . $logTime . "] " . $type . $log . "\r\n";
    }

    private static function writeToFile($filename, $logData)
    {
        if ($fh = fopen($filename, 'a')) {
            fwrite($fh, $logData);
            fclose($fh);
        } else {
            die("Unable to open file!");
        }
    }
}
