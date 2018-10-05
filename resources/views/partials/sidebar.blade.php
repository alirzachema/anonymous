@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            @can('business_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>@lang('quickadmin.business-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('company_access')
                    <li>
                        <a href="{{ route('admin.companies.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('quickadmin.companies.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('company_category_access')
                    <li>
                        <a href="{{ route('admin.company_categories.index') }}">
                            <i class="fa fa-folder"></i>
                            <span>@lang('quickadmin.company-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('product_access')
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>@lang('quickadmin.products.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('product_category_access')
                    <li>
                        <a href="{{ route('admin.product_categories.index') }}">
                            <i class="fa fa-folder"></i>
                            <span>@lang('quickadmin.product-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('product_tag_access')
                    <li>
                        <a href="{{ route('admin.product_tags.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('quickadmin.product-tags.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('location_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('quickadmin.locations.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('state_access')
                    <li>
                        <a href="{{ route('admin.states.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('quickadmin.states.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('city_access')
                    <li>
                        <a href="{{ route('admin.cities.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('quickadmin.cities.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_action_access')
                    <li>
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('quickadmin.user-actions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

