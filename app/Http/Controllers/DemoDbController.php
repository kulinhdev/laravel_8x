<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = DB::table('blogs');
        $blogs->get();
        // ->where('id', 1)
        // ->select('body')
        // ->pluck('title')
        // ->orWhere('title', 'LIKE', 'Learn%')
        // ->whereBetween('id', [1, 7])
        // ->orderBy('id', 'desc')
        // ->whereIn('id', [1, 2, 3])
        // ->whereNotNull('title')
        // ->find(2)
        // ->average('id')        
    }

    public function add()
    {
        $blogs = DB::table('blogs');
        $blogs->insert(['title' => 'Learn Docker in one video', 'body' => 'Docker tutorial famous in America 2021']);
    }


    public function update()
    {
        $blogs = DB::table('blogs');
        $blogs->where('id', '=', 4)
            ->update(['title' => 'New title Docker', 'body' => 'New body ...']);
    }

    public function delete()
    {
        $blogs = DB::table('blogs');
        $blogs->where('id', '=', 4)
            ->delete();
    }
}
