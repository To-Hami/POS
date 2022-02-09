<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductTranslation;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search .'%');
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id',  $request->category_id );
        })
            ->latest()->paginate(5);
        return view('Dashboard.Products.index',compact(['categories','products']));
    }


    public function create()
    {
        $categories = Category::all();

        return view('Dashboard.Products.create',compact('categories'));

    }

    public function store(Request $request)
    {

       $rules = [];

       foreach (config('translatable.locales' )as $locale){
           $rules+=[$locale.'.name' => 'required|unique:product_translations,name'];
           $rules+=[$locale.'.description' => 'required'];
       }

       $rules+=[
         'purchase_price' =>'required',
         'sale_price' =>'required',
         'stock' =>'required',
       ];

       $request->validate($rules);


        $request_data = $request->except('image');
        if ($request->image) {
            \Intervention\Image\Facades\Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        };

        Product::create($request_data);

         //  $user->attachRole('admin');

        //   $user->syncPermissions($request->permissions);


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }


    public function edit(Product $product)
    {
        $categories = Category::all();
     return view('dashboard.products.edit',compact(['product','categories']));
    }


    public function update(Request $request, Product $product)
    {

        $rules = [
            'category_id'=>'required'
        ];

        foreach (config('translatable.locales' )as $locale){
            $rules+=[$locale.'.name' => ['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')]];
            $rules+=[$locale.'.description' => 'required'];
        }
        $rules+=[
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' =>'required',
        ];

        $request->validate($rules);

        if($request->image){
            if($product->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/products_images'.$product->image);
            }
        }

        $request_data = $request->except('image');
        if ($request->image) {
            \Intervention\Image\Facades\Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/products_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        };

        $product->update($request_data);

        // $user->attachRole('admin');

        //   $user->syncPermissions($request->permissions);


        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');

    }


    public function destroy(Product $product)
    {


            if($product->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/products_images'.$product->image);
            }

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');

    }
}
