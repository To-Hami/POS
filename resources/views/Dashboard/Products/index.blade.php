@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.products')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><i class="fa fa-products">@lang('site.products')</i>

            </ol>


        </section>
        <section>

            <div class=" box box-primary" style="margin-top: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin: 10px 0">@lang('site.products') </h3>
                    <form action="{{route('dashboard.products.index')}}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                       value="{{request()->search}}">

                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{$category->id}}"{{request()->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-search"></i> @lang('site.search')</button>
                                <a href="{{route('dashboard.products.create')}}" class="btn btn-primary"><i
                                        class="fa fa-search"></i> @lang('site.add') </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if($products->count() > 0)
                        <div class="box-body table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>

                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.description')</th>
                                    <th>@lang('site.categories')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.purchase_price')</th>
                                    <th>@lang('site.sale_price')</th>
                                    <th>@lang('site.stock')</th>

                                    <th>@lang('site.action')</th>

                                </tr>

                                </thead>
                                <tbody>
                                @foreach($products as $index=>$product)
                                    <tr>
                                        <td>{{$index + 1}}</td>

                                        <td>{{$product->name}}</td>
                                        <td>{!! $product->description !!}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td><img class="img-thumbnail" style="width: 100px;height: 70px"
                                                 src="{{$product->image_path}}" alt=""></td>
                                        <td>{{$product->purchase_price}}</td>
                                        <td>{{$product->sale_price}}</td>
                                        <td>{{$product->stock}}</td>

                                        <td style="width: 120px !important">
                                            @if(auth()->user()->hasPermission('update_products'))
                                            <a class=" btn btn-info btn-sm" style="display: inherit;margin-right: 2px"
                                               href="{{route('dashboard.products.edit',$product->id)}}">@lang('site.edit')
                                            </a>
                                            @else
                                                <button
                                                    class=" btn btn-info  btn-sm disabled" >@lang('site.edit')
                                                </button>

                                            @endif
                                            @if(auth()->user()->hasPermission('delete_products'))
                                            <form action="{{route('dashboard.products.destroy',$product->id)}}"
                                                  method="post"  style="display: inherit;margin-right: 2px">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <button type="submit"
                                                        class=" btn btn-danger delete btn-sm" style="display: inherit;margin-right: 2px">@lang('site.delete')</button>

                                            </form>
                                                @else
                                                    <button
                                                        class=" btn btn-danger  btn-sm disabled" >@lang('site.delete')
                                                    </button>

                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="text-center" style="background-color: #3c8dbc">

                            {{$products->appends(request()->query())->links()}}

                        </div>

                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif()
                </div>
            </div>
        </section>


    </div>
@endsection
