<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');

        })->paginate(5);
        return view('dashboard.orders.index', compact('orders'));

//
//        $orders = Order::paginate(5);
//
//        return view('Dashboard.Orders.index',compact('orders'));
    }


    public function products(Order $order)
    {

        $products = $order->products;
        return view('dashboard.orders._products', compact('order', 'products'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }


    public function destroy(Order $order)
    {
       // dd($order->products->first()->pivot->quantity);
        foreach ($order->products as $product){
            $product->update([
                'stock'=> $product->stock + $product->pivot->quantity,
            ]);
        }

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    }


}

