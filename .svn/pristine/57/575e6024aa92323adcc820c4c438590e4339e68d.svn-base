@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-eye"></i> Thông tin chi tiết điểm cháy</h1>
        </div>
        <div class="row">
            <a href="#" data-href="admin/hotspot/delete/{{$data->id}}" data-toggle="modal"
               data-target="#confirm-delete"
               role="button" title="Delete" class="btn btn-danger">
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
            <a href="admin/hotspot/list" class="btn btn-info" style="margin-left: 5px">
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
                        <th>Mã huyện</th>
                        <td>{{$data->commune->district->mahuyen}}</td>
                    </tr>
                    <tr>
                        <th>Huyện</th>
                        <td>{{$data->commune->district->huyen}}</td>
                    </tr>
                    <tr>
                        <th>Mã xã</th>
                        <td>{{$data->maxa}}</td>
                    </tr>
                    <tr>
                        <th>Xã</th>
                        <td>{{$data->commune->xa}}</td>
                    </tr>
                    <tr>
                        <th>Tiểu khu</th>
                        <td>{{$data->tk}}</td>
                    </tr>
                    <tr>
                        <th>Khoảnh</th>
                        <td>{{$data->khoanh}}</td>
                    </tr>
                    <tr>
                        <th>Lô</th>
                        <td>{{$data->lo}}</td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td>{{$data->latitude}}</td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td>{{$data->longitude}}</td>
                    </tr>
                    <tr>
                        <th>Độ sáng</th>
                        <td>{{$data->brightness}}</td>
                    </tr>
                    <tr>
                        <th>Scan</th>
                        <td>{{$data->scan}}</td>
                    </tr>
                    <tr>
                        <th>Track</th>
                        <td>{{$data->track}}</td>
                    </tr>
                    <tr>
                        <th>Ngày chụp</th>
                        <td>{{$data->acq_date}}</td>
                    </tr>
                    <tr>
                        <th>Giờ chụp</th>
                        <td>{{$data->acq_time}}</td>
                    </tr>
                    <tr>
                        <th>Vệ tinh</th>
                        <td>{{$data->satellite}}</td>
                    </tr>
                    <tr>
                        <th>Độ tin cậy</th>
                        <td>{{$data->confidence}}</td>
                    </tr>
                    <tr>
                        <th>Phiên bản vệ tinh</th>
                        <td>{{$data->version}}</td>
                    </tr>
                    <tr>
                        <th>Độ sáng kênh 31</th>
                        <td>{{$data->bright_t31}}</td>
                    </tr>
                    <tr>
                        <th>Thời điểm chụp</th>
                        <td>{{$data->daynight}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
