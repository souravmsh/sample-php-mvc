<?php

namespace App\Controller;

use App\Libraries\View;

class ContactController extends Controller
{

    public function __construct()
    {
        //
    }

    public function contact()
    { 
        # load without template
        return View::withoutTemplate()
        ->render("pages/contact", [
            "title" => "Conact Page",
            "footer" => "Copy@2023"
        ]);

    }

    public function about()
    { 
        # load with custom template
        return View::customTemplate("layout2")
        ->render("pages/about", [
            "title" => "About Us",
            "footer" => "Copy@2023"
        ]);

    }
 
}