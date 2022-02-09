<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index( Request $request)
    {
        $categories = Category::when($request->search, function ($query) use ($request) {
                return $query->whereTranslationLike('name',  '%' . $request->search . '%');


            })->latest()->paginate(5);

        return  view('Dashboard.Categories.index',compact('categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('Dashboard.categories.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'ar.name' => 'required|unique:category_translations,name',
            'en.name' => 'required|unique:category_translations,name',

        ]);

        $request_data = $request->except(['_token']);

        $request_data = $request->all();


        $user = Category::create($request_data);

      //  $user->attachRole('admin');

        //   $user->syncPermissions($request->permissions);


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');

    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));

    }

    public function update(Request $request, Category $category)
    {




        $request->validate([
            'ar.name' => 'required|unique:category_translations,name',
            'en.name' => 'required|unique:category_translations,name',

        ]);

        $category->update($request->all());

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');

    }


    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.categories.index');

    }
}
