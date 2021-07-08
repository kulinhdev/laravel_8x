<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\AddProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        $page = 'Products';
        $title = 'All Products';
        return view('products.index', compact('page', 'title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategory = Category::all();
        $page = 'Add Product';
        $title = 'All New Product';
        return view('products.create', compact('page', 'title', 'allCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {

        if ($request->file('image')) {

            $file = $request->file('image');

            $file_name = $file->getClientOriginalName('image');

            // Customize Image Url
            $time = date('Y-m-d-H-i-s-');
            $rand = Str::random(10) . '-';
            $image_name = $time . $rand . $file_name;

            $file->move('uploads/products', $image_name);
        }

        Product::create([
            'name' => $request->name,
            'image' => $image_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productDetail = Product::find($id);
        dd($productDetail->category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editProduct = Product::find($id);
        $allCategory = Category::all();
        $page = 'Edit Product';
        $title = 'Update Product';
        return view('products.edit', compact('page', 'title', 'editProduct', 'allCategory'));
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

        $pro = Product::where('id', $id)->first();

        $image_name = $pro->image;

        // Unique except curren id 
        // + C1: 'unique:products,name,'.$pro->id
        // + C2: Rule::unique('products')->ignore($pro->id)
        
        $request->validate([
            'name' => ['required', 'min:6', Rule::unique('products')->ignore($pro->id)],
            'image' => 'mimes:jpg,jpeg,png',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName('image');

            // Unlink old file
            unlink('uploads/products/'.$image_name);

            // Customize Image Url
            $time = date('Y-m-d-H-i-s-');
            $rand = Str::random(10) . '-';
            $image_name = $time . $rand . $file_name;

            $file->move('uploads/products', $image_name);
        }

        $pro->update([
            'name' => $request->name,
            'image' => $image_name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->back()->with('success', 'Delete record successfully !');
    }

    // *** softDelete - Show View Trash *** \\
    public function softDelete()
    {
        $page = 'Products Trashed';
        $title = 'Products Trashed';

        $productsDeleted = Product::onlyTrashed()->get();

        return view('products.trash', compact('page', 'title', 'productsDeleted'));
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
            Product::withTrashed()->whereIn('id', $allId)->restore();

            return redirect()->back()->with('success', 'Record recovery successful !');
        } else {

            // Unlink Images
            foreach ($allId as $id) {
                $image = Product::onlyTrashed()->where('id', $id)->first();
                $pathImg = "uploads/products/" . $image->image;
                // Check file exits
                if (file_exists($pathImg)) {
                    unlink($pathImg);
                }
            }

            Product::withTrashed()->whereIn('id', $allId)->forceDelete();

            return redirect()->back()->with('success', 'Delete record successfully !');
        }
    }
}
