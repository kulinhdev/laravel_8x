<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::paginate(2);
        $page = 'Product';
        $products = [];
        return view('product.index', compact('products', 'page'));
    }

    public function detail($id)
    {
        $data = ['Iphone 12 Pro Max', 'SamSung Ultra 12', 'Huawei Mate 20 Pro', 'Xiaomi Note 10', 'Nokia 1280'];
        return view('product.detail', [
            'product' => $data[$id] ?? 'Product ' . $id . ' does not exits !'
        ]);
    }
}
