@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> Danh sách người dùng đăng ký dịch vụ</h1>
        </div>
        @if (Auth::user()->role =='admin')
        <a href="admin/receiveEmail/add" class="btn btn-success">
            <i class="fa fa-plus"></i> <span>Thêm</span>
        </a>
        @endif
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
                <th>Họ tên</th>
                <th>Đơn vị</th>
                <th>Chức vụ</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Huyện</th>
                <th>Xã</th>
                <th>Đăng ký dịch vụ</th>
                @if (Auth::user()->role =='admin')
            
                <th style="text-align: center">Hành động</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($data as $dt)
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
                    <td>{{$dt->name}}</td>
                    <td>{{$dt->unit}}</td>
                    <td>{{$dt->position}}</td>
                    <td>{{$dt->phone}}</td>
                    <td>{{$dt->email}}</td>
                    <td>{{$dt->commune->district->huyen}}</td>
                    <td>{{$dt->commune->xa}}</td>
                    <td>
                        <ul>
                            @if($dt->firelevel == '1')
                                <li>Nhận mail cấp cháy hàng ngày</li>
                            @endif
                            @if($dt->verification == '1')
                                <li>Nhận mail khi có người xác minh</li>
                            @endif
                            @if($dt->hotspot == '1')
                                <li>Nhận email khi có hotspot mới từ nasa</li>
                            @endif
                        </ul>
                    </td>
                    @if (Auth::user()->role =='admin')
            
                    <td style="text-align: center;min-width: 180px !important;margin: 0">
                        <a href="admin/receiveEmail/edit/{{$dt->id}}" title="Edit" class="btn btn-sm btn-primary ">
                            <i class="fa fa-edit"></i> <span class="hidden-xs hidden-sm">Sửa</span>
                        </a>
                        <a href="#" data-href="admin/receiveEmail/delete/{{$dt->id}}" data-toggle="modal"
                           data-target="#confirm-delete" role="button" title="Delete" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> <span class="hidden-xs hidden-sm">Xoá</span>
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
