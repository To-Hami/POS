@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4 class="box-title">@lang('site.edit')</h4>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>

                <li><a href="{{route('dashboard.clients.index')}}"><i class="fa fa-clients"></i>@lang('site.clients')</a></li>
                <li class="active"></i>@lang('site.edit')</li>

            </ol>

        </section>

        <section class="content">
            <div class=" box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.edit')</h3>

                </div>
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{route('dashboard.clients.update',$client->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" class="form-control" name="name" value="{{$client->name}}">
                        </div>
                        @for($i = 0 ;$i<2; $i++)
                            <div class="form-group">
                                <label>@lang('site.phone')</label>
                                <input type="text" class="form-control" name="phone[]" value="{{$client->phone[$i] ?? ''}}">
                            </div>
                        @endfor


                        <div class="form-group">
                            <label>@lang('site.address')</label>
                            <input  type="text" class="form-control" name="address"  value="{{$client->address}}">
                        </div>




                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')
                        </button>
                    </form>
                </div>
            </div>
        </section>


    </div>
@endsection
