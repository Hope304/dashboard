@extends('web.layout.index')
@section('content')
    <div class="container LoginForm">
        <div class="col-md-12 row form-inner-cont LoginMargin">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-center">QUÊN MẬT KHẨU</h3>
                <div class="text-center" style="min-width: 350px; margin:0 10px;">
                    @if (count($errors)>0)
                        <div class="alert alert-danger alert-dismissible" style="line-height: 50px !important;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
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
                            <a id="click_close_success" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>
                <form action="ForgotPassword" method="post" class="signin-form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-input" style="margin-top: 15px">
                        <input type="text" name="email" autofocus placeholder="Nhập email..." required="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-login"
                                style="color: #fff; background-color: #17a2b8">Đặt lại mật khẩu
                        </button>
                    </div>
                </form>

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
