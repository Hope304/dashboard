@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Sửa tài khoản</h1>
        </div>
        <a href="admin/users/list" class="btn btn-info" style="margin-left: 5px">
            <i class="fa fa-list"></i> <span>Danh Sách</span>
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
            <form action="admin/users/editUser/{{$tk->id}}" method="post" class="custom-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                    <label>Họ tên:</label>
                    <input type="text" value="{{$tk->name}}" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" value="{{$tk->email}}" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Đổi mật khẩu:</label>
                    <select class="form-control" name="changepass" id="changepass">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                </div>
                <div class="form-group" id="newpass" style="display: none">
                    <label>Mật khẩu mới:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>Phân quyền</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" @if($tk->role=='admin') selected @endif>Admin</option>
                        <option value="user" @if($tk->role=='user') selected @endif>User</option>
                        @php
                            $list_huyen = App\District::all();
                        @endphp
                        @if (isset($list_huyen))
                            @foreach ($list_huyen as $item)
                                <option value="{{ $item->mahuyen }}" @if($tk->mahuyen==$item->mahuyen) selected @endif>{{ $item->huyen }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var yes = $("#changepass").val();
            if (yes == 0) {
                $("#newpass").css('display', 'none');
            } else {
                $("#newpass").css('display', 'block');
            }

            $("#changepass").change(function () {
                var yes = $(this).val();
                if (yes == 0) {
                    $("#newpass").css('display', 'none');
                } else {
                    $("#newpass").css('display', 'block');
                }
            });
        });
    </script>
@endsection

