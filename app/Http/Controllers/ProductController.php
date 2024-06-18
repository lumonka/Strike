<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $product = DB::table('products')
            ->join(
                'categories',
                'categories.id',
                '=',
                'products.product_type'
            )->where('products.id', $id)
            ->first();
        if (!is_null($product)) {
            $product->id = intval($id);
            return view('product', ['product' => $product]);
        } else {
            return abort(404);
        }
        $product->id = intval($id);
        return view('product', ['product' => $product]);
    }
    public function getProducts(Request $request)
    {
        $products = DB::table('products')->join(
            'categories',
            'categories.id',
            '=',
            'products.product_type'
        )->select(
            'products.id as id',
            'products.*',
            'categories.product_type as product_type'
        )->get();
        return view('admin.products', ['products' => $products]);
    }
    public function getProductById(Request $request)
    {
        $id = $request->id;
        $categories = DB::table('categories')->get();
        $product = DB::table('products')->join(
            'categories',
            'categories.id',
            '=',
            'products.product_type',
        )->select(
            'products.id as id',
            'products.*',
            'categories.product_type as product_type'
        )->where('products.id', $id)->first();

        if (!is_null($product)) {
            return view('admin.product-edit', ['categories' => $categories, 'product' => $product]);
        } else {
            return abort(404);
        }
    }
    public function editProduct(Request $request)
    {
        $product = DB::table('products')->where('id', $request->id);
        $product->update([
            'title' => $request->input('title'),
            'qty' => $request->input('qty'),
            'price' => $request->input('price'),
            'product_type' => $request->input('category'),
            'img' => $request->input('img'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        return redirect()->route('admin.products');
    }
    public function createProductView()
    {
        $categories = DB::table('categories')->get();
        return view('admin.product-create', ['categories' => $categories]);
    }
    public function createProduct(Request $request)
    {
        DB::table('products')->insert([
            'title' => $request->input('title'),
            'qty' => $request->input('qty'),
            'price' => $request->input('price'),
            'product_type' => $request->input('category'),
            'img' => $request->input('img'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        return redirect()->route('admin.products');
    }
    public function deleteProduct(Request $request)
    {
        $product = DB::table('products')->where('id', $request->id);
        $product->delete();
        return redirect()->route('admin.products');
    }
}
