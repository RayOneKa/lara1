<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function category (Category $category)
    {
        return view('category', compact('category'));
    }
}
