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
                    <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}
                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" class="form-control image" name="image" >
                        </div>
                        <div class="form-group">
                           <img class="img-thumbnail image-preview" style="width: 90px" src="{{asset('uploads/users_images/default.png')}}" alt="">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.password')</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.password_confirmation')</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            <div style="margin: 10px" class="row">
                                <div class="col-12">
                                    <!-- Custom Tabs -->
                                    <div class="card">
                                        <div class="card-header d-flex p-0">
                                            @php
                                                $models = ['users','categories','products' ,'clients', 'orders'];
                                                $maps = ['create','read','update','delete'];

                                            @endphp
                                            <ul class="nav nav-pills ml-auto p-2">
                                                @foreach($models as $index=>$model)
                                                    <li class="nav-item {{$index == 0 ? 'active' : ''}}"><a href="#{{$model}}"data-toggle="tab">@lang('site.'.$model)</a> </li>
                                                @endforeach

                                            </ul>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                @foreach($models as $index=>$model)
                                                    <div class="tab-pane {{$index=0? 'active' : ''}}" id="{{$model}}">
                                                        @foreach($maps as $map)
                                                            <label><input type="checkbox" name="permissions[]" value="{{$map . '_' . $model}}">@lang('site.'.$map)</label>
                                                        @endforeach
                                                    </div>

                                                @endforeach

                                                <!-- /.tab-pane -->

                                                <!-- /.tab-pane -->
                                            </div>
                                            <!-- /.tab-content -->
                                        </div><!-- /.card-body -->
                                    </div>
                                    <!-- ./card -->
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')
                        </button>
                    </form>
                </div>
            </div>
        </section>


    </div>
@endsection
