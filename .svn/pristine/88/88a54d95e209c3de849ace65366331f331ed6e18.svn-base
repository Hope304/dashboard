@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> Danh sách kiểm duyệt báo cháy</h1>
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
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTables">
            <thead>
            <tr class="bg-primary" style="color: #fff">
                <th>Điểm cháy</th>
                <th>Mô tả</th>
                <th>S(m²)</th>
                <th>Tình trạng xác minh</th>
                <th>Kiểm duyệt</th>
                <th>Hình ảnh</th>
                <th>Ngày xác minh</th>
                <th style="text-align: center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $list)
                <tr>
                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Xác nhận huỷ xác minh ?
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

                    <td style="text-align: center"><a href="admin/hotspot/view/{{$list->hotspot->id}}"
                                                      class="btn btn-sm btn-info "><span class="hidden-xs hidden-sm">Xem thông tin</span></a>
                    </td>
                    <td>{{$list->mota}}</td>
                    <td>{{$list->dtdamchay}}</td>
                    <td>@if($list->tt_xacminh == 2) Đã xác minh là cháy rừng @elseif($list->tt_xacminh == 3) Đã xác minh không phải cháy rừng @else Đã xác minh có cháy nhưng không phải cháy rừng @endif</td>
                    <td>@if($list->kiemduyet == '0')<b style="color: #dc3545">Chưa kiểm duyệt</b> @else <b
                                style="color: #28a745">Đã kiểm duyệt</b> @endif</td>
                    <td style="text-align: center">
                        <img src="admin/images/verify/{{$list->hinhanh}}" class="sizeimg"
                             style="max-width:200px !important;">
                    </td>
                    <td>{{$list->ngayxacminh}}</td>
                    <td style="text-align: center; min-width: 180px !important;margin: 0">
                        <a href="admin/notification/view/{{$list->id}}" title="View"
                           class="btn btn-sm btn-warning ">
                            <i class="fa fa-eye"></i> <span class="hidden-xs hidden-sm">Xem</span>
                        </a>
                        @if (Auth::user()->role !='user')
            
                            @if($list->kiemduyet == '0')
                            <a href="#" data-href="admin/notification/verify/{{$list->id}}" data-toggle="modal"
                            data-target="#confirm-verify" role="button" title="Verify" class="btn btn-sm btn-success">
                                <i class="fa fa-check-circle"></i> <span class="hidden-xs hidden-sm">Duyệt</span>
                            </a>
                            @endif
                            <a href="#" data-href="admin/notification/delete/{{$list->id}}" data-toggle="modal"
                            data-target="#confirm-delete" role="button" title="Delete" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i> <span class="hidden-xs hidden-sm">Xoá</span>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $('#confirm-verify').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection
