<?php
 
return [
    // app
    "APP_NAME"     => "CodeKernel PHP Installer",
    "APP_VERSION"  => "6.0",
    "APP_ROOT"     => dirname(dirname(__FILE__)),
    "APP_URL"      => "/",

    // view
    "VIEW"         => [
            "PATH" => "./app/View/", // path of the view directory
            "DEFAUL_LAYOUT" => "layout", // a file name without extension inside the view directory
    ], 

    // LOG
    "LOG"           => [
            "ENABLE"  => true,
            "PATH"    => dirname(dirname(__DIR__)) . "/logs/"
    ],
 
    // database
    "DATABASE" => [
        "DRIVER"   => "mysql",
        "HOST"     => "127.0.0.1",
        "PORT"     => "3306",
        "USERNAME" => "root",
        "PASSWORD" => "",
        "DATABASE" => "db_test"
    ],
 
];
