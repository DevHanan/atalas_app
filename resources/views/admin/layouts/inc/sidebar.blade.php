<!-- Sidemenu -->
<div class="navbar-content scroll-div ps ps--active-y">
    <ul class="nav pcoded-inner-navbar">

        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                <span class="pcoded-mtext"> لوحة التحكم</span>
            </a>
        </li>

        <li class="nav-item pcoded-hasmenu @if ( Request::is('admin/province*')  || Request::is('admin/district*')) pcoded-trigger @endif ">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                <span class="pcoded-mtext">البيانات الأساسية</span>
            </a>
            <ul class="pcoded-submenu" @if ( Request::is('admin/province') || Request::is('admin/district') || Request::is('admin/sliders') || Request::is('admin/pages')) style="display:block;" @else style="display:none;" @endif>

                <li class="{{ Request::is('admn/province*') ? 'active' : '' }}"><a href="{{ route('admin.province.index') }}" class="">

                        <span class="pcoded-mtext">
                            المدن </span></a></li>

                <li class="{{ Request::is('admin/district*') ? 'active' : '' }}"><a href="{{ route('admin.district.index') }}" class="">

                        <span class="pcoded-mtext"> المناطق</span></a></li>
                <li><a href="{{route('admin.sliders.index')}}" style="font-size: 16px;">

                        <span class="pcoded-mtext"> الاعلانات </span>
                    </a></li>

                <li><a href="{{route('admin.pages.index')}}" style="font-size: 16px;">

                        <span class="pcoded-mtext"> الصفحات </span>
                    </a></li>


            </ul>
        </li>
        <li class="{{ Request::is('admn/clients*') ? 'active' : '' }}">
            <a href="{{ route('admin.clients.index') }}" class="">
                <span class="pcoded-micon"><i class="fa fa-user"></i></span>
                <span class="pcoded-mtext">
                    العملاء </span></a>
        </li>
      
        <li class="{{ Request::is('admn/orders*') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index') }}" class="">
                <span class="pcoded-micon"><i class="fa fa-first-order"></i></span>
                <span class="pcoded-mtext">
                    الطلبات </span></a>
        </li>
        <li class="{{ Request::is('admn/visits*') ? 'active' : '' }}">
            <a href="{{ route('admin.visits.index') }}" class="">
                <span class="pcoded-micon"><i class="fa fa-eye"></i></span>
                <span class="pcoded-mtext">
                    الزيارات </span></a>
        </li>

        <li class="nav-item pcoded-hasmenu @if ( Request::is('admin/sales*')  ) pcoded-trigger @endif ">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-users-cog"></i></span>
                <span class="pcoded-mtext">إدارة المخزون </span>
            </a>
            <ul class="pcoded-submenu" @if ( Request::is('admin/sections') || Request::is('admin/categories') || Request::is('admin/companies') || Request::is('admin/products')) style="display:block;" @else style="display:none;" @endif>



                <li class="{{ Request::is('admin/sections*') ? 'active' : '' }}"><a href="{{ url('admin/sections') }}" class="">
                        <span class="pcoded-mtext">
                            الأقسام

                        </span> </a></li>

                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}"><a href="{{ url('admin/categories') }}" class="">
                        <span class="pcoded-mtext">
                            الفئات

                        </span> </a></li>
                <li class="{{ Request::is('admin/companies*') ? 'active' : '' }}"><a href="{{ url('admin/companies') }}" class="">
                        <span class="pcoded-mtext">
                            الشركات

                        </span> </a></li>

                <li class="{{ Request::is('admin/products*') ? 'active' : '' }}"><a href="{{ url('admin/products') }}" class="">
                        <span class="pcoded-mtext">
                            المنتجات

                        </span> </a></li>

            </ul>
        </li>


        <li class="nav-item pcoded-hasmenu @if ( Request::is('admin/sales*') ) pcoded-trigger @endif ">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-users-cog"></i></span>
                <span class="pcoded-mtext"> المندوبين </span>
            </a>
            <ul class="pcoded-submenu" @if ( Request::is('admin/sales') ) style="display:block;" @else style="display:none;" @endif>



                <li class="{{ Request::is('admin/delivery*') ? 'active' : '' }}"><a href="{{ url('admin/delivery') }}" class="">
                        <span class="pcoded-mtext">
                            مندوبين التوصيل

                        </span> </a></li>

                <li class="{{ Request::is('admin/sales*') ? 'active' : '' }}"><a href="{{ url('admin/sales') }}" class="">
                        <span class="pcoded-mtext">
                            مندوبين المبيعات

                        </span> </a></li>
             

            </ul>
        </li>
<!-- 
        <li class="{{ Request::is('admn/users/staff*') ? 'active' : '' }}">
            <a href="{{ url('admn/users/staff') }}" class="">
                <span class="pcoded-micon"><i class="fa-solid fa-city"></i></span>
                <span class="pcoded-mtext">
                    المستخدمين </span></a>
        </li> -->
     







        <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}" class="">
                <span class="pcoded-micon"><i class="fas fa-user-edit"></i></span>
                <span class="pcoded-mtext">
                    الإعدادت العامة </span> </a></li>




    </ul>
</div>
<!-- End Sidebar -->