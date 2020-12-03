<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke() {
        return "The 'About' controller ia a Single action controller so no need to pass an Array when calling in web.php - only need to call the class name";
    }
}
