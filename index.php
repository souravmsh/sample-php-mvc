<?php 
session_start();

// Handling error reporting  
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// load vendor/autoload
require __DIR__ . '/vendor/autoload.php';

// load Config.php
require_once __DIR__ . '/app/Utilities/Config.php';

// load Helper.php
require_once __DIR__ . '/app/Utilities/Helper.php';

// load Routes.php
require_once __DIR__ . '/app/Utilities/Route.php';
 
//generate token
if (empty($_SESSION['csrf_token'])) {
    if (function_exists('random_bytes')) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } else {
        // Fallback if random_bytes() is not available (unlikely)
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
