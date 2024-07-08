<!-- header -->
<div class="header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="admin/images/logo.jpg"
                    style="position: absolute; margin-top: 6px; margin-left: -92px; width:85px; height:65px;" />


                <div class="w3layouts-logo">
                    <h1>
                        <a href="/">
                            GIÁM SÁT RỪNG HÀ NAM - 2023
                            <span>CÔNG TY CPTM CÔNG NGHỆ XUÂN MAI GREEN</span>
                        </a>
                    </h1>
                    <hr id="hr-logo" />
                </div>
            </div>

            <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                <nav>
                    <ul class="nav navbar-nav">
                        <li><a href="/" class="hvr-sweep-to-bottom @if (Request()->is('/')) active_menu @endif">TRANG
                                CHỦ</a></li>
                        <li><a href="GioiThieu"
                                class="hvr-sweep-to-bottom @if (Request()->is('GioiThieu')) active_menu @endif">GIỚI
                                THIỆU</a></li>
                        <li><a href="CanhBaoChayRung"
                                class="hvr-sweep-to-bottom @if (Request()->is('CanhBaoChayRung')) active_menu @endif">CẢNH
                                BÁO CHÁY RỪNG</a></li>
                        <li><a href="GiamSatRung"
                                class="hvr-sweep-to-bottom @if (Request()->is('GiamSatRung')) active_menu @endif">GIÁM
                                SÁT RỪNG</a></li>
                        <li><a href="ThongKeBaoCao"
                                class="hvr-sweep-to-bottom @if (Request()->is('ThongKeBaoCao')) active_menu @endif">THỐNG
                                KÊ & BÁO CÁO</a></li>
                        <li>
                            <a href="#"
                                class="dropdown-toggle hvr-sweep-to-bottom @if (Request()->is('HDSD/view') || Request()->is('LienHe')) active_menu @endif"
                                data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TRỢ
                                GIÚP<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="hvr-sweep-to-bottom" href="/HDSD/view">HƯỚNG DẪN SỬ DỤNG</a></li>
                                <li><a class="hvr-sweep-to-bottom" href="LienHe">LIÊN HỆ</a></li>
                            </ul>
                        </li>
                        {{-- <li><a href="LienHe"
                                class="hvr-sweep-to-bottom @if (Request()->is('LienHe')) active_menu @endif">LIÊN HỆ</a>
                        </li> --}}
                        <li><a href="Login"
                                class="hvr-sweep-to-bottom @if (Request()->is('Login')) active_menu @endif">QUẢN TRỊ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
</div>