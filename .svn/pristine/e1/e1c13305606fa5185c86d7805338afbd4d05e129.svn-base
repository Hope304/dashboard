@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-eye"></i> Thông tin chi tiết</h1>
        </div>
        <div class="row">
            @if($data->kiemduyet == '0')
            <a href="#" data-href="admin/notification/verify/{{$data->id}}" data-toggle="modal"
               data-target="#confirm-verify" role="button" title="Verify" class="btn btn-success">
                <i class="fa fa-check-circle"></i> <span class="hidden-xs hidden-sm">Duyệt</span>
            </a>
            @endif
            <a href="#" data-href="admin/notification/delete/{{$data->id}}" data-toggle="modal"
               data-target="#confirm-delete" role="button" title="Delete" class="btn btn-danger" style="margin-left: 5px">
                <i class="fa fa-trash"></i> <span>Xoá</span>
            </a>
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
            <div class="modal fade" id="confirm-verify" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            Xác nhận kiểm duyệt ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                            <a class="btn btn-success btn-ok" style="color: #fff">Xác nhận</a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="admin/notification/list" class="btn btn-info" style="margin-left: 5px">
                <i class="fa fa-list"></i> <span>Danh Sách</span>
            </a>
        </div>
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
            @if (session('fail'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{session('fail')}}
                </div>
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th>Điểm cháy</th>
                        <td><a href="admin/hotspot/view/{{$data->hotspot->id}}" class="btn btn-sm btn-info "><span
                                        class="hidden-xs hidden-sm">Xem thông tin</span></a></td>
                    </tr>
                    <tr>
                        <th>Tình trạng xác minh</th>
                        <td>@if($data->tt_xacminh == 2) Đã xác minh là cháy rừng @elseif($data->tt_xacminh == 3) Đã xác minh không phải cháy rừng @else Đã xác minh có cháy nhưng không phải cháy rừng @endif</td>
                    </tr>
                    <tr>
                        <th>Mô tả</th>
                        <td>{{$data->mota}}</td>
                    </tr>
                    <tr>
                        <th>Hướng phơi</th>
                        <td>{{$data->huongphoi}}</td>
                    </tr>
                    <tr>
                        <th>Diện tích đám cháy</th>
                        <td>{{$data->dtdamchay}} (m²)</td>
                    </tr>
                    <tr>
                        <th>Khoảng cách</th>
                        <td>{{$data->khoangcach}}</td>
                    </tr>
                    <tr>
                        <th>Tình trạng đám cháy</th>
                        <td>{{$data->tt_damchay}}</td>
                    </tr>
                    <tr>
                        <th>Thời gian dập tắt</th>
                        <td>{{$data->tgdaptat}}</td>
                    </tr>
                    <tr>
                        <th>Người xác minh</th>
                        <td>{{$data->nguoixacminh}}</td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td>{{$data->dienthoai}}</td>
                    </tr>
                    <tr>
                        <th>Kiểm duyệt</th>
                        <td>@if($data->kiemduyet == 0) <b style="color: #dc3545">Chưa kiểm duyệt</b> @else <b
                                    style="color: #28a745">Đã kiểm duyệt</b> @endif</td>
                    </tr>
                    <tr>
                        <th>Hình ảnh</th>
                        <td><img src="admin/images/verify/{{$data->hinhanh}}" class="sizeimg"
                                 style="max-width:200px !important;"></td>
                    </tr>
                    <tr>
                        <th>Ngày xác minh</th>
                        <td>{{$data->ngayxacminh}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
@section('script')
    <script>
        $('#confirm-verify').on('show.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection
