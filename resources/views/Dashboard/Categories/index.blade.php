@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.categories')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><i class="fa fa-categories">@lang('site.categories')</i>

            </ol>


        </section>
        <section>

            <div class=" box box-primary" style="margin-top: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin: 10px 0">@lang('site.categories') </h3>
                    <form action="" method="">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                       value="{{request()->search}}">

                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-search"></i> @lang('site.search')</button>
                                <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary"><i
                                        class="fa fa-search"></i> @lang('site.add') </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.products_count')</th>
                                    <th>@lang('site.related_products')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index=>$category)
                                <tr>
                                    <td>{{$index + 1}}</td>

                                    <td>{{$category->name}}</td>
                                    <td>{{$category->products->count()}}</td>
                                    <td><a href="{{route('dashboard.products.index',['category_id'=>$category->id])}}"
                                           class="btn btn-primary btn-sm">@lang('site.related_products')</a></td>
                                    <td>
                                        @if(auth()->user()->hasPermission('delete_categories'))
                                        <a class=" btn btn-info btn-sm"
                                           href="{{route('dashboard.categories.edit',$category->id)}}">@lang('site.edit')</a>
                                        @else
                                            <button
                                                class=" btn btn-info  btn-sm disabled">@lang('site.edit')</button>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_categories'))
                                        <form action="{{route('dashboard.categories.destroy',$category->id)}}"
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
                        <div class="text-center" style="background-color: #3c8dbc">
                        </div>
                    </div>
                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif()
                </div>
            </div>
        </section>


    </div>
@endsection
