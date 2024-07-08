@extends('admin.layout.index')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-star"></i> Số liệu kiểm tra các mức cảnh báo cấp độ cháy rừng từ 13h ngày {{$time_ago}} đến 13h ngày {{$time}}</h1>
        </div>
        @if (Auth::user()->role != 'user')
        <a href="admin/dieuchinhcapchay" class="btn btn-success">
            <i class="fa fa-plus"></i> <span>Điều chỉnh cấp cháy</span>
        </a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTables">
            <thead>
            <tr class="bg-primary" style="color: #fff">
                <th>Huyện</th>
                <th>Xã</th>
                <th>Nhiệt độ</th>
                <th>Độ ẩm</th>
                <th>Tốc độ gió</th>
                <th>Hướng gió</th>
                <th>Lượng mưa</th>
                <th>CSP</th>
                <th>Cấp NCC</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $data)
                <tr>
                    <td>{{$data->commune->district->huyen}}</td>
                    <td>{{$data->commune->xa}}</td>
                    <td>{{$data->nhietdo}}</td>
                    <td>{{$data->doam}}</td>
                    <td>{{$data->tocdogio}}</td>
                    <td>{{$data->huonggio}}</td>
                    <td>{{$data->luongmua}}</td>
                    <td>{{$data->csp}}</td>
                    <td>{{$data->capncc}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
