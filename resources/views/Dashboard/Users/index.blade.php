@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.users')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><i class="fa fa-users">@lang('site.users')</i>

            </ol>


        </section>
        <section>

            <div class=" box box-primary" style="margin-top: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin: 10px 0">@lang('site.users') {{$users->total()}}</h3>
                    <form action="" method="">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                       value="{{request()->search}}">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-search"></i> @lang('site.search')
                                </button>


                                    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i
                                            class="fa fa-search"></i> @lang('site.add') </a>


                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if($users->count() > 0)
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.first_name')</th>
                                    <th>@lang('site.last_name')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.action')</th>

                                </tr>

                                </thead>
                                <tbody>
                                @foreach($users as $index=>$user)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td><img class="img-thumbnail" src="{{$user->image_path}}"
                                                 style="width: 120px;height: 80px" alt=""></td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_users'))
                                                <a class=" btn btn-info btn-sm"
                                                   href="{{route('dashboard.users.edit',$user->id)}}">@lang('site.edit')
                                                </a>
                                            @else
                                                <button
                                                    class=" btn btn-info  btn-sm disabled">@lang('site.edit')
                                                </button>

                                            @endif
                                            @if(auth()->user()->hasPermission('delete_users'))
                                                <form action="{{route('dashboard.users.destroy',$user->id)}}"
                                                      method="post"
                                                      style="display: inline-block">
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

                            {{$users->appends(request()->query())->links()}}

                        </div>

                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif()
                </div>
            </div>
        </section>


    </div>
@endsection
