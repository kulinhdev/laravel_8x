<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(4);

        $page = 'Categories';
        $title = 'All Categories';
        return view('categories.index', compact('page', 'title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories',
            'status' => 'required',
        ]);

        Category::create($request->all());

        $message = 'Insert record successfully !';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoryHasOneProduct = Category::find($id);
        dd($categoryHasOneProduct->product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Categories';
        $title = 'All Categories';
        $category = Category::find($id);

        return view('categories.edit', compact('page', 'title', 'category'));
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
        Category::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        // Category::find($id)->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        $message = 'Delete record successfully !';
        return redirect()->back()->with('success', $message);

    }

    // *** softDelete - Show View Trash *** \\
    public function softDelete()
    {
        $page = 'Categories Trash';
        $title = 'Categories deleted';

        $categoriesDeleted = Category::onlyTrashed()->get();

        return view('categories.trash', compact('page', 'title', 'categoriesDeleted'));
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
            Category::withTrashed()->whereIn('id', $allId)->restore();

            return redirect()->back()->with('success', 'Record recovery successful !');

        } else {

            // Delete
            Category::withTrashed()->whereIn('id', $allId)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
