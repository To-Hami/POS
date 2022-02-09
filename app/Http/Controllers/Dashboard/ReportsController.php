<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ReportsController extends Controller
{

    public function index(Product $products)
    {
        $products = Product::paginate(5);

//
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();

        $sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at)  as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->paginate(5);


        $purchases_data = Order:: select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at)  as month'),
            DB::raw('SUM(total_purchase) as sum'),
            DB::raw('SUM(total_price) as total_price')
        )->groupBy('month')->paginate(5);


       return view('dashboard.reports.index', compact('sales_data', 'purchases_data','products'));

    }


}
