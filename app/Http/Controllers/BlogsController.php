<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blogs\BlogAddRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blogs;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(BlogAddRequest $request)
    {
        // *** Validate form *** \\
        // $this->validate($request, [
        //     'title' => 'required|unique:blogs', 
        //     'image' => 'required|mimes:jpg,jpeg,png',
        //     'body' => 'required',
        // ], [
        //     'title.required' => 'Tiêu đề không được bỏ rỗng !',
        //     'image.required' => 'Bạn chưa chọn ảnh !',
        //     'body.required' => 'Nội dung đề không được bỏ rỗng !',
        // ]);

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
    public function show($id)
    {
        $blog = Blogs::find($id);
        dd($blog);
    }

    public function softDelete()
    {
        $page = 'Trash';
        $title = 'Post deleted';

        $blogs = Blogs::onlyTrashed()->get();

        return view('blogs.trash', compact('page', 'title', 'blogs'));
    }

    public function restoreDelete(Request $request)
    {
        // Get id from request
        $allId = $request->all();

        // Slice Token and Method
        $allId = array_slice($allId, 2); 

        Blogs::withTrashed()->whereIn('id', $allId)->restore();

        return redirect()->back()->with('success', 'Record recovery successful !');
    }

    public function realDelete(Request $request)
    {
        // Get id from request
        $allId = $request->all();

        // Slice Token and Method
        $allId = array_slice($allId, 2);

        Blogs::withTrashed()->whereIn('id', $allId)->forceDelete();;

        return redirect()->back()->with('success', 'Delete record successfully !');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit Blog';
        $title = 'Edit Blogs Page';

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
    public function update(Request $request, $id)
    {
        Blogs::where('id', $id)->update([
            'title' => $request->title,
            'image' => 'laravel-bg-1.png',
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
    public function destroy($id)
    {
        Blogs::find($id)->delete();

        return redirect()->back()->with('success', 'Delete record successfully !');
    }
}
