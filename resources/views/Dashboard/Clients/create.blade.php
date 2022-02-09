@extends('layouts.Dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4 class="box-title">@lang('site.add')</h4>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"> <i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>

                <li><a href=""><i class="fa fa-users"></i>@lang('site.clients')</a></li>
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
                    <form action="{{route('dashboard.clients.store')}}" method="post" >
                        {{csrf_field()}}
                        {{method_field('post')}}
                            <div class="form-group">
                                <label>@lang('site.name')</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        @for($i = 0 ;$i<2; $i++)
                        <div class="form-group">
                                <label>@lang('site.phone')</label>
                                <input type="text" class="form-control" name="phone[]">
                            </div>
                        @endfor

                        <div class="form-group">
                                <label>@lang('site.address')</label>
                            <textarea  class="form-control" name="address"></textarea>
                            </div>





                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')
                        </button>
                    </form>
                </div>
            </div>
        </section>


    </div>
@endsection
