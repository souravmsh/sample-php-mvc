<?php
echo "<h1>Home</h1>";
echo "<h3>" . $title . "</h3>";
?>

<pre>
# Sample MVC using Raw PHP
------------------------------------

## CONFIGURATIONS 
1. Utilities/Routes.php
    - All routes of the application
    - Router::get("users", App\Controller\HomeController::class, 'users');
    - Router::post("save", App\Controller\HomeController::class, 'index');

2. Utilities/Helper.php
    - Contains with the custom helper function 

3. Utilities/Config.php
    - Write custom configuration here 
    - If you used database then change the database config 

    
## VIEWS
    - load with default template
    return View::render("pages/contact", [
            "title" => "Conact Page",
            "footer" => "Copy@2023"
        ]);

    - load without template
    return View::withoutTemplate()
        ->render("pages/contact", [
            "title" => "Conact Page",
            "footer" => "Copy@2023"
        ]);

    - load with custom template
        return View::customTemplate("layout2")
        ->render("pages/about", [
            "title" => "About Us",
            "footer" => "Copy@2023"
        ]);

## DATABASE

    $config = []; // optional configuration
    Database::init($otionalConfig)
        ->select("SELECT * FROM user");

</pre>