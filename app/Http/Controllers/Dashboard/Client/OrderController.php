<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {

    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(3);
        return view('Dashboard.Clients.Orders.create', compact('client', 'categories', 'orders'));
    }

    public function store(Request $request, Client $client)
    {

        $request->validate([
             'products' => 'required|array',
        ]);

        $this->attach_order($request, $client);


        session()->flash('success', __('site.added_successfully'));
          return redirect()->route('dashboard.orders.index');
    }


    public function edit(Client $client, Order $order)
    {

        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(3);

        return view('dashboard.clients.orders.edit', compact('categories', 'order', 'client', 'orders'));

    }

    public function update(Request $request, Client $client, Order $order)

    {

        $this->detach_order($order);
        $this->attach_order($request, $client);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    }

    public function destroy(Client $client, Order $order)
    {
// dd($order->products->first()->pivot->quantity);
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
            ]);
        }

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');
    }


//attach_order function

    private function attach_order($request, $client)
    {


        $total_price = 0;
        $total_purchase = 0;

        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);


        foreach ($request->products as $id => $quantity) {

            $product = Product::findOrFail($id);


            $total_price += $product->sale_price * $quantity['quantity'];
            $total_purchase += $product->purchase_price * $quantity['quantity'];

            $product->update([
                'now_stock' => $product->stock - $quantity['quantity']
            ]);


            $order->update([
                'total_price' => $total_price,
                'total_purchase' => $total_purchase,

            ]);

        }
    }

    //privet function to remove order

    private function detach_order($order)
    {

        // dd($order->products->first()->pivot->quantity);
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
            ]);
        }

        $order->delete();


    }
}


