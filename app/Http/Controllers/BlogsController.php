<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blogs\BlogAddRequest;
use App\Http\Requests\Blogs\BlogEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blogs;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // *** Index - Show All *** \\
    public function index()
    {
        $blogs = Blogs::all();

        $page = 'Home';
        $title = 'Home Page';
        return view('index', compact('page', 'title', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // *** Create - View Add *** \\

    public function create()
    {
        $page = 'Add Blog';
        $title = 'Add New Blogs';
        return view('blogs.create', compact('page', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // *** Store - Handle Date Store *** \\
    public function store(BlogAddRequest $request)
    {
        // *** Validate form *** \\
        // Form BlogAddRequest

        $file = $request->file('image');
        $file_name = $file->getClientOriginalName('image');
        $extension = $file->getClientOriginalExtension('image');
        $extension = Str::lower($extension);

        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            $image_name = Str::random(10) . '_' . $file_name;
            if (file_exists('images/' . $image_name)) {
                $image_name = Str::random(10) . '_' . $file_name;
            }

            $file->move('images', $image_name);

            Blogs::create([
                'title' => $request->title,
                'image' => $image_name,
                'body' => $request->body,
            ]);

            return redirect('/blogs');
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
        // Detail
        $oneBlog = Blogs::find($id);
        dd($oneBlog);
    }

    // *** softDelete - Show View Trash *** \\
    public function softDelete()
    {
        $page = 'Trash';
        $title = 'Post deleted';

        $blogs = Blogs::onlyTrashed()->get();

        return view('blogs.trash', compact('page', 'title', 'blogs'));
    }

    // *** softDelete - Restore and Real Delete *** \\
    public function softDeleteAction(Request $request) {
        // Get action
        $action = $request->action;
        
        // Get id from request
        $allId = $request->all();

        // Slice Token and Method
        $allId = array_slice($allId, 2, -1);
        
        if($action == 'restore') {
            // Restore
            Blogs::withTrashed()->whereIn('id', $allId)->restore();

            return redirect()->back()->with('success', 'Record recovery successful !');
        } else {
            // Delete
            // Unlink Images
            foreach ($allId as $id) {
                $image = Blogs::onlyTrashed()->where('id', $id)->get();
                unlink("images/" . $image[0]->image);
            }
            Blogs::withTrashed()->whereIn('id', $allId)->forceDelete();

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
        $page = 'Edit Blog';
        $title = 'Edit Blog Page';

        $blog = Blogs::find($id);
        return view('blogs.edit', compact('page', 'title', 'blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // *** Update - Handle Date Update *** \\
    public function update(BlogEditRequest $request, $id)
    {
        $file = $request->file('image');
        $file_name = $file->getClientOriginalName('image');

        $image_name = Str::random(10) . '_' . $file_name;
        if (file_exists('images/' . $image_name)) {
            $image_name = Str::random(10) . '_' . $file_name;
        }

        $file->move('images', $image_name);
        
        Blogs::where('id', $id)->update([
            'title' => $request->title,
            'image' => $image_name,
            'body' => $request->body,
        ]);

        return redirect('/blogs');
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
        Blogs::find($id)->delete();

        return redirect()->back()->with('success', 'Delete record successfully !');
    }
}
