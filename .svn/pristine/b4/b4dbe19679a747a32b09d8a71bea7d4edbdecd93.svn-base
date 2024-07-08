@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cog"></i> Đổi mật khẩu</h1>
        </div>
        <a href="admin/profile/{{$id}}" class="btn btn-info" style="margin-left: 5px">
            <i class="fa fa-user"></i> <span>Thông tin tài khoản</span>
        </a>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            @if (count($errors)>0)
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach ($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif
            @if (session('baoloi'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('baoloi')}}
                </div>
            @endif
            @if (session('thongbao'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('thongbao')}}
                </div>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <form action="admin/profile/changepass/{{$id}}" method="post" class="custom-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                    <label>Mật khẩu mới:</label>
                    <input type="password" class="form-control" name="newpassword">
                </div>
                <div class="form-group">
                    <label>Xác nhận mật khẩu mới:</label>
                    <input type="password" class="form-control" name="newpasswordAgain">
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
