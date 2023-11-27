<!-- Sidemenu -->
<div class="navbar-content scroll-div ps ps--active-y">
    <ul class="nav pcoded-inner-navbar">

        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                <span class="pcoded-mtext"> لوحة التحكم</span>
            </a>
        </li>
        <li><a href="{{route('admin.sliders.index')}}" style="font-size: 16px;">
                                             <span class="pcoded-micon"><i class="fa fa-sliders" aria-hidden="true"></i>
</span>
                <span class="pcoded-mtext">    الاعلانات  </span>
                                    </a></li>

                         <li><a href="{{route('admin.pages.index')}}" style="font-size: 16px;">  
                         <span class="pcoded-micon"><i class="fa-solid fa-file"></i>
</span>
                <span class="pcoded-mtext"> الصفحات   </span>
                                    </a></li>

                                    <li class="nav-item pcoded-hasmenu {{ Request::is('admin/job-request*') ? 'active' : '' }}">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-users-cog"></i></span>
                <span class="pcoded-mtext">إدارة  المخزون </span>
            </a>
            <ul class="pcoded-submenu">
                
               
          
         
         <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}"><a href="{{ url('admin/categories') }}" class="">  
         <span class="pcoded-mtext"> 
                      التصنيفات 
  
         </span> </a></li>

            </ul>
        </li>
                                    
                                

                                    <li class="{{ Request::is('admin/setting') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}" class="">
                    <span class="pcoded-micon"><i class="fas fa-user-edit"></i></span>
                <span class="pcoded-mtext"> 
                    الإعدادت العامة </span> </a></li>
       

    

    </ul>
</div>
<!-- End Sidebar -->