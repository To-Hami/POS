<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('address', 'like', '%' . $request->search . '%');
              })->latest()->paginate(5);

       // return $clients;
        return  view('Dashboard.Clients.index',compact('clients'));
    }

    public function create()
    {
        return  view('Dashboard.Clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:0',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data=  $request->all();
        $request_data['phone']= array_filter($request->phone);
        Client::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return  redirect()->route('dashboard.clients.index');
    }



    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
    }

    public function update(Request $request, Client $client)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:0',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data=  $request->all();
        $request_data['phone']= array_filter($request->phone);
        $client->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return  redirect()->route('dashboard.clients.index');
    }

    public function destroy(Client  $client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return  redirect()->route('dashboard.clients.index');
    }
}
