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
                    <form action="{{route('dashboard.categories.store')}}" method="post" >
                        {{csrf_field()}}
                        {{method_field('post')}}

                        @foreach(config('translatable.locales') as $locale)
                            <div class="form-group">
                                <label>@lang('site.'.$locale.'.name')</label>
                                <input type="text" class="form-control" name="{{$locale}}[name]" value="{{old($locale.'.name')}}">
                            </div>

                        @endforeach







                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')
                        </button>
                    </form>
                </div>
            </div>
        </section>


    </div>
@endsection
