<?php

namespace App\Libraries;

class Request
{

    public function __construct()
    {
        self::all();
    }

    public static function all()
    {
        $requestData = $_REQUEST;

        $jsonInput = file_get_contents('php://input');
        $jsonData = json_decode($jsonInput, true);

        if ($jsonData && is_array($jsonData)) {
            $requestData = array_merge($requestData, $jsonData);
        }

        // Sanitize the merged input to prevent XSS
        $sanitizedData = self::sanitizeInput($requestData);

        return $sanitizedData;
    }

    public static function input($key)
    {
        $requestData = self::all();
        return $requestData[$key] ?? null;
    }

    private static function sanitizeInput($data)
    {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }

        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    public static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }
}
