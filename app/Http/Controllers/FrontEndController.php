<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function getHeaderMenu() {
        $category = new Category();
        $menus = $category->getHeaderMenu();
    }
}
