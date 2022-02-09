@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4 class="box-title">@lang('site.add')</h4>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>

                <li><a href="{{route('dashboard.users.index')}}"><i class="fa fa-users"></i>@lang('site.users')</a></li>
                <li class="active"></i>@lang('site.add')</li>

            </ol>

        </section>

        <section class="content">
            <div class=" box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.add')</h3>

                </div>
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{route('dashboard.products.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}
                        <label>@lang('site.categories')</label>
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"{{old('category_id')==$category->id?'selected': ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach(config('translatable.locales') as $locale)

                            <div class="form-group">
                                <label>@lang('site.'.$locale.'.name')</label>
                                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{old($locale.'.name')}}">
                            </div>
                            <div class="form-group">
                                <label>@lang('site.'.$locale.'.description')</label>

                                <textarea type="text" class="form-control ckeditor" name="{{$locale}}[description]"> {{old($locale.'.description')}}</textarea>
                            </div>


                        @endforeach



                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image"  value="{{old('image')}}" >
                        </div>
                        <div class="form-group">
                            <img class="img-thumbnail image-preview" style="width: 90px" src="{{asset('uploads/products_images/default.png')}}" alt="">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.purchase_price')</label>
                            <input type="number" class="form-control" name="purchase_price"  value="{{old('purchase_price')}}" >
                        </div>
                        <div class="form-group">
                            <label>@lang('site.sale_price')</label>
                            <input type="number" class="form-control" name="sale_price"  value="{{old('sale_price')}}" >
                        </div>
                        <div class="form-group">
                            <label>@lang('site.stock')</label>
                            <input type="number" class="form-control" name="stock"  value="{{old('stock')}}">
                        </div>



                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')
                        </button>
                    </form>
                </div>
            </div>
        </section>


    </div>
@endsection
