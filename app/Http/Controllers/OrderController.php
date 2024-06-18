<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderController extends Controller
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
        return view('createOrder', ['cart' => $goodCart, 'total' => $total]);
    }
    public function createOrder(Request $request)
    {
        if (Hash::check($request->get('password'), $request->user()->password)) {
            $orderTable = DB::table('orders');
            $userCartTable = DB::table('cart')->where('uid', $request->user()->id)->get();

            $orderNumber = Str::random(8);
            $checkOrderNumber = $orderTable->where('number', $orderNumber)->get()->groupBy(['number', 'uid'])->all();
            $orderNumber = $checkOrderNumber > 0 ? Str::random(8) : $orderNumber;

            foreach ($userCartTable as $cartItem) {
                $orderTable->insert(['uid' => $cartItem->uid, 'pid' => $cartItem->pid, 'qty' => $cartItem->qty, 'number' => $orderNumber]);
            }
            DB::table('cart')->where('uid', $request->user()->id)->delete();
            return response()->json(['message' => 'good']);
        } else {
            return response()->json(['message' => 'err']);
        }
    }
    public function getOrders(Request $request)
    {
        $goodOrders = [];
        $filter = $request->query('filter');
        if ($filter == 'new') {
            $ordersTable = DB::table('orders')->where('status', 'Новый');
        } elseif ($filter == 'confirmed') {
            $ordersTable = DB::table('orders')->where('status', 'Подтвержден');
        } elseif ($filter == 'canceled') {
            $ordersTable = DB::table('orders')->where('status', 'Отменен');
        } else {
            $ordersTable = DB::table('orders');
        }
        $ordersTable = $ordersTable->get()->groupBy(['number']);

        foreach ($ordersTable as $order) {
            $openedOrder = $order->all();
            $userName = DB::table('users')->where('id', $openedOrder[0]->uid)
                ->select('name')->first();
            $date = $openedOrder[0]->created_at;
            $orderNumber = $openedOrder[0]->number;
            $orderStatus = $openedOrder[0]->status;

            $totalPrice = 0;
            $totalQty = 0;
            $products = [];

            foreach ($openedOrder as $orderItem) {
                $product = DB::table('products')->where('id', $orderItem->pid)->first();
                $totalPrice += $product->price * $orderItem->qty;
                $totalQty += $orderItem->qty;

                array_push(
                    $products,
                    (object)[
                        'title' => $product->title,
                        'price' => $product->price,
                        'qty' => $orderItem->qty,
                    ]
                );
            }
            array_push(
                $goodOrders,
                (object)[
                    'name' => $userName->name,
                    'number' => $orderNumber,
                    'products' => $products,
                    'date' => $date,
                    'totalPrice' => $totalPrice,
                    'totalQty' => $totalQty,
                    'status' => $orderStatus,
                ]
            );
        }
        return view('admin.orders', ['orders' => $goodOrders]);
    }
    public function editOrderStatus(Request $request)
    {
        $action = $request->action;
        $orderNumber = $request->number;
        $order = DB::table('orders')->where('number', $orderNumber);

        if ($action == 'confirm') {
            $order->update(['status' => 'Подтвержден']);
        } elseif ($action == 'cancel') {
            $order->update(['status' => 'Отменен']);
        } else {
            return abort(404);
        }
        return redirect()->route('admin.orders');
    }
    public function deleteOrder(Request $request)
    {
        $order = DB::table('orders')->where('uid', $request->user()->id)->where('number', $request->number);
        $status = $order->get()[0]->status;

        if (!is_null($order) && $status == 'Новый') {
            $order->delete();
            return redirect()->route('user');
        } else {
            return abort(404);
        }
    }
}
