@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">

            <h1>@lang('site.reports')</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><i class="fa fa-users">@lang('site.reports')</i>

            </ol>


        </section>
        <section>

            <div class=" box box-primary" style="margin-top: 10px">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin: 10px 0">@lang('site.reports_sales_by_month') </h3>
                    {{--                    <form action="" method="">--}}
                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-md-4">--}}
                    {{--                                <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"--}}
                    {{--                                       value="{{request()->search}}">--}}

                    {{--                            </div>--}}
                    {{--                            <div class="col-md-4">--}}
                    {{--                                <button class="btn btn-primary" type="submit"><i--}}
                    {{--                                        class="fa fa-search"></i> @lang('site.search')--}}
                    {{--                                </button>--}}


                    {{--                                @if(auth()->user()->hasPermission('create_users'))--}}
                    {{--                                    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i--}}
                    {{--                                            class="fa fa-search"></i> @lang('site.add') </a>--}}
                    {{--                                @else--}}
                    {{--                                    <button--}}
                    {{--                                        class=" btn btn-primary  disabled">@lang('site.add')--}}
                    {{--                                    </button>--}}
                    {{--                                @endif--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}
                </div>
                <div class="box-body">
                    @if($sales_data->count() > 0)
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>@lang('site.month')</th>
                                    <th>@lang('site.all_purchases')</th>
                                    <th>@lang('site.all_sales')</th>
                                    <th>@lang('site.all_gelt')</th>


                                </tr>

                                </thead>
                                <tbody>
                                @foreach($purchases_data as $purchase_data)
                                    <tr>
                                        <td>{{$purchase_data->month }}</td>
                                        <td>
                                            {{ number_format($purchase_data->sum, 2)   }}
                                        </td>
                                        <td>
                                            {{ number_format($purchase_data->total_price, 2)   }}
                                        </td>
                                        <td>
                                            {{ number_format( $purchase_data->total_price -$purchase_data->sum)   }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>
                        </div>
                        <div class="text-center">

                            {{$sales_data->appends(request()->query())->links()}}

                        </div>


                    @endif()

                </div>
            </div>
        </section>
        <section class="content">

            <div class="row">


                <div class="box box-primary">

                    <div class="box-header">

                        <h3 class="box-title" style="margin-bottom: 10px">@lang('site.reports_products')</h3>


                    </div><!-- end of box header -->


                    <div class="box-body table-responsive">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>

                                <th>@lang('site.name')</th>
                                <th>@lang('site.categories')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.purchase_price')</th>
                                <th>@lang('site.sale_price')</th>
                                <th>@lang('site.Remaining_in_stock')</th>
                                <th>@lang('site.now_in_stock')</th>
                                <th>@lang('site.profit_product')</th>


                            </tr>

                            </thead>
                            <tbody>
                            @foreach($products as $index=>$product)
                                <tr>
                                    <td>{{$index + 1}}</td>

                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td><img class="img-thumbnail" style="width: 100px;height: 70px"
                                             src="{{$product->image_path}}" alt=""></td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>
                                        <span style="">{{$product->stock}}</span>
                                    </td>
                                    <td>@if($product->now_stock == 0)
                                            <span>
                                                 {{$product->stock}}
                                             </span>

                                        @else
                                            <span style="border: 1px solid #2d2a2a;
                                              background-color: #ef444e;
                                               color: aliceblue;
                                                padding: 5px 20px;
                                                 border-radius: 5px;">
                                                {{$product->now_stock}}

                                             </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$product->profit_product}}
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="text-center">

                        {{$sales_data->appends(request()->query())->links()}}

                    </div>

                </div><!-- end of box -->


            </div><!-- end of row -->

        </section><!-- end of content section -->


    </div>
@endsection
