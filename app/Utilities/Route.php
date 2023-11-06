<?php 

use App\Libraries\Router;

Router::get("/", App\Controller\HomeController::class, 'index');
Router::get("users", App\Controller\HomeController::class, 'users');
// Router::post("save", App\Controller\HomeController::class, 'index');

Router::get("about", App\Controller\ContactController::class, 'about');
Router::get("contact", App\Controller\ContactController::class, 'contact');

// dispacth route
Router::dispatch();


// request
// middleware 