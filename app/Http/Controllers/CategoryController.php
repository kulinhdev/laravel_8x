<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // $cats = Category::all();
        $cats = [];

        // Compact method
        // return view('category.index', compact('cats'));

        // With method
        // return view('category.index')->with('cats', $cats);

        // Directly in the view 
        return view('category.index', ['cats' => $cats]);

    }
}
