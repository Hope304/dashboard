<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="admin/images/1.jpg" width="52px"
            height="52px" alt="Avatar">
        <div style="box-sizing: border-box">
            <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
            @if (Auth::user()->role =='admin')
            <p class="app-sidebar__user-designation" style="color: #ffc107">Administrator</p>
            @endif
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item @if (Request()->is('admin/home')) active @endif" href="admin/home"><i
                    class="app-menu__icon fa fa-star"></i><span class="app-menu__label">Cấp nguy cơ cháy</span></a></li>
        <li><a class="app-menu__item @if (Request()->is('admin/receiveEmail/*')) active @endif"
                href="admin/receiveEmail/list"><i class="app-menu__icon fa fa-users"></i><span
                    class="app-menu__label">Quản lý thông tin và email</span></a></li>
        <li><a class="app-menu__item @if (Request()->is('admin/hotspot/*')) active @endif" href="admin/hotspot/list"><i
                    class="app-menu__icon fa fa-fire"></i><span class="app-menu__label">Quản lý điểm cháy</span></a>
        </li>
        <li><a class="app-menu__item @if (Request()->is('admin/notification/*')) active @endif"
                href="admin/notification/list"><i class="app-menu__icon fa fa-bell"></i><span
                    class="app-menu__label">Kiểm duyệt báo cháy</span></a>
        </li>
        <li><a class="app-menu__item @if (Request()->is('admin/exportData/*')) active @endif"
                href="admin/exportData/"><i class="app-menu__icon fa fa-download"></i><span
                    class="app-menu__label">Trích xuất dữ liệu</span></a>
        </li>
        @if (Auth::user()->role =='admin')
        <li><a class="app-menu__item @if (Request()->is('admin/shp/*')) active @endif" href="admin/shp/"><i
                    class="app-menu__icon fa fa-download"></i><span class="app-menu__label">Quản lý bản đồ</span></a>
        </li>

        <li><a class="app-menu__item @if (Request()->is('admin/backup/*')) active @endif" href="admin/backup/"><i
                    class="app-menu__icon fa fa-solid fa-rotate-right"></i><span class="app-menu__label">Sao lưu bản đồ</span></a>
        </li>
        <li><a class="app-menu__item @if (Request()->is('admin/dashboard')) active @endif" href="admin/dashboard/"><i
                    class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">Dashboard</span></a>
        </li>
        @endif

        @if (Auth::user()->role =='admin')
        <li><a class="app-menu__item @if (Request()->is('admin/contact/*')) active @endif" href="admin/contact/list"><i
                    class="app-menu__icon fa fa-address-card-o"></i><span class="app-menu__label">Danh sách liên
                    hệ</span></a>
        </li>
        <li><a class="app-menu__item @if (Request()->is('admin/users/*')) active @endif" href="admin/users/list"><i
                    class="app-menu__icon fa fa-star"></i><span class="app-menu__label">Tài khoản quản trị</span></a>
        </li>
        @endif
        <li class="treeview"><a class="app-menu__item @if (Request()->is('admin/profile/*')) active @endif" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Tài khoản
                    của tôi</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="admin/profile/{{Auth::user()->id}}"><i
                            class="icon fa fa-circle-o"></i>Thông tin</a></li>
                <li><a class="treeview-item" href="admin/profile/changepass/{{Auth::user()->id}}"><i
                            class="icon fa fa-circle-o"></i>Đổi mật khẩu</a></li>
                <li><a class="treeview-item" href="admin/logout"><i class="icon fa fa-circle-o"></i>Thoát hệ thống</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>