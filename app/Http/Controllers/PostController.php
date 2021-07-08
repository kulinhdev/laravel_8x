<?php

namespace App\Http\Controllers;

// *** Validate Form  *** \\
use App\Http\Requests\Posts\PostAddRequest;
use App\Http\Requests\Posts\PostEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;

use Illuminate\Support\Facades\Route;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // *** Index - Show All *** \\
    public function index()
    {
        $posts = Post::all();

        $page = 'Posts';
        $title = 'All Posts';
        return view('posts.index', compact('page', 'title', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // *** Create - View Add *** \\

    public function create()
    {
        $page = 'Add Posts';
        $title = 'Add New Posts';
        return view('posts.create', compact('page', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // *** Store - Handle Date Store *** \\
    public function store(PostAddRequest $request)
    {
        // *** Validate form *** \\
        // Form BlogAddRequest

        $file = $request->file('image');
        $file_name = $file->getClientOriginalName('image');
        $extension = $file->getClientOriginalExtension('image');
        $extension = Str::lower($extension);

        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            $image_name = Str::random(10) . '_' . $file_name;
            if (file_exists('uploads/posts' . $image_name)) {
                $image_name = Str::random(10) . '_' . $file_name;
            }

            $file->move('uploads/posts', $image_name);

            Post::create([
                'title' => $request->title,
                'image' => $image_name,
                'body' => $request->body,
            ]);

            return redirect('/posts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // *** Show - Show Item by Id *** \\
    public function show($id)
    {
        // Route info
        $route = Route::current();
        dd($route);
    }

    // *** softDelete - Show View Trash *** \\
    public function softDelete()
    {
        $page = 'Posts Trash';
        $title = 'Posts deleted';

        $postsDeleted = Post::onlyTrashed()->get();

        return view('posts.trash', compact('page', 'title', 'postsDeleted'));
    }

    // *** softDelete - Restore and Real Delete *** \\
    public function softDeleteAction(Request $request)
    {
        // Get action
        $action = $request->action;

        // Get id from request
        $allId = $request->all();
        // Slice Token, Method and Action
        $allId = array_slice($allId, 2, -1);

        if ($action == 'restore') {
            // Restore
            Post::withTrashed()->whereIn('id', $allId)->restore();

            return redirect()->back()->with('success', 'Record recovery successful !');
        } else {
            // Delete
            // Unlink Images
            foreach ($allId as $id) {
                $image = Post::onlyTrashed()->where('id', $id)->first();
                $pathImg = "uploads/posts/" . $image->image;
                // Check file exits
                if (file_exists($pathImg)) {
                    unlink($pathImg);
                }
            }

            Post::withTrashed()->whereIn('id', $allId)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // *** Edit - Show Item by need Edit by Id*** \\
    public function edit($id)
    {
        $page = 'Edit Posts';
        $title = 'Edit Posts Page';

        $post = Post::find($id);
        return view('posts.edit', compact('page', 'title', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // *** Update - Handle Date Update *** \\
    public function update(PostEditRequest $request, $id)
    {
        $file = $request->file('image');
        $file_name = $file->getClientOriginalName('image');

        $image_name = Str::random(10) . '_' . $file_name;
        if (file_exists('uploads/posts/' . $image_name)) {
            $image_name = Str::random(10) . '_' . $file_name;
        }

        $file->move('uploads/posts', $image_name);

        Post::where('id', $id)->update([
            'title' => $request->title,
            'image' => $image_name,
            'body' => $request->body,
        ]);

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // *** Destroy - Temporarily delete the record *** \\
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->back()->with('success', 'Delete record successfully !');
    }
}
