@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.clients')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><i class="fa fa-clients">@lang('site.clients')</i>

            </ol>


        </section>
        <section>

            <div class=" box box-primary" style="margin-top: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin: 10px 0">@lang('site.clients') </h3>
                    <form action="" method="">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                       value="{{request()->search}}">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-search"></i> @lang('site.search')</button>
                                <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"><i
                                        class="fa fa-search"></i> @lang('site.add') </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if($clients->count() > 0)
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>

                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.phone')</th>
                                    <th>@lang('site.address')</th>
                                    <th>@lang('site.add_order')</th>


                                </tr>

                                </thead>
                                <tbody>
                                @foreach($clients as $index=>$client)
                                    <tr>
                                        <td>{{$index + 1}}</td>

                                        <td>{{$client->name}}</td>
                                        <td>{{is_array($client->phone)?implode($client->phone,'-'):$client->phone  }}</td>
                                        <td>{{$client->address}}</td>

                                        <td>
                                            @if(auth()->user()->hasPermission('create_orders'))
                                            <a href="{{route('dashboard.clients.orders.create',$client->id)}}"
                                               class="btn btn-primary">@lang('site.add_order')</a>
                                            @else
                                                <button
                                                    class=" btn btn-info  btn-sm disabled">@lang('site.add_order')</button>

                                            @endif
                                        </td>
                                        <td>

                                            @if(auth()->user()->hasPermission('update_clients'))
                                            <a class=" btn btn-info btn-sm"
                                               href="{{route('dashboard.clients.edit',$client->id)}}">@lang('site.edit')</a>
                                            @else
                                                <button
                                                    class=" btn btn-info  btn-sm disabled">@lang('site.edit')</button>

                                            @endif
                                            @if(auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{route('dashboard.clients.destroy',$client->id)}}"
                                                  method="post" style="display: inline-block">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <button type="submit"
                                                        class=" btn btn-danger delete btn-sm">@lang('site.delete')</button>

                                            </form>
                                                @else
                                                    <button
                                                        class=" btn btn-danger  btn-sm disabled">@lang('site.delete')</button>

                                                @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="text-center" style="background-color: #3c8dbc">


                        </div>

                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif()
                </div>
            </div>
        </section>


    </div>
@endsection
