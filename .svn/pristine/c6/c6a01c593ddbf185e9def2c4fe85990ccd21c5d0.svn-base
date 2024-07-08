@extends('web.layout.index')
@section('content')
    <div class="container LoginForm">
        <div class="col-md-12 row form-inner-cont LoginMargin">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3 class="text-center">ĐẶT LẠI MẬT KHẨU</h3>
                <form action="resets/{{$token}}" method="post" class="signin-form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-input" style="margin-top: 15px">
                        <input type="password" name="Password" placeholder="Nhập mật khẩu mới... " required="">
                    </div>
                    <div class="form-input" style="margin-top: 15px">
                        <input type="password" name="RePassword" placeholder="Xác nhật mật khẩu mới... " required="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-login"
                                style="color: #fff; background-color: #17a2b8">Thực hiện</button>
                    </div>
                </form>
                <div class="text-center" style="min-width: 350px; margin:0 10px;">
                    @if (count($errors)>0)
                        <div class="alert alert-danger alert-dismissible" style="line-height: 50px !important;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div class="alert alert-danger alert-dismissible" style="line-height: 50px !important;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

    </div>
@endsection
