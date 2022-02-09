<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:update_users'])->only('update');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index(Request $request)
    {

        /*
        if ($request->search) {
            $users = user::where('first_name', 'like', '%' . $request->search . '%')
            ->orWhere('last_name','like','%'.$request->search.'%')->get();
        } else {
            $users = User::whereRoleIs('admin')->get();
        }
        */
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        })->latest()->paginate(5);
//        $users = User::whereRoleIs('admin')->when($request->search, function ($query) use ($request) {
//            return $query->where('first_name', 'like', '%' . $request->search . '%')
//                ->orWhere('last_name', 'like', '%' . $request->search . '%');
//
//        })->latest()->paginate(5);

        return view('Dashboard.Users.index', compact('users'));
    }


/*****************************  create  ********************************/


    public function create()
    {
        $users = User::all();
        return view('Dashboard.Users.create', compact('users'));
    }


    /**********************************  Store  ********************************/


    public function store(Request $request)
    {


        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'permissions' => 'required'
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);



        if ($request->image) {
          \Intervention\Image\Facades\Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/users_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        };


        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.users.index');


    }

    /*****************************  Edit  ********************************/



    public function edit(User $user)
    {
        // return $user;
        return view('Dashboard.Users.edit', compact('user'));
    }


    /*****************************  Update  ********************************/



    public function update(Request $request, User $user)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|confirmed',
            'image' => 'image'
        ]);

        $request_data = $request->except(['permissions', 'password' ,'password_confirmation']);
        $request_data['password'] = bcrypt($request->password);


        if ($request->image) {
            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/users_images/' . $user->image);

                \Intervention\Image\Facades\Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_images/' . $request->image->hashName()));
                $request_data['image'] = $request->image->hashName();

            }
        };

        $user->update($request_data);

        $user->syncPermissions($request->permissions);


        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    /*****************************  Delete  ********************************/



    public function destroy(User $user)
    {


        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/users_images/' . $user->image);

        }//end of if


        $user->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
