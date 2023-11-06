<?php

namespace App\Controller;

use App\Libraries\Database;
use App\Libraries\Logger;
use App\Libraries\Request;
use App\Libraries\View;

class HomeController extends Controller
{
    public function index()
    {   
        # load with default template
        return View::render("pages/home", [
                "title" => "Home Page",
                "footer" => "Copy@2023"
            ]);
    }

    public function users()
    {  
        $data = Database::init()
            ->select("SELECT * FROM user");

        # load with default template
        return View::render("pages/users", [
                "title" => "Users Page",
                "footer" => "Copy@2023",
                "users"   => $data
            ]);
    }
 
}
