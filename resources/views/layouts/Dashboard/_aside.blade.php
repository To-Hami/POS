<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{'http://127.0.0.1:8000/uploads/users_images/'. auth()->user()->image}}"
                     style="width: 90px;height: 50px" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->first_name . ' '  .auth()->user()->last_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="side_links"><a href="{{route('dashboard.index')}}"><i
                        class=" icon fa fa-th fa-desktop"></i><span>@lang('site.dashboard')</span></a></li>
            @if (auth()->user()->hasPermission('read_categories'))

                    <li class="side_links"><a href="{{route('dashboard.categories.index')}}"><i
                                class=" icon fa fa-th fa-navicon"></i>@lang('site.categories')</a></li>


            @endif

            @if (auth()->user()->hasPermission('read_products'))
                <li class="side_links"><a href="{{route('dashboard.products.index')}}"><i
                            class=" icon fa fa-th fa-cubes"></i><span>@lang('site.products')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_clients'))
                <li class="side_links"><a href="{{route('dashboard.clients.index')}}"><i
                            class=" icon fa fa-th fa-group"></i><span>@lang('site.clients')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_orders'))
                <li class="side_links"><a href="{{route('dashboard.orders.index')}}"><i
                            class=" icon fa fa-th fa-gift"></i><span>@lang('site.orders')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_reports'))

                <li class="side_links"><a href="{{ route('dashboard.reports.index') }}"><i
                            class=" icon fa fa-th fa fa-edit"></i><span>@lang('site.reports')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('read_users'))
                <li class="  side_links"><a href="{{ route('dashboard.users.index') }}"><i class="icon fa fa-th fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif

        </ul>

    </section>

</aside>

