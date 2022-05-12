<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex-inline justify-content-between">
                <div class="logo">
                    <a href="">
                        <h4>Info Thek</h4>
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu" id="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item">
                    <a href="{{route('admin_dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{--main category--}}
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-folder"></i>
                        <span>Main Category</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{route('admin_create_main_category')}}">Create</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{route('admin_get_main_categories')}}">List</a>
                        </li>
                    </ul>
                </li>

                {{--sub category--}}
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-folder2"></i>
                        <span>Sub Category</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{route('admin_create_sub_category')}}">Create</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{route('admin_get_sub_categories')}}">List</a>
                        </li>
                    </ul>
                </li>

                {{--sub sub category--}}
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-folder2-open"></i>
                        <span>Sub-Sub Category</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="{{route('admin_create_sub_sub_category')}}">Create</a>
                        </li>
                        <li class="submenu-item">
                            <a href="{{route('admin_get_sub_sub_categories')}}">List</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
