@extends('web.layout.index')
@section('content')
    <div class="container LoginForm">
        <div class="col-md-12 row form-inner-cont LoginMargin">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-center">ĐĂNG NHẬP</h3>
                <form action="Login" method="post" class="signin-form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-input" style="margin-top: 15px">
                        <input type="text" name="email" autofocus placeholder="Nhập email..." required="">
                    </div>
                    <div class="form-input" style="margin-top: 15px">
                        <input type="password" name="password" placeholder="Nhập mật khẩu... " required="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-style btn-success btn-login">ĐĂNG NHẬP</button>
                        <a href="/ForgotPassword" type="button" class="btn btn-style btn-danger btn-resetpass">QUÊN MẬT
                            KHẨU</a>
                    </div>
                </form>
                <div class="text-center" style="min-width: 350px; margin:0 10px;">

                    @if (session('error'))
                        <div id="close_err" class="alert alert-danger alert-dismissible"
                             style="line-height: 50px !important;">
                            <a id="click_close_err" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('error')}}
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div id="close_success" class="alert alert-success alert-dismissible"
                             style="line-height: 50px !important;">
                            <a id="click_close_success" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $('#click_close_err').click(function () {
            $('#close_err').css('display', 'none');
        });

        $('#click_close_success').click(function () {
            $('#close_success').css('display', 'none');
        });
    </script>
@endsection
