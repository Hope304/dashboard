@extends('admin.layout.index')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> Danh sách điểm cháy</h1>
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
                <th>Huyện</th>
                <th>Xã</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Tiểu khu</th>
                <th>Khoảnh</th>
                <th>Lô</th>
                <th>Thời gian</th>
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
                                    Xác nhận xoá bản ghi này ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <a class="btn btn-danger btn-ok">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <td>{{$list->commune->district->huyen}}</td>
                    <td>{{$list->commune->xa}}</td>
                    <td>{{$list->latitude}}</td>
                    <td>{{$list->longitude}}</td>
                    <td>{{$list->tk}}</td>
                    <td>{{$list->khoanh}}</td>
                    <td>{{$list->lo}}</td>
                    <td>{{$list->acq_date . " ". $list->acq_time}}</td>
                    <td style="text-align: center; min-width: 180px !important;margin: 0">
                        <a href="admin/hotspot/view/{{$list->id}}" title="View"
                           class="btn btn-sm btn-warning ">
                            <i class="fa fa-eye"></i> <span class="hidden-xs hidden-sm">Xem</span>
                        </a>
                        @if (Auth::user()->role =='admin')
            
                        <a href="#" data-href="admin/hotspot/delete/{{$list->id}}" data-toggle="modal"
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
