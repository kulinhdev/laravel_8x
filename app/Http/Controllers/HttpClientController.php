<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpClientController extends Controller
{
    public function getAll()
    {
        $result = Http::get("https://jsonplaceholder.typicode.com/posts");
        return $result->json();
    }

    public function getById($id) 
    {
        $result = Http::get("https://jsonplaceholder.typicode.com/posts/$id");
        return $result->json();
    }

    public function addPost()
    {
        $result = Http::post("https://jsonplaceholder.typicode.com/posts", [
            'userId' => 1,
            'title' => 'demo 1',
            'body' => 'main text nè !'
        ]);
        return $result->json();
    }

    public function updatePost($id)
    {
        $result = Http::put("https://jsonplaceholder.typicode.com/posts/$id", [
            'userId' => 1,
            'title' => 'update 1',
            'body' => 'update main text nè !'
        ]);
        return $result->json();
    }

    public function deletePost($id)
    {
        $result = Http::delete("https://jsonplaceholder.typicode.com/posts/$id");
        return $result->json();
    }
}
