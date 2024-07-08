@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> Danh sách tài khoản</h1>
        </div>
        <a href="admin/users/addUser" class="btn btn-success">
            <i class="fa fa-plus"></i> <span>Thêm</span>
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
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTables">
            <thead>
            <tr class="bg-primary" style="color: #fff">
                <th>STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Quyền</th>
                <th style="text-align: center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 1 @endphp
            @foreach($taikhoan as $tk)
            <tr>
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                Xác nhận xoá bản ghi này ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                <a class="btn btn-danger btn-ok">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
                <td>{{$i++}}</td>
                <td>{{$tk->name}}</td>
                <td>{{$tk->email}}</td>
                <td>
                    @if ($tk->role == 'admin')
                        Admin
                    @elseif($tk->role == 'user')
                        User
                    @else
                        {{ App\District::where('mahuyen', $tk->mahuyen)->first()->huyen }}
                    @endif
                </td>
                <td style="text-align: center;min-width: 180px !important;margin: 0">
                    <a href="admin/users/editUser/{{$tk->id}}" title="Edit" class="btn btn-sm btn-primary ">
                        <i class="fa fa-edit"></i> <span class="hidden-xs hidden-sm">Sửa</span>
                    </a>
                    <a href="#" data-href="admin/users/deleteUser/{{$tk->id}}" data-toggle="modal" data-target="#confirm-delete" role="button" title="Delete" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i> <span class="hidden-xs hidden-sm">Xoá</span>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
