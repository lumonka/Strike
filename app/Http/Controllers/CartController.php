<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartTable = DB::table('cart')->where('uid', $request->user()->id)->get();
        $goodCart = [];
        $total = 0;
        foreach ($cartTable as $cartItem) {
            $product = DB::table('products')->select('title', 'price', 'qty', 'img')->where('id', $cartItem->pid)->first();
            $total += $cartItem->qty * $product->price;
            array_push(
                $goodCart,
                (object)[
                    'id' => $cartItem->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'qty' => $cartItem->qty,
                    'limit' => $product->qty,
                    'img' => $product->img
                ]
            );
        }
        return view('cart', ['cart' => $goodCart, 'total' => $total]);
    }
    public function addToCart(Request $request)
    {
        $cartTable = DB::table('cart');
        $itemInCart = $cartTable->where('uid', $request->user()->id)->where('pid', $request->id);

        $product = DB::table('products')->where('id', $request->id)->first();

        if (is_null($itemInCart->first())) {
            $cartTable->insert(['uid' => $request->user()->id, 'pid' => $request->id, 'qty' => 1]);
        } elseif ($product->qty > $itemInCart->first()->qty) {
            $itemInCart->update(['qty' => $itemInCart->first()->qty + 1]);
        } else {
            return xml_error_string('err');
        }
    }
    public function changeQty(Request $request)
    {
        $product = DB::table('cart')->where('uid', $request->user()->id)->where('id', $request->id);
        if ($request->param == "incr") {
            $product->update(['qty' => $product->first()->qty + 1]);
        }
        if ($request->param == "decr" && $product->first()->qty > 1) {
            $product->update(['qty' => $product->first()->qty - 1]);
        } elseif($request->param == "decr" && $product->first()->qty == 1) {
            $product->delete();
        }

//        $productInCart = DB::table('cart')->where('uid', $request->user()->id)->where('pid', $request->id);
//        $product = DB::table('products')->where('id', $request->id);
//
//        if ($request->param == "incr" && $product->first()->qty > $productInCart->first()->qty) {
//            $productInCart->update(['qty' => $productInCart->first()->qty + 1]);
//        }
//        if ($request->param == "decr" && $productInCart->first()->qty > 1) {
//            $productInCart->update(['qty' => $productInCart->first()->qty - 1]);
//        } elseif ($request->param == "decr" && $productInCart->first()->qty == 1) {
//            $productInCart->delete();
//        }
    }
}
